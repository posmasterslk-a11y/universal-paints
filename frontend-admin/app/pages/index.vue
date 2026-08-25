<template>
  <div>
    <div class="mb-8">
      <h1 class="text-3xl font-extrabold text-slate-900">Dashboard</h1>
      <p class="text-slate-500 mt-1">Welcome back, {{ user?.name || 'Admin' }}</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
      <div class="bg-white p-6 rounded-xl shadow-sm flex items-center gap-6">
        <div class="w-14 h-14 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center text-2xl">
          <i class="fa-solid fa-box-open"></i>
        </div>
        <div>
          <h3 class="text-slate-500 font-semibold text-sm">Total Products</h3>
          <p class="text-3xl font-extrabold text-slate-900">{{ products.length || 0 }}</p>
        </div>
      </div>
      
      <div class="bg-white p-6 rounded-xl shadow-sm flex items-center gap-6">
        <div class="w-14 h-14 rounded-xl bg-red-50 text-red-500 flex items-center justify-center text-2xl">
          <i class="fa-solid fa-shopping-cart"></i>
        </div>
        <div>
          <h3 class="text-slate-500 font-semibold text-sm">Total Orders</h3>
          <p class="text-3xl font-extrabold text-slate-900">0</p>
        </div>
      </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
      <div class="p-6 border-b border-slate-100 flex justify-between items-center">
        <h2 class="text-xl font-bold text-slate-900">Recent Products</h2>
        <NuxtLink to="/products/create" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
          Add New Product
        </NuxtLink>
      </div>
      <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
          <thead class="bg-slate-50 text-slate-500 font-semibold uppercase text-xs tracking-wider">
            <tr>
              <th class="px-6 py-4">Image</th>
              <th class="px-6 py-4">Product</th>
              <th class="px-6 py-4">Category</th>
              <th class="px-6 py-4">Price</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            <tr v-for="product in products.slice(0, 5)" :key="product.id" class="hover:bg-slate-50">
              <td class="px-6 py-4">
                <img :src="product.main_image || 'https://placehold.co/100'" alt="" class="w-12 h-12 rounded-lg object-cover">
              </td>
              <td class="px-6 py-4 font-semibold text-slate-900">{{ product.name }}</td>
              <td class="px-6 py-4">
                <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full text-xs font-semibold">
                  {{ product.category }}
                </span>
              </td>
              <td class="px-6 py-4 text-slate-600">LKR {{ product.price_min?.toLocaleString() }}</td>
            </tr>
            <tr v-if="products.length === 0">
              <td colspan="4" class="px-6 py-12 text-center text-slate-500">No products found.</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script setup>
const { user } = useAuth()
const { data: productsData } = await useFetch('http://127.0.0.1:8002/api/products')
const products = computed(() => productsData.value || [])
</script>
