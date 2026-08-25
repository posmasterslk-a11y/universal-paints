<template>
  <header class="header" :class="{ 'is-scrolled': shouldBeLight }">
    <div class="header-content">
      <div class="logo">
        <NuxtLink to="/">
          <img :src="shouldBeLight ? '/images/logo/Logo.webp' : '/images/logo/logo-white.webp'" alt="Universal Paints Logo" />
        </NuxtLink>
      </div>
      <nav class="nav">
        <ul>
          <li><NuxtLink to="/" exact-active-class="active">Home</NuxtLink></li>
          <li><NuxtLink to="/shop" exact-active-class="active">Shop</NuxtLink></li>
          <li><NuxtLink to="/about" exact-active-class="active">About Us</NuxtLink></li>
          <li><NuxtLink to="/blog" exact-active-class="active">Blog</NuxtLink></li>
          <li><NuxtLink to="/contact" exact-active-class="active">Contact Us</NuxtLink></li>
        </ul>
      </nav>
      <div class="header-actions">
        <button class="icon-btn search-btn">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
        </button>
        <button class="icon-btn cart-btn" @click="openCart">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" /></svg>
          <span class="cart-badge" v-if="cartItemsCount > 0">{{ cartItemsCount }}</span>
        </button>
        <button @click="openQuotePopup" class="btn btn-primary btn-quote">
          Get a Quote
          <span class="arrow">→</span>
        </button>
        <!-- Hamburger Menu Button -->
        <button class="icon-btn menu-toggle-btn" @click="toggleMobileMenu">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
        </button>
      </div>
    </div>
  </header>

  <!-- Mobile Menu Overlay -->
  <div class="mobile-menu-overlay" :class="{ 'is-open': isMobileMenuOpen }" @click="toggleMobileMenu"></div>

  <!-- Mobile Drawer Menu -->
  <div class="mobile-drawer" :class="{ 'is-open': isMobileMenuOpen }">
    <div class="drawer-header">
      <img src="/images/logo/Logo.webp" alt="Universal Paints Logo" class="drawer-logo" />
      <button class="close-drawer-btn" @click="toggleMobileMenu">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
      </button>
    </div>
    <nav class="drawer-nav">
      <ul>
        <li><NuxtLink to="/" exact-active-class="active" @click="toggleMobileMenu">Home</NuxtLink></li>
        <li><NuxtLink to="/shop" exact-active-class="active" @click="toggleMobileMenu">Shop</NuxtLink></li>
        <li><NuxtLink to="/about" exact-active-class="active" @click="toggleMobileMenu">About Us</NuxtLink></li>
        <li><NuxtLink to="/blog" exact-active-class="active" @click="toggleMobileMenu">Blog</NuxtLink></li>
        <li><NuxtLink to="/contact" exact-active-class="active" @click="toggleMobileMenu">Contact Us</NuxtLink></li>
      </ul>
    </nav>
    <div class="drawer-footer">
      <div class="social-icons">
        <a href="#" class="social-icon" aria-label="Facebook">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
        </a>
        <a href="#" class="social-icon" aria-label="Instagram">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
        </a>
      </div>
      <p>&copy; 2024 Universal Paints</p>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed, watch } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
const isScrolled = ref(false);

const isQuotePopupOpen = useState('quotePopup', () => false);
const openQuotePopup = () => {
  isQuotePopupOpen.value = true;
};

const isCartOpen = useState('cartOpen', () => false);
const cart = useState('cart', () => []);
const openCart = () => {
  isCartOpen.value = true;
};
const cartItemsCount = computed(() => {
  return cart.value.reduce((total, item) => total + item.qty, 0);
});

const isMobileMenuOpen = ref(false);
const toggleMobileMenu = () => {
  isMobileMenuOpen.value = !isMobileMenuOpen.value;
  // Prevent scrolling when drawer is open
  if (isMobileMenuOpen.value) {
    document.body.style.overflow = 'hidden';
  } else {
    document.body.style.overflow = '';
  }
};

// Close menu when route changes
watch(route, () => {
  if (isMobileMenuOpen.value) {
    toggleMobileMenu();
  }
});

const isHomePage = computed(() => route.path === '/');
const shouldBeLight = computed(() => !isHomePage.value || isScrolled.value);

const handleScroll = () => {
  isScrolled.value = window.scrollY > 50;
};

onMounted(() => {
  window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll);
  document.body.style.overflow = '';
});
</script>

<style scoped>
.header {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  padding: 15px 0;
  z-index: 1000;
  background-color: transparent;
  transition: background-color 0.3s ease, padding 0.3s ease, box-shadow 0.3s ease;
}
.header.is-scrolled {
  background-color: rgba(255, 255, 255, 0.95);
  background-image: none;
  padding: 10px 0;
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
  backdrop-filter: blur(10px);
}
.header-content {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 80px;
  width: 100%;
  max-width: 100%;
  margin: 0 auto;
}
.logo img {
  height: 60px;
}
.nav-link {
  text-decoration: none;
  color: #FFFFFF;
  font-weight: 500;
  font-size: 16px;
  position: relative;
  transition: color 0.3s ease;
}
.nav ul {
  display: flex;
  gap: 30px;
}
.nav a {
  font-weight: 600;
  font-size: 15px;
  color: #FFFFFF;
  transition: color 0.3s;
  padding-bottom: 5px;
}
.nav a:hover, .nav a.active {
  color: var(--primary-red);
}
.nav a.active {
  border-bottom: 2px solid var(--primary-red);
}

