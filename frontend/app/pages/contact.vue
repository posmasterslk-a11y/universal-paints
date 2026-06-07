<template>
  <div class="bg-surface-light min-h-screen pt-28 md:pt-40 pb-24">
    <!-- Header Section -->
    <section class="container mx-auto px-4 mb-16 max-w-5xl text-center">
      <span class="inline-block py-1 px-4 rounded-full bg-brand-primary/10 text-brand-primary text-xs font-bold uppercase tracking-widest mb-4 border border-brand-primary/20">
        Contact Us
      </span>
      <h1 class="text-4xl md:text-6xl font-bold text-gray-900 tracking-tight leading-tight mb-6">
        Let's Start a Conversation.
      </h1>
      <p class="text-gray-500 text-lg md:text-xl leading-relaxed max-w-2xl mx-auto">
        Have a question about our products, need a custom color formulation, or want to locate a dealer? Our team is here to help.
      </p>
    </section>

    <!-- Main Contact Grid -->
    <div class="container mx-auto px-4 max-w-6xl">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
        
        <!-- Left Column: Contact Information Card -->
        <div class="lg:col-span-5 bg-brand-primary rounded-[2rem] p-10 md:p-12 text-white flex flex-col justify-between relative overflow-hidden shadow-xl hover:-translate-y-1 transition-transform duration-500 h-full">
          <!-- Background decoration -->
          <div class="absolute -bottom-24 -right-24 w-64 h-64 bg-white/5 rounded-full blur-3xl pointer-events-none"></div>
          <div class="absolute top-10 right-10 w-32 h-32 bg-brand-accent1/20 rounded-full blur-2xl pointer-events-none"></div>
          
          <div class="relative z-10">
            <h2 class="text-3xl font-bold mb-10 text-white">Contact Information</h2>
            
            <div class="space-y-8">
              <!-- Address -->
              <div class="flex items-start gap-4 group">
                <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-brand-accent1 transition-colors duration-300">
                  <Icon name="lucide:map-pin" size="20" class="text-white group-hover:text-white" />
                </div>
                <div>
                  <h3 class="font-bold text-lg mb-1 text-white">Head Office</h3>
                  <p class="text-white leading-relaxed text-sm">
                    129/1 Galle Road,<br/>
                    Pallimulla, Panadura,<br/>
                    Sri Lanka, 12550
                  </p>
                </div>
              </div>

              <!-- Phone -->
              <div class="flex items-start gap-4 group">
                <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-brand-accent1 transition-colors duration-300">
                  <Icon name="lucide:phone" size="20" class="text-white" />
                </div>
                <div>
                  <h3 class="font-bold text-lg mb-1 text-white">Phone Support</h3>
                  <p class="text-white leading-relaxed text-sm">
                    +94 38 223 4567<br/>
                    +94 77 123 4567
                  </p>
                </div>
              </div>

              <!-- Email -->
              <div class="flex items-start gap-4 group">
                <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-brand-accent1 transition-colors duration-300">
                  <Icon name="lucide:mail" size="20" class="text-white" />
                </div>
                <div>
                  <h3 class="font-bold text-lg mb-1 text-white">Email Us</h3>
                  <p class="text-white leading-relaxed text-sm">
                    sales@universalpaints.lk<br/>
                    info@universalpaints.lk
                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="mt-16 relative z-10">
            <h3 class="font-bold mb-4 text-white uppercase tracking-widest text-sm">Connect with us</h3>
            <div class="flex gap-3">
              <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-brand-accent1 transition-colors duration-300">
                <Icon name="lucide:facebook" size="18" class="text-white" />
              </a>
              <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-brand-accent1 transition-colors duration-300">
                <Icon name="lucide:instagram" size="18" class="text-white" />
              </a>
              <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-brand-accent1 transition-colors duration-300">
                <Icon name="lucide:linkedin" size="18" class="text-white" />
              </a>
            </div>
          </div>
        </div>

        <!-- Right Column: Contact Form Card -->
        <div class="lg:col-span-7 bg-white rounded-[2rem] shadow-xl border border-gray-100 p-10 md:p-12 hover:shadow-2xl transition-shadow duration-500">
          <h2 class="text-3xl font-bold text-gray-900 mb-8">Send us a Message</h2>
          
          <form @submit.prevent="submitForm" class="space-y-6">
            <div class="grid md:grid-cols-2 gap-6">
              <!-- First Name -->
              <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">First Name</label>
                <input type="text" placeholder="John" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-brand-primary focus:bg-white outline-none transition-all" />
              </div>
              <!-- Last Name -->
              <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Last Name</label>
                <input type="text" placeholder="Doe" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-brand-primary focus:bg-white outline-none transition-all" />
              </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
              <!-- Email -->
              <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                <input type="email" placeholder="john@example.com" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-brand-primary focus:bg-white outline-none transition-all" />
              </div>
              <!-- Phone -->
              <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Phone Number</label>
                <input type="tel" placeholder="+94 77 000 0000" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-brand-primary focus:bg-white outline-none transition-all" />
              </div>
            </div>

            <!-- Subject -->
            <div>
              <label class="block text-sm font-bold text-gray-700 mb-2">Subject</label>
              <div class="relative">
                <select class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-brand-primary focus:bg-white outline-none transition-all text-gray-700 appearance-none">
                  <option value="">Select a topic</option>
                  <option value="sales">Sales Inquiry</option>
                  <option value="dealer">Become a Dealer</option>
                  <option value="support">Product Support</option>
                  <option value="other">Other</option>
                </select>
                <Icon name="lucide:chevron-down" size="18" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none" />
              </div>
            </div>

            <!-- Message -->
            <div>
              <label class="block text-sm font-bold text-gray-700 mb-2">Message</label>
              <textarea rows="4" placeholder="How can we help you?" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-brand-primary focus:border-brand-primary focus:bg-white outline-none transition-all resize-none"></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-brand-primary text-white font-bold text-lg py-4 rounded-xl hover:bg-brand-accent1 transition-colors shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 duration-300 flex items-center justify-center gap-2">
              Send Message <Icon name="lucide:send" size="18" />
            </button>
          </form>
        </div>

      </div>
    </div>
  </div>
</template>

<script setup>
useHead({
  title: 'Contact Us | Universal Paints'
})

const submitForm = () => {
  // Simulated form submission
  alert('Thank you for reaching out! We will get back to you soon.')
}
</script>
