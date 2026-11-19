<template>
  <div class="max-w-6xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
      <div>
        <h1 class="text-3xl font-extrabold text-slate-900 flex items-center gap-3">
          <i class="fa-solid fa-layer-group text-red-600"></i>
          Web Layout & Media
        </h1>
        <p class="text-sm text-slate-500 mt-1">
          Customize fixed background media, homepage hero slider images, and sub-pages header banners.
        </p>
      </div>

      <div class="flex items-center gap-3">
        <a 
          href="https://universalpaints.lk" 
          target="_blank" 
          rel="noopener noreferrer"
          class="px-4 py-2.5 rounded-lg border border-slate-200 text-slate-700 hover:bg-slate-100 font-semibold text-xs flex items-center gap-2 transition"
        >
          <i class="fa-solid fa-arrow-up-right-from-square"></i>
          View Live Website
        </a>

        <button 
          @click="saveCurrentLayout" 
          :disabled="isSaving || isAnyUploading"
          class="bg-red-600 hover:bg-red-700 text-white px-6 py-2.5 rounded-lg font-semibold text-sm transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2 shadow-sm"
        >
          <i class="fa-solid fa-spinner fa-spin" v-if="isSaving"></i>
          <i class="fa-solid fa-floppy-disk" v-else></i>
          {{ isSaving ? 'Saving Changes...' : 'Save All Changes' }}
        </button>
      </div>
    </div>

    <!-- Notification Alert -->
    <div 
      v-if="saveMessage" 
      class="p-4 rounded-xl text-sm font-semibold flex items-center justify-between transition-all"
      :class="saveMessageType === 'success' ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : 'bg-red-50 text-red-800 border border-red-200'"
    >
      <div class="flex items-center gap-2.5">
        <i :class="saveMessageType === 'success' ? 'fa-solid fa-circle-check text-emerald-600' : 'fa-solid fa-triangle-exclamation text-red-600'"></i>
        <span>{{ saveMessage }}</span>
      </div>
      <button @click="saveMessage = ''" class="text-slate-400 hover:text-slate-600">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <!-- Section Tabs -->
    <div class="border-b border-slate-200">
      <nav class="flex space-x-4 sm:space-x-8">
        <button 
          type="button"
          @click="activeTab = 'home'"
          class="py-3 px-1 border-b-2 font-bold text-sm flex items-center gap-2 transition"
          :class="activeTab === 'home' ? 'border-red-600 text-red-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300'"
        >
          <i class="fa-solid fa-house"></i>
          Homepage Hero Slider
          <span 
            class="ml-1.5 px-2 py-0.5 rounded-full text-[11px] font-semibold transition"
            :class="activeTab === 'home' ? 'bg-red-100 text-red-700' : 'bg-slate-100 text-slate-600'"
          >
            {{ heroSlides.length }} Slides
          </span>
        </button>

        <button 
          type="button"
          @click="activeTab = 'subpages'"
          class="py-3 px-1 border-b-2 font-bold text-sm flex items-center gap-2 transition"
          :class="activeTab === 'subpages' ? 'border-red-600 text-red-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300'"
        >
          <i class="fa-solid fa-images"></i>
          Sub-Pages Header Banners
          <span 
            class="ml-1.5 px-2 py-0.5 rounded-full text-[11px] font-semibold transition"
            :class="activeTab === 'subpages' ? 'bg-red-100 text-red-700' : 'bg-slate-100 text-slate-600'"
          >
            {{ Object.keys(subpageHeaders).length }} Pages
          </span>
        </button>
      </nav>
    </div>

    <!-- Loading State -->
    <div v-if="isLoading" class="p-16 text-center bg-white rounded-xl border border-slate-200">
      <i class="fa-solid fa-spinner fa-spin text-4xl text-red-600 mb-3"></i>
      <p class="text-slate-500 font-medium text-sm">Loading web layout configuration...</p>
    </div>

    <!-- ========================================== -->
    <!-- TAB 1: HOMEPAGE HERO SLIDER               -->
    <!-- ========================================== -->
    <div v-else-if="activeTab === 'home'" class="space-y-6">
      <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 md:p-8 space-y-6">
        
        <!-- Section Info Banner -->
        <div class="bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl p-5 sm:p-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 shadow-sm">
          <div class="space-y-1">
            <h2 class="text-lg font-bold flex items-center gap-2">
              <i class="fa-solid fa-images text-red-400"></i>
              Homepage Hero Background Slider (Right-Side Scene)
            </h2>
            <p class="text-xs text-slate-300 max-w-2xl leading-relaxed">
              These images cycle smoothly on the <strong>right side</strong> of the homepage hero slider. The left-side brand identity, deep navy background, paint splash arch, and typography remain permanently fixed for consistent branding.
            </p>
          </div>

          <div class="flex items-center gap-2 self-end md:self-auto shrink-0">
            <button 
              type="button" 
              @click="addSlide"
              class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-xs font-semibold flex items-center gap-1.5 transition shadow"
            >
              <i class="fa-solid fa-plus"></i>
              Add Slide
            </button>
            <button 
              type="button" 
              @click="resetToDefaults"
              class="px-3 py-2 bg-white/10 hover:bg-white/20 text-slate-200 rounded-lg text-xs font-medium transition"
              title="Reset to default original images"
            >
              <i class="fa-solid fa-rotate-left mr-1"></i>
              Reset Defaults
            </button>
          </div>
        </div>

        <!-- Slides List -->
        <div class="space-y-6">
          <div 
            v-for="(slide, index) in heroSlides" 
            :key="slide.id || index"
            class="border border-slate-200 rounded-xl overflow-hidden bg-slate-50/50 hover:border-slate-300 transition shadow-xs"
          >
            <!-- Card Header -->
            <div class="bg-slate-100 px-5 py-3 border-b border-slate-200 flex items-center justify-between">
              <div class="flex items-center gap-3">
                <span class="w-6 h-6 rounded-full bg-red-600 text-white font-extrabold text-xs flex items-center justify-center">
                  {{ index + 1 }}
                </span>
                <span class="font-bold text-slate-800 text-sm">
                  Slide #{{ index + 1 }}
                </span>
                <span v-if="slide.image.startsWith('/images/')" class="text-[10px] font-semibold uppercase px-2 py-0.5 rounded bg-slate-200 text-slate-600">
                  Default Theme Asset
                </span>
                <span v-else class="text-[10px] font-semibold uppercase px-2 py-0.5 rounded bg-emerald-100 text-emerald-700">
                  Custom Upload
                </span>
              </div>

              <!-- Reorder and Delete Actions -->
              <div class="flex items-center gap-1.5">
                <button 
                  type="button"
                  @click="moveSlideUp(index)"
                  :disabled="index === 0"
                  class="w-7 h-7 rounded bg-white border border-slate-200 text-slate-600 hover:bg-slate-200 disabled:opacity-30 disabled:cursor-not-allowed flex items-center justify-center text-xs transition"
                  title="Move slide up"
                >
                  <i class="fa-solid fa-arrow-up"></i>
                </button>
                <button 
                  type="button"
                  @click="moveSlideDown(index)"
                  :disabled="index === heroSlides.length - 1"
                  class="w-7 h-7 rounded bg-white border border-slate-200 text-slate-600 hover:bg-slate-200 disabled:opacity-30 disabled:cursor-not-allowed flex items-center justify-center text-xs transition"
                  title="Move slide down"
                >
                  <i class="fa-solid fa-arrow-down"></i>
                </button>
                <button 
                  type="button"
                  @click="removeSlide(index)"
                  :disabled="heroSlides.length <= 1"
                  class="w-7 h-7 rounded bg-red-50 border border-red-200 text-red-600 hover:bg-red-100 disabled:opacity-30 disabled:cursor-not-allowed flex items-center justify-center text-xs transition ml-1"
                  title="Delete this slide"
                >
                  <i class="fa-solid fa-trash"></i>
                </button>
              </div>
            </div>

            <!-- Card Content Body -->
            <div class="p-5 grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
              
              <!-- Live Preview Thumbnail with Mockup Overlay -->
              <div class="lg:col-span-5 space-y-1.5">
                <div class="flex items-center justify-between">
                  <label class="block text-xs font-bold text-slate-700">Live Appearance Preview</label>
                  <span v-if="isCustomSlide(slide.image)" class="text-[10px] text-emerald-600 font-semibold flex items-center gap-1">
                    <i class="fa-solid fa-wand-magic-sparkles text-[9px]"></i> Right-Side Blend Active
                  </span>
                </div>
                <div class="relative w-full h-48 rounded-xl overflow-hidden border border-slate-700 bg-[#031a36] group shadow-lg flex items-center justify-center">
                  
                  <!-- If custom slide: Show right-side image + fixed left branding -->
                  <template v-if="isCustomSlide(slide.image)">
                    <!-- Right side uploaded photo -->
                    <img 
                      v-if="slide.image"
                      :src="resolvePreviewUrl(slide.image)" 
                      :alt="'Slide ' + (index + 1)" 
                      class="absolute right-0 top-0 w-3/5 h-full object-cover transition-transform duration-700 group-hover:scale-105"
                      style="mask-image: linear-gradient(to right, transparent 0%, rgba(0,0,0,0.5) 8%, black 22%); -webkit-mask-image: linear-gradient(to right, transparent 0%, rgba(0,0,0,0.5) 8%, black 22%);"
                      @error="handleImgError($event)"
                    />
                    <!-- Rainbow Splash Arch Frame (conditionally rendered by tick) -->
                    <img 
                      v-if="slide.show_splash !== false"
                      src="/images/home-page/rainbow-splash-frame.webp" 
                      alt="Brand Splash Frame" 
                      class="absolute inset-0 w-full h-full object-cover pointer-events-none transition-opacity duration-300"
                    />
                    <!-- Left solid navy scrim (when splash is turned off) -->
                    <div v-else class="absolute inset-y-0 left-0 w-1/2 bg-gradient-to-r from-[#031a36] via-[#031a36] to-transparent pointer-events-none"></div>

                    <!-- Right side badge label -->
                    <div class="absolute top-2 right-2 bg-emerald-600/90 text-white text-[9px] font-bold px-2 py-0.5 rounded shadow z-10 flex items-center gap-1">
                      <i class="fa-solid fa-check text-[8px]"></i> Uploaded Scene
                    </div>
                  </template>

                  <!-- If default pre-composited slide -->
                  <template v-else>
                    <img 
                      v-if="slide.image" 
                      :src="resolvePreviewUrl(slide.image)" 
                      :alt="'Slide ' + (index + 1)" 
                      class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                      @error="handleImgError($event)"
                    />
                    <div class="absolute top-2 right-2 bg-slate-800/80 text-slate-300 text-[9px] font-medium px-2 py-0.5 rounded z-10">
                      Original Theme Slide
                    </div>
                  </template>

                  <div v-if="!slide.image" class="text-slate-400 text-center p-4">
                    <i class="fa-solid fa-image text-3xl mb-1 opacity-50"></i>
                    <p class="text-xs">No image uploaded yet</p>
                  </div>

                  <!-- Gradient Theme Mockup Overlay (identical to website) -->
                  <div class="absolute inset-0 bg-gradient-to-b from-slate-950/20 via-transparent to-slate-950/60 pointer-events-none"></div>

                  <!-- Mockup Text on Left Side with Fixed Badge -->
                  <div class="absolute inset-0 p-4 flex flex-col justify-between pointer-events-none max-w-[62%] z-10">
                    <span class="inline-block bg-slate-900/80 text-amber-400 text-[8px] font-extrabold uppercase px-1.5 py-0.5 rounded w-max tracking-wider border border-amber-400/30">
                      Fixed Left Identity
                    </span>
                    <div>
                      <span class="text-[9px] font-extrabold tracking-wider text-red-400 uppercase block mb-0.5">COLORING YOUR WORLD</span>
                      <span class="text-xs font-black text-white leading-tight block">
                        Quality Paints.<br/>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-500 via-amber-400 to-green-500">Beautiful</span> Possibilities.
                      </span>
                    </div>
                  </div>

                  <!-- Slide Indicator Badge (bottom right) -->
                  <div class="absolute bottom-2 right-2 bg-black/70 backdrop-blur-xs text-white text-[10px] font-mono px-2 py-0.5 rounded z-10">
                    Slide {{ index + 1 }} / {{ heroSlides.length }}
                  </div>
                </div>
              </div>

              <!-- Upload & URL Configuration Controls -->
              <div class="lg:col-span-7 space-y-4">
                
                <div>
                  <label class="block text-xs font-semibold text-slate-700 mb-1">Slide Label / Internal Reference</label>
                  <input 
                    type="text" 
                    v-model="slide.title" 
                    class="w-full text-xs px-3 py-2 border border-slate-300 rounded-lg focus:outline-hidden focus:ring-2 focus:ring-red-500/20 focus:border-red-500"
                    placeholder="e.g. Modern Architecture or Living Room"
                  />
                </div>

                <div>
                  <label class="block text-xs font-semibold text-slate-700 mb-1">
                    Slide Image Source <span class="text-red-500">*</span>
                  </label>
                  <div class="space-y-2">
                    <div class="flex items-center gap-2">
                      <label 
                        class="cursor-pointer bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 px-3 py-2 rounded-lg text-xs font-semibold flex items-center gap-1.5 transition shrink-0"
                        :class="{ 'opacity-50 pointer-events-none': uploadingMap[index] }"
                      >
                        <i class="fa-solid fa-spinner fa-spin" v-if="uploadingMap[index]"></i>
                        <i class="fa-solid fa-cloud-arrow-up" v-else></i>
                        <span>{{ uploadingMap[index] ? 'Uploading...' : 'Upload New Image' }}</span>
                        <input 
                          type="file" 
                          accept="image/png,image/jpeg,image/webp,image/jpg" 
                          class="hidden" 
                          @change="handleFileUpload($event, index)"
                          :disabled="uploadingMap[index]"
                        />
                      </label>

                      <input 
                        type="text" 
                        v-model="slide.image" 
                        class="flex-1 text-xs px-3 py-2 border border-slate-300 rounded-lg font-mono focus:outline-hidden focus:ring-2 focus:ring-red-500/20 focus:border-red-500"
                        placeholder="Paste image URL (e.g. Cloudflare R2 link) or relative path"
                      />
                    </div>
                    
                    <p class="text-[11px] text-slate-500">
                      Uploads only replace the <strong>right-side scene</strong>. The left-side brand dark wall, paint splash, and typography remain permanently fixed.
                    </p>
                  </div>
                </div>

                <!-- Paint Splash Arch Checkbox Option (Tick to show/hide) -->
                <div>
                  <label class="flex items-start gap-3 p-3 rounded-lg border transition cursor-pointer select-none"
                    :class="slide.show_splash !== false ? 'bg-amber-50/70 border-amber-300' : 'bg-slate-50 border-slate-200'"
                  >
                    <input 
                      type="checkbox" 
                      v-model="slide.show_splash" 
                      class="mt-0.5 w-4 h-4 rounded text-red-600 focus:ring-red-500 border-slate-300 cursor-pointer"
                    />
                    <div class="flex-1 text-xs">
                      <div class="flex items-center gap-2 font-bold" :class="slide.show_splash !== false ? 'text-amber-900' : 'text-slate-700'">
                        <i class="fa-solid fa-paintbrush text-amber-500 text-xs"></i>
                        <span>Center Rainbow Paint Splash Arch</span>
                        <span class="text-[9px] px-1.5 py-0.5 rounded uppercase font-bold"
                          :class="slide.show_splash !== false ? 'bg-amber-200 text-amber-900' : 'bg-slate-200 text-slate-600'"
                        >
                          {{ slide.show_splash !== false ? 'With Splash (Active)' : 'Without Splash (Clean Photo)' }}
                        </span>
                      </div>
                      <p class="text-[11px] text-slate-500 mt-0.5 leading-normal">
                        Tick this box to include the signature rainbow paint splash arch in the center, or uncheck for a clean photo-only transition.
                      </p>
                    </div>
                  </label>
                </div>

              </div>

            </div>
          </div>
        </div>

        <!-- Sticky / Bottom Action Bar -->
        <div class="pt-4 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
          <p class="text-xs text-slate-500">
            <i class="fa-solid fa-circle-info text-slate-400 mr-1"></i>
            Changes take effect immediately on the live website after clicking <strong>Save All Changes</strong>.
          </p>
          <div class="flex items-center gap-3 w-full sm:w-auto">
            <button 
              type="button" 
              @click="saveCurrentLayout" 
              :disabled="isSaving || isAnyUploading"
              class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white px-7 py-2.5 rounded-lg font-semibold text-xs transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2 shadow-sm"
            >
              <i class="fa-solid fa-spinner fa-spin" v-if="isSaving"></i>
              <i class="fa-solid fa-floppy-disk" v-else></i>
              {{ isSaving ? 'Saving Changes...' : 'Save All Changes' }}
            </button>
          </div>
        </div>

      </div>
    </div>

    <!-- ========================================== -->
    <!-- TAB 2: SUB-PAGES HEADER BANNERS           -->
    <!-- ========================================== -->
    <div v-else-if="activeTab === 'subpages'" class="space-y-6">
      <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 md:p-8 space-y-6">
        
        <!-- Section Info Banner -->
        <div class="bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl p-5 sm:p-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 shadow-sm">
          <div class="space-y-1">
            <h2 class="text-lg font-bold flex items-center gap-2">
              <i class="fa-solid fa-images text-red-400"></i>
              Sub-Pages Header Banners (Hero Images)
            </h2>
            <p class="text-xs text-slate-300 max-w-2xl leading-relaxed">
              Upload custom hero header images for the website's key sub-pages. When a custom image is uploaded, it seamlessly replaces the default banner with all titles and overlays perfectly preserved.
            </p>
          </div>

          <div class="flex items-center gap-2 self-end md:self-auto shrink-0">
            <button 
              type="button" 
              @click="resetAllSubpagesToDefault"
              class="px-3 py-2 bg-white/10 hover:bg-white/20 text-slate-200 rounded-lg text-xs font-medium transition"
              title="Reset all sub-page headers to default assets"
            >
              <i class="fa-solid fa-rotate-left mr-1"></i>
              Reset All to Defaults
            </button>
          </div>
        </div>

        <!-- Subpages List -->
        <div class="space-y-6">
          <div 
            v-for="(pageData, pageKey) in subpageHeaders" 
            :key="pageKey"
            class="border border-slate-200 rounded-xl overflow-hidden bg-slate-50/50 hover:border-slate-300 transition shadow-xs"
          >
            <!-- Card Header -->
            <div class="bg-slate-100 px-5 py-3 border-b border-slate-200 flex items-center justify-between">
              <div class="flex items-center gap-3">
                <span class="w-6 h-6 rounded-full bg-slate-800 text-white font-extrabold text-xs flex items-center justify-center">
                  <i :class="getPageIcon(pageKey)" class="text-[10px]"></i>
                </span>
                <span class="font-bold text-slate-800 text-sm">
                  {{ pageData.title }}
                </span>
                <span class="font-mono text-[11px] px-2 py-0.5 rounded bg-slate-200 text-slate-700 font-semibold">
                  {{ pageData.route }}
                </span>
                <span v-if="pageData.image && pageData.image !== pageData.default_image" class="text-[10px] font-semibold uppercase px-2 py-0.5 rounded bg-emerald-100 text-emerald-700">
                  Custom Header Active
                </span>
                <span v-else class="text-[10px] font-semibold uppercase px-2 py-0.5 rounded bg-slate-200 text-slate-600">
                  Default Theme Asset
                </span>
              </div>

              <!-- Quick action -->
              <div class="flex items-center gap-2">
                <a 
                  :href="'https://universalpaints.lk' + pageData.route" 
                  target="_blank" 
                  rel="noopener noreferrer"
                  class="text-xs text-slate-500 hover:text-slate-800 font-medium flex items-center gap-1 transition"
                  title="View this page live"
                >
                  <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                  <span class="hidden sm:inline">View Page</span>
                </a>
              </div>
            </div>

            <!-- Card Content Body -->
            <div class="p-5 grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
              
              <!-- Live Preview Thumbnail with Realistic Page Mockup -->
              <div class="lg:col-span-5 space-y-1.5">
                <label class="block text-xs font-bold text-slate-700">Header Appearance Preview</label>
                <div class="relative w-full h-44 rounded-xl overflow-hidden border border-slate-700 bg-slate-900 group shadow-lg flex items-center justify-center">
                  
                  <!-- Background Image -->
                  <img 
                    v-if="pageData.image || pageData.default_image"
                    :src="resolvePreviewUrl(pageData.image || pageData.default_image)" 
                    :alt="pageData.title"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    @error="handleImgError($event)"
                  />
                  <!-- Fallback gradient if no image exists (e.g. sales reps default) -->
                  <div 
                    v-else 
                    class="w-full h-full bg-gradient-to-br from-slate-900 via-slate-800 to-red-950 flex items-center justify-center"
                  ></div>

                  <!-- Dark Header Overlay (similar to website CSS) -->
                  <div class="absolute inset-0 bg-gradient-to-t from-slate-950/85 via-slate-950/50 to-slate-950/30 pointer-events-none"></div>

                  <!-- Breadcrumb and Page Title Mockup -->
                  <div class="absolute inset-0 p-4 flex flex-col justify-end text-white pointer-events-none z-10">
                    <div class="flex items-center gap-1.5 text-[9px] text-slate-300 font-medium mb-1">
                      <span>Home</span>
                      <span class="text-slate-500">&gt;</span>
                      <span class="text-red-400 font-bold">{{ pageData.title }}</span>
                    </div>
                    <span class="text-[9px] font-extrabold tracking-wider text-red-400 uppercase block">
                      {{ pageData.subtitle || 'Universal Paints' }}
                    </span>
                    <h3 class="text-sm font-black text-white leading-tight">
                      {{ pageData.title }}
                    </h3>
                  </div>

                  <!-- Route Badge (top right) -->
                  <div class="absolute top-2 right-2 bg-black/70 backdrop-blur-xs text-white text-[9px] font-mono px-2 py-0.5 rounded z-10">
                    {{ pageData.route }}
                  </div>
                </div>
              </div>

              <!-- Upload & URL Configuration Controls -->
              <div class="lg:col-span-7 space-y-4">
                
                <div>
                  <label class="block text-xs font-semibold text-slate-700 mb-1">
                    Header Banner Image <span class="text-red-500">*</span>
                  </label>
                  <div class="space-y-2">
                    <div class="flex items-center gap-2">
                      <label 
                        class="cursor-pointer bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 px-3 py-2 rounded-lg text-xs font-semibold flex items-center gap-1.5 transition shrink-0"
                        :class="{ 'opacity-50 pointer-events-none': uploadingSubpageMap[pageKey] }"
                      >
                        <i class="fa-solid fa-spinner fa-spin" v-if="uploadingSubpageMap[pageKey]"></i>
                        <i class="fa-solid fa-cloud-arrow-up" v-else></i>
                        <span>{{ uploadingSubpageMap[pageKey] ? 'Uploading...' : 'Upload Header Image' }}</span>
                        <input 
                          type="file" 
                          accept="image/png,image/jpeg,image/webp,image/jpg" 
                          class="hidden" 
                          @change="handleSubpageUpload($event, pageKey)"
                          :disabled="uploadingSubpageMap[pageKey]"
                        />
                      </label>

                      <input 
                        type="text" 
                        v-model="pageData.image" 
                        class="flex-1 text-xs px-3 py-2 border border-slate-300 rounded-lg font-mono focus:outline-hidden focus:ring-2 focus:ring-red-500/20 focus:border-red-500"
                        placeholder="Paste image URL (e.g. Cloudflare R2 link) or relative path"
                      />

                      <button
                        type="button"
                        v-if="pageData.default_image && pageData.image !== pageData.default_image"
                        @click="resetSingleSubpage(pageKey)"
                        class="px-2.5 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-xs font-medium transition shrink-0"
                        title="Revert to original default image"
                      >
                        <i class="fa-solid fa-rotate-left mr-1"></i> Default
                      </button>
                    </div>
                    
                    <p class="text-[11px] text-slate-500">
                      Recommended: <strong>1920 × 600 px</strong> or <strong>1920 × 1080 px</strong> landscape image. Uploads are automatically optimized to WebP and hosted on Cloudflare R2 CDN.
                    </p>
                  </div>
                </div>

                <div>
                  <label class="block text-xs font-semibold text-slate-700 mb-1">Header Subtitle / Tagline</label>
                  <input 
                    type="text" 
                    v-model="pageData.subtitle" 
                    class="w-full text-xs px-3 py-2 border border-slate-300 rounded-lg focus:outline-hidden focus:ring-2 focus:ring-red-500/20 focus:border-red-500"
                    placeholder="e.g. Our Journey & Story or Get in Touch"
                  />
                </div>

              </div>

            </div>
          </div>
        </div>

        <!-- Sticky / Bottom Action Bar -->
        <div class="pt-4 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
          <p class="text-xs text-slate-500">
            <i class="fa-solid fa-circle-info text-slate-400 mr-1"></i>
            Header banner changes take effect immediately on the live sub-pages after clicking <strong>Save All Changes</strong>.
          </p>
          <div class="flex items-center gap-3 w-full sm:w-auto">
            <button 
              type="button" 
              @click="saveCurrentLayout" 
              :disabled="isSaving || isAnyUploading"
              class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white px-7 py-2.5 rounded-lg font-semibold text-xs transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2 shadow-sm"
            >
              <i class="fa-solid fa-spinner fa-spin" v-if="isSaving"></i>
              <i class="fa-solid fa-floppy-disk" v-else></i>
              {{ isSaving ? 'Saving Changes...' : 'Save All Changes' }}
            </button>
          </div>
        </div>

      </div>
    </div>

  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { compressImage } from '~/utils/imageCompressor'

