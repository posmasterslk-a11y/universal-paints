<template>
  <section class="py-24 bg-surface-light overflow-hidden">
    <div class="container mx-auto px-4 max-w-7xl">
      <div class="text-center max-w-3xl mx-auto mb-16">
        <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-6">Time for a Makeover</h2>
        <p class="text-lg text-gray-600">Beautiful Walls, Better Living. Drag the slider below to see the Universal Paints difference instantly with our Superlux Interior Emulsion.</p>
      </div>
    </div> <!-- Close top container -->

    <!-- Before & After Interactive Slider (Full Width) -->
    <div class="relative w-full h-[400px] md:h-[70vh] min-h-[500px] overflow-hidden shadow-2xl cursor-ew-resize group"
           @mousemove="handleDrag" 
           @touchmove="handleDrag"
           @mousedown="isDragging = true"
           @mouseup="isDragging = false"
           @mouseleave="isDragging = false"
           @touchstart="isDragging = true"
           @touchend="isDragging = false">
        
        <!-- After Image (Bottom Layer) -->
        <div class="absolute inset-0 w-full h-full">
          <img src="https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?q=80&w=2000&auto=format&fit=crop" alt="Beautiful painted room" class="w-full h-full object-cover" draggable="false">
          <div class="absolute top-6 right-6 bg-brand-accent1 text-brand-primary font-bold px-5 py-2.5 rounded-full shadow-lg text-sm z-10 tracking-widest uppercase">After</div>
        </div>

        <!-- Before Image (Top Layer, clipped by Vue state) -->
        <div class="absolute inset-0 w-full h-full border-r-4 border-white select-none" :style="{ clipPath: `polygon(0 0, ${sliderPosition}% 0, ${sliderPosition}% 100%, 0 100%)` }">
          <!-- We use the same image but apply CSS filters to make it look old, unpainted, and gloomy -->
          <img src="https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?q=80&w=2000&auto=format&fit=crop" alt="Old unpainted room" class="w-full h-full object-cover filter grayscale contrast-125 brightness-75 sepia-[.40]" draggable="false">
          
          <!-- Grunge overlay to simulate dampness/peeling -->
          <div class="absolute inset-0 opacity-40 mix-blend-multiply bg-[url('https://www.transparenttextures.com/patterns/concrete-wall.png')] pointer-events-none"></div>

          <div class="absolute top-6 left-6 bg-gray-900/90 backdrop-blur-sm text-white font-bold px-5 py-2.5 rounded-full shadow-lg text-sm z-10 tracking-widest uppercase border border-white/10">Before</div>
        </div>

        <!-- Slider Handle -->
        <div class="absolute top-0 bottom-0 w-1 bg-white cursor-ew-resize shadow-[0_0_15px_rgba(0,0,0,0.5)]" :style="{ left: `${sliderPosition}%` }">
          <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-14 h-14 bg-white rounded-full shadow-[0_10px_25px_rgba(0,0,0,0.2)] flex items-center justify-center text-brand-primary group-hover:scale-110 group-hover:shadow-[0_10px_35px_rgba(0,0,0,0.3)] transition-all duration-300 pointer-events-none border-2 border-gray-100">
            <Icon name="lucide:chevrons-left-right" size="28" />
          </div>
        </div>
      </div>

    <!-- Re-open container for features below -->
    <div class="container mx-auto px-4 max-w-7xl">
      <!-- Feature Badges Below (Inspired by the poster icons) -->
      <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-5xl mx-auto mt-12">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center text-center hover:-translate-y-1 transition-transform cursor-default">
          <div class="w-14 h-14 rounded-full bg-brand-primary/5 text-brand-primary flex items-center justify-center mb-4">
            <Icon name="lucide:shield-check" size="28" />
          </div>
          <h4 class="font-bold text-gray-900 text-sm md:text-base mb-1">Long-Lasting</h4>
          <p class="text-xs text-gray-500">Protects from dampness</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center text-center hover:-translate-y-1 transition-transform cursor-default">
          <div class="w-14 h-14 rounded-full bg-brand-primary/5 text-brand-primary flex items-center justify-center mb-4">
            <Icon name="lucide:palette" size="28" />
          </div>
          <h4 class="font-bold text-gray-900 text-sm md:text-base mb-1">Perfect Colours</h4>
          <p class="text-xs text-gray-500">Rich & vibrant shades</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center text-center hover:-translate-y-1 transition-transform cursor-default">
          <div class="w-14 h-14 rounded-full bg-brand-primary/5 text-brand-primary flex items-center justify-center mb-4">
            <Icon name="lucide:sparkles" size="28" />
          </div>
          <h4 class="font-bold text-gray-900 text-sm md:text-base mb-1">Easy to Clean</h4>
          <p class="text-xs text-gray-500">Wipe clean surfaces</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center text-center hover:-translate-y-1 transition-transform cursor-default">
          <div class="w-14 h-14 rounded-full bg-brand-primary/5 text-brand-primary flex items-center justify-center mb-4">
            <Icon name="lucide:leaf" size="28" />
          </div>
          <h4 class="font-bold text-gray-900 text-sm md:text-base mb-1">Low VOC</h4>
          <p class="text-xs text-gray-500">Better for environment</p>
        </div>
      </div>

    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue'

const sliderPosition = ref(50)
const isDragging = ref(false)

const handleDrag = (e) => {
  if (!isDragging.value && e.type !== 'touchmove') return
  
  const container = e.currentTarget
  const rect = container.getBoundingClientRect()
  
  let clientX = e.clientX
  if (e.type === 'touchmove') {
    clientX = e.touches[0].clientX
  }
  
  const x = Math.max(0, Math.min(clientX - rect.left, rect.width))
  sliderPosition.value = (x / rect.width) * 100
}
</script>
