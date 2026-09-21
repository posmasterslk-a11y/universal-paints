<template>
  <div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
      <NuxtLink to="/blogs" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-slate-200 transition">
        <i class="fa-solid fa-arrow-left"></i>
      </NuxtLink>
      <h1 class="text-3xl font-extrabold text-slate-900">Create Blog Post</h1>
    </div>

    <form @submit.prevent="submitForm" class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 space-y-6">
      
      <!-- Title -->
      <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">Title</label>
        <input 
          v-model="form.title" 
          type="text" 
          required 
          class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition"
          placeholder="Enter blog title..."
        />
      </div>

      <!-- Status & Image Row -->
      <div class="grid grid-cols-2 gap-6">
        <div>
          <label class="block text-sm font-semibold text-slate-700 mb-2">Status</label>
          <select 
            v-model="form.status" 
            class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition"
          >
            <option value="draft">Draft</option>
            <option value="published">Published</option>
          </select>
        </div>
        
        <div>
          <label class="block text-sm font-semibold text-slate-700 mb-2">Cover Image</label>
          <input 
            type="file" 
            @change="handleImage" 
            accept="image/*"
            class="w-full px-4 py-2.5 rounded-lg border border-slate-200 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100 transition"
          />
        </div>
      </div>

      <!-- Content Editor -->
      <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">Content</label>
        <div class="border border-slate-200 rounded-lg overflow-hidden">
          <ClientOnly>
            <QuillEditor 
              v-model:content="form.content" 
              contentType="html" 
              theme="snow" 
              class="h-64 bg-white"
            />
          </ClientOnly>
        </div>
      </div>

      <!-- Actions -->
      <div class="flex justify-end gap-3 pt-6 border-t border-slate-100">
        <NuxtLink to="/blogs" class="px-6 py-2.5 rounded-lg font-medium text-slate-600 hover:bg-slate-100 transition">
          Cancel
        </NuxtLink>
        <button 
          type="submit" 
          :disabled="isSubmitting"
          class="bg-red-600 hover:bg-red-700 text-white px-6 py-2.5 rounded-lg font-medium transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2"
        >
          <i class="fa-solid fa-spinner fa-spin" v-if="isSubmitting"></i>
          {{ isSubmitting ? 'Saving...' : 'Save Blog Post' }}
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const config = useRuntimeConfig()
const { token } = useAuth()
const router = useRouter()

const isSubmitting = ref(false)
const imageFile = ref(null)

const form = ref({
  title: '',
  status: 'draft',
  content: ''
})

const handleImage = (e) => {
  if (e.target.files && e.target.files[0]) {
    imageFile.value = e.target.files[0]
  }
}

const submitForm = async () => {
  if (!form.value.content || form.value.content === '<p><br></p>') {
    alert('Please enter blog content')
    return
  }
  
  isSubmitting.value = true
  
  try {
    const formData = new FormData()
    formData.append('title', form.value.title)
    formData.append('status', form.value.status)
    formData.append('content', form.value.content)
    
    if (imageFile.value) {
      formData.append('image', imageFile.value)
    }

    await $fetch(`${config.public.apiBase}/api/blogs`, {
      method: 'POST',
      headers: {
        Authorization: `Bearer ${token.value}`
      },
      body: formData
    })
    
    router.push('/blogs')
  } catch (err) {
    alert('Error saving blog post. ' + (err.data?.message || err.message))
    console.error(err)
  } finally {
    isSubmitting.value = false
  }
}
</script>
