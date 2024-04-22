<template>
  <div>
    <h1>Activity Logs</h1>
    <ul>
      <li v-for="log in logs" :key="log.id">
        <strong>{{ log.subject_type }} with ID: {{ log.subject_id }}</strong> {{ log.description }} <small>{{ formatDate(log.created_at) }}</small>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    logs: {
      type: Array,
      required: true,
    },
  },
  methods: {
    formatDate(dateString) {
      const options = { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' };
      return new Date(dateString).toLocaleDateString('en-US', options);
    },
  },
};
</script>
