<template>
  <div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
      <div>
        <h1 class="text-3xl font-extrabold text-slate-900">Blogs</h1>
        <p class="text-sm text-slate-500 mt-1">Manage articles, news, announcements, and categories</p>
      </div>
      <NuxtLink to="/blogs/create" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-lg font-semibold transition flex items-center gap-2 shadow-sm">
        <i class="fa-solid fa-plus"></i>
        New Blog Post
      </NuxtLink>
    </div>

    <!-- Error State -->
    <div v-if="error" class="bg-red-50 border border-red-200 text-red-600 p-4 rounded-lg flex items-center gap-3">
      <i class="fa-solid fa-circle-exclamation"></i>
      {{ error?.data?.message || error?.message || 'Error loading blogs' }}
    </div>

    <!-- Loading State -->
    <div v-if="pending" class="flex justify-center items-center py-20 bg-white rounded-xl border border-slate-200">
      <i class="fa-solid fa-spinner fa-spin text-4xl text-red-600"></i>
    </div>

    <!-- Table -->
    <div v-else class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-slate-50 border-b border-slate-200 text-xs uppercase text-slate-500 font-bold tracking-wider">
              <th class="p-4">Cover</th>
              <th class="p-4">Title &amp; Slug</th>
              <th class="p-4">Category</th>
              <th class="p-4">Status</th>
              <th class="p-4">Date</th>
              <th class="p-4 text-right">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            <tr v-for="blog in blogList" :key="blog.id" class="hover:bg-slate-50 transition">
              <td class="p-4">
                <div class="w-16 h-12 rounded-lg bg-slate-100 border border-slate-200 overflow-hidden shrink-0">
                  <img 
                    v-if="blog.image" 
                    :src="getBlogImage(blog.image)" 
                    :alt="blog.title" 
                    class="w-full h-full object-cover" 
                  />
                  <div v-else class="w-full h-full flex items-center justify-center text-slate-300">
                    <i class="fa-solid fa-image text-lg"></i>
                  </div>
                </div>
              </td>
              <td class="p-4 max-w-xs md:max-w-md">
                <div class="font-bold text-slate-900 line-clamp-1" :title="blog.title">{{ blog.title }}</div>
                <div class="text-xs text-slate-400 mt-0.5 truncate">/blog/{{ blog.slug }}</div>
              </td>
              <td class="p-4 whitespace-nowrap">
                <span v-if="blog.category" class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-100">
                  <i class="fa-solid fa-tag text-[10px] mr-1.5 opacity-70"></i>
                  {{ blog.category }}
                </span>
                <span v-else class="text-xs text-slate-400 italic">Uncategorized</span>
              </td>
              <td class="p-4 whitespace-nowrap">
                <span v-if="blog.status === 'published'" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                  <i class="fa-solid fa-check text-[10px]"></i> Published
                </span>
                <span v-else class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">
                  <i class="fa-solid fa-pen text-[10px]"></i> Draft
                </span>
              </td>
              <td class="p-4 whitespace-nowrap text-slate-600 text-xs">
                {{ formatBlogDate(blog.published_at || blog.created_at) }}
              </td>
              <td class="p-4 whitespace-nowrap text-right">
                <div class="flex items-center justify-end gap-2">
                  <NuxtLink :to="`/blogs/${blog.id}`" title="Edit Post" class="w-8 h-8 rounded bg-slate-100 text-slate-600 hover:bg-slate-200 hover:text-slate-900 flex items-center justify-center transition">
                    <i class="fa-solid fa-pen text-xs"></i>
                  </NuxtLink>
                  <button @click="deleteBlog(blog.id)" title="Delete Post" class="w-8 h-8 rounded bg-red-50 text-red-600 hover:bg-red-100 hover:text-red-700 flex items-center justify-center transition">
                    <i class="fa-solid fa-trash text-xs"></i>
                  </button>
                </div>
              </td>
            </tr>
            <tr v-if="!blogList?.length">
              <td colspan="6" class="p-12 text-center text-slate-500">
                <div class="max-w-sm mx-auto space-y-3">
                  <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto text-xl">
                    <i class="fa-solid fa-newspaper"></i>
                  </div>
                  <div class="font-medium text-slate-700">No blog posts found</div>
                  <p class="text-xs text-slate-400">Click "New Blog Post" to write and publish your first article.</p>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const config = useRuntimeConfig()
const { token } = useAuth()

const { data: blogs, pending, error, refresh } = await useFetch(`${config.public.apiBase}/api/blogs`, {
  headers: {
    Authorization: `Bearer ${token.value}`
  }
})

const blogList = computed(() => {
  if (Array.isArray(blogs.value)) return blogs.value
  if (Array.isArray(blogs.value?.data)) return blogs.value.data
  return []
})

const getBlogImage = (img) => {
  if (!img) return ''
  if (img.startsWith('http://') || img.startsWith('https://')) return img
  if (img.startsWith('/images/')) return img
  return `${config.public.apiBase}${img}`
}

const formatBlogDate = (dateStr) => {
  if (!dateStr) return '-'
  try {
    return new Date(dateStr).toLocaleDateString('en-US', {
      year: 'numeric',
      month: 'short',
      day: 'numeric'
    })
  } catch (e) {
    return dateStr
  }
}

const deleteBlog = async (id) => {
  if (!confirm('Are you sure you want to delete this blog post?')) return;
  
  try {
    await $fetch(`${config.public.apiBase}/api/blogs/${id}`, {
      method: 'DELETE',
      headers: {
        Authorization: `Bearer ${token.value}`
      }
    })
    refresh()
  } catch (err) {
    alert('Failed to delete blog post: ' + (err.data?.message || err.message))
  }
}
</script>
