<template>
  <div class="bg-surface-light min-h-screen">
    <!-- Hero Section -->
    <section class="relative pt-32 pb-24 md:pt-40 md:pb-32 overflow-hidden bg-white">
      <div class="absolute inset-0 opacity-30 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-brand-accent1/20 via-transparent to-transparent"></div>
      
      <div class="container mx-auto px-4 relative z-10 text-center max-w-4xl">
        <span class="text-brand-accent1 font-bold tracking-widest uppercase text-sm mb-4 block">Press Room</span>
        <h1 class="text-5xl md:text-6xl font-bold text-brand-primary tracking-tight leading-[1.1] mb-6">
          News & Events
        </h1>
        <p class="text-gray-600 text-lg md:text-xl leading-relaxed mb-0 mx-auto max-w-2xl">
          Stay up to date with our latest product launches, industry awards, and community events.
        </p>
      </div>
    </section>

    <!-- Content Grid -->
    <section class="py-24">
      <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-3 gap-12">
          
          <!-- Latest News (Takes up 2 columns) -->
          <div class="lg:col-span-2">
            <h2 class="text-3xl font-bold text-brand-primary mb-8 border-b border-gray-200 pb-4">Latest News</h2>
            
            <div class="space-y-8">
              <!-- News Item 1 -->
              <article class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 flex flex-col md:flex-row group hover:shadow-lg transition-shadow cursor-pointer">
                <div class="md:w-1/3 aspect-video md:aspect-auto relative overflow-hidden bg-gray-100">
                  <img src="https://images.unsplash.com/photo-1562259949-e8e7689d7828?q=80&w=600&auto=format&fit=crop" alt="News Image" class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500" />
                </div>
                <div class="p-6 md:w-2/3 flex flex-col justify-center">
                  <div class="flex items-center gap-3 mb-3">
                    <span class="bg-brand-accent1/10 text-brand-accent1 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">Product Launch</span>
                    <span class="text-gray-400 text-sm font-medium">Oct 12, 2026</span>
                  </div>
                  <h3 class="text-xl font-bold text-brand-primary mb-3 group-hover:text-brand-accent1 transition-colors">Introducing EcoShield: The Zero-VOC Revolution</h3>
                  <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-2">Our R&D team has successfully developed a truly zero-VOC paint formula that performs identically to traditional solvent-based coatings...</p>
                  <span class="text-brand-primary font-bold text-sm flex items-center gap-1 group-hover:gap-2 transition-all">Read Story <Icon name="lucide:arrow-right" size="14" /></span>
                </div>
              </article>

              <!-- News Item 2 -->
              <article class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 flex flex-col md:flex-row group hover:shadow-lg transition-shadow cursor-pointer">
                <div class="md:w-1/3 aspect-video md:aspect-auto relative overflow-hidden bg-gray-100">
                  <img src="https://images.unsplash.com/photo-1542621323-22123f8cb2dc?q=80&w=600&auto=format&fit=crop" alt="News Image" class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500" />
                </div>
                <div class="p-6 md:w-2/3 flex flex-col justify-center">
                  <div class="flex items-center gap-3 mb-3">
                    <span class="bg-brand-primary/10 text-brand-primary px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">Awards</span>
                    <span class="text-gray-400 text-sm font-medium">Sep 28, 2026</span>
                  </div>
                  <h3 class="text-xl font-bold text-brand-primary mb-3 group-hover:text-brand-accent1 transition-colors">Universal Paints Wins 'Green Manufacturer of the Year'</h3>
                  <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-2">We are incredibly proud to announce that Universal Paints has been recognized at the National Industry Awards for our sustainability efforts...</p>
                  <span class="text-brand-primary font-bold text-sm flex items-center gap-1 group-hover:gap-2 transition-all">Read Story <Icon name="lucide:arrow-right" size="14" /></span>
                </div>
              </article>
            </div>
            
            <button class="mt-8 px-6 py-3 bg-white border border-gray-200 rounded-full text-brand-primary font-bold hover:bg-surface-light transition-colors shadow-sm">
              Load More News
            </button>
          </div>

          <!-- Upcoming Events (Takes up 1 column) -->
          <div>
            <h2 class="text-3xl font-bold text-brand-primary mb-8 border-b border-gray-200 pb-4">Upcoming Events</h2>
            
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-6">
              
              <!-- Event 1 -->
              <div class="flex gap-4 group cursor-pointer">
                <div class="w-16 h-16 rounded-xl bg-surface-light flex flex-col items-center justify-center text-brand-primary font-bold border border-gray-100 group-hover:bg-brand-primary group-hover:text-white transition-colors flex-shrink-0">
                  <span class="text-xs uppercase text-brand-accent1 group-hover:text-white/80">Nov</span>
                  <span class="text-xl">15</span>
                </div>
                <div>
                  <h4 class="font-bold text-brand-primary mb-1 group-hover:text-brand-accent1 transition-colors">BuildEx Expo 2026</h4>
                  <p class="text-gray-500 text-sm mb-2 flex items-center gap-1"><Icon name="lucide:map-pin" size="12" /> BMICH, Colombo</p>
                  <p class="text-brand-accent1 text-xs font-bold uppercase tracking-wider">Booth #402</p>
                </div>
              </div>

              <div class="h-px bg-gray-100 w-full"></div>

              <!-- Event 2 -->
              <div class="flex gap-4 group cursor-pointer">
                <div class="w-16 h-16 rounded-xl bg-surface-light flex flex-col items-center justify-center text-brand-primary font-bold border border-gray-100 group-hover:bg-brand-primary group-hover:text-white transition-colors flex-shrink-0">
                  <span class="text-xs uppercase text-brand-accent1 group-hover:text-white/80">Dec</span>
                  <span class="text-xl">05</span>
                </div>
                <div>
                  <h4 class="font-bold text-brand-primary mb-1 group-hover:text-brand-accent1 transition-colors">Architectural Design Summit</h4>
                  <p class="text-gray-500 text-sm mb-2 flex items-center gap-1"><Icon name="lucide:map-pin" size="12" /> Shangri-La</p>
                  <p class="text-brand-accent1 text-xs font-bold uppercase tracking-wider">Sponsor</p>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
useHead({
  title: 'News & Events | Universal Paints'
})
</script>
