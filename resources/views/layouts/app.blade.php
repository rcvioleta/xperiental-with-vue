<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Xperiental Learning Hub</title>

  <link rel="stylesheet" href="{{ asset('assets/fonts/batch-icons/css/batch-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/quillpro/quillpro.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">

  <!-- Styles -->
  {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>
<body>

    <div id="app">
        <el-container>
          <el-aside width="250px" id="sidebar">

            <side-bar user-name="Administrator"></side-bar>

          </el-aside>
          <el-main>

            @yield('content')

          <el-main>
        </el-container>
    </div>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>

  @yield('scripts')

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
