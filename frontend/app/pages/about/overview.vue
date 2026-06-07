<template>
  <div class="bg-surface-light min-h-screen">
    
    <!-- Hero Section with Background Image -->
    <section class="relative pt-40 pb-32 overflow-hidden bg-brand-primary flex items-center min-h-[60vh]">
      <!-- Background Image with Overlay -->
      <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=1200&auto=format&fit=crop" alt="Modern Architecture" class="w-full h-full object-cover opacity-30 mix-blend-overlay" />
        <div class="absolute inset-0 bg-gradient-to-t from-brand-primary to-transparent opacity-80"></div>
      </div>
      
      <div class="container mx-auto px-4 relative z-10 text-center">
        <span class="inline-block py-1.5 px-5 rounded-full bg-white/10 text-white text-xs font-bold uppercase tracking-widest mb-6 border border-white/20 backdrop-blur-sm">
          About Us
        </span>
        <h1 class="text-4xl md:text-6xl font-bold text-white tracking-tight leading-tight max-w-4xl mx-auto mb-6">
          Crafting the Colors That <br class="hidden md:block" /> Protect Your World.
        </h1>
        <p class="text-white/80 text-lg md:text-xl max-w-2xl mx-auto leading-relaxed">
          Universal Paints is Sri Lanka's premier destination for high-performance protective coatings, interior luxury finishes, and uncompromising quality.
        </p>
      </div>
    </section>

    <!-- Bento Box Style Story Grid -->
    <section class="py-24 -mt-20 relative z-20">
      <div class="container mx-auto px-4">
        
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 max-w-6xl mx-auto">
          
          <!-- Box 1: The Mission (Large text box) -->
          <div class="md:col-span-8 bg-white p-10 md:p-16 rounded-3xl shadow-xl border border-gray-100 flex flex-col justify-center transform hover:-translate-y-1 transition-transform duration-300">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Our Mission Since 2001</h2>
            <div class="w-16 h-1 bg-brand-accent1 mb-8"></div>
            <p class="text-gray-600 text-lg leading-relaxed mb-6">
              It started in a small formulating lab over two decades ago. The goal was simple: to create a paint that doesn't just look beautiful on day one, but maintains its brilliance years later under harsh tropical weather.
            </p>
            <p class="text-gray-600 text-lg leading-relaxed">
              Today, we source the highest-grade raw materials globally, utilizing advanced cross-linking polymers to deliver premium paints that architects and homeowners trust.
            </p>
          </div>

          <!-- Box 2: Stats -->
          <div class="md:col-span-4 bg-brand-primary p-10 rounded-3xl shadow-xl text-white flex flex-col items-center justify-center text-center transform hover:-translate-y-1 transition-transform duration-300">
            <Icon name="lucide:award" size="48" class="text-brand-accent1 mb-6" />
            <h3 class="text-6xl font-bold mb-2">25+</h3>
            <p class="text-white/80 font-medium uppercase tracking-wider text-sm">Years of Excellence</p>
          </div>

          <!-- Box 3: Image -->
          <div class="md:col-span-4 h-64 md:h-auto rounded-3xl shadow-xl overflow-hidden transform hover:-translate-y-1 transition-transform duration-300">
            <img src="https://images.unsplash.com/photo-1589939705384-5185137a7f0f?q=80&w=600&auto=format&fit=crop" class="w-full h-full object-cover" alt="Factory Testing" />
          </div>

          <!-- Box 4: Quality Commitment -->
          <div class="md:col-span-8 bg-white p-10 md:p-12 rounded-3xl shadow-xl border border-gray-100 flex items-center gap-8 transform hover:-translate-y-1 transition-transform duration-300">
            <div class="w-20 h-20 flex-shrink-0 bg-surface-light rounded-2xl flex items-center justify-center hidden md:flex">
               <Icon name="lucide:flask-conical" size="36" class="text-brand-accent1" />
            </div>
            <div>
              <h3 class="text-2xl font-bold text-gray-900 mb-3">Precision R&D Laboratory</h3>
              <p class="text-gray-600 leading-relaxed">
                We believe in science over shortcuts. Every batch of Universal Paint undergoes rigorous stress-testing for UV resistance, washability, and color retention before it ever leaves our Panadura facility.
              </p>
            </div>
          </div>

        </div>

      </div>
    </section>

    <!-- Core Values Section (Clean Row) -->
    <section class="py-20 bg-gray-100 border-t border-gray-200">
      <div class="container mx-auto px-4 max-w-6xl">
        <div class="text-center mb-16">
          <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">What We Stand For</h2>
          <p class="text-gray-500">The pillars of the Universal Paints brand.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
          <div class="flex flex-col items-center text-center">
            <div class="w-16 h-16 bg-brand-primary/5 rounded-2xl flex items-center justify-center mb-6 text-brand-primary">
              <Icon name="lucide:shield-check" size="32" />
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Durability First</h3>
            <p class="text-gray-500 text-sm leading-relaxed">Formulated to resist fading, cracking, and peeling even in extreme tropical climates.</p>
          </div>
          
          <div class="flex flex-col items-center text-center border-t md:border-t-0 md:border-l border-gray-100 pt-8 md:pt-0">
            <div class="w-16 h-16 bg-brand-accent1/10 rounded-2xl flex items-center justify-center mb-6 text-brand-accent1">
              <Icon name="lucide:leaf" size="32" />
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Eco-Friendly</h3>
            <p class="text-gray-500 text-sm leading-relaxed">Pioneering Zero-VOC and lead-free paints that keep your family and the environment safe.</p>
          </div>

          <div class="flex flex-col items-center text-center border-t md:border-t-0 md:border-l border-gray-100 pt-8 md:pt-0">
            <div class="w-16 h-16 bg-brand-primary/5 rounded-2xl flex items-center justify-center mb-6 text-brand-primary">
              <Icon name="lucide:palette" size="32" />
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Infinite Colors</h3>
            <p class="text-gray-500 text-sm leading-relaxed">Using pure, finely-ground pigments for vibrant colors that pop exactly how you envisioned.</p>
          </div>
        </div>
      </div>
    </section>

  </div>
</template>

<script setup>
useHead({
  title: 'Overview | Universal Paints'
})
</script>
