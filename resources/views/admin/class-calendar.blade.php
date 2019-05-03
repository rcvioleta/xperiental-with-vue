@extends('layouts.app')

@section('styling')
  <link rel="stylesheet" href="{{ asset('assets/fonts/batch-icons/css/batch-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/fonts/line-awesome/css/line-awesome.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/mdb.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/custom-scrollbar/jquery.mCustomScrollbar.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/hamburgers/hamburgers.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/fullcalendar/lib/fullcalendar.min.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/plugins/fullcalendar/lib/fullcalendar.print.min.css') }}" media='print' />
  <link rel="stylesheet" href="{{ asset('assets/plugins/fullcalendar/scheduler.min.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/plugins/jvmaps/jqvmap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/quillpro/quillpro.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h1>Class Calendar</h1>
        </div>
        <div class="col-md-6">
            <button class="btn btn-primary pull-right" type="button" data-toggle="modal" data-target="#exampleModal">Add New Schedule<i class="ml-2 batch-icon batch-icon-plus"></i></button>	
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="card">
                                <div class="card-header">
                                    Add New Schedule
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <div class="progress">
                                        <div id="progress-div" class="progress-bar progress-bar-sm bg-gradient" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="card-form-wizard">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div id="rootwizard-1">
                                                <ul class="nav nav-pills wizard-header">
                                                    <li>
                                                        <a href="#tab1" data-toggle="tab">
                                                            <!-- <span class="main-text">
                                                                <span class="h3">Student Search</span>
                                                                <small></small>
                                                            </span> -->
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab2" data-toggle="tab">
                                                            <!-- <span class="main-text">
                                                                <span class="h3">Class Details</span>
                                                                <small></small>
                                                            </span> -->
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content clearfix">
                                                    <div class="p-0 tab-pane" id="tab1">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <!-- <form method="post" id="wizard-stage-1">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Username</label>
                                                                        <input type="text" class="form-control wizard-stage-1-username" name="username" />
                                                                    </div>
                                                                </form> -->
                                                                <div class="table-responsive">
                                                                    <table id="datatable-sched" class="table table-datatable table-striped table-hover" data-page-length="5" data-order="false" data-sort="false" data-length-change="false" data-info="false">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>ID</th>
                                                                                <th>Student List</th>
                                                                                <th>Action</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>1001</td>
                                                                                <td>Jane Smith</td>
                                                                                <td>
                                                                                    <div class="pager wizard">
                                                                                        <li class="next">
                                                                                            <button type="button" class="btn btn-primary btn-sm" href="#">
                                                                                                Select
                                                                                            </button>
                                                                                        </li>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>1002</td>
                                                                                <td>Jane Smith</td>
                                                                                <td>
                                                                                    <div class="pager wizard">
                                                                                        <li class="next">
                                                                                            <button type="button" class="btn btn-primary btn-sm" href="#">
                                                                                                Select
                                                                                            </button>
                                                                                        </li>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>1002</td>
                                                                                <td>Jane Smith</td>
                                                                                <td>
                                                                                    <div class="pager wizard">
                                                                                        <li class="next">
                                                                                            <button type="button" class="btn btn-primary btn-sm" href="#">
                                                                                                Select
                                                                                            </button>
                                                                                        </li>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>1003</td>
                                                                                <td>Jane Smith</td>
                                                                                <td>
                                                                                    <div class="pager wizard">
                                                                                        <li class="next">
                                                                                            <button type="button" class="btn btn-primary btn-sm" href="#">
                                                                                                Select
                                                                                            </button>
                                                                                        </li>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>1004</td>
                                                                                <td>Jane Smith</td>
                                                                                <td>
                                                                                    <div class="pager wizard">
                                                                                        <li class="next">
                                                                                            <button type="button" class="btn btn-primary btn-sm" href="#">
                                                                                                Select
                                                                                            </button>
                                                                                        </li>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>1005</td>
                                                                                <td>Jane Smith</td>
                                                                                <td>
                                                                                    <div class="pager wizard">
                                                                                        <li class="next">
                                                                                            <button type="button" class="btn btn-primary btn-sm" href="#">
                                                                                                Select
                                                                                            </button>
                                                                                        </li>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>1006</td>
                                                                                <td>Jane Smith</td>
                                                                                <td>
                                                                                    <div class="pager wizard">
                                                                                        <li class="next">
                                                                                            <button type="button" class="btn btn-primary btn-sm" href="#">
                                                                                                Select
                                                                                            </button>
                                                                                        </li>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>1001</td>
                                                                                <td>Jane Smith</td>
                                                                                <td>
                                                                                    <div class="pager wizard">
                                                                                        <li class="next">
                                                                                            <button type="button" class="btn btn-primary btn-sm" href="#">
                                                                                                Select
                                                                                            </button>
                                                                                        </li>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>1001</td>
                                                                                <td>Jane Smith</td>
                                                                                <td>
                                                                                    <div class="pager wizard">
                                                                                        <li class="next">
                                                                                            <button type="button" class="btn btn-primary btn-sm" href="#">
                                                                                                Select
                                                                                            </button>
                                                                                        </li>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>1001</td>
                                                                                <td>Jane Smith</td>
                                                                                <td>
                                                                                    <div class="pager wizard">
                                                                                        <li class="next">
                                                                                            <button type="button" class="btn btn-primary btn-sm" href="#">
                                                                                                Select
                                                                                            </button>
                                                                                        </li>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>1001</td>
                                                                                <td>Jane Smith</td>
                                                                                <td>
                                                                                    <div class="pager wizard">
                                                                                        <li class="next">
                                                                                            <button type="button" class="btn btn-primary btn-sm" href="#">
                                                                                                Select
                                                                                            </button>
                                                                                        </li>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="p-0 tab-pane" id="tab2">
                                                        <div class="form-wizard-review-block">
                                                            <div class="row pb-2">
                                                                <div class="col-md-6">
                                                                    <p><strong>Student ID:</strong></p>
                                                                    <p>1001</p>
                                                                    <p><strong>Student Name:</strong></p>
                                                                    <p>John Doe</p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p><strong>Student Status:</strong></p>
                                                                    <p>Active</p>
                                                                    <p><strong>Available Credits:</strong></p>
                                                                    <p>7</p>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <form class="needs-validation" novalidate>
                                                                <div class="form-row pt-3">
                                                                    <div class="col-md-4 mb-3">
                                                                        <label for="validationCustom04"><strong>Class Date</strong></label>
                                                                        <input type="text" class="fallback form-control" autocomplete="off" placeholder="DD/MM/YYYY">
                                                                        <div class="invalid-feedback">
                                                                            Please provide a valid state.
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 mb-3">
                                                                        <label for="validationCustom04"><strong>Start Time</strong></label>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text" id="inputGroupPrepend-1">
                                                                                    <i class="batch-icon batch-icon-clock"></i>
                                                                                </span>
                                                                            </div>
                                                                            <input type="text" class="time form-control" id="hour-field" placeholder="HH:mm:SS" aria-describedby="inputGroupPrepend-1" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 mb-3">
                                                                        <label for="validationCustom04"><strong>End Time</strong></label>
                                                                        <div class="input-group">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text" id="inputGroupPrepend-1">
                                                                                        <i class="batch-icon batch-icon-clock"></i>
                                                                                    </span>
                                                                                </div>
                                                                                <input type="text" class="time form-control" id="hour-field" placeholder="HH:mm:SS" aria-describedby="inputGroupPrepend-1" required>
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="col-md-6 mb-3">
                                                                        <label for="validationCustom02"><strong>Subject</strong></label>
                                                                        <div class="form-group">
                                                                            <select class="form-control">
                                                                                <option>Algebra</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="valid-feedback">
                                                                            Looks good!
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 mb-3">
                                                                        <label for="validationCustom02"><strong>Classroom</strong></label>
                                                                        <div class="form-group">
                                                                            <select class="form-control">
                                                                                <option>Classroom 1</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="valid-feedback">
                                                                            Looks good!
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="col-md-4 mb-3">
                                                                        <label><strong>Credits to use</strong></label>
                                                                        <div class="form-group">
                                                                            <select class="form-control">
                                                                                <option>1</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="valid-feedback">
                                                                            Looks good!
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2 mb-3">
                                                                        <label for="validationCustom02"><strong>Color</strong></label>
                                                                        <div class="input-group-append">
                                                                            <button type="button" class="m-0 btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <i class="batch-icon batch-icon-droplet"></i>
                                                                                <span class="sr-only">Toggle Color Dropdown</span>
                                                                            </button>
                                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                                <li class="dropdown-item legend-block-item">
                                                                                    <div class="legend-block-color">
                                                                                        <div class="legend-block-color-box highlight-color-blue" data-event-color="blue">
                                                                                            <i class="batch-icon batch-icon-droplet"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li class="dropdown-item legend-block-item active">
                                                                                    <div class="legend-block-color">
                                                                                        <div class="legend-block-color-box highlight-color-green" data-event-color="green">
                                                                                            <i class="batch-icon batch-icon-droplet"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li class="dropdown-item legend-block-item">
                                                                                    <div class="legend-block-color">
                                                                                        <div class="legend-block-color-box highlight-color-red" data-event-color="red">
                                                                                            <i class="batch-icon batch-icon-droplet"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li class="dropdown-item legend-block-item">
                                                                                    <div class="legend-block-color">
                                                                                        <div class="legend-block-color-box highlight-color-yellow" data-event-color="yellow">
                                                                                            <i class="batch-icon batch-icon-droplet"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li class="dropdown-item legend-block-item">
                                                                                    <div class="legend-block-color">
                                                                                        <div class="legend-block-color-box highlight-color-orange" data-event-color="orange">
                                                                                            <i class="batch-icon batch-icon-droplet"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                                <li class="dropdown-item legend-block-item">
                                                                                    <div class="legend-block-color">
                                                                                        <div class="legend-block-color-box highlight-color-purple" data-event-color="purple">
                                                                                            <i class="batch-icon batch-icon-droplet"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 mb-3">
                                                                        <label for="validationCustom02"><strong>Status</strong></label>
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
                                                    </div>
                                                    <ul class="pager wizard">
                                                        <li class="previous first" style="display:none;">
                                                            <a class="btn btn-light" href="#">
                                                                <i class="batch-icon batch-icon-arrow-left"></i>
                                                                First
                                                            </a>
                                                        </li>
                                                        <li class="previous" id="wizard-back-btn">
                                                            <a class="btn btn-secondary" href="#">
                                                                <i class="batch-icon batch-icon-arrow-left"></i>
                                                            </a>
                                                        </li>
                                                        <li class="next last" style="display:none;">
                                                            <a class="btn btn-primary" href="#">Last</a>
                                                        </li>
                                                        <li class="pull-right">
                                                            <button id="btn-sched-save" class="btn btn-primary" type="button">Save Schedule<i class="ml-2 batch-icon batch-icon-stiffy"></i></button>	
                                                        </li>
                                                    </ul>
                                                </div>	
                                            </div>
                                        </div>
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
            <div class="card">
                <div class="card-body">
                    <div class="calendar-container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="calendar"></div>
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
  <script src="{{ asset('assets/js/misc/moment.min.js') }}" defer></script>
  <script src="{{ asset('assets/plugins/fullcalendar/lib/fullcalendar.min.js') }}" defer></script>
  <script src="{{ asset('assets/plugins/fullcalendar/scheduler.min.js') }}" defer></script>
  <script src="{{ asset('assets/js/jquery/jquery-ui-1.11.0.custom/jquery-ui.min.js') }}" defer></script>
  <script src="{{ asset('assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}" defer></script>
  <script src="{{ asset('assets/plugins/form-validator/jquery.form-validator.min.js') }}" defer></script>
  <script type="text/javascript">
    $(document).ready(function() {
      function qp_form_wizard(){
        var thisForm = '#rootwizard-1';
        if($(thisForm).length){
          $('.pager li a, .pager li span').on('click', function(e){
            e.preventDefault();
          });
          
          $(thisForm).bootstrapWizard({onNext: function(tab, navigation, index) {
            $('#wizard-back-btn').css({"display": "block"});
            $('#btn-sched-save').css({"display": "block"});

            // if(index == 1){
            // 	$(".form-wizard-review-block").html("");
            // 	$(".form-wizard-review-block").append("<p><strong>Student ID:</strong> " + $(".wizard-stage-1-username").val() + "</p>");
            // 	$(".form-wizard-review-block").append("<p><strong>Student Name:</strong> " + $(".wizard-stage-1-username").val() + "</p>");
            // 	$(".form-wizard-review-block").append("<p><strong>Available Credits:</strong> " + $(".wizard-stage-1-username").val() + "</p>");
            // 	$(".form-wizard-review-block").append("<p><strong>Student Status:</strong> " + $(".wizard-stage-1-username").val() + "</p>");
            // 	// $(".form-wizard-review-block").append("<p><strong>Email:</strong> " + $(".wizard-stage-1-email").val() + "</p>");
            // 	// $(".form-wizard-review-block").append("<p><strong>password:</strong> *******</p>");
            // 	// $(".form-wizard-review-block").append("<p><strong>Telephone:</strong> " + $(".wizard-stage-2-optional-1").val() + "</p>");
            // 	// $(".form-wizard-review-block").append("<p><strong>Your Address:</strong> " + $(".wizard-stage-2-optional-2").val() + "</p>");
            // 	// $(".form-wizard-review-block").append("<p><strong>Write something about yourself:</strong> " + $(".wizard-stage-2-optional-3").val() + "</p>");
            // }
            if(index <= 1){
              $(thisForm + ' .tab-pane').eq(index).addClass('active');
              $(thisForm + ' .tab-pane').eq(index - 1).removeClass('active');
            }

          }, onPrevious: function(tab, navigation, index) {
            // Note: index is the previous frame not the current one
            if(index !== -1){
              $(thisForm + ' .tab-pane').eq(index).addClass('active');
              $(thisForm + ' .tab-pane').eq(index + 1).removeClass('active');
            }
            $('#wizard-back-btn').css({"display": "none"});
            $('#btn-sched-save').css({"display": "none"});
          }, onTabShow: function(tab, navigation, index) {
            // Update Progress Bar
            var total = navigation.find('li').length;
            var current = index + 1;
            var completionPercentage = (current / total) * 100;

            var progressBar = $(thisForm).closest('.card').find(".card-header .progress-bar");

            progressBar.css({"width": completionPercentage + "%"}).attr("aria-valuenow", completionPercentage);
          }, onTabClick: function(tab, navigation, index){
            return false;
          }});
        }
      }

      qp_form_wizard();
      $('#progress-div').css({"width": "50%"});
      $('#wizard-back-btn').css({"display": "none"});
      $('#btn-sched-save').css({"display": "none"});
      
    });
  </script>
@endsection