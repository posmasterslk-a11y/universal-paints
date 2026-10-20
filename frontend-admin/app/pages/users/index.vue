<template>
  <div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
      <div>
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">User Accounts</h1>
        <p class="text-slate-500 text-sm mt-1">Register new administrators and manage existing system access.</p>
      </div>
      <button 
        @click="openCreateModal"
        class="bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-lg font-medium shadow-sm transition flex items-center gap-2 cursor-pointer"
      >
        <i class="fa-solid fa-user-plus"></i>
        Register New User
      </button>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
      <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-lg bg-red-50 text-red-600 flex items-center justify-center text-xl">
          <i class="fa-solid fa-users"></i>
        </div>
        <div>
          <div class="text-2xl font-black text-slate-800">{{ users?.length || 0 }}</div>
          <div class="text-xs uppercase font-bold text-slate-400">Total Users</div>
        </div>
      </div>

      <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-lg bg-green-50 text-green-600 flex items-center justify-center text-xl">
          <i class="fa-solid fa-shield-halved"></i>
        </div>
        <div>
          <div class="text-2xl font-black text-slate-800">{{ users?.length || 0 }} Active</div>
          <div class="text-xs uppercase font-bold text-slate-400">Administrators</div>
        </div>
      </div>

      <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-xl">
          <i class="fa-solid fa-id-badge"></i>
        </div>
        <div class="truncate">
          <div class="text-sm font-bold text-slate-800 truncate">{{ currentUser?.name || 'Administrator' }}</div>
          <div class="text-xs text-slate-400 truncate">{{ currentUser?.email }} (You)</div>
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
      <button @click="notification.message = ''" class="text-slate-400 hover:text-slate-600">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <!-- Error State -->
    <div v-if="fetchError" class="bg-red-50 border border-red-200 text-red-600 p-4 rounded-lg flex items-center gap-3">
      <i class="fa-solid fa-circle-exclamation"></i>
      {{ fetchError }}
    </div>

    <!-- Loading State -->
    <div v-if="pending" class="flex justify-center items-center py-20">
      <i class="fa-solid fa-spinner fa-spin text-4xl text-slate-300"></i>
    </div>

    <!-- Users Table -->
    <div v-else class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
      <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
        <h3 class="font-bold text-slate-800">System Accounts</h3>
        <span class="text-xs text-slate-400">All registered admin accounts</span>
      </div>
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-slate-50 border-b border-slate-200 text-xs uppercase text-slate-500 font-semibold tracking-wider">
              <th class="p-4 pl-6">User</th>
              <th class="p-4">Email</th>
              <th class="p-4">Role</th>
              <th class="p-4">Registered Date</th>
              <th class="p-4 pr-6 text-right">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="u in users" :key="u.id" class="border-b border-slate-100 hover:bg-slate-50/80 transition">
              <td class="p-4 pl-6">
                <div class="flex items-center gap-3">
                  <div class="w-10 h-10 rounded-full bg-slate-900 text-white flex items-center justify-center font-bold text-sm shadow-sm">
                    {{ getInitials(u.name) }}
                  </div>
                  <div>
                    <div class="font-bold text-slate-800 flex items-center gap-2">
                      {{ u.name }}
                      <span v-if="currentUser?.id === u.id" class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-700">
                        You
                      </span>
                    </div>
                    <div class="text-xs text-slate-400">ID: #{{ u.id }}</div>
                  </div>
                </div>
              </td>
              <td class="p-4 text-sm text-slate-600 font-medium">
                {{ u.email }}
              </td>
              <td class="p-4">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                  <i class="fa-solid fa-shield text-[10px]"></i> Administrator
                </span>
              </td>
              <td class="p-4 text-slate-500 text-sm">
                {{ formatDate(u.created_at) }}
              </td>
              <td class="p-4 pr-6 text-right">
                <div class="flex items-center justify-end gap-2">
                  <button 
                    @click="openEditModal(u)" 
                    class="w-8 h-8 rounded bg-slate-100 text-slate-600 hover:bg-slate-200 hover:text-slate-900 flex items-center justify-center transition cursor-pointer"
                    title="Edit User"
                  >
                    <i class="fa-solid fa-pen text-xs"></i>
                  </button>
                  <button 
                    v-if="currentUser?.id !== u.id"
                    @click="deleteUser(u)" 
                    class="w-8 h-8 rounded bg-red-50 text-red-600 hover:bg-red-100 hover:text-red-700 flex items-center justify-center transition cursor-pointer"
                    title="Delete User"
                  >
                    <i class="fa-solid fa-trash text-xs"></i>
                  </button>
                  <span 
                    v-else 
                    class="w-8 h-8 rounded bg-slate-50 text-slate-300 flex items-center justify-center cursor-not-allowed"
                    title="Cannot delete your own account"
                  >
                    <i class="fa-solid fa-trash text-xs"></i>
                  </span>
                </div>
              </td>
            </tr>
            <tr v-if="!users?.length">
              <td colspan="5" class="p-10 text-center text-slate-500">
                <i class="fa-solid fa-users text-3xl text-slate-300 mb-2"></i>
                <p>No user accounts found.</p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Registration / Create User Modal -->
    <div v-if="showCreateModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-xs p-4">
      <div class="bg-white rounded-2xl shadow-xl border border-slate-100 w-full max-w-md overflow-hidden animate-in fade-in zoom-in duration-150">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
          <div>
            <h3 class="text-lg font-bold text-slate-900">Register New User</h3>
            <p class="text-xs text-slate-500 mt-0.5">Create a new administrator login account</p>
          </div>
          <button @click="showCreateModal = false" class="text-slate-400 hover:text-slate-600 cursor-pointer">
            <i class="fa-solid fa-xmark text-lg"></i>
          </button>
        </div>

        <form @submit.prevent="handleCreateUser" class="p-6 space-y-4">
          <div v-if="formError" class="p-3 bg-red-50 border border-red-200 text-red-600 rounded-lg text-sm flex items-center gap-2">
            <i class="fa-solid fa-circle-exclamation text-xs"></i>
            <span>{{ formError }}</span>
          </div>

          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Full Name</label>
            <div class="relative">
              <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                <i class="fa-solid fa-user text-xs"></i>
              </span>
              <input 
                v-model="createForm.name" 
                type="text" 
                required 
                placeholder="e.g. Kamal Perera"
                class="w-full pl-9 pr-3 py-2.5 rounded-lg border border-slate-200 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm"
              />
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Email Address</label>
            <div class="relative">
              <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                <i class="fa-solid fa-envelope text-xs"></i>
              </span>
              <input 
                v-model="createForm.email" 
                type="email" 
                required 
                placeholder="user@universalpaints.lk"
                class="w-full pl-9 pr-3 py-2.5 rounded-lg border border-slate-200 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm"
              />
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Password</label>
            <div class="relative">
              <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                <i class="fa-solid fa-lock text-xs"></i>
              </span>
              <input 
                v-model="createForm.password" 
                :type="showPassword ? 'text' : 'password'" 
                required 
                minlength="6"
                placeholder="At least 6 characters"
                class="w-full pl-9 pr-10 py-2.5 rounded-lg border border-slate-200 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm"
              />
              <button 
                type="button" 
                @click="showPassword = !showPassword"
                class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 cursor-pointer"
              >
                <i :class="showPassword ? 'fa-solid fa-eye-slash text-xs' : 'fa-solid fa-eye text-xs'"></i>
              </button>
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Confirm Password</label>
            <div class="relative">
              <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                <i class="fa-solid fa-lock-open text-xs"></i>
              </span>
              <input 
                v-model="createForm.password_confirmation" 
                :type="showPassword ? 'text' : 'password'" 
                required 
                minlength="6"
                placeholder="Re-enter password"
                class="w-full pl-9 pr-3 py-2.5 rounded-lg border border-slate-200 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm"
              />
            </div>
          </div>

          <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100">
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
              <span v-else>Register User</span>
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Edit User Modal -->
    <div v-if="showEditModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-xs p-4">
      <div class="bg-white rounded-2xl shadow-xl border border-slate-100 w-full max-w-md overflow-hidden animate-in fade-in zoom-in duration-150">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
          <div>
            <h3 class="text-lg font-bold text-slate-900">Edit User Account</h3>
            <p class="text-xs text-slate-500 mt-0.5">Update details for {{ editForm.name }}</p>
          </div>
          <button @click="showEditModal = false" class="text-slate-400 hover:text-slate-600 cursor-pointer">
            <i class="fa-solid fa-xmark text-lg"></i>
          </button>
        </div>

        <form @submit.prevent="handleUpdateUser" class="p-6 space-y-4">
          <div v-if="editFormError" class="p-3 bg-red-50 border border-red-200 text-red-600 rounded-lg text-sm flex items-center gap-2">
            <i class="fa-solid fa-circle-exclamation text-xs"></i>
            <span>{{ editFormError }}</span>
          </div>

          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Full Name</label>
            <input 
              v-model="editForm.name" 
              type="text" 
              required 
              class="w-full px-3 py-2.5 rounded-lg border border-slate-200 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm"
            />
          </div>

          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Email Address</label>
            <input 
              v-model="editForm.email" 
              type="email" 
              required 
              class="w-full px-3 py-2.5 rounded-lg border border-slate-200 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm"
            />
          </div>

          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">
              New Password <span class="text-slate-400 normal-case font-normal">(leave blank to keep current)</span>
            </label>
            <input 
              v-model="editForm.password" 
              type="password" 
              minlength="6"
              placeholder="••••••••"
              class="w-full px-3 py-2.5 rounded-lg border border-slate-200 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm"
            />
          </div>

          <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100">
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
import { ref, reactive } from 'vue'