.header-actions {
  display: flex;
  align-items: center;
  gap: 16px;
}
.icon-btn {
  background: none;
  border: none;
  color: #fff;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  transition: background-color 0.3s;
  position: relative;
}
.header.is-scrolled .icon-btn {
  color: #1F2937;
}
.icon-btn:hover {
  background-color: rgba(255, 255, 255, 0.1);
}
.header.is-scrolled .icon-btn:hover {
  background-color: rgba(0, 0, 0, 0.05);
}
.icon-btn svg {
  width: 22px;
  height: 22px;
}
.cart-badge {
  position: absolute;
  top: 4px;
  right: 2px;
  background-color: var(--primary-red);
  color: white;
  font-size: 11px;
  font-weight: bold;
  width: 18px;
  height: 18px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 2px solid transparent;
}
.header.is-scrolled .cart-badge {
  border-color: white;
}

/* Scrolled State Font Colors */
.header.is-scrolled .nav a {
  color: #1F2937; /* Dark Grey for white background */
}
.header.is-scrolled .nav a:hover, 
.header.is-scrolled .nav a.active {
  color: var(--primary-red);
}
.btn-quote {
  padding: 10px 20px;
  font-size: 15px;
  background: linear-gradient(90deg, #E3000F 0%, #E3000F 70%, #ff5e00 100%);
  border: none;
  box-shadow: 0 4px 6px rgba(227, 0, 15, 0.2);
}
.btn-quote:hover {
  background: linear-gradient(90deg, #c4000d 0%, #c4000d 70%, #e65500 100%);
  transform: translateY(-2px);
}
.arrow {
  margin-left: 10px;
  background-color: white;
  color: var(--primary-red);
  border-radius: 50%;
  width: 24px;
  height: 24px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 14px;
}

.menu-toggle-btn {
  display: none; /* Hidden by default */
}

/* Mobile Drawer Menu */
.mobile-menu-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  backdrop-filter: blur(4px);
  z-index: 1050;
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.3s ease, visibility 0.3s ease;
}
.mobile-menu-overlay.is-open {
  opacity: 1;
  visibility: visible;
}

.mobile-drawer {
  position: fixed;
  top: 0;
  left: -320px;
  width: 300px;
  height: 100%;
  background-color: #ffffff;
  z-index: 1100;
  box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  display: flex;
  flex-direction: column;
}
.mobile-drawer.is-open {
  transform: translateX(320px); /* slide in */
}

.drawer-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px;
  border-bottom: 1px solid #f0f0f0;
}
.drawer-logo {
  height: 40px;
}
.close-drawer-btn {
  background: none;
  border: none;
  color: #333;
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  cursor: pointer;
  transition: background-color 0.2s;
}
.close-drawer-btn:hover {
  background-color: #f5f5f5;
}
.close-drawer-btn svg {
  width: 24px;
  height: 24px;
}

.drawer-nav {
  padding: 20px 0;
  flex-grow: 1;
  overflow-y: auto;
}
.drawer-nav ul {
  list-style: none;
  padding: 0;
  margin: 0;
}
.drawer-nav li {
  border-bottom: 1px solid #f9f9f9;
}
.drawer-nav a {
  display: block;
  padding: 16px 20px;
  font-size: 16px;
  font-weight: 600;
  color: #333;
  text-decoration: none;
  transition: color 0.2s, background-color 0.2s;
}
.drawer-nav a:hover, .drawer-nav a.active {
  color: var(--primary-red);
  background-color: #fdf2f2;
}

.drawer-footer {
  padding: 20px;
  border-top: 1px solid #f0f0f0;
  background-color: #fcfcfc;
}
.social-icons {
  display: flex;
  gap: 12px;
  margin-bottom: 10px;
}
.social-icon {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background-color: #f0f0f0;
  color: #333;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background-color 0.3s, color 0.3s;
}
.social-icon:hover {
  background-color: var(--primary-red);
  color: white;
}
.drawer-footer p {
  font-size: 13px;
  color: #888;
  margin: 0;
}

@media (max-width: 992px) {
  .header-content { justify-content: space-between; gap: 20px; padding: 0 20px; }
  .nav {
    display: none;
  }
  .menu-toggle-btn {
    display: flex; /* Show hamburger on mobile */
  }
}
@media (max-width: 576px) {
  .header-actions { gap: 8px; }
  .btn-quote { padding: 8px 12px; font-size: 13px; }
  .arrow { display: none; }
  .logo img { height: 40px; }
}
</style>
