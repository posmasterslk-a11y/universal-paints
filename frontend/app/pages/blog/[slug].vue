<template>
  <div class="bg-surface-light min-h-screen pt-32 md:pt-40 pb-24">
    
    <!-- Loading / Not Found state could go here, but since it's static we assume it exists -->
    <div v-if="article" class="container mx-auto px-4 max-w-4xl">
      
      <!-- Back to Blog Link -->
      <NuxtLink to="/blog" class="inline-flex items-center gap-2 text-brand-primary font-bold hover:text-brand-accent1 transition-colors mb-8 group">
        <Icon name="lucide:arrow-left" size="18" class="group-hover:-translate-x-1 transition-transform" /> Back to all articles
      </NuxtLink>

      <!-- Article Header -->
      <header class="mb-12">
        <span class="inline-block px-4 py-1.5 bg-brand-primary/10 text-brand-primary text-xs font-bold uppercase tracking-widest rounded-full mb-6">{{ article.category }}</span>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6 tracking-tight leading-tight">{{ article.title }}</h1>
        
        <div class="flex flex-wrap items-center gap-6 text-gray-600 border-b border-gray-200 pb-8">
          <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-full bg-brand-primary/10 flex items-center justify-center text-brand-primary font-bold text-lg">
              {{ article.author.charAt(0) }}
            </div>
            <div>
              <p class="font-bold text-gray-900">{{ article.author }}</p>
              <p class="text-sm">Author</p>
            </div>
          </div>
          <div class="w-px h-10 bg-gray-200 hidden md:block"></div>
          <div>
            <p class="text-sm font-bold text-gray-900">Published</p>
            <p class="text-sm">{{ article.date }}</p>
          </div>
          <div class="w-px h-10 bg-gray-200 hidden md:block"></div>
          <div>
            <p class="text-sm font-bold text-gray-900">Read Time</p>
            <p class="text-sm">{{ article.readTime }}</p>
          </div>
        </div>
      </header>

      <!-- Featured Image -->
      <div class="rounded-[2rem] overflow-hidden shadow-xl mb-16 aspect-[16/9] relative">
        <img :src="article.image" :alt="article.title" class="w-full h-full object-cover">
      </div>

      <!-- Article Content -->
      <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8 md:p-16">
        <!-- Render the rich HTML content dynamically -->
        <div class="prose prose-lg max-w-none article-content" v-html="article.content"></div>
      </div>
      
      <!-- CTA Footer -->
      <div class="mt-16 bg-brand-primary rounded-[2rem] p-10 md:p-16 text-center text-white relative overflow-hidden shadow-xl">
        <div class="absolute -bottom-24 -right-24 w-64 h-64 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
        <h3 class="text-3xl font-bold mb-4 relative z-10">Inspired to start your next project?</h3>
        <p class="text-white/80 mb-8 max-w-xl mx-auto relative z-10">Browse our full range of premium paints and find the perfect color for your space today.</p>
        <div class="flex justify-center gap-4 relative z-10">
          <NuxtLink to="/products" class="bg-brand-accent1 text-brand-primary font-bold px-8 py-3 rounded-xl hover:bg-white transition-colors shadow-lg">View Products</NuxtLink>
        </div>
      </div>

    </div>

    <!-- Error State -->
    <div v-else class="container mx-auto px-4 max-w-4xl text-center py-20">
      <h1 class="text-4xl font-bold text-gray-900 mb-4">Article Not Found</h1>
      <p class="text-gray-600 mb-8">The article you are looking for does not exist or has been removed.</p>
      <NuxtLink to="/blog" class="bg-brand-primary text-white font-bold px-8 py-3 rounded-xl hover:bg-brand-accent1 transition-colors">Return to Blog</NuxtLink>
    </div>
  </div>
</template>

<script setup>
import { useRoute } from 'vue-router'
import { articles } from '~/utils/blogData'

const route = useRoute()
const slug = route.params.slug

// Find the specific article matching the slug from the URL
const article = articles.find(a => a.slug === slug)

// Update page head for SEO
if (article) {
  useHead({
    title: `${article.title} | Universal Paints Blog`,
    meta: [
      { name: 'description', content: article.excerpt }
    ]
  })
}
</script>

<style>
/* Scoped styles for the v-html injected content */
.article-content p {
  margin-bottom: 1.5rem;
}
.article-content h3 {
  font-size: 1.5rem;
  font-weight: 700;
  color: #111827; /* gray-900 */
  margin-top: 2.5rem;
  margin-bottom: 1rem;
}
.article-content ul {
  list-style-type: disc;
  padding-left: 1.5rem;
  margin-bottom: 1.5rem;
}
.article-content li {
  margin-bottom: 0.5rem;
}
</style>
