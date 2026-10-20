<template>
  <div>
    <div class="mb-8 flex justify-between items-center">
      <div>
        <h1 class="text-3xl font-extrabold text-slate-900">Add Product</h1>
        <p class="text-slate-500 mt-1">Create a new product in the catalog</p>
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

      <form @submit.prevent="submitForm" class="space-y-6">
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
            <div class="flex items-center justify-between mb-1">
              <label class="block text-sm font-semibold text-slate-700">Category *</label>
              <NuxtLink to="/categories" target="_blank" class="text-xs text-red-600 hover:underline">
                + Manage Categories
              </NuxtLink>
            </div>
            <select v-model="form.category" required class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:border-red-600 focus:ring-2 focus:ring-red-600/20 outline-none transition bg-white">
              <option value="" disabled>Select a Category</option>
              <option v-for="cat in categories" :key="cat.id" :value="cat.name">
                {{ cat.name }}
              </option>
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
          <button type="submit" :disabled="isSubmitting" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-8 rounded-lg transition shadow-lg shadow-red-600/30 disabled:opacity-70 disabled:cursor-not-allowed cursor-pointer">
            {{ isSubmitting ? 'Saving...' : 'Save Product' }}
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const config = useRuntimeConfig()
const { token } = useAuth()

const { data: categories } = await useFetch(`${config.public.apiBase}/api/categories`)

const form = ref({
  name: '',
  subtitle: '',
  category: '',
  description: '',
  is_best_seller: false,
  is_in_stock: true,
  main_image: ''
})

onMounted(() => {
  if (categories.value && categories.value.length > 0 && !form.value.category) {
    form.value.category = categories.value[0].name
  }
})

const featuresInput = ref('')
const colorsInput = ref('')
const packSizesInput = ref('')
const isSubmitting = ref(false)
const successMsg = ref('')
const errorMsg = ref('')

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
    await $fetch(`${config.public.apiBase}/api/products`, {
      method: 'POST',
      body: payload,
      headers: {
        Authorization: `Bearer ${token.value}`
      }
    })
    
    successMsg.value = 'Product created successfully!'
    
    form.value.name = ''
    form.value.subtitle = ''
    form.value.description = ''
    form.value.main_image = ''
    featuresInput.value = ''
    colorsInput.value = ''
    packSizesInput.value = ''
    if (categories.value?.length) {
      form.value.category = categories.value[0].name
    }
  } catch (error) {
    console.error(error)
    errorMsg.value = 'Failed to create product.'
  } finally {
    isSubmitting.value = false
  }
}
</script>
