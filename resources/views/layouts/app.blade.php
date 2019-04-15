<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Xperiental Learning Hub</title>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> --}}

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

  <!-- start template assets -->
	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700&amp;subset=latin-ext" rel="stylesheet">

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
    <!-- end template assets -->
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

  <!-- start template assets -->
	<script src="{{ asset('assets/js/jquery/jquery-3.1.1.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap/popper.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap/mdb.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/velocity/velocity.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/velocity/velocity.ui.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/jquery_visible/jquery.visible.min.js') }}"></script>
	<script src="{{ asset('assets/js/misc/ie10-viewport-bug-workaround.js') }}"></script>
	<script src="{{ asset('assets/js/misc/holder.min.js') }}"></script>
	<!-- Datatables -->
	<script src="{{ asset('assets/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
	<script src="{{ asset('assets/js/scripts.js') }}"></script>
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
	</script>
    <!-- end template assets -->
</body>
</html>
