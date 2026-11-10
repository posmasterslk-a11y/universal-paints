<template>
  <div>
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
      <div>
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Sales Representatives</h1>
        <p class="text-slate-500 text-sm mt-1">Manage area sales executives and assign covered districts for the Sri Lanka interactive map.</p>
      </div>
      <button 
        @click="openCreateModal" 
        class="bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-xl font-semibold transition shadow-lg shadow-red-600/25 flex items-center gap-2 self-start sm:self-auto cursor-pointer"
      >
        <i class="fa-solid fa-user-plus"></i>
        <span>Add Representative</span>
      </button>
    </div>

    <!-- Quick Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">
      <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-red-50 text-red-600 flex items-center justify-center text-xl shrink-0">
          <i class="fa-solid fa-users"></i>
        </div>
        <div>
          <div class="text-2xl font-black text-slate-800">{{ reps?.length || 0 }}</div>
          <div class="text-xs uppercase font-bold text-slate-400">Total Representatives</div>
        </div>
      </div>
      <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl shrink-0">
          <i class="fa-solid fa-user-check"></i>
        </div>
        <div>
          <div class="text-2xl font-black text-slate-800">{{ activeRepsCount }}</div>
          <div class="text-xs uppercase font-bold text-slate-400">Active On Site</div>
        </div>
      </div>
      <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl shrink-0">
          <i class="fa-solid fa-map-location"></i>
        </div>
        <div>
          <div class="text-2xl font-black text-slate-800">{{ coveredDistrictsCount }} / 25</div>
          <div class="text-xs uppercase font-bold text-slate-400">Districts Covered</div>
        </div>
      </div>
    </div>

    <!-- Filters & Search Toolbar -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-sm mb-6 flex flex-col md:flex-row items-center justify-between gap-4">
      <div class="relative w-full md:w-96">
        <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
        <input 
          type="text" 
          v-model="searchQuery" 
          placeholder="Search by name, phone, or district..." 
          class="w-full pl-10 pr-4 py-2 text-sm rounded-xl border border-slate-200 focus:border-red-600 focus:ring-2 focus:ring-red-600/20 outline-none transition"
        />
      </div>

      <div class="flex items-center gap-3 w-full md:w-auto">
        <select 
          v-model="selectedDistrictFilter" 
          class="px-3.5 py-2 text-sm rounded-xl border border-slate-200 focus:border-red-600 outline-none bg-white text-slate-700"
        >
          <option value="">All Districts ({{ allDistrictsList.length }})</option>
          <option v-for="d in allDistrictsList" :key="d" :value="d">{{ d }}</option>
        </select>

        <span class="text-xs text-slate-500 whitespace-nowrap">
          Showing <strong>{{ filteredReps.length }}</strong> of {{ reps?.length || 0 }}
        </span>
      </div>
    </div>

    <!-- Representatives Table -->
    <div v-if="pending" class="bg-white rounded-2xl p-12 text-center border border-slate-200/80">
      <i class="fa-solid fa-circle-notch fa-spin text-3xl text-red-600 mb-3"></i>
      <p class="text-slate-500 font-medium">Loading sales representatives...</p>
    </div>

    <div v-else-if="filteredReps.length" class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-slate-50 border-b border-slate-200 text-xs font-bold uppercase tracking-wider text-slate-500">
              <th class="py-3.5 px-6">Representative</th>
              <th class="py-3.5 px-6">Contact Details</th>
              <th class="py-3.5 px-6">Covered Districts</th>
              <th class="py-3.5 px-6 text-center">Status</th>
              <th class="py-3.5 px-6 text-right">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100 text-sm">
            <tr v-for="rep in filteredReps" :key="rep.id" class="hover:bg-slate-50/80 transition">
              <!-- Rep Info & Photo -->
              <td class="py-4 px-6">
                <div class="flex items-center gap-3">
                  <div class="w-12 h-12 rounded-full overflow-hidden bg-slate-100 border border-slate-200 shrink-0">
                    <img 
                      :src="rep.image || 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=200&auto=format&fit=crop&q=80'" 
                      :alt="rep.name" 
                      class="w-full h-full object-cover"
                      @error="(e) => e.target.src = 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=200&auto=format&fit=crop&q=80'"
                    />
                  </div>
                  <div>
                    <div class="font-bold text-slate-900">{{ rep.name }}</div>
                    <div class="text-xs text-slate-500 font-medium">{{ rep.designation || 'Area Representative' }}</div>
                  </div>
                </div>
              </td>

              <!-- Contacts -->
              <td class="py-4 px-6">
                <div class="space-y-1">
                  <div class="flex items-center gap-2 text-slate-700 font-semibold">
                    <i class="fa-solid fa-phone text-xs text-red-600"></i>
                    <span>{{ rep.phone }}</span>
                  </div>
                  <div v-if="rep.whatsapp" class="flex items-center gap-2 text-xs text-emerald-600">
                    <i class="fa-brands fa-whatsapp text-sm"></i>
                    <span>{{ rep.whatsapp }}</span>
                  </div>
                  <div v-if="rep.email" class="flex items-center gap-2 text-xs text-slate-500">
                    <i class="fa-solid fa-envelope text-xs"></i>
                    <span>{{ rep.email }}</span>
                  </div>
                </div>
              </td>

              <!-- Districts -->
              <td class="py-4 px-6">
                <div class="flex flex-wrap gap-1.5 max-w-md">
                  <span 
                    v-for="dist in (rep.districts || [])" 
                    :key="dist" 
                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-200"
                  >
                    {{ dist }}
                  </span>
                  <span v-if="!rep.districts || rep.districts.length === 0" class="text-xs text-slate-400 italic">
                    None assigned
                  </span>
                </div>
              </td>

              <!-- Status -->
              <td class="py-4 px-6 text-center">
                <span 
                  :class="rep.is_active ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-slate-100 text-slate-600 border-slate-200'"
                  class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold border"
                >
                  <span class="w-1.5 h-1.5 rounded-full" :class="rep.is_active ? 'bg-emerald-600' : 'bg-slate-400'"></span>
                  {{ rep.is_active ? 'Active' : 'Hidden' }}
                </span>
              </td>

              <!-- Actions -->
              <td class="py-4 px-6 text-right">
                <div class="flex items-center justify-end gap-2">
                  <button 
                    @click="openEditModal(rep)" 
                    class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 hover:text-slate-900 flex items-center justify-center transition cursor-pointer"
                    title="Edit Representative"
                  >
                    <i class="fa-solid fa-pen text-xs"></i>
                  </button>
                  <button 
                    @click="deleteRep(rep)" 
                    class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 hover:text-red-700 flex items-center justify-center transition cursor-pointer"
                    title="Delete Representative"
                  >
                    <i class="fa-solid fa-trash-can text-xs"></i>
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Empty State -->
    <div v-else class="bg-white rounded-2xl p-12 text-center border border-slate-200/80">
      <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 mx-auto flex items-center justify-center text-2xl mb-4">
        <i class="fa-solid fa-user-slash"></i>
      </div>
      <h3 class="text-lg font-bold text-slate-800 mb-1">No Representatives Found</h3>
      <p class="text-slate-500 text-sm mb-5">
        {{ searchQuery || selectedDistrictFilter ? 'No representatives match your current search criteria.' : 'Get started by creating your first sales representative.' }}
      </p>
      <button 
        @click="openCreateModal" 
        class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-xl text-sm font-semibold transition cursor-pointer"
      >
        + Add Representative
      </button>
    </div>

    <!-- Create / Edit Modal -->
    <div 
      v-if="isModalOpen" 
      class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 overflow-y-auto"
      @click.self="closeModal"
    >
      <div class="bg-white rounded-2xl max-w-2xl w-full shadow-2xl border border-slate-200 overflow-hidden my-8">
        <!-- Modal Header -->
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between bg-slate-50">
          <div>
            <h3 class="font-extrabold text-slate-900 text-lg">
              {{ isEditing ? 'Edit Sales Representative' : 'Add New Sales Representative' }}
            </h3>
            <p class="text-xs text-slate-500 mt-0.5">Details and district allocations will display on the interactive Sri Lanka map.</p>
          </div>
          <button @click="closeModal" class="w-8 h-8 rounded-full bg-slate-200 hover:bg-slate-300 text-slate-600 flex items-center justify-center transition cursor-pointer">
            <i class="fa-solid fa-xmark text-sm"></i>
          </button>
        </div>

        <!-- Modal Body / Form -->
        <form @submit.prevent="saveRep" class="p-6 space-y-5 max-h-[75vh] overflow-y-auto">
          <!-- Name & Designation -->
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Full Name *</label>
              <input 
                type="text" 
                v-model="form.name" 
                required 
                placeholder="e.g. Kasun Dissanayake" 
                class="w-full px-3.5 py-2 text-sm rounded-xl border border-slate-200 focus:border-red-600 focus:ring-2 focus:ring-red-600/20 outline-none transition"
              />
            </div>
            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Designation</label>
              <input 
                type="text" 
                v-model="form.designation" 
                placeholder="e.g. Senior Area Sales Manager" 
                class="w-full px-3.5 py-2 text-sm rounded-xl border border-slate-200 focus:border-red-600 focus:ring-2 focus:ring-red-600/20 outline-none transition"
              />
            </div>
          </div>

          <!-- Contact Numbers -->
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Phone Number *</label>
              <input 
                type="text" 
                v-model="form.phone" 
                required 
                placeholder="+94 77 123 4567" 
                class="w-full px-3.5 py-2 text-sm rounded-xl border border-slate-200 focus:border-red-600 focus:ring-2 focus:ring-red-600/20 outline-none transition"
              />
            </div>
            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">WhatsApp Number</label>
              <input 
                type="text" 
                v-model="form.whatsapp" 
                placeholder="+94771234567" 
                class="w-full px-3.5 py-2 text-sm rounded-xl border border-slate-200 focus:border-red-600 focus:ring-2 focus:ring-red-600/20 outline-none transition"
              />
            </div>
            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Email Address</label>
              <input 
                type="email" 
                v-model="form.email" 
                placeholder="sales@universalpaints.lk" 
                class="w-full px-3.5 py-2 text-sm rounded-xl border border-slate-200 focus:border-red-600 focus:ring-2 focus:ring-red-600/20 outline-none transition"
              />
            </div>
          </div>

          <!-- Profile Photo (Cloudflare R2) -->
          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Representative Photo</label>
            <div class="flex items-center gap-4">
              <div class="w-16 h-16 rounded-full overflow-hidden bg-slate-100 border border-slate-200 shrink-0">
                <img 
                  v-if="form.image" 
                  :src="form.image" 
                  alt="Preview" 
                  class="w-full h-full object-cover"
                />
                <div v-else class="w-full h-full flex items-center justify-center text-slate-400 text-xl">
                  <i class="fa-solid fa-user"></i>
                </div>
              </div>
              <div class="space-y-2 flex-1">
                <div class="flex items-center gap-2">
                  <label class="cursor-pointer bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold py-2 px-3 rounded-lg border border-slate-300 transition flex items-center gap-1.5 shrink-0">
                    <i class="fa-solid fa-cloud-arrow-up text-red-600"></i>
                    <span>{{ isUploadingImage ? 'Uploading...' : 'Upload Photo (Cloudflare R2)' }}</span>
                    <input type="file" accept="image/*" class="hidden" :disabled="isUploadingImage" @change="handlePhotoUpload" />
                  </label>
                  <button 
                    v-if="form.image" 
                    type="button" 
                    @click="form.image = ''" 
                    class="text-xs text-red-600 hover:underline cursor-pointer"
                  >
                    Remove
                  </button>
                </div>
                <input 
                  type="text" 
                  v-model="form.image" 
                  placeholder="Or enter direct image URL" 
                  class="w-full px-3 py-1.5 text-xs rounded-lg border border-slate-200 focus:border-red-600 outline-none"
                />
              </div>
            </div>
          </div>

          <!-- Covered Districts (Province-Grouped Selection) -->
          <div>
            <div class="flex items-center justify-between mb-2">
              <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">
                Assigned Sri Lankan Districts ({{ form.districts.length }} Selected)
              </label>
              <div class="flex gap-2">
                <button 
                  type="button" 
                  @click="selectAllDistricts" 
                  class="text-[11px] font-semibold text-red-600 hover:underline cursor-pointer"
                >
                  Select All
                </button>
                <span class="text-slate-300">|</span>
                <button 
                  type="button" 
                  @click="clearAllDistricts" 
                  class="text-[11px] font-semibold text-slate-500 hover:underline cursor-pointer"
                >
                  Clear All
                </button>
              </div>
            </div>

            <div class="border border-slate-200 rounded-xl p-3 bg-slate-50/50 max-h-56 overflow-y-auto space-y-3">
              <div v-for="prov in provinceDistricts" :key="prov.province" class="space-y-1.5">
                <div class="flex items-center justify-between">
                  <span class="text-xs font-bold text-slate-700">{{ prov.province }}</span>
                  <button 
                    type="button" 
                    @click="toggleProvince(prov.districts)" 
                    class="text-[10px] text-slate-400 hover:text-red-600 cursor-pointer"
                  >
                    toggle
                  </button>
                </div>
                <div class="flex flex-wrap gap-1.5">
                  <label 
                    v-for="d in prov.districts" 
                    :key="d" 
                    :class="form.districts.includes(d) ? 'bg-red-600 text-white border-red-600' : 'bg-white text-slate-700 border-slate-200 hover:border-slate-300'"
                    class="px-2.5 py-1 rounded-lg text-xs font-medium border cursor-pointer select-none transition flex items-center gap-1.5"
                  >
                    <input 
                      type="checkbox" 
                      :value="d" 
                      v-model="form.districts" 
                      class="hidden" 
                    />
                    <i v-if="form.districts.includes(d)" class="fa-solid fa-check text-[10px]"></i>
                    <span>{{ d }}</span>
                  </label>
                </div>
              </div>
            </div>
          </div>

          <!-- Active & Sort Order -->
          <div class="flex flex-wrap items-center justify-between gap-4 pt-2 border-t border-slate-100">
            <label class="flex items-center gap-2.5 cursor-pointer">
              <input 
                type="checkbox" 
                v-model="form.is_active" 
                class="w-4 h-4 text-red-600 rounded border-slate-300 focus:ring-red-500"
              />
              <span class="text-sm font-semibold text-slate-800">Active (Visible on public Sri Lanka Map)</span>
            </label>

            <div class="flex items-center gap-2">
              <label class="text-xs font-semibold text-slate-500">Sort Order:</label>
              <input 
                type="number" 
                v-model.number="form.sort_order" 
                class="w-20 px-3 py-1 text-sm border border-slate-200 rounded-lg text-center"
              />
            </div>
          </div>

          <!-- Notes -->
          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Notes / Coverage details</label>
            <textarea 
              v-model="form.notes" 
              rows="2" 
              placeholder="e.g. Handles all commercial contractors, dealer networks, etc." 
              class="w-full px-3.5 py-2 text-sm rounded-xl border border-slate-200 focus:border-red-600 outline-none"
            ></textarea>
          </div>

          <!-- Modal Footer -->
          <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-200">
            <button 
              type="button" 
              @click="closeModal" 
              class="px-4 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition cursor-pointer"
            >
              Cancel
            </button>
            <button 
              type="submit" 
              :disabled="isSubmitting" 
              class="bg-red-600 hover:bg-red-700 disabled:opacity-50 text-white px-6 py-2.5 rounded-xl text-sm font-semibold transition shadow-md shadow-red-600/20 cursor-pointer flex items-center gap-2"
            >
              <i v-if="isSubmitting" class="fa-solid fa-circle-notch fa-spin"></i>
              <span>{{ isSubmitting ? 'Saving...' : (isEditing ? 'Update Representative' : 'Save Representative') }}</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { compressImage } from '~/utils/imageCompressor'

