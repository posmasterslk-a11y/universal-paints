<template>
  <div class="space-y-6">
    <div class="flex justify-between items-center">
      <h1 class="text-3xl font-extrabold text-slate-900">Blogs</h1>
      <NuxtLink to="/blogs/create" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-lg font-medium transition flex items-center gap-2">
        <i class="fa-solid fa-plus"></i>
        New Blog Post
      </NuxtLink>
    </div>

    <!-- Error State -->
    <div v-if="error" class="bg-red-50 border border-red-200 text-red-600 p-4 rounded-lg flex items-center gap-3">
      <i class="fa-solid fa-circle-exclamation"></i>
      {{ error }}
    </div>

    <!-- Loading State -->
    <div v-if="pending" class="flex justify-center items-center py-20">
      <i class="fa-solid fa-spinner fa-spin text-4xl text-slate-300"></i>
    </div>

    <!-- Table -->
    <div v-else class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
      <table class="w-full text-left border-collapse">
        <thead>
          <tr class="bg-slate-50 border-b border-slate-200 text-sm uppercase text-slate-500 font-semibold">
            <th class="p-4">Image</th>
            <th class="p-4">Title</th>
            <th class="p-4">Status</th>
            <th class="p-4">Date</th>
            <th class="p-4 text-right">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="blog in blogs" :key="blog.id" class="border-b border-slate-100 hover:bg-slate-50 transition">
            <td class="p-4">
              <div class="w-16 h-16 rounded-lg bg-slate-100 border border-slate-200 overflow-hidden">
                <img v-if="blog.image" :src="config.public.apiBase + blog.image" alt="Blog cover" class="w-full h-full object-cover" />
                <div v-else class="w-full h-full flex items-center justify-center text-slate-300">
                  <i class="fa-solid fa-image"></i>
                </div>
              </div>
            </td>
            <td class="p-4">
              <div class="font-bold text-slate-800">{{ blog.title }}</div>
              <div class="text-sm text-slate-500 mt-1">/blog/{{ blog.slug }}</div>
            </td>
            <td class="p-4">
              <span v-if="blog.status === 'published'" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                <i class="fa-solid fa-check"></i> Published
              </span>
              <span v-else class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">
                <i class="fa-solid fa-pen"></i> Draft
              </span>
            </td>
            <td class="p-4 text-slate-600 text-sm">
              {{ new Date(blog.created_at).toLocaleDateString() }}
            </td>
            <td class="p-4 text-right">
              <div class="flex items-center justify-end gap-2">
                <NuxtLink :to="`/blogs/${blog.id}`" class="w-8 h-8 rounded bg-slate-100 text-slate-600 hover:bg-slate-200 hover:text-slate-900 flex items-center justify-center transition">
                  <i class="fa-solid fa-pen"></i>
                </NuxtLink>
                <button @click="deleteBlog(blog.id)" class="w-8 h-8 rounded bg-red-50 text-red-600 hover:bg-red-100 hover:text-red-700 flex items-center justify-center transition">
                  <i class="fa-solid fa-trash"></i>
                </button>
              </div>
            </td>
          </tr>
          <tr v-if="!blogs?.length">
            <td colspan="5" class="p-8 text-center text-slate-500">
              No blog posts found.
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
const config = useRuntimeConfig()
const { token } = useAuth()
const { data: blogs, pending, error, refresh } = await useFetch(`${config.public.apiBase}/api/blogs`, {
  headers: {
    Authorization: `Bearer ${token.value}`
  }
})

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
    alert('Failed to delete blog post.')
  }
}
</script>
