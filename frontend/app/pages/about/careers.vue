<template>
  <div class="bg-surface-light min-h-screen">
    <!-- Hero Section -->
    <section class="relative pt-32 pb-24 md:pt-40 md:pb-32 overflow-hidden bg-brand-primary text-white">
      <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=1200&auto=format&fit=crop')] bg-cover bg-center opacity-20 mix-blend-overlay"></div>
      
      <div class="container mx-auto px-4 relative z-10 text-center max-w-4xl">
        <span class="text-brand-accent1 font-bold tracking-widest uppercase text-sm mb-4 block">Careers</span>
        <h1 class="text-5xl md:text-6xl font-bold tracking-tight leading-[1.1] mb-6">
          Formulate Your Future.
        </h1>
        <p class="text-white/80 text-lg md:text-xl leading-relaxed mb-8 mx-auto max-w-2xl">
          Join a team of innovators, chemists, and creators dedicated to coloring the world. At Universal Paints, your career is a canvas.
        </p>
        <button class="bg-brand-accent1 text-white font-bold px-8 py-4 rounded-full hover:bg-brand-accent1/90 transition-all shadow-lg hover:-translate-y-1">
          View Open Positions
        </button>
      </div>
    </section>

    <!-- Why Join Us? -->
    <section class="py-24 bg-white relative">
      <div class="container mx-auto px-4">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold text-brand-primary mb-4">Why Universal Paints?</h2>
          <p class="text-gray-600 text-lg">We invest in our people as much as our products.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
          <div class="p-8 rounded-2xl bg-surface-light border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group">
            <div class="w-14 h-14 bg-white rounded-xl flex items-center justify-center mb-6 shadow-sm group-hover:bg-brand-primary transition-colors duration-300">
               <Icon name="lucide:heart-pulse" size="28" class="text-brand-accent1 group-hover:text-white transition-colors duration-300" />
            </div>
            <h3 class="text-xl font-bold text-brand-primary mb-3">Health & Wellness</h3>
            <p class="text-gray-600 leading-relaxed text-sm">Comprehensive medical coverage, mental health days, and wellness programs designed for you and your family.</p>
          </div>
          <div class="p-8 rounded-2xl bg-surface-light border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group">
            <div class="w-14 h-14 bg-white rounded-xl flex items-center justify-center mb-6 shadow-sm group-hover:bg-brand-primary transition-colors duration-300">
               <Icon name="lucide:trending-up" size="28" class="text-brand-accent1 group-hover:text-white transition-colors duration-300" />
            </div>
            <h3 class="text-xl font-bold text-brand-primary mb-3">Continuous Growth</h3>
            <p class="text-gray-600 leading-relaxed text-sm">Access to industry certifications, tuition reimbursement, and clear paths for internal promotion.</p>
          </div>
          <div class="p-8 rounded-2xl bg-surface-light border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group">
            <div class="w-14 h-14 bg-white rounded-xl flex items-center justify-center mb-6 shadow-sm group-hover:bg-brand-primary transition-colors duration-300">
               <Icon name="lucide:lightbulb" size="28" class="text-brand-accent1 group-hover:text-white transition-colors duration-300" />
            </div>
            <h3 class="text-xl font-bold text-brand-primary mb-3">Innovative Culture</h3>
            <p class="text-gray-600 leading-relaxed text-sm">Work in state-of-the-art labs where creative thinking and new formulations are always encouraged.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Open Positions -->
    <section class="py-24 bg-surface-light">
      <div class="container mx-auto px-4 max-w-4xl">
        <div class="flex justify-between items-end mb-12 border-b border-gray-200 pb-4">
          <h2 class="text-3xl font-bold text-brand-primary">Open Positions</h2>
          <span class="text-gray-500 font-medium text-sm border border-gray-200 px-3 py-1 rounded-full bg-white">3 Roles Available</span>
        </div>

        <div class="space-y-4">
          <!-- Job Card -->
          <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow flex flex-col md:flex-row md:items-center justify-between gap-6 group cursor-pointer">
            <div>
              <h3 class="text-xl font-bold text-brand-primary mb-2 group-hover:text-brand-accent1 transition-colors">Senior Formulation Chemist</h3>
              <div class="flex gap-4 text-sm text-gray-500 font-medium">
                <span class="flex items-center gap-1"><Icon name="lucide:map-pin" size="14" /> Panadura HQ</span>
                <span class="flex items-center gap-1"><Icon name="lucide:briefcase" size="14" /> Full-Time</span>
              </div>
            </div>
            <button class="px-6 py-2 border-2 border-brand-primary text-brand-primary rounded-full font-bold hover:bg-brand-primary hover:text-white transition-colors whitespace-nowrap">
              Apply Now
            </button>
          </div>

          <!-- Job Card -->
          <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow flex flex-col md:flex-row md:items-center justify-between gap-6 group cursor-pointer">
            <div>
              <h3 class="text-xl font-bold text-brand-primary mb-2 group-hover:text-brand-accent1 transition-colors">Territory Sales Manager</h3>
              <div class="flex gap-4 text-sm text-gray-500 font-medium">
                <span class="flex items-center gap-1"><Icon name="lucide:map-pin" size="14" /> Colombo</span>
                <span class="flex items-center gap-1"><Icon name="lucide:briefcase" size="14" /> Full-Time</span>
              </div>
            </div>
            <button class="px-6 py-2 border-2 border-brand-primary text-brand-primary rounded-full font-bold hover:bg-brand-primary hover:text-white transition-colors whitespace-nowrap">
              Apply Now
            </button>
          </div>
          
          <!-- Job Card -->
          <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow flex flex-col md:flex-row md:items-center justify-between gap-6 group cursor-pointer">
            <div>
              <h3 class="text-xl font-bold text-brand-primary mb-2 group-hover:text-brand-accent1 transition-colors">Digital Marketing Lead</h3>
              <div class="flex gap-4 text-sm text-gray-500 font-medium">
                <span class="flex items-center gap-1"><Icon name="lucide:map-pin" size="14" /> Remote / Hybrid</span>
                <span class="flex items-center gap-1"><Icon name="lucide:briefcase" size="14" /> Full-Time</span>
              </div>
            </div>
            <button class="px-6 py-2 border-2 border-brand-primary text-brand-primary rounded-full font-bold hover:bg-brand-primary hover:text-white transition-colors whitespace-nowrap">
              Apply Now
            </button>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
useHead({
  title: 'Careers | Universal Paints'
})
</script>
