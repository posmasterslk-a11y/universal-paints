<template>
  <div class="shop-page">
    <!-- Hero Section -->
    <section class="shop-hero">
      <div class="hero-image-full">
        <img src="/images/shop page/shop_header.webp" alt="Shop Premium Paints" />
        <div class="hero-overlay"></div>
      </div>
      <div class="container hero-grid">
        <div class="hero-text">
          <div class="breadcrumbs">
            <NuxtLink to="/">Home</NuxtLink>
            <span class="separator">&gt;</span>
            <span class="current">Shop</span>
          </div>
          <div class="hero-subtitle text-red font-bold text-sm uppercase mb-2">Explore Our Range</div>
          <h1 class="hero-title">Shop Premium<br/><span class="text-gradient-orange">Quality Paints</span></h1>
          <p class="hero-subtitle-desc">Browse our wide range of high-quality paints and coatings designed to protect, beautify and add value to every surface.</p>
          <div class="hero-gradient-line"></div>
          
          <div class="hero-badges">
            <div class="badge-item">
              <div class="badge-icon bg-red-50 text-red">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
              </div>
              <div class="badge-text">
                <strong>Premium Quality</strong>
                <span>International Standards</span>
              </div>
            </div>
            <div class="badge-item">
              <div class="badge-icon bg-blue-50 text-blue">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" /></svg>
              </div>
              <div class="badge-text">
                <strong>Trusted by Experts</strong>
                <span>Preferred Choice</span>
              </div>
            </div>
          </div>
        </div>
        <div class="hero-empty"></div>
      </div>
    </section>

    <!-- Category Navigation Pills -->
    <section class="shop-categories">
      <div class="container">
        <div class="category-pills">
          <button 
            class="cat-pill"
            :class="{ active: selectedCategory === 'All' }"
            @click="selectCategory('All')"
          >
            <span class="cat-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" /></svg></span>
            <span class="cat-label">All Products</span>
          </button>
          <button 
            v-for="cat in activeCategories" 
            :key="cat.id"
            class="cat-pill"
            :class="{ active: selectedCategory === cat.name }"
            @click="selectCategory(cat.name)"
          >
            <span v-if="cat.icon" class="cat-icon" style="font-size: 16px;">{{ cat.icon }}</span>
            <span class="cat-label">{{ cat.name }}</span>
          </button>
        </div>
      </div>
    </section>

    <!-- Main Shop Layout -->
    <section class="shop-main">
      <div class="container shop-layout">
        <!-- Sidebar Filters -->
        <aside class="shop-sidebar">
          <div class="filter-header">
            <h3>Filter Products</h3>
            <button class="clear-btn" @click="resetFilters">Clear All</button>
          </div>
          <div class="filter-group">
            <h4 class="filter-title">Category <span>&#8964;</span></h4>
            <div class="filter-options">
              <label class="checkbox-label" @click.prevent="selectCategory('All')">
                <input type="radio" name="cat-radio" :checked="selectedCategory === 'All'" />
                All Categories
              </label>
              <label 
                v-for="cat in activeCategories" 
                :key="'filter-'+cat.id" 
                class="checkbox-label"
                @click.prevent="selectCategory(cat.name)"
              >
                <input type="radio" name="cat-radio" :checked="selectedCategory === cat.name" />
                {{ cat.name }}
              </label>
            </div>
          </div>
          <div class="filter-group">
            <h4 class="filter-title">Finish <span>&#8964;</span></h4>
            <div class="filter-options">
              <label class="checkbox-label"><input type="checkbox"/> Matt</label>
              <label class="checkbox-label"><input type="checkbox"/> Eggshell</label>
            </div>
          </div>
          <div class="filter-group">
            <h4 class="filter-title">Color Family <span>&#8964;</span></h4>
            <div class="color-options">
              <div class="color-circle" style="background-color: #E3000F;"></div>
              <div class="color-circle" style="background-color: #F59E0B;"></div>
              <div class="color-circle" style="background-color: #FCD34D;"></div>
              <div class="color-circle" style="background-color: #10B981;"></div>
              <div class="color-circle" style="background-color: #3B82F6;"></div>
              <div class="color-circle" style="background-color: #0F172A;"></div>
              <div class="color-circle" style="background-color: #FFFFFF; border: 1px solid #E2E8F0;"></div>
            </div>
          </div>
          <div class="filter-group">
            <h4 class="filter-title">Price Range <span>&#8964;</span></h4>
            <div class="price-range">
              <div class="price-labels">
                <span>Rs. 0</span>
                <span>Rs. 50,000+</span>
              </div>
              <input type="range" min="0" max="50000" class="range-slider" />
            </div>
          </div>
          <button class="btn btn-outline-red w-100" @click="resetFilters">Reset Filters &#x21bb;</button>
        </aside>

        <!-- Product Grid Area -->
        <div class="shop-products-area">
          <div class="products-header">
            <p>Showing {{ filteredProducts.length }} products <span v-if="selectedCategory !== 'All'">in <strong>{{ selectedCategory }}</strong></span></p>
            <div class="sort-by">
              <label>Sort by:</label>
              <select v-model="sortBy">
                <option value="newest">Newest First</option>
                <option value="price_asc">Price: Low to High</option>
                <option value="price_desc">Price: High to Low</option>
                <option value="name_asc">Name: A to Z</option>
              </select>
            </div>
          </div>
          <div class="products-grid" v-if="filteredProducts && filteredProducts.length > 0">
            <div class="product-card" v-for="product in filteredProducts" :key="product.id">
              <div class="product-img-wrap">
                <img :src="getProductImageUrl(product.main_image)" :alt="product.name" />
              </div>
              <div class="product-info">
                <h4>{{ product.name }}</h4>
                <p>{{ product.subtitle || product.description?.substring(0, 50) }}</p>
                <div class="product-price">Rs. {{ product.price_min?.toLocaleString() || 0 }} - Rs. {{ product.price_max?.toLocaleString() || 0 }}</div>
                <NuxtLink :to="`/shop/${product.id}`" class="btn btn-outline-red w-100 mt-auto text-center py-2" style="display: block; border-radius: 30px; font-weight: 600; text-decoration: none;">
                  View Details
                </NuxtLink>
              </div>
            </div>
          </div>
          <div v-else class="text-center py-10 text-gray-500">
            No products found in this category.
          </div>
          
          <!-- Pagination -->
          <div class="pagination">
            <button class="page-btn active">1</button>
            <button class="page-btn">2</button>
            <button class="page-btn">3</button>
            <button class="page-btn">4</button>
            <button class="page-btn next-btn">&rarr;</button>
          </div>
        </div>
      </div>
    </section>

    <!-- Features Banner -->
    <section class="shop-features">
      <div class="container features-wrap">
        <div class="feature-item">
          <div class="feature-icon text-red">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" /></svg>
          </div>
          <div class="feature-text">
            <strong>100% Original Products</strong>
            <span>Guaranteed Quality</span>
          </div>
        </div>
        <div class="feature-item">
          <div class="feature-icon text-blue">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" /></svg>
          </div>
          <div class="feature-text">
            <strong>Secure Payments</strong>
            <span>Safe & Secure Checkout</span>
          </div>
        </div>
        <div class="feature-item">
          <div class="feature-icon text-orange">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" /></svg>
          </div>
          <div class="feature-text">
            <strong>Fast Delivery</strong>
            <span>Islandwide Delivery</span>
          </div>
        </div>
        <div class="feature-item">
          <div class="feature-icon text-green">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
          </div>
          <div class="feature-text">
            <strong>Expert Support</strong>
            <span>We're Here to Help</span>
          </div>
        </div>
      </div>
    </section>

    <!-- Bottom CTA Banner -->
    <section class="shop-cta">
      <div class="container cta-banner">
        <div class="cta-banner-content">
          <h2>Can't Find What You're Looking For?</h2>
          <p>Our team is ready to help you find the perfect solution.</p>
        </div>
        <button class="btn btn-primary-red">
          Contact Us <span class="arrow">→</span>
        </button>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue'
