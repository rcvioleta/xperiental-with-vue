@extends('layouts.app')

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