const config = useRuntimeConfig()
const { token } = useAuth()
const router = useRouter()

const activeTab = ref('home')
const isLoading = ref(true)
const isSaving = ref(false)
const saveMessage = ref('')
const saveMessageType = ref('success')

// Per-slide uploading status tracker
const uploadingMap = ref({})
const uploadingSubpageMap = ref({})

const isAnyUploading = computed(() => {
  return Object.values(uploadingMap.value).some(Boolean) || Object.values(uploadingSubpageMap.value).some(Boolean)
})

// ==========================================
// 1. HOMEPAGE SLIDER DEFAULTS & STATE
// ==========================================
const defaultSlides = [
  {
    id: 1,
    image: '/images/home-page/dark-hero-bg1.webp',
    title: 'Slide 1',
    show_splash: true
  },
  {
    id: 2,
    image: '/images/home-page/dark-hero-bg2.webp',
    title: 'Slide 2',
    show_splash: true
  },
  {
    id: 3,
    image: '/images/home-page/dark-hero-bg3.webp',
    title: 'Slide 3',
    show_splash: true
  }
]

const heroSlides = ref([ ...defaultSlides ])

const isCustomSlide = (url) => {
  if (!url) return false
  if (url.includes('dark-hero-bg1') || url.includes('dark-hero-bg2') || url.includes('dark-hero-bg3')) {
    return false
  }
  return true
}