const config = useRuntimeConfig()
const { token, user: currentUser } = useAuth()

const showCreateModal = ref(false)
const showEditModal = ref(false)
const showPassword = ref(false)
const submitting = ref(false)
const formError = ref('')
const editFormError = ref('')

const notification = reactive({
  message: '',
  type: 'success'
})

const createForm = reactive({
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
})

const editForm = reactive({
  id: null,
  name: '',
  email: '',
  password: ''
})

// Fetch users
const { data: users, pending, error: fetchError, refresh } = await useFetch(`${config.public.apiBase}/api/users`, {
  headers: {
    Authorization: `Bearer ${token.value}`
  }
})

const getInitials = (name) => {
  if (!name) return 'U'
  return name.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase()
}

const formatDate = (dateStr) => {
  if (!dateStr) return '-'
  const d = new Date(dateStr)
  return d.toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'short',
    day: 'numeric'
  })
}

const openCreateModal = () => {
  createForm.name = ''
  createForm.email = ''
  createForm.password = ''
  createForm.password_confirmation = ''
  formError.value = ''
  showPassword.value = false
  showCreateModal.value = true
}

const handleCreateUser = async () => {
  formError.value = ''

  if (createForm.password !== createForm.password_confirmation) {
    formError.value = 'Passwords do not match.'
    return
  }

  if (createForm.password.length < 6) {
    formError.value = 'Password must be at least 6 characters.'
    return
  }

  submitting.value = true
  try {
    const res = await $fetch(`${config.public.apiBase}/api/users`, {
      method: 'POST',
      headers: {
        Authorization: `Bearer ${token.value}`
      },
      body: {
        name: createForm.name,
        email: createForm.email,
        password: createForm.password,
        password_confirmation: createForm.password_confirmation
      }
    })

    showCreateModal.value = false
    notification.message = res.message || 'User registered successfully!'
    notification.type = 'success'
    refresh()
  } catch (err) {
    console.error('Registration error:', err)
    formError.value = err?.data?.message || err?.data?.errors?.email?.[0] || 'Failed to register user. Please check the details.'
  } finally {
    submitting.value = false
  }
}

