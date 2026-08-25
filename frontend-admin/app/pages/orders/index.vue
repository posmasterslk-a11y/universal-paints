<template>
  <div>
    <div class="mb-8 flex justify-between items-center">
      <div>
        <h1 class="text-3xl font-extrabold text-slate-900">Orders</h1>
        <p class="text-slate-500 mt-1">Manage customer orders</p>
      </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
          <thead class="bg-slate-50 text-slate-500 font-semibold uppercase text-xs tracking-wider border-b border-slate-100">
            <tr>
              <th class="px-6 py-4">Order ID</th>
              <th class="px-6 py-4">Date</th>
              <th class="px-6 py-4">Customer</th>
              <th class="px-6 py-4">Total Amount</th>
              <th class="px-6 py-4">Status</th>
              <th class="px-6 py-4">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            <tr v-for="order in orders" :key="order.id" class="hover:bg-slate-50">
              <td class="px-6 py-4 font-bold text-slate-900">#{{ order.id }}</td>
              <td class="px-6 py-4 text-slate-600">{{ new Date(order.created_at).toLocaleDateString() }}</td>
              <td class="px-6 py-4">
                <p class="font-bold text-slate-900">{{ order.customer_name }}</p>
                <p class="text-xs text-slate-500">{{ order.customer_phone }}</p>
              </td>
              <td class="px-6 py-4 text-slate-600 font-medium">LKR {{ order.total_amount?.toLocaleString() }}</td>
              <td class="px-6 py-4">
                <span :class="statusClass(order.status)">{{ order.status }}</span>
              </td>
              <td class="px-6 py-4">
                <NuxtLink :to="`/orders/${order.id}`" class="text-blue-600 hover:text-blue-800 font-medium transition flex items-center">
                  View Details <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                </NuxtLink>
              </td>
            </tr>
            <tr v-if="orders.length === 0">
              <td colspan="6" class="px-6 py-12 text-center text-slate-500">No orders found yet.</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const { token } = useAuth()

const { data: ordersData } = await useFetch('http://127.0.0.1:8002/api/orders', {
  headers: {
    Authorization: `Bearer ${token.value}`
  }
})

const orders = computed(() => ordersData.value || [])

const statusClass = (status) => {
  switch(status) {
    case 'Pending': return 'text-yellow-600 bg-yellow-50 px-3 py-1 rounded-full text-xs font-bold'
    case 'Processing': return 'text-blue-600 bg-blue-50 px-3 py-1 rounded-full text-xs font-bold'
    case 'Shipped': return 'text-purple-600 bg-purple-50 px-3 py-1 rounded-full text-xs font-bold'
    case 'Delivered': return 'text-green-600 bg-green-50 px-3 py-1 rounded-full text-xs font-bold'
    case 'Cancelled': return 'text-red-600 bg-red-50 px-3 py-1 rounded-full text-xs font-bold'
    default: return 'text-slate-600 bg-slate-50 px-3 py-1 rounded-full text-xs font-bold'
  }
}
</script>
