<template>
  <section class="py-24 bg-surface-light relative overflow-hidden">
    <!-- Decorative Subtle Accent -->
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-brand-accent1/5 rounded-full blur-[100px] pointer-events-none transform translate-x-1/3 -translate-y-1/3"></div>
    
    <div class="container mx-auto px-4 relative z-10">
      <div class="grid lg:grid-cols-2 gap-16 lg:gap-24 items-center">
        
        <!-- Left: Editorial Image Composition -->
        <div class="relative order-2 lg:order-1">
          <div class="relative rounded-2xl overflow-hidden aspect-[4/5] shadow-xl group cursor-pointer">
            <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=800&auto=format&fit=crop" alt="Luxury Interior" class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-in-out" />
            <!-- Soft light overlay instead of dark mix-blend -->
            <div class="absolute inset-0 bg-white/10 group-hover:bg-transparent transition-colors duration-500"></div>
          </div>
          <!-- Floating Glass Card -->
          <div class="absolute -bottom-8 -right-8 md:-right-12 bg-white/90 backdrop-blur-xl border border-gray-100 p-8 rounded-2xl shadow-2xl max-w-xs hidden md:block transform hover:-translate-y-2 transition-transform duration-500">
            <p class="text-4xl font-bold text-brand-primary mb-2">25<span class="text-brand-accent1">+</span></p>
            <p class="text-gray-600 font-medium leading-relaxed">Years of pioneering paint technology & innovation.</p>
          </div>
        </div>
        
        <!-- Right: Text & Elegant Features List -->
        <div class="order-1 lg:order-2">
          <span class="text-brand-accent1 font-bold tracking-widest uppercase text-sm mb-4 block">The Universal Standard</span>
          <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-brand-primary tracking-tight leading-[1.1] mb-8">Why Choose<br/>Universal Paints?</h2>
          <p class="text-gray-600 text-lg mb-12 leading-relaxed max-w-xl">
            We don't just sell paint. We engineer advanced protective coatings that elevate aesthetics while ensuring uncompromising durability against the harshest elements.
          </p>
          
          <div class="space-y-6 mb-12">
            <div v-for="feature in features" :key="feature.title" class="flex gap-6 items-start group bg-white p-6 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-gray-50 cursor-pointer">
              <div class="flex-shrink-0 w-14 h-14 rounded-full bg-surface-light flex items-center justify-center group-hover:bg-brand-primary transition-colors duration-300">
                <Icon :name="feature.icon" size="24" class="text-brand-accent1 group-hover:text-white transition-colors duration-300 transform group-hover:scale-110" />
              </div>
              <div>
                <h3 class="font-bold text-xl text-brand-primary mb-2">{{ feature.title }}</h3>
                <p class="text-gray-600 leading-relaxed">{{ feature.desc }}</p>
              </div>
            </div>
          </div>
          
          <button class="bg-brand-primary text-white px-8 py-4 rounded-full font-semibold tracking-wide hover:bg-brand-primary/90 transition-all shadow-lg hover:shadow-xl hover:-translate-y-1">
            Learn About Our Heritage
          </button>
        </div>
        
      </div>
    </div>
  </section>
</template>

<script setup>
const features = [
  { title: 'Premium Raw Materials', desc: 'Sourced globally to ensure maximum pigment density, richer colors, and flawless coverage in every drop.', icon: 'lucide:award' },
  { title: 'Extreme Weather Resistance', desc: 'Advanced cross-linking polymers engineered to completely block UV degradation and prevent water infiltration.', icon: 'lucide:cloud-rain' },
  { title: 'Eco-Conscious Chemistry', desc: 'Industry-leading zero VOC formulations that keep the air safe for your family while protecting the environment.', icon: 'lucide:leaf' },
]
</script>
