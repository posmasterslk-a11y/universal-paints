// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2025-07-15',
  devtools: { enabled: true },

  modules: [
    '@nuxtjs/tailwindcss',
    '@nuxt/image',
    '@nuxt/icon'
  ],

  css: ['~/assets/css/main.css'],

  app: {
    head: {
      title: 'Universal Paints | Color Your World with Confidence',
      titleTemplate: '%s - Universal Paints',
      meta: [
        { charset: 'utf-8' },
        { name: 'viewport', content: 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0' },
        { hid: 'description', name: 'description', content: 'Premium paint solutions designed to protect, beautify, and transform every space. The best paints in Sri Lanka.' },
        { name: 'theme-color', content: '#02033F' }
      ],
      link: [
        { rel: 'icon', type: 'image/png', href: '/logo.png' },
        { rel: 'preconnect', href: 'https://fonts.googleapis.com' },
        { rel: 'preconnect', href: 'https://fonts.gstatic.com', crossorigin: '' },
        { rel: 'stylesheet', href: 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap' }
      ]
    }
  },

  tailwindcss: {
    cssPath: '~/assets/css/main.css',
    configPath: 'tailwind.config.js',
    exposeConfig: false,
    viewer: true,
  },

  image: {
    format: ['webp', 'avif'],
    quality: 80,
  }
})
