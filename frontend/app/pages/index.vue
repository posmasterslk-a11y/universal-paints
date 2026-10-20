<template>
  <div class="home-page">
    <!-- Hero Section -->
    <section class="hero">
      <div 
        v-for="(bg, index) in heroBackgrounds" 
        :key="index"
        class="hero-bg-layer"
        :class="{ active: currentBgIndex === index }"
        :style="{ backgroundImage: `url(${bg})` }"
      ></div>
      <div class="container hero-content">
        <div class="hero-text">
          <div class="section-subtitle">COLORING YOUR WORLD</div>
          <h1 class="hero-title">
            Quality Paints.<br />
            <span class="text-gradient-beautiful">Beautiful</span><br />
            Possibilities.
          </h1>
          <p class="hero-desc">
            Universal Paints is a leading manufacturer and distributor of premium quality paints and coatings trusted by professionals and homeowners.
          </p>
          <div class="hero-actions">
            <NuxtLink to="/shop" class="btn btn-primary">
              Explore Our Products <span class="arrow">→</span>
            </NuxtLink>
            <NuxtLink to="/about" class="btn btn-outline">
              Discover More <span class="arrow">→</span>
            </NuxtLink>
          </div>
        </div>
        <div class="hero-image">
          <!-- Background handles the image now -->
        </div>
      </div>
      
      <!-- Slider Navigation Dots -->
      <div class="hero-slider-nav">
        <button 
          v-for="(_, index) in heroBackgrounds" 
          :key="'dot-'+index"
          class="slider-dot"
          :class="{ active: currentBgIndex === index }"
          @click="setHeroSlide(index)"
          aria-label="Change slide"
        ></button>
      </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
      <div class="container features-grid">
        <div class="feature-card">
          <div class="feature-icon bg-light-red text-red">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 3h12l4 6-10 12L2 9z"></path><path d="M11 3 8 9l4 12 4-12-3-6"></path><path d="M2 9h20"></path></svg>
          </div>
          <div class="feature-text">
            <h4>Premium Quality</h4>
            <p>International standards with superior quality</p>
          </div>
        </div>
        <div class="feature-card">
          <div class="feature-icon bg-light-orange text-orange">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path></svg>
          </div>
          <div class="feature-text">
            <h4>Long Lasting</h4>
            <p>Durable protection for years to come</p>
          </div>
        </div>
        <div class="feature-card">
          <div class="feature-icon bg-light-green text-green">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"></path><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"></path></svg>
          </div>
          <div class="feature-text">
            <h4>Eco Friendly</h4>
            <p>Low VOC, safe for you and the environment</p>
          </div>
        </div>
        <div class="feature-card">
          <div class="feature-icon bg-light-blue text-blue">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 12 2 2 4-4"></path><path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2z"></path></svg>
          </div>
          <div class="feature-text">
            <h4>Trusted by Experts</h4>
            <p>Preferred choice of professionals</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Categories (What Are You Painting?) -->
    <section class="categories-section">
      <div class="container">
        <div class="categories-header">
          <div>
            <div class="section-subtitle">WHAT ARE YOU PAINTING?</div>
            <h2 class="section-title">Paints for Every Surface</h2>
          </div>
          <NuxtLink to="/shop" class="btn btn-outline">
            Find the Right Paint <span class="arrow">→</span>
          </NuxtLink>
        </div>
        
        <div class="categories-grid">
          <NuxtLink to="/shop" class="category-card">
            <div class="card-img">
              <img src="/images/products/exterior.webp" alt="Home" />
            </div>
            <div class="card-content">
              <div class="card-title-wrap">
                <div class="card-icon bg-red">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                </div>
                <h3>Home</h3>
              </div>
            </div>
          </NuxtLink>
          
          <NuxtLink to="/shop" class="category-card">
            <div class="card-img">
              <img src="/images/products/interior.webp" alt="Office" />
            </div>
            <div class="card-content">
              <div class="card-title-wrap">
                <div class="card-icon bg-orange">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="16" height="20" x="4" y="2" rx="2" ry="2"></rect><path d="M9 22v-4h6v4"></path><path d="M8 6h.01"></path><path d="M16 6h.01"></path><path d="M12 6h.01"></path><path d="M12 10h.01"></path><path d="M12 14h.01"></path><path d="M16 10h.01"></path><path d="M16 14h.01"></path><path d="M8 10h.01"></path><path d="M8 14h.01"></path></svg>
                </div>
                <h3>Office</h3>
              </div>
            </div>
          </NuxtLink>
          
          <NuxtLink to="/shop" class="category-card">
            <div class="card-img">
              <img src="/images/products/industrial.webp" alt="Factory" />
            </div>
            <div class="card-content">
              <div class="card-title-wrap">
                <div class="card-icon bg-blue">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 20a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8l-7 5V8l-7 5V4a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"></path><path d="M17 18h1"></path><path d="M12 18h1"></path><path d="M7 18h1"></path></svg>
                </div>
                <h3>Factory</h3>
              </div>
            </div>
          </NuxtLink>
          
          <NuxtLink to="/shop" class="category-card">
            <div class="card-img">
              <img src="/images/products/wood.webp" alt="Wood" />
            </div>
            <div class="card-content">
              <div class="card-title-wrap">
                <div class="card-icon bg-green">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20"></path><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                </div>
                <h3>Wood</h3>
              </div>
            </div>
          </NuxtLink>
        </div>
      </div>
    </section>

    <!-- Best Selling Products -->
    <section class="products-section">
      <div class="products-container">
        <div class="section-header">
          <div>
            <div class="section-subtitle">POPULAR PICKS</div>
            <h2 class="section-title">Best Selling Products</h2>
          </div>
          <NuxtLink to="/shop" class="text-red font-semibold view-all-link">
            View All Products <span class="arrow">→</span>
          </NuxtLink>
        </div>
        
        <div class="best-selling-grid" v-if="bestSellingProducts && bestSellingProducts.length > 0">
          <div class="best-selling-card" v-for="product in bestSellingProducts" :key="product.id">
            <NuxtLink :to="`/shop/${product.id}`" class="product-card-link">
              <div class="img-wrapper" style="--splash-color: #ff003c;">
                <img :src="product.main_image || '/images/products/paint-bucket.webp'" :alt="product.name" class="bucket-img" loading="lazy" />
              </div>
              <div class="card-details">
                <h4 class="product-name" :title="product.name">{{ product.name }}</h4>
                <p class="product-sub">{{ product.subtitle || product.category || 'Universal Paints' }}</p>
                <div class="product-price">
                  LKR {{ (product.price_min || 1500).toLocaleString() }}
                </div>
                <div class="size-pills">
                  <span v-for="(size, sIdx) in (product.pack_sizes && product.pack_sizes.length ? product.pack_sizes.slice(0, 3) : ['1L', '4L', '20L'])" :key="sIdx">
                    {{ typeof size === 'object' && size !== null ? size.size : size }}
                  </span>
                </div>
              </div>
            </NuxtLink>
          </div>
        </div>
        <div v-else class="empty-products-box">
          <p>Explore our wide selection of paints and primers in the shop.</p>
          <NuxtLink to="/shop" class="btn btn-primary mt-4">Visit Shop</NuxtLink>
        </div>
      </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
      <div class="about-image">
        <img src="/images/home-page/about%20universal%20paint.png" alt="About Universal Paints" />
      </div>
      <div class="about-content">
        <div class="section-subtitle">ABOUT UNIVERSAL PAINTS</div>
        <h2 class="section-title">A Legacy of Quality and Commitment</h2>
        <p class="about-desc">
          For over two decades, we have been committed to delivering innovative, reliable and sustainable paint solutions that beautify spaces and protect what matters most.
        </p>
        
        <div class="stats-grid">
          <div class="stat-item">
            <div class="stat-icon text-red">
              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 20a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8l-7 5V8l-7 5V4a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"></path></svg>
            </div>
            <div class="stat-number">20+</div>
            <div class="stat-label">Years of<br/>Excellence</div>
          </div>
          <div class="stat-item">
            <div class="stat-icon text-orange">
              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m2 7 4.41-4.41A2 2 0 0 1 7.83 2h8.34a2 2 0 0 1 1.42.59L22 7"></path><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path><path d="M15 22v-4a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v4"></path><path d="M2 7h20"></path></svg>
            </div>
            <div class="stat-number text-orange">1000+</div>
            <div class="stat-label">Retailers<br/>Nationwide</div>
          </div>
          <div class="stat-item">
            <div class="stat-icon text-green">
              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7.5 4.27 9 5.15"></path><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path><path d="m3.3 7 8.7 5 8.7-5"></path><path d="M12 22V12"></path></svg>
            </div>
            <div class="stat-number text-green">500+</div>
            <div class="stat-label">Products<br/>Available</div>
          </div>
          <div class="stat-item">
            <div class="stat-icon text-blue">
              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            </div>
            <div class="stat-number text-blue">50+</div>
            <div class="stat-label">Expert<br/>Employees</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Network Section -->
    <section class="network-section">
      <div class="container network-content">
        <div class="network-text">
          <div class="section-subtitle">NATIONWIDE PRESENCE</div>
          <h2 class="section-title">Strong Network.<br/>Reliable Service.</h2>
          <p class="network-desc">
            Our wide distribution network ensures our products and services are always close to you across Sri Lanka.
          </p>
          <NuxtLink to="/contact" class="btn btn-outline">
            Find a Distributor <span class="arrow text-red">→</span>
          </NuxtLink>
        </div>
        <div class="network-map">
          <div class="map-container">
            <img src="/images/srilanka-map.svg" alt="Sri Lanka Map" class="sl-map" />
            <!-- Location Pins -->
            <div class="map-pin pin-colombo" title="Western Province"></div>
            <div class="map-pin pin-kandy" title="Central Province"></div>
            <div class="map-pin pin-galle" title="Southern Province"></div>
            <div class="map-pin pin-kurunegala" title="North Western Province"></div>
            <div class="map-pin pin-batticaloa" title="Eastern Province"></div>
            <div class="map-pin pin-anuradhapura" title="North Central Province"></div>
            <div class="map-pin pin-badulla" title="Uva Province"></div>
            <div class="map-pin pin-ratnapura" title="Sabaragamuwa Province"></div>
          </div>
        </div>
        <div class="network-features">
          <h4>We Are Everywhere</h4>
          <ul class="check-list">
            <li>Islandwide distribution network</li>
            <li>On-time delivery you can trust</li>
            <li>Dedicated technical support</li>
            <li>Growing stronger every day</li>
          </ul>
        </div>
      </div>
    </section>

    <!-- Why Choose Us -->
    <section class="why-us">
      <div class="container">
        <div class="section-subtitle">WHY CHOOSE US</div>
        <h2 class="section-title">More Than Just Paint</h2>
        
        <div class="reasons-grid">
          <div class="reason-card">
            <div class="reason-icon bg-light-red text-red">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 2v7.31"></path><path d="M14 9.3V2"></path><path d="M8.5 2h7"></path><path d="M14 9.3a6.5 6.5 0 1 1-4 0"></path><path d="M5.52 16h12.96"></path></svg>
            </div>
            <div class="reason-text">
              <h4>Innovation</h4>
              <p>Continuous research and development for superior paint chemistry</p>
            </div>
          </div>
          <div class="reason-card">
            <div class="reason-icon bg-light-orange text-orange">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"></circle><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"></path></svg>
            </div>
            <div class="reason-text">
              <h4>Quality Assurance</h4>
              <p>Rigorous quality control and batch testing at every step</p>
            </div>
          </div>
          <div class="reason-card">
            <div class="reason-icon bg-light-green text-green">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m11 17 2 2a1 1 0 0 0 1.42 0l4.58-4.58a1 1 0 0 0 0-1.42l-3-3a1 1 0 0 0-1.42 0L13 11.58"></path><path d="m7 7 2-2a1 1 0 0 1 1.42 0l3 3a1 1 0 0 1 0 1.42L12 10.83"></path><path d="M18 21a8 8 0 0 0-8-8"></path><path d="M6 3a8 8 0 0 0 8 8"></path></svg>
            </div>
            <div class="reason-text">
              <h4>Customer First</h4>
              <p>Dedicated technical support and expert color consultancy</p>
            </div>
          </div>
          <div class="reason-card">
            <div class="reason-icon bg-light-blue text-blue">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"></path><path d="M15 18H9"></path><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"></path><circle cx="17" cy="18" r="2"></circle><circle cx="7" cy="18" r="2"></circle></svg>
            </div>
            <div class="reason-text">
              <h4>Reliable Distribution</h4>
              <p>Strong nationwide logistics ensuring prompt delivery</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue';

