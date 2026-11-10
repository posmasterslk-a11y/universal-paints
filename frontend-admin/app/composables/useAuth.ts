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

  const token = useState('auth_token', () => {
    if (process.client) {
      return authCookie.value || localStorage.getItem('auth_token') || null
    }
    return authCookie.value || null
  })

  const user = useState('auth_user', () => {
    if (process.client) {
      const stored = localStorage.getItem('auth_user')
      if (stored) {
        try { return JSON.parse(stored) } catch (_) {}
      }
    }
    return userCookie.value || null
  })

  const config = useRuntimeConfig()

  // Immediately synchronize token from localStorage on client
  if (process.client && !token.value) {
    const lsToken = localStorage.getItem('auth_token')
    if (lsToken) {
      token.value = lsToken
      authCookie.value = lsToken
    }
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
    // 1. Check state, cookie or localStorage
    let activeToken = token.value || authCookie.value
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

      // Re-verify user asynchronously in background (does NOT block route or logout on network blip)
      if (process.client) {
        $fetch(`${config.public.apiBase}/api/user`, {
          headers: {
            Authorization: `Bearer ${activeToken}`,
            Accept: 'application/json'
          }
        }).then(userData => {
          if (userData && userData.id) {
            user.value = userData
            userCookie.value = userData
            try {
              localStorage.setItem('auth_user', JSON.stringify(userData))
            } catch (_) {}
          }
        }).catch(err => {
          const status = err?.status || err?.statusCode || err?.response?.status
          if (status === 401) {
            token.value = null
            user.value = null
            authCookie.value = null
            userCookie.value = null
            localStorage.removeItem('auth_token')
            localStorage.removeItem('auth_user')
            navigateTo('/login')
          }
        })
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
