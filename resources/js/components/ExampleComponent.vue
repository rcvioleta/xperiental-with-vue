<template>
  <div class="container" style="background-color: red">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Example Component</div>

          <div class="card-body">I'm an example component.</div>
          <div v-for="(fruit, index) in fruits" :key="index">
            <strong>{{ fruit }}</strong>
            <br>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      fruits: ["apple", "orange", "mango", "cherry", "banana"]
    };
  },
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