const config = useRuntimeConfig()
const { token } = useAuth()

// Fetch all reps from backend
const { data: reps, pending, refresh } = await useFetch(`${config.public.apiBase}/api/sales-reps`, {
  headers: computed(() => ({
    Authorization: token.value ? `Bearer ${token.value}` : ''
  }))
})

// Sri Lanka Province & District mapping
const provinceDistricts = [
  { province: 'Western Province', districts: ['Colombo', 'Gampaha', 'Kalutara'] },
  { province: 'Central Province', districts: ['Kandy', 'Matale', 'Nuwara Eliya'] },
  { province: 'Southern Province', districts: ['Galle', 'Matara', 'Hambantota'] },
  { province: 'Northern Province', districts: ['Jaffna', 'Kilinochchi', 'Mannar', 'Vavuniya', 'Mullaitivu'] },
  { province: 'Eastern Province', districts: ['Batticaloa', 'Ampara', 'Trincomalee'] },
  { province: 'North Western Province', districts: ['Kurunegala', 'Puttalam'] },
  { province: 'North Central Province', districts: ['Anuradhapura', 'Polonnaruwa'] },
  { province: 'Uva Province', districts: ['Badulla', 'Monaragala'] },
  { province: 'Sabaragamuwa Province', districts: ['Ratnapura', 'Kegalle'] },
]

