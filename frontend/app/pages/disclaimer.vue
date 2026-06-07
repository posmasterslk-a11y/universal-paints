<template>
  <div class="bg-surface-light min-h-screen pt-32 md:pt-40 pb-24">
    <div class="container mx-auto px-4 max-w-4xl">
      <div class="bg-white rounded-[2rem] shadow-xl border border-gray-100 p-10 md:p-16">
        
        <div class="mb-12 border-b border-gray-100 pb-8">
          <span class="inline-block py-1 px-4 rounded-full bg-brand-accent1/10 text-brand-accent1 text-xs font-bold uppercase tracking-widest mb-4">Important</span>
          <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Disclaimer</h1>
          <p class="text-gray-500">Please read this disclaimer carefully before making purchasing decisions based on digital representations.</p>
        </div>

        <div class="space-y-8 text-gray-600 leading-relaxed">
          
          <div class="bg-brand-primary/5 border-l-4 border-brand-primary p-6 rounded-r-xl">
            <h2 class="text-xl font-bold text-gray-900 mb-2">Color Accuracy Warning</h2>
            <p class="text-gray-700">The paint colors displayed on this website are for digital reference only and may not be a 100% accurate representation of the physical paint color.</p>
          </div>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">1. Screen Variations</h2>
            <p>Digital screens, monitors, and mobile devices interpret and emit colors differently depending on their display technology, brightness settings, color profile, and age. Therefore, the color you see on your screen may differ significantly from the actual paint color when applied to a surface.</p>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">2. Lighting Conditions</h2>
            <p>Physical paint color is highly dependent on environmental lighting. Natural daylight (morning vs. afternoon) and artificial lighting (warm vs. cool bulbs) will dramatically alter how a paint color is perceived in your specific room. Colors shown digitally cannot account for your specific lighting environment.</p>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">3. Surface Texture</h2>
            <p>The texture, porosity, and base color of the surface being painted will affect the final appearance of the color. A color applied to smooth drywall will look different than the exact same color applied to textured stucco or wood.</p>
          </section>

          <section>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Recommendation</h2>
            <p class="font-medium text-gray-800">We strongly recommend visiting an authorized Universal Paints dealer to view physical color cards, or purchasing a small sample pot to test the color directly on your intended surface before making a large purchase.</p>
          </section>

        </div>

      </div>
    </div>
  </div>
</template>

<script setup>
useHead({
  title: 'Disclaimer | Universal Paints'
})
</script>
