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
        <h1>Add Employee Record</h1>
    </div>
</div>
<div class="row mb-5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 pb-5">
                        <h2>Employee Information</h2>
                        <form class="needs-validation" method="POST" action="{{ route('instructor.store') }}" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="form-row mb-3">
                                <div class="col-lg-12">
                                    <div class="form-row">
                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom01">Employee ID</label>
                                            <input type="text" class="form-control {{ $errors->has('id_num') ? 'is-invalid' : '' }}" name="id_num" placeholder="ID Number" value="{{ old('id_num') }}" required>
                                            @if ($errors->has('id_num'))
                                                <div class="text-danger">{{$errors->first('id_num')}}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom01">First name</label>
                                            <input type="text" class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" required>
                                            @if ($errors->has('first_name'))
                                                <div class="text-danger">{{$errors->first('first_name')}}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom02">Middle name</label>
                                            <input type="text" class="form-control {{ $errors->has('middle_name') ? 'is-invalid' : '' }}" name="middle_name" placeholder="Middle Name" value="{{ old('middle_name') }}" required>
                                            @if ($errors->has('middle_name'))
                                                <div class="text-danger">{{$errors->first('middle_name')}}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom02">Last name</label>
                                            <input type="text" class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" required>
                                            @if ($errors->has('last_name'))
                                                <div class="text-danger">{{$errors->first('last_name')}}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-2 mb-3">
                                            <label for="validationCustom03">Gender</label>
                                            <div class="col-md-12 mt-2" style="padding-left: 0">
                                                <div class="custom-control custom-radio form-check form-check-inline" style="width:40%;float:left;">
                                                    <input type="radio" class="custom-control-input" id="customControlValidation2a" value="male" @if(old('gender')) checked @endif name="gender">
                                                    <label class="custom-control-label" for="customControlValidation2a">Male</label>
                                                </div>
                                                <div class="custom-control custom-radio mb-3 form-check form-check-inline" style="width:20%;float:left;">
                                                    <input type="radio" class="custom-control-input" id="customControlValidation3a" value="female" @if(old('gender')) checked @endif name="gender">
                                                    <label class="custom-control-label" for="customControlValidation3a">Female</label>
                                                </div>
                                                @if ($errors->has('gender'))
                                                    <div class="text-danger mt-3" style="display: inline-block;">{{$errors->first('gender')}}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label for="validationCustom04">Birthdate</label>
                                            <input type="date" class="fallback form-control {{ $errors->has('bday') ? 'is-invalid' : '' }}" name="bday" value="{{ old('bday') }}">
                                            @if ($errors->has('bday'))
                                                <div class="text-danger">{{$errors->first('bday')}}</div>
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
                                                <input type="text" class="sp_celphones form-control {{ $errors->has('contact_num') ? 'is-invalid' : '' }}" autocomplete="off" name="contact_num" placeholder="Contact Number" aria-describedby="inputGroupPrepend-6" value="{{ old('contact_num') }}">
                                            </div>
                                            @if ($errors->has('contact_num'))
                                                <div class="text-danger mt-3">{{$errors->first('contact_num')}}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom02">Home Address</label>
                                            <input type="text" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" id="validationCustom02" name="address" value="{{ old('address') }}" placeholder="e.g. 58th Street, Davao City 8000" required>
                                            @if ($errors->has('address'))
                                                <div class="text-danger">{{$errors->first('address')}}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-row mt-5">
                                <div class="col-lg-4 pb-5">
                                    <h2>Profile Image</h2>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <image id="profImage" src="" class="profile-image">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <input type="file" name="image" class="" onchange="readURL(this);" accept="image/gif, image/jpeg, image/png" value="{{ old('image') }}">
                                        </div>
                                        @if ($errors->has('image'))
                                            <div class="text-danger">{{$errors->first('image')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-8 pb-5">
                                    <h2>Emplyoment Details</h2>
                                    <div class="form-row">
                                        <div class="col-md-5 mb-3">
                                            <label for="validationCustom01">Position/Designation</label>
                                            <input type="text" class="form-control {{ $errors->has('position') ? 'is-invalid' : '' }}" id="validationCustom01" name="position" value="{{ old('position') }}" placeholder="Position" required>
                                            @if ($errors->has('position'))
                                                <div class="text-danger">{{$errors->first('position')}}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom04">Hired Date</label>
                                            <input type="date" class="fallback form-control {{ $errors->has('hired_date') ? 'is-invalid' : '' }}" name="hired_date" value="{{ old('hired_date') }}">
                                            @if ($errors->has('hired_date'))
                                                <div class="text-danger">{{$errors->first('hired_date')}}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom02">Status</label>
                                            <div class="form-group">
                                                <select class="form-control" name="status">
                                                    <option value="1" selected>Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary pull-right">Save Employee Record <i class="ml-2 batch-icon batch-icon-stiffy"></i></button>
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