<template>
  <div class="mobile-bottom-nav">
    <NuxtLink to="/" exact-active-class="active" class="nav-item">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /></svg>
      <span>Home</span>
    </NuxtLink>

    <NuxtLink to="/shop" exact-active-class="active" class="nav-item">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" /></svg>
      <span>Products</span>
    </NuxtLink>

    <NuxtLink to="/contact" exact-active-class="active" class="nav-item">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" /></svg>
      <span>Contact</span>
    </NuxtLink>

    <button @click="toggleMobileMenu" class="nav-item" :class="{ 'active': isMobileMenuOpen }">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
      <span>Menu</span>
    </button>
  </div>
</template>

<script setup>
import { computed } from 'vue';

const isMobileMenuOpen = useState('mobileMenuOpen', () => false);
const toggleMobileMenu = () => {
  isMobileMenuOpen.value = !isMobileMenuOpen.value;
  if (isMobileMenuOpen.value) {
    document.body.style.overflow = 'hidden';
  } else {
    document.body.style.overflow = '';
  }
};

const isCartOpen = useState('cartOpen', () => false);
const cart = useState('cart', () => []);
const openCart = () => {
  isCartOpen.value = true;
};
const cartItemsCount = computed(() => {
  return cart.value.reduce((total, item) => total + item.qty, 0);
});
</script>

<style scoped>
.mobile-bottom-nav {
  display: none; /* Hidden on desktop */
  position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;
  background-color: #ffffff;
  box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.05);
  z-index: 999;
  justify-content: space-around;
  align-items: center;
  padding: 8px 0;
  border-top: 1px solid #f0f0f0;
}

@media (max-width: 768px) {
  .mobile-bottom-nav {
    display: flex;
  }
}

.nav-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  background: none;
  border: none;
  color: #666;
  font-size: 11px;
  font-weight: 500;
  cursor: pointer;
  transition: color 0.2s;
  flex: 1;
}

.nav-item svg {
  width: 24px;
  height: 24px;
  margin-bottom: 4px;
  stroke-width: 1.8;
}

.nav-item.active, .nav-item:active {
  color: #E3000F; /* Universal Paints Red */
}

.cart-icon-wrapper {
  position: relative;
  display: inline-flex;
}

.cart-badge {
  position: absolute;
  top: -4px;
  right: -8px;
  background-color: #E3000F;
  color: white;
  font-size: 10px;
  font-weight: bold;
  width: 16px;
  height: 16px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 2px solid white;
}
</style>
