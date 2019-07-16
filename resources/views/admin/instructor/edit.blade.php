@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6">
        <h1>Edit Employee Record</h1>
    </div>
</div>
<div class="row mb-5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 pb-5">
                        <h2>Employee Information</h2>
                        <form class="needs-validation" method="POST" action="{{ route('instructor.update', ['id' => $instructor->id]) }}" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="form-row mb-3">
                                <div class="col-lg-12">
                                    <div class="form-row">
                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom01">Employee ID</label>
                                            <input type="text" class="form-control {{$errors->has('id_num') ? 'is-invalid' : ''}}" name="id_num" value="{{ $instructor->id_num }}" required>
                                            @if ($errors->has('id_num'))
                                                <div class="text-danger">{{$errors->first('id_num')}}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom01">First name</label>
                                            <input type="text" class="form-control {{$errors->has('first_name') ? 'is-invalid' : ''}}" name="first_name" value="{{ $instructor->first_name }}" required>
                                            @if ($errors->has('first_name'))
                                                <div class="text-danger">{{$errors->first('first_name')}}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom02">Middle name</label>
                                            <input type="text" class="form-control {{$errors->has('middle_name') ? 'is-invalid' : ''}}" name="middle_name" value="{{ $instructor->middle_name }}" required>
                                            @if ($errors->has('middle_name'))
                                                <div class="text-danger">{{$errors->first('middle_name')}}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom02">Last name</label>
                                            <input type="text" class="form-control {{$errors->has('last_name') ? 'is-invalid' : ''}}" name="last_name" value="{{ $instructor->last_name }}" required>
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
                                                    <input type="radio" class="custom-control-input" id="customControlValidation2a" value="male" name="gender" 
                                                        @if($instructor->gender == "male")
                                                        checked
                                                        @endif
                                                        >
                                                    <label class="custom-control-label">Male</label>
                                                </div>
                                                <div class="custom-control custom-radio mb-3 form-check form-check-inline" style="width:20%;float:left;">
                                                    <input type="radio" class="custom-control-input" id="customControlValidation3a" value="female" name="gender"
                                                        @if($instructor->gender == "female")
                                                        checked
                                                        @endif
                                                        >
                                                    <label class="custom-control-label">Female</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label for="validationCustom04">Birthdate</label>
                                            <input type="date" class="fallback form-control {{$errors->has('bday') ? 'is-invalid' : ''}}" name="bday" value="{{ $instructor->bday }}">
                                            @if ($errors->has('bday'))
                                                <div class="text-danger mt-3">{{$errors->first('bday')}}</div>
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
                                                <input type="text" class="sp_celphones form-control {{$errors->has('contact_num') ? 'is-invalid' : ''}}" autocomplete="off" name="contact_num" value="{{ $instructor->contact_num }}" aria-describedby="inputGroupPrepend-6">
                                            </div>
                                            @if ($errors->has('contact_num'))
                                                <div class="text-danger mt-3">{{$errors->first('contact_num')}}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom02">Home Address</label>
                                            <input type="text" class="form-control {{$errors->has('address') ? 'is-invalid' : ''}}" id="validationCustom02" name="address" value="{{ $instructor->address }}" required>
                                            @if ($errors->has('address'))
                                                <div class="text-danger mt-3">{{$errors->first('address')}}</div>
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
                                            <image id="profImage" src="{{ asset($instructor->image) }}" class="profile-image">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <input type="file" name="image" onchange="readURL(this);" accept="image/gif, image/jpeg, image/png">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8 pb-5">
                                    <h2>Emplyoment Details</h2>
                                    <div class="form-row">
                                        <div class="col-md-5 mb-3">
                                            <label for="validationCustom01">Position/Designation</label>
                                            <input type="text" class="form-control {{$errors->has('position') ? 'is-invalid' : ''}}" id="validationCustom01" name="position" value="{{ $instructor->position }}" required>
                                            @if ($errors->has('position'))
                                                <div class="text-danger">{{$errors->first('position')}}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom04">Hired Date</label>
                                            <input type="date" class="fallback form-control {{$errors->has('hired_date') ? 'is-invalid' : ''}}" name="hired_date" value="{{ $instructor->hired_date }}">
                                            @if ($errors->has('hired_date'))
                                                <div class="text-danger">{{$errors->first('hired_date')}}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom02">Status</label>
                                            <div class="form-group">
                                                <select class="form-control" name="status">
                                                    <option value="1"
                                                    @if($instructor->status == "1")
                                                    selected
                                                    @endif
                                                    >Active</option>
                                                    <option value="0"
                                                    @if($instructor->status == "Inactive")
                                                    selected
                                                    @endif
                                                    >Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-md-12 mt-5">
                                            <button type="submit" class="btn btn-primary pull-right mr-0 mt-5">Update Employee Record <i class="ml-2 batch-icon batch-icon-stiffy"></i></button>
                                        </div>
                                    </div>
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