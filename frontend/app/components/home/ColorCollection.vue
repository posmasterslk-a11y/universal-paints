<template>
  <section class="py-24 bg-white relative overflow-hidden">
    <!-- Decorative Color Splashes in Background -->
    <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-brand-accent2/5 rounded-full blur-[100px] pointer-events-none transform -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-brand-accent1/5 rounded-full blur-[120px] pointer-events-none transform translate-x-1/3 translate-y-1/3"></div>

    <div class="container mx-auto px-4 relative z-10 text-center">
      <span class="text-brand-accent1 font-bold tracking-widest uppercase text-sm mb-3 block">Color Palette</span>
      <h2 class="text-4xl md:text-5xl font-bold text-brand-primary tracking-tight mb-4">Discover Your Perfect Shade</h2>
      <p class="text-gray-600 max-w-2xl mx-auto mb-12 text-lg">Explore our extensive palette of rich, vibrant colors inspired by nature and modern trends. Hover over any color to preview.</p>
      
      <!-- Search and Filter -->
      <div class="max-w-md mx-auto mb-16 relative group">
        <Icon name="lucide:search" class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-brand-primary transition-colors" size="20" />
        <input type="text" placeholder="Search color name or code..." class="w-full pl-12 pr-4 py-4 rounded-full border border-gray-200 bg-white shadow-sm focus:outline-none focus:border-brand-primary focus:ring-4 focus:ring-brand-primary/10 transition-all text-gray-800 placeholder-gray-400 font-medium">
      </div>

      <!-- Animated Paint Chip Grid -->
      <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
        <div v-for="color in colors" :key="color.hex" class="group relative cursor-pointer transform hover:-translate-y-3 transition-all duration-500 bg-white p-3 rounded-2xl shadow-sm hover:shadow-2xl border border-gray-100">
          
          <!-- Color Block -->
          <div class="h-32 rounded-xl w-full mb-4 shadow-inner relative overflow-hidden" :style="{ backgroundColor: color.hex }">
             <!-- Hover Preview Overlay -->
             <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                <span class="bg-white text-gray-900 text-xs font-bold px-3 py-1.5 rounded-full shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Preview</span>
             </div>
          </div>
          
          <!-- Text -->
          <div class="text-left px-1">
            <p class="text-sm font-bold text-gray-900 truncate" :title="color.name">{{ color.name }}</p>
            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mt-1">{{ color.hex }}</p>
          </div>
        </div>
      </div>
      
      <!-- Action Button -->
      <div class="mt-16">
         <button class="inline-flex items-center gap-2 bg-white border-2 border-brand-primary text-brand-primary font-bold px-8 py-4 rounded-full hover:bg-brand-primary hover:text-white transition-all duration-300 shadow-md hover:shadow-xl hover:-translate-y-1">
           Explore Full Catalog
           <Icon name="lucide:arrow-right" size="18" />
         </button>
      </div>
    </div>
  </section>
</template>

<script setup>
const colors = [
  { name: 'Ocean Depths', hex: '#02033F' },
  { name: 'Sunset Glow', hex: '#FF8F00' },
  { name: 'Azure Sky', hex: '#1E88E5' },
  { name: 'Forest Whisper', hex: '#4CAF50' },
  { name: 'Aqua Spark', hex: '#26C6DA' },
  { name: 'Crimson Rose', hex: '#E53935' },
  { name: 'Desert Sand', hex: '#F4A460' },
  { name: 'Royal Plum', hex: '#8E24AA' },
  { name: 'Slate Gray', hex: '#607D8B' },
  { name: 'Golden Honey', hex: '#FFC107' },
  { name: 'Mint Fresh', hex: '#98FB98' },
  { name: 'Midnight Coal', hex: '#212121' },
]
</script>
