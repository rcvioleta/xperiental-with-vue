@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-6">
      <h1>Student List</h1>
    </div>
    <div class="col-md-6">
      <a class="btn btn-primary pull-right" href="{{ route('student.create') }}">Add New <i class="ml-2 batch-icon batch-icon-plus"></i></a>
    </div>
  </div>
  <div class="row mb-5">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12 pb-5">
              <student-list-new :students="{{ json_encode($students) }}"></student-list-new>
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

@endsection