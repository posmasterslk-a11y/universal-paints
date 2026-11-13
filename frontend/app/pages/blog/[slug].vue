<template>
  <div class="blog-single-page">
    <!-- Loading State -->
    <div v-if="pending && !currentBlog" class="flex justify-center items-center min-h-screen py-32">
      <div class="spinner"></div>
    </div>
    
    <!-- Error State -->
    <div v-else-if="!currentBlog" class="flex flex-col items-center justify-center min-h-screen py-32 text-center px-4">
      <h1 class="text-4xl font-extrabold text-slate-900 mb-4">Blog Post Not Found</h1>
      <p class="text-lg text-slate-600 mb-8">The article you are looking for doesn't exist or has been removed.</p>
      <NuxtLink to="/blog" class="btn btn-primary">Back to Blog</NuxtLink>
    </div>

    <!-- Blog Content -->
    <article v-else>
      <!-- Hero Header -->
      <header class="blog-header">
        <div class="blog-header-bg">
          <img :src="getBlogImg(currentBlog)" :alt="currentBlog.title" class="header-bg-img" />
          <div class="header-overlay"></div>
        </div>
        <div class="container relative z-10 text-center">
          <div class="blog-meta-top text-white/80 mb-4 uppercase tracking-wider font-semibold text-sm flex items-center justify-center gap-3">
            <span v-if="getBlogCategory(currentBlog)" class="bg-[#E3000F] text-white px-3 py-1 rounded-full text-xs font-bold tracking-wide shadow-sm">
              {{ getBlogCategory(currentBlog) }}
            </span>
            <span>{{ new Date(currentBlog.published_at || currentBlog.created_at).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' }) }}</span>
          </div>
          <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white max-w-4xl mx-auto leading-tight">
            {{ currentBlog.title }}
          </h1>
        </div>
      </header>

      <!-- Main Content -->
      <div class="container py-16 lg:py-24 max-w-4xl">
        <div class="blog-content quill-content" v-html="currentBlog.content"></div>
        
        <div class="mt-16 pt-8 border-t border-slate-200 flex justify-between items-center">
          <NuxtLink to="/blog" class="font-bold text-slate-600 hover:text-[#E3000F] transition flex items-center gap-2">
            <span class="text-xl">←</span> Back to all articles
          </NuxtLink>
          
          <div class="share-buttons flex gap-4">
            <span class="font-semibold text-slate-500 mr-2">Share:</span>
            <a href="#" class="text-slate-400 hover:text-[#E3000F] transition"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#" class="text-slate-400 hover:text-[#E3000F] transition"><i class="fa-brands fa-twitter"></i></a>
            <a href="#" class="text-slate-400 hover:text-[#E3000F] transition"><i class="fa-brands fa-linkedin-in"></i></a>
          </div>
        </div>
      </div>
    </article>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const route = useRoute()
const config = useRuntimeConfig()

const { data: blog, pending, error } = await useFetch(`${config.public.apiBase}/api/blogs/${route.params.slug}`)

const currentBlog = computed(() => {
  if (blog.value && (blog.value.id || blog.value.title || blog.value.data?.id)) {
    return blog.value.data || blog.value
  }
  return null
})

const getBlogCategory = (b) => {
  if (b?.category) return b.category
  if (b?.title?.toLowerCase().includes('waterproof') || b?.title?.toLowerCase().includes('technolog')) {
    return 'Innovation & Technology'
  }
  if (b?.title?.toLowerCase().includes('color') || b?.title?.toLowerCase().includes('trend')) {
    return 'Color Trends & Design'
  }
  if (b?.title?.toLowerCase().includes('nationwide') || b?.title?.toLowerCase().includes('distribution')) {
    return 'Company News & Events'
  }
  return 'News & Events'
}

const getBlogImg = (b) => {
  if (!b?.image) return 'https://universalpaints.lk/images/about-us-page/hero.webp'
  if (b.image.startsWith('http://') || b.image.startsWith('https://')) return b.image
  if (b.image.startsWith('/images/')) return b.image
  return `${config.public.apiBase}${b.image}`
}

const blogTitle = computed(() => currentBlog.value?.title ? `${currentBlog.value.title} | Universal Paints Sri Lanka` : 'Universal Paints Blog')
const blogDesc = computed(() => {
  if (!currentBlog.value?.content) return 'Read insights, surface preparation tips, and painting advice from Universal Paints Sri Lanka.'
  return currentBlog.value.content.replace(/<[^>]*>/g, '').replace(/\s+/g, ' ').trim().substring(0, 160)
})
const blogImg = computed(() => getBlogImg(currentBlog.value))
const blogUrl = computed(() => `https://universalpaints.lk/blog/${route.params.slug}`)

useSeoMeta({
  title: () => currentBlog.value?.title || 'Blog Post',
  ogTitle: blogTitle,
  description: blogDesc,
  ogDescription: blogDesc,
  ogImage: blogImg,
  ogUrl: blogUrl,
  ogType: 'article',
  twitterCard: 'summary_large_image',
  twitterTitle: blogTitle,
  twitterDescription: blogDesc,
  twitterImage: blogImg
})

useHead({
  link: [
    { rel: 'canonical', href: blogUrl }
  ],
  script: [
    {
      type: 'application/ld+json',
      children: computed(() => JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'BlogPosting',
        headline: currentBlog.value?.title || 'Universal Paints Blog Post',
        image: [blogImg.value],
        description: blogDesc.value,
        datePublished: currentBlog.value?.published_at || currentBlog.value?.created_at || new Date().toISOString(),
        author: {
          '@type': 'Organization',
          name: 'Universal Paints (Pvt) Ltd'
        },
        publisher: {
          '@type': 'Organization',
          name: 'Universal Paints (Pvt) Ltd',
          logo: {
            '@type': 'ImageObject',
            url: 'https://universalpaints.lk/logo.png'
          }
        },
        mainEntityOfPage: {
          '@type': 'WebPage',
          '@id': blogUrl.value
        }
      }))
    }
  ]
})
</script>

