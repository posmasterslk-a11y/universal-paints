<template>
  <section class="py-24 bg-surface-light overflow-hidden">
    <div class="container mx-auto px-4 max-w-7xl">
      
      <!-- Contained Card with Storm Background -->
      <div class="bg-gray-900 rounded-[2.5rem] p-8 md:p-12 lg:p-16 relative overflow-visible shadow-[0_20px_50px_rgba(0,0,0,0.2)]">
        
        <!-- Storm Background inside the card -->
        <div class="absolute inset-0 z-0 rounded-[2.5rem] overflow-hidden">
          <img src="https://images.unsplash.com/photo-1505533321630-975218a5f66f?q=80&w=2000&auto=format&fit=crop" alt="Storm Background" class="w-full h-full object-cover opacity-40 mix-blend-luminosity">
          <div class="absolute inset-0 bg-gradient-to-r from-gray-900 via-gray-900/90 to-blue-900/40"></div>
        </div>

        <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
          
          <!-- Left: Text & Icons -->
          <div class="text-white col-span-1 lg:col-span-5">
            <div class="mb-8">
              <div class="inline-block bg-white/10 backdrop-blur-md p-3 rounded-2xl border border-white/10 mb-4 shadow-lg">
                <img src="/logo.png" alt="Universal Paints Logo" class="h-12 md:h-16 object-contain drop-shadow-md" />
              </div>
              <p class="text-lg italic text-gray-300 font-serif tracking-wide">Strength in every Coat</p>
            </div>
            
            <!-- Headline removed as requested -->

            <!-- Icons in a 2x2 grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
              <div class="flex items-center gap-4 bg-gray-800/50 p-3 rounded-xl backdrop-blur-sm border border-white/5">
                <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white shrink-0 shadow-[0_0_15px_rgba(34,197,94,0.4)]">
                  <Icon name="lucide:check" size="20" stroke-width="3" />
                </div>
                <span class="text-[11px] uppercase tracking-widest text-gray-200 font-bold leading-tight">Trusted<br>Quality</span>
              </div>
              <div class="flex items-center gap-4 bg-gray-800/50 p-3 rounded-xl backdrop-blur-sm border border-white/5">
                <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white shrink-0 shadow-[0_0_15px_rgba(34,197,94,0.4)]">
                  <Icon name="lucide:cloud-lightning" size="20" stroke-width="2.5" />
                </div>
                <span class="text-[11px] uppercase tracking-widest text-gray-200 font-bold leading-tight">Sri Lankan<br>Weather</span>
              </div>
              <div class="flex items-center gap-4 bg-gray-800/50 p-3 rounded-xl backdrop-blur-sm border border-white/5">
                <div class="w-10 h-10 bg-white border-2 border-green-500 rounded-full flex items-center justify-center text-green-600 shrink-0 shadow-[0_0_15px_rgba(255,255,255,0.2)]">
                  <Icon name="lucide:leaf" size="20" stroke-width="2.5" />
                </div>
                <span class="text-[11px] uppercase tracking-widest text-gray-200 font-bold leading-tight">No Lead<br>& Mercury</span>
              </div>
              <div class="flex items-center gap-4 bg-gray-800/50 p-3 rounded-xl backdrop-blur-sm border border-white/5">
                <div class="w-10 h-10 bg-white border-2 border-green-500 rounded-full flex items-center justify-center text-green-600 shrink-0 shadow-[0_0_15px_rgba(255,255,255,0.2)]">
                  <Icon name="lucide:shield-check" size="20" stroke-width="2.5" />
                </div>
                <span class="text-[11px] uppercase tracking-widest text-gray-200 font-bold leading-tight">Total Lead<br>< 90ppm</span>
              </div>
            </div>
          </div>

          <!-- Right: The 3 Buckets in a clustered/staggered layout -->
          <div class="col-span-1 lg:col-span-7 relative h-[400px] md:h-[500px] flex items-center justify-center mt-10 lg:mt-0">
            
            <!-- Background Glow -->
            <div class="absolute inset-0 bg-blue-500/20 blur-[100px] rounded-full z-0 pointer-events-none"></div>

            <!-- Left Bucket (Green) -->
            <div class="absolute left-4 md:left-10 z-10 transform scale-75 md:scale-90 hover:scale-100 hover:z-40 transition-all duration-300">
              <div class="relative group cursor-pointer">
                <img src="/images/bucket_green.png" alt="Superlux Weather Proof" class="w-44 md:w-56 object-contain drop-shadow-[0_20px_30px_rgba(0,0,0,0.8)]">
                <!-- Hover Info Tooltip -->
                <div class="absolute -bottom-16 left-1/2 -translate-x-1/2 w-64 text-center opacity-0 group-hover:opacity-100 transition-opacity bg-gray-900/95 backdrop-blur-md p-3 rounded-xl border border-green-500/30 shadow-2xl pointer-events-none">
                  <h3 class="text-sm font-bold text-green-400 uppercase tracking-wider">Weather Proof By Nature</h3>
                  <p class="text-[10px] text-gray-300 uppercase tracking-widest mt-1">Rain. Heat. Time. Protected.</p>
                </div>
              </div>
            </div>

            <!-- Right Bucket (Red) -->
            <div class="absolute right-4 md:right-10 z-10 transform scale-75 md:scale-90 hover:scale-100 hover:z-40 transition-all duration-300">
               <div class="relative group cursor-pointer">
                <img src="/images/bucket_red.png" alt="Superlux Interior Emulsion" class="w-44 md:w-56 object-contain drop-shadow-[0_20px_30px_rgba(0,0,0,0.8)]">
                <!-- Hover Info Tooltip -->
                <div class="absolute -bottom-16 left-1/2 -translate-x-1/2 w-64 text-center opacity-0 group-hover:opacity-100 transition-opacity bg-gray-900/95 backdrop-blur-md p-3 rounded-xl border border-red-500/30 shadow-2xl pointer-events-none">
                  <h3 class="text-sm font-bold text-red-400 uppercase tracking-wider">Where Comfort Meets Color</h3>
                  <p class="text-[10px] text-gray-300 uppercase tracking-widest mt-1">Smooth finish. Lasting beauty.</p>
                </div>
              </div>
            </div>

            <!-- Center Bucket (Blue - Aqua Flex) -->
            <div class="absolute z-30 transform hover:-translate-y-4 hover:scale-105 transition-all duration-300">
              <div class="relative group cursor-pointer">
                <img src="/images/bucket_blue.png" alt="Appco Aqua Flex" class="w-56 md:w-72 object-contain drop-shadow-[0_30px_50px_rgba(0,0,0,0.9)]">
                
                <!-- Hover Info Tooltip -->
                <div class="absolute -bottom-20 left-1/2 -translate-x-1/2 w-72 text-center opacity-0 group-hover:opacity-100 transition-opacity bg-gray-900/95 backdrop-blur-md p-4 rounded-xl border border-blue-500/30 shadow-2xl pointer-events-none">
                  <h3 class="text-md font-bold text-blue-400 uppercase tracking-wider">Flexible Protection</h3>
                  <p class="text-[11px] text-white uppercase font-bold tracking-widest mt-1">Powerful Performance</p>
                  <p class="text-[10px] text-gray-400 uppercase tracking-widest mt-1">Crack resistant. Water resistant.</p>
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>

    </div>
  </section>
</template>
