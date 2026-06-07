<template>
  <section class="py-24 bg-gray-50 relative border-y border-gray-100">
    <div class="container mx-auto px-4">
      
      <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-16 gap-6">
        <div>
          <span class="text-brand-accent1 font-bold tracking-widest uppercase text-sm mb-3 block">Our Catalog</span>
          <h2 class="text-4xl md:text-5xl font-bold text-brand-primary tracking-tight">Featured Products</h2>
        </div>
        <button class="text-brand-primary font-bold hover:text-brand-accent1 transition-colors flex items-center gap-2">
          View All Products <Icon name="lucide:arrow-right" size="18" />
        </button>
      </div>

      <!-- Products Grid / Mobile Slider -->
      <div class="flex overflow-x-auto md:grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 pb-8 -mx-4 px-4 md:pb-0 md:mx-0 md:px-0 snap-x snap-mandatory hide-scrollbar">
        <div v-for="product in products" :key="product.id" class="group bg-white w-[85vw] md:w-auto flex-none snap-center rounded-xl border border-gray-100 shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col overflow-hidden">
          
          <!-- Image Area (Full Bleed style) -->
          <div class="relative h-64 w-full bg-gray-50 p-4 flex items-center justify-center overflow-hidden">
            <!-- Featured Badge -->
            <div class="absolute top-4 left-4 z-10">
              <span class="bg-brand-accent1 text-white text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded">
                Featured
              </span>
            </div>
            
            <!-- Product Image -->
            <img :src="product.image" :alt="product.name" class="w-full h-full object-contain transform group-hover:scale-110 transition-transform duration-700 ease-out mix-blend-multiply" />
          </div>
          
          <!-- Product Details (Bottom area matching reference) -->
          <div class="p-6 flex-grow flex flex-col text-left">
            <!-- Category -->
            <p class="text-brand-accent1 text-xs font-bold uppercase tracking-wider mb-2">{{ product.category }}</p>
            
            <!-- Title -->
            <h3 class="text-lg font-bold text-gray-900 mb-3 leading-tight">{{ product.name }}</h3>
            
            <!-- Description -->
            <p class="text-sm text-gray-500 leading-relaxed line-clamp-3 mb-6 flex-grow">
              {{ product.description }}
            </p>
            
            <!-- Price and Button Row -->
            <div class="mt-auto flex justify-between items-end border-t border-gray-50 pt-4">
              <div>
                <p class="text-xs text-gray-400 mb-0.5">Starts from</p>
                <p class="font-bold text-gray-900">{{ product.price }}</p>
              </div>
              
              <!-- Circular Arrow Button -->
              <button class="w-8 h-8 rounded-full bg-brand-accent1 text-white flex items-center justify-center hover:bg-brand-primary transition-colors shadow-sm transform group-hover:scale-110 duration-300">
                <Icon name="lucide:chevron-right" size="18" />
              </button>
            </div>
          </div>
          
        </div>
      </div>
      
    </div>
  </section>
</template>

<style scoped>
/* Hide scrollbar for Chrome, Safari and Opera */
.hide-scrollbar::-webkit-scrollbar {
  display: none;
}
/* Hide scrollbar for IE, Edge and Firefox */
.hide-scrollbar {
  -ms-overflow-style: none;  /* IE and Edge */
  scrollbar-width: none;  /* Firefox */
}
</style>

<script setup>
import { ref, onMounted } from 'vue'

// Simulated backend data fetch
// Once you connect the backend, you can replace this with a useFetch or $fetch call to your API endpoint.
const products = ref([
  { 
    id: 1, 
    name: 'Superlux Weather Proof', 
    category: 'Exterior Paint', 
    price: 'Rs. 12,500', 
    size: '10L', 
    image: '/images/bucket_green.png',
    description: 'A premium exterior emulsion designed to protect your walls from harsh weather conditions while providing a rich, long-lasting finish.'
  },
  { 
    id: 2, 
    name: 'Appco Aqua Flex', 
    category: 'Waterproofing', 
    price: 'Rs. 14,200', 
    size: '4L', 
    image: '/images/bucket_blue.png',
    description: 'Advanced waterproofing technology that seals micro-cracks and prevents water seepage. Ideal for roofs and exterior walls.'
  },
  { 
    id: 3, 
    name: 'Superlux Interior Emulsion', 
    category: 'Interior Paint', 
    price: 'Rs. 8,200', 
    size: '4L', 
    image: '/images/bucket_red.png',
    description: 'Transform your living spaces with this ultra-smooth, washable interior emulsion. Features zero-VOC and beautiful matte aesthetics.'
  },
  { 
    id: 4, 
    name: 'Universal Heavy Duty Primer', 
    category: 'Primers', 
    price: 'Rs. 6,800', 
    size: '10L', 
    image: '/images/bucket_blue.png',
    description: 'The perfect foundation for any paint job. Ensures maximum adhesion, hides imperfections, and increases the topcoat lifespan.'
  }
])

// Example of how backend fetching would look:
/*
onMounted(async () => {
  try {
    const { data } = await useFetch('/api/products?limit=4')
    if(data.value) products.value = data.value
  } catch (err) {
    console.error("Failed to load products", err)
  }
})
*/
</script>
