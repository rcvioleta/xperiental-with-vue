@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-6">
      <h1>CLASS CALENDAR</h1>
    </div>
  </div>
  <div class="row mb-5">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12 pb-5">
              <class-calendar :class-types="{{ $classtypes }}" :schedules="{{ $schedules }}" :students="{{ $students }}" :grades="{{ $grades }}" :subjects="{{ $subjects }}" :instructors="{{ $instructors }}"></class-calendar>
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