<template>
  <div class="product-details-page-root">
    <!-- Main product details when loaded -->
    <div class="product-page" v-if="currentProduct">
      <div class="container product-container">
        
        <!-- Top Section -->
        <div class="product-top">
          <!-- Left Column: Gallery -->
          <div class="product-gallery">
            <div class="breadcrumbs">
              <NuxtLink to="/">Home</NuxtLink>
              <span class="sep">&gt;</span>
              <NuxtLink to="/shop">Products</NuxtLink>
              <span class="sep">&gt;</span>
              <NuxtLink :to="'/shop?category=' + encodeURIComponent(currentProduct.category || '')">{{ currentProduct.category || 'Coatings' }}</NuxtLink>
              <span class="sep">&gt;</span>
              <span class="current">{{ currentProduct.name }}</span>
            </div>

            <div class="main-image-wrap">
              <div class="badge-best-seller" v-if="currentProduct.is_best_seller">FEATURED</div>
              <button class="nav-arrow left-arrow" v-if="galleryImages.length > 1" @click="prevImage" aria-label="Previous image">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" /></svg>
              </button>
              <img :src="displayedImage" :alt="currentProduct.name" class="main-image" />
              <button class="nav-arrow right-arrow" v-if="galleryImages.length > 1" @click="nextImage" aria-label="Next image">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
              </button>
            </div>

            <!-- Thumbnails -->
            <div class="thumbnails" v-if="galleryImages.length > 1">
              <div 
                class="thumb" 
                v-for="(img, idx) in galleryImages" 
                :key="idx"
                :class="{ active: currentImageIndex === idx }"
                @click="currentImageIndex = idx"
              >
                <img :src="img" :alt="`${currentProduct.name} - View ${idx + 1}`" />
              </div>
            </div>
          </div>

          <!-- Right Column: Info -->
          <div class="product-info">
            <div class="category-pill-wrap">
              <span class="category-pill">{{ currentProduct.category || 'Universal Coating' }}</span>
              <span class="stock-pill" :class="currentProduct.is_in_stock ? 'in-stock' : 'out-stock'">
                <span class="dot"></span> {{ currentProduct.is_in_stock ? 'In Stock & Available' : 'Made to Order' }}
              </span>
            </div>

            <h1 class="product-title">{{ currentProduct.name }}</h1>
            <p class="product-subtitle" v-if="currentProduct.subtitle">{{ currentProduct.subtitle }}</p>

            <!-- Highlights Bar -->
            <div class="product-highlights">
              <div class="highlight-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                <span>100% Original Formula</span>
              </div>
              <div class="highlight-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" /></svg>
                <span>Islandwide Delivery</span>
              </div>
              <div class="highlight-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                <span>Wholesale & Trade Rates</span>
              </div>
            </div>

            <!-- Short Description -->
            <p class="description-short">{{ shortDescription }}</p>

            <!-- Key Feature Pills -->
            <div class="feature-pills" v-if="featuresList.length > 0">
              <span class="feat-pill" v-for="(feat, idx) in featuresList.slice(0, 6)" :key="idx">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" /></svg>
                {{ feat }}
              </span>
            </div>

            <!-- Pack Sizes -->
            <div class="selection-group" v-if="packSizes.length > 0">
              <h4 class="selection-title">Available Pack Sizes:</h4>
              <div class="pack-options">
                <div 
                  class="pack-box" 
                  v-for="pack in packSizes" 
                  :key="pack"
                  :class="{ active: selectedPack === pack }"
                  @click="selectedPack = pack"
                >
                  <span class="pack-size">{{ pack }}</span>
                </div>
              </div>
            </div>

            <!-- CTA Buttons -->
            <div class="actions-group">
              <button class="btn btn-red btn-quote" @click="openQuoteModal">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a.75.75 0 0 1-.974-.94 4.053 4.053 0 0 0 .546-1.382A8.957 8.957 0 0 1 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" /></svg>
                Request a Free Quote
              </button>
              <a :href="whatsappUrl" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp">
                <i class="fa-brands fa-whatsapp text-lg"></i>
                WhatsApp Inquiry
              </a>
            </div>

            <!-- Sales Rep Locator Link -->
            <div class="reps-box">
              <div class="reps-box-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" /></svg>
              </div>
              <div class="reps-box-text">
                <strong>Need trade pricing or delivery in your area?</strong>
                <p>Connect with your assigned Universal Paints district representative.</p>
              </div>
              <NuxtLink to="/sales-representatives" class="btn-rep-link">
                Find Rep &rarr;
              </NuxtLink>
            </div>
          </div>
        </div>

        <!-- Tabs Section -->
        <div class="product-tabs-section">
          <div class="tabs-nav">
            <button 
              class="tab-btn" 
              :class="{ active: activeTab === 'description' }"
              @click="activeTab = 'description'"
            >
              Description & Overview
            </button>
            <button 
              class="tab-btn" 
              :class="{ active: activeTab === 'features' }"
              @click="activeTab = 'features'"
            >
              Key Features ({{ featuresList.length }})
            </button>
            <button 
              class="tab-btn" 
              :class="{ active: activeTab === 'application' }"
              @click="activeTab = 'application'"
            >
              Application & Preparation
            </button>
          </div>

          <div class="tab-content">
            <!-- Description Tab -->
            <div class="tab-pane" v-if="activeTab === 'description'">
              <div class="content-body" v-html="formattedDescription"></div>
            </div>

            <!-- Key Features Tab -->
            <div class="tab-pane" v-if="activeTab === 'features'">
              <div class="features-grid-list" v-if="featuresList.length > 0">
                <div class="feat-card" v-for="(feat, idx) in featuresList" :key="idx">
                  <div class="feat-check">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                  </div>
                  <span>{{ feat }}</span>
                </div>
              </div>
              <p v-else class="text-gray-500">Contact our technical department for detailed specifications.</p>
            </div>

            <!-- Application Tab -->
            <div class="tab-pane" v-if="activeTab === 'application'">
              <div class="app-steps">
                <div class="app-step">
                  <span class="step-num">1</span>
                  <div>
                    <h4>Surface Preparation</h4>
                    <p>Ensure the substrate is clean, dry, and free of dirt, oil, efflorescence, grease, and loose paint flakes. Repair cracks with Universal Paints Premium Wall Filler.</p>
                  </div>
                </div>
                <div class="app-step">
                  <span class="step-num">2</span>
                  <div>
                    <h4>Primer Application</h4>
                    <p>Apply one coat of suitable Universal Paints Primer / Undercoat to seal porous masonry surfaces and ensure maximum adhesion and topcoat longevity.</p>
                  </div>
                </div>
                <div class="app-step">
                  <span class="step-num">3</span>
                  <div>
                    <h4>Topcoat Application</h4>
                    <p>Stir paint thoroughly before use. Apply 2 uniform coats using roller, brush, or spray equipment. Allow 3 to 4 hours drying time between coats.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Related Products -->
      <section class="related-section container" v-if="relatedProducts.length > 0">
        <div class="related-header">
          <div>
            <span class="sub-label">Recommended for you</span>
            <h2 class="section-title">Explore Related Coatings</h2>
          </div>
          <NuxtLink to="/shop" class="view-all-link">View Full Catalog &rarr;</NuxtLink>
        </div>
        <div class="related-grid">
          <div class="product-card" v-for="rel in relatedProducts" :key="rel.id">
            <NuxtLink :to="`/shop/${rel.id}`" class="product-img-wrap">
              <img :src="rel.main_image || '/images/logo/Logo.webp'" :alt="rel.name" loading="lazy" />
            </NuxtLink>
            <div class="rel-info">
              <span class="rel-cat">{{ rel.category || 'Coating' }}</span>
              <h4>
                <NuxtLink :to="`/shop/${rel.id}`">{{ rel.name }}</NuxtLink>
              </h4>
              <NuxtLink :to="`/shop/${rel.id}`" class="btn-view-more">
                View More &rarr;
              </NuxtLink>
            </div>
          </div>
        </div>
      </section>
    </div>

    <!-- Loading State -->
    <div class="loading-state container py-20 text-center" v-else-if="pending">
      <div class="spinner"></div>
      <p class="mt-4 text-gray-600 font-semibold">Loading product details...</p>
    </div>

    <!-- Error State -->
    <div class="error-state container py-20 text-center" v-else>
      <h2 class="text-2xl font-bold text-gray-900 mb-2">Product Not Found</h2>
      <p class="text-gray-500 mb-6">The requested product could not be loaded or may have been updated.</p>
      <NuxtLink to="/shop" class="btn btn-red inline-block">Return to Catalog</NuxtLink>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const route = useRoute()
