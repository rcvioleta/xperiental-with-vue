<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="assets/img/favicon.png">

  <title>Login - Xperiental Learning Hub</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700&amp;subset=latin-ext" rel="stylesheet">

  <!-- CSS - REQUIRED - START -->
  <!-- Batch Icons -->
  <link rel="stylesheet" href="{{ asset('assets/fonts/batch-icons/css/batch-icons.css') }}">
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/mdb.min.css') }}">
  <!-- Custom Scrollbar -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/custom-scrollbar/jquery.mCustomScrollbar.min.css') }}">
  <!-- Hamburger Menu -->
  <link rel="stylesheet" href="{{ asset('assets/css/hamburgers/hamburgers.css') }}">

  <!-- CSS - REQUIRED - END -->

  <!-- CSS - OPTIONAL - START -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome/css/font-awesome.min.css') }}">

  <!-- CSS - DEMO - START -->
  <link rel="stylesheet" href="{{ asset('assets/demo/css/ui-icons-batch-icons.css') }}">
  <!-- CSS - DEMO - END -->

  <!-- CSS - OPTIONAL - END -->

  <!-- QuillPro Styles -->
  <link rel="stylesheet" href="{{ asset('assets/css/quillpro/quillpro.css') }}">
</head>

<body>

  <div class="container-fluid">
    <div class="row">
      <div class="right-column sisu">
        <div class="row mx-0">
          <div class="col-md-7 order-md-2 signin-right-column px-5 bg-dark" style="background-image: url(assets/img/login-bg-3.jpg);">
            <a class="signin-logo d-sm-block d-md-none" href="#">
              <img src="assets/img/logo-white.png" width="145" height="32.3" alt="QuillPro">
            </a>
            <h1 class="display-4">MESSAGE AND SLOGAN HERE</h1>
            <p class="lead mb-5">
              Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
            </p>
          </div>
          <div class="col-md-5 order-md-1 signin-left-column bg-white px-5">
            <a class="signin-logo d-sm-none d-md-block" href="#">
              <img src="assets/img/logo-dark.png" width="145" height="32.3" alt="QuillPro">
            </a>
            @if (count($errors) > 0)
              {{ $errors }}
            @endif
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <!-- <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"> -->
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                @endif
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <!-- <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"> -->
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="keep-signed-in">
                <!-- <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> -->
                <label class="custom-control-label" for="keep-signed-in">Keep Me Signed In</label>
              </div>
              <button type="submit" class="btn btn-primary btn-gradient btn-block">
                <i class="batch-icon batch-icon-key"></i>
                Sign In
              </button>
              @if (Route::has('password.request'))
                <a style="display: none;" class="btn btn-link" href="{{ route('password.request') }}">
                  {{ __('Forgot Your Password?') }}
                </a>
              @endif
              <!-- <hr>
              <p class="text-center">
                Don't Have An Account? <a href="sisu-signup.html">Sign Up here</a>
              </p> -->
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- SCRIPTS - REQUIRED START -->
  <!-- Placed at the end of the document so the pages load faster -->
  <!-- Bootstrap core JavaScript -->
  <!-- JQuery -->
  <script type="text/javascript" src="{{ asset('assets/js/jquery/jquery-3.1.1.min.js') }}"></script>
  <!-- Popper.js - Bootstrap tooltips -->
  <script type="text/javascript" src="{{ asset('assets/js/bootstrap/popper.min.js') }}"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="{{ asset('assets/js/bootstrap/mdb.min.js') }}"></script>
  <!-- Velocity -->
  <script type="text/javascript" src="{{ asset('assets/plugins/velocity/velocity.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/plugins/velocity/velocity.ui.min.js') }}"></script>
  <!-- Custom Scrollbar -->
  <script type="text/javascript" src="{{ asset('assets/plugins/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
  <!-- jQuery Visible -->
  <script type="text/javascript" src="{{ asset('assets/plugins/jquery_visible/jquery.visible.min.js') }}"></script>
  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <script type="text/javascript" src="{{ asset('assets/js/misc/ie10-viewport-bug-workaround.js') }}"></script>

  <!-- SCRIPTS - REQUIRED END -->

  <!-- SCRIPTS - OPTIONAL START -->
  <!-- Image Placeholder -->
  <script type="text/javascript" src="{{ asset('assets/js/misc/holder.min.js') }}"></script>
  <!-- SCRIPTS - OPTIONAL END -->

  <!-- QuillPro Scripts -->
  <script type="text/javascript" src="{{ asset('assets/js/scripts.js') }}"></script>
</body>

</html>
