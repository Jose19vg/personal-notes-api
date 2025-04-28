<template>
  <div id="app">
    <PersonalNotes />
  </div>
</template>

<script>
import PersonalNotes from './components/PersonalNotes.vue'  // Aquí está el cambio

export default {
  name: 'App',
  components: {
    PersonalNotes  // Aquí también
  }
}
</script>
