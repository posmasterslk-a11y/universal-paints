<template>
  <header class="header" :class="{ 'is-scrolled': shouldBeLight }">
    <div class="header-content">
      <div class="logo">
        <NuxtLink to="/">
          <img :src="shouldBeLight ? '/images/logo/Logo.png' : '/images/logo/logo-white.png'" alt="Universal Paints Logo" />
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
      </div>
    </div>
  </header>
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue';
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

@media (max-width: 992px) {
  .nav {
    display: none; /* Add a mobile menu later if requested */
  }
}
</style>
