<template>
    <b-container fluid>
        <b-row>
            <b-col cols="12">
                <h1>Account Record:<strong> (ID: {{studentId}}) "{{nickname}}" {{ studentName }}</strong></h1>
            </b-col>
        </b-row>
        <b-row>
            <b-col>
                <ul class="nav nav-tabs custom-tab-headers" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#tab-1" data-toggle="tab" role="tab" aria-controls="tab-1" aria-selected="true">Account Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-2" data-toggle="tab" role="tab" aria-controls="tab-2" aria-selected="false">CLASS HISTORY</a>
                    </li>
                </ul>
                <b-card>
                    <div class="tab-content" id="student-account-details-tab">
                        <div id="tab-1" class="row tab-pane fade show active p-3 pb-0" role="tabpanel" aria-labelledby="tab-1">
                            <student-account-details></student-account-details>
                        </div>
                        <div id="tab-2" class="row tab-pane fade p-3 pb-0" role="tabpanel" aria-labelledby="tab-2">
                            <student-account-class-list></student-account-class-list>
                        </div>
                    </div>
                </b-card>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
    import StudentAccountClassList from '../../components/student-account/StudentAccountClassList';
    import StudentAccountDetails from '../../components/student-account/StudentAccountDetails';

    export default {
        props: ['id'],
        data() {
            return {
                studentName: '',
                nickname: '',
                studentId: ''
            }
        },
        components: {
            StudentAccountDetails,
            StudentAccountClassList,
        },
        created() {
            axios.get('/admin/studentaccount/edit/1/' + this.id)
            .then(response => {
                this.studentName = response.data.student.first_name + ' ' + (response.data.student.middle_name == '' ? '' : (response.data.student.middle_name + ' ')) + response.data.student.last_name;
                this.nickname = response.data.student.nickname;
                this.studentId = response.data.student.id_num;
                Event.$emit('studentaccount-edit', response.data);
            })
            .catch(err=>{
                swal("Error!", 
                    "Looks like something went wrong, please try again. If issue persist, please report this to your system developer.", 
                    "error");
            });
        },
    }
</script>
