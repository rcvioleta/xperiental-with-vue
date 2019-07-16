@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-6">
      <h1>Student Account List</h1>
    </div>
  </div>
  <div class="row mb-5">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12 pb-5">
              <student-account-list :data="{{ json_encode($data) }}"></student-account-list>
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