<template>
  <div>
    <div class="mb-8 flex justify-between items-center">
      <div>
        <h1 class="text-3xl font-extrabold text-slate-900">Order #{{ orderId }}</h1>
        <p class="text-slate-500 mt-1">View and manage order details</p>
      </div>
      <NuxtLink to="/orders" class="text-slate-500 hover:text-slate-700 font-medium flex items-center transition">
        <i class="fa-solid fa-arrow-left mr-2"></i> Back to Orders
      </NuxtLink>
    </div>

    <div v-if="pending" class="text-center py-12 text-slate-500">
      Loading order details...
    </div>

    <div v-else-if="error" class="text-center py-12 text-red-500">
      Failed to load order.
    </div>

    <div v-else-if="order" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      
      <!-- Left Column: Items and Status -->
      <div class="lg:col-span-2 space-y-8">
        
        <!-- Order Items -->
        <div class="bg-white rounded-xl shadow-sm p-6">
          <h2 class="text-xl font-bold text-slate-900 mb-6">Order Items</h2>
          <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
              <thead class="bg-slate-50 text-slate-500 font-semibold uppercase text-xs">
                <tr>
                  <th class="px-4 py-3">Product</th>
                  <th class="px-4 py-3">Size</th>
                  <th class="px-4 py-3 text-right">Price</th>
                  <th class="px-4 py-3 text-center">Qty</th>
                  <th class="px-4 py-3 text-right">Total</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100">
                <tr v-for="item in order.items" :key="item.id">
                  <td class="px-4 py-4 font-medium text-slate-900">{{ item.product_name }}</td>
                  <td class="px-4 py-4 text-slate-600">{{ item.pack_size }}</td>
                  <td class="px-4 py-4 text-right text-slate-600">LKR {{ item.unit_price?.toLocaleString() }}</td>
                  <td class="px-4 py-4 text-center font-bold text-slate-900">{{ item.quantity }}</td>
                  <td class="px-4 py-4 text-right font-bold text-red-600">LKR {{ item.total_price?.toLocaleString() }}</td>
                </tr>
              </tbody>
              <tfoot class="bg-slate-50 border-t border-slate-200">
                <tr>
                  <td colspan="4" class="px-4 py-4 text-right font-bold text-slate-900">Grand Total</td>
                  <td class="px-4 py-4 text-right font-bold text-red-600 text-lg">LKR {{ order.total_amount?.toLocaleString() }}</td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>

      </div>

      <!-- Right Column: Customer and Status Management -->
      <div class="space-y-8">
        
        <!-- Status Management -->
        <div class="bg-white rounded-xl shadow-sm p-6">
          <h2 class="text-xl font-bold text-slate-900 mb-4">Order Status</h2>
          
          <div v-if="successMsg" class="bg-green-50 text-green-600 p-3 rounded-lg mb-4 border border-green-200 text-sm">
            {{ successMsg }}
          </div>
          
          <form @submit.prevent="updateStatus">
            <label class="block text-sm font-semibold text-slate-700 mb-2">Update Status</label>
            <select v-model="statusForm" class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:border-red-600 focus:ring-2 focus:ring-red-600/20 outline-none transition bg-white mb-4">
              <option value="Pending">Pending</option>
              <option value="Processing">Processing</option>
              <option value="Shipped">Shipped</option>
              <option value="Delivered">Delivered</option>
              <option value="Cancelled">Cancelled</option>
            </select>
            <button type="submit" :disabled="isUpdating" class="w-full bg-slate-900 hover:bg-slate-800 text-white font-bold py-2 px-4 rounded-lg transition disabled:opacity-70">
              {{ isUpdating ? 'Updating...' : 'Save Status' }}
            </button>
          </form>
        </div>

        <!-- Customer Details -->
        <div class="bg-white rounded-xl shadow-sm p-6">
          <h2 class="text-xl font-bold text-slate-900 mb-4">Customer Details</h2>
          <div class="space-y-4 text-sm text-slate-700">
            <div>
              <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Name</p>
              <p class="font-medium text-slate-900">{{ order.customer_name }}</p>
            </div>
            <div>
              <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Email</p>
              <a :href="`mailto:${order.customer_email}`" class="font-medium text-blue-600 hover:underline">{{ order.customer_email }}</a>
            </div>
            <div>
              <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Phone</p>
              <a :href="`tel:${order.customer_phone}`" class="font-medium text-blue-600 hover:underline">{{ order.customer_phone }}</a>
            </div>
            <div>
              <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Delivery Address</p>
              <p class="bg-slate-50 p-3 rounded-lg border border-slate-100 whitespace-pre-wrap">{{ order.delivery_address }}</p>
            </div>
            <div>
              <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Order Date</p>
              <p>{{ new Date(order.created_at).toLocaleString() }}</p>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</template>

<script setup>
import { ref, watchEffect } from 'vue'
import { useRoute } from 'vue-router'

const { token } = useAuth()
const route = useRoute()
const orderId = route.params.id

const { data: order, pending, error, refresh } = await useFetch(`http://127.0.0.1:8002/api/orders/${orderId}`, {
  headers: {
    Authorization: `Bearer ${token.value}`
  }
})

const statusForm = ref('')
const isUpdating = ref(false)
const successMsg = ref('')

// Initialize status form when data loads
watchEffect(() => {
  if (order.value) {
    statusForm.value = order.value.status
  }
})

const updateStatus = async () => {
  isUpdating.value = true
  successMsg.value = ''
  
  try {
    await $fetch(`http://127.0.0.1:8002/api/orders/${orderId}/status`, {
      method: 'PUT',
      headers: {
        Authorization: `Bearer ${token.value}`
      },
      body: { status: statusForm.value }
    })
    successMsg.value = 'Status updated successfully'
    refresh()
  } catch (err) {
    alert('Failed to update status')
  } finally {
    isUpdating.value = false
  }
}
</script>
