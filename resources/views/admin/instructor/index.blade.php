@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-6">
      <h1>Employee List</h1>
    </div>
    <div class="col-md-6">
      <a class="btn btn-primary pull-right" href="{{ route('instructor.create') }}">Add New <i class="ml-2 batch-icon batch-icon-plus"></i></a>
    </div>
  </div>
  <div class="row mb-5">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12 pb-5">
              <instructor-list :instructors="{{ json_encode($instructors) }}"></instructor-list>
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