@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-6">
		<h1>Update Student Record</h1>
	</div>
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
				</ul>
			</div>
			<div class="card-body">
				<div class="tab-content" id="myTabContent-6">
					<div id="tab-6-1" class="row tab-pane fade show active" role="tabpanel" aria-labelledby="tab-6-1">
						<div class="col-lg-12">
							<h2>Student Information</h2>
						</div>
						<div class="col-lg-12">
							<form class="needs-validation" method="POST" action="{!! route('student.update', $student->id) !!}" novalidate enctype="multipart/form-data">
								@csrf
								<div class="form-row mb-3">
									<div class="col-lg-12">
										<div class="form-row">
											<div class="col-md-2 mb-3">
												<label for="validationCustom01">Student ID</label>
												<input type="text" class="form-control {{$errors->has('id_num') ? 'is-invalid' : ''}}" id="validationCustom01" value="{{ $student->id_num }}" name="id_num">
												@if ($errors->has('id_num'))
													<div class="text-danger">
														{{$errors->first('id_num')}}
													</div>
												@endif
											</div>
											<div class="col-md-1 mb-3">
												<label for="validationCustom01">Nickname</label>
												<input type="text" class="form-control {{$errors->has('nickname') ? 'is-invalid' : ''}}" id="validationCustom01" value="{{ $student->nickname }}" name="nickname" required>
												@if ($errors->has('nickname'))
													<div class="text-danger">
														{{$errors->first('nickname')}}
													</div>
												@endif
											</div>
											<div class="col-md-3 mb-3">
												<label for="validationCustom02">Last name</label>
												<input type="text" class="form-control {{$errors->has('last_name') ? 'is-invalid' : ''}}" id="validationCustom02" value="{!! $student->last_name !!}" name="last_name" required>
												@if ($errors->has('last_name'))
													<div class="text-danger">
														{{$errors->first('last_name')}}
													</div>
												@endif
											</div>
											<div class="col-md-3 mb-3">
												<label for="validationCustom01">First name</label>
												<input type="text" class="form-control {{$errors->has('first_name') ? 'is-invalid' : ''}}" id="validationCustom01" value="{!! $student->first_name !!}" name="first_name" required>
												@if ($errors->has('first_name'))
													<div class="text-danger">
														{{$errors->first('first_name')}}
													</div>
												@endif
											</div>
											<div class="col-md-3 mb-3">
												<label for="validationCustom02">Middle name</label>
												<input type="text" class="form-control {{$errors->has('middle_name') ? 'is-invalid' : ''}}" id="validationCustom02" value="{!! $student->middle_name !!}" name="middle_name">
												@if ($errors->has('middle_name'))
													<div class="text-danger">
														{{$errors->first('middle_name')}}
													</div>
												@endif
											</div>
										</div>
										<div class="form-row">
											<div class="col-md-2 mb-3">
												<label for="validationCustom03">Gender</label>
												<div class="col-md-12 mt-2" style="padding-left: 0">
													<div class="custom-control custom-radio form-check form-check-inline" style="width:40%;float:left;">
														<input type="radio" class="custom-control-input" id="customControlValidation2a" value="Male" name="gender" 
														@if($student->gender == "Male")
														checked
														@endif
														>
														<label class="custom-control-label" for="customControlValidation2a">Male</label>
													</div>
													<div class="custom-control custom-radio mb-3 form-check form-check-inline" style="width:20%;float:left;">
														<input type="radio" class="custom-control-input" id="customControlValidation3a" value="Female" name="gender"
														@if($student->gender == "Female")
														checked
														@endif
														>
														<label class="custom-control-label" for="customControlValidation3a">Female</label>
													</div>
												</div>
											</div>
											<div class="col-md-2 mb-3">
												<label for="validationCustom04">Birthdate</label>
												<input type="date" class="fallback form-control {{$errors->has('birth_date') ? 'is-invalid' : ''}}" autocomplete="off" value="{!! $student->birth_date !!}" name="birth_date">
												@if ($errors->has('birth_date'))
													<div class="text-danger">
														{{$errors->first('birth_date')}}
													</div>
												@endif
											</div>
											<div class="col-md-2 mb-3">
												<label for="validationCustom05">Telephone/Phone</label>
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text" id="inputGroupPrepend-6">
															<i class="batch-icon batch-icon-headphones"></i>
														</span>
													</div>
													<input type="text" class="sp_celphones form-control {{$errors->has('phone_number') ? 'is-invalid' : ''}}" autocomplete="off" value="{!! $student->phone_number !!}" name="phone_number" aria-describedby="inputGroupPrepend-6">
												</div>
												@if ($errors->has('phone_number'))
													<div class="text-danger mt-3" style="display: inline-block;">
														{{$errors->first('phone_number')}}
													</div>
												@endif
											</div>
											<div class="col-md-4 mb-3">
												<label for="validationCustom02">Home Address</label>
												<input type="text" class="form-control {{$errors->has('address') ? 'is-invalid' : ''}}" id="validationCustom02" value="{!! $student->address !!}" name="address" required>
												@if ($errors->has('address'))
													<div class="text-danger">
														{{$errors->first('address')}}
													</div>
												@endif
											</div>
											<div class="col-md-2 mb-3">
												<label for="validationCustom04">Registration Date</label>
												<input type="date" class="fallback form-control {{$errors->has('registration_date') ? 'is-invalid' : ''}}" autocomplete="off" value="{!! $student->registration_date !!}" name="registration_date">
												@if ($errors->has('registration_date'))
													<div class="text-danger">
														{{$errors->first('registration_date')}}
													</div>
												@endif
											</div>
										</div>
										<div class="form-row">
											<div class="col-md-2 mb-3">
												<label for="avatar">Profile Picture</label>
												<div class="form-row">
													<div class="col-md-12 mb-3">
														<image id="profImage"  src="{{ asset($student->image) }}" class="profile-image">
													</div>
													<div class="col-md-12 mb-3">
														<input type="file" name="image" onchange="readURL(this);" accept="image/gif, image/jpeg, image/png">
													</div>
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
												<input type="text" class="form-control {{$errors->has('emcon_full_name') ? 'is-invalid' : ''}}" id="validationCustom01" value="{!! $student->emcon_full_name !!}" name="emcon_full_name" required>
												@if ($errors->has('emcon_full_name'))
													<div class="text-danger">
														{{$errors->first('emcon_full_name')}}
													</div>
												@endif
											</div>
											<div class="col-md-2 mb-3">
												<label for="validationCustom05">Telephone/Phone</label>
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text" id="inputGroupPrepend-6">
															<i class="batch-icon batch-icon-headphones"></i>
														</span>
													</div>
													<input type="text" class="sp_celphones form-control {{$errors->has('emcon_phone_number') ? 'is-invalid' : ''}}" autocomplete="off" value="{!! $student->emcon_phone_number !!}" name="emcon_phone_number" aria-describedby="inputGroupPrepend-6">
												</div>
												@if ($errors->has('emcon_phone_number'))
													<div class="text-danger mt-3" style="display: inline-block;">
														{{$errors->first('emcon_phone_number')}}
													</div>
												@endif
											</div>
											<div class="col-md-2 mb-3">
												<label for="validationCustom02">Relation to Student</label>
												<input type="text" class="form-control {{$errors->has('emcon_relationship') ? 'is-invalid' : ''}}" id="validationCustom02" value="{!! $student->emcon_relationship !!}" name="emcon_relationship" required>
												@if ($errors->has('emcon_relationship'))
													<div class="text-danger">
														{{$errors->first('emcon_relationship')}}
													</div>
												@endif
											</div>
											<div class="col-md-4 mb-3">
												<label for="validationCustom02">Home Address</label>
												<input type="text" class="form-control {{$errors->has('emcon_address') ? 'is-invalid' : ''}}" id="validationCustom02" value="{!! $student->emcon_address !!}" name="emcon_address" required>
												@if ($errors->has('emcon_address'))
													<div class="text-danger">
														{{$errors->first('emcon_address')}}
													</div>
												@endif
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
							
						<student-educational-list :student-id="{{ $student->id }}" :edu-backgrounds="{{ $eduBackgrounds }}"></student-educational-list>

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

<script>
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#profImage').attr('src', e.target.result).width(150).height(200);
			};

			reader.readAsDataURL(input.files[0]);
		}
	}
</script>
@endsection