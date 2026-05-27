<template>
  <div class="chat-widget">
    <button class="chat-toggle" @click="open = !open" :class="{ active: open }" aria-label="Chat">
      <span class="toggle-icon">
        <svg v-if="!open" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        <svg v-else width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </span>
    </button>

    <transition name="chat-pop">
      <div v-if="open" class="chat-box">
        <div class="chat-header">
          <div class="chat-header-left">
            <div class="chat-avatar">M</div>
            <div>
              <div class="chat-name">Asistente Maskotas</div>
              <div class="chat-status">
                <span class="status-dot"></span> En línea
              </div>
            </div>
          </div>
          <button class="chat-close" @click="open = false" aria-label="Cerrar">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
          </button>
        </div>

        <div class="chat-messages" ref="messagesEl">
          <div v-for="(msg, i) in messages" :key="i" :class="['msg', msg.from]">
            <div class="msg-bubble">{{ msg.text }}</div>
          </div>
        </div>

        <form class="chat-input" @submit.prevent="send">
          <input v-model="input" placeholder="Escribe tu pregunta…" autocomplete="off" />
          <button type="submit" class="send-btn" :disabled="!input.trim()">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
          </button>
        </form>
      </div>
    </transition>
  </div>
</template>

<script setup>
import { ref, nextTick } from 'vue'
import { enviarMensaje } from '../api/chat'

const open = ref(false)
const input = ref('')
const messages = ref([{ from: 'bot', text: '¡Hola! Soy el asistente de Maskotas. ¿En qué puedo ayudarte hoy?' }])
const messagesEl = ref(null)

async function send() {
  const text = input.value.trim()
  if (!text) return
  messages.value.push({ from: 'user', text })
  input.value = ''
  await nextTick()
  scrollBottom()
  try {
    const { data } = await enviarMensaje(text)
    messages.value.push({ from: 'bot', text: data.response })
  } catch {
    messages.value.push({ from: 'bot', text: 'Lo siento, no puedo responder ahora mismo.' })
  }
  await nextTick()
  scrollBottom()
}

function scrollBottom() {
  if (messagesEl.value) messagesEl.value.scrollTop = messagesEl.value.scrollHeight
}
</script>

<style scoped>
.chat-widget {
  position: fixed;
  bottom: 1.75rem;
  right: 1.75rem;
  z-index: 200;
}

.chat-toggle {
  width: 54px; height: 54px;
  border-radius: 50%;
  background: var(--forest);
  color: #fff;
  border: none;
  cursor: pointer;
  box-shadow: 0 4px 20px rgba(26,61,31,.45);
  display: flex; align-items: center; justify-content: center;
  transition: all 0.22s ease;
  position: relative;
  z-index: 1;
}
.chat-toggle:hover { transform: scale(1.06); background: var(--deep); }
.chat-toggle.active { background: var(--deep); }
.toggle-icon { display: flex; align-items: center; justify-content: center; }

.chat-box {
  position: absolute;
  bottom: 68px;
  right: 0;
  width: 340px;
  background: #fff;
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-lg);
  overflow: hidden;
  border: 1px solid var(--border);
}

.chat-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 1.1rem;
  background: var(--forest);
  color: #fff;
}
.chat-header-left { display: flex; align-items: center; gap: 0.65rem; }
.chat-avatar {
  width: 32px; height: 32px;
  border-radius: 50%;
  background: rgba(255,255,255,.2);
  display: flex; align-items: center; justify-content: center;
  font-family: 'Cormorant Garamond', serif;
  font-size: 1.1rem;
  font-weight: 600;
  color: var(--gold-light);
}
.chat-name {
  font-size: 0.85rem;
  font-weight: 700;
  line-height: 1.2;
}
.chat-status {
  font-size: 0.7rem;
  color: rgba(255,255,255,.7);
  display: flex;
  align-items: center;
  gap: 0.3rem;
}
.status-dot {
  width: 6px; height: 6px;
  border-radius: 50%;
  background: #4ade80;
  display: inline-block;
}
.chat-close {
  background: none;
  border: none;
  color: rgba(255,255,255,.7);
  cursor: pointer;
  display: flex; align-items: center;
  transition: color 0.15s;
  padding: 0.2rem;
}
.chat-close:hover { color: #fff; }

.chat-messages {
  height: 260px;
  overflow-y: auto;
  padding: 1rem;
  display: flex;
  flex-direction: column;
  gap: 0.6rem;
  background: var(--cream);
}
.chat-messages::-webkit-scrollbar { width: 4px; }
.chat-messages::-webkit-scrollbar-track { background: transparent; }
.chat-messages::-webkit-scrollbar-thumb { background: var(--border); border-radius: 2px; }

.msg { display: flex; }
.msg.bot { justify-content: flex-start; }
.msg.user { justify-content: flex-end; }

.msg-bubble {
  max-width: 82%;
  padding: 0.6rem 0.9rem;
  border-radius: 16px;
  font-size: 0.85rem;
  line-height: 1.5;
}
.msg.bot .msg-bubble {
  background: #fff;
  color: var(--text);
  border: 1px solid var(--border);
  border-bottom-left-radius: 4px;
}
.msg.user .msg-bubble {
  background: var(--forest);
  color: #fff;
  border-bottom-right-radius: 4px;
}

.chat-input {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.75rem 1rem;
  border-top: 1px solid var(--border);
  background: #fff;
}
.chat-input input {
  flex: 1;
  padding: 0.55rem 0.85rem;
  border: 1.5px solid var(--border);
  border-radius: 9999px;
  font-size: 0.85rem;
  font-family: 'Plus Jakarta Sans', sans-serif;
  background: var(--cream);
  color: var(--text);
  transition: border-color 0.18s;
}
.chat-input input:focus {
  outline: none;
  border-color: var(--sage);
  background: #fff;
}
.send-btn {
  width: 34px; height: 34px;
  border-radius: 50%;
  background: var(--forest);
  color: #fff;
  border: none;
  cursor: pointer;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
  transition: background 0.18s, transform 0.18s;
}
.send-btn:hover:not(:disabled) { background: var(--deep); transform: scale(1.06); }
.send-btn:disabled { opacity: 0.4; cursor: not-allowed; }

.chat-pop-enter-active,
.chat-pop-leave-active { transition: opacity 0.2s ease, transform 0.2s ease; }
.chat-pop-enter-from,
.chat-pop-leave-to { opacity: 0; transform: translateY(12px) scale(0.97); }
</style>