<style scoped>
.blog-header {
  position: relative;
  padding: 200px 0 120px;
  background-color: #1a1a1a;
  overflow: hidden;
}
.blog-header-bg {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
.header-bg-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
}
.header-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(to bottom, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.85) 100%);
}

/* Quill Content Styling overrides */
.blog-content {
  font-size: 1.125rem;
  line-height: 1.8;
  color: #334155;
}

.blog-content :deep(h2) {
  font-size: 2rem;
  font-weight: 800;
  color: #0f172a;
  margin-top: 2.5rem;
  margin-bottom: 1.25rem;
}

.blog-content :deep(h3) {
  font-size: 1.5rem;
  font-weight: 700;
  color: #0f172a;
  margin-top: 2rem;
  margin-bottom: 1rem;
}

.blog-content :deep(p) {
  margin-bottom: 1.5rem;
}

.blog-content :deep(ul) {
  list-style-type: disc;
  padding-left: 1.5rem;
  margin-bottom: 1.5rem;
}

.blog-content :deep(ol) {
  list-style-type: decimal;
  padding-left: 1.5rem;
  margin-bottom: 1.5rem;
}

.blog-content :deep(li) {
  margin-bottom: 0.5rem;
}

.blog-content :deep(a) {
  color: #E3000F;
  text-decoration: underline;
}

.blog-content :deep(blockquote) {
  border-left: 4px solid #E3000F;
  padding-left: 1.5rem;
  margin-left: 0;
  font-style: italic;
  color: #64748b;
  margin-bottom: 1.5rem;
}

.blog-content :deep(img) {
  max-width: 100%;
  height: auto;
  border-radius: 0.75rem;
  margin: 2rem 0;
}

.btn-primary {
  display: inline-flex;
  padding: 12px 24px;
  background-color: #E3000F;
  color: white;
  border-radius: 8px;
  font-weight: 700;
  text-decoration: none;
  transition: background-color 0.3s;
}
.btn-primary:hover {
  background-color: #c0000c;
}

.spinner {
  width: 40px;
  height: 40px;
  border-width: 4px;
  border-style: solid;
  border-color: rgba(0,0,0,0.1);
  border-left-color: #E3000F;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}
@keyframes spin {
  to { transform: rotate(360deg); }
}
</style>
