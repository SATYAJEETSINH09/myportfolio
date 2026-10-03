/**
 * CHATBOT.JS - AI Portfolio Floating Chat Assistant (SD ✦)
 * Frontend intelligence engine with natural keyword matching & mock reasoning.
 */

(function () {
  const triggerBtn = document.getElementById('ai-chat-trigger');
  const chatWindow = document.getElementById('ai-chat-window');
  const closeBtn = document.getElementById('ai-close-btn');
  const clearBtn = document.getElementById('ai-clear-btn');
  const messagesContainer = document.getElementById('ai-messages-container');
  const inputEl = document.getElementById('ai-chat-input');
  const sendBtn = document.getElementById('ai-send-btn');
  const quickChips = document.querySelectorAll('.ai-chip');

  if (!triggerBtn || !chatWindow || !messagesContainer) return;

  function toggleChat() {
    chatWindow.classList.toggle('open');
    if (chatWindow.classList.contains('open')) {
      inputEl.focus();
    }
  }

  function closeChat() {
    chatWindow.classList.remove('open');
  }

  function appendMessage(sender, text, isHtml = false) {
    const msgDiv = document.createElement('div');
    msgDiv.className = `ai-msg ${sender}`;

    const bubble = document.createElement('div');
    bubble.className = 'ai-msg-bubble';

    if (isHtml) {
      bubble.innerHTML = text;
    } else {
      bubble.innerText = text;
    }

    msgDiv.appendChild(bubble);
    messagesContainer.appendChild(msgDiv);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
  }

  function showTypingIndicator() {
    const typingDiv = document.createElement('div');
    typingDiv.id = 'ai-typing-indicator';
    typingDiv.className = 'ai-msg assistant';
    typingDiv.innerHTML = `
      <div class="typing-dots">
        <span class="typing-dot"></span>
        <span class="typing-dot"></span>
        <span class="typing-dot"></span>
      </div>
    `;
    messagesContainer.appendChild(typingDiv);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
  }

  function removeTypingIndicator() {
    const indicator = document.getElementById('ai-typing-indicator');
    if (indicator) {
      indicator.remove();
    }
  }

  function getAssistantResponse(userText) {
    const lower = userText.toLowerCase().trim();
    const knowledge = window.PORTFOLIO_DATA.chatbotKnowledge;

    for (let entry of knowledge) {
      for (let keyword of entry.keywords) {
        if (lower.includes(keyword)) {
          return entry.response;
        }
      }
    }

    return "Satyajeetsinh specializes in Laravel backend architecture, REST API design, database performance, and building production web applications. Would you like to check out his **Selected Projects**, **Technical Toolkit**, or **Get in Touch**?";
  }

  function handleUserSubmit(text) {
    const query = text || inputEl.value.trim();
    if (!query) return;

    appendMessage('user', query);
    inputEl.value = '';

    showTypingIndicator();

    setTimeout(() => {
      removeTypingIndicator();
      const rawResponse = getAssistantResponse(query);
      const formatted = rawResponse
        .replace(/\n\n/g, '<br><br>')
        .replace(/\n/g, '<br>')
        .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
      appendMessage('assistant', formatted, true);
    }, 600);
  }

  // Event Listeners
  triggerBtn.addEventListener('click', toggleChat);
  if (closeBtn) closeBtn.addEventListener('click', closeChat);

  if (clearBtn) {
    clearBtn.addEventListener('click', () => {
      messagesContainer.innerHTML = `
        <div class="ai-msg assistant">
          <div class="ai-msg-bubble">
            Chat cleared. How can I assist you with Satyajeetsinh's work?
          </div>
        </div>
      `;
    });
  }

  sendBtn.addEventListener('click', () => handleUserSubmit());
  inputEl.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') {
      handleUserSubmit();
    }
  });

  quickChips.forEach(chip => {
    chip.addEventListener('click', () => {
      const topic = chip.getAttribute('data-topic');
      handleUserSubmit(topic);
    });
  });
})();