const config = useRuntimeConfig()

const cleanApiBase = computed(() => (config.public.apiBase || 'https://api.universalpaints.lk').replace(/\/api\/?$/, ''))

// Fetch current product with lazy: true so client route navigation occurs immediately without freezing
const { data: productData, pending, error } = await useFetch(
  () => `${cleanApiBase.value}/api/products/${route.params.id}`,
  {
    key: `product-${route.params.id}`,
    lazy: true
  }
)

const currentProduct = computed(() => {
  const val = productData.value
  if (!val) return null
  return val.data || val
})

// Fetch related products (lazy)
const { data: allProductsData } = await useFetch(
  () => `${cleanApiBase.value}/api/products`,
  {
    key: 'all-products-for-related',
    lazy: true
  }
)

const relatedProducts = computed(() => {
  const list = Array.isArray(allProductsData.value) ? allProductsData.value : (allProductsData.value?.data || [])
  return list.filter(p => String(p.id) !== String(route.params.id)).slice(0, 4)
})

// Gallery Images
const currentImageIndex = ref(0)
const galleryImages = computed(() => {
  if (!currentProduct.value) return ['/images/logo/Logo.webp']
  const imgs = []
  if (currentProduct.value.main_image) {
    imgs.push(currentProduct.value.main_image)
  }
  let gallery = currentProduct.value.gallery
  if (typeof gallery === 'string') {
    try {
      gallery = JSON.parse(gallery)
    } catch (e) {
      gallery = []
    }
  }
  if (Array.isArray(gallery)) {
    gallery.forEach(img => {
      if (img && !imgs.includes(img)) imgs.push(img)
    })
  }
  return imgs.length > 0 ? imgs : ['/images/logo/Logo.webp']
})

