<template>
  <div class="min-h-screen bg-gray-50 flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-brand-navy text-white flex flex-col transition-all duration-300 z-20">
      <div class="h-16 flex items-center justify-center border-b border-white/10 px-6">
        <h1 class="text-xl font-bold tracking-wider text-white">UP ADMIN</h1>
      </div>
      
      <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-2">
        <NuxtLink to="/" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors" active-class="bg-brand-red text-white" :class="{'text-gray-300 hover:bg-white/5': $route.path !== '/'}">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
          <span class="font-medium">Dashboard</span>
        </NuxtLink>
        <NuxtLink to="/products" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors" active-class="bg-brand-red text-white" :class="{'text-gray-300 hover:bg-white/5': !$route.path.includes('/products')}">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
          <span class="font-medium">Products</span>
        </NuxtLink>
        <NuxtLink to="/orders" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors text-gray-300 hover:bg-white/5">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
          <span class="font-medium">Orders</span>
        </NuxtLink>
        <NuxtLink to="/customers" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors text-gray-300 hover:bg-white/5">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
          <span class="font-medium">Customers</span>
        </NuxtLink>
      </nav>
      
      <div class="p-4 border-t border-white/10">
        <NuxtLink to="/login" class="flex items-center gap-3 px-4 py-3 text-gray-400 hover:text-white transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
          <span class="font-medium">Logout</span>
        </NuxtLink>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
      <!-- Top Navbar -->
      <header class="h-16 bg-white shadow-sm border-b border-gray-200 flex items-center justify-between px-8 z-10">
        <div class="flex items-center">
          <div class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            <input type="text" placeholder="Search..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-brand-red focus:border-brand-red w-64 bg-gray-50" />
          </div>
        </div>
        
        <div class="flex items-center gap-6">
          <button class="relative text-gray-500 hover:text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
            <span class="absolute top-0 right-0 h-2 w-2 bg-brand-red rounded-full"></span>
          </button>
          
          <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-brand-navy text-white flex items-center justify-center font-bold text-sm">
              AD
            </div>
            <div class="text-sm">
              <p class="font-semibold text-gray-700">Admin User</p>
              <p class="text-xs text-gray-500">Superadmin</p>
            </div>
          </div>
        </div>
      </header>

      <!-- Page Content -->
      <div class="flex-1 overflow-y-auto p-8">
        <slot />
      </div>
    </main>
  </div>
</template>
