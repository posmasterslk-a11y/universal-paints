<template>
  <div class="bg-surface-light min-h-screen pt-32 md:pt-40 pb-24">
    <div class="container mx-auto px-4 max-w-4xl">
      <div class="bg-white rounded-[2rem] shadow-xl border border-gray-100 p-10 md:p-16">
        
        <div class="mb-12 border-b border-gray-100 pb-8 text-center">
          <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Sitemap</h1>
          <p class="text-gray-500">Navigate the Universal Paints website.</p>
        </div>

        <div class="grid md:grid-cols-2 gap-12 text-gray-600">
          
          <!-- Column 1 -->
          <div class="space-y-10">
            <!-- Main -->
            <div>
              <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <Icon name="lucide:home" class="text-brand-accent1" /> Main
              </h2>
              <ul class="space-y-3 pl-8 border-l-2 border-gray-100 ml-3">
                <li><NuxtLink to="/" class="hover:text-brand-primary transition-colors">Home</NuxtLink></li>
                <li><NuxtLink to="/contact" class="hover:text-brand-primary transition-colors">Contact Us</NuxtLink></li>
                <li><NuxtLink to="/blog" class="hover:text-brand-primary transition-colors">Blog</NuxtLink></li>
                <li><NuxtLink to="/dealer-locator" class="hover:text-brand-primary transition-colors">Dealer Locator</NuxtLink></li>
              </ul>
            </div>

            <!-- About Us -->
            <div>
              <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <Icon name="lucide:info" class="text-brand-accent1" /> About Us
              </h2>
              <ul class="space-y-3 pl-8 border-l-2 border-gray-100 ml-3">
                <li><NuxtLink to="/about/overview" class="hover:text-brand-primary transition-colors">Overview</NuxtLink></li>
                <li><NuxtLink to="/about/careers" class="hover:text-brand-primary transition-colors">Careers</NuxtLink></li>
                <li><NuxtLink to="/about/news-events" class="hover:text-brand-primary transition-colors">News & Events</NuxtLink></li>
              </ul>
            </div>
          </div>

          <!-- Column 2 -->
          <div class="space-y-10">
            <!-- Products -->
            <div>
              <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <Icon name="lucide:package" class="text-brand-accent1" /> Products
              </h2>
              <ul class="space-y-3 pl-8 border-l-2 border-gray-100 ml-3">
                <li><NuxtLink to="/products/interior-paints" class="hover:text-brand-primary transition-colors">Interior Paints</NuxtLink></li>
                <li><NuxtLink to="/products/exterior-paints" class="hover:text-brand-primary transition-colors">Exterior Paints</NuxtLink></li>
                <li><NuxtLink to="/products/primers" class="hover:text-brand-primary transition-colors">Primers & Undercoats</NuxtLink></li>
                <li><NuxtLink to="/products/waterproofing" class="hover:text-brand-primary transition-colors">Waterproofing</NuxtLink></li>
                <li><NuxtLink to="/products/wood-coatings" class="hover:text-brand-primary transition-colors">Wood Coatings</NuxtLink></li>
                <li><NuxtLink to="/products/industrial-paints" class="hover:text-brand-primary transition-colors">Industrial Paints</NuxtLink></li>
              </ul>
            </div>

            <!-- Legal -->
            <div>
              <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <Icon name="lucide:scale" class="text-brand-accent1" /> Legal
              </h2>
              <ul class="space-y-3 pl-8 border-l-2 border-gray-100 ml-3">
                <li><NuxtLink to="/privacy" class="hover:text-brand-primary transition-colors">Privacy Policy</NuxtLink></li>
                <li><NuxtLink to="/terms" class="hover:text-brand-primary transition-colors">Terms & Conditions</NuxtLink></li>
                <li><NuxtLink to="/disclaimer" class="hover:text-brand-primary transition-colors">Disclaimer</NuxtLink></li>
              </ul>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
</template>

<script setup>
useHead({
  title: 'Sitemap | Universal Paints'
})
</script>
