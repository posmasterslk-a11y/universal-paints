export default defineNuxtRouteMiddleware(async (to, from) => {
  const { token, initAuth } = useAuth()

  // Ensure persistent token is loaded from cookie / storage before evaluating route
  if (!token.value) {
    await initAuth()
  }

  // Strip possible baseURL (/admin) prefix
  const cleanPath = to.path.replace(/^\/admin/, '') || '/'
  const isLoginPage = cleanPath === '/login' || cleanPath === '/login/' || to.name === 'login'

  if (!isLoginPage && !token.value) {
    return navigateTo('/login')
  }

  if (isLoginPage && token.value) {
    return navigateTo('/')
  }
})
