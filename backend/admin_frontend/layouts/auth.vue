<template>
  <div class="min-h-screen bg-brand-light flex">
    <!-- Left: Branding/Image -->
    <div class="hidden lg:flex lg:w-1/2 bg-brand-navy relative items-center justify-center overflow-hidden">
      <div class="absolute inset-0 bg-gradient-to-br from-brand-blue to-brand-navy opacity-90 z-10"></div>
      
      <!-- Paint Splash Abstract Elements -->
      <div class="absolute top-0 right-0 w-96 h-96 bg-brand-red rounded-full mix-blend-multiply filter blur-3xl opacity-30 translate-x-1/3 -translate-y-1/3 z-0"></div>
      <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 -translate-x-1/3 translate-y-1/3 z-0"></div>
      
      <div class="relative z-20 text-center text-white px-12">
        <h1 class="text-5xl font-bold mb-4 tracking-tight">Universal Paints</h1>
        <p class="text-xl text-gray-300 font-light">E-Commerce Administration Panel</p>
        
        <div class="mt-12 inline-flex items-center gap-2 bg-white/10 px-6 py-3 rounded-full backdrop-blur-md border border-white/20">
          <span class="w-3 h-3 rounded-full bg-green-400 animate-pulse"></span>
          <span class="text-sm font-medium">System Online</span>
        </div>
      </div>
    </div>
    
    <!-- Right: Login Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 lg:p-24 bg-white shadow-[0_0_40px_rgba(0,0,0,0.05)] z-20 rounded-l-3xl lg:rounded-l-[40px] transition-all">
      <div class="w-full max-w-md">
        <slot />
      </div>
    </div>
  </div>
</template>
