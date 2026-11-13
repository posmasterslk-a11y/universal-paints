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
          <div class="space-y-2">
            <!-- Preview Box if image present -->
            <div v-if="form.image" class="relative w-32 h-20 rounded-lg border border-slate-200 overflow-hidden bg-slate-50 group">
              <img :src="getCoverImageUrl(form.image)" alt="Cover preview" class="w-full h-full object-cover" />
              <button 
                type="button" 
                @click="form.image = ''" 
                class="absolute top-1 right-1 bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center shadow hover:bg-red-700 text-xs cursor-pointer"
                title="Remove image"
              >
                <i class="fa-solid fa-xmark text-[10px]"></i>
              </button>
            </div>

            <!-- Upload + URL Input -->
            <div class="flex items-center gap-2">
              <label class="cursor-pointer bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold py-2 px-3 rounded-lg border border-slate-300 transition flex items-center gap-1.5 shrink-0">
                <i class="fa-solid fa-cloud-arrow-up text-red-600"></i>
                <span>{{ isUploadingImage ? 'Uploading...' : 'Upload Image' }}</span>
                <input type="file" accept="image/*" class="hidden" :disabled="isUploadingImage" @change="handleImageUpload" />
              </label>
              <input 
                type="text" 
                v-model="form.image" 
                placeholder="Or paste image URL" 
                class="flex-1 px-3 py-2 text-xs rounded-lg border border-slate-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none transition"
              >
            </div>
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
        <div v-show="editorMode === 'visual'" class="border border-slate-200 rounded-lg overflow-hidden bg-white quill-wrapper [&_.ql-toolbar]:!border-0 [&_.ql-toolbar]:!border-b [&_.ql-toolbar]:!border-slate-200 [&_.ql-toolbar]:!bg-slate-50 [&_.ql-container]:!border-0">
          <ClientOnly>
            <QuillEditor 
              ref="quillEditorRef"
              v-model:content="form.content" 
              contentType="html" 
              theme="snow" 
              placeholder="Write your article content here..."
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
            rows="12" 
            placeholder="<p>Enter HTML content here...</p>"
            class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition font-mono text-sm leading-relaxed text-slate-800"
          ></textarea>
        </div>
        <p class="text-xs text-slate-400 mt-1.5">
          Tip: You can format headings, lists, bold text, links, and blockquotes using the visual editor, or switch to HTML Code to paste formatted code directly.
        </p>
      </div>

      <!-- Actions -->
      <div class="flex justify-end gap-3 pt-6 border-t border-slate-100">
        <NuxtLink to="/blogs" class="px-6 py-2.5 rounded-lg font-medium text-slate-600 hover:bg-slate-100 transition">
          Cancel
        </NuxtLink>
        <button 
          type="submit" 
          :disabled="isSubmitting || isUploadingImage"
          class="bg-red-600 hover:bg-red-700 text-white px-7 py-2.5 rounded-lg font-semibold transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2 shadow-sm"
        >
          <i class="fa-solid fa-spinner fa-spin" v-if="isSubmitting"></i>
          {{ isSubmitting ? 'Updating...' : 'Update Blog Post' }}
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css'
import { compressImage } from '~/utils/imageCompressor'

const config = useRuntimeConfig()
const { token } = useAuth()
const route = useRoute()
const router = useRouter()

const id = route.params.id
const pending = ref(true)
const isSubmitting = ref(false)
const isUploadingImage = ref(false)
const editorMode = ref('visual')
const quillEditorRef = ref(null)

const presetCategories = [
  'Innovation & Technology',
  'Color Trends & Design',
  'Company News & Events',
  'Tips & Guides',
  'Architectural Finishes'
]

const form = ref({
  title: '',
  category: 'Innovation & Technology',
  status: 'draft',
  image: '',
  content: ''
})

const getCoverImageUrl = (img) => {
  if (!img) return ''
  if (img.startsWith('http://') || img.startsWith('https://')) return img
  if (img.startsWith('/images/')) return img
  return `${config.public.apiBase}${img}`
}

const handleImageUpload = async (e) => {
  const rawFile = e.target.files?.[0]
  if (!rawFile) return

  isUploadingImage.value = true
  try {
    const file = await compressImage(rawFile)
    const formData = new FormData()
    formData.append('image', file)
    formData.append('folder', 'blogs')

    const res = await $fetch(`${config.public.apiBase}/api/upload`, {
      method: 'POST',
      body: formData,
      headers: {
        Authorization: `Bearer ${token.value || (process.client ? localStorage.getItem('auth_token') : '')}`
      }
    })
    if (res && res.url) {
      form.value.image = res.url
    }
  } catch (err) {
    alert('Failed to upload image: ' + (err.data?.message || err.message))
    console.error('Image upload error:', err)
  } finally {
    isUploadingImage.value = false
    e.target.value = ''
  }
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
        image: blog.image || '',
        content: blog.content || ''
      }
    }
  } catch (err) {
    console.error('Failed to load blog:', err)
  } finally {
    pending.value = false
  }
})

const submitForm = async () => {
  // Synchronize content from visual editor or textarea
  let finalContent = form.value?.content || ''
  if (quillEditorRef.value && typeof quillEditorRef.value.getHTML === 'function') {
    const qHtml = quillEditorRef.value.getHTML()
    if (qHtml && qHtml !== '<p><br></p>') {
      finalContent = qHtml
      form.value.content = qHtml
    }
  }

  const plainText = finalContent ? finalContent.replace(/<[^>]*>/g, '').trim() : ''
  if (!plainText && (!finalContent || finalContent === '<p><br></p>' || finalContent === '<p></p>')) {
    alert('Please enter blog content before updating.')
    return
  }

  const authToken = token.value || (process.client ? localStorage.getItem('auth_token') : '')
  if (!authToken) {
    alert('Your session has expired. Please log in again to update.')
    router.push('/login')
    return
  }
  
  isSubmitting.value = true
  
  try {
    const formData = new FormData()
    formData.append('title', form.value.title ? form.value.title.trim() : '')
    formData.append('category', form.value.category ? form.value.category.trim() : '')
    formData.append('status', form.value.status)
    formData.append('content', finalContent)
    formData.append('image', form.value.image || '')
    
    // Support Laravel PUT method spoofing via POST
    formData.append('_method', 'PUT')

    await $fetch(`${config.public.apiBase}/api/blogs/${id}`, {
      method: 'POST', // using POST with _method=PUT for multipart/form-data
      headers: {
        Authorization: `Bearer ${authToken}`,
        Accept: 'application/json'
      },
      body: formData
    })
    
    router.push('/blogs')
  } catch (err) {
    const errorDetails = err.data?.errors
      ? Object.values(err.data.errors).flat().join('\n')
      : (err.data?.message || err.message || 'Unknown server error')
    alert('Error updating blog post:\n' + errorDetails)
    console.error('Error updating blog post:', err)
  } finally {
    isSubmitting.value = false
  }
}
</script>

<style scoped>
.quill-wrapper :deep(.ql-editor) {
  min-height: 280px;
  padding: 16px;
  font-size: 15px;
  line-height: 1.6;
}
.quill-wrapper :deep(.ql-editor.ql-blank::before) {
  color: #94a3b8;
  font-style: normal;
}
</style>
