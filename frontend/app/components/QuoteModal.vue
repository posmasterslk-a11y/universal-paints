<template>
  <Teleport to="body">
    <div v-if="isOpen" class="fixed inset-0 z-[100] flex items-center justify-center">
      <!-- Backdrop -->
      <div class="absolute inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity" @click="$emit('close')"></div>
      
      <!-- Modal Content -->
      <div class="bg-white rounded-[2rem] shadow-2xl w-full max-w-lg mx-4 relative z-10 overflow-hidden transform transition-all animate-fade-in-up">
        
        <!-- Header -->
        <div class="bg-brand-primary p-8 text-white relative overflow-hidden">
          <div class="absolute -bottom-24 -right-24 w-64 h-64 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
          <button type="button" @click="emit('close')" class="absolute top-6 right-6 w-10 h-10 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/30 transition-colors z-[60] cursor-pointer">
            <Icon name="lucide:x" size="20" />
          </button>
          
          <h2 class="text-3xl font-bold mb-2 text-white relative z-10">Get a Free Quote</h2>
          <p class="text-white/80 text-sm relative z-10">Tell us about your project and we'll get back to you within 24 hours.</p>
        </div>

        <!-- Form -->
        <form @submit.prevent="submitForm" class="p-8 space-y-5 bg-white">
          <div class="grid grid-cols-2 gap-5">
            <div class="space-y-1.5">
              <label class="text-xs font-bold text-gray-700 uppercase tracking-wide">First Name</label>
              <input type="text" required class="w-full bg-surface-light border border-gray-100 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-colors" placeholder="John" />
            </div>
            <div class="space-y-1.5">
              <label class="text-xs font-bold text-gray-700 uppercase tracking-wide">Last Name</label>
              <input type="text" required class="w-full bg-surface-light border border-gray-100 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-colors" placeholder="Doe" />
            </div>
          </div>
          
          <div class="space-y-1.5">
            <label class="text-xs font-bold text-gray-700 uppercase tracking-wide">Phone Number</label>
            <input type="tel" required class="w-full bg-surface-light border border-gray-100 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-colors" placeholder="+94 77 000 0000" />
          </div>

          <div class="space-y-1.5">
            <label class="text-xs font-bold text-gray-700 uppercase tracking-wide">Project Type</label>
            <div class="relative">
              <select class="w-full bg-surface-light border border-gray-100 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-colors appearance-none cursor-pointer pr-10">
                <option value="" disabled selected>Select an option</option>
                <option value="residential">Residential Painting</option>
                <option value="commercial">Commercial Painting</option>
                <option value="industrial">Industrial Coatings</option>
                <option value="wood">Wood Coatings</option>
                <option value="other">Other</option>
              </select>
              <Icon name="lucide:chevron-down" size="16" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none" />
            </div>
          </div>

          <div class="space-y-1.5">
            <label class="text-xs font-bold text-gray-700 uppercase tracking-wide">Message (Optional)</label>
            <textarea rows="3" class="w-full bg-surface-light border border-gray-100 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-colors resize-none" placeholder="Briefly describe your requirements..."></textarea>
          </div>

          <button type="submit" class="w-full bg-brand-primary text-white font-bold py-4 rounded-xl shadow-lg hover:bg-brand-accent1 hover:shadow-brand-accent1/30 transition-all duration-300 flex justify-center items-center gap-2 mt-2 group">
            <span>Submit Request</span>
            <Icon name="lucide:arrow-right" size="18" class="group-hover:translate-x-1 transition-transform" />
          </button>
        </form>
      </div>
    </div>
  </Teleport>
</template>

<script setup>
defineProps({
  isOpen: {
    type: Boolean,
    required: true
  }
})

const emit = defineEmits(['close'])

const submitForm = () => {
  // Simple success simulation for UX
  setTimeout(() => {
    alert("Thank you! Your quote request has been successfully submitted. Our team will contact you within 24 hours.");
    emit('close');
  }, 400);
}
</script>

<style scoped>
.animate-fade-in-up {
  animation: fadeInUp 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px) scale(0.95);
  }
  to {
    opacity: 1;
    transform: translateY(0) scale(1);
  }
}
</style>
