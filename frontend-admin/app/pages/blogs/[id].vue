<template>
  <div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
      <NuxtLink to="/blogs" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-slate-200 transition">
        <i class="fa-solid fa-arrow-left"></i>
      </NuxtLink>
      <div>
        <h1 class="text-3xl font-extrabold text-slate-900">Edit Blog Post</h1>
        <p class="text-sm text-slate-500 mt-0.5">Update article details, category, and content</p>
      </div>
    </div>

    <!-- Loading State -->
    <div v-if="pending" class="flex flex-col items-center justify-center py-24 bg-white rounded-xl border border-slate-200">
      <i class="fa-solid fa-spinner fa-spin text-4xl text-red-600 mb-3"></i>
      <p class="text-sm font-medium text-slate-500">Loading blog post data...</p>
    </div>

    <!-- Form -->
    <form v-else-if="form" @submit.prevent="submitForm" class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 space-y-6">
      
      <!-- Title -->
      <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">Title *</label>
        <input 
          v-model="form.title" 
          type="text" 
          required 
          class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition text-slate-900 font-medium"
          placeholder="Enter blog title..."
        />
      </div>

      <!-- Category & Status & Image Grid -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Category -->
        <div>
          <label class="block text-sm font-semibold text-slate-700 mb-2">Category</label>
          <div class="space-y-2">
            <input 
              v-model="form.category" 
              list="blog-category-presets-edit" 
              type="text"
              placeholder="Select or type category..."
              class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition bg-white"
            />
            <datalist id="blog-category-presets-edit">
              <option value="Innovation & Technology" />
              <option value="Color Trends & Design" />
              <option value="Company News & Events" />
              <option value="Tips & Guides" />
              <option value="Architectural Finishes" />
              <option value="Sustainability" />
            </datalist>
            <!-- Fast preset chips -->
            <div class="flex flex-wrap gap-1.5 pt-1">
              <button 
                type="button" 
                v-for="cat in presetCategories" 
                :key="cat"
                @click="form.category = cat"
                class="px-2 py-0.5 text-xs rounded-md transition border"
                :class="form.category === cat ? 'bg-red-50 border-red-300 text-red-700 font-semibold' : 'bg-slate-50 border-slate-200 text-slate-600 hover:bg-slate-100'"
              >
                {{ cat }}
              </button>
            </div>
          </div>
        </div>

        <!-- Status -->
        <div>
          <label class="block text-sm font-semibold text-slate-700 mb-2">Publication Status</label>
          <select 
            v-model="form.status" 
            class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition bg-white"
          >
            <option value="draft">Draft (Hidden from public)</option>
            <option value="published">Published (Visible on website)</option>
          </select>
          <p class="text-xs text-slate-500 mt-2">
            Status: <span class="font-semibold" :class="form.status === 'published' ? 'text-green-600' : 'text-slate-600'">{{ form.status.toUpperCase() }}</span>
          </p>
        </div>
        
        <!-- Cover Image -->
        <div>
          <label class="block text-sm font-semibold text-slate-700 mb-2">Cover Image</label>
          <input 
            type="file" 
            @change="handleImage" 
            accept="image/*"
            class="w-full px-3 py-2.5 rounded-lg border border-slate-200 file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100 transition text-sm"
          />
          <div class="mt-2 flex items-center gap-3">
            <div v-if="imagePreview || existingImage" class="relative w-20 h-14 rounded-md overflow-hidden border border-slate-200 bg-slate-50">
              <img :src="imagePreview || getExistingImageUrl(existingImage)" alt="Cover" class="w-full h-full object-cover" />
            </div>
            <span v-if="existingImage && !imagePreview" class="text-xs text-slate-500">Current image active</span>
            <span v-if="imagePreview" class="text-xs text-green-600 font-medium">New image selected</span>
          </div>
        </div>
      </div>

      <!-- Content Editor with Mode Toggle -->
      <div>
        <div class="flex items-center justify-between mb-2">
          <label class="block text-sm font-semibold text-slate-700">Content *</label>
          <div class="inline-flex rounded-lg border border-slate-200 p-0.5 bg-slate-50 text-xs font-semibold">
            <button 
              type="button" 
              @click="editorMode = 'visual'"
              class="px-3 py-1 rounded-md transition"
              :class="editorMode === 'visual' ? 'bg-white shadow-xs text-red-600 font-bold' : 'text-slate-600 hover:text-slate-900'"
            >
              <i class="fa-solid fa-pen-nib mr-1.5"></i>Visual Editor
            </button>
            <button 
              type="button" 
              @click="editorMode = 'code'"
              class="px-3 py-1 rounded-md transition"
              :class="editorMode === 'code' ? 'bg-white shadow-xs text-red-600 font-bold' : 'text-slate-600 hover:text-slate-900'"
            >
              <i class="fa-solid fa-code mr-1.5"></i>HTML Code
            </button>
          </div>
        </div>

        <!-- Visual Editor (Quill) -->
        <div v-show="editorMode === 'visual'" class="border border-slate-200 rounded-lg overflow-hidden bg-white quill-wrapper">
          <ClientOnly>
            <QuillEditor 
              v-model:content="form.content" 
              contentType="html" 
              theme="snow" 
              placeholder="Article content..."
              class="bg-white"
            />
            <template #fallback>
              <div class="p-6 text-center text-slate-400">
                <i class="fa-solid fa-spinner fa-spin text-2xl mb-2"></i>
                <p class="text-sm">Loading visual editor...</p>
              </div>
            </template>
          </ClientOnly>
        </div>

        <!-- HTML Code Editor -->
        <div v-show="editorMode === 'code'">
          <textarea 
            v-model="form.content" 
            rows="14" 
            placeholder="<p>Enter HTML content here...</p>"
            class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition font-mono text-sm leading-relaxed text-slate-800"
          ></textarea>
        </div>
        <p class="text-xs text-slate-400 mt-1.5">
          You can format text visually with bold, headings, and lists, or toggle to HTML Code to paste formatted code directly.
        </p>
      </div>

      <!-- Actions -->
      <div class="flex justify-end gap-3 pt-6 border-t border-slate-100">
        <NuxtLink to="/blogs" class="px-6 py-2.5 rounded-lg font-medium text-slate-600 hover:bg-slate-100 transition">
          Cancel
        </NuxtLink>
        <button 
          type="submit" 
          :disabled="isSubmitting"
          class="bg-red-600 hover:bg-red-700 text-white px-7 py-2.5 rounded-lg font-semibold transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2 shadow-sm"
        >
          <i class="fa-solid fa-spinner fa-spin" v-if="isSubmitting"></i>
          {{ isSubmitting ? 'Saving Changes...' : 'Update Blog Post' }}
        </button>
      </div>
    </form>
    
    <!-- Error / Not Found State -->
    <div v-else class="text-center py-16 bg-white rounded-xl border border-slate-200 space-y-4">
      <div class="w-16 h-16 mx-auto rounded-full bg-red-50 text-red-600 flex items-center justify-center text-2xl">
        <i class="fa-solid fa-circle-exclamation"></i>
      </div>
      <div>
        <h2 class="text-lg font-bold text-slate-800">Blog post not found!</h2>
        <p class="text-sm text-slate-500 mt-1">The blog ID {{ id }} could not be retrieved from the server.</p>
      </div>
      <NuxtLink to="/blogs" class="inline-flex items-center gap-2 px-5 py-2 rounded-lg bg-slate-100 text-slate-700 font-semibold hover:bg-slate-200 transition text-sm">
        <i class="fa-solid fa-arrow-left"></i>
        Back to Blogs List
      </NuxtLink>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css'

