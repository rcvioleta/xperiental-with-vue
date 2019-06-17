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
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection

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
              <div class="table-responsive">
                <table id="mytable" class="table table-datatable table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Gender</th>
                            <th>Birth Date</th>
                            <th>Telephone/Phone</th>
                            <th>Created On</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                        <tr>
                            <td>{!! $student->id_num !!}</td>
                            <td>{!! $student->first_name !!} {!! $student->middle_name !!} {!! $student->last_name !!}</td>
                            <td>{!! $student->gender !!}</td>
                            <td>{!! $student->birth_date !!}</td>
                            <td>{!! $student->phone_number !!}</td>
                            <td>{!! $student->created_at !!}</td>
                            <td class="text-center">
                                <a href="{{ route('student.edit', $student->id) }}" class="btn btn-sm btn-warning pull-right waves-effect waves-light">Edit<i class="fa fa-pencil"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Gender</th>
                            <th>Birth Date</th>
                            <th>Telephone/Phone</th>
                            <th>Created On</th>
                            <th class="text-center">Action</th>
                        </tr>
                   	</tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row mb-5">
    <div class="col-md-12">
      <footer>
        <!-- Powered by - <a href="http://base5builder.com/?click_source=quillpro_footer_link" target="_blank" style="font-weight:300;color:#ffffff;background:#1d1d1d;padding:0 3px;">Base<span style="color:#ffa733;font-weight:bold">5</span>Builder</a> -->
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
        $(function () {

            $("#mytable").DataTable( {"order": [[ 0, "desc" ]]} );

        })
    </script>
@endsection