useHead({
  title: 'Universal Paints | Premium Quality Paints & Coatings',
  meta: [
    { 
      name: 'description', 
      content: 'Universal Paints is a leading manufacturer and distributor of premium quality paints, architectural coatings, and industrial finishes in Sri Lanka.' 
    }
  ]
})

const config = useRuntimeConfig()
const { data: allProducts } = await useFetch(`${config.public.apiBase}/api/products`)
const bestSellingProducts = computed(() => {
  if (!allProducts.value) return []
  const list = Array.isArray(allProducts.value) ? allProducts.value : (allProducts.value?.data || [])
  return list.filter(p => p.is_best_seller).slice(0, 6)
})

const heroBackgrounds = [
  '/images/home-page/dark-hero-bg1.webp',
  '/images/home-page/dark-hero-bg2.webp',
  '/images/home-page/dark-hero-bg3.webp'
];
const currentBgIndex = ref(0);
let bgInterval;

const setHeroSlide = (index) => {
  currentBgIndex.value = index;
  if (bgInterval) {
    clearInterval(bgInterval);
    bgInterval = setInterval(() => {
      currentBgIndex.value = (currentBgIndex.value + 1) % heroBackgrounds.length;
    }, 5000);
  }
};

onMounted(() => {
  bgInterval = setInterval(() => {
    currentBgIndex.value = (currentBgIndex.value + 1) % heroBackgrounds.length;
  }, 5000);
});

