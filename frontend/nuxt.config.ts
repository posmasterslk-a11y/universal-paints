export default defineNuxtConfig({
  runtimeConfig: {
    public: {
      siteUrl: process.env.NUXT_PUBLIC_SITE_URL || 'https://universalpaints.lk',
      apiBase: (process.env.NUXT_PUBLIC_API_BASE || 'https://api.universalpaints.lk').replace(/\/api\/?$/, '')
    }
  },
  compatibilityDate: '2024-04-03',
  future: { compatibilityVersion: 4 },
  devtools: { enabled: true },
  css: ['~/assets/css/main.css'],
  app: {
    head: {
      htmlAttrs: {
        lang: 'en'
      },
      title: 'Universal Paints | Premium Quality Paints & Coatings Sri Lanka',
      titleTemplate: '%s | Universal Paints Sri Lanka',
      meta: [
        { charset: 'utf-8' },
        { name: 'viewport', content: 'width=device-width, initial-scale=1, maximum-scale=5' },
        { name: 'format-detection', content: 'telephone=no' },
        { name: 'theme-color', content: '#E3000F' },
        {
          name: 'description',
          content: 'Universal Paints is a leading manufacturer and distributor of premium architectural, decorative, industrial, and waterproofing paints trusted by professionals and homeowners across Sri Lanka.'
        },
        {
          name: 'keywords',
          content: 'universal paints, universal paints sri lanka, paint sri lanka, exterior paints, interior emulsion, waterproofing paint, wall filler, wood finishes, weather guard paint, protective coatings, paint manufacturers colombo sri lanka'
        },
        { name: 'author', content: 'Universal Paints' },
        { name: 'robots', content: 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' },
        // Open Graph
        { property: 'og:site_name', content: 'Universal Paints Sri Lanka' },
        { property: 'og:type', content: 'website' },
        { property: 'og:locale', content: 'en_US' },
        { property: 'og:url', content: 'https://universalpaints.lk/' },
        { property: 'og:title', content: 'Universal Paints | Premium Quality Paints & Coatings' },
        {
          property: 'og:description',
          content: 'Explore high-performance architectural, decorative, and waterproofing paints for every surface. Over 20 years of excellence across Sri Lanka.'
        },
        { property: 'og:image', content: 'https://universalpaints.lk/images/logo/Logo.webp' },
        { property: 'og:image:alt', content: 'Universal Paints Sri Lanka' },
        // Twitter Card
        { name: 'twitter:card', content: 'summary_large_image' },
        { name: 'twitter:title', content: 'Universal Paints | Premium Quality Paints & Coatings' },
        {
          name: 'twitter:description',
          content: 'Leading manufacturer and distributor of architectural, decorative, and waterproofing paints in Sri Lanka.'
        },
        { name: 'twitter:image', content: 'https://universalpaints.lk/images/logo/Logo.webp' }
      ],
      link: [
        { rel: 'canonical', href: 'https://universalpaints.lk/' },
        { rel: 'icon', type: 'image/webp', href: '/images/logo/Logo.webp' },
        { rel: 'apple-touch-icon', href: '/images/logo/Logo.webp' },
        { rel: 'stylesheet', href: 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css' },
        { rel: 'stylesheet', href: 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap' }
      ],
      script: [
        {
          type: 'application/ld+json',
          children: JSON.stringify({
            '@context': 'https://schema.org',
            '@graph': [
              {
                '@type': 'Organization',
                '@id': 'https://universalpaints.lk/#organization',
                'name': 'Universal Paints',
                'url': 'https://universalpaints.lk',
                'logo': {
                  '@type': 'ImageObject',
                  'url': 'https://universalpaints.lk/images/logo/Logo.webp',
                  'caption': 'Universal Paints Logo'
                },
                'description': 'Premier manufacturer and distributor of high-performance architectural, decorative, and industrial coatings in Sri Lanka.',
                'telephone': '+94 11 234 5678',
                'email': 'info@universalpaints.lk',
                'address': {
                  '@type': 'PostalAddress',
                  'addressCountry': 'LK',
                  'addressLocality': 'Colombo'
                },
                'sameAs': [
                  'https://www.facebook.com/universalpaints',
                  'https://www.instagram.com/universalpaints'
                ]
              },
              {
                '@type': 'WebSite',
                '@id': 'https://universalpaints.lk/#website',
                'url': 'https://universalpaints.lk',
                'name': 'Universal Paints',
                'publisher': {
                  '@id': 'https://universalpaints.lk/#organization'
                },
                'potentialAction': {
                  '@type': 'SearchAction',
                  'target': 'https://universalpaints.lk/shop?search={search_term_string}',
                  'query-input': 'required name=search_term_string'
                }
              }
            ]
          })
        }
      ]
    }
  }
})
