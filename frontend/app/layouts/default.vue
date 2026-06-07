<template>
  <div class="min-h-screen flex flex-col bg-surface-light">
    <header :class="[
      'sticky top-0 z-50 transition-all duration-500 bg-white border-b border-gray-100',
      isScrolled ? 'py-1 shadow-md' : 'py-2 md:py-3 shadow-sm'
    ]">
      <div class="container mx-auto px-4 flex justify-between items-center relative">
        
        <!-- Left Contact & Navigation -->
        <div class="hidden md:flex flex-1 items-center justify-between pr-8">
          
          <!-- Left side utilities: Search & Language (Fills empty space elegantly) -->
          <div class="flex items-center gap-5 text-gray-600">
            <!-- Search Icon -->
            <button class="hover:text-brand-primary transition-colors" aria-label="Search">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </button>
            
            <!-- Divider -->
            <div class="w-px h-5 bg-gray-300"></div>
            
            <!-- Language Switcher -->
            <button class="flex items-center gap-1 text-sm font-bold hover:text-brand-primary transition-colors">
              EN
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>
          </div>

          <!-- Left Navigation -->
          <nav :class="[
            'flex items-center gap-6 lg:gap-8 font-medium transition-all duration-500',
            isScrolled ? 'text-gray-800 text-sm' : 'text-gray-900 text-base'
          ]">
            <NuxtLink to="/" class="hover:text-brand-accent1 transition-colors">Home</NuxtLink>
            
            <!-- About Us Dropdown -->
            <div class="relative group">
              <NuxtLink to="/about" class="flex items-center gap-1 hover:text-brand-accent1 transition-colors py-4">
                About Us
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:rotate-180 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </NuxtLink>
              <div class="absolute top-full left-0 w-48 bg-white shadow-xl rounded-lg py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top translate-y-2 group-hover:translate-y-0">
                <NuxtLink to="/about/overview" class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-primary/5 hover:text-brand-primary transition-colors">Overview</NuxtLink>
                <NuxtLink to="/about/careers" class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-primary/5 hover:text-brand-primary transition-colors">Careers</NuxtLink>
                <NuxtLink to="/about/news-events" class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-primary/5 hover:text-brand-primary transition-colors">News & Events</NuxtLink>
              </div>
            </div>

            <!-- Products Dropdown -->
            <div class="relative group">
              <NuxtLink to="/products" class="flex items-center gap-1 hover:text-brand-accent1 transition-colors py-4">
                Our Products
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:rotate-180 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </NuxtLink>
              <div class="absolute top-full left-0 w-56 bg-white shadow-xl rounded-lg py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top translate-y-2 group-hover:translate-y-0">
                <NuxtLink to="/products/interior-paints" class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-primary/5 hover:text-brand-primary transition-colors">Interior Paints</NuxtLink>
                <NuxtLink to="/products/exterior-paints" class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-primary/5 hover:text-brand-primary transition-colors">Exterior Paints</NuxtLink>
                <NuxtLink to="/products/primers" class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-primary/5 hover:text-brand-primary transition-colors">Primers</NuxtLink>
                <NuxtLink to="/products/wood-coatings" class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-primary/5 hover:text-brand-primary transition-colors">Wood Coatings</NuxtLink>
                <NuxtLink to="/products/industrial-paints" class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-primary/5 hover:text-brand-primary transition-colors">Industrial Paints</NuxtLink>
                <NuxtLink to="/products/waterproofing" class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-primary/5 hover:text-brand-primary transition-colors">Waterproofing Products</NuxtLink>
              </div>
            </div>
          </nav>
        </div>

        <!-- Center Logo - Animates on Scroll -->
        <div class="flex-shrink-0 flex justify-center z-10 mx-4 transition-all duration-500">
          <NuxtLink to="/" class="flex items-center">
            <img src="/logo.png" alt="Universal Paints Logo" class="object-contain transition-all duration-500" 
                 :class="isScrolled ? 'h-12 md:h-14 drop-shadow-sm' : 'h-16 md:h-20 drop-shadow-lg'" />
          </NuxtLink>
        </div>
        
        <!-- Right Menu Items & CTA -->
        <div class="hidden md:flex flex-1 items-center justify-start gap-8 pl-8 font-medium transition-all duration-500"
             :class="isScrolled ? 'text-gray-800 text-sm' : 'text-gray-900 text-base'">
          <nav class="flex gap-8">
            <NuxtLink to="/blog" class="hover:text-brand-accent2 transition-colors">Blog</NuxtLink>
            <NuxtLink to="/dealer-locator" class="hover:text-brand-accent2 transition-colors">Dealer Locator</NuxtLink>
            <NuxtLink to="/contact" class="hover:text-brand-accent2 transition-colors">Contact Us</NuxtLink>
          </nav>
          
          <button @click="isQuoteModalOpen = true" :class="[
            'bg-brand-primary text-white font-medium hover:bg-brand-primary/90 transition-all shadow-md ml-auto duration-500 rounded-tl-2xl rounded-br-2xl rounded-tr-md rounded-bl-md hover:rounded-tl-md hover:rounded-br-md hover:rounded-tr-2xl hover:rounded-bl-2xl',
            isScrolled ? 'px-5 py-2 text-sm' : 'px-8 py-3 text-base shadow-lg hover:-translate-y-1'
          ]">
            Get a Quote
          </button>
        </div>

        <!-- Mobile Toggle -->
        <div class="md:hidden flex flex-1 justify-end">
          <button @click="isMobileMenuOpen = true" class="text-brand-primary p-2">
            <Icon name="lucide:menu" size="24" />
          </button>
        </div>
        
      </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow">
      <slot />
    </main>

    <!-- Main Footer -->
    <TheFooter />

    <!-- Quote Modal -->
    <QuoteModal :isOpen="isQuoteModalOpen" @close="isQuoteModalOpen = false" />

    <!-- Mobile Bottom Navigation -->
    <div class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 z-50 flex justify-around py-3 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.1)]">
      <NuxtLink to="/" class="flex flex-col items-center text-gray-500 hover:text-brand-primary">
        <Icon name="lucide:home" size="20" />
        <span class="text-[10px] mt-1 font-medium">Home</span>
      </NuxtLink>
      <NuxtLink to="/products" class="flex flex-col items-center text-gray-500 hover:text-brand-primary">
        <Icon name="lucide:package" size="20" />
        <span class="text-[10px] mt-1 font-medium">Products</span>
      </NuxtLink>
      <NuxtLink to="/blog" class="flex flex-col items-center text-gray-500 hover:text-brand-primary">
        <Icon name="lucide:book-open" size="20" />
        <span class="text-[10px] mt-1 font-medium">Blog</span>
      </NuxtLink>
      <NuxtLink to="/contact" class="flex flex-col items-center text-gray-500 hover:text-brand-primary">
        <Icon name="lucide:phone" size="20" />
        <span class="text-[10px] mt-1 font-medium">Contact</span>
      </NuxtLink>
      <button @click="isMobileMenuOpen = true" class="flex flex-col items-center text-gray-500 hover:text-brand-primary">
        <Icon name="lucide:menu" size="20" />
        <span class="text-[10px] mt-1 font-medium">Menu</span>
      </button>
    </div>
    
    <!-- Mobile Menu Drawer (Side Panel) -->
    <Transition name="slide-right">
      <div v-if="isMobileMenuOpen" class="fixed inset-0 z-[100] flex md:hidden">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="isMobileMenuOpen = false"></div>
        
        <!-- Drawer Panel -->
        <div class="drawer-panel relative w-4/5 max-w-sm bg-white h-full flex flex-col shadow-2xl ml-auto overflow-y-auto">
          <div class="p-4 border-b border-gray-100 flex justify-between items-center bg-surface-light">
            <span class="font-bold text-brand-primary text-lg">Menu</span>
            <button @click="isMobileMenuOpen = false" class="p-2 text-gray-500 hover:text-brand-primary bg-white rounded-full shadow-sm">
              <Icon name="lucide:x" size="20" />
            </button>
          </div>
          
          <nav class="flex flex-col p-4 gap-2">
            <NuxtLink to="/" @click="isMobileMenuOpen = false" class="px-4 py-3 rounded-lg text-gray-800 hover:bg-brand-primary/5 hover:text-brand-primary font-medium transition-colors">Home</NuxtLink>
            
            <div class="border-t border-gray-100 my-2"></div>
            <span class="px-4 text-xs font-bold text-gray-400 uppercase tracking-wider mb-1 mt-2">About Us</span>
            <NuxtLink to="/about/overview" @click="isMobileMenuOpen = false" class="px-4 py-2 rounded-lg text-gray-600 hover:bg-brand-primary/5 hover:text-brand-primary transition-colors text-sm">Overview</NuxtLink>
            <NuxtLink to="/about/careers" @click="isMobileMenuOpen = false" class="px-4 py-2 rounded-lg text-gray-600 hover:bg-brand-primary/5 hover:text-brand-primary transition-colors text-sm">Careers</NuxtLink>
            <NuxtLink to="/about/news-events" @click="isMobileMenuOpen = false" class="px-4 py-2 rounded-lg text-gray-600 hover:bg-brand-primary/5 hover:text-brand-primary transition-colors text-sm">News & Events</NuxtLink>
            
            <div class="border-t border-gray-100 my-2"></div>
            <span class="px-4 text-xs font-bold text-gray-400 uppercase tracking-wider mb-1 mt-2">Our Products</span>
            <NuxtLink to="/products/interior-paints" @click="isMobileMenuOpen = false" class="px-4 py-2 rounded-lg text-gray-600 hover:bg-brand-primary/5 hover:text-brand-primary transition-colors text-sm">Interior Paints</NuxtLink>
            <NuxtLink to="/products/exterior-paints" @click="isMobileMenuOpen = false" class="px-4 py-2 rounded-lg text-gray-600 hover:bg-brand-primary/5 hover:text-brand-primary transition-colors text-sm">Exterior Paints</NuxtLink>
            <NuxtLink to="/products/primers" @click="isMobileMenuOpen = false" class="px-4 py-2 rounded-lg text-gray-600 hover:bg-brand-primary/5 hover:text-brand-primary transition-colors text-sm">Primers</NuxtLink>
            <NuxtLink to="/products/wood-coatings" @click="isMobileMenuOpen = false" class="px-4 py-2 rounded-lg text-gray-600 hover:bg-brand-primary/5 hover:text-brand-primary transition-colors text-sm">Wood Coatings</NuxtLink>
            <NuxtLink to="/products/industrial-paints" @click="isMobileMenuOpen = false" class="px-4 py-2 rounded-lg text-gray-600 hover:bg-brand-primary/5 hover:text-brand-primary transition-colors text-sm">Industrial Paints</NuxtLink>
            <NuxtLink to="/products/waterproofing" @click="isMobileMenuOpen = false" class="px-4 py-2 rounded-lg text-gray-600 hover:bg-brand-primary/5 hover:text-brand-primary transition-colors text-sm">Waterproofing</NuxtLink>
            
            <div class="border-t border-gray-100 my-2"></div>
            <NuxtLink to="/dealer-locator" @click="isMobileMenuOpen = false" class="px-4 py-3 rounded-lg text-gray-800 hover:bg-brand-primary/5 hover:text-brand-primary font-medium transition-colors">Dealer Locator</NuxtLink>
          </nav>
          
          <div class="mt-auto p-6 bg-surface-light border-t border-gray-100">
            <button @click="isQuoteModalOpen = true; isMobileMenuOpen = false" class="w-full bg-brand-primary text-white font-bold py-3 rounded-xl shadow-lg hover:bg-brand-primary/90 transition-colors">
              Get a Free Quote
            </button>
          </div>
        </div>
      </div>
    </Transition>
    
    <!-- Scroll to Top Button -->
    <ScrollToTop />
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const isScrolled = ref(false)
const isQuoteModalOpen = ref(false)
const isMobileMenuOpen = ref(false)

const handleScroll = () => {
  isScrolled.value = window.scrollY > 50
}

onMounted(() => {
  window.addEventListener('scroll', handleScroll)
  // Check initial scroll position
  handleScroll()
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
})
</script>

<style scoped>
.slide-right-enter-active,
.slide-right-leave-active {
  transition: opacity 0.3s ease;
}

.slide-right-enter-active .drawer-panel,
.slide-right-leave-active .drawer-panel {
  transition: transform 0.3s ease-out;
}

.slide-right-enter-from,
.slide-right-leave-to {
  opacity: 0;
}

.slide-right-enter-from .drawer-panel,
.slide-right-leave-to .drawer-panel {
  transform: translateX(100%);
}
</style>
