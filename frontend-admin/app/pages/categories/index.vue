<template>
  <div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
      <div>
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Product Categories</h1>
        <p class="text-slate-500 text-sm mt-1">Register, organize, and upload images for product categories.</p>
      </div>
      <button 
        @click="openCreateModal"
        class="bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-lg font-medium shadow-sm transition flex items-center gap-2 cursor-pointer"
      >
        <i class="fa-solid fa-plus"></i>
        Register New Category
      </button>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
      <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-lg bg-red-50 text-red-600 flex items-center justify-center text-xl">
          <i class="fa-solid fa-tags"></i>
        </div>
        <div>
          <div class="text-2xl font-black text-slate-800">{{ categories?.length || 0 }}</div>
          <div class="text-xs uppercase font-bold text-slate-400">Total Categories</div>
        </div>
      </div>

      <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl">
          <i class="fa-solid fa-circle-check"></i>
        </div>
        <div>
          <div class="text-2xl font-black text-slate-800">{{ activeCategoriesCount }}</div>
          <div class="text-xs uppercase font-bold text-slate-400">Active Categories</div>
        </div>
      </div>

      <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-xl">
          <i class="fa-solid fa-image"></i>
        </div>
        <div>
          <div class="text-2xl font-black text-slate-800">{{ withImagesCount }}</div>
          <div class="text-xs uppercase font-bold text-slate-400">With Cover Images</div>
        </div>
      </div>
    </div>

    <!-- Alert / Notification -->
    <div v-if="notification.message" :class="[
      'p-4 rounded-lg flex items-center justify-between text-sm transition',
      notification.type === 'success' ? 'bg-green-50 border border-green-200 text-green-700' : 'bg-red-50 border border-red-200 text-red-600'
    ]">
      <div class="flex items-center gap-2">
        <i :class="notification.type === 'success' ? 'fa-solid fa-circle-check text-green-600' : 'fa-solid fa-circle-exclamation text-red-600'"></i>
        <span>{{ notification.message }}</span>
      </div>
      <button @click="notification.message = ''" class="text-slate-400 hover:text-slate-600 cursor-pointer">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <!-- Search & Filter Bar -->
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
      <div class="relative w-full sm:w-80">
        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 pointer-events-none">
          <i class="fa-solid fa-magnifying-glass text-xs"></i>
        </span>
        <input 
          v-model="searchQuery" 
          type="text" 
          placeholder="Search categories..."
          class="w-full pl-9 pr-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:border-red-500 text-sm"
        />
      </div>

      <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
        <span class="text-xs text-slate-500 font-medium">Showing {{ filteredCategories.length }} of {{ categories?.length || 0 }}</span>
      </div>
    </div>

    <!-- Loading State -->
    <div v-if="pending" class="flex justify-center items-center py-20">
      <i class="fa-solid fa-spinner fa-spin text-4xl text-slate-300"></i>
    </div>

    <!-- Categories List Table -->
    <div v-else-if="filteredCategories.length" class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-slate-50 border-b border-slate-200 text-xs uppercase text-slate-500 font-semibold tracking-wider">
              <th class="p-4 pl-6">Cover</th>
              <th class="p-4">Category Name</th>
              <th class="p-4">Description</th>
              <th class="p-4 text-center">Products</th>
              <th class="p-4">Status</th>
              <th class="p-4">Created Date</th>
              <th class="p-4 pr-6 text-right">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            <tr 
              v-for="cat in paginatedCategories" 
              :key="cat.id" 
              class="hover:bg-slate-50/80 transition"
            >
              <!-- Cover Image Thumbnail -->
              <td class="p-4 pl-6">
                <div class="w-14 h-11 rounded-lg bg-slate-100 border border-slate-200 overflow-hidden flex items-center justify-center relative shadow-xs">
                  <img 
                    v-if="cat.image" 
                    :src="getImageUrl(cat.image)" 
                    :alt="cat.name"
                    class="w-full h-full object-cover"
                    @error="handleImageError"
                  />
                  <div v-else class="text-base text-slate-400">
                    {{ cat.icon || '🎨' }}
                  </div>
                </div>
              </td>

              <!-- Name & Slug -->
              <td class="p-4">
                <div class="font-bold text-slate-800 text-sm flex items-center gap-2">
                  <span>{{ cat.name }}</span>
                </div>
                <div class="text-xs text-slate-400 font-mono mt-0.5">/category/{{ cat.slug }}</div>
              </td>

              <!-- Description -->
              <td class="p-4 max-w-sm">
                <p class="text-xs text-slate-600 line-clamp-2 leading-relaxed">
                  {{ cat.description || '-' }}
                </p>
              </td>

              <!-- Products Count -->
              <td class="p-4 text-center">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">
                  <i class="fa-solid fa-box text-[10px] text-slate-400"></i>
                  {{ cat.products_count || 0 }}
                </span>
              </td>

              <!-- Status -->
              <td class="p-4">
                <span 
                  :class="[
                    'inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold',
                    cat.is_active ? 'bg-emerald-50 text-emerald-700 border border-emerald-200/60' : 'bg-slate-100 text-slate-500'
                  ]"
                >
                  <span :class="['w-1.5 h-1.5 rounded-full', cat.is_active ? 'bg-emerald-500' : 'bg-slate-400']"></span>
                  {{ cat.is_active ? 'Active' : 'Inactive' }}
                </span>
              </td>

              <!-- Created Date -->
              <td class="p-4 text-slate-500 text-xs">
                {{ formatDate(cat.created_at) }}
              </td>

              <!-- Actions -->
              <td class="p-4 pr-6 text-right">
                <div class="flex items-center justify-end gap-2">
                  <button 
                    @click="openEditModal(cat)"
                    class="w-8 h-8 rounded bg-slate-100 text-slate-600 hover:bg-slate-200 hover:text-slate-900 flex items-center justify-center transition cursor-pointer"
                    title="Edit Category"
                  >
                    <i class="fa-solid fa-pen text-xs"></i>
                  </button>
                  <button 
                    @click="deleteCategory(cat)"
                    class="w-8 h-8 rounded bg-red-50 text-red-600 hover:bg-red-100 hover:text-red-700 flex items-center justify-center transition cursor-pointer"
                    title="Delete Category"
                  >
                    <i class="fa-solid fa-trash text-xs"></i>
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Pagination Footer -->
      <div v-if="filteredCategories.length > 0" class="px-6 py-3.5 bg-slate-50/80 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-3 text-xs text-slate-500">
          <span>
            Showing <strong class="text-slate-800 font-semibold">{{ paginationInfo.start }}</strong> to <strong class="text-slate-800 font-semibold">{{ paginationInfo.end }}</strong> of <strong class="text-slate-800 font-semibold">{{ paginationInfo.total }}</strong> categories
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
          <!-- Previous Button -->
          <button 
            @click="goToPage(currentPage - 1)" 
            :disabled="currentPage === 1"
            class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white text-xs font-medium text-slate-600 hover:bg-slate-50 disabled:opacity-40 disabled:cursor-not-allowed transition flex items-center gap-1 cursor-pointer"
          >
            <i class="fa-solid fa-chevron-left text-[10px]"></i>
            <span>Prev</span>
          </button>

          <!-- Page Numbers -->
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

          <!-- Next Button -->
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

    <!-- Empty State -->
    <div v-else class="bg-white rounded-xl border border-slate-200 p-12 text-center">
      <i class="fa-solid fa-tags text-4xl text-slate-300 mb-3"></i>
      <h3 class="font-bold text-slate-700 text-lg">No Categories Found</h3>
      <p class="text-slate-400 text-sm mt-1 max-w-sm mx-auto">
        {{ searchQuery ? 'No categories matched your search term.' : 'Get started by registering your first product category.' }}
      </p>
      <button 
        v-if="!searchQuery"
        @click="openCreateModal"
        class="mt-4 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium text-sm transition inline-flex items-center gap-2 cursor-pointer"
      >
        <i class="fa-solid fa-plus text-xs"></i>
        Register Category
      </button>
    </div>

    <!-- Create Category Modal -->
    <div v-if="showCreateModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-xs p-4 overflow-y-auto">
      <div class="bg-white rounded-2xl shadow-xl border border-slate-100 w-full max-w-lg overflow-hidden my-8 animate-in fade-in zoom-in duration-150">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
          <div>
            <h3 class="text-lg font-bold text-slate-900">Register New Category</h3>
            <p class="text-xs text-slate-500 mt-0.5">Add a new paint category with a cover image</p>
          </div>
          <button @click="showCreateModal = false" class="text-slate-400 hover:text-slate-600 cursor-pointer">
            <i class="fa-solid fa-xmark text-lg"></i>
          </button>
        </div>

        <form @submit.prevent="handleCreateCategory" class="p-6 space-y-4">
          <div v-if="formError" class="p-3 bg-red-50 border border-red-200 text-red-600 rounded-lg text-sm flex items-center gap-2">
            <i class="fa-solid fa-circle-exclamation text-xs"></i>
            <span>{{ formError }}</span>
          </div>

          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Category Name *</label>
            <input 
              v-model="createForm.name" 
              type="text" 
              required 
              placeholder="e.g. Roof Coatings & Waterproofing"
              class="w-full px-3.5 py-2.5 rounded-lg border border-slate-200 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm"
            />
          </div>

          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Description</label>
            <textarea 
              v-model="createForm.description" 
              rows="3" 
              placeholder="Brief description of products in this category..."
              class="w-full px-3.5 py-2.5 rounded-lg border border-slate-200 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm"
            ></textarea>
          </div>

          <!-- Category Image Upload -->
          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Category Image</label>
            <div class="space-y-3">
              <!-- Image Preview Box -->
              <div 
                v-if="createImagePreview" 
                class="relative h-44 rounded-xl border border-slate-200 overflow-hidden bg-slate-50 group"
              >
                <img :src="createImagePreview" alt="Category preview" class="w-full h-full object-cover" />
                <button 
                  type="button" 
                  @click="removeCreateImage"
                  class="absolute top-2 right-2 bg-red-600 text-white rounded-full w-7 h-7 flex items-center justify-center shadow hover:bg-red-700 transition cursor-pointer"
                  title="Remove image"
                >
                  <i class="fa-solid fa-xmark text-xs"></i>
                </button>
              </div>

              <!-- File Input Trigger -->
              <label 
                v-else
                class="border-2 border-dashed border-slate-200 hover:border-red-400 rounded-xl p-6 flex flex-col items-center justify-center cursor-pointer bg-slate-50/50 hover:bg-red-50/30 transition text-center"
              >
                <i class="fa-solid fa-cloud-arrow-up text-3xl text-slate-400 mb-2"></i>
                <span class="text-sm font-semibold text-slate-700">Click to upload category image</span>
                <span class="text-xs text-slate-400 mt-1">Supports JPG, PNG, WEBP (Max 5MB)</span>
                <input 
                  type="file" 
                  accept="image/jpeg,image/png,image/jpg,image/webp" 
                  @change="handleCreateImageSelect"
                  class="hidden" 
                />
              </label>
            </div>
          </div>

          <!-- Active Toggle -->
          <div class="flex items-center gap-2 pt-1">
            <input 
              id="create_is_active" 
              v-model="createForm.is_active" 
              type="checkbox" 
              class="w-4 h-4 text-red-600 rounded border-slate-300 focus:ring-red-500 cursor-pointer"
            />
            <label for="create_is_active" class="text-sm font-medium text-slate-700 cursor-pointer">
              Active Category (visible to customers)
            </label>
          </div>

          <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
            <button 
              type="button" 
              @click="showCreateModal = false"
              class="px-4 py-2.5 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50 text-sm font-medium transition cursor-pointer"
            >
              Cancel
            </button>
            <button 
              type="submit" 
              :disabled="submitting"
              class="bg-red-600 hover:bg-red-700 disabled:opacity-50 text-white px-5 py-2.5 rounded-lg font-medium text-sm transition flex items-center gap-2 cursor-pointer shadow-sm"
            >
              <i v-if="submitting" class="fa-solid fa-spinner fa-spin text-xs"></i>
              <span v-else>Register Category</span>
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Edit Category Modal -->
    <div v-if="showEditModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-xs p-4 overflow-y-auto">
      <div class="bg-white rounded-2xl shadow-xl border border-slate-100 w-full max-w-lg overflow-hidden my-8 animate-in fade-in zoom-in duration-150">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
          <div>
            <h3 class="text-lg font-bold text-slate-900">Edit Category</h3>
            <p class="text-xs text-slate-500 mt-0.5">Update details and cover image</p>
          </div>
          <button @click="showEditModal = false" class="text-slate-400 hover:text-slate-600 cursor-pointer">
            <i class="fa-solid fa-xmark text-lg"></i>
          </button>
        </div>

        <form @submit.prevent="handleUpdateCategory" class="p-6 space-y-4">
          <div v-if="editFormError" class="p-3 bg-red-50 border border-red-200 text-red-600 rounded-lg text-sm flex items-center gap-2">
            <i class="fa-solid fa-circle-exclamation text-xs"></i>
            <span>{{ editFormError }}</span>
          </div>

          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Category Name *</label>
            <input 
              v-model="editForm.name" 
              type="text" 
              required 
              class="w-full px-3.5 py-2.5 rounded-lg border border-slate-200 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm"
            />
          </div>

          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Description</label>
            <textarea 
              v-model="editForm.description" 
              rows="3" 
              class="w-full px-3.5 py-2.5 rounded-lg border border-slate-200 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm"
            ></textarea>
          </div>

          <!-- Image Edit -->
          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Cover Image</label>
            <div class="space-y-3">
              <div 
                v-if="editImagePreview || editForm.currentImage" 
                class="relative h-44 rounded-xl border border-slate-200 overflow-hidden bg-slate-50"
              >
                <img 
                  :src="editImagePreview || getImageUrl(editForm.currentImage)" 
                  alt="Category preview" 
                  class="w-full h-full object-cover" 
                />
              </div>

              <!-- Upload new image -->
              <label class="border border-slate-200 hover:border-slate-300 rounded-lg px-4 py-2.5 flex items-center justify-center gap-2 cursor-pointer bg-slate-50 hover:bg-slate-100 transition text-sm font-medium text-slate-700">
                <i class="fa-solid fa-camera text-slate-500"></i>
                <span>{{ editImagePreview ? 'Change Selected Image' : 'Upload New Cover Image' }}</span>
                <input 
                  type="file" 
                  accept="image/jpeg,image/png,image/jpg,image/webp" 
                  @change="handleEditImageSelect"
                  class="hidden" 
                />
              </label>
            </div>
          </div>

          <!-- Active Toggle -->
          <div class="flex items-center gap-2 pt-1">
            <input 
              id="edit_is_active" 
              v-model="editForm.is_active" 
              type="checkbox" 
              class="w-4 h-4 text-red-600 rounded border-slate-300 focus:ring-red-500 cursor-pointer"
            />
            <label for="edit_is_active" class="text-sm font-medium text-slate-700 cursor-pointer">
              Active Category
            </label>
          </div>

          <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
            <button 
              type="button" 
              @click="showEditModal = false"
              class="px-4 py-2.5 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50 text-sm font-medium transition cursor-pointer"
            >
              Cancel
            </button>
            <button 
              type="submit" 
              :disabled="submitting"
              class="bg-slate-900 hover:bg-slate-800 disabled:opacity-50 text-white px-5 py-2.5 rounded-lg font-medium text-sm transition flex items-center gap-2 cursor-pointer shadow-sm"
            >
              <i v-if="submitting" class="fa-solid fa-spinner fa-spin text-xs"></i>
              <span v-else>Save Changes</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, computed, watch } from 'vue'

