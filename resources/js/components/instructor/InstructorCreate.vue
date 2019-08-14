<template>
    <b-container fluid>
        <b-row>
            <b-col cols="6">
                <h1>Add Employee Record</h1>
            </b-col>
        </b-row>
        <b-row>
            <b-col>
                <b-card>
                    <b-form @submit="saveEmployee">
                        <b-row>
                            <b-col>
                                <h2>Employee Information</h2>
                                <b-row class="mb-4">
                                    <b-col cols="2">
                                        <label>Employee ID</label>
                                        <input type="text" class="form-control w-100" v-model="employeeData.id_num" maxlength="5" minlength="5" required>
                                    </b-col>
                                    <b-col cols="1">
                                        <label>Nickname</label>
                                        <input type="text" class="form-control w-100" v-model="employeeData.nickname" required>
                                    </b-col>
                                    <b-col>
                                        <label>Last name</label>
                                        <input type="text" class="form-control w-100" v-model="employeeData.last_name" required>
                                    </b-col>
                                    <b-col>
                                        <label>First name</label>
                                        <input type="text" class="form-control w-100" v-model="employeeData.first_name" required>
                                    </b-col>
                                    <b-col>
                                        <label>Middle name</label>
                                        <input type="text" class="form-control w-100" v-model="employeeData.middle_name">
                                    </b-col>
                                </b-row>
                                <b-row class="mb-4">
                                    <b-col cols="2">
                                        <b-form-group label="Gender">
                                            <b-form-radio-group name="radio-inline" class="mt-2">
                                                <b-form-radio v-model="employeeData.gender" value="Male">Male</b-form-radio>
                                                <b-form-radio v-model="employeeData.gender" value="Female">Female</b-form-radio>
                                            </b-form-radio-group>
                                        </b-form-group>
                                    </b-col>
                                    <b-col cols="2">
                                        <label for="validationCustom04">Birthdate</label>
                                        <input type="date" class="fallback form-control w-100" v-model="employeeData.bday">
                                    </b-col>
                                    <b-col cols="2">
                                        <label>Telephone/Phone</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="batch-icon batch-icon-headphones"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="sp_celphones form-control" v-model="employeeData.contact_num">
                                        </div>
                                    </b-col>
                                    <b-col cols="6">
                                        <label>Home Address</label>
                                        <input type="text" class="form-control w-100" v-model="employeeData.address" required>
                                    </b-col>
                                </b-row>
                            </b-col>
                        </b-row>
                        <hr>
                        <b-row class="mt-5 mb-5">
                            <b-col cols="3">
                                <h2>Profile Picture</h2>
                                <b-row>
                                    <b-col cols="12" class="mt-3">
                                        <img id="profImage" v-if="url" :src="url" class="profile-image" />
                                    </b-col>
                                    <b-col cols="12" class="mt-3">
                                        <b-form-file placeholder="Choose a file..." drop-placeholder="Drop file here..." @change="readURL" accept="image/gif, image/jpeg, image/png"></b-form-file>
                                    </b-col>
                                </b-row>
                            </b-col>
                            <b-col cols="9">
                                <h2>EMPLOYMENT DETAILS</h2>
                                <b-row>
                                    <b-col>
                                        <label>Position/Designation</label>
                                        <input type="text" class="form-control w-100" v-model="employeeData.position" required>
                                    </b-col>
                                    <b-col>
                                        <label for="validationCustom04">Hired Date</label>
                                        <input type="date" class="fallback form-control w-100" v-model="employeeData.hired_date">
                                    </b-col>
                                    <b-col>
                                        <label>Status</label>
                                        <select class="form-control w-100" v-model="employeeData.status" required>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </b-col>
                                </b-row>
                            </b-col>
                        </b-row>
                        <b-row class="mt-5 mb-3">
                            <b-col class="mt-5">
                                <button type="submit" class="btn btn-primary pull-right">Save Employee <i class="ml-2 batch-icon batch-icon-stiffy"></i></button>
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
                employeeData: {
                    id_num: '',
                    image: '',
                    nickname: '',
                    first_name: '',
                    middle_name: '',
                    last_name: '',
                    gender: '',
                    bday: '',
                    contact_num: '',
                    address: '',
                    position: '',
                    hired_date: '',
                    status: '1',
                },
            }
        },
        methods: {
            saveEmployee(e) {
                e.preventDefault();
                
                let data = new FormData();

                for(var key in this.employeeData)
                    data.append(key, this.employeeData[key]);

                axios.post('/admin/instructor/store', data)
                .then(response => {
                    swal("Success!", 
                        "Successfully added New Employee " + this.employeeData.first_name + ' ' + this.employeeData.last_name + ' with ID # ' + this.employeeData.id_num, 
                        "success")
                    .then((value) => {
                      this.$router.push('/instructor');
                    });
                })
                .catch(err=>{
                    swal("Error!", 
                        "Looks like something went wrong, please try again. If issue persist, please report this to your system developer.", 
                        "error");
                });

            },
            readURL(e) {
                this.employeeData.image = e.target.files[0];
                this.url = URL.createObjectURL(this.employeeData.image);
            }
        },
    }
</script>
