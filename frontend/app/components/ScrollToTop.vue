<template>
  <Transition name="fade">
    <button
      v-show="isVisible"
      @click="scrollToTop"
      class="fixed bottom-20 md:bottom-8 right-4 md:right-8 z-50 p-3 bg-brand-primary text-white rounded-full shadow-2xl hover:bg-brand-accent1 hover:-translate-y-1 transition-all duration-300 group border-2 border-white/20"
      aria-label="Scroll to top"
    >
      <Icon name="lucide:arrow-up" size="24" class="group-hover:-translate-y-1 transition-transform" />
    </button>
  </Transition>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const isVisible = ref(false)

const handleScroll = () => {
  // Show button after scrolling down 400px
  if (window.scrollY > 400) {
    isVisible.value = true
  } else {
    isVisible.value = false
  }
}

const scrollToTop = () => {
  window.scrollTo({
    top: 0,
    behavior: 'smooth'
  })
}

onMounted(() => {
  window.addEventListener('scroll', handleScroll)
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
})
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease, transform 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: translateY(20px) scale(0.9);
}
</style>
