<template>
  <div class="blog-page">
    <!-- Hero Section -->
    <section class="page-hero">
      <div class="page-hero-bg">
        <!-- We can use a default hero image for the blog -->
        <img src="/images/about-us-page/hero.webp" alt="Blog" class="hero-bg-img" />
        <div class="hero-overlay"></div>
      </div>
      <div class="container relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-4">Our <span class="text-gradient">Blog</span></h1>
        <p class="text-lg md:text-xl text-white/90 max-w-2xl mx-auto">
          Insights, tips, and the latest news from Universal Paints.
        </p>
      </div>
    </section>

    <div class="container py-16">
      <!-- Loading State -->
      <div v-if="pending" class="flex justify-center py-20">
        <div class="spinner"></div>
      </div>
      
      <!-- Error State -->
      <div v-else-if="error" class="text-center py-20 text-red-500">
        Failed to load blog posts.
      </div>

      <!-- Empty State -->
      <div v-else-if="!blogs?.length" class="text-center py-20 text-gray-500">
        No blog posts available at the moment.
      </div>

      <!-- Blog Grid -->
      <div v-else class="blog-grid">
        <NuxtLink 
          v-for="blog in blogs" 
          :key="blog.id" 
          :to="`/blog/${blog.slug}`"
          class="blog-card"
        >
          <div class="blog-card-img">
            <img :src="blog.image ? config.public.apiBase + blog.image : '/images/products/paint-bucket.webp'" :alt="blog.title" />
          </div>
          <div class="blog-card-content">
            <div class="blog-meta">
              <span>{{ new Date(blog.published_at || blog.created_at).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' }) }}</span>
            </div>
            <h2 class="blog-title">{{ blog.title }}</h2>
            <div class="blog-excerpt" v-html="getExcerpt(blog.content)"></div>
            <div class="blog-read-more">
              Read More <span class="arrow">→</span>
            </div>
          </div>
        </NuxtLink>
      </div>
    </div>
  </div>
</template>

<script setup>
const config = useRuntimeConfig()

const { data: blogs, pending, error } = await useFetch(`${config.public.apiBase}/api/blogs`)

const getExcerpt = (html) => {
  if (!html) return ''
  // Strip HTML tags and get first 150 chars
  const tmp = document.createElement('DIV')
  tmp.innerHTML = html
  const text = tmp.textContent || tmp.innerText || ''
  return text.length > 150 ? text.substring(0, 150) + '...' : text
}

useHead({
  title: 'Blog - Universal Paints',
  meta: [
    { name: 'description', content: 'Read the latest news, tips, and insights from Universal Paints.' }
  ]
})
</script>

<style scoped>
.page-hero {
  position: relative;
  padding: 180px 0 120px;
  background-color: #1a1a1a;
  overflow: hidden;
}
.page-hero-bg {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
.hero-bg-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
}
.hero-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(to right, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.4) 100%);
}
.text-gradient {
  background: linear-gradient(90deg, #E3000F 0%, #F59E0B 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.blog-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
  gap: 30px;
}

.blog-card {
  background: white;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 20px rgba(0,0,0,0.05);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  display: flex;
  flex-direction: column;
  text-decoration: none;
  color: inherit;
}
.blog-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.blog-card-img {
  height: 220px;
  overflow: hidden;
}
.blog-card-img img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
}
.blog-card:hover .blog-card-img img {
  transform: scale(1.05);
}

.blog-card-content {
  padding: 24px;
  flex: 1;
  display: flex;
  flex-direction: column;
}

.blog-meta {
  font-size: 13px;
  color: #666;
  margin-bottom: 12px;
  text-transform: uppercase;
  font-weight: 600;
  letter-spacing: 0.5px;
}

.blog-title {
  font-size: 20px;
  font-weight: 800;
  color: #1a1a1a;
  margin-bottom: 15px;
  line-height: 1.3;
}
.blog-card:hover .blog-title {
  color: #E3000F;
}

.blog-excerpt {
  font-size: 15px;
  color: #555;
  line-height: 1.6;
  margin-bottom: 20px;
  flex: 1;
}

.blog-read-more {
  font-weight: 700;
  color: #E3000F;
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 15px;
  margin-top: auto;
}
.blog-read-more .arrow {
  transition: transform 0.3s ease;
}
.blog-card:hover .blog-read-more .arrow {
  transform: translateX(5px);
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
