<template>
  <div>
    <NavBar />
    <main>
      <RouterView />
    </main>
    <ChatWidget />
  </div>
</template>

<script setup>
import NavBar from './components/NavBar.vue'
import ChatWidget from './components/ChatWidget.vue'
</script>

<style scoped>
main { padding-bottom: 4rem; }
</style>
