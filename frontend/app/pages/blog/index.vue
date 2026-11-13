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
      <div v-if="pending && !displayBlogs?.length" class="flex justify-center py-20">
        <div class="spinner"></div>
      </div>

      <!-- Blog Grid -->
      <div v-else class="blog-grid">
        <NuxtLink 
          v-for="blog in displayBlogs" 
          :key="blog.id || blog.slug" 
          :to="`/blog/${blog.slug}`"
          class="blog-card"
        >
          <div class="blog-card-img">
            <img :src="getBlogImg(blog)" :alt="blog.title" loading="lazy" decoding="async" />
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

const defaultBlogs = [
  {
    id: 1,
    title: 'Universal Paints Launches Advanced Hybrid Aquamax Waterproofing Technology',
    slug: 'universal-paints-launches-advanced-hybrid-aquamax-waterproofing-technology',
    content: '<p>Universal Paints is proud to unveil its latest breakthrough in architectural protection: <strong>Hybrid Aquamax Waterproofing Paint</strong>. Formulated using advanced water-based polymer cross-linking technology, Hybrid Aquamax offers an all-in-one protective barrier engineered specifically for Sri Lanka’s demanding tropical weather conditions.</p>',
    image: '/images/about-us-page/lab-test.webp',
    published_at: '2026-11-01',
    created_at: '2026-11-01'
  },
  {
    id: 2,
    title: 'Color Trends & Architectural Finishes: Elevating Modern Sri Lankan Spaces',
    slug: 'color-trends-and-architectural-finishes-elevating-modern-sri-lankan-spaces',
    content: '<p>Modern architecture in Sri Lanka is undergoing an exciting renaissance—blending open-concept tropical minimalism with warm earthy undertones and vibrant accents. Universal Paints has curated an inspiring guide on how to choose colors and finishes that enhance natural daylight while standing up to high humidity and intense UV exposure.</p>',
    image: '/images/about-us-page/production-line.webp',
    published_at: '2026-10-25',
    created_at: '2026-10-25'
  },
  {
    id: 3,
    title: 'Expanding Nationwide: Universal Paints Deepens Distribution Across 25 Districts',
    slug: 'expanding-nationwide-universal-paints-deepens-distribution-across-25-districts',
    content: '<p>In line with our commitment to accessible quality and dependable service, Universal Paints has announced the significant expansion of our islandwide logistics fleet and dedicated district sales network across all 25 administrative districts in Sri Lanka.</p>',
    image: '/images/about-us-page/truck.webp',
    published_at: '2026-10-18',
    created_at: '2026-10-18'
  }
]

const displayBlogs = computed(() => {
  const list = Array.isArray(blogs.value) ? blogs.value : (blogs.value?.data || [])
  if (list && list.length > 0) return list
  return defaultBlogs
})

const getBlogImg = (b) => {
  if (!b?.image) return '/images/about-us-page/hero.webp'
  if (b.image.startsWith('http://') || b.image.startsWith('https://')) return b.image
  if (b.image.startsWith('/images/')) return b.image
  return `${config.public.apiBase}${b.image}`
}

const getExcerpt = (html) => {
  if (!html) return ''
  const text = html.replace(/<[^>]*>/g, '').replace(/\s+/g, ' ').trim()
  return text.length > 150 ? text.substring(0, 150) + '...' : text
}

useSeoMeta({
  title: 'Painting Guides, Color Ideas & Industry News',
  ogTitle: 'Universal Paints Blog | Painting Guides & Color Ideas Sri Lanka',
  description: 'Expert home painting advice, architectural coating guides, waterproofing tips, and color trend inspirations from Universal Paints Sri Lanka.',
  ogDescription: 'Expert home painting advice, architectural coating guides, waterproofing tips, and color trend inspirations from Universal Paints Sri Lanka.',
  ogImage: 'https://universalpaints.lk/images/about-us-page/hero.webp',
  ogUrl: 'https://universalpaints.lk/blog',
  ogType: 'website',
  twitterCard: 'summary_large_image',
  twitterTitle: 'Universal Paints Blog',
  twitterDescription: 'Painting guides, color tips, and surface protection advice.',
  twitterImage: 'https://universalpaints.lk/images/about-us-page/hero.webp'
})

useHead({
  link: [
    { rel: 'canonical', href: 'https://universalpaints.lk/blog' }
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
