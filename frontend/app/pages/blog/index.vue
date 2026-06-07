<template>
  <div class="bg-surface-light min-h-screen pt-32 md:pt-40 pb-24">
    <!-- Header -->
    <div class="container mx-auto px-4 max-w-7xl mb-16">
      <div class="text-center max-w-3xl mx-auto">
        <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6 tracking-tight">The Paint Blog</h1>
        <p class="text-lg text-gray-600 leading-relaxed">Discover the latest color trends, expert painting tutorials, and industry insights from the Universal Paints team.</p>
      </div>
    </div>

    <div class="container mx-auto px-4 max-w-7xl">
      <!-- Featured Article (First article in the array) -->
      <NuxtLink :to="`/blog/${articles[0].slug}`" class="block group mb-16">
        <div class="bg-white rounded-[2rem] overflow-hidden shadow-xl border border-gray-100 flex flex-col md:flex-row">
          <div class="md:w-3/5 relative overflow-hidden h-72 md:h-auto">
            <img :src="articles[0].image" :alt="articles[0].title" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
          </div>
          <div class="md:w-2/5 p-8 md:p-12 flex flex-col justify-center">
            <span class="inline-block px-3 py-1 bg-brand-primary/10 text-brand-primary text-xs font-bold uppercase tracking-widest rounded-full self-start mb-6">{{ articles[0].category }}</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 group-hover:text-brand-primary transition-colors">{{ articles[0].title }}</h2>
            <p class="text-gray-600 mb-8 leading-relaxed text-lg">{{ articles[0].excerpt }}</p>
            <div class="flex items-center gap-4 mt-auto">
              <div class="w-10 h-10 rounded-full bg-brand-primary/10 flex items-center justify-center text-brand-primary font-bold">
                {{ articles[0].author.charAt(0) }}
              </div>
              <div>
                <p class="text-sm font-bold text-gray-900">{{ articles[0].author }}</p>
                <p class="text-xs text-gray-500">{{ articles[0].date }} • {{ articles[0].readTime }}</p>
              </div>
            </div>
          </div>
        </div>
      </NuxtLink>

      <!-- Articles Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <NuxtLink v-for="article in articles.slice(1)" :key="article.id" :to="`/blog/${article.slug}`" class="bg-white rounded-[1.5rem] overflow-hidden shadow-lg border border-gray-100 group flex flex-col hover:-translate-y-2 transition-transform duration-500">
          <div class="relative h-60 overflow-hidden">
            <img :src="article.image" :alt="article.title" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            <div class="absolute top-4 left-4">
              <span class="px-3 py-1 bg-white/95 backdrop-blur-sm text-brand-primary text-xs font-bold uppercase tracking-widest rounded-full shadow-sm">{{ article.category }}</span>
            </div>
          </div>
          <div class="p-8 flex flex-col flex-grow">
            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-brand-primary transition-colors line-clamp-2 leading-tight">{{ article.title }}</h3>
            <p class="text-gray-600 text-sm mb-6 line-clamp-3 leading-relaxed">{{ article.excerpt }}</p>
            
            <div class="flex items-center justify-between mt-auto pt-6 border-t border-gray-100">
              <p class="text-xs font-medium text-gray-500">{{ article.date }}</p>
              <p class="text-xs font-bold text-brand-accent1 flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                Read More <Icon name="lucide:arrow-right" size="14" />
              </p>
            </div>
          </div>
        </NuxtLink>
      </div>
      
      <!-- Load More Button -->
      <div class="text-center mt-16">
        <button class="px-8 py-3 bg-white border-2 border-brand-primary text-brand-primary font-bold rounded-xl hover:bg-brand-primary hover:text-white transition-colors duration-300">
          Load More Articles
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { articles } from '~/utils/blogData'
</script>
