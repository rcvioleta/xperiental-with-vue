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
		<h1>Add Student Record</h1>
	</div>
</div>
<div class="row mb-5">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-lg-12 pb-5">
						<h2>Student Information</h2>
						<form class="needs-validation" method="POST" action="{{route('student.store')}}" novalidate>
							@csrf
							<div class="form-row mb-3">
								<div class="col-lg-12">
									<div class="form-row">
										<div class="col-md-3 mb-3">
											<label for="validationCustom01">Student ID</label>
											<input type="text" class="form-control" id="validationCustom01" name="id_num" required>
											<div class="valid-feedback">
												Looks good!
											</div>
										</div>
										<div class="col-md-3 mb-3">
											<label for="validationCustom01">First name</label>
											<input type="text" class="form-control" id="validationCustom01" name="first_name" required>
											<div class="valid-feedback">
												Looks good!
											</div>
										</div>
										<div class="col-md-3 mb-3">
											<label for="validationCustom02">Middle name</label>
											<input type="text" class="form-control" id="validationCustom02" name="middle_name" required>
											<div class="valid-feedback">
												Looks good!
											</div>
										</div>
										<div class="col-md-3 mb-3">
											<label for="validationCustom02">Last name</label>
											<input type="text" class="form-control" id="validationCustom02" name="last_name" required>
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
													<input type="radio" class="custom-control-input" id="customControlValidation2a" value="male" name="gender">
													<label class="custom-control-label" for="customControlValidation2a">Male</label>
												</div>
												<div class="custom-control custom-radio mb-3 form-check form-check-inline" style="width:20%;float:left;">
													<input type="radio" class="custom-control-input" id="customControlValidation3a" value="female" name="gender">
													<label class="custom-control-label" for="customControlValidation3a">Female</label>
													<div class="invalid-feedback">More example invalid feedback text</div>
												</div>
											</div>
										</div>
										<div class="col-md-2 mb-3">
											<label for="validationCustom04">Birthdate</label>
											<input type="date" class="fallback form-control" autocomplete="off" name="birth_date">
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
												<input type="text" class="sp_celphones form-control" autocomplete="off" name="phone_number" aria-describedby="inputGroupPrepend-6">
											</div>
											<div class="invalid-feedback">
												Please provide a valid zip.
											</div>
										</div>
										<div class="col-md-6 mb-3">
											<label for="validationCustom02">Home Address</label>
											<input type="text" class="form-control" id="validationCustom02" name="address" required>
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
											<input type="text" class="form-control" id="validationCustom01" name="emcon_full_name" required>
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
												<input type="text" class="sp_celphones form-control" autocomplete="off" name="emcon_phone_number" aria-describedby="inputGroupPrepend-6">
											</div>
										</div>
										<div class="col-md-2 mb-3">
											<label for="validationCustom02">Relation to Student</label>
											<input type="text" class="form-control" id="validationCustom02" name="emcon_relationship" required>
											<div class="valid-feedback">
												Looks good!
											</div>
										</div>
										<div class="col-md-4 mb-3">
											<label for="validationCustom02">Home Address</label>
											<input type="text" class="form-control" id="validationCustom02" name="emcon_address" required>
											<div class="valid-feedback">
												Looks good!
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<button type="submit" class="btn btn-primary pull-right">Save Student <i class="ml-2 batch-icon batch-icon-stiffy"></i></button>
								</div>
							</div>
						</form>
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