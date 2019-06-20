
<a class="navbar-brand" href="/admin/home">
    <img src="/assets/img/logo-white.png" width="145" height="32.3" alt="QuillPro" class="mCS_img_loaded">
</a>
<el-menu class="el-menu-demo" mode="vertical" text-color="#fff">
    <el-submenu index="2">
        <template slot="title">
            <div class="mr-3 profile-picture bg-gradient bg-primary has-message float-left">
                <img src="/assets/img/profile-pic.jpg" width="44" height="44" class="mCS_img_loaded">
            </div>
        </template>
        <el-menu-item href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</el-menu-item>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
  </el-submenu>
</el-menu>

<div class="menu-line"></div>
<el-menu default-active="1" text-color="#fff" active-text-color="#fff">
    <el-menu-item index="1" onclick="window.location='/admin/home'"> 
        <i class="el-icon-menu"></i>
        <span>Dashboard</span>
    </el-menu-item>
    <div class="menu-text-divide">NAVIGATION</div>
    <el-menu-item onclick="window.location='/admin/classschedule'">
        <i class="el-icon-setting"></i>
        <span>Class Schedule</span>
    </el-menu-item>
    <el-submenu index="3">
        <template slot="title">
            <i class="el-icon-location"></i>
            <span>Student Management</span>
        </template>
        <el-menu-item index="3-1" onclick="window.location='/admin/studentmanagement'">Student List</el-menu-item>
        <el-menu-item index="3-2" onclick="window.location='/admin/studentmanagement/create'">Add Student</el-menu-item>
    </el-submenu>
    <el-submenu index="4">
        <template slot="title">
            <i class="el-icon-location"></i>
            <span>Enrollment Management</span>
        </template>
        <el-menu-item index="4-1" onclick="window.location='/admin/enrollment'">Enrollment List</el-menu-item>
        <el-menu-item index="4-2" onclick="window.location='/admin/enrollment/create'">Enroll Student</el-menu-item>
    </el-submenu>
    <el-submenu index="5">
        <template slot="title">
            <i class="el-icon-location"></i>
            <span>Employee Management</span>
        </template>
        <el-menu-item index="5-1" onclick="window.location='/admin/instructor'">Employee List</el-menu-item>
        <el-menu-item index="5-2" onclick="window.location='/admin/instructor/create'">Add Employee</el-menu-item>
    </el-submenu>
    <el-menu-item index="6" onclick="window.location='/admin/configurations'">
        <i class="el-icon-setting"></i>
        <span>Configurations</span>
    </el-menu-item>
    <el-menu-item index="7">
        <i class="el-icon-setting"></i>
        <span>Report Management</span>
    </el-menu-item>
</el-menu>
