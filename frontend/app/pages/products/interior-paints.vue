<template>
  <div class="bg-gray-50 min-h-screen">
    <!-- Category Hero -->
    <div class="relative bg-brand-primary text-white py-24 overflow-hidden">
      <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?q=80&w=2000&auto=format&fit=crop')] bg-cover bg-center opacity-20 mix-blend-overlay"></div>
      <div class="absolute inset-0 bg-gradient-to-t from-brand-primary via-transparent to-transparent"></div>
      <div class="container mx-auto px-4 relative z-10 text-center">
        <span class="text-brand-accent1 font-bold tracking-widest uppercase text-sm mb-3 block">Premium Finishes</span>
        <h1 class="text-4xl md:text-6xl font-bold mb-6 text-white">Interior Paints</h1>
        <p class="text-xl max-w-2xl mx-auto text-gray-200">Washable, zero VOC finishes for a beautiful and safe living space. Perfect for any room in your home.</p>
      </div>
    </div>

    <!-- Product Grid -->
    <div class="container mx-auto px-4 py-20">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Product 1 -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-xl transition-all group flex flex-col">
          <div class="h-48 bg-gray-50 rounded-xl mb-6 p-4 flex items-center justify-center relative overflow-hidden">
            <span class="absolute top-2 left-2 bg-brand-accent1 text-white text-[10px] font-bold uppercase px-2 py-1 rounded z-10">Bestseller</span>
            <img src="/images/bucket_red.png" alt="Superlux Emulsion" class="h-full object-contain mix-blend-multiply group-hover:scale-110 transition-transform duration-500" />
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-2">Superlux Emulsion</h3>
          <p class="text-gray-600 mb-6 flex-grow">Our flagship interior emulsion offering unparalleled washability and a luxurious matte finish. Zero VOCs for a healthy home.</p>
          <div class="flex justify-between items-center border-t border-gray-100 pt-4">
            <span class="font-bold text-gray-900">4L, 10L, 20L</span>
            <button @click="openQuote" class="text-brand-accent1 font-bold hover:text-brand-primary flex items-center gap-1 transition-colors">
              Get Quote <Icon name="lucide:arrow-right" size="16" />
            </button>
          </div>
        </div>

        <!-- Product 2 -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-xl transition-all group flex flex-col">
          <div class="h-48 bg-gray-50 rounded-xl mb-6 p-4 flex items-center justify-center relative overflow-hidden">
            <img src="/images/bucket_blue.png" alt="Easy-Clean Silk" class="h-full object-contain mix-blend-multiply group-hover:scale-110 transition-transform duration-500" />
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-2">Easy-Clean Silk</h3>
          <p class="text-gray-600 mb-6 flex-grow">A mid-sheen finish that repels stains and can be scrubbed clean. Perfect for high-traffic areas like kitchens and hallways.</p>
          <div class="flex justify-between items-center border-t border-gray-100 pt-4">
            <span class="font-bold text-gray-900">1L, 4L, 10L</span>
            <button @click="openQuote" class="text-brand-accent1 font-bold hover:text-brand-primary flex items-center gap-1 transition-colors">
              Get Quote <Icon name="lucide:arrow-right" size="16" />
            </button>
          </div>
        </div>

        <!-- Product 3 -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-xl transition-all group flex flex-col">
          <div class="h-48 bg-gray-50 rounded-xl mb-6 p-4 flex items-center justify-center relative overflow-hidden">
            <span class="absolute top-2 left-2 bg-gray-900 text-white text-[10px] font-bold uppercase px-2 py-1 rounded z-10">Premium</span>
            <img src="/images/bucket_green.png" alt="Royal Velvet" class="h-full object-contain mix-blend-multiply group-hover:scale-110 transition-transform duration-500" />
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-2">Royal Velvet</h3>
          <p class="text-gray-600 mb-6 flex-grow">The ultimate luxury finish. Formulated with light-reflecting particles for a rich, deep aesthetic. Highly durable and scrub-resistant.</p>
          <div class="flex justify-between items-center border-t border-gray-100 pt-4">
            <span class="font-bold text-gray-900">4L, 10L</span>
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
// Assuming a global or layout-level way to open the quote modal, or we just emit/use a composable.
// For now, we'll just alert or trigger a custom event. In the layout it's controlled by isQuoteModalOpen.
// A better way is using a global state, but for this demo:
const openQuote = () => {
  // Try to find the button in the header and click it, or just scroll to the CTA section
  window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
}
</script>
