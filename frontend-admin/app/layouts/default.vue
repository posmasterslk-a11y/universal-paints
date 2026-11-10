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
        <NuxtLink to="/categories" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-400 hover:text-white hover:bg-white/5 transition" active-class="bg-red-600 !text-white hover:bg-red-600">
          <i class="fa-solid fa-tags w-5"></i>
          Categories
        </NuxtLink>
        <NuxtLink to="/sales-reps" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-400 hover:text-white hover:bg-white/5 transition" active-class="bg-red-600 !text-white hover:bg-red-600">
          <i class="fa-solid fa-map-location-dot w-5"></i>
          Sales Representatives
        </NuxtLink>
        <NuxtLink to="/blogs" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-400 hover:text-white hover:bg-white/5 transition" active-class="bg-red-600 !text-white hover:bg-red-600">
          <i class="fa-solid fa-pen-nib w-5"></i>
          Blogs
        </NuxtLink>
        <NuxtLink to="/users" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-400 hover:text-white hover:bg-white/5 transition" active-class="bg-red-600 !text-white hover:bg-red-600">
          <i class="fa-solid fa-users w-5"></i>
          User Accounts
        </NuxtLink>
        <a href="https://universalpaints.lk/" target="_blank" rel="noopener noreferrer" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-400 hover:text-white hover:bg-white/5 transition">
          <i class="fa-solid fa-arrow-up-right-from-square w-5"></i>
          View Site
        </a>
      </nav>
      <div class="p-4 border-t border-white/10 space-y-2">
        <button @click="handleLogout" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-lg text-slate-400 hover:text-red-400 hover:bg-red-400/10 transition cursor-pointer">
          <i class="fa-solid fa-right-from-bracket w-5"></i>
          Logout
        </button>
        <div class="px-2 pt-2 text-[11px] text-slate-400 flex items-center justify-between border-t border-white/5">
          <span>v{{ config.public.appVersion }}</span>
          <span class="text-slate-400 font-mono">{{ config.public.buildTime }}</span>
        </div>
      </div>
    </aside>

    <!-- Main Content -->
    <div :class="['flex-1 flex flex-col min-h-screen overflow-y-auto', token ? 'ml-64' : '']">
      <main :class="['flex-1', token ? 'p-8' : 'flex items-center justify-center p-8']">
        <slot />
      </main>

      <!-- Admin Panel Footer with Version & Build Number -->
      <footer v-if="token" class="px-8 py-3.5 border-t border-slate-200 bg-white text-xs text-slate-500 flex flex-col sm:flex-row justify-between items-center gap-2">
        <div class="flex items-center gap-2">
          <span class="font-bold text-slate-700">Universal Paints</span>
          <span>&bull; Admin Console &copy; {{ currentYear }}</span>
        </div>
        <div class="flex items-center gap-2.5">
          <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-slate-100 text-slate-700 font-mono font-medium border border-slate-200">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block animate-pulse"></span>
            Version: v{{ config.public.appVersion }}
          </span>
          <span class="text-slate-400 font-mono text-[11px]">
            Build: {{ config.public.buildTime }}
          </span>
        </div>
      </footer>
    </div>
  </div>
</template>

<script setup>
const { token, logout } = useAuth()
const router = useRouter()
const config = useRuntimeConfig()
const currentYear = new Date().getFullYear()

const handleLogout = async () => {
  await logout()
  router.push('/login')
}
</script>