const config = useRuntimeConfig()
const { token } = useAuth()

const searchQuery = ref('')
const currentPage = ref(1)
const perPage = ref(8)
const showCreateModal = ref(false)
const showEditModal = ref(false)
const submitting = ref(false)
const formError = ref('')
const editFormError = ref('')

const notification = reactive({
  message: '',
  type: 'success'
})

const createForm = reactive({
  name: '',
  description: '',
  is_active: true
})
const createSelectedFile = ref(null)
const createImagePreview = ref('')

const editForm = reactive({
  id: null,
  name: '',
  description: '',
  currentImage: '',
  is_active: true
})
const editSelectedFile = ref(null)
const editImagePreview = ref('')

// Fetch categories from backend
const { data: categories, pending, refresh } = await useFetch(`${config.public.apiBase}/api/categories`)

const activeCategoriesCount = computed(() => {
  return categories.value?.filter(c => c.is_active)?.length || 0
})

const withImagesCount = computed(() => {
  return categories.value?.filter(c => !!c.image)?.length || 0
})

const filteredCategories = computed(() => {
  if (!categories.value) return []
  if (!searchQuery.value) return categories.value
  const q = searchQuery.value.toLowerCase().trim()
  return categories.value.filter(c => 
    c.name.toLowerCase().includes(q) || 
    (c.description && c.description.toLowerCase().includes(q))
  )
})

