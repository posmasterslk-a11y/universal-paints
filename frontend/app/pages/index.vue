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
            <NuxtLink to="/products" class="btn btn-primary">
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
    </section>

    <!-- Features Section -->
    <section class="features-section">
      <div class="container features-grid">
        <div class="feature-card">
          <div class="feature-icon bg-light-red">💎</div>
          <div class="feature-text">
            <h4>Premium Quality</h4>
            <p>International standards with superior quality</p>
          </div>
        </div>
        <div class="feature-card">
          <div class="feature-icon bg-light-orange">🛡️</div>
          <div class="feature-text">
            <h4>Long Lasting</h4>
            <p>Durable protection for years to come</p>
          </div>
        </div>
        <div class="feature-card">
          <div class="feature-icon bg-light-green">🍃</div>
          <div class="feature-text">
            <h4>Eco Friendly</h4>
            <p>Low VOC, safe for you and the environment</p>
          </div>
        </div>
        <div class="feature-card">
          <div class="feature-icon bg-light-blue">👍</div>
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
          <NuxtLink to="/products" class="btn btn-outline">
            Find the Right Paint <span class="arrow">→</span>
          </NuxtLink>
        </div>
        
        <div class="categories-grid">
          <div class="category-card">
            <div class="card-img">
              <img src="/images/products/exterior.webp" alt="Home" style="width: 100%; height: 100%; object-fit: cover;" />
            </div>
            <div class="card-content">
              <div class="card-title-wrap">
                <div class="card-icon bg-red">🏠</div>
                <h3>Home</h3>
              </div>
            </div>
          </div>
          
          <div class="category-card">
            <div class="card-img">
              <img src="/images/products/interior.webp" alt="Office" style="width: 100%; height: 100%; object-fit: cover;" />
            </div>
            <div class="card-content">
              <div class="card-title-wrap">
                <div class="card-icon bg-orange">🏢</div>
                <h3>Office</h3>
              </div>
            </div>
          </div>
          
          <div class="category-card">
            <div class="card-img">
              <img src="/images/products/industrial.webp" alt="Factory" style="width: 100%; height: 100%; object-fit: cover;" />
            </div>
            <div class="card-content">
              <div class="card-title-wrap">
                <div class="card-icon bg-blue">🏭</div>
                <h3>Factory</h3>
              </div>
            </div>
          </div>
          
          <div class="category-card">
            <div class="card-img">
              <img src="/images/products/wood.webp" alt="Wood" style="width: 100%; height: 100%; object-fit: cover;" />
            </div>
            <div class="card-content">
              <div class="card-title-wrap">
                <div class="card-icon bg-green">🪵</div>
                <h3>Wood</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Best Selling Products -->
    <section class="products-section">
      <div class="container">
        <div class="section-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px;">
          <h2 class="section-title" style="margin-bottom: 0;">Best Selling Products</h2>
          <NuxtLink to="/products" class="text-red" style="font-weight: 600; display: flex; align-items: center; gap: 8px;">
            View All Products <span style="font-size: 18px;">→</span>
          </NuxtLink>
        </div>
        
        <div class="best-selling-grid" v-if="bestSellingProducts && bestSellingProducts.length > 0">
          <div class="best-selling-card" v-for="product in bestSellingProducts" :key="product.id">
            <NuxtLink :to="`/shop/${product.id}`" style="text-decoration: none; color: inherit;">
              <div class="img-wrapper" style="--splash-color: #ff003c;">
                <img :src="product.main_image || '/images/products/paint-bucket.webp'" :alt="product.name" class="bucket-img" />
              </div>
              <h4 class="product-name" v-html="product.name.replace(' ', '<br/>')"></h4>
              <p class="product-sub">{{ product.subtitle || product.category }}</p>
              <div class="size-pills">
                <span v-for="size in (product.pack_sizes || ['1L', '4L', '20L']).slice(0, 3)" :key="size">{{ size }}</span>
              </div>
            </NuxtLink>
          </div>
        </div>
        <div v-else class="text-center py-8 text-gray-500" style="grid-column: 1 / -1;">
          No best selling products added yet.
        </div>
      </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
      <div class="about-image">
        <img src="/images/home-page/ABOUT%20UNIVERSAL%20PAINTS.webp" alt="About Universal Paints" style="width: 100%; height: 100%; object-fit: cover;" />
      </div>
      <div class="about-content">
        <div class="section-subtitle">ABOUT UNIVERSAL PAINTS</div>
        <h2 class="section-title">A Legacy of Quality and Commitment</h2>
        <p class="about-desc">
          For over two decades, we have been committed to delivering innovative, reliable and sustainable paint solutions that beautify spaces and protect what matters most.
        </p>
        
        <div class="stats-grid">
          <div class="stat-item">
            <div class="stat-icon text-red">🏭</div>
            <div class="stat-number">20+</div>
            <div class="stat-label">Years of<br/>Excellence</div>
          </div>
          <div class="stat-item">
            <div class="stat-icon text-orange">🏪</div>
            <div class="stat-number text-orange">1000+</div>
            <div class="stat-label">Retailers<br/>Nationwide</div>
          </div>
          <div class="stat-item">
            <div class="stat-icon text-green">📦</div>
            <div class="stat-number text-green">500+</div>
            <div class="stat-label">Products<br/>Available</div>
          </div>
          <div class="stat-item">
            <div class="stat-icon text-blue">👥</div>
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
            Our wide distribution network ensures our products and services are always close to you.
          </p>
          <NuxtLink to="/network" class="btn btn-outline">
            Find a Distributor <span class="arrow text-red">→</span>
          </NuxtLink>
        </div>
        <div class="network-map">
          <div class="map-container">
            <img src="/images/srilanka-map.svg" alt="Sri Lanka Map" class="sl-map" />
            <!-- Location Pins (All Provinces except North) -->
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
            <li>Dedicated customer support</li>
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
            <div class="reason-icon bg-light-red text-red">🔬</div>
            <div class="reason-text">
              <h4>Innovation</h4>
              <p>Continuous research and development for better solutions</p>
            </div>
          </div>
          <div class="reason-card">
            <div class="reason-icon bg-light-orange text-orange">🏅</div>
            <div class="reason-text">
              <h4>Quality Assurance</h4>
              <p>Rigorous quality control at every step of production</p>
            </div>
          </div>
          <div class="reason-card">
            <div class="reason-icon bg-light-green text-green">🤝</div>
            <div class="reason-text">
              <h4>Customer First</h4>
              <p>Dedicated support and solutions for your needs</p>
            </div>
          </div>
          <div class="reason-card">
            <div class="reason-icon bg-light-blue text-blue">🚚</div>
            <div class="reason-text">
              <h4>Reliable Distribution</h4>
              <p>Strong distribution network ensuring on-time delivery</p>
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
  title: 'Home - Universal Paints',
})