const allDistrictsList = [
  'Colombo', 'Gampaha', 'Kalutara',
  'Kandy', 'Matale', 'Nuwara Eliya',
  'Galle', 'Matara', 'Hambantota',
  'Jaffna', 'Kilinochchi', 'Mannar', 'Vavuniya', 'Mullaitivu',
  'Batticaloa', 'Ampara', 'Trincomalee',
  'Kurunegala', 'Puttalam',
  'Anuradhapura', 'Polonnaruwa',
  'Badulla', 'Monaragala',
  'Ratnapura', 'Kegalle'
]

// Stats
const activeRepsCount = computed(() => {
  return reps.value?.filter(r => r.is_active)?.length || 0
})

const coveredDistrictsCount = computed(() => {
  const set = new Set()
  reps.value?.forEach(r => {
    if (r.is_active && Array.isArray(r.districts)) {
      r.districts.forEach(d => set.add(d))
    }
  })
  return set.size
})

// Search & Filtering
const searchQuery = ref('')
const selectedDistrictFilter = ref('')

const filteredReps = computed(() => {
  let list = reps.value || []

  if (selectedDistrictFilter.value) {
    list = list.filter(r => Array.isArray(r.districts) && r.districts.includes(selectedDistrictFilter.value))
  }

  if (searchQuery.value.trim()) {
    const q = searchQuery.value.toLowerCase().trim()
    list = list.filter(r => {
      const matchName = (r.name || '').toLowerCase().includes(q)
      const matchPhone = (r.phone || '').toLowerCase().includes(q)
      const matchEmail = (r.email || '').toLowerCase().includes(q)
      const matchDesig = (r.designation || '').toLowerCase().includes(q)
      const matchDist = Array.isArray(r.districts) && r.districts.some(d => d.toLowerCase().includes(q))
      return matchName || matchPhone || matchEmail || matchDesig || matchDist
    })
  }

  return list
})

