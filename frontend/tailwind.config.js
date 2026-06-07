/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './components/**/*.{js,vue,ts}',
    './layouts/**/*.vue',
    './pages/**/*.vue',
    './plugins/**/*.{js,ts}',
    './app.vue',
    './error.vue'
  ],
  theme: {
    extend: {
      colors: {
        brand: {
          primary: '#000232',
          accent1: '#FF8F00',
          accent2: '#1E88E5', // Blue
          support1: '#4CAF50', // Green
          support2: '#26C6DA', // Cyan
        },
        surface: {
          light: '#F8FAFC', // Light Gray
          white: '#FFFFFF',
        }
      },
      fontFamily: {
        sans: ['"Montserrat"', 'sans-serif'],
        heading: ['"Montserrat"', 'sans-serif'],
      }
    },
  },
  plugins: [],
}
