<template>
  <div class="bg-gray-50 min-h-screen">
    <!-- Category Hero -->
    <div class="relative bg-brand-primary text-white py-24 overflow-hidden">
      <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1610505466042-3e21cbf2d011?q=80&w=2000&auto=format&fit=crop')] bg-cover bg-center opacity-20 mix-blend-overlay"></div>
      <div class="absolute inset-0 bg-gradient-to-t from-brand-primary via-transparent to-transparent"></div>
      <div class="container mx-auto px-4 relative z-10 text-center">
        <span class="text-brand-accent1 font-bold tracking-widest uppercase text-sm mb-3 block">Natural Beauty</span>
        <h1 class="text-4xl md:text-6xl font-bold mb-6 text-white">Wood Coatings</h1>
        <p class="text-xl max-w-2xl mx-auto text-gray-200">Enhance and protect the natural beauty of timber. From clear varnishes to rich wood stains and enamels.</p>
      </div>
    </div>

    <!-- Product Grid -->
    <div class="container mx-auto px-4 py-20">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Product 1 -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-xl transition-all group flex flex-col">
          <div class="h-48 bg-gray-50 rounded-xl mb-6 p-4 flex items-center justify-center relative overflow-hidden">
            <img src="/images/bucket_green.png" alt="Polyurethane Clear Varnish" class="h-full object-contain mix-blend-multiply group-hover:scale-110 transition-transform duration-500" />
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-2">PU Clear Varnish</h3>
          <p class="text-gray-600 mb-6 flex-grow">A tough, scratch-resistant clear coat that highlights the natural grain of wood. Perfect for furniture and doors.</p>
          <div class="flex justify-between items-center border-t border-gray-100 pt-4">
            <span class="font-bold text-gray-900">1L, 4L</span>
            <button @click="openQuote" class="text-brand-accent1 font-bold hover:text-brand-primary flex items-center gap-1 transition-colors">
              Get Quote <Icon name="lucide:arrow-right" size="16" />
            </button>
          </div>
        </div>

        <!-- Product 2 -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-xl transition-all group flex flex-col">
          <div class="h-48 bg-gray-50 rounded-xl mb-6 p-4 flex items-center justify-center relative overflow-hidden">
            <img src="/images/bucket_red.png" alt="Premium Teak Polish" class="h-full object-contain mix-blend-multiply group-hover:scale-110 transition-transform duration-500" />
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-2">Premium Teak Polish</h3>
          <p class="text-gray-600 mb-6 flex-grow">A traditional oil-based polish that penetrates deep to nourish the wood while providing a rich, warm glow to antique and modern teak.</p>
          <div class="flex justify-between items-center border-t border-gray-100 pt-4">
            <span class="font-bold text-gray-900">1L</span>
            <button @click="openQuote" class="text-brand-accent1 font-bold hover:text-brand-primary flex items-center gap-1 transition-colors">
              Get Quote <Icon name="lucide:arrow-right" size="16" />
            </button>
          </div>
        </div>

        <!-- Product 3 -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-xl transition-all group flex flex-col">
          <div class="h-48 bg-gray-50 rounded-xl mb-6 p-4 flex items-center justify-center relative overflow-hidden">
            <img src="/images/bucket_blue.png" alt="Enamel Wood Paint" class="h-full object-contain mix-blend-multiply group-hover:scale-110 transition-transform duration-500" />
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-2">High-Gloss Enamel</h3>
          <p class="text-gray-600 mb-6 flex-grow">A versatile, highly durable enamel paint for wood and metal. Provides a brilliant, mirror-like finish that is easy to wash.</p>
          <div class="flex justify-between items-center border-t border-gray-100 pt-4">
            <span class="font-bold text-gray-900">1L, 4L</span>
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
