<template>
  <div class="flex h-screen bg-slate-50">
    <!-- Sidebar -->
    <aside class="w-64 bg-slate-900 text-white flex flex-col fixed h-full" v-if="token">
      <div class="p-6 border-b border-white/10">
        <h2 class="text-xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-white to-slate-300">Admin Panel</h2>
      </div>
      <nav class="flex-1 p-4 space-y-2">
        <NuxtLink to="/" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-400 hover:text-white hover:bg-white/5 transition" active-class="bg-red-600 !text-white hover:bg-red-600">
          <i class="fa-solid fa-chart-pie w-5"></i>
          Dashboard
        </NuxtLink>
        <NuxtLink to="/products" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-400 hover:text-white hover:bg-white/5 transition" active-class="bg-red-600 !text-white hover:bg-red-600">
          <i class="fa-solid fa-box-open w-5"></i>
          Products
        </NuxtLink>
        <NuxtLink to="/orders" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-400 hover:text-white hover:bg-white/5 transition" active-class="bg-red-600 !text-white hover:bg-red-600">
          <i class="fa-solid fa-shopping-cart w-5"></i>
          Orders
        </NuxtLink>
        <a href="http://localhost:3002" target="_blank" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-400 hover:text-white hover:bg-white/5 transition">
          <i class="fa-solid fa-arrow-up-right-from-square w-5"></i>
          View Site
        </a>
      </nav>
      <div class="p-4 border-t border-white/10">
        <button @click="handleLogout" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-slate-400 hover:text-red-400 hover:bg-red-400/10 transition cursor-pointer">
          <i class="fa-solid fa-right-from-bracket w-5"></i>
          Logout
        </button>
      </div>
    </aside>

    <!-- Main Content -->
    <main :class="['flex-1 overflow-y-auto', token ? 'ml-64 p-8' : 'flex items-center justify-center p-8']">
      <slot />
    </main>
  </div>
</template>

<script setup>
const { token, logout } = useAuth()
const router = useRouter()

const handleLogout = async () => {
  await logout()
  router.push('/login')
}
</script>
