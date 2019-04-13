@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-6">
      <h1>Configurations</h1>
    </div>
  </div>
  <div class="row mb-5">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <ul class="nav nav-tabs card-header-tabs" id="myTab-6" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" onclick="SubjectAdd()" href="#tab-6-1" data-toggle="tab" role="tab" aria-controls="tab-6-1" aria-selected="true">Subjects</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" onclick="ClassroomAdd()" href="#tab-6-2" data-toggle="tab" role="tab" aria-controls="tab-6-2" aria-selected="false">Classrooms</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" onclick="LevelsAdd()" href="#tab-6-3" data-toggle="tab" role="tab" aria-controls="tab-6-3" aria-selected="false">Grade Level</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" onclick="SystemAdd()" href="#tab-6-4" data-toggle="tab" role="tab" aria-controls="tab-6-4" aria-selected="false">System Users</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" onclick="ClassRateAdd()" href="#tab-6-5" data-toggle="tab" role="tab" aria-controls="tab-6-5" aria-selected="false">Class Rate</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div id="tab-6-1" class="row tab-pane fade show active" role="tabpanel" aria-labelledby="tab-6-1">
              <div class="row">
                <div class="p-0 col-lg-12 pb-5">
                  <div class="table-responsive">
                    <!-- DO NOT DELETE. THIS IS A CUSTOM VUE COMPONENT -->
                    <subject-crud></subject-crud>
                  </div>
                </div>
              </div>
            </div>
            <div id="tab-6-2" class="row tab-pane fade show" role="tabpanel" aria-labelledby="tab-6-2">
              <div class="row">
                <div class="p-0 col-lg-12 pb-5">
                  <div class="table-responsive">
                    <classroom-crud></classroom-crud>
                  </div>
                </div>
              </div>
            </div>
            <div id="tab-6-3" class="row tab-pane fade show" role="tabpanel" aria-labelledby="tab-6-3">
              <div class="row">
                <div class="p-0 col-lg-12 pb-5">
                  <div class="table-responsive">
                    <student-level-crud></student-level-crud>
                  </div>
                </div>
              </div>
            </div>
            <div id="tab-6-4" class="row tab-pane fade show" role="tabpanel" aria-labelledby="tab-6-4">
              <div class="row">
                <div class="p-0 col-lg-12 pb-5">
                  <div class="table-responsive">
                    <table id="datatable-1" class="table table-datatable table-striped table-hover">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>John Doe</td>
                          <td>admin@example.com</td>
                          <td>
                            <div class="btn-group">
                              <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Active
                              </button>
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
                          <td>Jomar Enrico</td>
                          <td>jomxenri2@gmail.com</td>
                          <td>
                            <div class="btn-group">
                              <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Active
                              </button>
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
                  </div>
                </div>
              </div>
            </div>
            <div id="tab-6-5" class="row tab-pane fade show" role="tabpanel" aria-labelledby="tab-6-5">
              <div class="row">
                <div class="p-0 col-lg-12 pb-5">
                  <div class="table-responsive">
                    <class-rate-crud></class-rate-crud>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <!-- DO NOT DELETE. THIS IS A CUSTOM VUE COMPONENT -->
      <subject-form></subject-form>
      <classroom-form></classroom-form>
      <level-form></level-form>
      <class-rate-form></class-rate-form>
      <div class="card" id="system-add" style="display: none;">
        <div class="card-header">
          <h4><strong>Add System User</strong></h4>
        </div>
        <div class="card-body">
          <form class="needs-validation" novalidate>
            <div class="form-row">
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">Profile Name</label>
                <input type="text" class="form-control" id="validationCustom01" placeholder="Name" required>
                <div class="valid-feedback">
                  Looks good!
                </div>
              </div>
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">Email</label>
                <input type="text" class="form-control" id="validationCustom01" placeholder="Email" value="" required>
                <div class="valid-feedback">
                  Looks good!
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="validationCustom02">Status</label>
                <div class="form-group">
                  <select class="form-control">
                    <option>Active</option>
                    <option>Inactive</option>
                  </select>
                </div>
                <div class="valid-feedback">
                  Looks good!
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <button class="btn btn-primary pull-right" type="submit">Save User <i class="ml-2 batch-icon batch-icon-stiffy"></i></button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row mb-5">
    <div class="col-md-12">
      <footer>
        <!-- Powered by - <a href="http://base5builder.com/?click_source=quillpro_footer_link" target="_blank" style="font-weight:300;color:#ffffff;background:#1d1d1d;padding:0 3px;">Base<span style="color:#ffa733;font-weight:bold">5</span>Builder</a> -->
      </footer>
    </div>
  </div>
@endsection