const displayedImage = computed(() => {
  return galleryImages.value[currentImageIndex.value] || currentProduct.value?.main_image || '/images/logo/Logo.webp'
})

const nextImage = () => {
  if (galleryImages.value.length <= 1) return
  currentImageIndex.value = (currentImageIndex.value + 1) % galleryImages.value.length
}

const prevImage = () => {
  if (galleryImages.value.length <= 1) return
  currentImageIndex.value = (currentImageIndex.value - 1 + galleryImages.value.length) % galleryImages.value.length
}

// Active Tab
const activeTab = ref('description')

// Features
const featuresList = computed(() => {
  if (!currentProduct.value) return []
  let feats = currentProduct.value.features
  if (typeof feats === 'string') {
    try {
      feats = JSON.parse(feats)
    } catch (e) {
      feats = []
    }
  }
  return Array.isArray(feats) ? feats : []
})

// Pack sizes
const packSizes = computed(() => {
  if (!currentProduct.value) return ['1L', '4L', '10L', '20L']
  let packs = currentProduct.value.pack_sizes
  if (typeof packs === 'string') {
    try {
      packs = JSON.parse(packs)
    } catch (e) {
      packs = []
    }
  }
  if (Array.isArray(packs) && packs.length > 0) {
    return packs.map(p => typeof p === 'object' && p ? p.size || String(p) : String(p))
  }
  return ['1L', '4L', '10L', '20L']
})

