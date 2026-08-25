<template>
  <div class="product-page" v-if="product">
    <div class="container product-container">
      
      <!-- Top Section -->
      <div class="product-top">
        <!-- Left Column: Gallery -->
        <div class="product-gallery">
          <div class="breadcrumbs">
            <NuxtLink to="/">Home</NuxtLink>
            <span class="sep">&gt;</span>
            <NuxtLink to="/shop">Shop</NuxtLink>
            <span class="sep">&gt;</span>
            <NuxtLink :to="'/shop?category=' + product.category">{{ product.category || 'Paints' }}</NuxtLink>
            <span class="sep">&gt;</span>
            <span class="current">{{ product.name }}</span>
          </div>

          <div class="main-image-wrap">
            <div class="badge-best-seller" v-if="product.is_best_seller">BEST<br/>SELLER</div>
            <button class="nav-arrow left-arrow">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" /></svg>
            </button>
            <img :src="product.main_image || 'https://placehold.co/400x400/eee/999?text=Product'" :alt="product.name" class="main-image"/>
            <button class="nav-arrow right-arrow">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
            </button>
          </div>

          <div class="thumbnails" v-if="product.gallery && product.gallery.length > 0">
            <div class="thumb active">
              <img :src="product.main_image || 'https://placehold.co/400x400/eee/999?text=Product'" alt="Thumb 1" />
            </div>
            <div class="thumb" v-for="(img, idx) in product.gallery" :key="idx">
              <img :src="img" :alt="'Thumb ' + (idx+2)" />
            </div>
            <div class="thumb-more">
              <span>+2<br/>More</span>
            </div>
          </div>
        </div>

        <!-- Right Column: Info -->
        <div class="product-info">
          <h1 class="product-title">{{ product.name }}</h1>
          <p class="product-subtitle">{{ product.subtitle }}</p>
          
          <div class="rating-stock">
            <div class="rating">
              <span class="stars text-yellow">
                <svg v-for="i in 4" :key="i" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" /></svg>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 opacity-50"><path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" /></svg>
              </span>
              <span class="rating-text">{{ product.rating }} ({{ product.reviews }} reviews)</span>
            </div>
            <div class="divider">|</div>
            <div class="stock text-green" v-if="product.is_in_stock">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
              In Stock
            </div>
            <div class="stock text-red" v-else>
              Out of Stock
            </div>
          </div>

          <div class="price-wrap">
            <div class="price text-red">Rs. {{ product.price_min }} – Rs. {{ product.price_max }}</div>
            <div class="tax-info">Inclusive of all taxes</div>
          </div>

          <p class="description-short">{{ product.description }}</p>

          <div class="feature-badges" v-if="product.features && product.features.length > 0">
            <div class="badge text-orange" v-for="(feat, idx) in product.features" :key="idx">
              <span>{{ feat }}</span>
            </div>
          </div>

          <div class="selection-group" v-if="product.pack_sizes && product.pack_sizes.length > 0">
            <h4 class="selection-title">Select Pack Size</h4>
            <div class="pack-options">
              <div class="pack-box" v-for="pack in product.pack_sizes" :key="pack.size" :class="{active: selectedPack === pack.size}" @click="selectedPack = pack.size">
                <span class="pack-size">{{ pack.size }}</span>
                <span class="pack-price">Rs. {{ pack.price }}</span>
              </div>
            </div>
          </div>

          <div class="selection-group" v-if="product.colors && product.colors.length > 0">
            <h4 class="selection-title">Select Color</h4>
            <div class="color-selection">
              <div class="color-options">
                <div class="color-circle" v-for="c in product.colors" :key="c" :style="'background-color: ' + c"></div>
              </div>
              <button class="btn-view-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M4.098 19.902a3.75 3.75 0 0 0 5.304 0l6.401-6.402M6.75 21A3.75 3.75 0 0 1 3 17.25l7.22-7.22C10.554 9.696 11.233 9 12 9c.767 0 1.446.696 1.78 1.03l6.402 6.402" /></svg>
                View All Colors
              </button>
            </div>
          </div>

          <div class="actions-group">
            <div class="qty-selector">
              <button class="qty-btn" @click="if(qty > 1) qty--">-</button>
              <input type="text" class="qty-input" v-model="qty" readonly/>
              <button class="qty-btn" @click="qty++">+</button>
            </div>
            <button class="btn btn-red btn-add-cart" @click="addToCart">Add to Cart 🛒</button>
            <button class="btn btn-outline-red btn-buy-now">Buy Now 💳</button>
          </div>

          <div class="trust-badges">
            <div class="trust-badge">
              <svg class="text-green" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" /></svg>
              Secure Payment
            </div>
            <div class="trust-badge">
              <svg class="text-green" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
              Original Products
            </div>
            <div class="trust-badge">
              <svg class="text-green" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" /></svg>
              Fast Delivery
            </div>
          </div>
          
          <div class="share-actions">
            <span>Share:</span>
            <div class="social-icons">
              <div class="s-icon bg-blue"><svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></div>
              <div class="s-icon bg-light-blue"><svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg></div>
              <div class="s-icon bg-red"><svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.894 8.221l-1.97 9.283c-.145.658-.537.818-1.084.508l-3-2.21-1.446 1.394c-.14.18-.357.295-.6.295-.002 0-.003 0-.005 0l.213-3.054 5.56-5.022c.24-.213-.054-.334-.373-.121l-6.869 4.326-2.96-.924c-.64-.203-.658-.64.135-.954l11.566-4.458c.538-.196 1.006.128.832.941z"/></svg></div>
            </div>
          </div>
        </div>
      </div>

      <!-- Tabs Section -->
      <div class="product-tabs-section">
        <div class="tabs-nav">
          <button class="tab-btn active">Description</button>
          <button class="tab-btn">Key Features</button>
          <button class="tab-btn">Technical Details</button>
          <button class="tab-btn">How to Use</button>
          <button class="tab-btn">Reviews ({{ product.reviews }})</button>
          <button class="tab-btn">FAQs</button>
        </div>
        <div class="tab-content">
          <div class="tab-pane active description-pane">
            <div class="desc-text-col">
              <p>{{ product.description }}</p>
              <ul class="desc-features" v-if="product.features && product.features.length > 0">
                <li v-for="(feat, idx) in product.features" :key="idx">
                  <svg class="w-5 h-5 text-green" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                  {{ feat }}
                </li>
              </ul>
            </div>
            <div class="desc-img-col">
              <img src="/images/home-page/interior.jpg" alt="Interior Application" />
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Cross Sell Section -->
    <section class="cross-sell-section container">
      <h2 class="section-title text-center">Complete Your Painting System</h2>
      <div class="cross-sell-grid">
        <div class="cs-card">
          <div class="cs-img"><img src="/images/contact-us-page/paint-bucket.png" alt="Primer" /></div>
          <div class="cs-info">
            <h5>Surface Primer</h5>
            <p>Strong adhesion and better finish</p>
            <div class="cs-price">Rs. 4,250</div>
            <button class="btn-outline-red btn-cs-add">Add to Cart</button>
          </div>
        </div>
        <div class="cs-card">
          <div class="cs-img"><img src="/images/contact-us-page/paint-bucket.png" alt="Putty" /></div>
          <div class="cs-info">
            <h5>Wall Putty</h5>
            <p>Smoothens surface for perfect finish</p>
            <div class="cs-price">Rs. 2,450</div>
            <button class="btn-outline-red btn-cs-add">Add to Cart</button>
          </div>
        </div>
        <div class="cs-card">
          <div class="cs-img"><img src="https://placehold.co/100x100/eee/999?text=Roller" alt="Roller" /></div>
          <div class="cs-info">
            <h5>Paint Roller</h5>
            <p>For smooth and even application</p>
            <div class="cs-price">Rs. 750</div>
            <button class="btn-outline-red btn-cs-add">Add to Cart</button>
          </div>
        </div>
        <div class="cs-card">
          <div class="cs-img"><img src="https://placehold.co/100x100/eee/999?text=Brush" alt="Brush" /></div>
          <div class="cs-info">
            <h5>Paint Brush</h5>
            <p>High quality brush for best results</p>
            <div class="cs-price">Rs. 350</div>
            <button class="btn-outline-red btn-cs-add">Add to Cart</button>
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
  </div>
  <div class="loading-state" v-else-if="pending">
    <p>Loading product details...</p>
  </div>
  <div class="error-state" v-else>
    <p>Product not found.</p>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()