const config = useRuntimeConfig()
const { data: allProducts } = await useFetch(`${config.public.apiBase}/api/products`)
const bestSellingProducts = computed(() => {
  if (!allProducts.value) return []
  return allProducts.value.filter(p => p.is_best_seller).slice(0, 6)
})

const isQuotePopupOpen = useState('quotePopup', () => false)
const openQuotePopup = () => {
  isQuotePopupOpen.value = true
}

const heroBackgrounds = [
  '/images/home-page/dark-hero-bg1.webp',
  '/images/home-page/dark-hero-bg2.webp',
  '/images/home-page/dark-hero-bg3.webp'
];
const currentBgIndex = ref(0);
let bgInterval;

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
  background-color: rgba(255, 255, 255, 0.1);
}
.btn-primary svg {
  margin-left: 8px;
}
.hero-image {
  position: relative;
  display: flex;
  justify-content: flex-end;
}

/* Features */
.features-section {
  padding: 40px 0;
  background-color: var(--bg-light);
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
  box-shadow: 0 10px 40px rgba(0,0,0,0.1);
  margin-top: -100px; /* Pulls grid up to overlap hero */
}
.feature-card {
  display: flex;
  align-items: center;
  gap: 15px;
  background: white;
  padding: 20px;
  border-radius: 12px;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
}
.feature-icon {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  flex-shrink: 0;
}
.feature-text h4 {
  font-size: 16px;
  font-weight: 700;
  margin-bottom: 4px;
}
.feature-text p {
  font-size: 13px;
  color: var(--text-light);
  line-height: 1.4;
}

