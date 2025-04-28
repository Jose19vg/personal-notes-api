<template>
  <div class="container">
    <h1>Notas Personales</h1>

    <!-- Formulario para crear o actualizar una nota -->
    <form @submit.prevent="isEditing ? updateNote() : createNote" class="note-form">
      <input type="text" v-model="newNote.title" placeholder="Título" required class="input-field" />
      <input type="text" v-model="newNote.author" placeholder="Autor" required class="input-field" />
      <input type="datetime-local" v-model="newNote.date_time" required class="input-field" />
      <textarea v-model="newNote.body" placeholder="Cuerpo de la nota" required class="input-field"></textarea>
      <input type="text" v-model="newNote.classification" placeholder="Clasificación" required class="input-field" />
      <button type="submit" class="submit-button">
        {{ isEditing ? 'Actualizar Nota' : 'Crear Nota' }}
      </button>
    </form>

    <!-- Mostrar notas -->
    <ul class="note-list">
      <li v-for="note in notes" :key="note.id" class="note-item">
        <h3>{{ note.title }}</h3>
        <p>{{ note.body }}</p>
        <div class="button-group">
          <button @click="editNote(note)" class="edit-button">Editar</button>
          <button @click="deleteNote(note.id)" class="delete-button">Eliminar</button>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'PersonalNotes',
  data() {
    return {
      notes: [],
      newNote: {
        title: '',
        author: '',
        date_time: '',
        body: '',
        classification: ''
      },
      isEditing: false, // Para controlar si estamos editando una nota
      currentNoteId: null // ID de la nota que se está editando
    };
  },
  methods: {
    async fetchNotes() {
      try {
        const response = await this.$axios.get('http://127.0.0.1:8000/api/notes');
        this.notes = response.data;
      } catch (error) {
        console.error('Error al obtener notas', error);
      }
    },
    async createNote() {
      try {
        const response = await this.$axios.post('http://127.0.0.1:8000/api/notes', this.newNote);
        this.notes.push(response.data);
        this.resetForm();
      } catch (error) {
        console.error('Error al crear la nota', error);
      }
    },
    async updateNote() {
      try {
        const response = await this.$axios.put(`http://127.0.0.1:8000/api/notes/${this.currentNoteId}`, this.newNote);
        const index = this.notes.findIndex(note => note.id === this.currentNoteId);
        this.$set(this.notes, index, response.data); // Actualiza la nota en el array
        this.resetForm();
        this.isEditing = false;
        this.currentNoteId = null;
      } catch (error) {
        console.error('Error al actualizar la nota', error);
      }
    },
    editNote(note) {
      this.newNote = { ...note };
      this.isEditing = true;
      this.currentNoteId = note.id;
    },
    async deleteNote(id) {
      try {
        await this.$axios.delete(`http://127.0.0.1:8000/api/notes/${id}`);
        this.notes = this.notes.filter(note => note.id !== id);
      } catch (error) {
        console.error('Error al eliminar la nota', error);
      }
    },
    resetForm() {
      this.newNote = { title: '', author: '', date_time: '', body: '', classification: '' };
    }
  },
  mounted() {
    this.fetchNotes();
  }
};
</script>

<style scoped>
/* Estilos generales */
.container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
  background-color: #f7f7f7;
  padding: 20px;
}

h1 {
  font-size: 2.5rem;
  color: #333;
  margin-bottom: 20px;
}

.note-form {
  background: #ffffff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 400px;
  margin-bottom: 30px;
}

.input-field {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #ddd;
  border-radius: 4px;
  box-sizing: border-box;
  font-size: 1rem;
  color: #333;
}

.input-field:focus {
  border-color: #4CAF50;
  outline: none;
}

.submit-button {
  width: 100%;
  padding: 12px;
  background-color: #4CAF50;
  border: none;
  border-radius: 4px;
  color: white;
  font-size: 1rem;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.submit-button:hover {
  background-color: #45a049;
}

.note-list {
  list-style: none;
  padding: 0;
  width: 100%;
  max-width: 500px;
}

.note-item {
  background: #fff;
  padding: 15px;
  margin-bottom: 10px;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.note-item h3 {
  margin: 0;
  color: #333;
}

.note-item p {
  color: #555;
}

.button-group {
  display: flex;
  gap: 10px; /* Añade espacio entre los botones */
}

.edit-button {
  background-color: #ffa500;
  color: white;
  padding: 6px 12px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  font-size: 0.9rem;
}

.edit-button:hover {
  background-color: #ff8c00;
}

.delete-button {
  background-color: #e57373;
  color: white;
  padding: 6px 12px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  font-size: 0.9rem;
}

.delete-button:hover {
  background-color: #f44336;
}
</style>
