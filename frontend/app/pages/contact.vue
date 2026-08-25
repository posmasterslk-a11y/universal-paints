<template>
  <div class="contact-page">
    <section class="contact-hero">
      <div class="hero-image-full">
        <img src="/images/contact-us-page/hero.webp" alt="Contact Us Banner" />
        <div class="hero-overlay"></div>
      </div>
      <div class="container hero-grid">
        <div class="hero-text">
          <!-- Breadcrumb -->
          <div class="breadcrumb-wrap">
            <div class="breadcrumb">
              <NuxtLink to="/">Home</NuxtLink>
              <span class="sep">></span>
              <span class="current">Contact Us</span>
            </div>
          </div>
          <div class="hero-subtitle text-red font-bold text-sm uppercase mb-2">Get in Touch</div>
          <h1 class="hero-title">Contact <span class="text-gradient-orange">Us</span></h1>
          <p class="hero-desc">We're here to help you with the right paint solutions, support and inquiries.</p>
          <div class="hero-gradient-line"></div>
          <div class="hero-features">
            <div class="feature">
              <svg class="icon-red" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" /></svg>
              <span class="feature-text">Ask</span>
            </div>
            <div class="feature-divider"></div>
            <div class="feature">
              <!-- Using a close approximation of a handshake or joining hands using heroicons outline styles -->
              <svg class="icon-red" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
              </svg>
              <span class="feature-text">Connect</span>
            </div>
            <div class="feature-divider"></div>
            <div class="feature">
              <svg class="icon-orange" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 10.5 9 3.75l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" /></svg>
              <span class="feature-text">Grow</span>
            </div>
          </div>
        </div>
        <div class="hero-empty"></div>
      </div>
    </section>

    <!-- Main Content: Info & Form -->
    <section class="contact-main">
      <div class="container contact-grid">
        
        <!-- Left: Info Cards -->
        <div class="contact-info">
          <!-- Card 1: Call -->
          <div class="info-card card-call">
            <div class="info-icon bg-red-50 text-red">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.896-1.596-5.48-4.18-7.076-7.076l1.293-.97c.362-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" /></svg>
            </div>
            <div class="info-details">
              <h4>Call Us</h4>
              <p>+94 11 234 5678<br/>+94 77 123 4567</p>
            </div>
          </div>
          <!-- Card 2: Email -->
          <div class="info-card card-email">
            <div class="info-icon bg-green-50 text-green">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg>
            </div>
            <div class="info-details">
              <h4>Email Us</h4>
              <p>info@universalpaints.lk<br/>sales@universalpaints.lk</p>
            </div>
          </div>
          <!-- Card 3: Address -->
          <div class="info-card card-address">
            <div class="info-icon bg-blue-50 text-blue">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" /></svg>
            </div>
            <div class="info-details">
              <h4>Our Address</h4>
              <p>No. 123, Industrial Zone,<br/>Colombo, Sri Lanka.</p>
            </div>
          </div>
          <!-- Card 4: Map -->
          <div class="map-card">
            <div class="map-header">
              <svg class="text-red" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" /></svg>
              <h4>Our Location</h4>
              <a href="https://share.google/D0Jkmwxyk7zRswXqc" target="_blank" class="map-link">View on Maps ↗</a>
            </div>
            <div class="map-image-wrap">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.9202003926016!2d79.8807746749952!3d6.779566493217437!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae24594d8ed75b9%3A0x11ecd508a1204783!2sUniversal%20Paints!5e0!3m2!1sen!2slk!4v1786790232330!5m2!1sen!2slk" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
            </div>
          </div>
        </div>

        <!-- Right: Form -->
        <div class="contact-form-wrap">
          <div class="form-card">
            <h3 class="form-title">Send Us a Message</h3>
            <div class="form-divider"></div>
            <p class="form-subtitle">We'd love to hear from you. Fill out the form below.</p>
            
            <form @submit.prevent="" class="contact-form">
              <div class="form-row">
                <div class="form-group">
                  <div class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg></div>
                  <input type="text" placeholder="Your Name" />
                </div>
                <div class="form-group">
                  <div class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg></div>
                  <input type="email" placeholder="Your Email" />
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <div class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.896-1.596-5.48-4.18-7.076-7.076l1.293-.97c.362-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" /></svg></div>
                  <input type="text" placeholder="Phone Number" />
                </div>
                <div class="form-group">
                  <div class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg></div>
                  <input type="text" placeholder="Subject" />
                </div>
              </div>
              <div class="form-group">
                <div class="input-icon textarea-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" /></svg></div>
                <textarea placeholder="Your Message" rows="5"></textarea>
              </div>
              <button type="submit" class="btn btn-primary-orange">
                Send Message <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 16px; height: 16px; margin-left: 8px;"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" /></svg>
              </button>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
      <div class="container">
        <div class="faq-header text-center">
          <h2 class="section-title">Frequently Asked Questions</h2>
          <p class="section-subtitle-gray">Find quick answers to common questions.</p>
        </div>
        
        <div class="faq-grid">
          <div class="faq-card">
            <div class="faq-icon bg-red-50 text-red"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" /></svg></div>
            <div class="faq-content">
              <h4>Where can I buy Universal Paints products?</h4>
              <p>Our products are available through our nationwide distribution network and trusted retail partners.</p>
            </div>
            <div class="faq-chevron text-red"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" /></svg></div>
          </div>
          <div class="faq-card">
            <div class="faq-icon bg-green-50 text-green"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" /></svg></div>
            <div class="faq-content">
              <h4>Do you offer bulk orders for businesses?</h4>
              <p>Yes, we provide special pricing and support for large volume and corporate clients.</p>
            </div>
            <div class="faq-chevron text-red"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" /></svg></div>
          </div>
          <div class="faq-card">
            <div class="faq-icon bg-blue-50 text-blue"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.4 2.245 4.5 4.5 0 0 0 8.4-2.245c0-.399-.078-.78-.22-1.128Zm0 0a15.998 15.998 0 0 0 3.388-1.62m-5.043-.025a15.994 15.994 0 0 1 1.622-3.395m3.42 3.42a15.995 15.995 0 0 0 4.764-4.648l3.813-6.814-3.111-1.134-3.956 2.727-1.808-1.808m-4.155 4.155c-.361-.05-.724-.092-1.089-.122M6.75 8.25a2.25 2.25 0 0 0-2.246-2.23c.097-.315.198-.63.306-.94l1.116-3.193 1.141 3.237a2.25 2.25 0 0 0-2.246 2.23Zm10.5-1.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" /></svg></div>
            <div class="faq-content">
              <h4>Are your paints eco-friendly?</h4>
              <p>Yes, our paints are low VOC and safe for your home and the environment.</p>
            </div>
            <div class="faq-chevron text-red"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" /></svg></div>
          </div>
          <div class="faq-card">
            <div class="faq-icon bg-orange-50 text-orange"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 0 0 6-6v-1.5m-6 7.5a6 6 0 0 1-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 0 1-3-3V4.5a3 3 0 1 1 6 0v8.25a3 3 0 0 1-3 3Z" /></svg></div>
            <div class="faq-content">
              <h4>How can I get technical support?</h4>
              <p>Contact our customer care team via phone or email. We're here to help.</p>
            </div>
            <div class="faq-chevron text-red"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" /></svg></div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
      <div class="container">
        <div class="cta-card">
          <div class="cta-img-wrap">
            <img src="/images/contact-us-page/paint-bucket.webp" alt="Paint Buckets" class="cta-img" />
          </div>
          <div class="cta-content">
            <h3>Ready to Transform<br/>Your Space?</h3>
            <p>Contact our team today for product advice, quotations and support.</p>
          </div>
          <div class="cta-action">
            <button class="btn btn-primary-orange">
              Get in Touch <span class="arrow">→</span>
            </button>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