// ==========================================
// 2. SUB-PAGES HEADERS DEFAULTS & STATE
// ==========================================
const defaultSubpages = {
  about: {
    title: 'About Us',
    route: '/about',
    image: '/images/about-us-page/hero.webp',
    default_image: '/images/about-us-page/hero.webp',
    subtitle: 'Our Journey & Story'
  },
  contact: {
    title: 'Contact Us',
    route: '/contact',
    image: '/images/contact-us-page/hero.webp',
    default_image: '/images/contact-us-page/hero.webp',
    subtitle: 'Get in Touch'
  },
  shop: {
    title: 'Shop / Products',
    route: '/shop',
    image: '/images/shop page/shop_header.webp',
    default_image: '/images/shop page/shop_header.webp',
    subtitle: 'Explore Our Range'
  },
  blog: {
    title: 'Blog',
    route: '/blog',
    image: '/images/about-us-page/hero.webp',
    default_image: '/images/about-us-page/hero.webp',
    subtitle: 'News & Insights'
  },
  sales_reps: {
    title: 'Sales Network / Representatives',
    route: '/sales-representatives',
    image: '',
    default_image: '',
    subtitle: 'Island-wide Network'
  }
}

const subpageHeaders = ref({ ...defaultSubpages })

const getPageIcon = (key) => {
  const iconMap = {
    about: 'fa-solid fa-building',
    contact: 'fa-solid fa-envelope',
    shop: 'fa-solid fa-cart-shopping',
    blog: 'fa-solid fa-newspaper',
    sales_reps: 'fa-solid fa-map-location-dot'
  }
  return iconMap[key] || 'fa-solid fa-file'
}

