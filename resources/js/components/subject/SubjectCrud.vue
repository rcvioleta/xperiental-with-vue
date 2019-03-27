<template>
  <table id="datatable-1" class="table table-datatable table-striped table-hover">
    <thead>
      <tr>
        <th>Name</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Algebra</td>
        <td>
          <div class="btn-group">
            <button
              class="btn btn-primary btn-sm dropdown-toggle"
              type="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >Active</button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Inactive</a>
            </div>
          </div>
        </td>
        <td>
          <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
            <button type="button" class="btn btn-danger">Remove</button>
            <button type="button" class="btn btn-warning">Edit</button>
          </div>
        </td>
      </tr>
      <tr>
        <td>Geometry</td>
        <td>
          <div class="btn-group">
            <button
              class="btn btn-primary btn-sm dropdown-toggle"
              type="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >Active</button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Inactive</a>
            </div>
          </div>
        </td>
        <td>
          <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
            <button type="button" class="btn btn-danger">Remove</button>
            <button type="button" class="btn btn-warning">Edit</button>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {};
</script>

<style>
</style>