const config = useRuntimeConfig()
const { token } = useAuth()
const router = useRouter()
const route = useRoute()

const id = route.params.id

const pending = ref(true)
const isSubmitting = ref(false)
const imageFile = ref(null)
const imagePreview = ref(null)
const existingImage = ref(null)
const editorMode = ref('visual')

const presetCategories = [
  'Innovation & Technology',
  'Color Trends & Design',
  'Company News & Events',
  'Tips & Guides',
  'Architectural Finishes'
]

const form = ref(null)

const getExistingImageUrl = (img) => {
  if (!img) return ''
  if (img.startsWith('http://') || img.startsWith('https://')) return img
  if (img.startsWith('/images/')) return img
  return `${config.public.apiBase}${img}`
}

onMounted(async () => {
  pending.value = true
  try {
    let blog = null

    // Attempt 1: Direct fetch by ID/slug from API
    try {
      const singleRes = await $fetch(`${config.public.apiBase}/api/blogs/${id}`, {
        headers: { Authorization: `Bearer ${token.value}` }
      })
      if (singleRes && (singleRes.id || singleRes.title)) {
        blog = singleRes
      }
    } catch (e) {
      console.warn('Direct blog fetch by ID failed, falling back to blog list query', e)
    }

    // Attempt 2: Fallback query all blogs if direct fetch didn't return
    if (!blog) {
      const blogsRes = await $fetch(`${config.public.apiBase}/api/blogs`, {
        headers: { Authorization: `Bearer ${token.value}` }
      })
      const list = Array.isArray(blogsRes) ? blogsRes : (blogsRes?.data || [])
      blog = list.find(b => String(b.id) === String(id) || String(b.slug) === String(id))
    }

    if (blog) {
      form.value = {
        title: blog.title || '',
        category: blog.category || 'Innovation & Technology',
        status: blog.status || 'draft',
        content: blog.content || ''
      }
      existingImage.value = blog.image
    }
  } catch (err) {
    console.error('Failed to load blog:', err)
  } finally {
    pending.value = false
  }
})

