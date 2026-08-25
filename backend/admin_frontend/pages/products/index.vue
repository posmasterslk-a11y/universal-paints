<template>
  <div>
    <div class="flex justify-between items-center mb-8">
      <div>
        <h2 class="text-2xl font-bold text-gray-800">Products</h2>
        <p class="text-gray-500 text-sm mt-1">Manage your product inventory, pricing, and stock.</p>
      </div>
      <button class="bg-brand-red hover:bg-red-600 text-white px-4 py-2 rounded-lg font-medium shadow-sm transition-colors flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
        Add Product
      </button>
    </div>

    <!-- Filters & Search -->
    <div class="bg-white p-4 rounded-t-xl border border-gray-200 border-b-0 flex flex-wrap gap-4 items-center justify-between">
      <div class="flex gap-4 items-center">
        <div class="relative">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
          <input type="text" placeholder="Search products..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-brand-red w-64" />
        </div>
        <select class="border border-gray-300 rounded-lg px-4 py-2 text-sm text-gray-700 bg-white focus:outline-none focus:ring-1 focus:ring-brand-red">
          <option>All Categories</option>
          <option>Exterior Paints</option>
          <option>Interior Paints</option>
          <option>Wood Finishes</option>
        </select>
      </div>
      <div class="flex gap-2">
        <button class="p-2 text-gray-500 hover:text-brand-red border border-gray-200 rounded-lg"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" /></svg></button>
        <button class="p-2 text-brand-red bg-red-50 border border-red-100 rounded-lg"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg></button>
      </div>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 bg-gray-50 p-6 border border-gray-200 rounded-b-xl border-t-0">
      
      <!-- Product Card 1 -->
      <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden group hover:shadow-md transition-all">
        <div class="h-40 bg-gray-100 relative flex items-center justify-center p-4">
          <div class="absolute top-3 right-3 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
            <button class="p-1.5 bg-white text-gray-600 rounded-md shadow-sm hover:text-brand-blue"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></button>
            <button class="p-1.5 bg-white text-red-500 rounded-md shadow-sm hover:text-red-700"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
          </div>
          <span class="text-6xl">🪣</span>
        </div>
        <div class="p-4">
          <div class="flex justify-between items-start mb-2">
            <h3 class="font-bold text-gray-900 text-sm">Premium Exterior Emulsion</h3>
            <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-bold rounded">In Stock</span>
          </div>
          <p class="text-xs text-gray-500 mb-4">Category: Exterior</p>
          <div class="flex justify-between items-center border-t border-gray-100 pt-3">
            <span class="font-bold text-brand-navy">Rs. 9,500</span>
            <span class="text-xs text-gray-500">20L</span>
          </div>
        </div>
      </div>

      <!-- Product Card 2 -->
      <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden group hover:shadow-md transition-all">
        <div class="h-40 bg-gray-100 relative flex items-center justify-center p-4">
          <div class="absolute top-3 right-3 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
            <button class="p-1.5 bg-white text-gray-600 rounded-md shadow-sm hover:text-brand-blue"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></button>
            <button class="p-1.5 bg-white text-red-500 rounded-md shadow-sm hover:text-red-700"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
          </div>
          <span class="text-6xl">🪣</span>
        </div>
        <div class="p-4">
          <div class="flex justify-between items-start mb-2">
            <h3 class="font-bold text-gray-900 text-sm">Elite Interior Emulsion</h3>
            <span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs font-bold rounded">Low Stock</span>
          </div>
          <p class="text-xs text-gray-500 mb-4">Category: Interior</p>
          <div class="flex justify-between items-center border-t border-gray-100 pt-3">
            <span class="font-bold text-brand-navy">Rs. 2,100</span>
            <span class="text-xs text-gray-500">4L</span>
          </div>
        </div>
      </div>

      <!-- Product Card 3 -->
      <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden group hover:shadow-md transition-all">
        <div class="h-40 bg-gray-100 relative flex items-center justify-center p-4">
          <div class="absolute top-3 right-3 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
            <button class="p-1.5 bg-white text-gray-600 rounded-md shadow-sm hover:text-brand-blue"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></button>
            <button class="p-1.5 bg-white text-red-500 rounded-md shadow-sm hover:text-red-700"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
          </div>
          <span class="text-6xl">🪣</span>
        </div>
        <div class="p-4">
          <div class="flex justify-between items-start mb-2">
            <h3 class="font-bold text-gray-900 text-sm">Wood Finish Varnish</h3>
            <span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-bold rounded">Out of Stock</span>
          </div>
          <p class="text-xs text-gray-500 mb-4">Category: Wood</p>
          <div class="flex justify-between items-center border-t border-gray-100 pt-3">
            <span class="font-bold text-brand-navy">Rs. 1,800</span>
            <span class="text-xs text-gray-500">1L</span>
          </div>
        </div>
      </div>

    </div>
  </div>
</template>
