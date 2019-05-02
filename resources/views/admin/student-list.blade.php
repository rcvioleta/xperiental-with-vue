@extends('layouts.app')

@section('styling')
  <link rel="stylesheet" href="{{ asset('assets/fonts/batch-icons/css/batch-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/fonts/line-awesome/css/line-awesome.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/mdb.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/custom-scrollbar/jquery.mCustomScrollbar.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/hamburgers/hamburgers.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/jvmaps/jqvmap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/quillpro/quillpro.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection

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

@section('scripts')
	<script src="{{ asset('assets/js/jquery/jquery-3.1.1.min.js') }}" defer></script>
	<script src="{{ asset('assets/js/bootstrap/popper.min.js') }}" defer></script>
	<script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}" defer></script>
	<script src="{{ asset('assets/js/bootstrap/mdb.min.js') }}" defer></script>
	<script src="{{ asset('assets/plugins/velocity/velocity.min.js') }}" defer></script>
	<script src="{{ asset('assets/plugins/velocity/velocity.ui.min.js') }}" defer></script>
	<script src="{{ asset('assets/plugins/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js') }}" defer></script>
	<script src="{{ asset('assets/plugins/jquery_visible/jquery.visible.min.js') }}" defer></script>
	<script src="{{ asset('assets/js/misc/ie10-viewport-bug-workaround.js') }}" defer></script>
	<script src="{{ asset('assets/js/misc/holder.min.js') }}" defer></script>
	<script src="{{ asset('assets/plugins/datatables/js/jquery.dataTables.min.js') }}" defer></script>
	<script src="{{ asset('assets/plugins/datatables/js/dataTables.bootstrap4.min.js') }}" defer></script>
	<script src="{{ asset('assets/plugins/datatables/js/dataTables.responsive.min.js') }}" defer></script>
	<script src="{{ asset('assets/js/scripts.js') }}" defer></script> 
@endsection