const openEditModal = (u) => {
  editForm.id = u.id
  editForm.name = u.name
  editForm.email = u.email
  editForm.password = ''
  editFormError.value = ''
  showEditModal.value = true
}

const handleUpdateUser = async () => {
  editFormError.value = ''
  submitting.value = true

  try {
    const payload = {
      name: editForm.name,
      email: editForm.email
    }
    if (editForm.password) {
      payload.password = editForm.password
    }

    const res = await $fetch(`${config.public.apiBase}/api/users/${editForm.id}`, {
      method: 'PUT',
      headers: {
        Authorization: `Bearer ${token.value}`
      },
      body: payload
    })

    showEditModal.value = false
    notification.message = res.message || 'User updated successfully!'
    notification.type = 'success'
    refresh()
  } catch (err) {
    console.error('Update error:', err)
    editFormError.value = err?.data?.message || 'Failed to update user.'
  } finally {
    submitting.value = false
  }
}

const deleteUser = async (u) => {
  if (!confirm(`Are you sure you want to delete administrator "${u.name}" (${u.email})?`)) {
    return
  }

  try {
    const res = await $fetch(`${config.public.apiBase}/api/users/${u.id}`, {
      method: 'DELETE',
      headers: {
        Authorization: `Bearer ${token.value}`
      }
    })

    notification.message = res.message || 'User deleted successfully!'
    notification.type = 'success'
    refresh()
  } catch (err) {
    console.error('Delete error:', err)
    alert(err?.data?.message || 'Failed to delete user.')
  }
}
</script>