// Modal & Form State
const isModalOpen = ref(false)
const isEditing = ref(false)
const editingId = ref(null)
const isSubmitting = ref(false)
const isUploadingImage = ref(false)

const form = ref({
  name: '',
  designation: 'Area Sales Executive',
  phone: '',
  whatsapp: '',
  email: '',
  districts: [],
  image: '',
  is_active: true,
  sort_order: 0,
  notes: ''
})

const openCreateModal = () => {
  isEditing.value = false
  editingId.value = null
  form.value = {
    name: '',
    designation: 'Area Sales Executive',
    phone: '',
    whatsapp: '',
    email: '',
    districts: [],
    image: '',
    is_active: true,
    sort_order: 0,
    notes: ''
  }
  isModalOpen.value = true
}

const openEditModal = (rep) => {
  isEditing.value = true
  editingId.value = rep.id
  form.value = {
    name: rep.name || '',
    designation: rep.designation || '',
    phone: rep.phone || '',
    whatsapp: rep.whatsapp || '',
    email: rep.email || '',
    districts: Array.isArray(rep.districts) ? [...rep.districts] : [],
    image: rep.image || '',
    is_active: rep.is_active ?? true,
    sort_order: rep.sort_order || 0,
    notes: rep.notes || ''
  }
  isModalOpen.value = true
}

