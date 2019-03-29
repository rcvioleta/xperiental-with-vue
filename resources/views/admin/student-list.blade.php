@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-6">
      <h1>Add Student</h1>
    </div>
    <div class="col-md-6">
      <button class="btn btn-primary pull-right" type="submit" onclick="location.href='student-add.html';">Add New <i class="ml-2 batch-icon batch-icon-plus"></i></button>
    </div>
  </div>
  <div class="row mb-5">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12 pb-5">
              <!-- <h2>Student List</h2> -->
              <div class="table-responsive">
                <table id="datatable-1" class="table table-datatable table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Student List</th>
                      <th>Class</th>
                      <th>Used Credits</th>
                      <th>Unused Credits</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>John Doe</td>
                      <td>Math</td>
                      <td>12</td>
                      <td>4</td>
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Active
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Active</a>
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
                      <td>John Doe</td>
                      <td>Math</td>
                      <td>12</td>
                      <td>4</td>
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Active
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Active</a>
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
                      <td>John Doe</td>
                      <td>Math</td>
                      <td>12</td>
                      <td>4</td>
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Active
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Active</a>
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
                      <td>John Doe</td>
                      <td>Math</td>
                      <td>12</td>
                      <td>4</td>
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Active
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Active</a>
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
                      <td>John Doe</td>
                      <td>Math</td>
                      <td>12</td>
                      <td>4</td>
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Active
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Active</a>
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
                      <td>John Doe</td>
                      <td>Math</td>
                      <td>12</td>
                      <td>4</td>
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Active
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Active</a>
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
                      <td>John Doe</td>
                      <td>Math</td>
                      <td>12</td>
                      <td>4</td>
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Active
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Active</a>
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
                      <td>John Doe</td>
                      <td>Math</td>
                      <td>12</td>
                      <td>4</td>
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Active
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Active</a>
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
                      <td>John Doe</td>
                      <td>Math</td>
                      <td>12</td>
                      <td>4</td>
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Active
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Active</a>
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
                      <td>John Doe</td>
                      <td>Math</td>
                      <td>12</td>
                      <td>4</td>
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Active
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Active</a>
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
                      <td>John Doe</td>
                      <td>Math</td>
                      <td>12</td>
                      <td>4</td>
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Active
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Active</a>
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
                      <td>John Doe</td>
                      <td>Math</td>
                      <td>12</td>
                      <td>4</td>
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Active
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Active</a>
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
  <div class="row mb-5">
    <div class="col-md-12">
      <footer>
        <!-- Powered by - <a href="http://base5builder.com/?click_source=quillpro_footer_link" target="_blank" style="font-weight:300;color:#ffffff;background:#1d1d1d;padding:0 3px;">Base<span style="color:#ffa733;font-weight:bold">5</span>Builder</a> -->
      </footer>
    </div>
  </div>
@endsection