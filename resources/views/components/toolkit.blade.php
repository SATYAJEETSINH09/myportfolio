<!-- 04 / TOOLKIT SECTION (Categorized Horizontal Lists) -->
<section class="section" id="toolkit">
  <div class="container">
    <div class="section-label reveal-on-scroll">04 / TOOLKIT</div>
    <h2 class="section-title reveal-on-scroll">ENGINEERING TOOLKIT</h2>
    <p class="section-subtitle reveal-on-scroll">
      Technologies, frameworks, and developer tools utilized in my day-to-day production workflow.
    </p>

    <div class="toolkit-categories reveal-on-scroll delay-200">
      @if(isset($skills) && $skills->count() > 0)
        @php $catIndex = 1; @endphp
        @foreach($skills as $category => $items)
          <div class="toolkit-cat-group">
            <div class="toolkit-cat-title">0{{ $catIndex++ }} / {{ strtoupper($category) }}</div>
            <div class="toolkit-pill-grid">
              @foreach($items as $skill)
                <div class="tool-pill-item">
                  <div class="tool-pill-left">
                    <span class="tool-pill-icon">{{ $skill->icon ?? '⚡' }}</span>
                    <span class="tool-pill-name">{{ $skill->name }}</span>
                  </div>
                  <span class="tool-pill-desc">{{ $skill->badge ?? strtoupper($category) }}</span>
                </div>
              @endforeach
            </div>
          </div>
        @endforeach
      @else
        <!-- Static Fallback Grid -->
        <div class="toolkit-cat-group">
          <div class="toolkit-cat-title">01 / BACKEND</div>
          <div class="toolkit-pill-grid">
            <div class="tool-pill-item"><div class="tool-pill-left"><span class="tool-pill-icon">⚡</span><span class="tool-pill-name">Laravel</span></div><span class="tool-pill-desc">FRAMEWORK</span></div>
            <div class="tool-pill-item"><div class="tool-pill-left"><span class="tool-pill-icon">🐘</span><span class="tool-pill-name">PHP 8.x</span></div><span class="tool-pill-desc">LANGUAGE</span></div>
            <div class="tool-pill-item"><div class="tool-pill-left"><span class="tool-pill-icon">🗄️</span><span class="tool-pill-name">MySQL</span></div><span class="tool-pill-desc">DATABASE</span></div>
            <div class="tool-pill-item"><div class="tool-pill-left"><span class="tool-pill-icon">🔗</span><span class="tool-pill-name">REST API</span></div><span class="tool-pill-desc">ARCHITECTURE</span></div>
          </div>
        </div>
      @endif
    </div>
  </div>
</section>
