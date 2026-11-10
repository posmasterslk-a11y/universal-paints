<template>
  <div class="sales-reps-page">
    <!-- Hero Banner -->
    <section class="reps-hero">
      <div class="hero-pattern"></div>
      <div class="container hero-content">
        <span class="hero-badge">
          <i class="fa-solid fa-map-location-dot"></i> Island-wide Sales Network
        </span>
        <h1 class="hero-title">
          Find Your Local <span class="text-red-highlight">Sales Representative</span>
        </h1>
        <p class="hero-desc">
          Select any district on our interactive Sri Lanka map or search below to connect directly with dedicated Universal Paints area representatives.
        </p>
      </div>
    </section>

    <!-- Main Content Section -->
    <section class="reps-main">
      <div class="container">
        <!-- Search & Filter Card -->
        <div class="filter-card">
          <div class="filter-top-bar">
            <!-- Search Bar -->
            <div class="search-input-wrap">
              <i class="fa-solid fa-magnifying-glass search-icon"></i>
              <input 
                type="text" 
                v-model="searchQuery" 
                placeholder="Search representative name, district, or phone number..." 
                class="search-input"
              />
            </div>

            <!-- District Dropdown & Reset -->
            <div class="filter-controls">
              <select v-model="selectedDistrict" class="district-select">
                <option value="">All Sri Lankan Districts</option>
                <option v-for="d in allDistricts" :key="d" :value="d">
                  {{ d }} ({{ repsCountByDistrict[d] || 0 }} {{ repsCountByDistrict[d] === 1 ? 'Rep' : 'Reps' }})
                </option>
              </select>

              <button 
                v-if="selectedDistrict || searchQuery || selectedProvince" 
                @click="clearFilters" 
                class="btn-reset"
              >
                <i class="fa-solid fa-rotate-left"></i> Reset
              </button>
            </div>
          </div>

          <!-- Province Quick Filters -->
          <div class="province-bar">
            <span class="province-label">Provinces:</span>
            <div class="province-buttons">
              <button 
                @click="selectedProvince = ''" 
                :class="['pill-btn', !selectedProvince ? 'pill-active' : '']"
              >
                All Provinces
              </button>
              <button 
                v-for="prov in provincesList" 
                :key="prov" 
                @click="selectProvince(prov)"
                :class="['pill-btn', selectedProvince === prov ? 'pill-active' : '']"
              >
                {{ prov }}
              </button>
            </div>
          </div>
        </div>

        <!-- 2-Column Layout: Interactive Map + Representatives List -->
        <div class="content-layout">
          <!-- Left Column: Sri Lanka Interactive Map (Sticky) -->
          <div class="map-sidebar">
            <div class="map-header">
              <div>
                <h3 class="map-title">
                  <i class="fa-solid fa-map"></i>
                  <span>Interactive Sri Lanka Map</span>
                </h3>
                <p class="map-subtitle">Tap or click any district to show reps</p>
              </div>

              <span v-if="selectedDistrict" class="selected-district-chip">
                <span>{{ selectedDistrict }}</span>
                <button @click="selectedDistrict = ''" class="chip-remove" title="Clear district">
                  <i class="fa-solid fa-xmark"></i>
                </button>
              </span>
            </div>

            <!-- SVG Map Component -->
            <div class="map-wrapper-box">
              <SriLankaMap 
                :selectedDistrict="selectedDistrict" 
                :repsCount="repsCountByDistrict"
                @select="handleDistrictClick" 
              />
            </div>

            <!-- Map Legend -->
            <div class="map-legend">
              <div class="legend-item">
                <span class="legend-dot dot-selected"></span>
                <span class="legend-text font-bold">Selected</span>
              </div>
              <div class="legend-item">
                <span class="legend-dot dot-rep"></span>
                <span class="legend-text">Rep Available</span>
              </div>
              <div class="legend-item">
                <span class="legend-dot dot-hotline"></span>
                <span class="legend-text">Hotline Coverage</span>
              </div>
            </div>
          </div>

          <!-- Right Column: Representatives Cards -->
          <div class="reps-column">
            <!-- Active Selection Header -->
            <div class="reps-header-card">
              <div>
                <div class="reps-header-sub">Viewing Representatives For:</div>
                <h2 class="reps-header-title">
                  <span>{{ selectedDistrict || (selectedProvince ? selectedProvince : 'All Sri Lanka') }}</span>
                  <span class="count-badge">{{ displayedReps.length }} Available</span>
                </h2>
              </div>

              <button 
                v-if="selectedDistrict || selectedProvince" 
                @click="clearFilters" 
                class="btn-view-all"
              >
                View All Reps
              </button>
            </div>

            <!-- Loading State -->
            <div v-if="pending" class="loading-state">
              <i class="fa-solid fa-circle-notch fa-spin loading-icon"></i>
              <p>Fetching sales network...</p>
            </div>

            <!-- Representatives List -->
            <div v-else-if="displayedReps.length > 0" class="reps-list">
              <div 
                v-for="rep in displayedReps" 
                :key="rep.id" 
                class="rep-card"
              >
                <div class="rep-main-row">
                  <!-- Photo -->
                  <div class="rep-avatar">
                    <img 
                      :src="getRepImage(rep.image)" 
                      :alt="rep.name" 
                      @error="(e) => e.target.src = 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=300&auto=format&fit=crop&q=80'"
                    />
                  </div>

                  <!-- Details -->
                  <div class="rep-info">
                    <div class="rep-title-row">
                      <h3 class="rep-name">{{ rep.name }}</h3>
                      <span class="rep-designation">
                        {{ rep.designation || 'Area Representative' }}
                      </span>
                    </div>

                    <p v-if="rep.notes" class="rep-notes">
                      {{ rep.notes }}
                    </p>

                    <!-- Covered Districts -->
                    <div class="rep-districts">
                      <span class="districts-label">Covering:</span>
                      <div class="district-chips">
                        <span 
                          v-for="dist in (rep.districts || [])" 
                          :key="dist" 
                          :class="['district-chip', dist === selectedDistrict ? 'chip-highlight' : '']"
                        >
                          {{ dist }}
                        </span>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Contact CTAs -->
                <div class="rep-actions">
                  <!-- Call Button -->
                  <a 
                    :href="`tel:${cleanPhone(rep.phone)}`" 
                    class="action-btn btn-call"
                  >
                    <i class="fa-solid fa-phone"></i>
                    <span>Call Now ({{ rep.phone }})</span>
                  </a>

                  <!-- WhatsApp Button -->
                  <a 
                    v-if="rep.whatsapp || rep.phone" 
                    :href="getWhatsAppLink(rep.whatsapp || rep.phone, rep.name)" 
                    target="_blank" 
                    rel="noopener"
                    class="action-btn btn-whatsapp"
                  >
                    <i class="fa-brands fa-whatsapp"></i>
                    <span>WhatsApp</span>
                  </a>

                  <!-- Email Button -->
                  <a 
                    v-if="rep.email" 
                    :href="`mailto:${rep.email}?subject=Paint Inquiry - Universal Paints`" 
                    class="action-btn btn-email"
                    title="Send Email"
                  >
                    <i class="fa-solid fa-envelope"></i>
                    <span>Email</span>
                  </a>
                </div>
              </div>
            </div>

            <!-- Fallback Card (When no representative is specifically assigned) -->
            <div v-else class="fallback-card">
              <div class="fallback-icon">
                <i class="fa-solid fa-building-circle-check"></i>
              </div>

              <div class="fallback-text">
                <h3 class="fallback-title">
                  Head Office Coverage for {{ selectedDistrict || 'this area' }}
                </h3>
                <p class="fallback-desc">
                  Universal Paints operates seamless island-wide distribution across all 25 districts. Our Central Sales Desk and technical engineers provide immediate support, wholesale quotes, and site consultations.
                </p>
              </div>

              <div class="fallback-actions">
                <a href="tel:+94112345678" class="btn btn-primary fallback-call">
                  <i class="fa-solid fa-phone"></i>
                  <span>Call Central Sales: +94 11 234 5678</span>
                </a>
                <button @click="openQuoteModal" class="btn btn-outline fallback-quote">
                  <i class="fa-solid fa-file-invoice"></i>
                  <span>Request a Quotation</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Island-wide Services Highlight -->
    <section class="services-highlight">
      <div class="container">
        <div class="section-header">
          <h2 class="section-title-custom">Why Contact a Universal Paints Representative?</h2>
          <p class="section-subtitle-custom">Direct assistance designed for homeowners, contractors, architects, and hardware retail dealers.</p>
        </div>

        <div class="services-grid">
          <div class="service-box">
            <div class="service-icon">
              <i class="fa-solid fa-compass-drafting"></i>
            </div>
            <h3 class="service-name">Free Technical Site Visits</h3>
            <p class="service-desc">
              Our area executives visit your construction site or facility to inspect wall conditions, moisture levels, and recommend accurate surface preparations.
            </p>
          </div>

          <div class="service-box">
            <div class="service-icon">
              <i class="fa-solid fa-truck-fast"></i>
            </div>
            <h3 class="service-name">Fast Island-wide Dispatch</h3>
            <p class="service-desc">
              Timely delivery directly from our manufacturing facilities and regional warehouses straight to your hardware shop or project site.
            </p>
          </div>

          <div class="service-box">
            <div class="service-icon">
              <i class="fa-solid fa-handshake-angle"></i>
            </div>
            <h3 class="service-name">Contractor & Dealer Pricing</h3>
            <p class="service-desc">
              Access wholesale bulk discounts, promotional color fans, marketing materials, and flexible payment terms for verified partners.
            </p>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import SriLankaMap from '~/components/SriLankaMap.vue'

