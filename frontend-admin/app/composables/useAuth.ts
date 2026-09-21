import { ref } from 'vue'

export const useAuth = () => {
  const token = useState('auth_token', () => null)
  const user = useState('auth_user', () => null)
  const config = useRuntimeConfig()

  const login = async (email, password) => {
    try {
      const response = await $fetch(`${config.public.apiBase}/api/login`, {
        method: 'POST',
        body: { email, password }
      })

      if (response.token) {
        token.value = response.token
        user.value = response.user
        
        if (process.client) {
          localStorage.setItem('auth_token', response.token)
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
            Authorization: `Bearer ${token.value}`
          }
        })
      } catch (e) {
        console.error('Logout error', e)
      }
    }
    
    token.value = null
    user.value = null
    if (process.client) {
      localStorage.removeItem('auth_token')
    }
  }

  const initAuth = async () => {
    if (process.client) {
      const storedToken = localStorage.getItem('auth_token')
      if (storedToken) {
        try {
          const userData = await $fetch(`${config.public.apiBase}/api/user`, {
            headers: {
              Authorization: `Bearer ${storedToken}`
            }
          })
          token.value = storedToken
          user.value = userData
        } catch (e) {
          localStorage.removeItem('auth_token')
          token.value = null
          user.value = null
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
