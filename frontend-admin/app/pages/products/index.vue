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

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
          <thead class="bg-slate-50 text-slate-500 font-semibold uppercase text-xs tracking-wider border-b border-slate-100">
            <tr>
              <th class="px-6 py-4">Image</th>
              <th class="px-6 py-4">Name</th>
              <th class="px-6 py-4">Category</th>
              <th class="px-6 py-4">Price Range</th>
              <th class="px-6 py-4">Status</th>
              <th class="px-6 py-4 text-right">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            <tr v-for="product in paginatedProducts" :key="product.id" class="hover:bg-slate-50">
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
              <td class="px-6 py-4 text-right">
                <div class="flex items-center justify-end gap-2">
                  <NuxtLink :to="`/products/edit/${product.id}`" class="text-blue-500 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 w-8 h-8 rounded-lg transition flex items-center justify-center cursor-pointer" title="Edit">
                    <i class="fa-solid fa-pen"></i>
                  </NuxtLink>
                  <button @click="deleteProduct(product.id)" class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 w-8 h-8 rounded-lg transition flex items-center justify-center cursor-pointer" title="Delete">
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </div>
              </td>
            </tr>
            <tr v-if="filteredProducts.length === 0">
              <td colspan="6" class="px-6 py-12 text-center text-slate-500">No products found matching your criteria.</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Pagination Footer -->
      <div v-if="filteredProducts.length > 0" class="px-6 py-3.5 bg-slate-50/80 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-3 text-xs text-slate-500">
          <span>
            Showing <strong class="text-slate-800 font-semibold">{{ paginationInfo.start }}</strong> to <strong class="text-slate-800 font-semibold">{{ paginationInfo.end }}</strong> of <strong class="text-slate-800 font-semibold">{{ paginationInfo.total }}</strong> products
          </span>
          <span class="text-slate-300">|</span>
          <div class="flex items-center gap-1.5">
            <span>Per page:</span>
            <select v-model="perPage" class="bg-white border border-slate-200 rounded px-2 py-1 text-xs text-slate-700 outline-none focus:border-red-500 cursor-pointer">
              <option :value="5">5</option>
              <option :value="8">8</option>
              <option :value="15">15</option>
              <option :value="25">25</option>
            </select>
          </div>
        </div>

        <div v-if="totalPages > 1" class="flex items-center gap-1">
          <button 
            @click="goToPage(currentPage - 1)" 
            :disabled="currentPage === 1"
            class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white text-xs font-medium text-slate-600 hover:bg-slate-50 disabled:opacity-40 disabled:cursor-not-allowed transition flex items-center gap-1 cursor-pointer"
          >
            <i class="fa-solid fa-chevron-left text-[10px]"></i>
            <span>Prev</span>
          </button>

          <button 
            v-for="(page, idx) in visiblePages" 
            :key="idx"
            @click="typeof page === 'number' ? goToPage(page) : null"
            :disabled="typeof page !== 'number'"
            :class="[
              'min-w-8 h-8 rounded-lg text-xs font-semibold transition flex items-center justify-center',
              page === currentPage ? 'bg-red-600 text-white shadow-xs' : (typeof page === 'number' ? 'border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 cursor-pointer' : 'text-slate-400 cursor-default')
            ]"
          >
            {{ page }}
          </button>

          <button 
            @click="goToPage(currentPage + 1)" 
            :disabled="currentPage >= totalPages"
            class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white text-xs font-medium text-slate-600 hover:bg-slate-50 disabled:opacity-40 disabled:cursor-not-allowed transition flex items-center gap-1 cursor-pointer"
          >
            <span>Next</span>
            <i class="fa-solid fa-chevron-right text-[10px]"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue'

const config = useRuntimeConfig()
const { token } = useAuth()
const { data: productsData, refresh } = await useFetch(`${config.public.apiBase}/api/products`)

const searchQuery = ref('')
const currentPage = ref(1)
const perPage = ref(8)

const filteredProducts = computed(() => {
  let list = productsData.value || []
  if (searchQuery.value) {
    const q = searchQuery.value.toLowerCase()
    list = list.filter(p => p.name?.toLowerCase().includes(q) || p.category?.toLowerCase().includes(q))
  }
  return list
})

watch(searchQuery, () => {
  currentPage.value = 1
})

watch(perPage, () => {
  currentPage.value = 1
})

const totalPages = computed(() => {
  return Math.ceil(filteredProducts.value.length / perPage.value) || 1
})

const paginatedProducts = computed(() => {
  const start = (currentPage.value - 1) * perPage.value
  return filteredProducts.value.slice(start, start + perPage.value)
})

const paginationInfo = computed(() => {
  const total = filteredProducts.value.length
  if (total === 0) return { start: 0, end: 0, total: 0 }
  const start = (currentPage.value - 1) * perPage.value + 1
  const end = Math.min(currentPage.value * perPage.value, total)
  return { start, end, total }
})

const visiblePages = computed(() => {
  const total = totalPages.value
  const current = currentPage.value
  if (total <= 7) {
    return Array.from({ length: total }, (_, i) => i + 1)
  }
  if (current <= 4) {
    return [1, 2, 3, 4, 5, '...', total]
  }
  if (current >= total - 3) {
    return [1, '...', total - 4, total - 3, total - 2, total - 1, total]
  }
  return [1, '...', current - 1, current, current + 1, '...', total]
})

const goToPage = (p) => {
  if (p >= 1 && p <= totalPages.value) {
    currentPage.value = p
  }
}

const deleteProduct = async (id) => {
  if (confirm('Are you sure you want to delete this product?')) {
    try {
      await $fetch(`${config.public.apiBase}/api/products/${id}`, {
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
