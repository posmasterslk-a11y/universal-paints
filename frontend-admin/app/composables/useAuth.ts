export const useAuth = () => {
  const authCookie = useCookie('auth_token', {
    maxAge: 60 * 60 * 24 * 30, // 30-day session
    path: '/',
    sameSite: 'lax',
    secure: true
  })
  const userCookie = useCookie('auth_user', {
    maxAge: 60 * 60 * 24 * 30,
    path: '/',
    sameSite: 'lax',
    secure: true
  })

  const token = useState('auth_token', () => authCookie.value || null)
  const user = useState('auth_user', () => userCookie.value || null)
  const config = useRuntimeConfig()

  // Sync state from cookies immediately on load
  if (!token.value && authCookie.value) {
    token.value = authCookie.value
  }
  if (!user.value && userCookie.value) {
    user.value = userCookie.value
  }

  const login = async (email, password) => {
    try {
      const response = await $fetch(`${config.public.apiBase}/api/login`, {
        method: 'POST',
        headers: {
          Accept: 'application/json'
        },
        body: { email, password }
      })

      if (response && response.token) {
        token.value = response.token
        user.value = response.user
        authCookie.value = response.token
        userCookie.value = response.user

        if (process.client) {
          localStorage.setItem('auth_token', response.token)
          try {
            localStorage.setItem('auth_user', JSON.stringify(response.user))
          } catch (_) {}
        }

        return true
      }
    } catch (error) {
      console.error('Login failed:', error)
      return false
    }
  }

  const logout = async () => {
    if (token.value) {
      try {
        await $fetch(`${config.public.apiBase}/api/logout`, {
          method: 'POST',
          headers: {
            Authorization: `Bearer ${token.value}`,
            Accept: 'application/json'
          }
        })
      } catch (e) {
        console.error('Logout error', e)
      }
    }

    token.value = null
    user.value = null
    authCookie.value = null
    userCookie.value = null
    if (process.client) {
      localStorage.removeItem('auth_token')
      localStorage.removeItem('auth_user')
    }
  }

  const initAuth = async () => {
    // 1. Check cookie or current state first
    let activeToken = authCookie.value || token.value

    // 2. Fallback to localStorage if in browser
    if (!activeToken && process.client) {
      activeToken = localStorage.getItem('auth_token')
    }

    if (activeToken) {
      token.value = activeToken
      authCookie.value = activeToken

      // Retrieve cached user profile
      if (!user.value && process.client) {
        try {
          const storedUser = localStorage.getItem('auth_user')
          if (storedUser) user.value = JSON.parse(storedUser)
        } catch (_) {}
      }

      // Verify and refresh user data in background
      try {
        const userData = await $fetch(`${config.public.apiBase}/api/user`, {
          headers: {
            Authorization: `Bearer ${activeToken}`,
            Accept: 'application/json'
          }
        })
        user.value = userData
        userCookie.value = userData
        if (process.client) {
          try {
            localStorage.setItem('auth_user', JSON.stringify(userData))
          } catch (_) {}
        }
      } catch (e) {
        // Only invalidate session if backend returns 401 Unauthorized
        if (e?.response?.status === 401 || e?.status === 401) {
          token.value = null
          user.value = null
          authCookie.value = null
          userCookie.value = null
          if (process.client) {
            localStorage.removeItem('auth_token')
            localStorage.removeItem('auth_user')
          }
        }
      }
    }
  }

  return {
    token,
    user,
    login,
    logout,
    initAuth
  }
}
