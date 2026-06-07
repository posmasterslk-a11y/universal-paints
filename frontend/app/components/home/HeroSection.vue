<template>
  <section class="h-[70vh] relative flex items-center justify-center overflow-hidden">
    
    <!-- Full Width Background Image Slider -->
    <div class="absolute inset-0 z-0 bg-black">
      <TransitionGroup name="hero-bg" mode="out-in">
        <div v-for="(slide, index) in slides" :key="'bg'+index" v-show="activeSlide === index" class="absolute inset-0">
          <img :src="slide.image" :alt="slide.title" class="w-full h-full object-cover transform scale-105" />
          <!-- Neutral dark overlay for clean text contrast without color tinting the photo -->
          <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/40 to-transparent"></div>
        </div>
      </TransitionGroup>
    </div>

    <!-- Foreground Content -->
    <div class="container mx-auto px-4 z-10 pt-8">
      <div class="max-w-3xl">
        <TransitionGroup name="fade" mode="out-in">
          <div v-for="(slide, index) in slides" :key="'text'+index" v-show="activeSlide === index" class="absolute inset-y-0 left-0 flex flex-col justify-center px-4 md:px-8 w-full max-w-4xl">
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold leading-[1.1] tracking-tight mb-6 text-white" v-html="slide.title"></h1>
            <p class="text-lg md:text-xl text-white/90 mb-10 max-w-2xl leading-relaxed font-light">
              {{ slide.desc }}
            </p>
            <div class="flex flex-wrap gap-4">
              <button class="bg-brand-primary text-white px-8 py-4 rounded-full font-semibold tracking-wide hover:bg-brand-primary/90 transition-all shadow-lg hover:shadow-xl hover:-translate-y-1">
                Explore Products
              </button>
              <button class="bg-white text-brand-primary px-8 py-4 rounded-full font-semibold tracking-wide hover:bg-gray-50 transition-all shadow-md hover:shadow-lg hover:-translate-y-1">
                Contact Us
              </button>
            </div>
          </div>
        </TransitionGroup>
      </div>
      
      <!-- Slider Dots -->
      <div class="absolute bottom-12 left-4 md:left-8 flex gap-3 z-20">
        <button v-for="(slide, index) in slides" :key="'dot'+index" @click="activeSlide = index" 
          class="w-2.5 h-2.5 rounded-full transition-all duration-500 shadow-sm"
          :class="activeSlide === index ? 'bg-white w-8' : 'bg-white/40 hover:bg-white/70'">
        </button>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const activeSlide = ref(0)
let slideInterval = null

const slides = [
  {
    title: 'Color Your World <br/> with Confidence',
    desc: 'Premium paint solutions designed to protect, beautify, and transform every space. Engineered for excellence, inspired by you.',
    image: 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?q=80&w=1920&auto=format&fit=crop'
  },
  {
    title: 'Uncompromising <br/> Durability',
    desc: 'Industrial-grade coatings built to withstand the harshest elements. Long-lasting protection for commercial and residential properties.',
    image: 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=1920&auto=format&fit=crop' 
  },
  {
    title: 'Eco-Friendly <br/> Formulations',
    desc: 'Low-VOC paints that are tough on surfaces but gentle on the planet and safe for your family.',
    image: 'https://images.unsplash.com/photo-1562663474-6cbb3eaa4d14?q=80&w=1920&auto=format&fit=crop'
  }
]

onMounted(() => {
  slideInterval = setInterval(() => {
    activeSlide.value = (activeSlide.value + 1) % slides.length
  }, 6000)
})

onUnmounted(() => {
  clearInterval(slideInterval)
})
</script>

<style scoped>
.hero-bg-enter-active,
.hero-bg-leave-active {
  transition: opacity 1.5s ease-in-out;
}
.hero-bg-enter-from,
.hero-bg-leave-to {
  opacity: 0;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.8s ease, transform 0.8s ease;
  transition-delay: 0.3s;
}
.fade-enter-from {
  opacity: 0;
  transform: translateY(30px);
}
.fade-leave-to {
  opacity: 0;
  transform: translateY(-30px);
  transition-delay: 0s;
}

img {
  animation: slowZoom 20s infinite alternate linear;
}

@keyframes slowZoom {
  0% { transform: scale(1.05); }
  100% { transform: scale(1.15); }
}
</style>
