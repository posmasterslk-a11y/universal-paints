<template>
  <div class="policy-page pt-32 pb-20">
    <div class="container mx-auto px-4 max-w-4xl">
      <div class="mb-10 text-center">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Frequently Asked Questions</h1>
        <p class="text-gray-500">Find answers to common questions about our products and services.</p>
      </div>

      <div class="faq-list space-y-6">
        <div class="faq-item bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
          <h3 class="text-xl font-bold text-gray-900 mb-2">How do I choose the right paint for my walls?</h3>
          <p class="text-gray-600">The right paint depends on the surface and the location. For interiors, we recommend our premium emulsions with a matte or eggshell finish. For exteriors, you need weather-resistant paints like our Exterior Shield range. Our experts are always available to guide you.</p>
        </div>

        <div class="faq-item bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
          <h3 class="text-xl font-bold text-gray-900 mb-2">Do you deliver islandwide?</h3>
          <p class="text-gray-600">Yes, we provide delivery services across Sri Lanka. Delivery times and charges may vary depending on your location and the size of your order.</p>
        </div>

        <div class="faq-item bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
          <h3 class="text-xl font-bold text-gray-900 mb-2">Can I get a custom colour mixed?</h3>
          <p class="text-gray-600">Absolutely! We have state-of-the-art colour mixing technology available at all our main dealerships. Just bring in a sample of the colour you want, and we can match it perfectly.</p>
        </div>

        <div class="faq-item bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
          <h3 class="text-xl font-bold text-gray-900 mb-2">How do I calculate how much paint I need?</h3>
          <p class="text-gray-600">As a general rule, 1 litre of our standard emulsion covers approximately 12-14 square meters (for a single coat). You will typically need two coats for a perfect finish. You can contact us with your room dimensions for a precise calculation.</p>
        </div>

        <div class="faq-item bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
          <h3 class="text-xl font-bold text-gray-900 mb-2">What is your return policy?</h3>
          <p class="text-gray-600">We accept returns on unopened, standard colour paints within 14 days of purchase. Unfortunately, we cannot accept returns on custom-mixed colours unless the product is defective.</p>
        </div>
      </div>
      
      <div class="mt-12 text-center bg-gray-50 p-8 rounded-xl border border-gray-200">
        <h3 class="text-xl font-bold mb-2">Still have questions?</h3>
        <p class="text-gray-600 mb-4">We're here to help! Get in touch with our support team.</p>
        <NuxtLink to="/contact" class="inline-block bg-red-600 text-white font-semibold py-3 px-8 rounded-full hover:bg-red-700 transition">Contact Support</NuxtLink>
      </div>
    </div>
  </div>
</template>

<script setup>
useSeoMeta({
  title: 'Frequently Asked Questions (FAQ) | Painting & Coating Guide',
  ogTitle: 'Universal Paints FAQ | Painting & Coating Guide Sri Lanka',
  description: 'Answers to frequent questions about paint selection, surface preparation, islandwide delivery, color matching, and paint quantity calculation in Sri Lanka.',
  ogDescription: 'Answers to frequent questions about paint selection, surface preparation, islandwide delivery, color matching, and paint quantity calculation in Sri Lanka.',
  ogImage: 'https://universalpaints.lk/images/og-image.jpg',
  ogUrl: 'https://universalpaints.lk/support/faq',
  ogType: 'website',
  twitterCard: 'summary_large_image',
  twitterTitle: 'Universal Paints FAQ',
  twitterDescription: 'Paint selection advice, islandwide delivery, and custom color matching in Sri Lanka.',
  twitterImage: 'https://universalpaints.lk/images/og-image.jpg'
})

useHead({
  link: [
    { rel: 'canonical', href: 'https://universalpaints.lk/support/faq' }
  ],
  script: [
    {
      type: 'application/ld+json',
      children: JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'FAQPage',
        mainEntity: [
          {
            '@type': 'Question',
            name: 'How do I choose the right paint for my walls?',
            acceptedAnswer: {
              '@type': 'Answer',
              text: 'The right paint depends on the surface and the location. For interiors, we recommend our premium emulsions with a matte or eggshell finish. For exteriors, you need weather-resistant paints like our Exterior Shield range.'
            }
          },
          {
            '@type': 'Question',
            name: 'Do you deliver islandwide in Sri Lanka?',
            acceptedAnswer: {
              '@type': 'Answer',
              text: 'Yes, we provide delivery services across all 25 districts of Sri Lanka. Delivery times and charges may vary depending on your location and the size of your order.'
            }
          },
          {
            '@type': 'Question',
            name: 'Can I get a custom colour mixed?',
            acceptedAnswer: {
              '@type': 'Answer',
              text: 'Absolutely! We have state-of-the-art colour mixing technology available at all our main dealerships. Just bring in a sample of the colour you want, and we can match it perfectly.'
            }
          },
          {
            '@type': 'Question',
            name: 'How do I calculate how much paint I need?',
            acceptedAnswer: {
              '@type': 'Answer',
              text: 'As a general rule, 1 litre of our standard emulsion covers approximately 12-14 square meters for a single coat. Two coats are recommended for a durable finish.'
            }
          },
          {
            '@type': 'Question',
            name: 'What is your return policy?',
            acceptedAnswer: {
              '@type': 'Answer',
              text: 'We accept returns on unopened, standard colour paints within 14 days of purchase. Custom-mixed colours cannot be returned unless defective.'
            }
          }
        ]
      })
    }
  ]
})
</script>

<style scoped>
.policy-page {
  background-color: #f9fafb;
  min-height: calc(100vh - 300px);
}
</style>
