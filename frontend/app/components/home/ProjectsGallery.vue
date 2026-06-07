<template>
  <section class="py-24 bg-surface-light relative overflow-hidden">
    <div class="container mx-auto px-4">
      
      <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-8">
        <div class="max-w-2xl">
          <span class="text-brand-accent1 font-bold tracking-widest uppercase text-sm mb-3 block">Portfolio</span>
          <h2 class="text-4xl md:text-5xl font-bold text-brand-primary tracking-tight leading-tight">Our Masterpieces</h2>
          <p class="text-gray-600 mt-4 text-lg">See how Universal Paints brings spaces to life across residential, commercial, and industrial projects with flawless finishes.</p>
        </div>
        
        <!-- Premium Filter Tabs -->
        <div class="flex flex-wrap gap-2 md:gap-4 p-1.5 bg-white rounded-full shadow-sm border border-gray-100">
          <button class="text-sm font-bold px-6 py-2.5 rounded-full bg-brand-primary text-white shadow-md transition-all">All</button>
          <button class="text-sm font-bold px-6 py-2.5 rounded-full text-gray-500 hover:text-brand-primary hover:bg-gray-50 transition-all">Residential</button>
          <button class="text-sm font-bold px-6 py-2.5 rounded-full text-gray-500 hover:text-brand-primary hover:bg-gray-50 transition-all">Commercial</button>
        </div>
      </div>

      <!-- Elegant Tall Grid -->
      <div class="grid md:grid-cols-3 gap-6 lg:gap-8">
        <div v-for="(project, index) in projects" :key="index" 
             class="group relative rounded-2xl overflow-hidden aspect-[3/4] md:aspect-[4/5] cursor-pointer shadow-lg hover:shadow-2xl transition-all duration-500">
          
          <!-- Image -->
          <img :src="project.image" :alt="project.title" class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-1000 ease-in-out" />
          
          <!-- Gradient Overlay -->
          <div class="absolute inset-0 bg-gradient-to-t from-brand-primary/90 via-brand-primary/20 to-transparent opacity-80 group-hover:opacity-95 transition-opacity duration-500"></div>
          
          <!-- Content -->
          <div class="absolute inset-x-0 bottom-0 p-8 z-20 flex flex-col justify-end h-full">
            <div class="transform translate-y-6 group-hover:translate-y-0 transition-transform duration-500">
              <span class="inline-block px-3 py-1 bg-white/20 backdrop-blur-md text-white text-xs font-bold uppercase tracking-wider rounded-full mb-4 border border-white/30">
                {{ project.category }}
              </span>
              <h3 class="text-2xl font-bold text-white mb-2 leading-tight">{{ project.title }}</h3>
              
              <div class="overflow-hidden">
                <p class="text-white/80 text-sm opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-y-4 group-hover:translate-y-0 delay-100 line-clamp-2">
                  {{ project.desc }}
                </p>
              </div>
            </div>
            
            <!-- View Project Icon -->
            <div class="absolute top-8 right-8 w-12 h-12 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transform scale-50 group-hover:scale-100 transition-all duration-500 border border-white/30">
               <Icon name="lucide:arrow-up-right" class="text-white" size="20" />
            </div>
          </div>
          
        </div>
      </div>
      
      <div class="mt-16 text-center">
        <button class="inline-flex items-center gap-2 text-brand-primary font-bold border-b-2 border-brand-primary pb-1 hover:text-brand-accent1 hover:border-brand-accent1 transition-all">
          View Entire Portfolio
          <Icon name="lucide:arrow-right" size="16" />
        </button>
      </div>

    </div>
  </section>
</template>

<script setup>
const projects = [
  {
    title: 'The Modern Minimalist Mansion',
    category: 'Residential',
    desc: 'Coated entirely in our ultra-matte pure white formula for a stunning, glare-free flawless finish.',
    image: 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?q=80&w=800&auto=format&fit=crop'
  },
  {
    title: 'Aura Luxury Hotel & Spa',
    category: 'Commercial',
    desc: 'Protected with WeatherShield Pro for intense UV protection and waterproof sealing against coastal weather.',
    image: 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=800&auto=format&fit=crop'
  },
  {
    title: 'Velocity Tech Headquarters',
    category: 'Industrial',
    desc: 'Industrial-grade epoxy flooring and anti-corrosive structural beam coatings for lasting endurance.',
    image: 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?q=80&w=800&auto=format&fit=crop'
  }
]
</script>