definePageMeta({
  title: 'Contact Us - Universal Paints'
})
</script>

<style scoped>
.contact-page {
  width: 100%;
}

/* Colors Utilities - Matching the design */
.text-red { color: #E3000F; }
.text-orange { color: #F97316; }
.text-green { color: #10B981; }
.text-blue { color: #3B82F6; }
.text-gradient-orange {
  background: linear-gradient(90deg, #E3000F 0%, #F59E0B 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
.bg-red-50 { background-color: #FEF2F2; }
.bg-green-50 { background-color: #ECFDF5; }
.bg-blue-50 { background-color: #EFF6FF; }
.bg-orange-50 { background-color: #FFF7ED; }

/* Buttons */
.btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 12px 28px;
  font-size: 15px;
  font-weight: 600;
  border-radius: 30px;
  cursor: pointer;
  transition: all 0.3s ease;
  border: none;
}
.btn-primary-orange {
  background: linear-gradient(90deg, #E3000F 0%, #F97316 100%);
  color: white;
  box-shadow: 0 4px 15px rgba(249, 115, 22, 0.3);
}
.btn-primary-orange:hover {
  box-shadow: 0 6px 20px rgba(249, 115, 22, 0.4);
  transform: translateY(-2px);
}
.arrow {
  margin-left: 8px;
  transition: transform 0.3s;
}
.btn:hover .arrow {
  transform: translateX(4px);
}

/* Breadcrumb */
.breadcrumb-wrap {
  padding-bottom: 20px;
}
.breadcrumb {
  font-size: 13px;
  color: #666;
}
.breadcrumb a {
  color: #666;
  text-decoration: none;
}
.breadcrumb a:hover {
  color: #E3000F;
}
.breadcrumb .sep {
  margin: 0 8px;
  color: #ccc;
}
.breadcrumb .current {
  color: #E3000F;
  font-weight: 500;
}

/* Hero Section */
.contact-hero {
  position: relative;
  min-height: 600px;
  display: flex;
  align-items: center;
  background-color: #F9FAFB;
  overflow: hidden;
  padding: 140px 0 80px;
}
.hero-image-full {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 0;
}
.hero-image-full img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: right center;
}
.hero-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(to right, rgba(249, 250, 251, 1) 30%, rgba(249, 250, 251, 0.85) 55%, rgba(249, 250, 251, 0) 80%);
}
.hero-grid {
  position: relative;
  z-index: 1;
  display: grid;
  grid-template-columns: 1fr 1.2fr;
  gap: 40px;
  align-items: center;
  width: 100%;
}
.hero-title {
  font-size: 56px;
  font-weight: 800;
  color: #0A192F;
  margin-bottom: 20px;
  line-height: 1.1;
}
.hero-desc {
  font-size: 18px;
  color: #4B5563;
  margin-bottom: 30px;
  max-width: 400px;
}
.hero-gradient-line {
  width: 60px;
  height: 4px;
  background: linear-gradient(to right, #E3000F, #F59E0B, #10B981, #3B82F6);
  border-radius: 2px;
  margin-bottom: 24px;
}
.hero-features {
  display: flex;
  align-items: center;
  gap: 16px;
}
.feature {
  display: flex;
  align-items: center;
  gap: 8px;
}
.feature svg {
  width: 22px;
  height: 22px;
}
.feature .icon-red {
  color: #E3000F;
}
.feature .icon-orange {
  color: #F97316;
}
.feature-text {
  font-size: 16px;
  font-weight: 700;
  color: #0A192F;
}
.feature-divider {
  width: 1px;
  height: 22px;
  background-color: #D1D5DB;
}
.hero-empty {
  display: none; /* Can be used to keep grid structural spacing */
}

@media (min-width: 993px) {
  .hero-empty {
    display: block;
  }
}

/* Contact Main Section */
.contact-main {
  padding: 80px 0;
  background-color: #FAFAFA;
}
.contact-grid {
  display: grid;
  grid-template-columns: 1fr 1.5fr;
  gap: 40px;
}
.contact-info {
  display: flex;
  flex-direction: column;
  gap: 20px;
}
.info-card {
  position: relative;
  overflow: hidden;
  display: flex;
  align-items: center;
  gap: 24px;
  background: white;
  padding: 24px 32px;
  border-radius: 20px;
  box-shadow: 0 8px 30px rgba(0,0,0,0.04);
  transition: transform 0.3s, box-shadow 0.3s;
}
.info-card::before {
  content: "";
  position: absolute;
  left: 0;
  top: 0;
  bottom: 0;
  width: 6px;
}
.card-call::before {
  background: linear-gradient(to bottom, #E3000F, #F59E0B);
}
.card-email::before {
  background: linear-gradient(to bottom, #10B981, #A7F3D0);
}
.card-address::before {
  background: linear-gradient(to bottom, #2563EB, #BFDBFE);
}
.info-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 12px 40px rgba(0,0,0,0.06);
}
.info-icon {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.info-icon svg {
  width: 26px;
  height: 26px;
  stroke-width: 1.5;
}
.info-details h4 {
  font-size: 18px;
  font-weight: 700;
  color: #0A192F;
  margin-bottom: 6px;
}
.info-details p {
  font-size: 15px;
  color: #4B5563;
  line-height: 1.6;
  margin: 0;
}
.map-card {
  background: white;
  border-radius: 16px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.03);
  overflow: hidden;
  margin-top: 10px;
}
.map-header {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 20px 24px;
  border-bottom: 1px solid #F3F4F6;
}
.map-header svg {
  width: 20px;
  height: 20px;
}
.map-header h4 {
  font-size: 16px;
  font-weight: 700;
  color: #111;
  margin: 0;
}
.map-link {
  margin-left: auto;
  font-size: 13px;
  color: #E3000F;
  text-decoration: none;
  font-weight: 600;
  transition: opacity 0.2s;
}
.map-link:hover {
  text-decoration: underline;
  opacity: 0.8;
}
.map-image-wrap {
  width: 100%;
  height: 200px;
}
.map-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

/* Contact Form */
.form-card {
  background: white;
  padding: 40px;
  border-radius: 20px;
  box-shadow: 0 10px 40px rgba(0,0,0,0.05);
  height: 100%;
}
.form-title {
  font-size: 28px;
  font-weight: 700;
  color: #0A192F;
  margin-bottom: 12px;
}
.form-divider {
  width: 60px;
  height: 4px;
  background: linear-gradient(to right, #E3000F, #F59E0B, #10B981, #3B82F6);
  border-radius: 2px;
  margin-bottom: 20px;
}
.form-subtitle {
  font-size: 15px;
  color: #6B7280;
  margin-bottom: 30px;
}
.contact-form {
  display: flex;
  flex-direction: column;
  gap: 20px;
}
.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}
.form-group {
  position: relative;
  display: flex;
  align-items: center;
}
.input-icon {
  position: absolute;
  left: 16px;
  color: #9CA3AF;
  display: flex;
  align-items: center;
  justify-content: center;
}
.input-icon.textarea-icon {
  top: 16px;
  align-items: flex-start;
}
.input-icon svg {
  width: 20px;
  height: 20px;
}
.contact-form input,
.contact-form textarea {
  width: 100%;
  padding: 14px 16px 14px 48px;
  border: 1px solid #E5E7EB;
  border-radius: 12px;
  font-size: 15px;
  color: #111;
  background-color: #F9FAFB;
  transition: all 0.3s;
  font-family: inherit;
}
.contact-form input:focus,
.contact-form textarea:focus {
  outline: none;
  border-color: #F97316;
  background-color: white;
  box-shadow: 0 0 0 4px rgba(249, 115, 22, 0.1);
}
.contact-form input::placeholder,
.contact-form textarea::placeholder {
  color: #9CA3AF;
}

/* FAQ Section */
.faq-section {
  padding: 80px 0;
  background-color: white;
}
.section-title {
  font-size: 32px;
  font-weight: 800;
  color: #111;
  margin-bottom: 12px;
}
.section-subtitle-gray {
  font-size: 16px;
  color: #6B7280;
  margin-bottom: 40px;
}
.faq-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 24px;
}
.faq-card {
  display: flex;
  align-items: flex-start;
  gap: 20px;
  background: white;
  padding: 24px;
  border-radius: 16px;
  border: 1px solid #F3F4F6;
  box-shadow: 0 4px 15px rgba(0,0,0,0.02);
  cursor: pointer;
  transition: all 0.3s;
}
.faq-card:hover {
  border-color: #FCA5A5;
  box-shadow: 0 10px 25px rgba(227,0,15,0.05);
}
.faq-icon {
  width: 48px;
  height: 48px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.faq-icon svg {
  width: 24px;
  height: 24px;
}
.faq-content {
  flex-grow: 1;
}
.faq-content h4 {
  font-size: 16px;
  font-weight: 700;
  color: #111;
  margin-bottom: 8px;
  padding-right: 20px;
}
.faq-content p {
  font-size: 14px;
  color: #4B5563;
  line-height: 1.5;
  margin: 0;
}
.faq-chevron {
  flex-shrink: 0;
  padding-top: 4px;
}
.faq-chevron svg {
  width: 20px;
  height: 20px;
}

/* CTA Section */
.cta-section {
  padding: 60px 0 100px;
  background-color: white;
}
.cta-card {
  display: flex;
  align-items: center;
  background: linear-gradient(90deg, #F9FAFB 0%, #FFFFFF 100%);
  border-radius: 24px;
  padding: 0;
  box-shadow: 0 10px 40px rgba(0,0,0,0.05);
  overflow: hidden;
  border: 1px solid #F3F4F6;
}
.cta-img-wrap {
  width: 300px;
  height: 200px;
  flex-shrink: 0;
}
.cta-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.cta-content {
  flex-grow: 1;
  padding: 40px;
  border-right: 1px solid #F3F4F6;
}
.cta-content h3 {
  font-size: 28px;
  font-weight: 800;
  color: #111;
  margin-bottom: 10px;
  line-height: 1.2;
}
.cta-content p {
  font-size: 15px;
  color: #4B5563;
  margin: 0;
}
.cta-action {
  padding: 40px;
  flex-shrink: 0;
  display: flex;
  align-items: center;
  justify-content: center;
}

@media (max-width: 992px) {
  .hero-grid, .contact-grid {
    grid-template-columns: 1fr;
  }
  .form-row {
    grid-template-columns: 1fr;
  }
  .faq-grid {
    grid-template-columns: 1fr;
  }
  .cta-card {
    flex-direction: column;
    text-align: center;
  }
  .cta-img-wrap {
    width: 100%;
  }
  .cta-content {
    border-right: none;
    border-bottom: 1px solid #F3F4F6;
  }
}
</style>
