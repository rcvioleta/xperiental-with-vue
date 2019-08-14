<template>
    <b-container fluid>
        <b-row>
            <b-col cols="6">
                <h1>Add Student Record</h1>
            </b-col>
        </b-row>
        <b-row>
            <b-col>
                <b-card>
                    <b-form @submit="saveStudent">
                        <b-row>
                            <b-col>
                                <h2>Student Information</h2>
                                <b-row class="mb-4">
                                    <b-col cols="2">
                                        <label>Student ID</label>
                                        <input type="text" class="form-control w-100" v-model="studentData.id_num" maxlength="5" minlength="5" required>
                                    </b-col>
                                    <b-col cols="1">
                                        <label>Nickname</label>
                                        <input type="text" class="form-control w-100" v-model="studentData.nickname" required>
                                    </b-col>
                                    <b-col>
                                        <label>Last name</label>
                                        <input type="text" class="form-control w-100" v-model="studentData.last_name" required>
                                    </b-col>
                                    <b-col>
                                        <label>First name</label>
                                        <input type="text" class="form-control w-100" v-model="studentData.first_name" required>
                                    </b-col>
                                    <b-col>
                                        <label>Middle name</label>
                                        <input type="text" class="form-control w-100" v-model="studentData.middle_name">
                                    </b-col>
                                </b-row>
                                <b-row class="mb-4">
                                    <b-col cols="2">
                                        <b-form-group label="Gender">
                                            <b-form-radio-group name="radio-inline" class="mt-2">
                                                <b-form-radio v-model="studentData.gender" value="Male">Male</b-form-radio>
                                                <b-form-radio v-model="studentData.gender" value="Female">Female</b-form-radio>
                                            </b-form-radio-group>
                                        </b-form-group>
                                    </b-col>
                                    <b-col cols="2">
                                        <label for="validationCustom04">Birthdate</label>
                                        <input type="date" class="fallback form-control w-100" v-model="studentData.birth_date">
                                    </b-col>
                                    <b-col cols="2">
                                        <label>Telephone/Phone</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="batch-icon batch-icon-headphones"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="sp_celphones form-control" v-model="studentData.phone_number">
                                        </div>
                                    </b-col>
                                    <b-col cols="6">
                                        <label>Home Address</label>
                                        <input type="text" class="form-control w-100" v-model="studentData.address" required>
                                    </b-col>
                                </b-row>
                                <b-row class="mb-4">
                                    <b-col cols="4">
                                        <label for="avatar">Profile Picture</label>
                                        <b-row>
                                            <b-col cols="12">
                                                <img id="profImage" v-if="url" :src="url" class="profile-image" />
                                            </b-col>
                                            <b-col cols="12">
                                                <b-form-file placeholder="Choose a file..." drop-placeholder="Drop file here..." @change="readURL" accept="image/gif, image/jpeg, image/png"></b-form-file>
                                            </b-col>
                                        </b-row>
                                    </b-col>
                                    <b-col cols="2">
                                        <label>Registration Date</label>
                                        <input type="date" class="fallback form-control w-100" v-model="studentData.registration_date">
                                    </b-col>
                                    <b-col cols="2">
                                        <label>Status</label>
                                        <select class="form-control w-100" v-model="studentData.status" required>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </b-col>
                                </b-row>
                            </b-col>
                        </b-row>
                        <hr>
                        <b-row class="mt-5 mb-5">
                            <b-col>
                                <h2>Emergency Contact</h2>
                                <b-row>
                                    <b-col>
                                        <label>Full Name</label>
                                        <input type="text" class="form-control w-100" v-model="studentData.emcon_full_name" required>
                                    </b-col>
                                    <b-col>
                                        <label>Telephone/Phone</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend-6">
                                                    <i class="batch-icon batch-icon-headphones"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="sp_celphones form-control" v-model="studentData.emcon_phone_number">
                                        </div>
                                    </b-col>
                                    <b-col>
                                        <label>Relation to Student</label>
                                        <input type="text" class="form-control w-100" v-model="studentData.emcon_relationship" required>
                                    </b-col>
                                    <b-col>
                                        <label>Home Address</label>
                                        <input type="text" class="form-control w-100" v-model="studentData.emcon_address" required>
                                    </b-col>
                                </b-row>
                            </b-col>
                        </b-row>
                        <b-row class="mt-5 mb-3">
                            <b-col class="mt-5">
                                <button type="submit" class="btn btn-primary pull-right">Save Student <i class="ml-2 batch-icon batch-icon-stiffy"></i></button>
                            </b-col>
                        </b-row> 
                    </b-form>      
                </b-card>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
    export default {
        data() {
            return {
                url: null,
                studentData: {
                    id_num: '',
                    image: '',
                    first_name: '',
                    middle_name: '',
                    last_name: '',
                    gender: '',
                    birth_date: '',
                    phone_number: '',
                    address: '',
                    emcon_full_name: '',
                    emcon_phone_number: '',
                    emcon_relationship: '',
                    emcon_address: '',
                    nickname: '',
                    registration_date: '',
                    status: '1'
                },
            }
        },
        methods: {
            saveStudent(e) {
                e.preventDefault()

                let data = new FormData();

                for(var key in this.studentData)
                    data.append(key, this.studentData[key]);

                axios.post('/admin/studentmanagement/store', data)
                .then(response => {
                    swal("Success!", 
                        "Successfully added New Student " + this.studentData.first_name + ' ' + this.studentData.last_name + ' with ID # ' + this.studentData.id_num, 
                        "success")
                    .then((value) => {
                      this.$router.push('/studentmanagement');
                    });
                })
                .catch(err=>{
                    swal("Error!", 
                        "Looks like something went wrong, please try again. If issue persist, please report this to your system developer.", 
                        "error");
                });

            },
            readURL(e) {
                this.studentData.image = e.target.files[0];
                this.url = URL.createObjectURL(this.studentData.image);
            }
        },
    }
</script>
