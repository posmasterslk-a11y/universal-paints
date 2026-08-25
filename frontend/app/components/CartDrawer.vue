<template>
  <div>
    <!-- Backdrop -->
    <div v-if="isOpen" class="cart-backdrop" @click="closeCart"></div>

    <!-- Drawer -->
    <div class="cart-drawer" :class="{ 'is-open': isOpen }">
      <div class="cart-header">
        <h2>Your Cart ({{ totalItems }})</h2>
        <button class="close-btn" @click="closeCart">&times;</button>
      </div>

      <div class="cart-body">
        <div v-if="cart.length === 0" class="empty-cart">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>
          <p>Your cart is empty.</p>
          <button class="btn btn-outline-red mt-4" @click="closeCart">Continue Shopping</button>
        </div>
        
        <div v-else class="cart-items">
          <div class="cart-item" v-for="(item, index) in cart" :key="index">
            <div class="item-img">
              <img :src="item.image" :alt="item.name" />
            </div>
            <div class="item-details">
              <h4>{{ item.name }}</h4>
              <p class="item-meta" v-if="item.pack_size || item.color">
                <span v-if="item.pack_size">{{ item.pack_size }}</span>
                <span v-if="item.pack_size && item.color"> | </span>
                <span v-if="item.color" class="color-dot" :style="{ backgroundColor: item.color }"></span>
              </p>
              <div class="item-price">Rs. {{ formatPrice(item.price) }}</div>
              
              <div class="item-actions">
                <div class="qty-selector">
                  <button @click="updateQty(index, -1)">-</button>
                  <input type="text" :value="item.qty" readonly />
                  <button @click="updateQty(index, 1)">+</button>
                </div>
                <button class="remove-btn" @click="removeItem(index)">Remove</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="cart-footer" v-if="cart.length > 0">
        <div class="subtotal">
          <span>Subtotal:</span>
          <strong>Rs. {{ formatPrice(subtotal) }}</strong>
        </div>
        <p class="tax-note">Taxes and shipping calculated at checkout</p>
        <button class="btn btn-red w-100 btn-checkout">Proceed to Checkout</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const isOpen = useState('cartOpen', () => false)
const cart = useState('cart', () => [])

const closeCart = () => {
  isOpen.value = false
}

const totalItems = computed(() => {
  return cart.value.reduce((total, item) => total + item.qty, 0)
})

const subtotal = computed(() => {
  return cart.value.reduce((total, item) => total + (item.price * item.qty), 0)
})

const updateQty = (index, change) => {
  const newQty = cart.value[index].qty + change
  if (newQty > 0) {
    cart.value[index].qty = newQty
  }
}

const removeItem = (index) => {
  cart.value.splice(index, 1)
}

const formatPrice = (price) => {
  return Number(price).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })
}
</script>

<style scoped>
.cart-backdrop {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(15, 23, 42, 0.5);
  backdrop-filter: blur(2px);
  z-index: 10000;
  transition: opacity 0.3s ease;
}

.cart-drawer {
  position: fixed;
  top: 0;
  right: -450px;
  width: 100%;
  max-width: 400px;
  height: 100vh;
  background: white;
  z-index: 10001;
  display: flex;
  flex-direction: column;
  transition: right 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: -5px 0 25px rgba(0, 0, 0, 0.1);
}

.cart-drawer.is-open {
  right: 0;
}

.cart-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px 24px;
  border-bottom: 1px solid #F1F5F9;
}

.cart-header h2 {
  font-size: 20px;
  font-weight: 700;
  color: #0F172A;
  margin: 0;
}

.close-btn {
  background: #F1F5F9;
  border: none;
  width: 32px;
  height: 32px;
  border-radius: 50%;
  font-size: 20px;
  color: #475569;
  cursor: pointer;
  display: flex;
  justify-content: center;
  align-items: center;
  transition: all 0.2s;
}

.close-btn:hover {
  background: #E2E8F0;
  color: #E3000F;
}

.cart-body {
  flex-grow: 1;
  overflow-y: auto;
  padding: 24px;
}

.empty-cart {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100%;
  text-align: center;
  color: #64748B;
}

.empty-cart svg {
  width: 64px;
  height: 64px;
  margin-bottom: 16px;
  color: #CBD5E1;
}

.empty-cart p {
  font-size: 16px;
  margin: 0;
}

.cart-items {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.cart-item {
  display: flex;
  gap: 16px;
  padding-bottom: 20px;
  border-bottom: 1px solid #F1F5F9;
}

.item-img {
  width: 80px;
  height: 80px;
  background: #F8FAFC;
  border-radius: 8px;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 10px;
  flex-shrink: 0;
}

.item-img img {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
}

.item-details {
  flex-grow: 1;
  display: flex;
  flex-direction: column;
}

.item-details h4 {
  font-size: 15px;
  font-weight: 600;
  color: #0F172A;
  margin: 0 0 4px 0;
  line-height: 1.4;
}

.item-meta {
  font-size: 12px;
  color: #64748B;
  margin: 0 0 8px 0;
  display: flex;
  align-items: center;
  gap: 4px;
}

.color-dot {
  display: inline-block;
  width: 12px;
  height: 12px;
  border-radius: 50%;
  border: 1px solid #E2E8F0;
}

.item-price {
  font-size: 14px;
  font-weight: 700;
  color: #E3000F;
  margin-bottom: 10px;
}

.item-actions {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: auto;
}

.qty-selector {
  display: flex;
  align-items: center;
  border: 1px solid #E2E8F0;
  border-radius: 6px;
  overflow: hidden;
}

.qty-selector button {
  width: 28px;
  height: 28px;
  background: white;
  border: none;
  font-size: 16px;
  color: #475569;
  cursor: pointer;
  display: flex;
  justify-content: center;
  align-items: center;
}

.qty-selector button:hover {
  background: #F8FAFC;
}

.qty-selector input {
  width: 32px;
  height: 28px;
  border: none;
  border-left: 1px solid #E2E8F0;
  border-right: 1px solid #E2E8F0;
  text-align: center;
  font-size: 13px;
  font-weight: 600;
  color: #0F172A;
  outline: none;
  pointer-events: none;
}

.remove-btn {
  background: none;
  border: none;
  color: #64748B;
  font-size: 13px;
  cursor: pointer;
  text-decoration: underline;
}

.remove-btn:hover {
  color: #E3000F;
}

.cart-footer {
  padding: 24px;
  background: #F8FAFC;
  border-top: 1px solid #E2E8F0;
}

.subtotal {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 8px;
  font-size: 16px;
  color: #0F172A;
}

.subtotal strong {
  font-size: 20px;
  font-weight: 800;
}

.tax-note {
  font-size: 12px;
  color: #64748B;
  margin: 0 0 20px 0;
  text-align: center;
}

.btn-red {
  background: #E3000F;
  color: white;
  padding: 14px 24px;
  border: none;
  border-radius: 30px;
  font-size: 15px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s;
  box-shadow: 0 4px 12px rgba(227, 0, 15, 0.2);
}

.btn-red:hover {
  background: #C8000D;
  transform: translateY(-2px);
}

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

.btn-outline-red:hover {
  background: #FEF2F2;
}

.w-100 {
  width: 100%;
}
</style>