onUnmounted(() => {
  if (bgInterval) clearInterval(bgInterval);
});
</script>

<style scoped>
.text-green { color: #10B981; }
.text-blue { color: #3B82F6; }
.text-orange { color: #F59E0B; }
.text-red { color: #E3000F; }

.bg-light-red { background-color: #FEE2E2; }
.bg-light-green { background-color: #D1FAE5; }
.bg-light-blue { background-color: #DBEAFE; }
.bg-light-orange { background-color: #FEF3C7; }

.text-gradient-beautiful {
  background: linear-gradient(90deg, #E3000F 0%, #F59E0B 50%, #84CC16 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.home-page {
  overflow-x: hidden;
  width: 100%;
  max-width: 100%;
}

/* Hero */
.hero {
  padding-top: 180px;
  padding-bottom: 120px;
  position: relative;
  overflow: hidden;
}
.hero-bg-layer {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  opacity: 0;
  transition: opacity 1.5s ease-in-out;
  z-index: 1;
}
.hero-bg-layer.active {
  opacity: 1;
}
.hero-content {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 40px;
  align-items: center;
  position: relative;
  z-index: 2;
}
.hero-text {
  margin-top: -60px;
}
.hero-title {
  font-size: 54px;
  font-weight: 800;
  line-height: 1.1;
  margin-bottom: 20px;
  color: #FFFFFF;
}
.hero-desc {
  font-size: 18px;
  color: #F0F0F0;
  margin-bottom: 40px;
  max-width: 90%;
  line-height: 1.6;
}
.hero-actions {
  display: flex;
  gap: 15px;
}
.hero-actions .btn-outline {
  border-color: #FFFFFF;
  color: #FFFFFF;
  background-color: transparent;
}
.hero-actions .btn-outline:hover {
  background-color: rgba(255, 255, 255, 0.15);
}

/* Slider Dots */
.hero-slider-nav {
  position: absolute;
  bottom: 120px;
  left: 0;
  width: 100%;
  display: flex;
  justify-content: center;
  gap: 12px;
  z-index: 5;
}
.slider-dot {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background-color: rgba(255, 255, 255, 0.4);
  border: 2px solid transparent;
  cursor: pointer;
  transition: all 0.3s ease;
  padding: 0;
}
.slider-dot:hover {
  background-color: rgba(255, 255, 255, 0.8);
}
.slider-dot.active {
  background-color: transparent;
  border-color: #E3000F;
  transform: scale(1.3);
}

/* Features */
.features-section {
  padding: 40px 0;
  background-color: var(--bg-light, #F8FAFC);
  position: relative;
  z-index: 10;
}
.features-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
  background: white;
  padding: 30px;
  border-radius: 16px;
  box-shadow: 0 10px 40px rgba(0,0,0,0.08);
  margin-top: -100px;
}
.feature-card {
  display: flex;
  align-items: center;
  gap: 15px;
  background: white;
  padding: 20px;
  border-radius: 12px;
  border: 1px solid rgba(0, 0, 0, 0.04);
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03);
  transition: transform 0.25s ease, box-shadow 0.25s ease;
}
.feature-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 16px -2px rgba(0, 0, 0, 0.08);
}
.feature-icon {
  width: 52px;
  height: 52px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.feature-text h4 {
  font-size: 16px;
  font-weight: 700;
  margin-bottom: 4px;
  color: #0F172A;
}
.feature-text p {
  font-size: 13px;
  color: var(--text-light, #64748B);
  line-height: 1.4;
  margin: 0;
}

/* Categories */
.categories-section {
  padding: 80px 0;
  background-color: var(--bg-light, #F8FAFC);
}
.categories-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
  margin-bottom: 40px;
}
.categories-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 30px;
}
.category-card {
  background: white;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 10px 20px -3px rgba(0, 0, 0, 0.06);
  transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s ease;
  text-decoration: none;
  color: inherit;
  display: block;
}
.category-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
}
.card-img {
  height: 200px;
  overflow: hidden;
  position: relative;
}
.card-img img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
}
.category-card:hover .card-img img {
  transform: scale(1.08);
}
.card-content {
  padding: 20px;
}
.card-title-wrap {
  display: flex;
  align-items: center;
  gap: 12px;
}
.card-icon {
  width: 42px;
  height: 42px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  flex-shrink: 0;
}
.bg-green { background-color: #10B981; }
.bg-blue { background-color: #3B82F6; }
.bg-orange { background-color: #F59E0B; }
.bg-red { background-color: #EF4444; }
.card-content h3 {
  font-size: 17px;
  font-weight: 700;
  margin: 0;
  color: #0F172A;
}

/* Best Selling Products */
.products-section {
  padding: 80px 0;
  background-color: var(--white, #FFFFFF);
  width: 100%;
  overflow: hidden;
}
.products-container {
  width: 100%;
  max-width: 1560px;
  margin: 0 auto;
  padding: 0 40px;
  box-sizing: border-box;
}
.section-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
  margin-bottom: 40px;
}
.view-all-link {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 15px;
  text-decoration: none;
  transition: gap 0.2s ease;
}
.view-all-link:hover {
  gap: 12px;
}
.best-selling-grid {
  display: grid;
  grid-template-columns: repeat(6, minmax(0, 1fr));
  gap: 20px;
  align-items: stretch;
  width: 100%;
  box-sizing: border-box;
}
.best-selling-card {
  text-align: center;
  background: white;
  padding: 16px 12px;
  border-radius: 14px;
  border: 1px solid rgba(0, 0, 0, 0.05);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  display: flex;
  flex-direction: column;
  height: 100%;
  box-sizing: border-box;
  min-width: 0;
  max-width: 100%;
  overflow: hidden;
}
.best-selling-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 12px 24px -4px rgba(0, 0, 0, 0.08);
}
.product-card-link {
  text-decoration: none;
  color: inherit;
  display: flex;
  flex-direction: column;
  height: 100%;
  flex: 1;
}
.img-wrapper {
  position: relative;
  width: 100%;
  height: 135px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 12px;
  flex-shrink: 0;
}
.img-wrapper::before {
  content: '';
  position: absolute;
  width: 80px;
  height: 80px;
  background: var(--splash-color, #ff003c);
  border-radius: 50%;
  filter: blur(20px);
  z-index: 1;
  opacity: 0.75;
}
.bucket-img {
  width: 100%;
  height: 100%;
  max-width: 100px;
  max-height: 110px;
  object-fit: contain;
  position: relative;
  z-index: 2;
  transition: transform 0.3s ease;
}
.best-selling-card:hover .bucket-img {
  transform: scale(1.06);
}
.card-details {
  display: flex;
  flex-direction: column;
  flex: 1;
}
.product-name {
  font-size: 13px;
  font-weight: 700;
  color: #0F172A;
  line-height: 1.35;
  margin-bottom: 4px;
  height: 36px;
  max-height: 36px;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
  flex-shrink: 0;
}
.product-sub {
  font-size: 11px;
  color: #64748B;
  margin-bottom: 6px;
  height: 16px;
  line-height: 16px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  flex-shrink: 0;
}
.product-price {
  font-size: 13px;
  font-weight: 800;
  color: #E3000F;
  margin-bottom: 10px;
  height: 18px;
  line-height: 18px;
  flex-shrink: 0;
}
.size-pills {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: nowrap;
  gap: 4px;
  margin-top: auto;
  height: 24px;
  flex-shrink: 0;
  overflow: hidden;
}
.size-pills span {
  font-size: 10px;
  font-weight: 600;
  color: #475569;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 2px 7px;
  background: #F8FAFC;
  white-space: nowrap;
  text-overflow: ellipsis;
  overflow: hidden;
  max-width: 65px;
}
.empty-products-box {
  text-align: center;
  padding: 40px 20px;
  color: #64748B;
  background: #F8FAFC;
  border-radius: 12px;
}

/* About Section */
.about-section {
  display: grid;
  grid-template-columns: 1fr 1fr;
}
.about-image {
  height: 100%;
  min-height: 380px;
  position: relative;
}
.about-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.about-image::after {
  content: '';
  position: absolute;
  top: 0;
  right: 0;
  width: 120px;
  height: 100%;
  background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
}
.about-content {
  padding: 60px 10%;
  background-color: var(--white, #FFFFFF);
  display: flex;
  flex-direction: column;
  justify-content: center;
}
.about-desc {
  font-size: 16px;
  color: var(--text-light, #64748B);
  margin-bottom: 40px;
  line-height: 1.6;
}
.stats-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
}
.stat-item {
  text-align: center;
}
.stat-icon {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: 10px;
}
.stat-number {
  font-size: 32px;
  font-weight: 800;
  margin-bottom: 5px;
  color: #0F172A;
}
.stat-label {
  font-size: 13px;
  color: var(--text-dark, #334155);
  font-weight: 600;
  line-height: 1.3;
}

/* Network */
.network-section {
  padding: 80px 0;
  background-color: var(--bg-light, #F8FAFC);
  overflow: hidden;
}
.network-content {
  display: grid;
  grid-template-columns: 1fr 1.5fr 1fr;
  gap: 40px;
  align-items: center;
}
.network-desc {
  font-size: 16px;
  color: var(--text-light, #64748B);
  margin-bottom: 30px;
  line-height: 1.6;
}
/* Map styles */
.map-container {
  position: relative;
  width: 100%;
  height: 380px;
  display: flex;
  justify-content: center;
  transform: scale(1.2);
  margin: 30px 0;
}
.sl-map {
  height: 100%;
  opacity: 0.9;
  filter: grayscale(80%) contrast(1.2);
}
.map-pin {
  position: absolute;
  width: 14px;
  height: 14px;
  border-radius: 50%;
  border: 2px solid white;
  box-shadow: 0 3px 6px rgba(0,0,0,0.3);
  cursor: pointer;
  animation: pulse 2s infinite;
}
@keyframes pulse {
  0% { box-shadow: 0 0 0 0 rgba(227, 0, 15, 0.4); }
  70% { box-shadow: 0 0 0 10px rgba(227, 0, 15, 0); }
  100% { box-shadow: 0 0 0 0 rgba(227, 0, 15, 0); }
}
.pin-colombo { top: 72%; left: 35%; background-color: #E3000F; }
.pin-kandy { top: 65%; left: 52%; background-color: #F59E0B; }
.pin-galle { top: 88%; left: 45%; background-color: #10B981; }
.pin-kurunegala { top: 58%; left: 38%; background-color: #84CC16; }
.pin-batticaloa { top: 55%; left: 68%; background-color: #3B82F6; }
.pin-anuradhapura { top: 40%; left: 48%; background-color: #E3000F; }
.pin-badulla { top: 73%; left: 63%; background-color: #10B981; }
.pin-ratnapura { top: 78%; left: 46%; background-color: #F59E0B; }

.network-features h4 {
  font-size: 18px;
  font-weight: 700;
  margin-bottom: 20px;
  color: #0F172A;
}
.check-list {
  list-style: none;
  padding: 0;
  margin: 0;
}
.check-list li {
  position: relative;
  padding-left: 28px;
  margin-bottom: 15px;
  font-size: 15px;
  color: var(--text-dark, #334155);
}
.check-list li::before {
  content: '✓';
  position: absolute;
  left: 0;
  top: 0;
  color: #10B981;
  font-weight: 800;
  font-size: 16px;
}

/* Why Us */
.why-us {
  padding: 80px 0;
  background-color: var(--white, #FFFFFF);
}
.reasons-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 25px;
}
.reason-card {
  display: flex;
  gap: 15px;
  padding: 24px 20px;
  border-radius: 14px;
  background: var(--bg-light, #F8FAFC);
  border: 1px solid rgba(0, 0, 0, 0.03);
  transition: transform 0.25s ease, box-shadow 0.25s ease;
}
.reason-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 20px -3px rgba(0, 0, 0, 0.05);
}
.reason-icon {
  width: 50px;
  height: 50px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.reason-text h4 {
  font-size: 16px;
  font-weight: 700;
  margin-bottom: 6px;
  color: #0F172A;
}
.reason-text p {
  font-size: 13px;
  color: var(--text-light, #64748B);
  line-height: 1.5;
  margin: 0;
}

/* Responsive */
@media (max-width: 1440px) {
  .products-container {
    padding: 0 32px;
  }
  .best-selling-grid {
    grid-template-columns: repeat(6, minmax(0, 1fr));
    gap: 16px;
  }
}
@media (max-width: 1200px) {
  .hero-title { font-size: 48px; }
  .products-container { padding: 0 24px; }
  .best-selling-grid { grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 16px; }
  .categories-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 992px) {
  .hero { 
    padding-top: 100px; 
    padding-bottom: 0px; 
    min-height: 60vh;
    display: flex;
    align-items: flex-end;
    overflow: visible;
  }
  .hero-content { 
    grid-template-columns: 1fr; 
    text-align: center; 
    width: 100%;
    transform: translateY(50%);
  }
  .hero-text {
    background: rgba(0, 0, 0, 0.65);
    padding: 30px;
    border-radius: 16px;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    margin-top: 0;
    position: relative;
    z-index: 10;
  }
  .hero-desc { margin: 20px auto 40px; }
  .hero-actions { justify-content: center; }
  .features-section { padding-top: 150px; }
  .features-grid { grid-template-columns: repeat(2, 1fr); margin-top: 0; }
  .about-section { grid-template-columns: 1fr; }
  .about-image { min-height: 300px; }
  .network-content { grid-template-columns: 1fr; }
  .map-container { transform: scale(1); margin-top: 20px; height: auto; }
  .sl-map { width: 100%; height: auto; object-fit: contain; }
  .reasons-grid { grid-template-columns: repeat(2, 1fr); }
  .products-container { padding: 0 20px; }
  .best-selling-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 14px; }
}
@media (max-width: 768px) {
  .hero-title { font-size: 38px; }
  .best-selling-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px; }
  .categories-grid { gap: 15px; }
}
@media (max-width: 576px) {
  .hero-title { font-size: 32px; }
  .hero-actions { flex-direction: column; width: 100%; }
  .hero-actions .btn { width: 100%; justify-content: center; }
  .features-grid { grid-template-columns: 1fr; margin-top: 0; padding: 20px; }
  .categories-grid { grid-template-columns: 1fr; }
  .products-container { padding: 0 16px; }
  .best-selling-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 10px; }
  .stats-grid { grid-template-columns: repeat(2, 1fr); }
  .reasons-grid { grid-template-columns: 1fr; }
  .section-header { flex-direction: column; align-items: flex-start; gap: 10px; }
  .about-content { padding: 40px 5%; }
}
</style>
