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
											<input type="text" class="form-control {{$errors->has('id_num') ? 'is-invalid' : ''}}" id="validationCustom01" name="id_num" value="{{old('id_num')}}" required>
											@if ($errors->has('id_num'))
												<div class="text-danger">
													{{$errors->first('id_num')}}
												</div>	
											@endif
										</div>
										<div class="col-md-3 mb-3">
											<label for="validationCustom01">First name</label>
											<input type="text" class="form-control {{$errors->has('first_name') ? 'is-invalid' : ''}}" id="validationCustom01" name="first_name" value="{{old('first_name')}}" required>
											@if ($errors->has('first_name'))
												<div class="text-danger">
													{{$errors->first('first_name')}}
												</div>	
											@endif
										</div>
										<div class="col-md-3 mb-3">
											<label for="validationCustom02">Middle name</label>
											<input type="text" class="form-control {{$errors->has('middle_name') ? 'is-invalid' : ''}}" id="validationCustom02" name="middle_name" value="{{old('middle_name')}}" required>
											@if ($errors->has('first_name'))
												<div class="text-danger">
													{{$errors->first('first_name')}}
												</div>	
											@endif
										</div>
										<div class="col-md-3 mb-3">
											<label for="validationCustom02">Last name</label>
											<input type="text" class="form-control {{$errors->has('last_name') ? 'is-invalid' : ''}}" id="validationCustom02" name="last_name" value="{{old('last_name')}}" required>
											@if ($errors->has('last_name'))
												<div class="text-danger">
													{{$errors->first('last_name')}}
												</div>	
											@endif
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-2 mb-3">
											<label for="validationCustom03">Gender</label>
											<div class="col-md-12 mt-2" style="padding-left: 0">
												<div class="custom-control custom-radio form-check form-check-inline" style="width:40%;float:left;">
													<input type="radio" class="custom-control-input" id="customControlValidation2a" value="male" name="gender" @if(old('gender') === 'male') checked @endif)>
													<label class="custom-control-label" for="customControlValidation2a">Male</label>
												</div>
												<div class="custom-control custom-radio mb-3 form-check form-check-inline" style="width:20%;float:left;">
													<input type="radio" class="custom-control-input" id="customControlValidation3a" value="female" name="gender" @if(old('gender') === 'female') checked @endif>
													<label class="custom-control-label" for="customControlValidation3a">Female</label>
												</div>
											</div>
											@if ($errors->has('gender'))
												<div class="text-danger mt-3" style="display: inline-block;">
													{{$errors->first('gender')}}
												</div>	
											@endif
										</div>
										<div class="col-md-2 mb-3">
											<label for="validationCustom04">Birthdate</label>
											<input type="date" class="fallback form-control {{$errors->has('birth_date') ? 'is-invalid' : ''}}" autocomplete="off" name="birth_date" value="{{old('birth_date')}}">
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
												<input type="text" class="sp_celphones form-control {{$errors->has('phone_number') ? 'is-invalid' : ''}}" value="{{old('phone_number')}}" autocomplete="off" name="phone_number" aria-describedby="inputGroupPrepend-6">
											</div>
											@if ($errors->has('phone_number'))
												<div class="text-danger mt-3">
													{{$errors->first('phone_number')}}
												</div>	
											@endif
										</div>
										<div class="col-md-6 mb-3">
											<label for="validationCustom02">Home Address</label>
											<input type="text" class="form-control {{$errors->has('address') ? 'is-invalid' : ''}}" value="{{old('address')}}" id="validationCustom02" name="address" required>
											@if ($errors->has('address'))
												<div class="text-danger">
													{{$errors->first('address')}}
												</div>	
											@endif
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
											<input type="text" class="form-control {{$errors->has('emcon_full_name') ? 'is-invalid' : ''}}" value="{{old('emcon_full_name')}}" id="validationCustom01" name="emcon_full_name" required>
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
												<input type="text" class="sp_celphones form-control {{$errors->has('emcon_phone_number') ? 'is-invalid' : ''}}" value="{{old('emcon_phone_number')}}" autocomplete="off" name="emcon_phone_number" aria-describedby="inputGroupPrepend-6">
											</div>
											@if ($errors->has('emcon_phone_number'))
												<div class="text-danger mt-3">
													{{$errors->first('emcon_phone_number')}}
												</div>	
											@endif
										</div>
										<div class="col-md-2 mb-3">
											<label for="validationCustom02">Relation to Student</label>
											<input type="text" class="form-control {{$errors->has('emcon_relationship') ? 'is-invalid' : ''}}" value="{{old('emcon_relationship')}}" id="validationCustom02" name="emcon_relationship" required>
											@if ($errors->has('emcon_relationship'))
												<div class="text-danger">
													{{$errors->first('emcon_relationship')}}
												</div>	
											@endif
										</div>
										<div class="col-md-4 mb-3">
											<label for="validationCustom02">Home Address</label>
											<input type="text" class="form-control {{$errors->has('emcon_address') ? 'is-invalid' : ''}}" value="{{old('emcon_address')}}" id="validationCustom02" name="emcon_address" required>
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