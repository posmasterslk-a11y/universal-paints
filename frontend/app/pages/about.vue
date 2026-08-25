<template>
  <div class="about-page">
    <!-- Hero Section -->
    <section class="about-hero">
      <div class="hero-bg">
        <img src="/images/about-us-page/office.png" alt="Universal Paints Office" />
        <div class="hero-overlay"></div>
      </div>
      <div class="container hero-content">
        <!-- Breadcrumb -->
        <div class="breadcrumb-wrap">
          <div class="breadcrumb">
            <NuxtLink to="/">Home</NuxtLink>
            <span class="sep">></span>
            <span class="current">About Us</span>
          </div>
        </div>

        <div class="hero-left">
          <h1 class="page-title">
            About<br/>
            Universal <span class="text-gradient-beautiful">Paints</span>
          </h1>
          <p class="hero-desc">
            For over two decades, we have been committed to delivering innovative, reliable and sustainable paint solutions that beautify spaces and protect what matters most.
          </p>
          <div class="hero-buttons">
            <NuxtLink to="#our-story" class="btn btn-primary">
              Our Journey <span class="arrow">→</span>
            </NuxtLink>
            <button class="btn btn-outline btn-video">
              Watch Video <span class="play-icon">▶</span>
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- Stats Bar -->
    <section class="stats-bar-section">
      <div class="container">
        <div class="stats-bar">
          <div class="stat-item">
            <div class="stat-icon text-red">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" /></svg>
            </div>
            <div class="stat-text">
              <span class="stat-num">20+</span>
              <span class="stat-label">Years of<br/>Excellence</span>
            </div>
          </div>
          <div class="stat-divider"></div>
          <div class="stat-item">
            <div class="stat-icon text-orange">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.999 2.999 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.999 2.999 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" /></svg>
            </div>
            <div class="stat-text">
              <span class="stat-num">1000+</span>
              <span class="stat-label">Retailers<br/>Nationwide</span>
            </div>
          </div>
          <div class="stat-divider"></div>
          <div class="stat-item">
            <div class="stat-icon text-green">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" /></svg>
            </div>
            <div class="stat-text">
              <span class="stat-num">500+</span>
              <span class="stat-label">Products<br/>Available</span>
            </div>
          </div>
          <div class="stat-divider"></div>
          <div class="stat-item">
            <div class="stat-icon text-blue">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
            </div>
            <div class="stat-text">
              <span class="stat-num">50+</span>
              <span class="stat-label">Expert<br/>Employees</span>
            </div>
          </div>
          <div class="stat-divider"></div>
          <div class="stat-item">
            <div class="stat-icon text-purple">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-2.25A1.5 1.5 0 0 1 10.5 17.25h3a1.5 1.5 0 0 1 1.5 1.5V21" /></svg>
            </div>
            <div class="stat-text">
              <span class="stat-num">1</span>
              <span class="stat-label">Advanced<br/>Manufacturing Unit</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Our Story Section -->
    <section id="our-story" class="our-story-section">
      <div class="container story-grid">
        <div class="story-left">
          <div class="section-subtitle text-red text-xs font-bold uppercase mb-2">OUR STORY</div>
          <h2 class="section-title mb-6">A Legacy of Quality<br/>and Commitment</h2>
          <p class="mb-4">
            Universal Paints was founded with a simple mission – to deliver high quality paints that combine beauty, durability and protection.
          </p>
          <p class="mb-8">
            Today, we are proud to be one of the most trusted paint manufacturers and distributors in the region, serving thousands of customers with dedication and integrity.
          </p>
          <NuxtLink to="#values" class="btn btn-primary">
            Our Journey <span class="arrow">→</span>
          </NuxtLink>
        </div>
        
        <div class="story-middle">
          <img src="/images/about-us-page/paint-bucket.png" alt="Paint Buckets" class="story-img" />
        </div>

        <div class="story-right">
          <div class="trust-card">
            <div class="trust-card-header">
              <h3>Built on Trust.<br/>Driven by Quality.<br/>Committed to You.</h3>
              <div class="header-line-accent"></div>
            </div>
            <div class="trust-card-body">
              <ul class="trust-list">
                <li>
                  <span class="check-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                  </span>
                  <span>Premium Quality<br/>Raw Materials</span>
                </li>
                <li>
                  <span class="check-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                  </span>
                  <span>Continuous Innovation<br/>& Research</span>
                </li>
                <li>
                  <span class="check-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                  </span>
                  <span>Eco-friendly & Safe<br/>Products</span>
                </li>
                <li>
                  <span class="check-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                  </span>
                  <span>Customer Satisfaction<br/>Our Priority</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Our Values Section -->
    <section id="values" class="values-section">
      <div class="container">
        <div class="text-center mb-10">
          <div class="section-subtitle text-red text-xs font-bold uppercase mb-2">OUR VALUES</div>
          <h2 class="section-title text-3xl font-bold">The Principles That Drive Us</h2>
        </div>
        
        <div class="values-grid">
          <div class="value-card">
            <div class="value-icon-wrap bg-red-100 text-red">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" /></svg>
            </div>
            <h4>Quality First</h4>
            <p>We never compromise on quality. Every product is made to the highest standards.</p>
          </div>
          <div class="value-card">
            <div class="value-icon-wrap bg-orange-100 text-orange">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.82 1.508-2.316a7.5 7.5 0 1 0-7.516 0c.85.496 1.508 1.333 1.508 2.316V18" /></svg>
            </div>
            <h4>Innovation</h4>
            <p>We continually invest in research and technology to bring innovative solutions.</p>
          </div>
          <div class="value-card">
            <div class="value-icon-wrap bg-green-100 text-green">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.974 0-5.699-.952-7.843-2.582m15.686 0A5.936 5.936 0 0 1 21 12a5.965 5.965 0 0 1-1.5 4.025" /></svg>
            </div>
            <h4>Sustainability</h4>
            <p>We are committed to eco-friendly practices and a greener, better future.</p>
          </div>
          <div class="value-card">
            <div class="value-icon-wrap bg-blue-100 text-blue">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
            </div>
            <h4>Customer Focus</h4>
            <p>Our customers are at the heart of everything we do. We grow when they grow.</p>
          </div>
          <div class="value-card">
            <div class="value-icon-wrap bg-purple-100 text-purple">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" /></svg>
            </div>
            <h4>Integrity</h4>
            <p>We conduct our business with honesty, transparency and respect.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Manufacturing Section -->
    <section class="manufacturing-section">
      <div class="container mfg-grid">
        <div class="mfg-left">
          <div class="section-subtitle text-red text-xs font-bold uppercase mb-2">OUR MANUFACTURING</div>
          <h2 class="section-title mb-6 text-3xl">Advanced Technology.<br/>Superior Quality.</h2>
          <p class="mb-8 text-gray-600">
            Our state-of-the-art manufacturing facility is equipped with advanced technology and strict quality control systems to ensure every drop of paint we produce meets international standards.
          </p>
          <button class="btn btn-outline btn-outline-red">
            Explore Manufacturing <span class="arrow text-red">→</span>
          </button>
        </div>
        <div class="mfg-right">
          <div class="mfg-images">
            <img src="/images/about-us-page/factory-tanks.png" alt="Factory Tanks" class="mfg-img large-img" />
            <div class="mfg-images-col">
              <img src="/images/about-us-page/production-line.png" alt="Production Line" class="mfg-img" />
              <img src="/images/about-us-page/lab-test.png" alt="Lab Testing" class="mfg-img" />
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Network Section -->
    <section class="network-section">
      <div class="network-bg">
        <img src="/images/about-us-page/truck.png" alt="Universal Paints Delivery Truck" />
        <div class="network-overlay"></div>
      </div>
      <div class="container network-grid">
        <div class="network-map-container">
          <img src="/images/srilanka-map.svg" alt="Sri Lanka Map" class="sl-map-image" />
          
          <!-- Pins for Provinces (Excluding North) -->
          <div class="map-pin" style="top: 35%; left: 52%; color: #E3000F;" title="North Central">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" /></svg>
          </div>
          <div class="map-pin" style="top: 48%; left: 32%; color: #F59E0B;" title="North Western">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" /></svg>
          </div>
          <div class="map-pin" style="top: 45%; left: 75%; color: #10B981;" title="Eastern">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" /></svg>
          </div>
          <div class="map-pin" style="top: 60%; left: 52%; color: #3B82F6;" title="Central">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" /></svg>
          </div>
          <div class="map-pin" style="top: 68%; left: 25%; color: #8B5CF6;" title="Western">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" /></svg>
          </div>
          <div class="map-pin" style="top: 75%; left: 38%; color: #EC4899;" title="Sabaragamuwa">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" /></svg>
          </div>
          <div class="map-pin" style="top: 70%; left: 65%; color: #14B8A6;" title="Uva">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" /></svg>
          </div>
          <div class="map-pin" style="top: 85%; left: 45%; color: #F97316;" title="Southern">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" /></svg>
          </div>
        </div>
        
        <div class="network-text">
          <div class="section-subtitle text-red text-xs font-bold uppercase mb-2">NATIONWIDE PRESENCE</div>
          <h2 class="section-title mb-6 text-3xl">Strong Network.<br/>Reliable Service.</h2>
          <p class="mb-6 text-gray-600">
            Our wide distribution network across the country ensures our products and services are always close to you.
          </p>
          <ul class="network-check-list mb-8">
            <li><span class="check-icon-green">✓</span> Islandwide distribution network</li>
            <li><span class="check-icon-green">✓</span> On-time delivery you can trust</li>
            <li><span class="check-icon-green">✓</span> Dedicated customer support</li>
            <li><span class="check-icon-green">✓</span> Growing stronger every day</li>
          </ul>
          <button class="btn btn-outline btn-outline-red">
            Find a Distributor <span class="arrow text-red">→</span>
          </button>
        </div>

        <!-- Empty column to reveal the full-bleed truck background -->
        <div class="network-empty"></div>
      </div>
    </section>


    <!-- Pre-Footer CTA -->
    <section class="pre-footer-cta">
      <div class="container cta-flex">
        <div class="cta-text-side">
          <h2>Let's Build a Colorful Future Together</h2>
          <p>Partner with Universal Paints for high quality, innovative and sustainable paint solutions.</p>
        </div>
        <div class="cta-btn-side">
          <NuxtLink to="/contact" class="btn btn-primary">
            Get In Touch <span class="arrow">→</span>
          </NuxtLink>
        </div>
      </div>
      <!-- Decorative color wave removed to fix build error -->
    </section>

  </div>
