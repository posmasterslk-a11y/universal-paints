<template>
  <section class="py-24 bg-brand-primary relative overflow-hidden text-white">
    <!-- Background Elements -->
    <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1534447677768-be436bb09401?q=80&w=2000&auto=format&fit=crop')] opacity-10 bg-cover bg-center mix-blend-overlay"></div>
    <div class="absolute -top-40 -right-40 w-96 h-96 bg-brand-accent1/20 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-blue-400/20 rounded-full blur-3xl"></div>

    <div class="container mx-auto px-4 max-w-7xl relative z-10">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        
        <!-- Left Text Content -->
        <div>
          <span class="inline-block px-4 py-1.5 bg-white/10 text-brand-accent1 text-sm font-bold uppercase tracking-widest rounded-full mb-6 backdrop-blur-md border border-white/20 shadow-sm">All-Weather Protection</span>
          <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight text-white">For Homes That Shine,<br>Every Time.</h2>
          <p class="text-white/80 text-lg mb-10 leading-relaxed max-w-lg">Universal Superlux Weather Proof emulsion acts like an invisible shield around your home. From scorching sun to heavy monsoon rains, our advanced formula provides unbreakable protection.</p>
          
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
            <div class="flex items-start gap-4 group">
              <div class="w-14 h-14 rounded-xl bg-white/10 flex items-center justify-center shrink-0 border border-white/10 group-hover:bg-brand-accent1 group-hover:text-brand-primary group-hover:border-brand-accent1 transition-colors duration-300 text-brand-accent1 shadow-lg">
                <Icon name="lucide:thermometer-sun" size="26" />
              </div>
              <div>
                <h4 class="font-bold mb-1 text-lg text-white">Reduces Temperature</h4>
                <p class="text-sm text-white/70">Surface temperature drops up to 24°C</p>
              </div>
            </div>
            
            <div class="flex items-start gap-4 group">
              <div class="w-14 h-14 rounded-xl bg-white/10 flex items-center justify-center shrink-0 border border-white/10 group-hover:bg-brand-accent1 group-hover:text-brand-primary group-hover:border-brand-accent1 transition-colors duration-300 text-brand-accent1 shadow-lg">
                <Icon name="lucide:droplets" size="26" />
              </div>
              <div>
                <h4 class="font-bold mb-1 text-lg text-white">Waterproof</h4>
                <p class="text-sm text-white/70">100% water and moisture resistant</p>
              </div>
            </div>

            <div class="flex items-start gap-4 group">
              <div class="w-14 h-14 rounded-xl bg-white/10 flex items-center justify-center shrink-0 border border-white/10 group-hover:bg-brand-accent1 group-hover:text-brand-primary group-hover:border-brand-accent1 transition-colors duration-300 text-brand-accent1 shadow-lg">
                <Icon name="lucide:sun" size="26" />
              </div>
              <div>
                <h4 class="font-bold mb-1 text-lg text-white">Sunproof</h4>
                <p class="text-sm text-white/70">Anti-fade UV protection</p>
              </div>
            </div>

            <div class="flex items-start gap-4 group">
              <div class="w-14 h-14 rounded-xl bg-white/10 flex items-center justify-center shrink-0 border border-white/10 group-hover:bg-brand-accent1 group-hover:text-brand-primary group-hover:border-brand-accent1 transition-colors duration-300 text-brand-accent1 shadow-lg">
                <Icon name="lucide:shield" size="26" />
              </div>
              <div>
                <h4 class="font-bold mb-1 text-lg text-white">Long-Lasting</h4>
                <p class="text-sm text-white/70">Up to 15 years of solid protection</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Right Visual (Shield Concept) -->
        <div class="relative flex justify-center lg:justify-end mt-10 lg:mt-0">
          <div class="relative w-full max-w-[450px] aspect-square rounded-full border border-white/20 bg-gradient-to-tr from-white/5 to-transparent flex items-center justify-center p-8 shadow-[inset_0_0_100px_rgba(255,255,255,0.05)] backdrop-blur-sm">
            <!-- House image inside -->
            <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover rounded-full shadow-[0_20px_50px_rgba(0,0,0,0.5)] border-4 border-white/10" alt="Protected House">
            
            <!-- Shield Graphic Overlay -->
            <div class="absolute inset-0 rounded-full border-[6px] border-white/20 shadow-[0_0_80px_rgba(255,255,255,0.15)]"></div>
            
            <!-- Floating Shield Icon -->
            <div class="absolute -top-4 -right-4 md:-top-6 md:-right-6 w-24 h-24 bg-white rounded-full shadow-2xl flex items-center justify-center border-4 border-brand-accent1 animate-bounce-slow z-20">
              <Icon name="lucide:shield-check" size="44" class="text-brand-primary" />
            </div>
            
            <!-- Decorative Dots -->
            <div class="absolute top-1/4 -left-4 w-6 h-6 bg-brand-accent1 rounded-full shadow-[0_0_15px_rgba(255,165,0,0.8)] animate-pulse"></div>
            <div class="absolute bottom-1/4 -right-2 w-4 h-4 bg-blue-400 rounded-full shadow-[0_0_15px_rgba(96,165,250,0.8)] animate-pulse" style="animation-delay: 1s;"></div>
          </div>
        </div>

      </div>
    </div>
  </section>
</template>

<style scoped>
.animate-bounce-slow {
  animation: bounce 4s infinite;
}
@keyframes bounce {
  0%, 100% {
    transform: translateY(-8%);
    animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
  }
  50% {
    transform: translateY(0);
    animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
  }
}
</style>