const handleImage = (e) => {
  if (e.target.files && e.target.files[0]) {
    imageFile.value = e.target.files[0]
    imagePreview.value = URL.createObjectURL(e.target.files[0])
  }
}

const submitForm = async () => {
  const contentStr = form.value?.content ? form.value.content.trim() : ''
  if (!contentStr || contentStr === '<p><br></p>' || contentStr === '<p></p>') {
    alert('Please enter blog content')
    return
  }
  
  isSubmitting.value = true
  
  try {
    const formData = new FormData()
    formData.append('title', form.value.title)
    formData.append('category', form.value.category || '')
    formData.append('status', form.value.status)
    formData.append('content', form.value.content)
    
    // Support Laravel PUT method spoofing via POST
    formData.append('_method', 'PUT')
    
    if (imageFile.value) {
      formData.append('image', imageFile.value)
    }

    await $fetch(`${config.public.apiBase}/api/blogs/${id}`, {
      method: 'POST', // using POST with _method=PUT for multipart/form-data
      headers: {
        Authorization: `Bearer ${token.value}`
      },
      body: formData
    })
    
    router.push('/blogs')
  } catch (err) {
    alert('Error updating blog post: ' + (err.data?.message || err.message))
    console.error(err)
  } finally {
    isSubmitting.value = false
  }
}
</script>

<style scoped>
.quill-wrapper :deep(.ql-toolbar.ql-snow) {
  border: none;
  border-bottom: 1px solid #e2e8f0;
  background-color: #f8fafc;
  padding: 10px 12px;
}
.quill-wrapper :deep(.ql-container.ql-snow) {
  border: none;
  font-size: 15px;
  line-height: 1.6;
}
.quill-wrapper :deep(.ql-editor) {
  min-height: 280px;
  padding: 16px;
}
.quill-wrapper :deep(.ql-editor.ql-blank::before) {
  color: #94a3b8;
  font-style: normal;
}
</style>