const closeModal = () => {
  isModalOpen.value = false
  isEditing.value = false
  editingId.value = null
}

const selectAllDistricts = () => {
  form.value.districts = [...allDistrictsList]
}

const clearAllDistricts = () => {
  form.value.districts = []
}

const toggleProvince = (districts) => {
  const allPresent = districts.every(d => form.value.districts.includes(d))
  if (allPresent) {
    form.value.districts = form.value.districts.filter(d => !districts.includes(d))
  } else {
    districts.forEach(d => {
      if (!form.value.districts.includes(d)) {
        form.value.districts.push(d)
      }
    })
  }
}

// Upload photo to Cloudflare R2 via /api/upload
const handlePhotoUpload = async (e) => {
  const rawFile = e.target.files?.[0]
  if (!rawFile) return

  isUploadingImage.value = true
  try {
    const file = await compressImage(rawFile, { maxWidth: 1200, maxHeight: 1200, quality: 0.82 })
    const formData = new FormData()
    formData.append('image', file)
    formData.append('folder', 'sales-reps')

    const res = await $fetch(`${config.public.apiBase}/api/upload`, {
      method: 'POST',
      body: formData,
      headers: {
        Authorization: `Bearer ${token.value}`
      }
    })
    form.value.image = res.url
  } catch (err) {
    alert('Failed to upload image to Cloudflare R2: ' + (err.data?.message || err.message))
  } finally {
    isUploadingImage.value = false
    e.target.value = ''
  }
}

