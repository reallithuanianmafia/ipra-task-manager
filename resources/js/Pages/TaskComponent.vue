<template>
  <div class="bg-blue-800 text-white py-4">
    <div class="container mx-auto px-4">
      
      <a href="/dashboard" class="text-center flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-15 ml-6" viewBox="0 6 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M12.707 12.293a1 1 0 0 1 0 1.414L9.414 17l3.293 3.293a1 1 0 0 1-1.414 1.414l-4-4a1 1 0 0 1 0-1.414l4-4a1 1 0 0 1 1.414 0z" clip-rule="evenodd" />
        </svg>
        <p>Back to Dashboard</p>
  
      </a>
      
    </div>
  </div>
  
  <div class="container mx-auto px-8 py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
      <div class="px-6 py-8">
        <!-- Editable title -->
        <div v-if="editMode" class="flex items-center justify-between text-sm text-gray-600 mb-4">
          <div class="font-semibold">
            <select v-model="editedItem.type" class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 transition duration-150 ease-in-out">
              <option :value="null" disabled>Select type</option>
              <option :value="'bug'" :selected="item.type === 'bug'">Bug</option>
              <option :value="'task'" :selected="item.type === 'task'">Task</option>
            </select>     
          </div>
          <div class="font-semibold">
            <select v-model="editedItem.status" class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 transition duration-150 ease-in-out">
              <option :value="null" disabled>Select status</option>
              <option value="pause" :selected="item.status === 'pause'">Pause</option>
              <option value="in_progress" :selected="item.status === 'in_progress'">In Progress</option>
              <option value="testing" :selected="item.status === 'testing'">Testing</option>
              <option value="release" :selected="item.status === 'release'">Release</option>
            </select>
                
          </div>
        </div>
        <div v-else>
          <span v-if="item.type === 'bug'" class="inline-block px-2 py-1 text-xs font-semibold leading-none text-red-800 bg-red-200 rounded-full mr-2">BUG</span>
        <span v-else-if="item.type === 'task'" class="inline-block px-2 py-1 text-xs font-semibold leading-none text-blue-800 bg-blue-200 rounded-full">TASK</span>
        </div>
        <h1 v-if="editMode" class="text-3xl font-semibold text-gray-800 mb-4">
          <input v-model="editedItem.title" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 transition duration-150 ease-in-out">
        </h1>
        <h1 v-else class="text-3xl font-semibold text-gray-800 mb-4">{{ item.title }}</h1>
        <div class="flex items-center justify-between text-sm text-gray-600 mb-4">
          <StatusCondition :status="item.status"></StatusCondition>
          <span>Created by <span class="font-semibold">{{ item.creator.name }}</span> on {{ formatDate(item.created_at) }}</span>
        </div>
          <div v-if="editMode" class="flex items-center justify-between text-sm text-gray-600 mb-4">
            <div class="font-semibold">Tester:
              <select v-model="editedItem.tester.id" class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 transition duration-150 ease-in-out">
                <option v-for="user in users" :key="user.id" :value="user.id" >{{ user.name }}</option>
              </select>
            </div>
            <div class="font-semibold">Assignee:
              <select v-model="editedItem.assignee.id" class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 transition duration-150 ease-in-out">
                <option v-for="user in users" :key="user.id" :value="user.id" :selected="user.id === item.assignee.id">{{ user.name }}</option>
              </select>
            </div>
          </div>
          <div v-else class="space-x-4">
            <span class="font-semibold">Tester:</span>
            <span>{{ item.tester.name }}</span>
            <span class="font-semibold">Assignee:</span>
            <span>{{ item.assignee.name }}</span>
          </div>


        <!-- Editable content -->
        <div class="border-t border-gray-200 pt-4">
          <p v-if="editMode" class="text-base text-gray-700">
            <textarea v-model="editedItem.content" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 transition duration-150 ease-in-out"></textarea>
          </p>
          <p v-else class="text-base text-gray-700">{{ item.content }}</p>
        </div>

        <!-- Edit button -->
        <button @click="toggleEditMode" class="mt-4 text-sm text-gray-600 underline">
          {{ editMode ? 'Cancel' : 'Edit' }}
        </button>        
        <!-- Save changes button -->
        <button v-if="editMode" @click="saveChanges" class="mt-4 ml-4 text-sm text-blue-500 underline">Save Changes</button>
      </div>
    </div>
  </div>

  

  <CommentSection :comments="comments" :taskId="item.id" :authenticatedUserId="authenticatedUserId.userId" @commentRemoved="handleCommentRemoved" />
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import axios from 'axios';
import StatusCondition from '@/Components/StatusCondition.vue';
import CommentSection from '@/Components/CommentSection.vue';

