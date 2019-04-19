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
              <a class="nav-link" href="#tab-6-3" data-toggle="tab" role="tab" aria-controls="tab-6-3" aria-selected="false">Enrollment History</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#tab-6-4" data-toggle="tab" role="tab" aria-controls="tab-6-4" aria-selected="false">Class History</a>
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
                <education-background-crud></education-background-crud>
              </div>
            </div>
            <div id="tab-6-3" class="row tab-pane fade" role="tabpanel" aria-labelledby="tab-6-3">
              <div class="col-lg-12 pb-5">
                <h2 class="pull-left">Enrollment History</h2>
                <form class="pull-left needs-validation" novalidate>
                  <div class="form-row">
                    <div class="col-md-12 mb-3">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>Enrollment Date</th>
                            <th>Regular Credits</th>
                            <th>Special Credits</th>
                            <th>Amount Paid</th>
                            <th>Amount Balance</th>
                            <th>Status</th>
                            <th>Remarks</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>04-02-2019</td>
                            <td>3</td>
                            <td>4</td>
                            <td>4,400</td>
                            <td>0</td>
                            <td>Fully Paid</td>
                            <td>Lorem Ipsum is simply dummy text</td>
                            <td>
                              <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                <button type="button" class="btn btn-danger"><i class="ml-2 batch-icon batch-icon-bin"></i></button>
                                <button type="button" class="btn btn-warning"><i class="ml-2 batch-icon batch-icon-pencil"></i></button>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>03-02-2019</td>
                            <td>3</td>
                            <td>4</td>
                            <td>1,200</td>
                            <td>3,200</td>
                            <td>Partial Paid</td>
                            <td>Lorem Ipsum is simply dummy text</td>
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
            <div id="tab-6-4" class="row tab-pane fade" role="tabpanel" aria-labelledby="tab-6-4">
              <div class="col-lg-12 pb-5">
                <h2 class="pull-left">Class Taken History</h2>
                <form class="pull-left needs-validation" novalidate>
                  <div class="form-row">
                    <div class="col-md-12 mb-3">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>Class Date</th>
                            <th>Class Time</th>
                            <th>Subject</th>
                            <th>Classroom</th>
                            <th>Class Type</th>
                            <th># of Student</th>
                            <th>Status</th>
                            <th>Remarks</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>04-02-2019</td>
                            <td>1:00 PM - 2:00 PM</td>
                            <td>Math</td>
                            <td>Room 1</td>
                            <td>Regular</td>
                            <td>1</td>
                            <td>Attended</td>
                            <td>Lorem Ipsum is simply dummy text</td>
                            <td>
                              <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                <button type="button" class="btn btn-danger"><i class="ml-2 batch-icon batch-icon-bin"></i></button>
                                <button type="button" class="btn btn-warning"><i class="ml-2 batch-icon batch-icon-pencil"></i></button>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>03-02-2019</td>
                            <td>2:00 PM - 3:00 PM</td>
                            <td>Math</td>
                            <td>Room 1</td>
                            <td>Special</td>
                            <td>2</td>
                            <td>Canceled</td>
                            <td>Lorem Ipsum is simply dummy text</td>
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
  <div class="row mb-5">
    <div class="col-md-12">
      <footer>
        <!-- Powered by - <a href="http://base5builder.com/?click_source=quillpro_footer_link" target="_blank" style="font-weight:300;color:#ffffff;background:#1d1d1d;padding:0 3px;">Base<span style="color:#ffa733;font-weight:bold">5</span>Builder</a> -->
      </footer>
    </div>
  </div>    
@endsection