import { useRoute, useRouter } from 'vue-router'

const route = useRoute()
const router = useRouter()
const config = useRuntimeConfig()

const searchQuery = ref('')
const selectedCategory = ref(route.query.category ? String(route.query.category) : 'All')
const selectedFinish = ref('All')
const selectedColor = ref('All')
const sortBy = ref('newest')
const priceRange = ref(50000)

// Watch query param changes from URL
watch(() => route.query.category, (newCat) => {
  selectedCategory.value = newCat ? String(newCat) : 'All'
})

const selectCategory = (catName) => {
  selectedCategory.value = catName
  router.push({
    query: {
      ...route.query,
      category: catName === 'All' ? undefined : catName
    }
  })
}

const resetFilters = () => {
  selectedCategory.value = 'All'
  searchQuery.value = ''
  selectedFinish.value = 'All'
  selectedColor.value = 'All'
  sortBy.value = 'newest'
  router.push({ query: {} })
}

// Fetch active categories dynamically from backend
const cleanApiBase = computed(() => (config.public.apiBase || 'https://api.universalpaints.lk').replace(/\/api\/?$/, ''))

const { data: categoriesData } = await useFetch(() => `${cleanApiBase.value}/api/categories?active_only=true`, { key: 'shop-categories' })

const activeCategories = computed(() => {
  const list = Array.isArray(categoriesData.value) ? categoriesData.value : (categoriesData.value?.data || [])
  return list || []
})