watch(searchQuery, () => {
  currentPage.value = 1
})

watch(perPage, () => {
  currentPage.value = 1
})

const totalPages = computed(() => {
  return Math.ceil(filteredCategories.value.length / perPage.value) || 1
})

const paginatedCategories = computed(() => {
  const start = (currentPage.value - 1) * perPage.value
  return filteredCategories.value.slice(start, start + perPage.value)
})

const paginationInfo = computed(() => {
  const total = filteredCategories.value.length
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

const getImageUrl = (path) => {
  if (!path) return ''
  if (path.startsWith('http://') || path.startsWith('https://')) return path
  // If stored in /storage/..., prepend apiBase
  return `${config.public.apiBase}${path}`
}

const handleImageError = (e) => {
  // Fallback to placeholder if relative image is missing
  e.target.style.display = 'none'
}

const formatDate = (dateStr) => {
  if (!dateStr) return '-'
  return new Date(dateStr).toLocaleDateString('en-US', {
    month: 'short',
    day: 'numeric',
    year: 'numeric'
  })
}

// Create handlers
const openCreateModal = () => {
  createForm.name = ''
  createForm.description = ''
  createForm.is_active = true
  createSelectedFile.value = null
  createImagePreview.value = ''
  formError.value = ''
  showCreateModal.value = true
}

const handleCreateImageSelect = (event) => {
  const file = event.target.files?.[0]
  if (!file) return

  if (file.size > 5 * 1024 * 1024) {
    formError.value = 'Image size must be less than 5MB.'
    return
  }

  createSelectedFile.value = file
  createImagePreview.value = URL.createObjectURL(file)
}

const removeCreateImage = () => {
  createSelectedFile.value = null
  createImagePreview.value = ''
}

const handleCreateCategory = async () => {
  formError.value = ''
  submitting.value = true

  try {
    const formData = new FormData()
    formData.append('name', createForm.name)
    if (createForm.description) {
      formData.append('description', createForm.description)
    }
    formData.append('is_active', createForm.is_active ? '1' : '0')
    if (createSelectedFile.value) {
      formData.append('image', createSelectedFile.value)
    }

    const res = await $fetch(`${config.public.apiBase}/api/categories`, {
      method: 'POST',
      headers: {
        Authorization: `Bearer ${token.value}`
      },
      body: formData
    })

    showCreateModal.value = false
    notification.message = res.message || 'Category registered successfully!'
    notification.type = 'success'
    refresh()
  } catch (err) {
    console.error('Create category error:', err)
    formError.value = err?.data?.message || err?.data?.errors?.name?.[0] || 'Failed to register category.'
  } finally {
    submitting.value = false
  }
}

// Edit handlers
const openEditModal = (cat) => {
  editForm.id = cat.id
  editForm.name = cat.name
  editForm.description = cat.description || ''
  editForm.currentImage = cat.image || ''
  editForm.is_active = !!cat.is_active
  editSelectedFile.value = null
  editImagePreview.value = ''
  editFormError.value = ''
  showEditModal.value = true
}

const handleEditImageSelect = (event) => {
  const file = event.target.files?.[0]
  if (!file) return

  if (file.size > 5 * 1024 * 1024) {
    editFormError.value = 'Image size must be less than 5MB.'
    return
  }

  editSelectedFile.value = file
  editImagePreview.value = URL.createObjectURL(file)
}

const handleUpdateCategory = async () => {
  editFormError.value = ''
  submitting.value = true

  try {
    const formData = new FormData()
    formData.append('name', editForm.name)
    if (editForm.description !== undefined) {
      formData.append('description', editForm.description || '')
    }
    formData.append('is_active', editForm.is_active ? '1' : '0')
    if (editSelectedFile.value) {
      formData.append('image', editSelectedFile.value)
    }

    const res = await $fetch(`${config.public.apiBase}/api/categories/${editForm.id}`, {
      method: 'POST',
      headers: {
        Authorization: `Bearer ${token.value}`
      },
      body: formData
    })

    showEditModal.value = false
    notification.message = res.message || 'Category updated successfully!'
    notification.type = 'success'
    refresh()
  } catch (err) {
    console.error('Update category error:', err)
    editFormError.value = err?.data?.message || 'Failed to update category.'
  } finally {
    submitting.value = false
  }
}

// Delete handler
const deleteCategory = async (cat) => {
  const promptText = (cat.products_count && cat.products_count > 0)
    ? `Warning: This category has ${cat.products_count} associated product(s). Are you sure you want to delete "${cat.name}"?`
    : `Are you sure you want to delete category "${cat.name}"?`

  if (!confirm(promptText)) {
    return
  }

  try {
    const res = await $fetch(`${config.public.apiBase}/api/categories/${cat.id}`, {
      method: 'DELETE',
      headers: {
        Authorization: `Bearer ${token.value}`
      }
    })

    notification.message = res.message || 'Category deleted successfully!'
    notification.type = 'success'
    refresh()
  } catch (err) {
    console.error('Delete error:', err)
    alert(err?.data?.message || 'Failed to delete category.')
  }
}
</script>