// Resolve image URL for admin preview
const resolvePreviewUrl = (url) => {
  if (!url) return ''
  if (url.startsWith('http://') || url.startsWith('https://')) return url
  if (url.startsWith('/images/')) {
    return `https://universalpaints.lk${url}`
  }
  return `${config.public.apiBase}${url}`
}

const handleImgError = (e) => {
  console.warn('Preview image load error:', e.target.src)
}

// ==========================================
// 3. FETCH LAYOUT CONFIGURATIONS
// ==========================================
const loadLayout = async () => {
  isLoading.value = true
  const authToken = token.value || (process.client ? (localStorage.getItem('auth_token') || useCookie('auth_token').value) : '')
  
  try {
    const [homeRes, subRes] = await Promise.all([
      $fetch(`${config.public.apiBase}/api/web-layout/home`, {
        headers: {
          Accept: 'application/json',
          ...(authToken ? { Authorization: `Bearer ${authToken}` } : {})
        }
      }).catch(err => {
        console.warn('Failed to load home web-layout:', err)
        return null
      }),
      $fetch(`${config.public.apiBase}/api/web-layout/subpages`, {
        headers: {
          Accept: 'application/json',
          ...(authToken ? { Authorization: `Bearer ${authToken}` } : {})
        }
      }).catch(err => {
        console.warn('Failed to load subpages web-layout:', err)
        return null
      })
    ])

    // Load Home Slider
    if (homeRes && Array.isArray(homeRes.hero_slides) && homeRes.hero_slides.length > 0) {
      heroSlides.value = homeRes.hero_slides.map((s, idx) => ({
        id: s.id || (idx + 1),
        image: typeof s === 'string' ? s : (s.image || ''),
        title: typeof s === 'string' ? `Slide ${idx + 1}` : (s.title || `Slide ${idx + 1}`),
        show_splash: typeof s === 'object' && s !== null ? s.show_splash !== false : true
      }))
    } else {
      heroSlides.value = [ ...defaultSlides ]
    }

    // Load Sub-Pages Headers
    if (subRes && subRes.subpage_headers) {
      const merged = { ...defaultSubpages }
      for (const [k, v] of Object.entries(subRes.subpage_headers)) {
        if (merged[k]) {
          merged[k] = {
            ...merged[k],
            ...v,
            default_image: defaultSubpages[k]?.default_image || ''
          }
        }
      }
      subpageHeaders.value = merged
    } else {
      subpageHeaders.value = { ...defaultSubpages }
    }
  } catch (err) {
    console.warn('Failed to fetch web layout, using defaults:', err)
    heroSlides.value = [ ...defaultSlides ]
    subpageHeaders.value = { ...defaultSubpages }
  } finally {
    isLoading.value = false
  }
}

