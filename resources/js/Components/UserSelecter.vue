<template>
  <div>
    <select v-model="selectedUser" @change="emitSelectedUser" class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 transition duration-150 ease-in-out">
      <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
    </select>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: {
    value: Number // Define the prop for the v-model
  },
  data() {
    return {
      users: [],
      selectedUser: this.value // Initialize selectedUser with the prop value
    };
  },
  created() {
    this.fetchUsers();
  },
  methods: {
    fetchUsers() {
      axios.get('/api/users')
        .then(response => {
          this.users = response.data;
          // No need to set selectedUser here, it's already initialized with the prop value
        })
        .catch(error => {
          console.error('Error fetching users:', error);
        });
    },
    emitSelectedUser() {
      this.$emit('input', this.selectedUser); // Emit an event with the selected user ID
    }
  },
  watch: {
    value(newValue) {
      // Update selectedUser when the prop value changes
      this.selectedUser = newValue;
    }
  }
};
</script>
