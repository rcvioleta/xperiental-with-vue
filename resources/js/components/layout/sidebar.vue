<template>
    <div>
        <a class="navbar-brand" href="/admin/dashboard">
            <img src="/assets/img/logo-white.png" width="145" height="32.3" alt="QuillPro" class="mCS_img_loaded">
        </a>
        <el-menu class="el-menu-demo" mode="vertical" text-color="#fff">
            <el-submenu index="2">
                <template slot="title">
                    <div class="mr-3 profile-picture bg-gradient bg-primary has-message float-left">
                        <img src="/assets/img/profile-pic.jpg" width="44" height="44" class="mCS_img_loaded">
                    </div>
                    <span class="username-menu">{{ userName }}</span>
                </template>
                <el-menu-item @click="logout">Logout</el-menu-item>
            </el-submenu>
        </el-menu>

        <div class="menu-line"></div>
        <el-menu default-active="1" text-color="#fff" active-text-color="#fff" :router="true">
            <el-menu-item index="2" onclick="window.location='/admin'"> 
                <i class="el-icon-menu"></i>
                <span>Dashboard</span>
            </el-menu-item>
            <div class="menu-text-divide">NAVIGATION</div>
            <el-menu-item index="7" :route="{path:'/classschedule'}">
                <i class="el-icon-date"></i>
                <span>Class Schedule</span>
            </el-menu-item>
            <el-submenu index="3">
                <template slot="title">
                    <i class="el-icon-user"></i>
                    <span>Student Management</span>
                </template>
                <el-menu-item index="3-1" :route="{path:'/studentmanagement'}">Student List</el-menu-item>
                <el-menu-item index="3-2" :route="{path:'/studentmanagement/create'}">Add Student</el-menu-item>
            </el-submenu>
            <el-menu-item index="4" :route="{path:'/studentaccount'}">
                <i class="el-icon-notebook-1"></i>
                <span>Student Account</span>
            </el-menu-item>
            <el-submenu index="5">
                <template slot="title">
                    <i class="el-icon-suitcase-1"></i>
                    <span>Employee Management</span>
                </template>
                <el-menu-item index="5-1" :route="{path:'/instructor'}">Employee List</el-menu-item>
                <el-menu-item index="5-2" :route="{path:'/instructor/create'}">Add Employee</el-menu-item>
            </el-submenu>
            <el-menu-item index="6" :route="{path:'/configuration'}">
                <i class="el-icon-setting"></i>
                <span>Configurations</span>
            </el-menu-item>
            <!-- <el-menu-item index="7" onclick="window.location='/admin/report'">
                <i class="el-icon-folder-opened"></i>
                <span>Report Management</span>
            </el-menu-item> -->
        </el-menu>
    </div>
</template>

<script>

    export default {
        props: ['logoutRoute', 'userName'],
        data: () => ({
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }), 
        methods: {
        logout:function(){
            axios.post('/logout').then(response => {
                if (response.status === 302 || 401) {
                    window.location = '/    ';
                }
                else {
                    // throw error and go to catch block
                }
            }).catch(error => {

            });
        },
    }
}
</script>
