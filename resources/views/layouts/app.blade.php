<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="assets/img/favicon.png">
  
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Xperiental Learning Hub</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700&amp;subset=latin-ext" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('assets/fonts/batch-icons/css/batch-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/quillpro/quillpro.css') }}">

  <!-- Styles -->
  {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>
<body>
    <div id="app">
        <el-container>
          <el-aside width="270px" id="sidebar">

            <side-bar user-name="Administrator"></side-bar>

          </el-aside>
          <el-main>

            <transition name="fade">
              <router-view></router-view>
            </transition>   

          <el-main>
        </el-container>
    </div>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>

  @yield('scripts')

</body>
</html>
