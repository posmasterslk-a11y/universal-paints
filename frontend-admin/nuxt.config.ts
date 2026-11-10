// Admin Panel Nuxt Configuration - Universal Paints
import tailwindcss from "@tailwindcss/vite";

const now = new Date();
const buildTime = now.toISOString().replace(/[-:T]/g, '').slice(0, 12);
const buildNumber = process.env.GITHUB_RUN_NUMBER || buildTime;
const appVersion = `1.0.${buildNumber}`;

export default defineNuxtConfig({
  ssr: false,
  compatibilityDate: '2024-04-03',
  devtools: { enabled: true },
  css: ['~/assets/css/main.css'],
  vite: {
    plugins: [
      tailwindcss(),
    ],
  },
  app: {
    baseURL: '/admin/',
    head: {
      title: 'Admin - Universal Paints',
      link: [
        { rel: 'stylesheet', href: 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css' },
        { rel: 'stylesheet', href: 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap' }
      ]
    }
  },
  runtimeConfig: {
    public: {
      apiBase: process.env.NUXT_PUBLIC_API_BASE || 'https://api.universalpaints.lk',
      appVersion: process.env.APP_VERSION || appVersion,
      buildNumber: buildNumber,
      buildTime: now.toLocaleString('en-US', { timeZone: 'Asia/Colombo', dateStyle: 'short', timeStyle: 'short' })
    }
  }
})
