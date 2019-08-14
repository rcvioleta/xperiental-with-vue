<template>
    <b-card>
        <b-form @submit="saveForm">
            <h3>Add {{ formType }}</h3>
            <hr>    
            <b-row class="mb-5" v-if="subject">
                <b-col class="mt-3">
                    <label>Subject Name</label>
                    <input type="text" class="form-control w-100" v-model="formData.subject_name" required>
                </b-col>
                <b-col class="mt-3">
                    <label>Status</label>
                    <select class="form-control w-100" v-model="formData.subject_status" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </b-col>
            </b-row>
            <b-row class="mb-5" v-if="classroom">
                <b-col class="mt-3">
                    <label>Classroom Name</label>
                    <input type="text" class="form-control w-100" v-model="formData.classroom_name" required>
                </b-col>
                <b-col class="mt-3">
                    <label>Status</label>
                    <select class="form-control w-100" v-model="formData.classroom_status" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </b-col>
            </b-row>
            <b-row class="mb-5" v-if="grade">
                <b-col class="mt-3">
                    <label>Grade Name</label>
                    <input type="text" class="form-control w-100" v-model="formData.grade_name" required>
                </b-col>
                <b-col class="mt-3">
                    <label>Status</label>
                    <select class="form-control w-100" v-model="formData.grade_status" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </b-col>
            </b-row>
            <b-row class="mb-5" v-if="user">
                <b-col cols="12" class="mt-3">
                    <label>Profile Name</label>
                    <input type="text" class="form-control w-100" v-model="formData.user_name" required>
                </b-col>
                <b-col cols="12" class="mt-3">
                    <label>Email</label>
                    <input type="text" class="form-control w-100" v-model="formData.email" required>
                </b-col>
                <b-col cols="6" class="mt-3">
                    <label>Profile Picture</label>
                    <input type="text" class="form-control w-100" v-model="formData.user_image" required>
                </b-col>
                <b-col cols="6" class="mt-3">
                    <label>Status</label>
                    <select class="form-control w-100" v-model="formData.user_status" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </b-col>
                <b-col cols="12" class="mt-3">
                    <label>Password</label>
                    <input type="password" class="form-control w-100" v-model="formData.password" required>
                </b-col>
                <b-col cols="12" class="mt-3">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control w-100" v-model="formData.confirm_password" required>
                </b-col>
            </b-row>
            <b-row class="mb-5" v-if="classtype">
                <b-col cols="6" class="mt-3">
                    <label>Class Type Name</label>
                    <input type="text" class="form-control w-100" v-model="formData.classtype_name" required>
                </b-col>
                <b-col cols="6" class="mt-3">
                    <label>Rate</label>
                    <input type="text" class="form-control w-100" v-model="formData.rate" required>
                </b-col>
                <b-col cols="6" class="mt-3">
                    <label>Status</label>
                    <select class="form-control w-100" v-model="formData.classtype_status" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </b-col>
            </b-row>
            <b-row class="pt-5">
                <b-col>
                    <button type="submit" class="btn btn-primary pull-right">Save {{ formType }} <i class="ml-2 batch-icon batch-icon-stiffy"></i></button>
                </b-col>
            </b-row>
        </b-form>
    </b-card>
</template>

<script>
    export default {
        data() {
            return {
                subject: true,
                classroom: false,
                grade: false,
                user: false,
                classtype: false,
                formType: 'Subject',
                eventType: 'configuration-subject-list',
                postUrl: '/admin/subject/store',
                formData: {
                    subject_name: '',
                    subject_status: '1',
                    classroom_name: '',
                    classroom_status: '1',
                    grade_name: '',
                    grade_status: '1',
                    user_name: '',
                    user_image: '',
                    email: '',
                    password: '',
                    confirm_password: '',
                    user_status: '1',
                    classtype_name: '',
                    rate: '',
                    classtype_status: '1'
                }
            }
        },
        created() {
            Event.$on('configuration-form', (configuration) => {
                this.changeForm(configuration);
            });
        },
        methods: {
            saveForm(e) {
                e.preventDefault();

                let data = new FormData();

                for(var key in this.formData)
                    data.append(key, this.formData[key]);

                axios.post(this.postUrl, data)
                .then(response => {

                    Event.$emit(this.eventType, response.data.newlist);
                    this.resetForm();
                    swal("Success!", "Successfully added New " + this.formType, "success");
                })
                .catch(err=>{
                    swal("Error!", 
                        "Looks like something went wrong, please try again. If issue persist, please report this to your system developer.", 
                        "error");
                });
            },
            changeForm(type) {
                if(type == 'tab_1') {
                    this.subject = true;
                    this.formType = 'Subject';
                    this.postUrl = '/admin/subject/store';
                    this.eventType = 'configuration-subject-list';
                } else this.subject = false;

                if(type == 'tab_2') {
                    this.classroom = true;
                    this.formType = 'Classroom';
                    this.postUrl = '/admin/classroom/store';
                    this.eventType = 'configuration-classroom-list';
                } else this.classroom = false;

                if(type == 'tab_3') {
                    this.grade = true;
                    this.formType = 'Grade';
                    this.postUrl = '/admin/student-level/store';
                    this.eventType = 'configuration-studentLevel-list';
                } else this.grade = false;

                if(type == 'tab_4') {
                    this.user = true;
                    this.formType = 'System User';
                    this.postUrl = '/admin/user/store';
                    this.eventType = 'configuration-user-list';
                } else this.user = false;

                if(type == 'tab_5') {
                    this.classtype = true;
                    this.formType = 'Class Type';
                    this.postUrl = '/admin/class-rate/store';
                    this.eventType = 'configuration-classRate-list';
                } else this.classtype = false;
            },
            resetForm() {
                var self = this
                Object.keys(self.formData).forEach(function(key,index) {
                    self.formData[key] = '';
                })

                this.formData.subject_status = '1';
                this.formData.classroom_status = '1';
                this.formData.grade_status = '1';
                this.formData.user_status = '1';
                this.formData.classtype_status = '1';
            }
        },
    }
</script>
