<template>
  <span :class="getStatusColorClass(status)">
    <!-- Display the capitalized status -->
    <span>{{ capitalizeFirstLetter(status) }}</span>
  </span>
</template>

<script>
export default {
  props: {
    status: {
      type: String,
      required: true
    }
  },
  methods: {
    capitalizeFirstLetter(str) {
    // Remove underscores and capitalize the first letter of each word
    return str.replace(/_/g, ' ')
        .replace(/\b\w/g, function(char) {
            return char.toUpperCase();
    });
},
    getStatusColorClass(status) {
      // Determine and return the appropriate class based on the status
      switch (status) {
        case 'pause':
          return 'paused-color';
        case 'in_progress':
          return 'in-progress-color';
        case 'release':
          return 'release-color';
        case 'testing':
          return 'testing-color';
        default:
          return ''; // Default color class
      }
    }
  }
};
</script>

<style scoped>
.paused-color {
  background-color: yellow;
  color: black;
  font-weight: bold;
}

.in-progress-color {
  background-color: rgb(42 98 255);;
  color: white;
  font-weight: bold;
}

.release-color {
  background-color: green;
  color: black;
  font-weight: bold;
}

.testing-color {
  background-color: orange; /* Adjust as needed */
  color: black;
  font-weight: bold;
}
</style>
