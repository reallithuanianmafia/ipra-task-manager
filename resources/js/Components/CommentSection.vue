<template>
  <div class="container mx-auto px-4 py-8">
    <!-- Comments section -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8 p-6">
      <h2 class="text-2xl font-semibold text-gray-800 mb-6">Comments</h2>
      <transition-group name="fade-slide" tag="div" class="divide-y divide-gray-200">
        <div v-for="(comment, index) in comments" :key="index" class="py-4">
          <div v-if="comment.editMode">
            <textarea v-model="comment.editedText" class="form-textarea mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 transition duration-150 ease-in-out"></textarea>
            <div class="flex justify-end mt-2">
              <button @click="saveEditedComment(comment)" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">Save</button>
              <button @click="cancelEdit(comment)" class="ml-2 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-gray-700 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition duration-150 ease-in-out">Cancel</button>
            </div>
          </div>
          <div v-else>
            <p class="text-lg text-gray-700">{{ comment.text }}</p>
            <div class="text-sm text-gray-600 mt-2">Posted by <span class="font-semibold">{{ comment.user.name }}</span> on {{ formatDate(comment.created_at) }}</div>
            <!-- Show remove and edit buttons if comment belongs to authenticated user -->
            <div v-if="comment.user.id === authenticatedUserId" class="mt-2">
              <button @click="editComment(comment)" class="text-gray-500 hover:text-gray-700">Edit</button>
              <button @click="removeComment(comment.id)" class="ml-2 text-red-500 hover:text-red-700">Remove</button>
            </div>
          </div>
        </div>
      </transition-group>
    </div>

    <!-- Comment form section -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8 p-6">
      <h2 class="text-2xl font-semibold text-gray-800 mb-6">Add a Comment</h2>
      <form @submit.prevent="submitComment">
        <div class="mb-6">
          <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Comment:</label>
          <textarea id="comment" v-model="newComment" rows="3" class="form-textarea mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 transition duration-150 ease-in-out"></textarea>
        </div>
        <div class="flex justify-end">
          <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">Post Comment</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: {
    comments: {
      type: Array,
      default: () => []
    },
    taskId: Number,
    authenticatedUserId: Number
  },
  data() {
    return {
      newComment: ''
    };
  },
  methods: {
    submitComment() {
      if (this.newComment.trim() !== '') {
        axios.post('/api/comments', { text: this.newComment, task_id: this.taskId, user_id: 1 })
          .then(response => {
            this.comments.push(response.data);
            this.newComment = '';
          })
          .catch(error => {
            console.error('Error posting comment:', error);
          });
      }
    },
    removeComment(commentId) {
      axios.delete(`/api/comments/${commentId}`)
        .then(() => {
          // Emit an event to notify the parent component to update the comments prop
          this.$emit('commentRemoved', commentId);
        })
        .catch(error => {
          console.error('Error removing comment:', error);
        });
    },
    editComment(comment) {
      // Set edit mode to true and initialize edited text with current comment text
      comment.editMode = true;
      comment.editedText = comment.text;
    },
    saveEditedComment(comment) {
      // Update comment text with edited text
      comment.text = comment.editedText;
      // Send update request to the server if needed
      axios.put(`/api/comments/${comment.id}`, { text: comment.text })
        .then(() => {
          // Disable edit mode
          comment.editMode = false;
        })
        .catch(error => {
          console.error('Error updating comment:', error);
        });
    },
    cancelEdit(comment) {
      // Disable edit mode without saving changes
      comment.editMode = false;
    },
    formatDate(date) {
      return new Date(date).toLocaleDateString();
    }
  }
};
</script>

<style scoped>
.fade-slide-enter-active, .fade-slide-leave-active {
  transition: all 0.5s;
}
.fade-slide-enter, .fade-slide-leave-to {
  opacity: 0;
  transform: translateY(20px);
}
</style>
