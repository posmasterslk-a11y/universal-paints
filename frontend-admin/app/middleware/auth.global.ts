export default defineNuxtRouteMiddleware(async (to, from) => {
  const { token, initAuth } = useAuth()

  if (process.client && !token.value) {
    await initAuth()
  }

  if (to.path !== '/login' && !token.value) {
    return navigateTo('/login')
  }

  if (to.path === '/login' && token.value) {
    return navigateTo('/')
  }
})