const { data: product, pending, error } = await useFetch(`http://127.0.0.1:8002/api/products/${route.params.id}`)

const selectedPack = ref('20L')
const qty = ref(1)

const cart = useState('cart', () => [])
const isCartOpen = useState('cartOpen', () => false)

const addToCart = () => {
  if (!product.value) return
  
  const price = product.value.pack_sizes?.find(p => p.size === selectedPack.value)?.price || product.value.price_min

  const newItem = {
    id: product.value.id,
    name: product.value.name,
    image: product.value.main_image || 'https://placehold.co/400x400/eee/999?text=Product',
    price: price,
    qty: qty.value,
    pack_size: selectedPack.value
  }

  const existingItemIndex = cart.value.findIndex(item => item.id === newItem.id && item.pack_size === newItem.pack_size)
  
  if (existingItemIndex > -1) {
    cart.value[existingItemIndex].qty += newItem.qty
  } else {
    cart.value.push(newItem)
  }

  isCartOpen.value = true
}
</script>

<style scoped>
.product-page {
  padding: 60px 0;
  background-color: #FAFAFA;
}
.product-container {
  background: white;
  padding: 0;
  border-radius: 24px;
}
.product-top {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 60px;
  padding: 40px;
}

/* Left Column: Gallery */
.breadcrumbs {
  font-size: 13px;
  color: #64748B;
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 24px;
}
.breadcrumbs a { color: #64748B; text-decoration: none; }
.breadcrumbs a:hover { color: #E3000F; }
.breadcrumbs .current { color: #E3000F; font-weight: 500; }
.sep { color: #CBD5E1; }

.main-image-wrap {
  position: relative;
  background: #F1F5F9;
  border-radius: 16px;
  padding: 40px;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 500px;
  margin-bottom: 20px;
}
.badge-best-seller {
  position: absolute;
  top: 20px;
  left: 20px;
  background: #E3000F;
  color: white;
  font-weight: 800;
  font-size: 12px;
  padding: 10px;
  border-radius: 8px;
  line-height: 1.2;
  text-align: center;
}
.main-image {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
}
.nav-arrow {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: white;
  border: 1px solid #E2E8F0;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  color: #475569;
  box-shadow: 0 4px 6px rgba(0,0,0,0.05);
}
.nav-arrow:hover { color: #0F172A; border-color: #CBD5E1; }
.left-arrow { left: 20px; }
.right-arrow { right: 20px; }
.nav-arrow svg { width: 20px; height: 20px; }

.thumbnails {
  display: flex;
  gap: 16px;
}
.thumb {
  flex: 1;
  height: 100px;
  border-radius: 12px;
  border: 2px solid transparent;
  background: #F8FAFC;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
}
.thumb img { width: 100%; height: 100%; object-fit: cover; }
.thumb.active { border-color: #E3000F; }
.thumb-more {
  flex: 1;
  height: 100px;
  border-radius: 12px;
  background: #F1F5F9;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
  font-weight: 700;
  color: #0F172A;
  text-align: center;
  cursor: pointer;
}

/* Right Column: Info */
.product-info {
  display: flex;
  flex-direction: column;
}
.product-title { font-size: 36px; font-weight: 800; color: #0F172A; margin: 0 0 8px 0; }
.product-subtitle { font-size: 16px; color: #475569; margin: 0 0 20px 0; }
.rating-stock { display: flex; align-items: center; gap: 16px; margin-bottom: 24px; }
.rating { display: flex; align-items: center; gap: 8px; }
.stars { display: flex; color: #F59E0B; }
.w-5 { width: 20px; } .h-5 { height: 20px; } .opacity-50 { opacity: 0.5; }
.text-yellow { color: #F59E0B; }
.rating-text { font-size: 14px; color: #475569; font-weight: 500; }
.divider { color: #E2E8F0; }
.stock { display: flex; align-items: center; gap: 6px; font-size: 14px; font-weight: 600; }
.text-green { color: #10B981; }

.price-wrap { margin-bottom: 24px; }
.price { font-size: 28px; font-weight: 800; color: #E3000F; margin-bottom: 4px; }
.tax-info { font-size: 13px; color: #64748B; }

.description-short { font-size: 15px; color: #475569; line-height: 1.6; margin-bottom: 30px; }

.feature-badges { display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 16px; margin-bottom: 30px; border-bottom: 1px solid #F1F5F9; padding-bottom: 30px; }
.badge { display: flex; align-items: center; gap: 10px; font-size: 13px; font-weight: 600; color: #0F172A; line-height: 1.2; }
.badge svg { width: 32px; height: 32px; flex-shrink: 0; }
.text-orange svg { color: #F59E0B; }
.text-blue svg { color: #3B82F6; }
.text-purple svg { color: #8B5CF6; }

.selection-group { margin-bottom: 30px; }
.selection-title { font-size: 15px; font-weight: 700; color: #0F172A; margin: 0 0 16px 0; }
.pack-options { display: flex; gap: 16px; }
.pack-box { flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 12px; border: 1px solid #E2E8F0; border-radius: 8px; cursor: pointer; transition: all 0.2s; }
.pack-box:hover { border-color: #CBD5E1; }
.pack-box.active { border-color: #E3000F; box-shadow: 0 0 0 1px #E3000F; }
.pack-size { font-size: 16px; font-weight: 700; color: #0F172A; margin-bottom: 4px; }
.pack-price { font-size: 12px; color: #64748B; }

.color-selection { display: flex; align-items: center; justify-content: space-between; }
.color-options { display: flex; gap: 10px; }
.color-circle { width: 32px; height: 32px; border-radius: 50%; cursor: pointer; border: 1px solid #E2E8F0; }
.btn-view-colors { background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 8px 16px; font-size: 13px; font-weight: 600; color: #475569; display: flex; align-items: center; gap: 6px; cursor: pointer; }

.actions-group { display: flex; gap: 16px; margin-bottom: 30px; }
.qty-selector { display: flex; align-items: center; border: 1px solid #E2E8F0; border-radius: 8px; overflow: hidden; }
.qty-btn { width: 40px; height: 48px; background: white; border: none; font-size: 18px; color: #475569; cursor: pointer; display: flex; justify-content: center; align-items: center; }
.qty-input { width: 40px; height: 48px; border: none; border-left: 1px solid #E2E8F0; border-right: 1px solid #E2E8F0; text-align: center; font-size: 16px; font-weight: 600; color: #0F172A; }
.btn { height: 48px; padding: 0 24px; border-radius: 8px; font-size: 15px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; transition: all 0.3s; flex: 1; }
.btn-red { background: #E3000F; color: white; border: none; box-shadow: 0 4px 12px rgba(227, 0, 15, 0.2); }
.btn-outline-red { background: transparent; color: #E3000F; border: 1px solid #E3000F; }

.trust-badges { display: flex; gap: 24px; padding-bottom: 24px; border-bottom: 1px solid #F1F5F9; margin-bottom: 24px; }
.trust-badge { display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 500; color: #475569; }
.trust-badge svg { width: 18px; height: 18px; }

.share-actions { display: flex; align-items: center; gap: 16px; }
.share-actions > span { font-size: 14px; font-weight: 600; color: #0F172A; }
.social-icons { display: flex; gap: 12px; }
.s-icon { width: 32px; height: 32px; border-radius: 50%; display: flex; justify-content: center; align-items: center; color: white; cursor: pointer; }
.bg-blue { background-color: #1877F2; }
.bg-light-blue { background-color: #1DA1F2; }
.bg-red { background-color: #E60023; }
.w-4 { width: 16px; } .h-4 { height: 16px; }

/* Tabs Section */
.product-tabs-section { padding: 40px; }
.tabs-nav { display: flex; border-bottom: 1px solid #E2E8F0; gap: 32px; margin-bottom: 30px; overflow-x: auto; }
.tab-btn { background: none; border: none; padding: 0 0 16px 0; font-size: 15px; font-weight: 600; color: #475569; cursor: pointer; border-bottom: 2px solid transparent; white-space: nowrap; transition: all 0.3s; }
.tab-btn:hover { color: #0F172A; }
.tab-btn.active { color: #E3000F; border-bottom-color: #E3000F; }

.description-pane { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center; }
.desc-text-col p { font-size: 15px; color: #475569; line-height: 1.6; margin-bottom: 24px; }
.desc-features { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 16px; }
.desc-features li { display: flex; align-items: center; gap: 12px; font-size: 14px; font-weight: 500; color: #0F172A; }
.desc-img-col img { width: 100%; border-radius: 16px; object-fit: cover; }

/* Cross Sell Section */
.cross-sell-section { margin-top: 60px; margin-bottom: 60px; }
.section-title { font-size: 24px; font-weight: 800; color: #0F172A; margin-bottom: 30px; text-align: center; }
.cross-sell-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; }
.cs-card { background: white; border: 1px solid #E2E8F0; border-radius: 16px; overflow: hidden; display: flex; align-items: center; padding: 20px; gap: 20px; transition: all 0.3s; }
.cs-card:hover { box-shadow: 0 12px 24px rgba(0,0,0,0.06); border-color: #CBD5E1; }
.cs-img { width: 80px; height: 80px; flex-shrink: 0; background: #F8FAFC; border-radius: 12px; display: flex; justify-content: center; align-items: center; }
.cs-img img { max-width: 100%; max-height: 100%; object-fit: contain; }
.cs-info { display: flex; flex-direction: column; flex-grow: 1; }
.cs-info h5 { font-size: 15px; font-weight: 700; color: #0F172A; margin: 0 0 4px 0; }
.cs-info p { font-size: 12px; color: #64748B; line-height: 1.4; margin: 0 0 10px 0; }
.cs-price { font-size: 15px; font-weight: 800; color: #0F172A; margin-bottom: 12px; }
.btn-cs-add { height: 32px; padding: 0 16px; font-size: 12px; border-radius: 16px; }

/* Features Banner */
.shop-features { padding: 60px 0; background-color: white; border-top: 1px solid #F1F5F9; }
.features-wrap { display: flex; justify-content: space-between; gap: 24px; flex-wrap: wrap; }
.feature-item { display: flex; align-items: center; gap: 16px; flex: 1; min-width: 200px; }
.feature-icon { width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background-color: #F8FAFC; }
.feature-icon svg { width: 24px; height: 24px; }
.feature-text { display: flex; flex-direction: column; gap: 4px; }
.feature-text strong { font-size: 15px; font-weight: 700; color: #0F172A; }
.feature-text span { font-size: 13px; color: #64748B; }

@media (max-width: 991px) {
  .product-top { grid-template-columns: 1fr; }
  .description-pane { grid-template-columns: 1fr; }
  .cross-sell-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 768px) {
  .cross-sell-grid { grid-template-columns: 1fr; }
  .features-wrap { flex-direction: column; gap: 30px; }
}
</style>
