<template>
  <div class="bg-gray-50 min-h-screen">
    <!-- Category Hero -->
    <div class="relative bg-brand-primary text-white py-24 overflow-hidden">
      <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=2000&auto=format&fit=crop')] bg-cover bg-center opacity-20 mix-blend-overlay"></div>
      <div class="absolute inset-0 bg-gradient-to-t from-brand-primary via-transparent to-transparent"></div>
      <div class="container mx-auto px-4 relative z-10 text-center">
        <span class="text-brand-accent1 font-bold tracking-widest uppercase text-sm mb-3 block">Heavy Duty</span>
        <h1 class="text-4xl md:text-6xl font-bold mb-6 text-white">Industrial Paints</h1>
        <p class="text-xl max-w-2xl mx-auto text-gray-200">Engineered for extreme environments. Anti-corrosive, chemical-resistant, and heat-resistant coatings for commercial applications.</p>
      </div>
    </div>

    <!-- Product Grid -->
    <div class="container mx-auto px-4 py-20">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Product 1 -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-xl transition-all group flex flex-col">
          <div class="h-48 bg-gray-50 rounded-xl mb-6 p-4 flex items-center justify-center relative overflow-hidden">
            <img src="/images/bucket_blue.png" alt="Heavy-Duty Epoxy" class="h-full object-contain mix-blend-multiply group-hover:scale-110 transition-transform duration-500" />
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-2">Heavy-Duty Epoxy</h3>
          <p class="text-gray-600 mb-6 flex-grow">A two-part epoxy system that cures to a rock-hard finish. Impervious to harsh chemicals, solvents, and heavy machinery wear.</p>
          <div class="flex justify-between items-center border-t border-gray-100 pt-4">
            <span class="font-bold text-gray-900">10L, 20L Kits</span>
            <button @click="openQuote" class="text-brand-accent1 font-bold hover:text-brand-primary flex items-center gap-1 transition-colors">
              Get Quote <Icon name="lucide:arrow-right" size="16" />
            </button>
          </div>
        </div>

        <!-- Product 2 -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-xl transition-all group flex flex-col">
          <div class="h-48 bg-gray-50 rounded-xl mb-6 p-4 flex items-center justify-center relative overflow-hidden">
            <span class="absolute top-2 left-2 bg-gray-900 text-white text-[10px] font-bold uppercase px-2 py-1 rounded z-10">Specialty</span>
            <img src="/images/bucket_red.png" alt="Heat Resistant Coating" class="h-full object-contain mix-blend-multiply group-hover:scale-110 transition-transform duration-500" />
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-2">Heat Resistant 600°C</h3>
          <p class="text-gray-600 mb-6 flex-grow">A specialized silicone-based coating designed for industrial exhaust pipes, boilers, and kilns operating at extreme temperatures.</p>
          <div class="flex justify-between items-center border-t border-gray-100 pt-4">
            <span class="font-bold text-gray-900">4L, 20L</span>
            <button @click="openQuote" class="text-brand-accent1 font-bold hover:text-brand-primary flex items-center gap-1 transition-colors">
              Get Quote <Icon name="lucide:arrow-right" size="16" />
            </button>
          </div>
        </div>

        <!-- Product 3 -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-xl transition-all group flex flex-col">
          <div class="h-48 bg-gray-50 rounded-xl mb-6 p-4 flex items-center justify-center relative overflow-hidden">
            <img src="/images/bucket_green.png" alt="Factory Floor Paint" class="h-full object-contain mix-blend-multiply group-hover:scale-110 transition-transform duration-500" />
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-2">Polyurethane Floor Paint</h3>
          <p class="text-gray-600 mb-6 flex-grow">A high-build, seamless floor coating that resists tire marks, impacts, and daily forklift traffic in busy warehouse environments.</p>
          <div class="flex justify-between items-center border-t border-gray-100 pt-4">
            <span class="font-bold text-gray-900">10L, 20L</span>
            <button @click="openQuote" class="text-brand-accent1 font-bold hover:text-brand-primary flex items-center gap-1 transition-colors">
              Get Quote <Icon name="lucide:arrow-right" size="16" />
            </button>
          </div>
        </div>
      </div>
    </div>

    <HomeContactCta />
  </div>
</template>

<script setup>
const openQuote = () => {
  window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
}
</script>