const config = useRuntimeConfig()
const cleanApiBase = computed(() => (config.public.apiBase || 'https://api.universalpaints.lk').replace(/\/api\/?$/, ''))
const isQuotePopupOpen = useState('quotePopup', () => false)

useHead({
  title: 'Sales Representatives | Universal Paints Sri Lanka',
  meta: [
    { name: 'description', content: 'Connect with local Universal Paints sales representatives across all 25 districts in Sri Lanka. Interactive district map with instant phone and WhatsApp contacts.' }
  ]
})

// Fetch all active representatives from backend
const { data: repsData, pending, error, refresh } = await useFetch(() => `${cleanApiBase.value}/api/sales-reps`, {
  key: 'sales-representatives-list'
})

const reps = computed(() => {
  if (!repsData.value) return []
  return Array.isArray(repsData.value) ? repsData.value : (repsData.value?.data || [])
})

// Client-side hydration retry if SSR payload was empty or failed
onMounted(async () => {
  const currentList = Array.isArray(repsData.value) ? repsData.value : (repsData.value?.data || [])
  if (!currentList.length) {
    try {
      const res = await $fetch(`${cleanApiBase.value}/api/sales-reps`)
      if (res && (Array.isArray(res) ? res.length : res.data?.length)) {
        repsData.value = res
      }
    } catch (err) {
      try {
        const res2 = await $fetch('https://api.universalpaints.lk/api/sales-reps')
        if (res2) repsData.value = res2
      } catch (e) {}
    }
  }
})

