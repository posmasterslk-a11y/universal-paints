<template>
  <footer class="bg-white text-gray-800 pt-20 pb-24 md:pb-10 mt-auto border-t border-gray-100 relative">
    <!-- Optional: Subtle top border accent -->
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-brand-primary via-brand-accent1 to-brand-primary"></div>
    
    <div class="container mx-auto px-4">
      <!-- Top Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
        
        <!-- Brand -->
        <div class="space-y-6">
          <img src="/logo.png" alt="Universal Paints Logo" class="h-16 object-contain" />
          <p class="text-gray-600 leading-relaxed text-sm pr-4">
            Engineering premium protective coatings and paints since 2001. We deliver uncompromising quality for residential, commercial, and industrial spaces.
          </p>
          <!-- Socials -->
          <div class="flex gap-4">
             <a href="#" class="w-10 h-10 rounded-full bg-surface-light flex items-center justify-center text-brand-primary hover:bg-brand-primary hover:text-white transition-colors" aria-label="Facebook"><Icon name="lucide:facebook" size="18" /></a>
             <a href="#" class="w-10 h-10 rounded-full bg-surface-light flex items-center justify-center text-brand-primary hover:bg-brand-primary hover:text-white transition-colors" aria-label="Twitter"><Icon name="lucide:twitter" size="18" /></a>
             <a href="#" class="w-10 h-10 rounded-full bg-surface-light flex items-center justify-center text-brand-primary hover:bg-brand-primary hover:text-white transition-colors" aria-label="Instagram"><Icon name="lucide:instagram" size="18" /></a>
             <a href="#" class="w-10 h-10 rounded-full bg-surface-light flex items-center justify-center text-brand-primary hover:bg-brand-primary hover:text-white transition-colors" aria-label="LinkedIn"><Icon name="lucide:linkedin" size="18" /></a>
          </div>
        </div>

        <!-- Quick Links -->
        <div>
          <h4 class="font-bold text-lg text-brand-primary mb-6 border-b border-gray-200 pb-2 inline-block">Company</h4>
          <ul class="space-y-3 text-sm text-gray-600 font-medium">
            <li><NuxtLink to="/about/overview" class="hover:text-brand-accent1 hover:translate-x-1 transition-transform inline-flex items-center gap-2"><Icon name="lucide:chevron-right" size="14" class="text-brand-accent1" /> About Us</NuxtLink></li>
            <li><NuxtLink to="/about/careers" class="hover:text-brand-accent1 hover:translate-x-1 transition-transform inline-flex items-center gap-2"><Icon name="lucide:chevron-right" size="14" class="text-brand-accent1" /> Careers</NuxtLink></li>
            <li><NuxtLink to="/about/news-events" class="hover:text-brand-accent1 hover:translate-x-1 transition-transform inline-flex items-center gap-2"><Icon name="lucide:chevron-right" size="14" class="text-brand-accent1" /> News & Events</NuxtLink></li>
            <li><NuxtLink to="/blog" class="hover:text-brand-accent1 hover:translate-x-1 transition-transform inline-flex items-center gap-2"><Icon name="lucide:chevron-right" size="14" class="text-brand-accent1" /> Paint Blog</NuxtLink></li>
            <li><NuxtLink to="/dealer-locator" class="hover:text-brand-accent1 hover:translate-x-1 transition-transform inline-flex items-center gap-2"><Icon name="lucide:chevron-right" size="14" class="text-brand-accent1" /> Find a Dealer</NuxtLink></li>
          </ul>
        </div>

        <!-- Products -->
        <div>
          <h4 class="font-bold text-lg text-brand-primary mb-6 border-b border-gray-200 pb-2 inline-block">Our Products</h4>
          <ul class="space-y-3 text-sm text-gray-600 font-medium">
            <li><NuxtLink to="/products/interior-paints" class="hover:text-brand-accent1 hover:translate-x-1 transition-transform inline-flex items-center gap-2"><Icon name="lucide:chevron-right" size="14" class="text-brand-accent1" /> Interior Paints</NuxtLink></li>
            <li><NuxtLink to="/products/exterior-paints" class="hover:text-brand-accent1 hover:translate-x-1 transition-transform inline-flex items-center gap-2"><Icon name="lucide:chevron-right" size="14" class="text-brand-accent1" /> Exterior Paints</NuxtLink></li>
            <li><NuxtLink to="/products/primers" class="hover:text-brand-accent1 hover:translate-x-1 transition-transform inline-flex items-center gap-2"><Icon name="lucide:chevron-right" size="14" class="text-brand-accent1" /> Primers & Prep</NuxtLink></li>
            <li><NuxtLink to="/products/wood-coatings" class="hover:text-brand-accent1 hover:translate-x-1 transition-transform inline-flex items-center gap-2"><Icon name="lucide:chevron-right" size="14" class="text-brand-accent1" /> Wood Coatings</NuxtLink></li>
            <li><NuxtLink to="/products/industrial-paints" class="hover:text-brand-accent1 hover:translate-x-1 transition-transform inline-flex items-center gap-2"><Icon name="lucide:chevron-right" size="14" class="text-brand-accent1" /> Industrial Coatings</NuxtLink></li>
          </ul>
        </div>

        <!-- Newsletter & Contact -->
        <div>
          <h4 class="font-bold text-lg text-brand-primary mb-6 border-b border-gray-200 pb-2 inline-block">Stay Updated</h4>
          <p class="text-sm text-gray-600 mb-4">Subscribe to our newsletter for the latest color trends and painting tips.</p>
          <div class="flex mb-6 group">
            <input type="email" placeholder="Email address..." class="bg-surface-light border border-gray-200 rounded-l-lg px-4 py-2 w-full focus:outline-none focus:border-brand-primary focus:ring-2 focus:ring-brand-primary/10 text-sm placeholder-gray-400 transition-colors">
            <button class="bg-brand-primary text-white px-4 rounded-r-lg hover:bg-brand-accent1 transition-colors" aria-label="Subscribe">
              <Icon name="lucide:send" size="16" />
            </button>
          </div>
          <div class="space-y-3 text-sm text-gray-600 font-medium">
            <p class="flex items-start gap-3"><Icon name="lucide:map-pin" size="16" class="text-brand-accent1 flex-shrink-0 mt-0.5" /> 129/1 Galle Road, Pallimulla,<br/>Panadura, Sri Lanka, 12550</p>
            <p class="flex items-center gap-3"><Icon name="lucide:phone" size="16" class="text-brand-accent1 flex-shrink-0" /> +94 11 234 5678</p>
            <p class="flex items-center gap-3"><Icon name="lucide:mail" size="16" class="text-brand-accent1 flex-shrink-0" /> sales@universalpaints.lk</p>
          </div>
        </div>

      </div>

      <!-- Bottom Bar -->
      <div class="border-t border-gray-200 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-gray-500 font-medium pb-4">
        <p>
          &copy; {{ new Date().getFullYear() }} Universal Paints Industries. All Rights Reserved. 
          <span class="mx-2 hidden sm:inline">|</span><br class="sm:hidden" />
          Web By <a href="https://www.codehubsoftware.com/" target="_blank" rel="noopener noreferrer" class="hover:text-brand-primary transition-colors font-bold">Codehub Software</a>
        </p>
        <div class="flex gap-6">
          <NuxtLink to="/privacy" class="hover:text-brand-primary transition-colors">Privacy Policy</NuxtLink>
          <NuxtLink to="/terms" class="hover:text-brand-primary transition-colors">Terms of Service</NuxtLink>
          <NuxtLink to="/disclaimer" class="hover:text-brand-primary transition-colors">Disclaimer</NuxtLink>
          <NuxtLink to="/sitemap" class="hover:text-brand-primary transition-colors">Sitemap</NuxtLink>
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup>
// TheFooter component
</script>