export default defineComponent({
  components: {
    StatusCondition,
    CommentSection
  },
  props: {
    item:{ Object} as () => any, // Define the type for item prop
    comments: Array as () => any[],
    authenticatedUserId: Number as () => number
  },
  data() {
    return {
      editMode: false,
      users: [],
      editedItem: {
        title: '',
        content: '',
        creator: '',
      } as any // Initialize editedItem object
    };
  },
  created() {
    this.fetchUsers();
    this.editedItem.tester = this.item.tester.id;
  },
  methods: {
    formatDate(date: string) {
      return new Date(date).toLocaleDateString();
    },
    toggleEditMode() {
      this.editedItem = { ...this.item }; // Reset editedItem when toggling edit mode
      this.editMode = !this.editMode;
    },
    saveChanges() {
      // Create a new object with updated properties
      const updatedItem = {
        title: this.editedItem.title,
        type: this.editedItem.type,
        content: this.editedItem.content,
        creator: this.editedItem.creator.id,
        tester: this.editedItem.tester.id,
        assignee: this.editedItem.assignee.id,
        status: this.editedItem.status
      };

      console.log(updatedItem);

      // Perform the API request to update the task
      axios.put(`/api/tasks/${this.item.id}`, updatedItem)
        .then(response => {
          // Update item properties with the response data
          this.item.title = response.data.title;
          this.item.content = response.data.content;
          this.item.tester = response.data.tester;
          this.item.assignee = response.data.assignee;
          this.item.type = response.data.type;
          this.item.status = response.data.status;
          // Exit edit mode
          this.editMode = false;
          console.log(response.data);
        })
        .catch(error => {
          console.error('Error updating task:', error);
          // Handle error
        });
    },
    fetchUsers() {
      axios.get('/api/users')
        .then(response => {
          this.users = response.data;
        })
        .catch(error => {
          console.error('Error fetching users:', error);
        });
    },
    handleCommentRemoved(commentId) {
  // Find the index of the comment with the specified ID
  const index = this.comments.findIndex(comment => comment.id === commentId);
  if (index !== -1) {
    // Remove the comment from the array using splice
    this.comments.splice(index, 1);
  }
}
  }
});
</script>

<style scoped>
.container {
  max-width: 800px;
}

.bg-white {
  background-color: #ffffff;
}

.rounded-lg {
  border-radius: 0.75rem;
}

.shadow-lg {
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}

.overflow-hidden {
  overflow: hidden;
}

.px-6 {
  padding-left: 1.5rem;
  padding-right: 1.5rem;
}

.py-8 {
  padding-top: 2rem;
  padding-bottom: 2rem;
}

.text-3xl {
  font-size: 1.875rem;
}

.font-semibold {
  font-weight: 600;
}

.text-gray-800 {
  color: #1f2937;
}

.mb-4 {
  margin-bottom: 1.5rem;
}

.flex {
  display: flex;
}

.items-center {
  align-items: center;
}

.justify-between {
  justify-content: space-between;
}

.text-sm {
  font-size: 0.875rem;
}

.text-gray-600 {
  color: #4b5563;
}

.text-blue-500 {
  color: #3b82f6;
}

.rounded-md {
  border-radius: 0.375rem;
}

.border-t {
  border-top-width: 1px;
}

.border-gray-200 {
  border-color: #e5e7eb;
}

.pt-4 {
  padding-top: 1rem;
}

.text-base {
  font-size: 1rem;
}

.text-gray-700 {
  color: #4a5568;
}
</style>
