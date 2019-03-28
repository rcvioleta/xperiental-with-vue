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
              <a class="nav-link" onclick="LevelsAdd()" href="#tab-6-3" data-toggle="tab" role="tab" aria-controls="tab-6-3" aria-selected="false">Student Levels</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" onclick="SystemAdd()" href="#tab-6-4" data-toggle="tab" role="tab" aria-controls="tab-6-4" aria-selected="false">System Users</a>
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
                    <table id="datatable-1" class="table table-datatable table-striped table-hover">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Parent Subject</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Classroom 1</td>
                          <td>Algebra</td>
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
                          <td>Classroom 2</td>
                          <td>Algebra</td>
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
                          <td>Classroom 3</td>
                          <td>Algebra</td>
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
                          <td>Classroom 1</td>
                          <td>Geometry</td>
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
                          <td>Classroom 2</td>
                          <td>Geometry</td>
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
            <div id="tab-6-3" class="row tab-pane fade show" role="tabpanel" aria-labelledby="tab-6-3">
              <div class="row">
                <div class="p-0 col-lg-12 pb-5">
                  <div class="table-responsive">
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
                          <td>Level 1</td>
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
                          <td>Level 2</td>
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
                          <td>Level 3</td>
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
                          <td>Level 4</td>
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
                          <td>Level 5</td>
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
                          <td>Level 6</td>
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
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <!-- <div class="card">
        <div class="card-header">
          <h4><strong>Add Subject</strong></h4>
        </div>
        <div class="card-body">
          <form class="needs-validation" novalidate>
            <div class="form-row">
              <div class="col-md-6 mb-3">
                <label for="validationCustom01">Subject Name</label>
                <input type="text" class="form-control" id="validationCustom01" placeholder="First name" value="Calculus" required>
                <div class="valid-feedback">
                  Looks good!
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="validationCustom02">Status</label>
                <div class="form-group">
                  <select class="form-control">
                    <option>Active</option>
                  </select>
                </div>
                <div class="valid-feedback">
                  Looks good!
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <button class="btn btn-primary pull-right" type="submit">Save Subject <i class="ml-2 batch-icon batch-icon-stiffy"></i></button>
              </div>
            </div>
          </form>
        </div>
      </div> -->
      <!-- DO NOT DELETE. THIS IS A CUSTOM VUE COMPONENT -->
      <subject-form></subject-form>
      <div class="card" id="classroom-add" style="display: none;">
        <div class="card-header">
          <h4><strong>Add Classroom</strong></h4>
        </div>
        <div class="card-body">
          <form class="needs-validation" novalidate>
            <div class="form-row">
              <div class="col-md-6 mb-3">
                <label for="validationCustom01">Classroom Name</label>
                <input type="text" class="form-control" id="validationCustom01" placeholder="Classroom" required>
                <div class="valid-feedback">
                  Looks good!
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="validationCustom02">Parent Subject</label>
                <div class="form-group">
                  <select class="form-control">
                    <option>Algebra</option>
                    <option>Geometry</option>
                  </select>
                </div>
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
                <button class="btn btn-primary pull-right" type="submit">Save Classroom <i class="ml-2 batch-icon batch-icon-stiffy"></i></button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="card" id="levels-add" style="display: none;">
        <div class="card-header">
          <h4><strong>Add Student Levels</strong></h4>
        </div>
        <div class="card-body">
          <form class="needs-validation" novalidate>
            <div class="form-row">
              <div class="col-md-6 mb-3">
                <label for="validationCustom01">Level Name</label>
                <input type="text" class="form-control" id="validationCustom01" placeholder="Level" required>
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
                <button class="btn btn-primary pull-right" type="submit">Save Level <i class="ml-2 batch-icon batch-icon-stiffy"></i></button>
              </div>
            </div>
          </form>
        </div>
      </div>
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