<template>
    <form @submit.prevent="handleSubmit">
        <label>Title:</label>
        <input type="text" v-model="title" required>
        
        <label>Content:</label>
        <textarea v-model="content" required></textarea>
        
        <label>Creator:</label>
        <input type="text" v-model="creator" required>
        
        <label>Tester:</label>
        <input type="text" v-model="tester" required>
        
        <label>Assignee:</label>
        <input type="text" v-model="assignee" required>
        
        <label>Status:</label>
        <select v-model="status" required>
            <option value="pause">Pause</option>
            <option value="in_progress">In Progress</option>
            <option value="testing">Testing</option>
            <option value="release">Release</option>
        </select>
        
        <button type="submit">Submit</button>
    </form>
</template>

<script>
export default {
    data() {
        return {
            title: '',
            content: '',
            creator: '',
            tester: '',
            assignee: '',
            status: 'pause'
        };
    },
    methods: {
        handleSubmit() {
            const taskData = {
                title: this.title,
                content: this.content,
                creator: this.creator,
                tester: this.tester,
                assignee: this.assignee,
                status: this.status
            };

            // Call a method to handle form submission (e.g., submitTask(taskData))
            this.$emit('submit', taskData);
        }
    }
}
</script>
