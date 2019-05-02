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
      <h1>Configurations</h1>
    </div>
  </div>
  <div class="row mb-5">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <ul class="nav nav-tabs card-header-tabs" id="myTab-6" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" onclick="SubjectAdd()" href="#tab-6-1" data-toggle="tab" role="tab" aria-controls="tab-6-1" aria-selected="true">Subjects</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" onclick="ClassroomAdd()" href="#tab-6-2" data-toggle="tab" role="tab" aria-controls="tab-6-2" aria-selected="false">Classrooms</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" onclick="LevelsAdd()" href="#tab-6-3" data-toggle="tab" role="tab" aria-controls="tab-6-3" aria-selected="false">Grade Level</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" onclick="SystemAdd()" href="#tab-6-4" data-toggle="tab" role="tab" aria-controls="tab-6-4" aria-selected="false">System Users</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" onclick="ClassRateAdd()" href="#tab-6-5" data-toggle="tab" role="tab" aria-controls="tab-6-5" aria-selected="false">Class Rate</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div id="tab-6-1" class="row tab-pane fade show active" role="tabpanel" aria-labelledby="tab-6-1">
              <div class="row">
                <div class="p-0 col-lg-12 pb-5">
                  <div class="table-responsive">
                    <!-- DO NOT DELETE. THIS IS A CUSTOM VUE COMPONENT -->
                    <subject-crud></subject-crud>
                  </div>
                </div>
              </div>
            </div>
            <div id="tab-6-2" class="row tab-pane fade show" role="tabpanel" aria-labelledby="tab-6-2">
              <div class="row">
                <div class="p-0 col-lg-12 pb-5">
                  <div class="table-responsive">
                    <classroom-crud></classroom-crud>
                  </div>
                </div>
              </div>
            </div>
            <div id="tab-6-3" class="row tab-pane fade show" role="tabpanel" aria-labelledby="tab-6-3">
              <div class="row">
                <div class="p-0 col-lg-12 pb-5">
                  <div class="table-responsive">
                    <student-level-crud></student-level-crud>
                  </div>
                </div>
              </div>
            </div>
            <div id="tab-6-4" class="row tab-pane fade show" role="tabpanel" aria-labelledby="tab-6-4">
              <div class="row">
                <div class="p-0 col-lg-12 pb-5">
                  <div class="table-responsive">
                    <user-crud></user-crud>
                  </div>
                </div>
              </div>
            </div>
            <div id="tab-6-5" class="row tab-pane fade show" role="tabpanel" aria-labelledby="tab-6-5">
              <div class="row">
                <div class="p-0 col-lg-12 pb-5">
                  <div class="table-responsive">
                    <class-rate-crud></class-rate-crud>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <!-- DO NOT DELETE. THIS IS A CUSTOM VUE COMPONENT -->
      <subject-form></subject-form>
      <classroom-form></classroom-form>
      <level-form></level-form>
      <class-rate-form></class-rate-form>
      <user-form></user-form>
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
  <script src="{{ asset('assets/js/jquery/jquery-3.1.1.min.js') }}" defer></script>
  <script src="{{ asset('assets/js/bootstrap/popper.min.js') }}" defer></script>
  <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap/mdb.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/velocity/velocity.min.js') }}" defer></script>
  <script src="{{ asset('assets/plugins/velocity/velocity.ui.min.js') }}" defer></script>
  <script src="{{ asset('assets/plugins/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js') }}" defer></script>
  <script src="{{ asset('assets/plugins/jquery_visible/jquery.visible.min.js') }}" defer></script>
  <script src="{{ asset('assets/js/misc/ie10-viewport-bug-workaround.js') }}" defer></script>
  <script src="{{ asset('assets/js/misc/holder.min.js') }}" defer></script>
  <script src="{{ asset('assets/plugins/datatables/js/jquery.dataTables.min.js') }}" defer></script>
  <script src="{{ asset('assets/plugins/datatables/js/dataTables.bootstrap4.min.js') }}" defer></script>
  <script src="{{ asset('assets/plugins/datatables/js/dataTables.responsive.min.js') }}" defer></script>
  <script src="{{ asset('assets/js/scripts.js') }}" defer></script>
@endsection