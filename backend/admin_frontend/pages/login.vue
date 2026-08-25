<template>
  <div>
    <div class="mb-10">
      <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Welcome back</h2>
      <p class="text-gray-500">Please enter your details to sign in.</p>
    </div>

    <form @submit.prevent="handleLogin" class="space-y-6">
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
        <input 
          id="email" 
          type="email" 
          v-model="email"
          placeholder="admin@universalpaints.lk"
          class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-brand-red focus:border-brand-red outline-none transition-all shadow-sm"
          required
        />
      </div>
      
      <div>
        <div class="flex items-center justify-between mb-1">
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <a href="#" class="text-sm font-semibold text-brand-red hover:text-red-700 transition-colors">Forgot password?</a>
        </div>
        <input 
          id="password" 
          type="password" 
          v-model="password"
          placeholder="••••••••"
          class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-brand-red focus:border-brand-red outline-none transition-all shadow-sm"
          required
        />
      </div>

      <div class="flex items-center">
        <input 
          id="remember-me" 
          type="checkbox" 
          class="h-4 w-4 text-brand-red focus:ring-brand-red border-gray-300 rounded cursor-pointer"
        />
        <label for="remember-me" class="ml-2 block text-sm text-gray-700 cursor-pointer">
          Remember me for 30 days
        </label>
      </div>

      <button 
        type="submit" 
        class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-lg shadow-md text-sm font-bold text-white bg-brand-red hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-red transition-all transform hover:-translate-y-0.5 active:translate-y-0"
      >
        Sign in to Dashboard
      </button>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

definePageMeta({
  layout: 'auth'
})

const router = useRouter()
const email = ref('')
const password = ref('')

const handleLogin = () => {
  // Mock login for now
  if (email.value) {
    router.push('/')
  }
}
</script>