// ==========================================
// 4. UPLOAD FILES TO CLOUDFLARE R2
// ==========================================
const handleFileUpload = async (event, index) => {
  const rawFile = event.target.files?.[0]
  if (!rawFile) return

  const authToken = token.value || (process.client ? (localStorage.getItem('auth_token') || useCookie('auth_token').value) : '')
  if (!authToken) {
    alert('Your session has expired. Please log in again to upload images.')
    router.push('/login')
    return
  }

  uploadingMap.value[index] = true
  saveMessage.value = ''

  try {
    let fileToUpload = rawFile
    try {
      fileToUpload = await compressImage(rawFile, { maxWidth: 1920, maxHeight: 1080, quality: 0.85 })
    } catch (compressErr) {
      console.warn('Image compressor fallback to raw file:', compressErr)
      fileToUpload = rawFile
    }

    const formData = new FormData()
    formData.append('image', fileToUpload)
    formData.append('folder', 'web-layout')

    const res = await $fetch(`${config.public.apiBase}/api/upload`, {
      method: 'POST',
      body: formData,
      headers: {
        Accept: 'application/json',
        Authorization: `Bearer ${authToken}`
      }
    })

    if (res && res.url) {
      heroSlides.value[index].image = res.url
      saveMessage.value = `Image for Slide #${index + 1} uploaded successfully! Don't forget to click "Save All Changes" to publish it live.`
      saveMessageType.value = 'success'
    }
  } catch (err) {
    const errorDetails = err.data?.errors
      ? Object.values(err.data.errors).flat().join('\n')
      : (err.data?.message || err.message || 'Unknown network error')
    alert(`Failed to upload image:\n${errorDetails}`)
    console.error('Upload error:', err)
  } finally {
    uploadingMap.value[index] = false
    event.target.value = ''
  }
}

