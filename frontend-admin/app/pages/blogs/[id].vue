<template>
  <div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
      <NuxtLink to="/blogs" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-slate-200 transition">
        <i class="fa-solid fa-arrow-left"></i>
      </NuxtLink>
      <h1 class="text-3xl font-extrabold text-slate-900">Edit Blog Post</h1>
    </div>

    <!-- Loading State -->
    <div v-if="pending" class="flex justify-center py-20">
      <i class="fa-solid fa-spinner fa-spin text-4xl text-slate-300"></i>
    </div>

    <form v-else-if="form" @submit.prevent="submitForm" class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 space-y-6">
      
      <!-- Title -->
      <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">Title</label>
        <input 
          v-model="form.title" 
          type="text" 
          required 
          class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition"
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
          <label class="block text-sm font-semibold text-slate-700 mb-2">Update Cover Image</label>
          <input 
            type="file" 
            @change="handleImage" 
            accept="image/*"
            class="w-full px-4 py-2.5 rounded-lg border border-slate-200 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100 transition"
          />
          <div v-if="existingImage" class="mt-2 text-sm text-slate-500 flex items-center gap-2">
            <i class="fa-solid fa-image"></i>
            Current image exists
          </div>
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
          {{ isSubmitting ? 'Saving...' : 'Update Blog Post' }}
        </button>
      </div>
    </form>
    
    <div v-else class="text-center text-red-500 py-10">
      Blog post not found!
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'

const config = useRuntimeConfig()
const { token } = useAuth()
const router = useRouter()
const route = useRoute()

const id = route.params.id

const pending = ref(true)
const isSubmitting = ref(false)
const imageFile = ref(null)
const existingImage = ref(null)

const form = ref(null)

onMounted(async () => {
  try {
    // In our backend, show() expects slug if it's the public route.
    // Wait, we didn't create an admin show route for blogs, we only have a public one by slug.
    // Let's just fetch all and find it, or we can use the public slug route if we know the slug.
    // Actually, we can fetch all blogs and filter, because our admin index route returns all blogs.
    const blogs = await $fetch(`${config.public.apiBase}/api/blogs`, {
      headers: { Authorization: `Bearer ${token.value}` }
    })
    
    const blog = blogs.find(b => b.id == id)
    if (blog) {
      form.value = {
        title: blog.title,
        status: blog.status,
        content: blog.content
      }
      existingImage.value = blog.image
    }
  } catch (err) {
    console.error('Failed to fetch blog', err)
  } finally {
    pending.value = false
  }
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
    
    // Laravel requires _method=PUT for FormData PUT requests
    formData.append('_method', 'PUT')
    
    if (imageFile.value) {
      formData.append('image', imageFile.value)
    }

    await $fetch(`${config.public.apiBase}/api/blogs/${id}`, {
      method: 'POST', // using POST with _method=PUT
      headers: {
        Authorization: `Bearer ${token.value}`
      },
      body: formData
    })
    
    router.push('/blogs')
  } catch (err) {
    alert('Error updating blog post. ' + (err.data?.message || err.message))
    console.error(err)
  } finally {
    isSubmitting.value = false
  }
}
</script>
