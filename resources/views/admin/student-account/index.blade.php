@extends('layouts.app')

@section('styling')
  <link rel="stylesheet" href="{{ asset('assets/fonts/batch-icons/css/batch-icons.css') }}">
  <!-- <link rel="stylesheet" href="{{ asset('assets/fonts/line-awesome/css/line-awesome.css') }}"> -->
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
  <!-- <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/mdb.min.css') }}"> -->
  <!-- <link rel="stylesheet" href="{{ asset('assets/plugins/custom-scrollbar/jquery.mCustomScrollbar.min.css') }}"> -->
  <!-- <link rel="stylesheet" href="{{ asset('assets/css/hamburgers/hamburgers.css') }}"> -->
  <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome/css/font-awesome.min.css') }}">
  <!-- <link rel="stylesheet" href="{{ asset('assets/plugins/jvmaps/jqvmap.min.css') }}"> -->
  <link rel="stylesheet" href="{{ asset('assets/css/quillpro/quillpro.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection

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
              <student-account-list :students="{{ json_encode($students) }}"></student-account-list>
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