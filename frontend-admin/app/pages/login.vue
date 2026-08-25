<template>
  <div class="min-h-screen flex items-center justify-center bg-slate-50">
    <div class="bg-white w-full max-w-md p-8 rounded-2xl shadow-xl text-center">
      <div class="mb-6 flex justify-center">
        <h1 class="text-3xl font-extrabold text-red-600">Universal Paints</h1>
      </div>
      
      <h2 class="text-2xl font-bold text-slate-900 mb-2">Admin Login</h2>
      <p class="text-slate-500 text-sm mb-8">Sign in to manage your store</p>

      <div v-if="errorMsg" class="bg-red-50 text-red-600 p-3 rounded-lg text-sm mb-6 border border-red-200 text-left">
        {{ errorMsg }}
      </div>

      <form @submit.prevent="handleLogin" class="space-y-5 text-left">
        <div>
          <label class="block text-sm font-semibold text-slate-700 mb-1">Email Address</label>
          <input type="email" v-model="email" required class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-red-600 focus:ring-2 focus:ring-red-600/20 outline-none transition" placeholder="admin@universalpaints.lk" :disabled="isLoading">
        </div>
        
        <div>
          <label class="block text-sm font-semibold text-slate-700 mb-1">Password</label>
          <div class="relative">
            <input :type="showPassword ? 'text' : 'password'" v-model="password" required class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-red-600 focus:ring-2 focus:ring-red-600/20 outline-none transition" placeholder="••••••••" :disabled="isLoading">
            <button type="button" @click="showPassword = !showPassword" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 focus:outline-none cursor-pointer">
              <i :class="showPassword ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'"></i>
            </button>
          </div>
        </div>
        
        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-lg transition shadow-lg shadow-red-600/30 mt-4 disabled:opacity-70 disabled:cursor-not-allowed" :disabled="isLoading">
          {{ isLoading ? 'Signing in...' : 'Sign In' }}
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

definePageMeta({
  layout: false
})

const { login } = useAuth()
const router = useRouter()

const email = ref('')
const password = ref('')
const showPassword = ref(false)
const isLoading = ref(false)
const errorMsg = ref('')

const handleLogin = async () => {
  isLoading.value = true
  errorMsg.value = ''
  
  const success = await login(email.value, password.value)
  
  if (success) {
    router.push('/')
  } else {
    errorMsg.value = 'Invalid email or password. Please try again.'
  }
  
  isLoading.value = false
}
</script>
