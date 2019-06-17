<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Xperiental Learning Hub</title>

  <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <!-- Styles -->
  {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

  @yield('styling')
  <style type="text/css">
		.nav-tabs .nav-link.active {
      font-weight: bold;
		}
		.nav-tabs .nav-link {
      padding: 10px 16px;
      margin-right: 4px;
      background-color: #f5f5f5;
      border: 1px solid #e7e7e7;
		}
		.dropdown-menu {
      width: 200px;
		}
		#sidebar .dropdown-toggle::after {
      float: right; 
      top: -30px;
      position: relative;
		}
		#sidebar .nav-item.dropdown {
			height: 70px;
		}
		#sidebar hr {
      border-top: 1px solid rgba(245, 245, 245, 0.3);
      width: 90%;
		}
	</style>
</head>
<body>

    <div id="app">
        {{-- default bootstrap navigation --}}
        {{-- <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}

        <div class="container-fluid">
            <div class="row">

                @include('admin.includes.sidebar')
                <div class="right-column">
                    <main class="main-content p-5" role="main">
                        @yield('content')
                    </div>
                </div>

            </div>
        </div>

    </div>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>

  @yield('scripts')

  <script src="{{ asset('assets/plugins/datatables/js/jquery.dataTables.min.js') }}" defer></script>
  <script src="{{ asset('assets/plugins/datatables/js/dataTables.bootstrap4.min.js') }}" defer></script>
  <script src="{{ asset('assets/plugins/datatables/js/dataTables.responsive.min.js') }}" defer></script>
  <script src="{{ asset('assets/js/scripts.js') }}" defer></script>

  <!-- MultiSelect and Quicksearch -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/multi-select.css') }}" v>
  <script src="{{ asset('assets/jquery.quicksearch.js') }}" defer></script>
  <script src="{{ asset('assets/jquery.multi-select.js') }}" defer></script>
  <!-- End Important -->

  <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}" defer></script>


	<script>
		function SubjectAdd() {
			$('#subject-add').css('display','block');
			$('#classroom-add').css('display','none');
			$('#level-add').css('display','none');
			$('#system-add').css('display','none');
			$('#class-rate-add').css('display','none');
		}
		function ClassroomAdd() {
			$('#subject-add').css('display','none');
			$('#classroom-add').css('display','block');
			$('#level-add').css('display','none');
			$('#system-add').css('display','none');
			$('#class-rate-add').css('display','none');
		}
		function LevelsAdd() {
			$('#subject-add').css('display','none');
			$('#classroom-add').css('display','none');
			$('#level-add').css('display','block');
			$('#system-add').css('display','none');
			$('#class-rate-add').css('display','none');
		}
		function SystemAdd() {
			$('#subject-add').css('display','none');
			$('#classroom-add').css('display','none');
			$('#level-add').css('display','none');
			$('#system-add').css('display','block');
			$('#class-rate-add').css('display','none');
		}
		function ClassRateAdd() {
			$('#subject-add').css('display','none');
			$('#classroom-add').css('display','none');
			$('#level-add').css('display','none');
			$('#system-add').css('display','none');
			$('#class-rate-add').css('display','block');
		}
    // $(document).ready(function(){
      // $('#callbacks').multiSelect();
      // alert("1");
    // })

    $(document).ready(function(){

      function messageToastr(type, msg) {

        toastr[type](msg, (type=='success'? 'Success':'Error'));

        toastr.options = {
          "closeButton": true,
          "debug": false,
          "positionClass": "toast-top-right",
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "50000",  
          "extendedTimeOut": "10000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }

      }

      @if(session()->has('message'))
        messageToastr('success', '{!! session('message') !!}' );
      @endif

    });

	</script>
  <!-- end template assets -->
</body>
</html>
