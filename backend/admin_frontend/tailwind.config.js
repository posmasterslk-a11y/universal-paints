/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./components/**/*.{js,vue,ts}",
    "./layouts/**/*.vue",
    "./pages/**/*.vue",
    "./plugins/**/*.{js,ts}",
    "./app.vue",
    "./error.vue"
  ],
  theme: {
    extend: {
      colors: {
        brand: {
          navy: '#051024',
          blue: '#001f3f',
          red: '#EF4444',
          light: '#F8FAFC',
          gray: '#E2E8F0'
        }
      }
    },
  },
  plugins: [],
}
