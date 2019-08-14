<template>
    <b-modal :title="'Edit ' + formType" :ok-title="'Update ' + formType" @ok="updateForm" v-model="show">  
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
                <input type="text" class="form-control w-100" v-model="formData.user_image">
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
                <input type="password" class="form-control w-100" v-model="formData.password">
            </b-col>
            <b-col cols="12" class="mt-3">
                <label>Confirm Password</label>
                <input type="password" class="form-control w-100" v-model="formData.confirm_password">
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
    </b-modal>
</template>

<script>
    export default {
        data() {
            return {
                show: false,
                subject: true,
                classroom: false,
                grade: false,
                user: false,
                classtype: false,
                formType: '',
                eventType: '',
                postUrl: '',
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
            Event.$on('configuration-modal', (configuration) => {
                this.dataForm(configuration);
            });
        },
        methods: {
            updateForm() {

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
            dataForm(items) {
                this.show = true;

                if(items.type == 'tab_1') {
                    this.subject = true;
                    this.formType = 'Subject';
                    this.postUrl = '/admin/subject/update/' + items.data.id;
                    this.eventType = 'configuration-subject-list';

                    this.formData.subject_name = items.data.name;
                    this.formData.subject_status = items.data.status;
                } else this.subject = false;

                if(items.type == 'tab_2') {
                    this.classroom = true;
                    this.formType = 'Classroom';
                    this.postUrl = '/admin/classroom/update/' + items.data.id;
                    this.eventType = 'configuration-classroom-list';

                    this.formData.classroom_name = items.data.name;
                    this.formData.classroom_status = items.data.status;
                } else this.classroom = false;

                if(items.type == 'tab_3') {
                    this.grade = true;
                    this.formType = 'Grade';
                    this.postUrl = '/admin/student-level/update/' + items.data.id;
                    this.eventType = 'configuration-studentLevel-list';

                    this.formData.grade_name = items.data.name;
                    this.formData.grade_status = items.data.status;
                } else this.grade = false;

                if(items.type == 'tab_4') {
                    this.user = true;
                    this.formType = 'System User';
                    this.postUrl = '/admin/user/update/' + items.data.id;
                    this.eventType = 'configuration-user-list';

                    this.formData.user_name = items.data.name;
                    this.formData.user_image = items.data.avatar;
                    this.formData.email = items.data.email;
                    this.formData.user_status = items.data.status;
                } else this.user = false;

                if(items.type == 'tab_5') {
                    this.classtype = true;
                    this.formType = 'Class Type';
                    this.postUrl = '/admin/class-rate/update/' + items.data.id;
                    this.eventType = 'configuration-classRate-list';

                    this.formData.classtype_name = items.data.name;
                    this.formData.rate = items.data.rate;
                    this.formData.classtype_status = items.data.status;
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