/* Categories */
.categories-section {
  padding: 80px 0;
  background-color: var(--bg-light);
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
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
  transition: transform 0.3s;
}
.category-card:hover {
  transform: translateY(-5px);
}
.card-img {
  height: 200px;
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
  width: 40px;
  height: 40px;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 18px;
}
.bg-green { background-color: #10B981; }
.bg-blue { background-color: #3B82F6; }
.bg-orange { background-color: #F59E0B; }
.bg-red { background-color: #EF4444; }
.card-content h3 {
  font-size: 16px;
  font-weight: 700;
  margin: 0;
}

/* Best Selling Products */
.products-section {
  padding: 80px 0;
  background-color: var(--white);
}
.best-selling-grid {
  display: grid;
  grid-template-columns: repeat(6, 1fr);
  gap: 20px;
}
.best-selling-card {
  text-align: center;
  background: white;
  padding: 10px;
  border-radius: 12px;
  transition: transform 0.3s;
}
.best-selling-card:hover {
  transform: translateY(-5px);
}
.img-wrapper {
  position: relative;
  width: 100%;
  aspect-ratio: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 20px;
}
.img-wrapper::before {
  content: '';
  position: absolute;
  width: 70%;
  height: 70%;
  background: var(--splash-color);
  border-radius: 50%;
  filter: blur(20px);
  z-index: 1;
  opacity: 0.8;
}
.bucket-img {
  width: 80%;
  height: auto;
  position: relative;
  z-index: 2;
  mix-blend-mode: multiply;
}
.product-name {
  font-size: 12px;
  font-weight: 800;
  color: #111;
  line-height: 1.3;
  margin-bottom: 8px;
  min-height: 32px;
  text-transform: uppercase;
}
.product-sub {
  font-size: 11px;
  color: #666;
  margin-bottom: 15px;
  min-height: 26px;
}
.size-pills {
  display: flex;
  justify-content: center;
  gap: 6px;
}
.size-pills span {
  font-size: 9px;
  font-weight: 700;
  color: #333;
  border: 1px solid #eee;
  border-radius: 20px;
  padding: 2px 8px;
  background: #fff;
}

/* About Section */
.about-section {
  display: grid;
  grid-template-columns: 1fr 1fr;
}
.about-image {
  height: 100%;
  min-height: 350px;
  position: relative;
}
.about-image::after {
  content: '';
  position: absolute;
  top: 0;
  right: 0;
  width: 150px;
  height: 100%;
  background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
}
.about-content {
  padding: 50px 10%;
  background-color: var(--white);
}
.about-desc {
  font-size: 16px;
  color: var(--text-light);
  margin-bottom: 40px;
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
  font-size: 28px;
  margin-bottom: 10px;
}
.stat-number {
  font-size: 32px;
  font-weight: 800;
  margin-bottom: 5px;
}
.stat-label {
  font-size: 13px;
  color: var(--text-dark);
  font-weight: 600;
}

/* Network */
.network-section {
  padding: 80px 0;
  background-color: var(--bg-light);
}
.network-content {
  display: grid;
  grid-template-columns: 1fr 1.5fr 1fr;
  gap: 40px;
  align-items: center;
}
.network-desc {
  font-size: 16px;
  color: var(--text-light);
  margin-bottom: 30px;
}
/* Map styles */
.map-container {
  position: relative;
  width: 100%;
  height: 400px;
  display: flex;
  justify-content: center;
  transform: scale(1.3);
  margin-top: 50px;
  margin-bottom: 50px;
}
.sl-map {
  height: 100%;
  opacity: 0.9;
  filter: grayscale(80%) contrast(1.2);
}
.map-pin {
  position: absolute;
  width: 16px;
  height: 16px;
  background-color: var(--primary-red);
  border-radius: 50%;
  border: 3px solid white;
  box-shadow: 0 3px 6px rgba(0,0,0,0.3);
  cursor: pointer;
  animation: pulse 2s infinite;
}
@keyframes pulse {
  0% { box-shadow: 0 0 0 0 rgba(227, 0, 15, 0.4); }
  70% { box-shadow: 0 0 0 12px rgba(227, 0, 15, 0); }
  100% { box-shadow: 0 0 0 0 rgba(227, 0, 15, 0); }
}
/* Rough positioning for pins based on Sri Lanka's shape */
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
}
.check-list li {
  position: relative;
  padding-left: 30px;
  margin-bottom: 15px;
  font-size: 15px;
  color: var(--text-dark);
}
.check-list li::before {
  content: '✓';
  position: absolute;
  left: 0;
  top: 0;
  color: #10B981;
  font-weight: bold;
}

/* Why Us */
.why-us {
  padding: 80px 0;
  background-color: var(--white);
}
.reasons-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 30px;
}
.reason-card {
  display: flex;
  gap: 15px;
  padding: 20px;
  border-radius: 12px;
  background: var(--bg-light);
}
.reason-icon {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  flex-shrink: 0;
}
.reason-text h4 {
  font-size: 16px;
  font-weight: 700;
  margin-bottom: 8px;
}
.reason-text p {
  font-size: 13px;
  color: var(--text-light);
  line-height: 1.4;
}

/* Responsive */
@media (max-width: 1200px) {
  .hero-title { font-size: 48px; }
  .best-selling-grid { grid-template-columns: repeat(4, 1fr); }
  .categories-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 992px) {
  .hero { padding-top: 140px; padding-bottom: 160px; }
  .hero-content { grid-template-columns: 1fr; text-align: center; }
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
  .features-grid { grid-template-columns: repeat(2, 1fr); margin-top: -80px; }
  .about-section { grid-template-columns: 1fr; }
  .about-image { min-height: 300px; }
  .network-content { grid-template-columns: 1fr; }
  .map-container { transform: scale(1); margin-top: 20px; height: auto; }
  .sl-map { width: 100%; height: auto; object-fit: contain; }
  .reasons-grid { grid-template-columns: repeat(2, 1fr); }
  .best-selling-grid { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 768px) {
  .hero-title { font-size: 40px; }
  .best-selling-grid { grid-template-columns: repeat(2, 1fr); }
  .categories-grid { gap: 15px; }
}
@media (max-width: 576px) {
  .hero-title { font-size: 32px; }
  .hero-actions { flex-direction: column; width: 100%; }
  .hero-actions .btn { width: 100%; justify-content: center; }
  .features-grid { grid-template-columns: 1fr; margin-top: -60px; padding: 20px; }
  .categories-grid { grid-template-columns: 1fr; }
  .best-selling-grid { grid-template-columns: repeat(2, 1fr); gap: 10px; }
  .stats-grid { grid-template-columns: repeat(2, 1fr); }
  .reasons-grid { grid-template-columns: 1fr; }
  .section-header { flex-direction: column; align-items: flex-start; gap: 10px; }
  .cta-buttons { flex-direction: column; width: 100%; }
  .cta-buttons .btn { width: 100%; justify-content: center; }
  .cta-content h2 { font-size: 24px; }
  .about-content { padding: 40px 5%; }
}

</style>
