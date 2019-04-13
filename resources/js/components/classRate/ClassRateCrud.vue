<template>
  <div id="class-rate">
    <table id="datatable-1" class="table table-datatable table-striped table-hover">
      <thead>
        <tr>
          <th>Name</th>
          <th>Rate</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Regular</td>
          <td>400</td>
          <td>
            <div class="btn-group">
              <select class="btn btn-primary btn-sm dropdown-toggle">
                <option>Active</option>
                <option>Inactive</option>
              </select>
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
          <td>Special</td>
          <td>800</td>
          <td>
            <div class="btn-group">
              <select class="btn btn-primary btn-sm dropdown-toggle">
                <option>Active</option>
                <option>Inactive</option>
              </select>
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
  
</div>
</template>

<script>
  import { EventBus } from "../../app.js";
  import Model from "../../helpers/Model.js";
  import Modal from "../ui/modal/Modal.vue";

  export default {

  };
</script>
<style>
</style>