// Sri Lanka Geography Reference
const allDistricts = [
  'Colombo', 'Gampaha', 'Kalutara',
  'Kandy', 'Matale', 'Nuwara Eliya',
  'Galle', 'Matara', 'Hambantota',
  'Jaffna', 'Kilinochchi', 'Mannar', 'Vavuniya', 'Mullaitivu',
  'Batticaloa', 'Ampara', 'Trincomalee',
  'Kurunegala', 'Puttalam',
  'Anuradhapura', 'Polonnaruwa',
  'Badulla', 'Monaragala',
  'Ratnapura', 'Kegalle'
]

const provincesMap = {
  'Western': ['Colombo', 'Gampaha', 'Kalutara'],
  'Central': ['Kandy', 'Matale', 'Nuwara Eliya'],
  'Southern': ['Galle', 'Matara', 'Hambantota'],
  'Northern': ['Jaffna', 'Kilinochchi', 'Mannar', 'Vavuniya', 'Mullaitivu'],
  'Eastern': ['Batticaloa', 'Ampara', 'Trincomalee'],
  'North Western': ['Kurunegala', 'Puttalam'],
  'North Central': ['Anuradhapura', 'Polonnaruwa'],
  'Uva': ['Badulla', 'Monaragala'],
  'Sabaragamuwa': ['Ratnapura', 'Kegalle'],
}

