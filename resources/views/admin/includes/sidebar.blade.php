<nav id="sidebar" class="px-0 bg-dark bg-gradient sidebar mCustomScrollbar _mCS_4 mCS-autoHide" style="width: 240px; height: 377px;"><button class="hamburger hamburger--slider" type="button" data-target=".sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle Sidebar"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button><div id="mCSB_4" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside" tabindex="0" style="max-height: none;"><div id="mCSB_4_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="ltr">
    <ul class="nav nav-pills flex-column">
      <li class="logo-nav-item">
        <a class="navbar-brand" href="#">
          <img src="{{ asset('assets/img/logo-white.png') }}" width="145" height="32.3" alt="QuillPro" class="mCS_img_loaded">
        </a>

      </li>
      <br>
      <li class="nav-item dropdown">
        <!-- <ul class="navbar-nav ml-5 navbar-profile">
          <li class="nav-item dropdown"> -->
            <a class="nav-link dropdown-toggle" id="navbar-dropdown-navbar-profile" data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
              <div class="mr-3 profile-picture bg-gradient bg-primary has-message float-left">
                <img src="{{ asset('assets/img/profile-pic.jpg') }}" width="44" height="44" class="mCS_img_loaded">
              </div>
              <div class="profile-name">
                Jane Doe
              </div>
              <div>
                Administrator
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-dropdown-navbar-profile">
              <li><a class="dropdown-item" href="#">Profile</a></li>
              <li><a class="dropdown-item" href="login.html">Logout</a></li>
            </ul>
          <!-- </li>
        </ul> -->
      </li>
      <hr>
      <li class="nav-item">
        <a class="nav-link active" href="{{ route('home') }}">
          <i class="batch-icon batch-icon-browser-alt" style="font-weight: bold"></i>
          Dashboard <span class="sr-only">(current)</span>
        </a>
      </li>
      <li>
        <h6 class="mt-0 nav-header">Navigation</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link nav-parent" href="#">
          <i class="batch-icon batch-icon-users"></i>
          Student Management
        </a>
        <ul class="nav nav-pills flex-column">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('student-list') }}">
              <i class="batch-icon batch-icon-bullet"></i>
              Student List
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('add-student') }}">
              <i class="batch-icon batch-icon-bullet"></i>
              Add Student
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('class-calendar') }}">
          <i class="batch-icon batch-icon-calendar"></i>
          Class Schedule
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('configurations') }}">
          <i class="batch-icon batch-icon-unite"></i>
          Configurations
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="batch-icon batch-icon-layout-center-column"></i>
          Generate Reports
        </a>
      </li>
    </ul>
  </div><div id="mCSB_4_scrollbar_vertical" class="mCSB_scrollTools mCSB_4_scrollbar mCS-light mCSB_scrollTools_vertical mCSB_scrollTools_onDrag_expand" style="display: block;"><div class="mCSB_draggerContainer"><div id="mCSB_4_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; height: 297px; top: 0px; display: block; max-height: 367px;"><div class="mCSB_dragger_bar" style="line-height: 30px;"></div></div><div class="mCSB_draggerRail"></div></div></div></div></nav>