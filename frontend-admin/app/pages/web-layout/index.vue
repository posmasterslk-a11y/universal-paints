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
          Customize fixed background media, homepage hero slider images, and website visual assets.
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
          @click="saveLayout" 
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
      <nav class="flex space-x-6">
        <button 
          class="py-3 px-1 border-b-2 border-red-600 font-bold text-sm text-red-600 flex items-center gap-2"
        >
          <i class="fa-solid fa-house"></i>
          Homepage Hero Slider
          <span class="ml-1.5 px-2 py-0.5 rounded-full text-[11px] bg-red-100 text-red-700">
            {{ heroSlides.length }} Slides
          </span>
        </button>
      </nav>
    </div>

    <!-- Loading State -->
    <div v-if="isLoading" class="p-16 text-center bg-white rounded-xl border border-slate-200">
      <i class="fa-solid fa-spinner fa-spin text-4xl text-red-600 mb-3"></i>
      <p class="text-slate-500 font-medium text-sm">Loading web layout configuration...</p>
    </div>

    <!-- Hero Slider Configuration Card -->
    <div v-else class="space-y-6">
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
                  
                  <!-- If custom slide: Show right-side image + splash overlay + fixed left branding -->
                  <template v-if="isCustomSlide(slide.image)">
                    <!-- Right side uploaded photo -->
                    <img 
                      v-if="slide.image"
                      :src="resolvePreviewUrl(slide.image)" 
                      :alt="'Slide ' + (index + 1)" 
                      class="absolute right-0 top-0 w-3/5 h-full object-cover transition-transform duration-700 group-hover:scale-105"
                      style="mask-image: linear-gradient(to right, transparent 0%, rgba(0,0,0,0.5) 18%, black 45%); -webkit-mask-image: linear-gradient(to right, transparent 0%, rgba(0,0,0,0.5) 18%, black 45%);"
                      @error="handleImgError($event)"
                    />
                    <!-- Fixed splash overlay -->
                    <img 
                      src="/images/home-page/header-paint-splash.webp" 
                      alt="Brand Splash" 
                      class="absolute inset-0 w-full h-full object-cover mix-blend-screen pointer-events-none opacity-90"
                    />
                    <!-- Left solid navy scrim for text clarity -->
                    <div class="absolute inset-y-0 left-0 w-1/2 bg-gradient-to-r from-[#031a36] via-[#031a36] to-transparent pointer-events-none"></div>

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
                <!-- Slide Title/Label -->
                <div>
                  <label class="block text-xs font-semibold text-slate-700 mb-1">Slide Label / Internal Reference</label>
                  <input 
                    type="text" 
                    v-model="slide.title"
                    placeholder="e.g. Modern Exterior Home"
                    class="w-full px-3 py-2 text-xs rounded-lg border border-slate-300 focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none transition bg-white"
                  />
                </div>

                <!-- Image Uploader & Direct URL -->
                <div>
                  <label class="block text-xs font-semibold text-slate-700 mb-1">Slide Image Source *</label>
                  
                  <div class="space-y-2">
                    <div class="flex items-center gap-2">
                      <!-- Upload Button -->
                      <label 
                        class="cursor-pointer bg-red-50 hover:bg-red-100 text-red-700 text-xs font-semibold py-2 px-3.5 rounded-lg border border-red-200 transition flex items-center gap-1.5 shrink-0"
                        :class="{ 'opacity-50 pointer-events-none': uploadingMap[index] }"
                      >
                        <i class="fa-solid fa-spinner fa-spin text-red-600" v-if="uploadingMap[index]"></i>
                        <i class="fa-solid fa-cloud-arrow-up text-red-600" v-else></i>
                        <span>{{ uploadingMap[index] ? 'Uploading...' : 'Upload New Image' }}</span>
                        <input 
                          type="file" 
                          accept="image/*" 
                          class="hidden" 
                          :disabled="uploadingMap[index]" 
                          @change="handleFileUpload($event, index)" 
                        />
                      </label>

                      <!-- URL Input -->
                      <input 
                        type="text" 
                        v-model="slide.image" 
                        placeholder="https://... or /images/..." 
                        class="flex-1 px-3 py-2 text-xs rounded-lg border border-slate-300 focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none transition bg-white font-mono"
                      />
                    </div>
                    
                    <p class="text-[11px] text-slate-500">
                      Uploads only replace the <strong>right-side scene</strong>. The left-side brand dark wall, paint splash, and typography remain permanently fixed.
                    </p>
                  </div>
                </div>

              </div>

            </div>
          </div>
        </div>

        <!-- Add Slide Row -->
        <div class="pt-2 flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-slate-100">
          <button 
            type="button" 
            @click="addSlide"
            class="w-full sm:w-auto px-5 py-2.5 rounded-lg border-2 border-dashed border-slate-300 hover:border-red-500 text-slate-600 hover:text-red-600 font-semibold text-xs flex items-center justify-center gap-2 transition bg-white"
          >
            <i class="fa-solid fa-plus text-sm"></i>
            Add Another Slide Image
          </button>

          <div class="flex items-center gap-3 w-full sm:w-auto justify-end">
            <button 
              type="button" 
              @click="saveLayout" 
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

