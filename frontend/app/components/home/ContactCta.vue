<template>
  <section class="py-24 bg-brand-primary relative overflow-hidden">
    <!-- Abstract background circle -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-brand-accent2/20 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-brand-accent1/20 rounded-full blur-3xl translate-y-1/2 -translate-x-1/4"></div>
    
    <div class="container mx-auto px-4 relative z-10 text-center">
      <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Ready to Transform Your Space?</h2>
      <p class="text-xl text-gray-300 mb-10 max-w-2xl mx-auto">
        Speak to our color consultants and technical experts today to find the perfect coating solution for your next project.
      </p>
      
      <div class="flex flex-col sm:flex-row justify-center gap-4">
        <button class="bg-brand-accent1 text-white px-8 py-4 rounded-full font-medium hover:bg-brand-accent1/90 transition-colors shadow-lg text-lg flex items-center justify-center gap-2">
          Request a Quote <Icon name="lucide:arrow-right" size="20" />
        </button>
        <button class="bg-white/10 backdrop-blur-md text-white border border-white/20 px-8 py-4 rounded-full font-medium hover:bg-white/20 transition-colors text-lg flex items-center justify-center gap-2">
          <Icon name="lucide:phone" size="20" /> Contact Support
        </button>
      </div>
    </div>
  </section>
</template>
