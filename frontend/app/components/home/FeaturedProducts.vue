<template>
  <section class="pb-24 pt-4 md:pt-8 bg-surface-light relative">
    <div class="container mx-auto px-4">
      
      <!-- Premium Section Header (Centered) -->
      <div class="text-center max-w-3xl mx-auto mb-16">
        <span class="text-brand-accent1 font-bold tracking-widest uppercase text-sm mb-3 block">Our Expertise</span>
        <h2 class="text-4xl md:text-5xl font-bold text-brand-primary tracking-tight leading-tight mb-6">Premium Formulations for Every Surface</h2>
        <p class="text-gray-600 text-lg">
          Discover our range of industry-leading products designed for maximum durability, vibrant finishes, and eco-friendly application.
        </p>
      </div>

      <!-- Modern Overlay Cards Grid -->
      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div v-for="category in categories" :key="category.name" 
             class="group relative h-[400px] rounded-2xl overflow-hidden cursor-pointer shadow-md hover:shadow-2xl transition-all duration-500">
          
          <!-- Background Image with Hover Scale -->
          <img :src="category.image" :alt="category.name" class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 ease-in-out" />
          
          <!-- Dark Gradient Overlay -->
          <div class="absolute inset-0 bg-gradient-to-t from-brand-primary/95 via-brand-primary/40 to-transparent opacity-80 group-hover:opacity-90 transition-opacity duration-300"></div>
          
          <!-- Card Content -->
          <div class="absolute inset-x-0 bottom-0 p-8 flex flex-col justify-end h-full">
            <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
              <h3 class="text-2xl font-bold text-white mb-2">{{ category.name }}</h3>
              <p class="text-white/80 text-sm mb-6 opacity-0 group-hover:opacity-100 transition-opacity duration-300 delay-100">
                {{ category.desc }}
              </p>
              
              <!-- Custom Arrow Button -->
              <NuxtLink to="/products" class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-white text-brand-primary group-hover:bg-brand-accent1 group-hover:text-white transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
              </NuxtLink>
            </div>
          </div>
          
        </div>
      </div>
      
    </div>
  </section>
</template>

<script setup>
const categories = [
  { 
    name: 'Interior Paints', 
    desc: 'Washable, zero VOC finishes for a beautiful and safe living space. Perfect for any room.', 
    image: 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?q=80&w=800&auto=format&fit=crop'
  },
  { 
    name: 'Exterior Paints', 
    desc: 'Weather-resistant formulas built to withstand extreme climates and protect your home.', 
    image: 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?q=80&w=800&auto=format&fit=crop'
  },
  { 
    name: 'Primers & Prep', 
    desc: 'The perfect foundation for long-lasting, flawless topcoats on any challenging surface.', 
    image: 'https://images.unsplash.com/photo-1589939705384-5185137a7f0f?q=80&w=800&auto=format&fit=crop'
  },
  { 
    name: 'Industrial', 
    desc: 'Heavy-duty, anti-corrosive protection engineered for commercial and industrial structures.', 
    image: 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=800&auto=format&fit=crop'
  },
]
</script>