const selectedPack = ref('4L')

// Formatting
const shortDescription = computed(() => {
  if (!currentProduct.value?.description) return ''
  const firstPara = currentProduct.value.description.split('\n')[0]
  return firstPara.length > 250 ? firstPara.substring(0, 250) + '...' : firstPara
})

const formattedDescription = computed(() => {
  if (!currentProduct.value?.description) return '<p>No description provided.</p>'
  return currentProduct.value.description
    .split('\n\n')
    .map(p => `<p class="mb-4 leading-relaxed">${p.replace(/\n/g, '<br/>')}</p>`)
    .join('')
})

// Quote modal state
const isQuotePopupOpen = useState('quotePopup', () => false)
const openQuoteModal = () => {
  isQuotePopupOpen.value = true
}

// WhatsApp link
const whatsappUrl = computed(() => {
  const name = currentProduct.value?.name || 'paint product'
  const text = encodeURIComponent(`Hello Universal Paints! I am interested in getting a price quotation and dealer information for: ${name}.`)
  return `https://wa.me/94112099055?text=${text}`
})

// SEO & Structured Data
const pageTitle = computed(() => currentProduct.value?.name ? `${currentProduct.value.name} | Universal Paints Sri Lanka` : 'Paint Product Details | Universal Paints')
const pageDesc = computed(() => currentProduct.value?.description ? currentProduct.value.description.substring(0, 160).replace(/\s+/g, ' ').trim() : 'Premium architectural and decorative coatings by Universal Paints Sri Lanka.')
const pageImage = computed(() => displayedImage.value)
const canonicalUrl = computed(() => `https://universalpaints.lk/shop/${route.params.id}`)

useSeoMeta({
  title: () => pageTitle.value,
  ogTitle: () => pageTitle.value,
  description: () => pageDesc.value,
  ogDescription: () => pageDesc.value,
  ogImage: () => pageImage.value,
  ogUrl: () => canonicalUrl.value,
  ogType: 'product',
  twitterCard: 'summary_large_image',
  twitterTitle: () => pageTitle.value,
  twitterDescription: () => pageDesc.value,
  twitterImage: () => pageImage.value
})

useHead(() => ({
  link: [
    { rel: 'canonical', href: canonicalUrl.value }
  ],
  script: currentProduct.value ? [
    {
      type: 'application/ld+json',
      innerHTML: JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'Product',
        name: currentProduct.value.name,
        image: galleryImages.value,
        description: pageDesc.value,
        sku: `UP-${route.params.id}`,
        brand: {
          '@type': 'Brand',
          name: 'Universal Paints'
        },
        offers: {
          '@type': 'AggregateOffer',
          priceCurrency: 'LKR',
          availability: currentProduct.value.is_in_stock ? 'https://schema.org/InStock' : 'https://schema.org/PreOrder',
          seller: {
            '@type': 'Organization',
            name: 'Universal Paints (Pvt) Ltd',
            url: 'https://universalpaints.lk'
          }
        }
      })
    }
  ] : []
}))
</script>

<style scoped>
.product-page {
  padding: 50px 0 80px;
  background-color: #F8FAFC;
}
.product-container {
  background: white;
  border-radius: 24px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
  border: 1px solid #F1F5F9;
  overflow: hidden;
}
.product-top {
  display: grid;
  grid-template-columns: 1.05fr 1fr;
  gap: 50px;
  padding: 40px;
}

