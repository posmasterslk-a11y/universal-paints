<template>
  <div>
    <div class="mb-8 flex justify-between items-center">
      <div>
        <h1 class="text-3xl font-extrabold text-slate-900">Products</h1>
        <p class="text-slate-500 mt-1">Manage your store's inventory</p>
      </div>
      <NuxtLink to="/products/create" class="bg-red-600 hover:bg-red-700 text-white px-5 py-3 rounded-lg font-semibold transition shadow-lg shadow-red-600/20 flex items-center">
        <i class="fa-solid fa-plus mr-2"></i> Add Product
      </NuxtLink>
    </div>

    <div class="mb-6">
      <div class="relative max-w-md">
        <i class="fa-solid fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
        <input type="text" v-model="searchQuery" placeholder="Search products by name or category..." class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-slate-200 focus:border-red-600 focus:ring-2 focus:ring-red-600/20 outline-none transition bg-white shadow-sm text-sm font-medium">
      </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
          <thead class="bg-slate-50 text-slate-500 font-semibold uppercase text-xs tracking-wider border-b border-slate-100">
            <tr>
              <th class="px-6 py-4">Image</th>
              <th class="px-6 py-4">Name</th>
              <th class="px-6 py-4">Category</th>
              <th class="px-6 py-4">Price Range</th>
              <th class="px-6 py-4">Status</th>
              <th class="px-6 py-4">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            <tr v-for="product in filteredProducts" :key="product.id" class="hover:bg-slate-50">
              <td class="px-6 py-4">
                <img :src="product.main_image || 'https://placehold.co/100'" alt="" class="w-12 h-12 rounded-lg object-cover">
              </td>
              <td class="px-6 py-4">
                <p class="font-bold text-slate-900">{{ product.name }}</p>
                <p class="text-xs text-slate-500 truncate w-48">{{ product.subtitle }}</p>
              </td>
              <td class="px-6 py-4">
                <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full text-xs font-semibold">
                  {{ product.category }}
                </span>
              </td>
              <td class="px-6 py-4 text-slate-600 font-medium">
                LKR {{ product.price_min?.toLocaleString() }} - {{ product.price_max?.toLocaleString() }}
              </td>
              <td class="px-6 py-4">
                <span v-if="product.is_in_stock" class="text-green-600 bg-green-50 px-2 py-1 rounded text-xs font-bold">In Stock</span>
                <span v-else class="text-red-600 bg-red-50 px-2 py-1 rounded text-xs font-bold">Out of Stock</span>
              </td>
              <td class="px-6 py-4 flex items-center gap-2">
                <NuxtLink :to="`/products/edit/${product.id}`" class="text-blue-500 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 w-8 h-8 rounded-lg transition flex items-center justify-center cursor-pointer" title="Edit">
                  <i class="fa-solid fa-pen"></i>
                </NuxtLink>
                <button @click="deleteProduct(product.id)" class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 w-8 h-8 rounded-lg transition flex items-center justify-center cursor-pointer" title="Delete">
                  <i class="fa-solid fa-trash"></i>
                </button>
              </td>
            </tr>
            <tr v-if="filteredProducts.length === 0">
              <td colspan="6" class="px-6 py-12 text-center text-slate-500">No products found matching your criteria.</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const { token } = useAuth()
const { data: productsData, refresh } = await useFetch('http://127.0.0.1:8002/api/products')

const searchQuery = ref('')

const filteredProducts = computed(() => {
  let list = productsData.value || []
  if (searchQuery.value) {
    const q = searchQuery.value.toLowerCase()
    list = list.filter(p => p.name.toLowerCase().includes(q) || p.category.toLowerCase().includes(q))
  }
  return list
})

const deleteProduct = async (id) => {
  if (confirm('Are you sure you want to delete this product?')) {
    try {
      await $fetch(`http://127.0.0.1:8002/api/products/${id}`, {
        method: 'DELETE',
        headers: {
          Authorization: `Bearer ${token.value}`
        }
      })
      refresh()
    } catch (error) {
      alert('Failed to delete product')
    }
  }
}
</script>
