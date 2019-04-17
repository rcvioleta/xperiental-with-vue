<template>
  <div class="card" id="system-add" style="display: none;">
    <div class="card-header">
      <h4>
        <strong>Add System User</strong>
      </h4>
    </div>
    <div class="card-body">
      <form class="needs-validation" novalidate>
        <div class="form-row">
          <div class="col-md-12 mb-3">
            <label for="validationCustom01">Profile Name</label>
            <input
              type="text"
              class="form-control"
              id="validationCustom01"
              placeholder="Name"
              required
            >
            <div class="valid-feedback">Looks good!</div>
          </div>
          <div class="col-md-12 mb-3">
            <label for="validationCustom01">Email</label>
            <input
              type="text"
              class="form-control"
              id="validationCustom01"
              placeholder="Email"
              value
              required
            >
            <div class="valid-feedback">Looks good!</div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="validationCustom02">Status</label>
            <div class="form-group">
              <select class="form-control">
                <option>Active</option>
                <option>Inactive</option>
              </select>
            </div>
            <div class="valid-feedback">Looks good!</div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <button class="btn btn-primary pull-right" type="submit">
              Save User
              <i class="ml-2 batch-icon batch-icon-stiffy"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>