const provincesList = Object.keys(provincesMap)

// Count of reps per district for the map
const repsCountByDistrict = computed(() => {
  const counts = {}
  allDistricts.forEach(d => counts[d] = 0)
  reps.value.forEach(rep => {
    if (Array.isArray(rep.districts)) {
      rep.districts.forEach(d => {
        counts[d] = (counts[d] || 0) + 1
      })
    }
  })
  return counts
})

// Active Filters
const selectedDistrict = ref('')
const selectedProvince = ref('')
const searchQuery = ref('')

const handleDistrictClick = (districtName) => {
  if (selectedDistrict.value === districtName) {
    selectedDistrict.value = ''
  } else {
    selectedDistrict.value = districtName
    selectedProvince.value = ''
  }
}

const selectProvince = (prov) => {
  selectedProvince.value = prov
  selectedDistrict.value = ''
}

const clearFilters = () => {
  selectedDistrict.value = ''
  selectedProvince.value = ''
  searchQuery.value = ''
}

// Displayed Reps after filtering
const displayedReps = computed(() => {
  let list = reps.value || []

  if (selectedDistrict.value) {
    list = list.filter(r => Array.isArray(r.districts) && r.districts.includes(selectedDistrict.value))
  } else if (selectedProvince.value) {
    const provDistricts = provincesMap[selectedProvince.value] || []
    list = list.filter(r => Array.isArray(r.districts) && r.districts.some(d => provDistricts.includes(d)))
  }

  if (searchQuery.value.trim()) {
    const q = searchQuery.value.toLowerCase().trim()
    list = list.filter(r => {
      const matchName = (r.name || '').toLowerCase().includes(q)
      const matchPhone = (r.phone || '').toLowerCase().includes(q)
      const matchEmail = (r.email || '').toLowerCase().includes(q)
      const matchDesig = (r.designation || '').toLowerCase().includes(q)
      const matchDist = Array.isArray(r.districts) && r.districts.some(d => d.toLowerCase().includes(q))
      return matchName || matchPhone || matchEmail || matchDesig || matchDist
    })
  }

  return list
})

// Helper methods
const getRepImage = (image) => {
  if (!image) return 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=300&auto=format&fit=crop&q=80'
  if (image.startsWith('http://') || image.startsWith('https://')) return image
  if (image.startsWith('/storage/')) return `${cleanApiBase.value}${image}`
  return image
}

const cleanPhone = (phone) => {
  return (phone || '').replace(/[^0-9+]/g, '')
}

const getWhatsAppLink = (phone, repName) => {
  const clean = (phone || '').replace(/[^0-9]/g, '')
  const msg = encodeURIComponent(`Hello ${repName}, I am inquiring about Universal Paints products.`)
  return `https://wa.me/${clean}?text=${msg}`
}

const openQuoteModal = () => {
  isQuotePopupOpen.value = true
}

useSeoMeta({
  title: 'Find Sales Representatives Across Sri Lanka',
  ogTitle: 'Find Universal Paints Sales Representatives Across Sri Lanka',
  description: 'Connect directly with official Universal Paints sales representatives across all 25 districts of Sri Lanka for trade inquiries, dealer support, and bulk paint orders.',
  ogDescription: 'Connect directly with official Universal Paints sales representatives across all 25 districts of Sri Lanka for trade inquiries, dealer support, and bulk paint orders.',
  ogImage: 'https://universalpaints.lk/images/og-image.jpg',
  ogUrl: 'https://universalpaints.lk/sales-representatives',
  ogType: 'website',
  twitterCard: 'summary_large_image',
  twitterTitle: 'Find Sales Representatives Across Sri Lanka | Universal Paints',
  twitterDescription: 'Direct contact details and WhatsApp for all district paint sales representatives in Sri Lanka.',
  twitterImage: 'https://universalpaints.lk/images/og-image.jpg'
})

