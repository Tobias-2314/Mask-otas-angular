<template>
  <div class="chat-widget">
    <button class="chat-toggle" @click="open = !open">💬</button>

    <div v-if="open" class="chat-box card">
      <div class="chat-header">
        <span>Asistente Virtual</span>
        <button @click="open = false">✕</button>
      </div>
      <div class="chat-messages" ref="messagesEl">
        <div v-for="(msg, i) in messages" :key="i" :class="['msg', msg.from]">
          {{ msg.text }}
        </div>
      </div>
      <form class="chat-input" @submit.prevent="send">
        <input v-model="input" placeholder="Escribe aquí..." />
        <button type="submit" class="btn btn-primary btn-sm">Enviar</button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, nextTick } from 'vue'
import { enviarMensaje } from '../api/chat'

const open = ref(false)
const input = ref('')
const messages = ref([{ from: 'bot', text: '¡Hola! ¿En qué puedo ayudarte?' }])
const messagesEl = ref(null)

async function send() {
  const text = input.value.trim()
  if (!text) return
  messages.value.push({ from: 'user', text })
  input.value = ''
  try {
    const { data } = await enviarMensaje(text)
    messages.value.push({ from: 'bot', text: data.response })
  } catch {
    messages.value.push({ from: 'bot', text: 'Error al conectar.' })
  }
  await nextTick()
  if (messagesEl.value) messagesEl.value.scrollTop = messagesEl.value.scrollHeight
}
</script>

<style scoped>
.chat-widget { position: fixed; bottom: 1.5rem; right: 1.5rem; z-index: 200; }
.chat-toggle {
  width: 52px; height: 52px; border-radius: 50%;
  background: var(--primary); color: #fff; font-size: 1.4rem;
  border: none; cursor: pointer; box-shadow: 0 4px 12px rgba(0,0,0,.2);
}
.chat-box {
  position: absolute; bottom: 65px; right: 0;
  width: 320px; padding: 0; overflow: hidden;
}
.chat-header {
  display: flex; justify-content: space-between; align-items: center;
  padding: .75rem 1rem; background: var(--primary); color: #fff; font-weight: 600;
}
.chat-header button { background: none; border: none; color: #fff; cursor: pointer; font-size: 1rem; }
.chat-messages {
  height: 240px; overflow-y: auto; padding: 1rem;
  display: flex; flex-direction: column; gap: .5rem;
}
.msg {
  max-width: 80%; padding: .5rem .75rem; border-radius: 12px;
  font-size: .85rem; line-height: 1.4;
}
.msg.bot  { background: #f3f4f6; align-self: flex-start; }
.msg.user { background: var(--primary); color: #fff; align-self: flex-end; }
.chat-input { display: flex; gap: .5rem; padding: .75rem; border-top: 1px solid var(--border); }
.chat-input input {
  flex: 1; padding: .5rem .75rem; border: 1.5px solid var(--border);
  border-radius: 8px; font-size: .85rem;
}
.chat-input input:focus { outline: none; border-color: var(--primary); }
</style>
