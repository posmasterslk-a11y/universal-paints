<template>
  <div>
    <div class="mb-8">
      <h2 class="text-2xl font-bold text-gray-800">Dashboard Overview</h2>
      <p class="text-gray-500 text-sm mt-1">Welcome back! Here's what's happening with your store today.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
      <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 flex items-center justify-between">
        <div>
          <p class="text-sm font-medium text-gray-500 mb-1">Total Revenue</p>
          <p class="text-2xl font-bold text-gray-900">Rs. 245,500</p>
          <div class="flex items-center gap-1 mt-2 text-sm text-green-600 font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
            <span>+12.5%</span>
          </div>
        </div>
        <div class="w-12 h-12 rounded-full bg-green-50 flex items-center justify-center text-green-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        </div>
      </div>

      <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 flex items-center justify-between">
        <div>
          <p class="text-sm font-medium text-gray-500 mb-1">Active Orders</p>
          <p class="text-2xl font-bold text-gray-900">124</p>
          <div class="flex items-center gap-1 mt-2 text-sm text-green-600 font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
            <span>+5.2%</span>
          </div>
        </div>
        <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center text-brand-blue">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
        </div>
      </div>

      <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 flex items-center justify-between">
        <div>
          <p class="text-sm font-medium text-gray-500 mb-1">Customers</p>
          <p class="text-2xl font-bold text-gray-900">1,450</p>
          <div class="flex items-center gap-1 mt-2 text-sm text-red-500 font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" /></svg>
            <span>-1.1%</span>
          </div>
        </div>
        <div class="w-12 h-12 rounded-full bg-purple-50 flex items-center justify-center text-purple-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
        </div>
      </div>

      <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 flex items-center justify-between">
        <div>
          <p class="text-sm font-medium text-gray-500 mb-1">Products Sold</p>
          <p class="text-2xl font-bold text-gray-900">856</p>
          <div class="flex items-center gap-1 mt-2 text-sm text-green-600 font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
            <span>+18.4%</span>
          </div>
        </div>
        <div class="w-12 h-12 rounded-full bg-orange-50 flex items-center justify-center text-orange-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
        </div>
      </div>
    </div>

    <!-- Main Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <!-- Recent Orders -->
      <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
          <h3 class="text-lg font-bold text-gray-800">Recent Orders</h3>
          <a href="#" class="text-sm font-semibold text-brand-red hover:text-red-700">View All</a>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="text-xs font-semibold text-gray-500 uppercase tracking-wider bg-white">
                <th class="px-6 py-4">Order ID</th>
                <th class="px-6 py-4">Customer</th>
                <th class="px-6 py-4">Product</th>
                <th class="px-6 py-4">Amount</th>
                <th class="px-6 py-4">Status</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
              <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 font-medium text-gray-900">#ORD-001</td>
                <td class="px-6 py-4 text-gray-600">Kasun Perera</td>
                <td class="px-6 py-4 text-gray-600">Premium Exterior 20L</td>
                <td class="px-6 py-4 font-semibold text-gray-900">Rs. 18,500</td>
                <td class="px-6 py-4">
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Completed</span>
                </td>
              </tr>
              <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 font-medium text-gray-900">#ORD-002</td>
                <td class="px-6 py-4 text-gray-600">Nimal Silva</td>
                <td class="px-6 py-4 text-gray-600">Elite Interior 4L</td>
                <td class="px-6 py-4 font-semibold text-gray-900">Rs. 4,200</td>
                <td class="px-6 py-4">
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Processing</span>
                </td>
              </tr>
              <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 font-medium text-gray-900">#ORD-003</td>
                <td class="px-6 py-4 text-gray-600">Amila Rathnayake</td>
                <td class="px-6 py-4 text-gray-600">Wood Finish 1L (x2)</td>
                <td class="px-6 py-4 font-semibold text-gray-900">Rs. 3,600</td>
                <td class="px-6 py-4">
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Shipped</span>
                </td>
              </tr>
              <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 font-medium text-gray-900">#ORD-004</td>
                <td class="px-6 py-4 text-gray-600">Ruwan Fernando</td>
                <td class="px-6 py-4 text-gray-600">Surface Primer 20L</td>
                <td class="px-6 py-4 font-semibold text-gray-900">Rs. 12,000</td>
                <td class="px-6 py-4">
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Completed</span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Top Selling Products -->
      <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50">
          <h3 class="text-lg font-bold text-gray-800">Top Selling Products</h3>
        </div>
        <div class="p-6 space-y-6">
          <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center p-2">
              <!-- Placeholder for bucket icon -->
              <span class="text-xl">🪣</span>
            </div>
            <div class="flex-1">
              <h4 class="text-sm font-bold text-gray-900">Premium Exterior Emulsion</h4>
              <p class="text-xs text-gray-500">20L Variant</p>
            </div>
            <div class="text-right">
              <p class="text-sm font-bold text-gray-900">142</p>
              <p class="text-xs text-gray-500">Sales</p>
            </div>
          </div>

          <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center p-2">
              <span class="text-xl">🪣</span>
            </div>
            <div class="flex-1">
              <h4 class="text-sm font-bold text-gray-900">Elite Interior Emulsion</h4>
              <p class="text-xs text-gray-500">4L Variant</p>
            </div>
            <div class="text-right">
              <p class="text-sm font-bold text-gray-900">98</p>
              <p class="text-xs text-gray-500">Sales</p>
            </div>
          </div>
          
          <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center p-2">
              <span class="text-xl">🪣</span>
            </div>
            <div class="flex-1">
              <h4 class="text-sm font-bold text-gray-900">Silk Interior Finish</h4>
              <p class="text-xs text-gray-500">1L Variant</p>
            </div>
            <div class="text-right">
              <p class="text-sm font-bold text-gray-900">65</p>
              <p class="text-xs text-gray-500">Sales</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