/* Left Column: Gallery */
.breadcrumbs {
  font-size: 13px;
  color: #64748B;
  display: flex;
  align-items: center;
  flex-wrap: wrap;
  gap: 8px;
  margin-bottom: 20px;
}
.breadcrumbs a { color: #64748B; text-decoration: none; transition: color 0.2s; }
.breadcrumbs a:hover { color: #E3000F; }
.breadcrumbs .current { color: #0F172A; font-weight: 600; }
.sep { color: #CBD5E1; }

.main-image-wrap {
  position: relative;
  background: #F8FAFC;
  border-radius: 20px;
  border: 1px solid #E2E8F0;
  display: flex;
  justify-content: center;
  align-items: center;
  aspect-ratio: 16 / 10;
  max-height: 480px;
  overflow: hidden;
  margin-bottom: 16px;
}
.main-image {
  width: 100%;
  height: 100%;
  object-fit: contain;
  padding: 16px;
  transition: transform 0.3s ease;
}
.main-image:hover {
  transform: scale(1.02);
}
.badge-best-seller {
  position: absolute;
  top: 16px;
  left: 16px;
  background: #E3000F;
  color: white;
  font-weight: 800;
  font-size: 11px;
  letter-spacing: 0.5px;
  padding: 6px 14px;
  border-radius: 30px;
  box-shadow: 0 4px 10px rgba(227, 0, 15, 0.3);
}
.nav-arrow {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: white;
  border: 1px solid #E2E8F0;
  width: 42px;
  height: 42px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  color: #475569;
  box-shadow: 0 4px 12px rgba(0,0,0,0.08);
  transition: all 0.2s;
}
.nav-arrow:hover {
  background: #E3000F;
  color: white;
  border-color: #E3000F;
}
.left-arrow { left: 16px; }
.right-arrow { right: 16px; }
.nav-arrow svg { width: 20px; height: 20px; }

.thumbnails {
  display: flex;
  gap: 12px;
  overflow-x: auto;
  padding-bottom: 4px;
}
.thumb {
  width: 80px;
  height: 80px;
  flex-shrink: 0;
  border-radius: 12px;
  border: 2px solid #E2E8F0;
  background: #F8FAFC;
  overflow: hidden;
  cursor: pointer;
  transition: all 0.2s;
}
.thumb img { width: 100%; height: 100%; object-fit: cover; }
.thumb:hover { border-color: #CBD5E1; }
.thumb.active { border-color: #E3000F; box-shadow: 0 0 0 1px #E3000F; }

/* Right Column: Info */
.product-info {
  display: flex;
  flex-direction: column;
}
.category-pill-wrap {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 12px;
}
.category-pill {
  display: inline-block;
  background: #FEF2F2;
  color: #E3000F;
  font-size: 12px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  padding: 4px 12px;
  border-radius: 20px;
}
.stock-pill {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: 12px;
  font-weight: 600;
  padding: 4px 12px;
  border-radius: 20px;
}
.stock-pill .dot { width: 8px; height: 8px; border-radius: 50%; }
.stock-pill.in-stock { background: #ECFDF5; color: #059669; }
.stock-pill.in-stock .dot { background: #10B981; }
.stock-pill.out-stock { background: #FFF7ED; color: #D97706; }
.stock-pill.out-stock .dot { background: #F59E0B; }

.product-title {
  font-size: 32px;
  font-weight: 800;
  color: #0F172A;
  line-height: 1.25;
  margin: 0 0 10px 0;
}
.product-subtitle {
  font-size: 15px;
  color: #64748B;
  margin: 0 0 20px 0;
}

.product-highlights {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 12px;
  background: #F8FAFC;
  border: 1px solid #F1F5F9;
  border-radius: 12px;
  padding: 14px;
  margin-bottom: 24px;
}
.highlight-item {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 12px;
  font-weight: 600;
  color: #334155;
}
.highlight-item svg { width: 18px; height: 18px; color: #E3000F; flex-shrink: 0; }

.description-short {
  font-size: 15px;
  color: #475569;
  line-height: 1.6;
  margin-bottom: 20px;
}

.feature-pills {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-bottom: 24px;
}
.feat-pill {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: #F1F5F9;
  color: #1E293B;
  font-size: 12px;
  font-weight: 600;
  padding: 6px 12px;
  border-radius: 8px;
}
.feat-pill svg { color: #10B981; width: 14px; height: 14px; }

.selection-group {
  margin-bottom: 24px;
}
.selection-title {
  font-size: 14px;
  font-weight: 700;
  color: #0F172A;
  margin: 0 0 10px 0;
}
.pack-options {
  display: flex;
  gap: 10px;
}
.pack-box {
  padding: 8px 18px;
  border: 1.5px solid #E2E8F0;
  border-radius: 10px;
  cursor: pointer;
  background: white;
  transition: all 0.2s;
}
.pack-box:hover { border-color: #CBD5E1; }
.pack-box.active {
  border-color: #E3000F;
  background: #FEF2F2;
  color: #E3000F;
}
.pack-size { font-size: 14px; font-weight: 700; }

.actions-group {
  display: flex;
  gap: 14px;
  margin-bottom: 24px;
}
.btn {
  height: 50px;
  padding: 0 24px;
  border-radius: 30px;
  font-size: 15px;
  font-weight: 700;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  text-decoration: none;
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  border: none;
}
.btn-red {
  background: #E3000F;
  color: white;
  box-shadow: 0 6px 20px rgba(227, 0, 15, 0.25);
  flex: 1.2;
}
.btn-red:hover {
  background: #C8000D;
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(227, 0, 15, 0.35);
}
.btn-whatsapp {
  background: #25D366;
  color: white;
  box-shadow: 0 6px 20px rgba(37, 211, 102, 0.25);
  flex: 1;
}
.btn-whatsapp:hover {
  background: #20BA5A;
  transform: translateY(-2px);
}

.reps-box {
  background: #F8FAFC;
  border: 1px dashed #CBD5E1;
  border-radius: 16px;
  padding: 16px 20px;
  display: flex;
  align-items: center;
  gap: 16px;
  margin-top: auto;
}
.reps-box-icon {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: #FEF2F2;
  color: #E3000F;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.reps-box-icon svg { width: 22px; height: 22px; }
.reps-box-text { flex-grow: 1; }
.reps-box-text strong { display: block; font-size: 13px; color: #0F172A; }
.reps-box-text p { font-size: 12px; color: #64748B; margin: 2px 0 0; }
.btn-rep-link {
  color: #E3000F;
  font-size: 13px;
  font-weight: 700;
  text-decoration: none;
  white-space: nowrap;
  padding: 6px 12px;
  background: white;
  border: 1px solid #FCA5A5;
  border-radius: 20px;
  transition: all 0.2s;
}
.btn-rep-link:hover {
  background: #E3000F;
  color: white;
}

/* Tabs Section */
.product-tabs-section {
  padding: 40px;
  border-top: 1px solid #F1F5F9;
}
.tabs-nav {
  display: flex;
  border-bottom: 2px solid #F1F5F9;
  gap: 32px;
  margin-bottom: 30px;
  overflow-x: auto;
}
.tab-btn {
  background: none;
  border: none;
  padding: 0 0 16px 0;
  font-size: 15px;
  font-weight: 600;
  color: #64748B;
  cursor: pointer;
  border-bottom: 3px solid transparent;
  margin-bottom: -2px;
  white-space: nowrap;
  transition: all 0.2s;
}
.tab-btn:hover { color: #0F172A; }
.tab-btn.active {
  color: #E3000F;
  border-bottom-color: #E3000F;
  font-weight: 700;
}

.content-body {
  font-size: 15px;
  color: #475569;
  line-height: 1.7;
  max-width: 900px;
}

.features-grid-list {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 16px;
}
.feat-card {
  display: flex;
  align-items: center;
  gap: 14px;
  padding: 16px 20px;
  background: #F8FAFC;
  border-radius: 12px;
  border: 1px solid #F1F5F9;
}
.feat-check {
  width: 28px;
  height: 28px;
  border-radius: 50%;
  background: #ECFDF5;
  color: #10B981;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.feat-check svg { width: 16px; height: 16px; }
.feat-card span { font-size: 14px; font-weight: 600; color: #1E293B; }

.app-steps {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
}
.app-step {
  background: #F8FAFC;
  border-radius: 16px;
  padding: 24px;
  border: 1px solid #F1F5F9;
  position: relative;
}
.step-num {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 36px;
  height: 36px;
  border-radius: 10px;
  background: #E3000F;
  color: white;
  font-weight: 800;
  font-size: 16px;
  margin-bottom: 16px;
}
.app-step h4 { font-size: 16px; font-weight: 700; color: #0F172A; margin: 0 0 8px; }
.app-step p { font-size: 13px; color: #64748B; line-height: 1.6; margin: 0; }

/* Related Section */
.related-section {
  margin-top: 60px;
}
.related-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
  margin-bottom: 30px;
}
.sub-label {
  font-size: 13px;
  font-weight: 700;
  text-transform: uppercase;
  color: #E3000F;
  letter-spacing: 1px;
}
.section-title {
  font-size: 28px;
  font-weight: 800;
  color: #0F172A;
  margin: 4px 0 0;
}
.view-all-link {
  font-size: 14px;
  font-weight: 700;
  color: #E3000F;
  text-decoration: none;
}
.related-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 24px;
}
.product-card {
  background: white;
  border-radius: 16px;
  border: 1px solid #F1F5F9;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}
.product-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 16px 32px rgba(0, 0, 0, 0.08);
}
.product-img-wrap {
  width: 100%;
  aspect-ratio: 16 / 9;
  background-color: #F8FAFC;
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
  text-decoration: none;
}
.product-img-wrap img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s ease;
}
.product-card:hover .product-img-wrap img {
  transform: scale(1.04);
}
.rel-info {
  padding: 16px;
  display: flex;
  flex-direction: column;
  flex-grow: 1;
}
.rel-cat {
  font-size: 11px;
  font-weight: 700;
  text-transform: uppercase;
  color: #E3000F;
  margin-bottom: 4px;
}
.rel-info h4 {
  font-size: 14px;
  font-weight: 700;
  margin: 0 0 14px;
  line-height: 1.4;
  flex-grow: 1;
}
.rel-info h4 a {
  color: #0F172A;
  text-decoration: none;
  transition: color 0.2s;
}
.rel-info h4 a:hover { color: #E3000F; }
.btn-view-more {
  display: block;
  text-align: center;
  padding: 8px 14px;
  border: 1px solid #E3000F;
  color: #E3000F;
  border-radius: 30px;
  font-size: 13px;
  font-weight: 700;
  text-decoration: none;
  transition: all 0.2s;
}
.btn-view-more:hover {
  background: #E3000F;
  color: white;
}

.spinner {
  width: 44px;
  height: 44px;
  border: 4px solid #F3F4F6;
  border-top-color: #E3000F;
  border-radius: 50%;
  animation: spin 0.8s linear infinite;
  margin: 0 auto;
}
@keyframes spin {
  to { transform: rotate(360deg); }
}

@media (max-width: 991px) {
  .product-top { grid-template-columns: 1fr; gap: 30px; padding: 24px; }
  .product-highlights { grid-template-columns: 1fr; }
  .features-grid-list { grid-template-columns: 1fr; }
  .app-steps { grid-template-columns: 1fr; }
  .related-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 640px) {
  .actions-group { flex-direction: column; }
  .related-grid { grid-template-columns: 1fr; }
  .product-tabs-section { padding: 24px 16px; }
  .product-title { font-size: 24px; }
}
</style>