<!-- Floating AI Portfolio Assistant (SD ✦) -->
<div class="ai-assistant-widget" id="ai-assistant-widget">
  <button class="ai-assistant-trigger" id="ai-chat-trigger" aria-label="Open AI Portfolio Assistant">
    <span>SD</span> <span class="ai-sparkle">✦</span>
  </button>
</div>

<!-- AI Chat Window -->
<div class="ai-chat-window" id="ai-chat-window" role="dialog" aria-modal="false" aria-label="AI Portfolio Assistant Window">
  <div class="ai-chat-header">
    <div class="ai-chat-title">
      <span>SD. Assistant</span>
      <span class="status-dot-pulse"></span>
    </div>
    <div class="ai-chat-actions">
      <button class="ai-btn-icon" id="ai-clear-btn" title="Clear Chat" aria-label="Clear chat">⟲</button>
      <button class="ai-btn-icon" id="ai-close-btn" title="Close" aria-label="Close assistant">✕</button>
    </div>
  </div>

  <div class="ai-chat-messages" id="ai-messages-container">
    <div class="ai-msg assistant">
      <div class="ai-msg-bubble">
        Hi 👋 I'm Satyajeetsinh's portfolio assistant.<br><br>
        Ask me about his <strong>Laravel projects</strong>, <strong>technical skills</strong>, <strong>experience</strong>, or <strong>availability</strong>.
      </div>
    </div>
    <div class="ai-quick-actions">
      <button class="ai-chip" data-topic="Tell me about your projects">Projects</button>
      <button class="ai-chip" data-topic="What technologies do you use?">Skills</button>
      <button class="ai-chip" data-topic="Tell me about your experience at Binstellar">Experience</button>
      <button class="ai-chip" data-topic="How can I contact Satyajeetsinh?">Contact</button>
    </div>
  </div>

  <div class="ai-chat-input-area">
    <input type="text" class="ai-chat-input" id="ai-chat-input" placeholder="Ask anything about Satyajeetsinh..." aria-label="Message to assistant">
    <button class="ai-send-btn" id="ai-send-btn" aria-label="Send Message">↑</button>
  </div>
</div>