// Upload file for sub-page header
const handleSubpageUpload = async (event, pageKey) => {
  const rawFile = event.target.files?.[0]
  if (!rawFile) return

  const authToken = token.value || (process.client ? (localStorage.getItem('auth_token') || useCookie('auth_token').value) : '')
  if (!authToken) {
    alert('Your session has expired. Please log in again to upload images.')
    router.push('/login')
    return
  }

  uploadingSubpageMap.value[pageKey] = true
  saveMessage.value = ''

  try {
    let fileToUpload = rawFile
    try {
      fileToUpload = await compressImage(rawFile, { maxWidth: 1920, maxHeight: 1080, quality: 0.85 })
    } catch (compressErr) {
      console.warn('Image compressor fallback to raw file:', compressErr)
      fileToUpload = rawFile
    }

    const formData = new FormData()
    formData.append('image', fileToUpload)
    formData.append('folder', 'web-layout')

    const res = await $fetch(`${config.public.apiBase}/api/upload`, {
      method: 'POST',
      body: formData,
      headers: {
        Accept: 'application/json',
        Authorization: `Bearer ${authToken}`
      }
    })

    if (res && res.url) {
      subpageHeaders.value[pageKey].image = res.url
      saveMessage.value = `Header image for "${subpageHeaders.value[pageKey].title}" uploaded successfully! Click "Save All Changes" to publish it live.`
      saveMessageType.value = 'success'
    }
  } catch (err) {
    const errorDetails = err.data?.errors
      ? Object.values(err.data.errors).flat().join('\n')
      : (err.data?.message || err.message || 'Unknown network error')
    alert(`Failed to upload image:\n${errorDetails}`)
    console.error('Upload error:', err)
  } finally {
    uploadingSubpageMap.value[pageKey] = false
    event.target.value = ''
  }
}

