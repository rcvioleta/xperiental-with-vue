<template>
  <div id="modal">
    <div class="backdrop" :class="active"></div>
    <div class="main-modal" :class="active">
      <div class="card">
        <div class="card-header">Edit: {{ name }}</div>
        <div class="card-body">
          <form @submit.prevent="updateFunc">
            <div class="form-group">
              <input type="hidden" name="slug" :value="slug">
              <label for="subject">Name</label>
              <input type="text" id="subject" name="name" class="form-control" :value="name">
            </div>
            <div class="form-group" v-if="rate">
              <label for="rate">Rate</label>
              <input type="number" id="rate" name="rate" class="form-control" :value="rate">
            </div>
            <div class="form-group">
              <label for="status">Status</label>
              <select name="status" id="status" class="form-control">
                <option :value="status ? 1 : 0">{{ status ? 'Active' : 'Inactive' }}</option>
                <option :value="status ? 0 : 1">{{ status ? 'Inactive' : 'Active' }}</option>
              </select>
            </div>
            <button class="btn btn-primary" type="submit">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["slug", "name", "status", "updateFunc", "active", "rate"]
};
</script>

<style>
.main-modal {
  position: fixed;
  top: 50%;
  left: 50%;
  width: 80%;
  transform: translate(-50%, -50%);
  z-index: 700;
  display: none;
}

.backdrop {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 600;
  background: rgba(0, 0, 0, 0.7);
  display: none;
}

.main-modal.in-use,
.backdrop.in-use {
  display: block;
}

@media (min-width: 48em) {
  .main-modal {
    width: 30%;
  }
}
</style>
