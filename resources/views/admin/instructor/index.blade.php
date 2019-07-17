@extends('layouts.app')

@section('styling')
  <link rel="stylesheet" href="{{ asset('assets/css/quillpro/quillpro.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection

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
              <div class="table-responsive">
                <table id="mytable" class="table table-datatable table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID No.</th>
                            <th>Avatar</th>
                            <th>Nickname</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Hired Date</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($instructors as $instructor)
                        <tr>
                            <td>{{ $instructor->id_num }}</td>
                            <td><image src="{{ asset($instructor->image) }}" width="40px"></td>
                            <td>{{ $instructor->nickname }}</td>
                            <td>{{ $instructor->first_name }}</td>
                            <td>{{ $instructor->middle_name }}</td>
                            <td>{{ $instructor->last_name }}</td>
                            <td>{{ $instructor->hired_date }}</td>
                            <td>
                                @if ($instructor->status == 1)
                                    <span class="badge badge-success">Active</span>
                                    <!-- <a href="{{ route('instructor.deactivate', ['id' => $instructor->id]) }}">Deactivate</a> -->
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                    <!-- <a href="{{ route('instructor.activate', ['id' => $instructor->id]) }}">Activate</a> -->
                                @endif
                            </td>
                            <td class="text-center">
                                <!-- <div class="btn-group btn-group-sm" role="group" aria-label="Small button group"> -->
                                    <!-- <a href="{{ route('instructor.destroy', ['id' => $instructor->id]) }}" class="btn btn-danger waves-effect waves-light">Remove</a> -->
                                    <a href="{{ route('instructor.edit', ['id' => $instructor->id]) }}" class="table-button btn btn-warning waves-effect waves-light">Edit <i class="fa fa-pencil"></i></a>
                                <!-- </div> -->

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID No.</th>
                            <th>Avatar</th>
                            <th>Nickname</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Hired Date</th>
                            <th>Status</th>
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

      </footer>
    </div>
  </div>
@endsection

@section('scripts')
    <script>
        $(function () {

            $("#mytable").DataTable( {"order": [[ 0, "desc" ]]} );

        })
    </script>
@endsection