// Save Rep (Create or Update)
const saveRep = async () => {
  isSubmitting.value = true
  try {
    const payload = {
      ...form.value,
      whatsapp: form.value.whatsapp || form.value.phone
    }

    if (isEditing.value) {
      await $fetch(`${config.public.apiBase}/api/sales-reps/${editingId.value}`, {
        method: 'PUT',
        body: payload,
        headers: {
          Authorization: `Bearer ${token.value}`
        }
      })
    } else {
      await $fetch(`${config.public.apiBase}/api/sales-reps`, {
        method: 'POST',
        body: payload,
        headers: {
          Authorization: `Bearer ${token.value}`
        }
      })
    }

    await refresh()
    closeModal()
  } catch (err) {
    alert('Failed to save sales representative: ' + (err.data?.message || err.message))
  } finally {
    isSubmitting.value = false
  }
}

// Delete Rep
const deleteRep = async (rep) => {
  if (!confirm(`Are you sure you want to delete representative "${rep.name}"?`)) return

  try {
    await $fetch(`${config.public.apiBase}/api/sales-reps/${rep.id}`, {
      method: 'DELETE',
      headers: {
        Authorization: `Bearer ${token.value}`
      }
    })
    await refresh()
  } catch (err) {
    alert('Failed to delete representative: ' + (err.data?.message || err.message))
  }
}
</script>

