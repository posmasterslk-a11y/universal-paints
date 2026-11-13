<template>
  <div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
      <NuxtLink to="/blogs" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-slate-200 transition">
        <i class="fa-solid fa-arrow-left"></i>
      </NuxtLink>
      <div>
        <h1 class="text-3xl font-extrabold text-slate-900">Create Blog Post</h1>
        <p class="text-sm text-slate-500 mt-0.5">Publish articles, updates, and news for Universal Paints</p>
      </div>
    </div>

    <form @submit.prevent="submitForm" class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 space-y-6">
      
      <!-- Title -->
      <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">Title *</label>
        <input 
          v-model="form.title" 
          type="text" 
          required 
          class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition text-slate-900 font-medium"
          placeholder="e.g. Universal Paints Launches Advanced Waterproofing..."
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
              list="blog-category-presets" 
              type="text"
              placeholder="Select or type category..."
              class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition bg-white"
            />
            <datalist id="blog-category-presets">
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
            {{ form.status === 'published' ? 'Will be published immediately on universalpaints.lk' : 'Saved as draft in admin only' }}
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
          <div v-if="imagePreview" class="mt-2 relative w-20 h-14 rounded-md overflow-hidden border border-slate-200">
            <img :src="imagePreview" alt="Preview" class="w-full h-full object-cover" />
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
          :disabled="isSubmitting"
          class="bg-red-600 hover:bg-red-700 text-white px-7 py-2.5 rounded-lg font-semibold transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2 shadow-sm"
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
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css'

const config = useRuntimeConfig()
const { token } = useAuth()
const router = useRouter()

const isSubmitting = ref(false)
const imageFile = ref(null)
const imagePreview = ref(null)
const editorMode = ref('visual')

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
  content: ''
})

const handleImage = (e) => {
  if (e.target.files && e.target.files[0]) {
    imageFile.value = e.target.files[0]
    imagePreview.value = URL.createObjectURL(e.target.files[0])
  }
}

const submitForm = async () => {
  const contentStr = form.value.content ? form.value.content.trim() : ''
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
    alert('Error saving blog post: ' + (err.data?.message || err.message))
    console.error(err)
  } finally {
    isSubmitting.value = false
  }
}
</script>

<style scoped>
.quill-wrapper :deep(.ql-toolbar.ql-snow) {
  border-width: 0 0 1px 0;
  border-style: solid;
  border-color: #e2e8f0;
  background-color: #f8fafc;
  padding: 10px 12px;
}
.quill-wrapper :deep(.ql-container.ql-snow) {
  border-width: 0;
  font-size: 15px;
  line-height: 1.6;
}
.quill-wrapper :deep(.ql-editor) {
  min-height: 260px;
  padding: 16px;
}
.quill-wrapper :deep(.ql-editor.ql-blank::before) {
  color: #94a3b8;
  font-style: normal;
}
</style>