// Reset single subpage
const resetSingleSubpage = (pageKey) => {
  if (confirm(`Reset header image for "${subpageHeaders.value[pageKey].title}" to default?`)) {
    subpageHeaders.value[pageKey].image = subpageHeaders.value[pageKey].default_image
  }
}

// Reset all subpages
const resetAllSubpagesToDefault = () => {
  if (confirm('Are you sure you want to reset all sub-page header images to default assets?')) {
    for (const key of Object.keys(subpageHeaders.value)) {
      subpageHeaders.value[key].image = subpageHeaders.value[key].default_image
    }
    saveMessage.value = 'Reset all sub-pages to default headers. Click "Save All Changes" to publish.'
    saveMessageType.value = 'success'
  }
}

// ==========================================
// 5. SLIDE MANAGEMENT HELPERS
// ==========================================
const addSlide = () => {
  const newId = heroSlides.value.length ? Math.max(...heroSlides.value.map(s => s.id || 0)) + 1 : 1
  heroSlides.value.push({
    id: newId,
    image: '',
    title: `Slide ${heroSlides.value.length + 1}`,
    show_splash: true
  })
}

const removeSlide = (index) => {
  if (heroSlides.value.length <= 1) {
    alert('At least one hero slide is required.')
    return
  }
  if (confirm(`Are you sure you want to delete Slide #${index + 1}?`)) {
    heroSlides.value.splice(index, 1)
  }
}