// Fetch products from backend
const { data: productsData, pending, error } = await useFetch(() => `${cleanApiBase.value}/api/products`, { key: 'shop-products' })

const allProducts = computed(() => {
  const list = Array.isArray(productsData.value) ? productsData.value : (productsData.value?.data || [])
  return list || []
})

const filteredProducts = computed(() => {
  let list = [...allProducts.value]

  // Filter by category
  if (selectedCategory.value && selectedCategory.value !== 'All') {
    const target = selectedCategory.value.toLowerCase().trim()
    list = list.filter(p => {
      const pCat = (p.category || '').toLowerCase().trim()
      return pCat === target || pCat.includes(target) || target.includes(pCat)
    })
  }

  // Filter by search query
  if (searchQuery.value.trim()) {
    const q = searchQuery.value.toLowerCase().trim()
    list = list.filter(p => 
      (p.name || '').toLowerCase().includes(q) || 
      (p.subtitle || '').toLowerCase().includes(q) ||
      (p.description || '').toLowerCase().includes(q)
    )
  }

  // Sorting
  if (sortBy.value === 'price_asc') {
    list.sort((a, b) => (Number(a.price_min) || 0) - (Number(b.price_min) || 0))
  } else if (sortBy.value === 'price_desc') {
    list.sort((a, b) => (Number(b.price_min) || 0) - (Number(a.price_min) || 0))
  } else if (sortBy.value === 'name_asc') {
    list.sort((a, b) => (a.name || '').localeCompare(b.name || ''))
  } else {
    // Newest first
    list.sort((a, b) => (b.id || 0) - (a.id || 0))
  }

  return list
})

const getProductImageUrl = (path) => {
  if (!path) return 'https://placehold.co/400x400/eee/999?text=Universal+Paints'
  if (path.startsWith('http://') || path.startsWith('https://')) return path
  if (path.startsWith('/storage/')) return `${config.public.apiBase}${path}`
  return path
}
</script>

<style scoped>
.shop-page {
  width: 100%;
}