</template>

<script setup>
useHead({
  title: 'About Us - Universal Paints',
})
</script>

<style scoped>
/* Common Utility Classes */
.text-red { color: #E3000F; }
.text-orange { color: #F59E0B; }
.text-green { color: #10B981; }
.text-blue { color: #3B82F6; }
.text-purple { color: #8B5CF6; }

.bg-red-100 { background-color: #FEE2E2; }
.bg-orange-100 { background-color: #FEF3C7; }
.bg-green-100 { background-color: #D1FAE5; }
.bg-blue-100 { background-color: #DBEAFE; }
.bg-purple-100 { background-color: #EDE9FE; }

.mb-2 { margin-bottom: 8px; }
.mb-4 { margin-bottom: 16px; }
.mb-6 { margin-bottom: 24px; }
.mb-8 { margin-bottom: 32px; }
.mb-10 { margin-bottom: 40px; }
.text-xs { font-size: 12px; }
.text-sm { font-size: 14px; }
.text-3xl { font-size: 28px; font-weight: 800; line-height: 1.2; }
.font-bold { font-weight: 700; }
.uppercase { text-transform: uppercase; letter-spacing: 1px; }
.text-center { text-align: center; }
.text-gray-600 { color: #4B5563; line-height: 1.6; }

.btn {
  padding: 12px 24px;
  border-radius: 30px;
  font-weight: 600;
  font-size: 15px;
  text-decoration: none;
  transition: all 0.3s ease;
  display: inline-flex;
  align-items: center;
  cursor: pointer;
  border: none;
}
.btn-primary {
  background: linear-gradient(90deg, #E3000F 0%, #ff5e00 100%);
  color: white;
  box-shadow: 0 4px 6px rgba(227, 0, 15, 0.2);
}
.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 12px rgba(227, 0, 15, 0.3);
}
.btn-outline {
  background: transparent;
  border: 1px solid #ccc;
  color: #333;
}
.btn-outline-red {
  border-color: #fbcfe8;
  color: #E3000F;
}
.btn-outline-red:hover {
  background-color: #FEE2E2;
}
.btn-video {
  gap: 10px;
}
.play-icon {
  display: inline-flex;
  width: 20px;
  height: 20px;
  border-radius: 50%;
  border: 1px solid #E3000F;
  color: #E3000F;
  align-items: center;
  justify-content: center;
  font-size: 10px;
}
.arrow {
  margin-left: 8px;
}

.text-gradient-beautiful {
  background: linear-gradient(90deg, #E3000F 0%, #F59E0B 50%, #84CC16 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
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
.about-hero {
  position: relative;
  min-height: 500px;
  display: flex;
  align-items: center;
  padding: 100px 0 80px 0; /* Add top padding to account for header */
}
.hero-bg {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 1;
}
.hero-bg img {
  width: 100%;
  height: 100%;
  object-fit: contain; /* Prevents the image from being zoomed in */
  object-position: right center; /* Keeps it aligned to the right */
}
.hero-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(to right, rgba(255,255,255,1) 30%, rgba(255,255,255,0.85) 55%, rgba(255,255,255,0) 80%);
}
.hero-content {
  position: relative;
  z-index: 2;
  width: 100%;
}
.hero-left {
  max-width: 600px; /* Restrict width so it stays on the left */
}
.page-title {
  font-size: 54px;
  font-weight: 800;
  line-height: 1.1;
  color: #111;
  margin-bottom: 24px;
}
.hero-desc {
  font-size: 16px;
  color: #555;
  line-height: 1.6;
  margin-bottom: 32px;
  max-width: 90%;
}
.hero-buttons {
  display: flex;
  gap: 16px;
}

/* Stats Bar */
.stats-bar-section {
  padding: 0 0 80px 0;
}
.stats-bar {
  display: flex;
  justify-content: space-between;
  background: #F9FAFB;
  padding: 30px 40px;
  border-radius: 100px; /* Pill shape */
  align-items: center;
  box-shadow: 0 4px 6px rgba(0,0,0,0.02);
  border: 1px solid #F3F4F6;
}
.stat-item {
  display: flex;
  align-items: center;
  gap: 12px;
}
.stat-icon {
  font-size: 32px;
  line-height: 1;
}
.stat-icon svg {
  width: 36px;
  height: 36px;
}
.stat-text {
  display: flex;
  flex-direction: column;
}
.stat-num {
  font-size: 18px;
  font-weight: 800;
  color: #111;
  line-height: 1.1;
}
.stat-label {
  font-size: 13px;
  color: #666;
  font-weight: 500;
  line-height: 1.3;
}
.stat-divider {
  width: 1px;
  height: 40px;
  background-color: #E5E7EB;
}

/* Our Story Section */
.our-story-section {
  padding: 60px 0;
}
.story-grid {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  gap: 40px;
  align-items: center;
}
.story-left p {
  color: #4B5563;
  line-height: 1.6;
  font-size: 15px;
}
.story-img {
  width: 100%;
  height: 500px;
  border-radius: 20px;
  object-fit: cover;
  box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}
.trust-card {
  background: white;
  border-radius: 20px;
  box-shadow: 0 10px 40px rgba(0,0,0,0.08);
  overflow: hidden;
}
.trust-card-header {
  background-color: #0A192F;
  color: white;
  padding: 40px 30px 30px;
}
.trust-card-header h3 {
  font-size: 22px;
  font-weight: 700;
  line-height: 1.4;
  margin-bottom: 20px;
}
.header-line-accent {
  height: 3px;
  width: 50px;
  background: linear-gradient(90deg, #E3000F 0%, #F59E0B 33%, #3B82F6 66%, #10B981 100%);
  border-radius: 2px;
}
.trust-card-body {
  padding: 30px;
  background-color: white;
}
.trust-list {
  list-style: none;
  padding: 0;
  margin: 0;
}
.trust-list li {
  display: flex;
  align-items: flex-start;
  gap: 16px;
  margin-bottom: 24px;
  font-size: 14px;
  color: #111;
  font-weight: 600;
  line-height: 1.4;
}
.trust-list li:last-child {
  margin-bottom: 0;
}
.check-icon {
  display: inline-flex;
  width: 24px;
  height: 24px;
  border-radius: 50%;
  border: 1.5px solid #10B981;
  color: #10B981;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  margin-top: 2px;
}
.check-icon svg {
  width: 14px;
  height: 14px;
}

/* Our Values Section */
.values-section {
  padding: 80px 0;
  background-color: #FAFAFA;
}
.values-grid {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 20px;
}
.value-card {
  background: white;
  padding: 30px 20px;
  border-radius: 16px;
  text-align: center;
  box-shadow: 0 4px 6px rgba(0,0,0,0.02);
  border: 1px solid #F3F4F6;
  transition: transform 0.3s;
}
.value-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 15px rgba(0,0,0,0.05);
}
.value-icon-wrap {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  margin-bottom: 20px;
}
.value-icon-wrap svg {
  width: 32px;
  height: 32px;
}
.value-card h4 {
  font-size: 16px;
  font-weight: 700;
  color: #111;
  margin-bottom: 12px;
}
.value-card p {
  font-size: 13px;
  color: #666;
  line-height: 1.5;
}

/* Manufacturing Section */
.manufacturing-section {
  padding: 80px 0;
}
.mfg-grid {
  display: grid;
  grid-template-columns: 4fr 6fr;
  gap: 60px;
  align-items: center;
}
.mfg-images {
  display: flex;
  gap: 20px;
}
.large-img {
  width: 50%;
  border-radius: 16px;
  object-fit: cover;
}
.mfg-images-col {
  display: flex;
  flex-direction: column;
  gap: 20px;
  width: 50%;
}
.mfg-images-col img {
  width: 100%;
  border-radius: 16px;
  object-fit: cover;
  height: 100%;
}

/* Network Section */
.network-section {
  position: relative;
  padding: 80px 0;
  background-color: #FFFFFF;
  border-top: 1px solid #F3F4F6;
  border-bottom: 1px solid #F3F4F6;
  overflow: hidden;
}
.network-bg {
  position: absolute;
  top: 0;
  right: 0;
  width: 55%;
  height: 100%;
  z-index: 1;
}
.network-bg img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: left center;
}
.network-overlay {
  position: absolute;
  top: 0;
  left: -2px;
  width: 250px;
  height: 100%;
  background: linear-gradient(to right, #FFFFFF 0%, rgba(255,255,255,0) 100%);
}
.network-grid {
  position: relative;
  z-index: 2;
  display: grid;
  grid-template-columns: 1fr 1.2fr 1.5fr;
  gap: 40px;
  align-items: center;
}
.network-map-container {
  position: relative;
  width: 100%;
  max-width: 350px;
  margin: 0 auto;
}
.sl-map-image {
  width: 100%;
  height: auto;
  opacity: 0.8;
  filter: drop-shadow(0 10px 15px rgba(0,0,0,0.1));
}
.map-pin {
  position: absolute;
  transform: translate(-50%, -100%);
  width: 24px;
  height: 24px;
  animation: bounce 2s infinite;
}
.map-pin svg {
  width: 100%;
  height: 100%;
  fill: currentColor;
  filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));
}
@keyframes bounce {
  0%, 100% {
    transform: translate(-50%, -100%);
  }
  50% {
    transform: translate(-50%, calc(-100% - 5px));
  }
}
.network-check-list {
  list-style: none;
  padding: 0;
  margin: 0;
}
.network-check-list li {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 12px;
  font-size: 14px;
  color: #4B5563;
}
.check-icon-green {
  color: #10B981;
  font-weight: bold;
}



/* Pre-Footer CTA */
.pre-footer-cta {
  position: relative;
  padding: 60px 0 100px 0;
  background-color: white;
  text-align: center;
  overflow: hidden;
  margin-bottom: -20px; /* Slide under footer */
}
.cta-flex {
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: relative;
  z-index: 2;
  margin-bottom: 40px;
}
.cta-text-side {
  text-align: left;
}
.cta-text-side h2 {
  font-size: 32px;
  font-weight: 800;
  color: #111;
  margin-bottom: 12px;
}
.cta-text-side p {
  font-size: 16px;
  color: #666;
}
.cta-btn-side .btn-primary {
  padding: 14px 32px;
  font-size: 16px;
}
.cta-wave {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  z-index: 1;
}
.cta-wave img {
  width: 100%;
  display: block;
}

/* Responsive Overrides */
@media (max-width: 1024px) {
  .hero-container, .story-grid, .mfg-grid, .network-grid, .people-grid {
    grid-template-columns: 1fr;
  }
  .stats-bar {
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    border-radius: 20px;
  }
  .stat-divider { display: none; }
  .values-grid {
    grid-template-columns: repeat(2, 1fr);
  }
  .cta-flex {
    flex-direction: column;
    text-align: center;
    gap: 30px;
  }
  .cta-text-side {
    text-align: center;
  }
}
@media (max-width: 576px) {
  .values-grid {
    grid-template-columns: 1fr;
  }
  .page-title {
    font-size: 36px;
  }
  .certifications {
    flex-direction: column;
    align-items: center;
  }
}
</style>
