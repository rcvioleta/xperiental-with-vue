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

@endsection

@section('content')
<div class="row">
	<div class="col-md-6">
		<h1>Update Student Record</h1>
	</div>
	<!-- <div class="col-md-6">
		<button class="btn btn-primary pull-right" type="submit">Save <i class="ml-2 batch-icon batch-icon-stiffy"></i></button>
	</div> -->
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
						<a class="nav-link" href="#tab-6-3" data-toggle="tab" role="tab" aria-controls="tab-6-3" aria-selected="false">ENROLLMENT HISTORY</a>
					</li>
				</ul>
			</div>
			<div class="card-body">
				<div class="tab-content" id="myTabContent-6">
					<div id="tab-6-1" class="row tab-pane fade show active" role="tabpanel" aria-labelledby="tab-6-1">
						<div class="col-lg-12">
							<h2>Student Information</h2>
						</div>
						<div class="col-lg-12">
							<form class="needs-validation" method="POST" action="{!! route('student.update', $student->id) !!}" novalidate>
								@csrf
								<div class="form-row mb-3">
									<div class="col-lg-12">
										<div class="form-row">
											<div class="col-md-3 mb-3">
												<label for="validationCustom01">Student ID</label>
												<input type="text" class="form-control" id="validationCustom01" value="{!! $student->id_num !!}" name="id_num" required>
												<div class="valid-feedback">
													Looks good!
												</div>
											</div>
											<div class="col-md-3 mb-3">
												<label for="validationCustom01">First name</label>
												<input type="text" class="form-control" id="validationCustom01" value="{!! $student->first_name !!}" name="first_name" required>
												<div class="valid-feedback">
													Looks good!
												</div>
											</div>
											<div class="col-md-3 mb-3">
												<label for="validationCustom02">Middle name</label>
												<input type="text" class="form-control" id="validationCustom02" value="{!! $student->middle_name !!}" name="middle_name" required>
												<div class="valid-feedback">
													Looks good!
												</div>
											</div>
											<div class="col-md-3 mb-3">
												<label for="validationCustom02">Last name</label>
												<input type="text" class="form-control" id="validationCustom02" value="{!! $student->last_name !!}" name="last_name" required>
												<div class="valid-feedback">
													Looks good!
												</div>
											</div>
										</div>
										<div class="form-row">
											<div class="col-md-2 mb-3">
												<label for="validationCustom03">Gender</label>
												<div class="col-md-12 mt-2" style="padding-left: 0">
													<div class="custom-control custom-radio form-check form-check-inline" style="width:40%;float:left;">
														<input type="radio" class="custom-control-input" id="customControlValidation2a" value="male" name="gender" 
														@if($student->gender == "male")
														checked
														@endif
														>
														<label class="custom-control-label" for="customControlValidation2a">Male</label>
													</div>
													<div class="custom-control custom-radio mb-3 form-check form-check-inline" style="width:20%;float:left;">
														<input type="radio" class="custom-control-input" id="customControlValidation3a" value="female" name="gender"
														@if($student->gender == "female")
														checked
														@endif
														>
														<label class="custom-control-label" for="customControlValidation3a">Female</label>
														<div class="invalid-feedback">More example invalid feedback text</div>
													</div>
												</div>
											</div>
											<div class="col-md-2 mb-3">
												<label for="validationCustom04">Birthdate</label>
												<input type="text" class="fallback form-control" autocomplete="off" value="{!! $student->birth_date !!}" placeholder="DD/MM/YYYY" name="birth_date">
												<div class="invalid-feedback">
													Please provide a valid state.
												</div>
											</div>
											<div class="col-md-2 mb-3">
												<label for="validationCustom05">Telephone/Phone</label>
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text" id="inputGroupPrepend-6">
															<i class="batch-icon batch-icon-headphones"></i>
														</span>
													</div>
													<input type="text" class="sp_celphones form-control" autocomplete="off" value="{!! $student->phone_number !!}" name="phone_number" aria-describedby="inputGroupPrepend-6">
												</div>
												<div class="invalid-feedback">
													Please provide a valid zip.
												</div>
											</div>
											<div class="col-md-6 mb-3">
												<label for="validationCustom02">Home Address</label>
												<input type="text" class="form-control" id="validationCustom02" value="{!! $student->address !!}" name="address" required>
												<div class="valid-feedback">
													Looks good!
												</div>
											</div>
										</div>
									</div>
								</div>
								<hr>
								<div class="form-row mt-5">
									<div class="col-lg-12 pb-5">
										<h2>Emergency Contact</h2>
										<div class="form-row">
											<div class="col-md-4 mb-3">
												<label for="validationCustom01">Full Name</label>
												<input type="text" class="form-control" id="validationCustom01" value="{!! $student->emcon_full_name !!}" name="emcon_full_name" required>
												<div class="valid-feedback">
													Looks good!
												</div>
											</div>
											<div class="col-md-2 mb-3">
												<label for="validationCustom05">Telephone/Phone</label>
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text" id="inputGroupPrepend-6">
															<i class="batch-icon batch-icon-headphones"></i>
														</span>
													</div>
													<input type="text" class="sp_celphones form-control" autocomplete="off" value="{!! $student->emcon_phone_number !!}" name="emcon_phone_number" aria-describedby="inputGroupPrepend-6">
												</div>
												<div class="invalid-feedback">
													Please provide a valid zip.
												</div>
											</div>
											<div class="col-md-2 mb-3">
												<label for="validationCustom02">Relation to Student</label>
												<input type="text" class="form-control" id="validationCustom02" value="{!! $student->emcon_relationship !!}" name="emcon_relationship" required>
												<div class="valid-feedback">
													Looks good!
												</div>
											</div>
											<div class="col-md-4 mb-3">
												<label for="validationCustom02">Home Address</label>
												<input type="text" class="form-control" id="validationCustom02" value="{!! $student->emcon_address !!}" name="emcon_address" required>
												<div class="valid-feedback">
													Looks good!
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<button type="submit" class="btn btn-primary pull-right">Update Student <i class="ml-2 batch-icon batch-icon-stiffy"></i></button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div id="tab-6-2" class="row tab-pane fade" role="tabpanel" aria-labelledby="tab-6-2">
						<div class="modal fade" id="addhistoryModal" tabindex="-1" role="dialog" aria-labelledby="addhistoryModalLongTitle" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="addhistoryModalLongTitle">Add History</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="container-fluid">
											<form class="needs-validation" novalidate>
												<div class="form-row pt-3">
													<div class="col-md-12 mb-3">
														<label for="validationCustom02">School Name</label>
														<input type="text" class="form-control" id="validationCustom01" placeholder="School name" value="1001" required>
														<div class="valid-feedback">
															Looks good!
														</div>
													</div>
												</div>
												<div class="form-row pt-3">
													<div class="col-md-6 mb-3">
														<label for="validationCustom02">Attended From</label>
														<input type="text" class="form-control" id="validationCustom01" placeholder="From Year" value="1001" required>
														<div class="valid-feedback">
															Looks good!
														</div>
													</div>
													<div class="col-md-6 mb-3">
														<label for="validationCustom02">Attended To</label>
														<input type="text" class="form-control" id="validationCustom01" placeholder="To Year" value="1001" required>
														<div class="valid-feedback">
															Looks good!
														</div>
													</div>
												</div>
												<div class="form-row pt-3">
													<div class="col-md-12 mb-3">
														<label for="	FormControlTextarea1">Notes</label>
														<textarea class="form-control" id="FormControlTextarea1" rows="3"></textarea>
													</div>
												</div>
											</form>
										</div>
									</div>
									<div class="modal-footer mr-3">
										<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
										<button type="button" class="btn btn-primary">Save History <i class="ml-2 batch-icon batch-icon-stiffy"></i></button>
									</div>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-lg-6">
								<h2 class="ml-4 mb-3">School Attended</h2>
							</div>
							<div class="col-lg-6">
								<button class="btn btn-primary pull-right mr-4 mb-3" data-toggle="modal" data-target="#addhistoryModal">Add History <i class="batch-icon batch-icon-plus"></i></button>
							</div>
						</div>
						<div class="col-lg-12 pb-5">

							<form class="needs-validation" novalidate>
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
												@foreach($eduBackgrounds as $eduBackground)
												<tr>
													<td>{!! $eduBackground->name !!}</td>
													<td>{!! $eduBackground->year_attended !!}</td>
													<td>{!! $eduBackground->notes !!}</td>
													<td>
														<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
															<button type="button" class="btn btn-danger"><i class="ml-2 batch-icon batch-icon-bin"></i></button>
															<button type="button" class="btn btn-warning"><i class="ml-2 batch-icon batch-icon-pencil"></i></button>
														</div>
													</td>
												</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div id="tab-6-3" class="row tab-pane fade" role="tabpanel" aria-labelledby="tab-6-3">
						<div class="form-row">
							<div class="col-lg-12">
								<h2 class="ml-4 mb-3">ENROLLMENT HISTORY</h2>
							</div>
						</div>
						<div class="col-lg-12 pb-5">

							<form class="needs-validation" novalidate>
								<div class="form-row">
									<div class="col-md-12 mb-3">
										<table class="table table-striped">
											<thead>
												<tr>
													<th>Date Created</th>
													<th>Credits</th>
													<th>Credit Type</th>
													<th>Amount Paid</th>
													<th>Balance</th>
													<th>Status</th>
													<th>Remarks</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												@foreach($enrollments as $enrollment)
												<tr>
													<td>{!! $enrollment->created_at !!}</td>
													<td>{!! $enrollment->credits !!}</td>
													<td>{!! $enrollment->credit_type_id !!}</td>
													<td>{!! $enrollment->amount_paid !!}</td>
													<td>{!! $enrollment->amount_balance !!}</td>
													<td>{!! $enrollment->payment_status !!}</td>
													<td>{!! $enrollment->remarks !!}</td>
													<td>
														<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
															<button type="button" class="btn btn-danger"><i class="ml-2 batch-icon batch-icon-bin"></i></button>
															<button type="button" class="btn btn-warning"><i class="ml-2 batch-icon batch-icon-pencil"></i></button>
														</div>
													</td>
												</tr>
												@endforeach
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

		</footer>
	</div>
</div>
@endsection

@section('scripts')
{{-- <script src="{{ asset('assets/js/jquery/jquery-3.1.1.min.js') }}" defer></script> --}}
<script src="{{ asset('assets/js/bootstrap/popper.min.js') }}" defer></script>
<script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}" defer></script>
<script src="{{ asset('assets/js/bootstrap/mdb.min.js') }}" defer></script>
<script src="{{ asset('assets/plugins/velocity/velocity.min.js') }}" defer></script>
<script src="{{ asset('assets/plugins/velocity/velocity.ui.min.js') }}" defer></script>
<script src="{{ asset('assets/plugins/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js') }}" defer></script>
<script src="{{ asset('assets/plugins/jquery_visible/jquery.visible.min.js') }}" defer></script>
<script src="{{ asset('assets/js/misc/ie10-viewport-bug-workaround.js') }}" defer></script>
<script src="{{ asset('assets/js/misc/holder.min.js') }}" defer></script>

<script>

</script>
@endsection