/* Colors Utilities */
.text-red { color: #E3000F; }
.text-orange { color: #F97316; }
.text-green { color: #10B981; }
.text-blue { color: #3B82F6; }
.bg-red-50 { background-color: #FEF2F2; }
.bg-blue-50 { background-color: #EFF6FF; }
.text-gradient-orange {
  background: linear-gradient(90deg, #E3000F 0%, #F59E0B 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

/* Hero Section */
.shop-hero {
  position: relative;
  min-height: 600px;
  display: flex;
  align-items: center;
  background-color: #FFFFFF;
  overflow: hidden;
  padding: 140px 0 80px;
}
.hero-image-full {
  position: absolute;
  top: 0;
  right: 0;
  left: auto;
  width: 65%;
  height: 100%;
  z-index: 0;
  -webkit-mask-image: linear-gradient(to right, transparent 0%, black 30%, black 100%);
  mask-image: linear-gradient(to right, transparent 0%, black 30%, black 100%);

}
.hero-image-full img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: right center;
}
.hero-overlay {
  display: none;
}
.hero-grid {
  position: relative;
  z-index: 1;
  display: grid;
  grid-template-columns: 1fr 1.2fr;
  gap: 40px;
  align-items: center;
  width: 100%;
}
.breadcrumbs {
  font-size: 14px;
  color: #64748B;
  margin-bottom: 24px;
  display: flex;
  align-items: center;
  gap: 8px;
}
.breadcrumbs a {
  color: #64748B;
  text-decoration: none;
}
.breadcrumbs a:hover {
  color: #E3000F;
}
.breadcrumbs .current {
  color: #E3000F;
  font-weight: 500;
}
.hero-title {
  font-size: 56px;
  font-weight: 800;
  line-height: 1.1;
  color: #0F172A;
  margin-bottom: 20px;
  letter-spacing: -1px;
}
.hero-subtitle-desc {
  font-size: 18px;
  color: #475569;
  line-height: 1.6;
  margin-bottom: 30px;
  max-width: 400px;
}
.hero-gradient-line {
  width: 60px;
  height: 4px;
  background: linear-gradient(to right, #E3000F, #F59E0B, #10B981, #3B82F6);
  border-radius: 2px;
  margin-bottom: 24px;
}
.hero-badges {
  display: flex;
  gap: 24px;
}
.badge-item {
  display: flex;
  align-items: center;
  gap: 12px;
}
.badge-icon {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.badge-icon svg {
  width: 24px;
  height: 24px;
}
.badge-text {
  display: flex;
  flex-direction: column;
}
.badge-text strong {
  font-size: 14px;
  color: #0F172A;
  font-weight: 700;
}
.badge-text span {
  font-size: 12px;
  color: #64748B;
}

@media (max-width: 991px) {
  .hero-grid {
    grid-template-columns: 1fr;
  }
  .hero-overlay {
    background: linear-gradient(to bottom, rgba(249, 250, 251, 0.9) 0%, rgba(249, 250, 251, 0.95) 100%);
  }
  .hero-title { font-size: 40px; }
  .hero-badges { flex-direction: column; gap: 16px; }
}

/* Shop Categories */
.shop-categories {
  padding: 40px 0;
  border-bottom: 1px solid #F1F5F9;
}
.category-pills {
  display: flex;
  gap: 16px;
  overflow-x: auto;
  padding-bottom: 10px;
  scrollbar-width: none;
}
.category-pills::-webkit-scrollbar {
  display: none;
}
.cat-pill {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
  padding: 16px 24px;
  background: white;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  cursor: pointer;
  min-width: 140px;
  transition: all 0.3s;
}
.cat-pill.active {
  border-color: #E3000F;
  box-shadow: 0 4px 12px rgba(227,0,15,0.1);
}
.cat-pill.active .cat-icon { color: #E3000F; }
.cat-pill.active .cat-label { color: #E3000F; font-weight: 600; }
.cat-icon { color: #64748B; transition: color 0.3s; }
.cat-icon svg { width: 32px; height: 32px; }
.cat-label { font-size: 14px; color: #475569; font-weight: 500; }

/* Shop Main Layout */
.shop-main { padding: 60px 0; background-color: #FAFAFA; }
.shop-layout {
  display: grid;
  grid-template-columns: 280px 1fr;
  gap: 40px;
}

/* Sidebar */
.shop-sidebar {
  background: white;
  padding: 24px;
  border-radius: 16px;
  border: 1px solid #F1F5F9;
  height: fit-content;
}
.filter-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 24px;
  padding-bottom: 16px;
  border-bottom: 1px solid #F1F5F9;
}
.filter-header h3 { font-size: 18px; font-weight: 700; color: #0F172A; margin: 0; }
.clear-btn { background: none; border: none; color: #E3000F; font-size: 13px; font-weight: 600; cursor: pointer; }
.filter-group { margin-bottom: 24px; }
.filter-title { font-size: 15px; font-weight: 600; color: #1E293B; margin-bottom: 16px; display: flex; justify-content: space-between; cursor: pointer; }
.filter-options { display: flex; flex-direction: column; gap: 12px; }
.checkbox-label { display: flex; align-items: center; gap: 10px; font-size: 14px; color: #475569; cursor: pointer; }
.color-options { display: flex; flex-wrap: wrap; gap: 10px; }
.color-circle { width: 24px; height: 24px; border-radius: 50%; cursor: pointer; transition: transform 0.2s; }
.color-circle:hover { transform: scale(1.1); }
.price-range { display: flex; flex-direction: column; gap: 10px; }
.price-labels { display: flex; justify-content: space-between; font-size: 13px; color: #64748B; }
.range-slider { -webkit-appearance: none; width: 100%; height: 4px; border-radius: 2px; background: #E2E8F0; outline: none; }
.range-slider::-webkit-slider-thumb { -webkit-appearance: none; appearance: none; width: 16px; height: 16px; border-radius: 50%; background: #E3000F; cursor: pointer; }
.w-100 { width: 100%; }
.btn-outline-red {
  background: transparent;
  border: 1px solid #E3000F;
  color: #E3000F;
  padding: 10px 20px;
  border-radius: 30px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s;
}
.btn-outline-red:hover { background: #FEF2F2; }

/* Product Grid Area */
.products-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 24px;
}
.products-header p { font-size: 14px; color: #64748B; margin: 0; }
.sort-by { display: flex; align-items: center; gap: 8px; font-size: 14px; color: #475569; }
.sort-by select { border: 1px solid #E2E8F0; padding: 8px 32px 8px 12px; border-radius: 8px; background: white; color: #0F172A; outline: none; }
.products-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
  margin-bottom: 40px;
}
.product-card {
  background: white;
  border-radius: 16px;
  border: 1px solid #F1F5F9;
  overflow: hidden;
  transition: all 0.3s;
  display: flex;
  flex-direction: column;
}
.product-card:hover {
  box-shadow: 0 12px 24px rgba(0,0,0,0.06);
  border-color: #E2E8F0;
}
.product-img-wrap {
  padding: 24px;
  background-color: #F8FAFC;
  display: flex;
  justify-content: center;
  align-items: center;
}
.product-img-wrap img { width: 140px; height: 140px; object-fit: contain; }
.product-info { padding: 20px; flex-grow: 1; display: flex; flex-direction: column; }
.product-info h4 { font-size: 16px; font-weight: 700; color: #0F172A; margin: 0 0 8px 0; }
.product-info p { font-size: 13px; color: #64748B; line-height: 1.5; margin: 0 0 16px 0; flex-grow: 1; }
.product-price { font-size: 18px; font-weight: 800; color: #0F172A; margin-bottom: 16px; }
.btn-add-cart { width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; font-size: 14px; }

/* Pagination */
.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 8px;
}
.page-btn {
  width: 36px;
  height: 36px;
  border-radius: 8px;
  border: 1px solid #E2E8F0;
  background: white;
  color: #475569;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s;
}
.page-btn:hover { border-color: #CBD5E1; color: #0F172A; }
.page-btn.active { background: #E3000F; color: white; border-color: #E3000F; }

/* Features Banner */
.shop-features {
  padding: 60px 0;
  background-color: white;
  border-top: 1px solid #F1F5F9;
}
.features-wrap {
  display: flex;
  justify-content: space-between;
  gap: 24px;
  flex-wrap: wrap;
}
.feature-item {
  display: flex;
  align-items: center;
  gap: 16px;
  flex: 1;
  min-width: 200px;
}
.feature-icon {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #F8FAFC;
}
.feature-icon svg { width: 24px; height: 24px; }
.feature-text { display: flex; flex-direction: column; gap: 4px; }
.feature-text strong { font-size: 15px; font-weight: 700; color: #0F172A; }
.feature-text span { font-size: 13px; color: #64748B; }

/* Bottom CTA Banner */
.shop-cta {
  padding: 80px 0;
  position: relative;
  background-color: #FAFAFA;
}
.cta-banner {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: white;
  padding: 40px 60px;
  border-radius: 24px;
  box-shadow: 0 20px 40px rgba(0,0,0,0.1);
  max-width: 900px;
  margin: 0 auto;
}
.cta-banner-content h2 {
  font-size: 32px;
  font-weight: 800;
  color: #0F172A;
  margin: 0 0 10px 0;
}
.cta-banner-content p {
  font-size: 16px;
  color: #475569;
  margin: 0;
}
.btn-primary-red {
  background: #E3000F;
  color: white;
  box-shadow: 0 4px 15px rgba(227, 0, 15, 0.3);
}
.btn-primary-red:hover {
  background: #C8000D;
  transform: translateY(-2px);
}

@media (max-width: 991px) {
  .shop-layout { grid-template-columns: 1fr; }
  .features-wrap { flex-direction: column; gap: 30px; }
  .cta-banner { flex-direction: column; text-align: center; gap: 30px; padding: 30px; }
}
@media (max-width: 768px) {
  .products-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 576px) {
  .products-grid { grid-template-columns: 1fr; }
}
</style>
