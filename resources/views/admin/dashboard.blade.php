@extends('layouts.app')

@section('styling')
  <!-- <link rel="stylesheet" href="{{ asset('assets/fonts/batch-icons/css/batch-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/mdb.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/custom-scrollbar/jquery.mCustomScrollbar.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/hamburgers/hamburgers.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/demo/css/ui-icons-batch-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/quillpro/quillpro.css') }}"> -->
@endsection

@section('content')
    <!-- <div class="row">
        <div class="col-md-6 col-lg-6 col-xl-3 mb-5">
            <div class="card card-tile card-xs bg-primary bg-gradient text-center">
                <div class="card-body p-4">
                    <div class="tile-left">
                        <i class="batch-icon batch-icon-user-alt batch-icon-xxl"></i>
                    </div>
                    <div class="tile-right">
                        <div class="tile-number"></div>
                        <div class="tile-description">Enrolled Students</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3 mb-5">
            <div class="card card-tile card-xs bg-secondary bg-gradient text-center">
                <div class="card-body p-4">
                    <div class="tile-left">
                        <i class="batch-icon batch-icon-tag-alt-2 batch-icon-xxl"></i>
                    </div>
                    <div class="tile-right">
                        <div class="tile-number">{{ $total_instructors }}</div>
                        <div class="tile-description">Total Instructors</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3 mb-5">
            <div class="card card-tile card-xs bg-primary bg-gradient text-center">
                <div class="card-body p-4">
                    <div class="tile-left">
                        <i class="batch-icon batch-icon-list batch-icon-xxl"></i>
                    </div>
                    <div class="tile-right">
                        <div class="tile-number"></div>
                        <div class="tile-description">All Unused Credits</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3 mb-5">
            <div class="card card-tile card-xs bg-secondary bg-gradient text-center">
                <div class="card-body p-4">
                    <div class="tile-left">
                        <i class="batch-icon batch-icon-star batch-icon-xxl"></i>
                    </div>
                    <div class="tile-right">
                        <div class="tile-number">{{ $total_subjects }}</div>
                        <div class="tile-description">Total Subjects</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-xl-8 mb-5">
            
        </div>
        <div class="col-md-6 col-lg-6 col-xl-4 mb-5">
            <div class="card card-md">
                <div class="card-header">
                    Traffic Sources
                    <div class="header-btn-block">
                        <span class="data-range dropdown">
                            <a href="#" class="btn btn-primary dropdown-toggle waves-effect waves-light" id="navbar-dropdown-traffic-sources-header-button" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
                                <i class="batch-icon batch-icon-calendar"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-dropdown-traffic-sources-header-button">
                                <a class="dropdown-item" href="today.html">Today</a>
                                <a class="dropdown-item" href="week.html">This Week</a>
                                <a class="dropdown-item" href="month.html">This Month</a>
                                <a class="dropdown-item active" href="year.html">This Year</a>
                            </div>
                        </span>
                    </div>
                </div>
                <div class="card-body text-center">
                    <p class="text-left">Your top 5 traffic sources</p>
                    <div class="card-chart" data-chart-color-1="#07a7e3" data-chart-color-2="#32dac3" data-chart-color-3="#4f5b60" data-chart-color-4="#FCCF31" data-chart-color-5="#f43a59" style="width: 204.188px; height: 204.188px;"><iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; top: 0px; left: 0px; bottom: 0px; right: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe><canvas id="traffic-source" width="204.1875px" height="204.1875px" style="display: block;"></canvas></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-5 col-xl-3 mb-5">
            <div class="card card-md card-team-members">
                <div class="card-header">
                    Team Members
                </div>

                @foreach ($users as $user)
                    <div class="card-media-list mCustomScrollbar _mCS_1 mCS-autoHide"><div id="mCSB_1" class="mCustomScrollBox mCS-dark mCSB_vertical mCSB_inside" style="max-height: 305.004px;" tabindex="0"><div id="mCSB_1_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="ltr">
                        <div class="media clickable" data-qp-link="profiles-member-profile.html">
                            <div class="profile-picture bg-gradient bg-primary has-message float-right d-flex mr-3">
                                <img src="{{ asset('assets/img/profile-pic.jpg') }}" width="44" height="44" class="mCS_img_loaded">
                            </div>
                            <div class="media-body">
                                <div class="heading mt-1">
                                    {{ $user->name }}
                                </div>
                                <div class="subtext">{{ $user->email }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div id="mCSB_1_scrollbar_vertical" class="mCSB_scrollTools mCSB_1_scrollbar mCS-dark mCSB_scrollTools_vertical mCSB_scrollTools_onDrag_expand" style="display: block;"><div class="mCSB_draggerContainer"><div id="mCSB_1_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; display: block; height: 143px; max-height: 295px; top: 0px;"><div class="mCSB_dragger_bar" style="line-height: 30px;"></div></div><div class="mCSB_draggerRail"></div></div></div></div></div>
            </div>
        </div>
    </div> -->
    <!-- div class="row mb-5">
        <div class="col-md-12">
            <footer>
                Powered by - <a href="http://base5builder.com/?click_source=quillpro_footer_link" target="_blank" style="font-weight:300;color:#ffffff;background:#1d1d1d;padding:0 3px;">Base<span style="color:#ffa733;font-weight:bold">5</span>Builder</a>
            </footer>
        </div>
    </div> -->
@endsection

@section('scripts')
<!-- {{-- <script src="{{ asset('assets/js/jquery/jquery-3.1.1.min.js') }}"></script> --}}
<script src="{{ asset('assets/js/bootstrap/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap/mdb.min.js') }}"></script>
<script src="{{ asset('assets/plugins/velocity/velocity.min.js') }}"></script>
<script src="{{ asset('assets/plugins/velocity/velocity.ui.min.js') }}"></script>
<script src="{{ asset('assets/plugins/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery_visible/jquery.visible.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery_visible/jquery.visible.min.js') }}"></script>
<script src="{{ asset('assets/js/misc/ie10-viewport-bug-workaround.js') }}"></script>
<script src="{{ asset('assets/plugins/chartjs/chart.bundle.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jvmaps/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jvmaps/maps/jquery.vmap.usa.js') }}"></script>
<script src="{{ asset('assets/js/misc/holder.min.js') }}"></script> -->
@endsection