useHead({
  link: [
    { rel: 'canonical', href: 'https://universalpaints.lk/sales-representatives' }
  ],
  script: [
    {
      type: 'application/ld+json',
      children: JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'ContactPage',
        name: 'Universal Paints Sales Network',
        description: 'Direct sales representatives directory covering all 9 provinces and 25 districts in Sri Lanka.',
        url: 'https://universalpaints.lk/sales-representatives',
        mainEntity: {
          '@type': 'Organization',
          name: 'Universal Paints (Pvt) Ltd',
          url: 'https://universalpaints.lk',
          areaServed: 'LK'
        }
      })
    }
  ]
})
</script>

<style scoped>
.sales-reps-page {
  width: 100%;
  min-height: 100vh;
  background-color: #F8FAFC;
  color: #1E293B;
  font-family: 'Inter', sans-serif;
}

/* Hero Section */
.reps-hero {
  position: relative;
  background: linear-gradient(135deg, #0F172A 0%, #1E293B 55%, #450A0A 100%);
  color: #FFFFFF;
  padding-top: 140px;
  padding-bottom: 70px;
  padding-left: 20px;
  padding-right: 20px;
  overflow: hidden;
  text-align: center;
}

.hero-pattern {
  position: absolute;
  inset: 0;
  opacity: 0.08;
  background-image: radial-gradient(#FFFFFF 1.5px, transparent 1.5px);
  background-size: 20px 20px;
  pointer-events: none;
}

.hero-content {
  position: relative;
  z-index: 10;
  max-width: 820px;
  margin: 0 auto;
}

.hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 6px 18px;
  border-radius: 9999px;
  font-size: 12px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1.2px;
  background-color: rgba(227, 0, 15, 0.22);
  color: #FCA5A5;
  border: 1px solid rgba(227, 0, 15, 0.35);
  margin-bottom: 22px;
}

.hero-title {
  font-size: clamp(30px, 4.5vw, 52px);
  font-weight: 900;
  letter-spacing: -0.025em;
  line-height: 1.15;
  margin-bottom: 16px;
  color: #FFFFFF;
}

.text-red-highlight {
  color: #E3000F;
  text-shadow: 0 0 30px rgba(227, 0, 15, 0.4);
}

.hero-desc {
  font-size: clamp(15px, 1.8vw, 17px);
  color: #CBD5E1;
  line-height: 1.65;
  max-width: 650px;
  margin: 0 auto;
}

/* Main Section */
.reps-main {
  padding: 48px 0 64px 0;
}

/* Filter Card */
.filter-card {
  background: #FFFFFF;
  border-radius: 20px;
  padding: 24px;
  border: 1px solid #E2E8F0;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
  margin-bottom: 36px;
}

.filter-top-bar {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

@media (min-width: 992px) {
  .filter-top-bar {
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
  }
}

.search-input-wrap {
  position: relative;
  flex: 1;
}

.search-icon {
  position: absolute;
  left: 16px;
  top: 50%;
  transform: translateY(-50%);
  color: #94A3B8;
  font-size: 15px;
}

.search-input {
  width: 100%;
  padding: 13px 18px 13px 44px;
  border-radius: 12px;
  border: 1.5px solid #E2E8F0;
  font-size: 14px;
  color: #1E293B;
  outline: none;
  transition: all 0.2s ease;
  background-color: #F8FAFC;
}

.search-input:focus {
  background-color: #FFFFFF;
  border-color: #E3000F;
  box-shadow: 0 0 0 3px rgba(227, 0, 15, 0.12);
}

.filter-controls {
  display: flex;
  align-items: center;
  gap: 12px;
  flex-wrap: wrap;
}

.district-select {
  padding: 13px 16px;
  border-radius: 12px;
  border: 1.5px solid #E2E8F0;
  font-size: 14px;
  font-weight: 600;
  color: #334155;
  background-color: #FFFFFF;
  outline: none;
  min-width: 220px;
  cursor: pointer;
  transition: all 0.2s ease;
}

.district-select:focus {
  border-color: #E3000F;
}

.btn-reset {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: 13px;
  font-weight: 600;
  color: #64748B;
  background-color: #F1F5F9;
  border: 1px solid #E2E8F0;
  padding: 12px 18px;
  border-radius: 12px;
  cursor: pointer;
  transition: all 0.2s ease;
  white-space: nowrap;
}

.btn-reset:hover {
  background-color: #FEE2E2;
  color: #E3000F;
  border-color: #FCA5A5;
}

/* Province Bar */
.province-bar {
  margin-top: 18px;
  padding-top: 18px;
  border-top: 1px solid #F1F5F9;
  display: flex;
  align-items: center;
  gap: 12px;
  overflow-x: auto;
  scrollbar-width: thin;
}

.province-label {
  font-size: 11px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  color: #94A3B8;
  white-space: nowrap;
}

.province-buttons {
  display: flex;
  align-items: center;
  gap: 8px;
  flex-wrap: nowrap;
}

.pill-btn {
  padding: 6px 14px;
  border-radius: 9999px;
  font-size: 12px;
  font-weight: 600;
  color: #475569;
  background-color: #F1F5F9;
  border: 1px solid transparent;
  cursor: pointer;
  white-space: nowrap;
  transition: all 0.2s ease;
}

.pill-btn:hover {
  background-color: #E2E8F0;
  color: #0F172A;
}

.pill-btn.pill-active {
  background-color: #E3000F;
  color: #FFFFFF;
  box-shadow: 0 2px 8px rgba(227, 0, 15, 0.3);
}

/* 2-Column Content Layout */
.content-layout {
  display: grid;
  grid-template-columns: 1fr;
  gap: 32px;
  align-items: start;
}

@media (min-width: 1024px) {
  .content-layout {
    grid-template-columns: 460px 1fr;
  }
}

/* Left Column: Map Sidebar */
.map-sidebar {
  background: #FFFFFF;
  border-radius: 24px;
  padding: 24px;
  border: 1px solid #E2E8F0;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
}

@media (min-width: 1024px) {
  .map-sidebar {
    position: sticky;
    top: 110px;
  }
}

.map-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 16px;
  padding-bottom: 14px;
  border-bottom: 1px solid #F1F5F9;
}

.map-title {
  font-size: 17px;
  font-weight: 800;
  color: #0F172A;
  display: flex;
  align-items: center;
  gap: 8px;
}

.map-title i {
  color: #E3000F;
}

.map-subtitle {
  font-size: 12px;
  color: #64748B;
  margin-top: 2px;
}

.selected-district-chip {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background-color: #FEE2E2;
  color: #E3000F;
  border: 1px solid #FCA5A5;
  padding: 4px 10px;
  border-radius: 9999px;
  font-size: 12px;
  font-weight: 700;
}

.chip-remove {
  background: none;
  border: none;
  color: #E3000F;
  cursor: pointer;
  padding: 2px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
}

.chip-remove:hover {
  background-color: #E3000F;
  color: #FFFFFF;
}

.map-wrapper-box {
  background: #F8FAFC;
  border-radius: 18px;
  border: 1px solid #E2E8F0;
  padding: 12px;
  display: flex;
  justify-content: center;
  align-items: center;
}

/* Map Legend */
.map-legend {
  margin-top: 16px;
  padding-top: 14px;
  border-top: 1px solid #F1F5F9;
  display: flex;
  align-items: center;
  justify-content: space-around;
  flex-wrap: wrap;
  gap: 12px;
}

.legend-item {
  display: flex;
  align-items: center;
  gap: 6px;
}

.legend-dot {
  width: 14px;
  height: 14px;
  border-radius: 4px;
  display: inline-block;
}

.dot-selected {
  background-color: #E3000F;
  box-shadow: 0 1px 4px rgba(227, 0, 15, 0.4);
}

.dot-rep {
  background-color: #FEE2E2;
  border: 1px solid #F87171;
}

.dot-hotline {
  background-color: #E2E8F0;
  border: 1px solid #94A3B8;
}

.legend-text {
  font-size: 12px;
  color: #475569;
}

.legend-text.font-bold {
  font-weight: 700;
  color: #0F172A;
}

/* Right Column: Reps Column */
.reps-column {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

/* Header Card */
.reps-header-card {
  background: #FFFFFF;
  border-radius: 18px;
  padding: 18px 24px;
  border: 1px solid #E2E8F0;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.reps-header-sub {
  font-size: 11px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  color: #94A3B8;
}

.reps-header-title {
  font-size: 22px;
  font-weight: 900;
  color: #0F172A;
  display: flex;
  align-items: center;
  gap: 10px;
  margin-top: 2px;
}

.count-badge {
  font-size: 12px;
  font-weight: 700;
  background-color: #F1F5F9;
  color: #475569;
  padding: 2px 10px;
  border-radius: 9999px;
}

.btn-view-all {
  background-color: #FEE2E2;
  color: #E3000F;
  border: 1px solid #FCA5A5;
  font-size: 12px;
  font-weight: 700;
  padding: 8px 16px;
  border-radius: 10px;
  cursor: pointer;
  transition: all 0.2s ease;
}

.btn-view-all:hover {
  background-color: #E3000F;
  color: #FFFFFF;
}

/* Loading State */
.loading-state {
  background: #FFFFFF;
  border-radius: 18px;
  padding: 50px 20px;
  text-align: center;
  border: 1px solid #E2E8F0;
  color: #64748B;
}

.loading-icon {
  font-size: 32px;
  color: #E3000F;
  margin-bottom: 12px;
}

/* Representatives List */
.reps-list {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.rep-card {
  background: #FFFFFF;
  border-radius: 20px;
  padding: 24px;
  border: 1.5px solid #E2E8F0;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
  transition: all 0.25s ease;
}

.rep-card:hover {
  border-color: #FCA5A5;
  box-shadow: 0 10px 25px -5px rgba(227, 0, 15, 0.12);
  transform: translateY(-2px);
}

.rep-main-row {
  display: flex;
  flex-direction: column;
  gap: 18px;
}

@media (min-width: 576px) {
  .rep-main-row {
    flex-direction: row;
    align-items: center;
  }
}

.rep-avatar {
  width: 76px;
  height: 76px;
  border-radius: 16px;
  overflow: hidden;
  background-color: #F1F5F9;
  border: 2px solid #E2E8F0;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
  flex-shrink: 0;
}

.rep-avatar img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.rep-info {
  flex: 1;
  min-width: 0;
}

.rep-title-row {
  display: flex;
  align-items: center;
  gap: 8px;
  flex-wrap: wrap;
  margin-bottom: 4px;
}

.rep-name {
  font-size: 18px;
  font-weight: 800;
  color: #0F172A;
}

.rep-designation {
  font-size: 11px;
  font-weight: 700;
  padding: 3px 8px;
  border-radius: 6px;
  background-color: #FEE2E2;
  color: #E3000F;
}

.rep-notes {
  font-size: 13px;
  color: #64748B;
  margin-bottom: 8px;
  line-height: 1.45;
}

.rep-districts {
  display: flex;
  align-items: center;
  gap: 6px;
  flex-wrap: wrap;
}

.districts-label {
  font-size: 11px;
  font-weight: 700;
  color: #94A3B8;
  margin-right: 2px;
}

.district-chips {
  display: flex;
  align-items: center;
  gap: 6px;
  flex-wrap: wrap;
}

.district-chip {
  font-size: 11px;
  font-weight: 600;
  padding: 2px 8px;
  border-radius: 9999px;
  background-color: #F1F5F9;
  color: #475569;
  transition: all 0.2s ease;
}

.district-chip.chip-highlight {
  background-color: #E3000F;
  color: #FFFFFF;
  font-weight: 700;
}

/* Rep Action Buttons */
.rep-actions {
  margin-top: 18px;
  padding-top: 16px;
  border-top: 1px solid #F1F5F9;
  display: flex;
  align-items: center;
  gap: 10px;
  flex-wrap: wrap;
}

.action-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  padding: 10px 18px;
  border-radius: 12px;
  font-size: 13px;
  font-weight: 700;
  cursor: pointer;
  transition: all 0.2s ease;
  text-decoration: none;
}

.btn-call {
  background-color: #E3000F;
  color: #FFFFFF;
  box-shadow: 0 3px 10px rgba(227, 0, 15, 0.25);
  flex: 1;
}

@media (min-width: 576px) {
  .btn-call {
    flex: initial;
  }
}

.btn-call:hover {
  background-color: #C4000D;
  box-shadow: 0 5px 15px rgba(227, 0, 15, 0.35);
}

.btn-whatsapp {
  background-color: #16A34A;
  color: #FFFFFF;
  box-shadow: 0 3px 10px rgba(22, 163, 74, 0.25);
}

.btn-whatsapp:hover {
  background-color: #15803D;
  box-shadow: 0 5px 15px rgba(22, 163, 74, 0.35);
}

.btn-email {
  background-color: #F1F5F9;
  color: #334155;
  border: 1px solid #E2E8F0;
}

.btn-email:hover {
  background-color: #E2E8F0;
  color: #0F172A;
}

/* Fallback Card */
.fallback-card {
  background: linear-gradient(135deg, #FFFFFF 0%, #FFF5F5 100%);
  border-radius: 24px;
  padding: 36px 28px;
  border: 2px dashed #FCA5A5;
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 18px;
}

.fallback-icon {
  width: 64px;
  height: 64px;
  border-radius: 50%;
  background-color: #FEE2E2;
  color: #E3000F;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 26px;
}

.fallback-title {
  font-size: 20px;
  font-weight: 800;
  color: #0F172A;
  margin-bottom: 8px;
}

.fallback-desc {
  font-size: 14px;
  color: #64748B;
  max-width: 540px;
  line-height: 1.6;
}

.fallback-actions {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 14px;
  flex-wrap: wrap;
  margin-top: 6px;
}

.fallback-call {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 12px 24px;
  font-size: 14px;
}

.fallback-quote {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 12px 24px;
  font-size: 14px;
}

/* Services Highlight Section */
.services-highlight {
  background: #FFFFFF;
  border-top: 1px solid #E2E8F0;
  padding: 64px 20px;
  margin-top: 48px;
}

.section-header {
  text-align: center;
  max-width: 680px;
  margin: 0 auto 48px auto;
}

.section-title-custom {
  font-size: clamp(24px, 3.5vw, 34px);
  font-weight: 900;
  color: #0F172A;
  margin-bottom: 8px;
}

.section-subtitle-custom {
  font-size: 14px;
  color: #64748B;
}

.services-grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: 28px;
}

@media (min-width: 768px) {
  .services-grid {
    grid-template-columns: repeat(3, 1fr);
  }
}

.service-box {
  background-color: #F8FAFC;
  border: 1px solid #F1F5F9;
  border-radius: 20px;
  padding: 32px 24px;
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
  transition: all 0.25s ease;
}

.service-box:hover {
  background-color: #FFFFFF;
  border-color: #FCA5A5;
  box-shadow: 0 10px 25px -5px rgba(227, 0, 15, 0.1);
  transform: translateY(-4px);
}

.service-icon {
  width: 56px;
  height: 56px;
  border-radius: 16px;
  background-color: #E3000F;
  color: #FFFFFF;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  margin-bottom: 18px;
  box-shadow: 0 6px 15px rgba(227, 0, 15, 0.25);
}

.service-name {
  font-size: 17px;
  font-weight: 800;
  color: #0F172A;
  margin-bottom: 10px;
}

.service-desc {
  font-size: 13px;
  color: #64748B;
  line-height: 1.6;
}
</style>