const moveSlideUp = (index) => {
  if (index > 0) {
    const item = heroSlides.value.splice(index, 1)[0]
    heroSlides.value.splice(index - 1, 0, item)
  }
}

const moveSlideDown = (index) => {
  if (index < heroSlides.value.length - 1) {
    const item = heroSlides.value.splice(index, 1)[0]
    heroSlides.value.splice(index + 1, 0, item)
  }
}

const resetToDefaults = () => {
  if (confirm('Are you sure you want to reset hero slider images to the default website assets?')) {
    heroSlides.value = JSON.parse(JSON.stringify(defaultSlides))
    saveMessage.value = 'Reset to default assets. Click "Save All Changes" to publish.'
    saveMessageType.value = 'success'
  }
}

// ==========================================
// 6. SAVE CONFIGURATIONS (CURRENT OR BOTH)
// ==========================================
const saveCurrentLayout = async () => {
  const authToken = token.value || (process.client ? (localStorage.getItem('auth_token') || useCookie('auth_token').value) : '')
  if (!authToken) {
    alert('Your session has expired. Please log in again.')
    router.push('/login')
    return
  }

  isSaving.value = true
  saveMessage.value = ''

  try {
    if (activeTab.value === 'home') {
      const validSlides = heroSlides.value.filter(s => Boolean(s.image && s.image.trim()))
      if (!validSlides.length) {
        alert('Please provide at least one slide with a valid image.')
        isSaving.value = false
        return
      }

      const res = await $fetch(`${config.public.apiBase}/api/web-layout/home`, {
        method: 'POST',
        headers: {
          Authorization: `Bearer ${authToken}`,
          Accept: 'application/json'
        },
        body: { hero_slides: validSlides }
      })

      if (res && res.hero_slides) {
        heroSlides.value = res.hero_slides
      }

      saveMessage.value = 'Homepage hero slider images updated and published successfully!'
      saveMessageType.value = 'success'

    } else if (activeTab.value === 'subpages') {
      const res = await $fetch(`${config.public.apiBase}/api/web-layout/subpages`, {
        method: 'POST',
        headers: {
          Authorization: `Bearer ${authToken}`,
          Accept: 'application/json'
        },
        body: { subpage_headers: subpageHeaders.value }
      })

      if (res && res.subpage_headers) {
        subpageHeaders.value = { ...defaultSubpages, ...res.subpage_headers }
      }

      saveMessage.value = 'Sub-pages header banners updated and published successfully!'
      saveMessageType.value = 'success'
    }
  } catch (err) {
    saveMessage.value = 'Failed to save changes: ' + (err.data?.message || err.message || 'Server error')
    saveMessageType.value = 'error'
    console.error('Error saving web layout:', err)
  } finally {
    isSaving.value = false
  }
}

onMounted(() => {
  loadLayout()
})
</script>
