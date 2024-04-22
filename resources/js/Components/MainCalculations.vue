<template>
    <main class="mt-6">
        <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
            <a href="#" id="docs-card" class="w-full flex flex-col gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                <div class="text-center text-md text-white font-extralight">Current Tasks and Bugs</div>
                <!-- Specific Task -->
                <div v-if="loading">Loading...</div>
                <a :href="getEndpointUrl(item.id)" v-for="(item, index) in taskBugList" :key="index" class="w-full flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                    <BugIcon v-if="item.type === 'bug'" />
                    <TaskIcon v-else-if="item.type === 'task'" />
                    <div class=""><StatusCondition :status="item.status"></StatusCondition>
                        <div class="pt-3 sm:pt-5">
                            <h2 class="text-xl font-semibold text-black dark:text-white">{{ item.title }}</h2>
                        </div>
                    </div>
                <div>
                    </div>
                </a>
            </a>

    <div class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
    <div class="pt-3 sm:pt-5 w-full">
    <div class="text-center text-md text-white font-extralight">New Task & Bug Section</div>
        <form @submit.prevent="handleSubmit" class="space-y-4">
            <div>
                <label for="title" class="text-center text-sm text-black dark:text-white/70">Title:</label>
                <input type="text" id="title" v-model="title" required placeholder="Enter title" class="w-full border-gray-300 dark:border-gray-700 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 rounded-md px-3 py-2 text-black dark:text-black">
            </div>
            <div>
                <label for="content" class="text-center text-sm text-black dark:text-white/70">Content:</label>
                <input type="text" id="content" v-model="content" required placeholder="Describe situation" class="w-full border-gray-300 dark:border-gray-700 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 rounded-md px-3 py-2 text-black dark:text-black">
            </div>
            <div>
                <label for="creator" class="text-center text-sm text-black dark:text-white/70">Creator:</label>
                <select id="creator" v-model="creator" required class="w-full border-gray-300 dark:border-gray-700 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 rounded-md px-3 py-2 text-black dark:text-black">
                    <option disabled selected value="">Please choose</option>
                    <option v-for="user in users" :value="user.id" :key="user.id">{{ user.name }}</option>
                </select>
            </div>
            <div>
                <label for="tester" class="text-center text-sm text-black dark:text-white/70">Tester:</label>
                <select id="tester" v-model="tester" required class="w-full border-gray-300 dark:border-gray-700 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 rounded-md px-3 py-2 text-black dark:text-black">
                    <option disabled selected value="">Please choose</option>
                    <option v-for="user in users" :value="user.id" :key="user.id">{{ user.name }}</option>
                </select>
            </div>
            <div>
                <label for="assignee" class="text-center text-sm text-black dark:text-white/70">Assignee:</label>
                <select id="assignee" v-model="assignee" required class="w-full border-gray-300 dark:border-gray-700 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 rounded-md px-3 py-2 text-black dark:text-black">
                    <option disabled selected value="">Please choose</option>
                    <option v-for="user in users" :value="user.id" :key="user.id">{{ user.name }}</option>
                </select>
            </div>
            <div>
                <label for="type" class="text-center text-sm text-black dark:text-white/70">Type:</label>
                <select id="type" v-model="type" required class="w-full border-gray-300 dark:border-gray-700 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 rounded-md px-3 py-2 text-black dark:text-black">
                    <option disabled selected value="">Please choose</option>
                    <option value="task">Task</option>
                    <option value="bug">Bug</option>
                </select>
            </div>
            <div>
                <label for="status" class="text-center text-sm text-black dark:text-white/70">Status:</label>
                <select id="status" v-model="status" required class="w-full border-gray-300 dark:border-gray-700 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 rounded-md px-3 py-2 text-black dark:text-black">
                    <option disabled selected value="">Please choose</option>
                    <option value="pause">Pause</option>
                    <option value="in_progress">In Progress</option>
                    <option value="testing">Testing</option>
                    <option value="release">Release</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-600 block w-full">Create</button>
        </form>
    </div>
</div>
        </div>
  </main>
</template>

<script>
import axios from 'axios';
import BugIcon from '@/Components/BugIcon.vue';
import TaskIcon from '@/Components/TaskIcon.vue';
import RightArrow from '@/Components/RightArrow.vue';
import StatusCondition from '@/Components/StatusCondition.vue';

export default {
    components: {
        BugIcon,
        TaskIcon,
        RightArrow,
        StatusCondition
  },
  data() {
    return {
      taskBugList: [],
      users: [],
      title: '',
      content: '',
      creator: '',
      tester: '',
      assignee: '',
      type: '',
      status: '',
      loading: false
    };
  },
  created() {
    this.fetchTasksAndBugs();
    this.fetchUsers();
  },
  methods: {
    getEndpointUrl(itemId) {
      return `/dashboard/tasks-and-bugs/${itemId}`;
    },
    fetchTasksAndBugs() {
      this.loading = true;
      axios.get('/api/tasks-and-bugs')
        .then(response => {
          this.taskBugList = response.data;
        })
        .catch(error => {
          console.error('Error fetching tasks and bugs:', error);
        })
        .finally(() => {
          this.loading = false;
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
    handleSubmit() {
      const formData = {
        title: this.title,
        content: this.content,
        creator: this.creator,
        tester: this.tester,
        type: this.type,
        assignee: this.assignee,
        status: this.status
      };

      axios.post('/api/tasks-and-bugs', formData)
        .then(response => {
          this.taskBugList.unshift(response.data);
          this.title = '';
          this.content = '';
          this.creator = '';
          this.tester = '';
          this.type = '';
          this.assignee = '';
          this.status = '';
        })
        .catch(error => {
          console.error('Error creating task or bug:', error);
          console.log(formData);
        });
    }
  }
}
</script>

<style scoped>
.left-side {
  padding: 20px;
}

.right-side {
  padding: 20px;
}
</style>
