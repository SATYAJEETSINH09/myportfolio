<!-- 06 / SERVICES SECTION (High Contrast Invert Cards) -->
<section class="section" id="services">
  <div class="container">
    <div class="section-label reveal-on-scroll">06 / SERVICES</div>
    <h2 class="section-title reveal-on-scroll">WHAT I OFFER</h2>
    <p class="section-subtitle reveal-on-scroll">
      Comprehensive backend and web development solutions for startups, enterprises, and agencies.
    </p>

    <div class="services-grid reveal-on-scroll delay-200">
      @if(isset($services) && $services->count() > 0)
        @foreach($services as $srv)
          <div class="service-card" onclick="document.getElementById('contact').scrollIntoView({behavior:'smooth'})">
            <div class="service-top">
              <span class="service-num">{{ $srv->number }}</span>
              <span class="service-cta">INQUIRE <span class="btn-arrow">↗</span></span>
            </div>
            <div>
              <h3 class="service-title">{{ $srv->title }}</h3>
              <p class="service-desc">
                {{ $srv->description }}
              </p>
            </div>
          </div>
        @endforeach
      @else
        <div class="service-card" onclick="document.getElementById('contact').scrollIntoView({behavior:'smooth'})">
          <div class="service-top"><span class="service-num">01</span><span class="service-cta">INQUIRE <span class="btn-arrow">↗</span></span></div>
          <div><h3 class="service-title">Backend Development</h3><p class="service-desc">Scalable server-side systems engineered with clean Laravel architectures.</p></div>
        </div>
      @endif
    </div>
  </div>
</section>