const isLoading = ref(true)
const isSaving = ref(false)
const saveMessage = ref('')
const saveMessageType = ref('success')

// Per-slide uploading status tracker
const uploadingMap = ref({})
const isAnyUploading = computed(() => {
  return Object.values(uploadingMap.value).some(Boolean)
})

const defaultSlides = [
  {
    id: 1,
    image: '/images/home-page/dark-hero-bg1.webp',
    title: 'Slide 1'
  },
  {
    id: 2,
    image: '/images/home-page/dark-hero-bg2.webp',
    title: 'Slide 2'
  },
  {
    id: 3,
    image: '/images/home-page/dark-hero-bg3.webp',
    title: 'Slide 3'
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

// Resolve image URL for admin preview
const resolvePreviewUrl = (url) => {
  if (!url) return ''
  if (url.startsWith('http://') || url.startsWith('https://')) return url
  if (url.startsWith('/images/')) {
    // For local dev or production, load asset from main domain
    return `https://universalpaints.lk${url}`
  }
  return `${config.public.apiBase}${url}`
}

const handleImgError = (e) => {
  // If preview failed to load from primary source, try localhost:3000 if in dev
  console.warn('Preview image load error:', e.target.src)
}

// Fetch layout settings on mount
const loadLayout = async () => {
  isLoading.value = true
  const authToken = token.value || (process.client ? (localStorage.getItem('auth_token') || useCookie('auth_token').value) : '')
  try {
    const res = await $fetch(`${config.public.apiBase}/api/web-layout/home`, {
      headers: {
        Accept: 'application/json',
        ...(authToken ? { Authorization: `Bearer ${authToken}` } : {})
      }
    })

    if (res && Array.isArray(res.hero_slides) && res.hero_slides.length > 0) {
      heroSlides.value = res.hero_slides.map((s, idx) => ({
        id: s.id || (idx + 1),
        image: typeof s === 'string' ? s : (s.image || ''),
        title: typeof s === 'string' ? `Slide ${idx + 1}` : (s.title || `Slide ${idx + 1}`)
      }))
    } else {
      heroSlides.value = [ ...defaultSlides ]
    }
  } catch (err) {
    console.warn('Failed to fetch web layout, using defaults:', err)
    heroSlides.value = [ ...defaultSlides ]
  } finally {
    isLoading.value = false
  }
}

// Upload file to Cloudflare R2
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

// Slide Management
const addSlide = () => {
  const newId = heroSlides.value.length ? Math.max(...heroSlides.value.map(s => s.id || 0)) + 1 : 1
  heroSlides.value.push({
    id: newId,
    image: '',
    title: `Slide ${heroSlides.value.length + 1}`
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

// Save Configuration to Backend
const saveLayout = async () => {
  // Validate at least one slide with an image
  const validSlides = heroSlides.value.filter(s => Boolean(s.image && s.image.trim()))
  if (!validSlides.length) {
    alert('Please provide at least one slide with a valid image.')
    return
  }

  const authToken = token.value || (process.client ? (localStorage.getItem('auth_token') || useCookie('auth_token').value) : '')
  if (!authToken) {
    alert('Your session has expired. Please log in again.')
    router.push('/login')
    return
  }

  isSaving.value = true
  saveMessage.value = ''

  try {
    const payload = {
      hero_slides: validSlides
    }

    const res = await $fetch(`${config.public.apiBase}/api/web-layout/home`, {
      method: 'POST',
      headers: {
        Authorization: `Bearer ${authToken}`,
        Accept: 'application/json'
      },
      body: payload
    })

    if (res && res.hero_slides) {
      heroSlides.value = res.hero_slides
    }

    saveMessage.value = 'Homepage hero slider images updated and published successfully!'
    saveMessageType.value = 'success'
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
