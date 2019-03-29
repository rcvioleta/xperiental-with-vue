@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-6">
      <h1>Add Student</h1>
    </div>
    <add-student-button></add-student-button>
  </div>
  <div class="row mb-5">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <ul class="nav nav-tabs card-header-tabs" id="myTab-6" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" href="#tab-6-1" data-toggle="tab" role="tab" aria-controls="tab-6-1" aria-selected="true">Personal Information</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#tab-6-2" data-toggle="tab" role="tab" aria-controls="tab-6-2" aria-selected="false">Educational Background</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#tab-6-3" data-toggle="tab" role="tab" aria-controls="tab-6-3" aria-selected="false">Account Information</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content" id="myTabContent-6">
            <div id="tab-6-1" class="row tab-pane fade show active" role="tabpanel" aria-labelledby="tab-6-1">
              <div class="col-lg-12 pb-5">
                <h2>Student Information</h2>
                <personal-information-form></personal-information-form>
                {{-- <script>
                  // Example starter JavaScript for disabling form submissions if there are invalid fields
                  (function() {
                    'use strict';
                    window.addEventListener('load', function() {
                      // Fetch all the forms we want to apply custom Bootstrap validation styles to
                      var forms = document.getElementsByClassName('needs-validation');
                      // Loop over them and prevent submission
                      var validation = Array.prototype.filter.call(forms, function(form) {
                        form.addEventListener('submit', function(event) {
                          if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                          }
                          form.classList.add('was-validated');
                        }, false);
                      });
                  }, false);
                  })();
                </script> --}}
              </div>
              <hr>
              <br>
              <br>
              <div class="col-lg-12 pb-5">
                <h2>Emergency Contact</h2>
                <emergency-contact-form></emergency-contact-form>
                {{-- <script>
                  // Example starter JavaScript for disabling form submissions if there are invalid fields
                  (function() {
                    'use strict';
                    window.addEventListener('load', function() {
                      // Fetch all the forms we want to apply custom Bootstrap validation styles to
                      var forms = document.getElementsByClassName('needs-validation');
                      // Loop over them and prevent submission
                      var validation = Array.prototype.filter.call(forms, function(form) {
                        form.addEventListener('submit', function(event) {
                          if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                          }
                          form.classList.add('was-validated');
                        }, false);
                      });
                  }, false);
                  })();
                </script> --}}
              </div>
            </div>
            <div id="tab-6-2" class="row tab-pane fade" role="tabpanel" aria-labelledby="tab-6-2">
              <div class="col-lg-12 pb-5">
                <h2>Current School Information</h2>
                <educational-background-form></educational-background-form>
              </div>
              <hr>
              <br>
              <div class="col-lg-12 pb-5">
                <h2 class="pull-left">School Attended</h2><button class="btn btn-primary pull-right">Add History <i class="batch-icon batch-icon-plus"></i></button>
                <form class="pull-left needs-validation" novalidate>
                  <div class="form-row">
                    <div class="col-md-12 mb-3">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>School Name</th>
                            <th>Attended</th>
                            <th>Notes</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Stella Maris Academy</td>
                            <td>2008-2013</td>
                            <td>
                              Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            </td>
                            <td>
                              <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                <button type="button" class="btn btn-danger"><i class="ml-2 batch-icon batch-icon-bin"></i></button>
                                <button type="button" class="btn btn-warning"><i class="ml-2 batch-icon batch-icon-pencil"></i></button>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>University of the Immaculate ConceptionStella Maris Academy</td>
                            <td>2014-2017</td>
                            <td>
                              Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                            </td>
                            <td>
                              <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                <button type="button" class="btn btn-danger"><i class="ml-2 batch-icon batch-icon-bin"></i></button>
                                <button type="button" class="btn btn-warning"><i class="ml-2 batch-icon batch-icon-pencil"></i></button>
                              </div>
                            </td>
                          </tr>
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div id="tab-6-3" class="row tab-pane fade" role="tabpanel" aria-labelledby="tab-6-3">
              <div class="col-lg-12 pb-5">
                <h2>Account Details</h2>
                <form class="needs-validation" novalidate>
                  <div class="form-row">
                    <div class="col-md-3 mb-3">
                      <label for="validationCustom01">Started on</label>
                      <input type="text" class="form-control" id="validationCustom01" placeholder="School name" value="01/20/2019" required>
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="validationCustom02">Student ID</label>
                      <input type="text" class="form-control" id="validationCustom01" placeholder="School name" value="1001" required>
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                    </div>
                    <div class="col-md-2 mb-3">
                      <label for="validationCustom02">Credits Used</label>
                      <input type="text" class="form-control" id="validationCustom01" placeholder="School name" value="7" required>
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                    </div>
                    <div class="col-md-2 mb-3">
                      <label for="validationCustom02">Available Credits</label>
                      <input type="text" class="form-control" id="validationCustom01" placeholder="School name" value="3	" required>
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                    </div>
                    <div class="col-md-2 mb-3">
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
                </form>
              </div>
              <hr>
              <br>
              <div class="col-lg-12 pb-5">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Class Taken</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Credits History</a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <button class="btn btn-primary pull-right waves-effect waves-light" type="submit">Add New Class Record <i class="ml-2 batch-icon batch-icon-plus"></i></button>
                    <form class="pull-left needs-validation" novalidate>
                      <div class="form-row">
                        <div class="col-md-12 mb-3">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Date Added</th>
                                <th>Added By</th>
                                <th>Class</th>
                                <th>Credit Used</th>
                                <th>Notes</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>12/15/2018</td>
                                <td>Administrator</td>
                                <td>Algebra</td>
                                <td>2</td>
                                <td>
                                  Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                </td>
                                <td>
                                  <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                    <button type="button" class="btn btn-danger"><i class="ml-2 batch-icon batch-icon-bin"></i></button>
                                    <button type="button" class="btn btn-warning"><i class="ml-2 batch-icon batch-icon-pencil"></i></button>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>12/15/2018</td>
                                <td>Administrator</td>
                                <td>Geometry</td>
                                <td>2</td>
                                <td>
                                  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                </td>
                                <td>
                                  <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                    <button type="button" class="btn btn-danger"><i class="ml-2 batch-icon batch-icon-bin"></i></button>
                                    <button type="button" class="btn btn-warning"><i class="ml-2 batch-icon batch-icon-pencil"></i></button>
                                  </div>
                                </td>
                              </tr>
                              
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <button class="btn btn-primary pull-right waves-effect waves-light" type="submit">Add Student Credit Record <i class="ml-2 batch-icon batch-icon-plus"></i></button>
                    <form class="pull-left needs-validation" novalidate>
                      <div class="form-row">
                        <div class="col-md-12 mb-3">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Date Added</th>
                                <th>Added By</th>
                                <th>Credits Added</th>
                                <th>Notes</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>12/15/2018</td>
                                <td>Adminstrator</td>
                                <td>4</td>
                                <td>
                                  Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                </td>
                                <td>
                                  <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                    <button type="button" class="btn btn-danger"><i class="ml-2 batch-icon batch-icon-bin"></i></button>
                                    <button type="button" class="btn btn-warning"><i class="ml-2 batch-icon batch-icon-pencil"></i></button>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>01/10/2019</td>
                                <td>Adminstrator</td>
                                <td>3</td>
                                <td>
                                  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                </td>
                                <td>
                                  <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                    <button type="button" class="btn btn-danger"><i class="ml-2 batch-icon batch-icon-bin"></i></button>
                                    <button type="button" class="btn btn-warning"><i class="ml-2 batch-icon batch-icon-pencil"></i></button>
                                  </div>
                                </td>
                              </tr>
                              
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
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