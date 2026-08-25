<template>
  <div>
    <div class="mb-8 flex justify-between items-center">
      <div>
        <h1 class="text-3xl font-extrabold text-slate-900">Edit Product</h1>
        <p class="text-slate-500 mt-1">Update product details in the catalog</p>
      </div>
      <NuxtLink to="/products" class="text-slate-500 hover:text-slate-700 font-medium flex items-center transition">
        <i class="fa-solid fa-arrow-left mr-2"></i> Back to Products
      </NuxtLink>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-8">
      <div v-if="successMsg" class="bg-green-50 text-green-600 p-4 rounded-lg mb-6 border border-green-200">
        {{ successMsg }}
      </div>
      <div v-if="errorMsg" class="bg-red-50 text-red-600 p-4 rounded-lg mb-6 border border-red-200">
        {{ errorMsg }}
      </div>

      <div v-if="isLoadingData" class="text-slate-500 py-10 text-center">
        Loading product details...
      </div>
      <form v-else @submit.prevent="submitForm" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Product Name *</label>
            <input type="text" v-model="form.name" required class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:border-red-600 focus:ring-2 focus:ring-red-600/20 outline-none transition">
          </div>
          <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Subtitle</label>
            <input type="text" v-model="form.subtitle" class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:border-red-600 focus:ring-2 focus:ring-red-600/20 outline-none transition">
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Category *</label>
            <select v-model="form.category" required class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:border-red-600 focus:ring-2 focus:ring-red-600/20 outline-none transition bg-white">
              <option value="Interior Paints">Interior Paints</option>
              <option value="Exterior Paints">Exterior Paints</option>
              <option value="Wood Finishes">Wood Finishes</option>
              <option value="Industrial Coatings">Industrial Coatings</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Image URL</label>
            <input type="text" v-model="form.main_image" placeholder="/images/home-page/interior.jpg" class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:border-red-600 focus:ring-2 focus:ring-red-600/20 outline-none transition">
          </div>
        </div>

        <div>
          <label class="block text-sm font-semibold text-slate-700 mb-1">Description *</label>
          <textarea v-model="form.description" required rows="4" class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:border-red-600 focus:ring-2 focus:ring-red-600/20 outline-none transition"></textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Features (comma separated)</label>
            <input type="text" v-model="featuresInput" placeholder="Washable, Low VOC" class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:border-red-600 focus:ring-2 focus:ring-red-600/20 outline-none transition">
          </div>
          <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Colors (comma separated HEX)</label>
            <input type="text" v-model="colorsInput" placeholder="#FFFFFF, #000000" class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:border-red-600 focus:ring-2 focus:ring-red-600/20 outline-none transition">
          </div>
        </div>

        <div>
          <label class="block text-sm font-semibold text-slate-700 mb-1">Pack Sizes & Prices (Format: Size-Price)</label>
          <input type="text" v-model="packSizesInput" placeholder="1L-2500, 4L-8500" class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:border-red-600 focus:ring-2 focus:ring-red-600/20 outline-none transition">
          <p class="text-xs text-slate-500 mt-1">Separate different packs with a comma.</p>
        </div>

        <div class="flex gap-6 pt-4 border-t border-slate-100">
          <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" v-model="form.is_best_seller" class="w-5 h-5 text-red-600 rounded focus:ring-red-500 border-slate-300">
            <span class="text-sm font-semibold text-slate-700">Best Seller</span>
          </label>
          <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" v-model="form.is_in_stock" class="w-5 h-5 text-red-600 rounded focus:ring-red-500 border-slate-300">
            <span class="text-sm font-semibold text-slate-700">In Stock</span>
          </label>
        </div>

        <div class="pt-6">
          <button type="submit" :disabled="isSubmitting" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-8 rounded-lg transition shadow-lg shadow-red-600/30 disabled:opacity-70 disabled:cursor-not-allowed">
            {{ isSubmitting ? 'Saving...' : 'Update Product' }}
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'

const { token } = useAuth()
const route = useRoute()
const productId = route.params.id

const form = ref({
  name: '',
  subtitle: '',
  category: 'Interior Paints',
  description: '',
  is_best_seller: false,
  is_in_stock: true,
  main_image: ''
})

const featuresInput = ref('')
const colorsInput = ref('')
const packSizesInput = ref('')
const isSubmitting = ref(false)
const isLoadingData = ref(true)
const successMsg = ref('')
const errorMsg = ref('')

onMounted(async () => {
  try {
    const data = await $fetch(`http://127.0.0.1:8002/api/products/${productId}`)
    if (data) {
      form.value = {
        name: data.name || '',
        subtitle: data.subtitle || '',
        category: data.category || 'Interior Paints',
        description: data.description || '',
        is_best_seller: data.is_best_seller || false,
        is_in_stock: data.is_in_stock ?? true,
        main_image: data.main_image || ''
      }
      featuresInput.value = (data.features || []).join(', ')
      colorsInput.value = (data.colors || []).join(', ')
      packSizesInput.value = (data.pack_sizes || []).map(p => `${p.size}-${p.price}`).join(', ')
    }
  } catch (e) {
    errorMsg.value = 'Failed to load product data.'
  } finally {
    isLoadingData.value = false
  }
})

const submitForm = async () => {
  isSubmitting.value = true
  successMsg.value = ''
  errorMsg.value = ''

  const features = featuresInput.value.split(',').map(s => s.trim()).filter(Boolean)
  const colors = colorsInput.value.split(',').map(s => s.trim()).filter(Boolean)
  
  const pack_sizes = packSizesInput.value.split(',').map(s => {
    const parts = s.trim().split('-')
    if(parts.length === 2) {
      return { size: parts[0].trim(), price: parseFloat(parts[1].trim()) }
    }
    return null
  }).filter(Boolean)

  const payload = {
    ...form.value,
    features,
    colors,
    pack_sizes
  }

  try {
    await $fetch(`http://127.0.0.1:8002/api/products/${productId}`, {
      method: 'PUT',
      body: payload,
      headers: {
        Authorization: `Bearer ${token.value}`
      }
    })
    
    successMsg.value = 'Product updated successfully!'
    
  } catch (error) {
    console.error(error)
    errorMsg.value = 'Failed to update product.'
  } finally {
    isSubmitting.value = false
  }
}
</script>
