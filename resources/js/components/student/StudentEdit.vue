<template>
    <b-container fluid>
        <b-row>
            <b-col cols="6">
                <h1>Update Student Record</h1>
            </b-col>
        </b-row>
        <b-row>
            <b-col>
                <ul class="nav nav-tabs custom-tab-headers" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#tab-1" data-toggle="tab" role="tab" aria-controls="tab-1" aria-selected="true">Personal Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-2" data-toggle="tab" role="tab" aria-controls="tab-2" aria-selected="false">Educational Background</a>
                    </li>
                </ul>
                <b-card>
                    <div class="tab-content" id="student-account-details-tab">
                        <div id="tab-1" class="row tab-pane fade show active p-3 pb-0" role="tabpanel" aria-labelledby="tab-1">
                            <student-details></student-details>
                        </div>
                        <div id="tab-2" class="row tab-pane fade p-3 pb-0" role="tabpanel" aria-labelledby="tab-2">
                            <student-educational-list></student-educational-list>
                        </div>
                    </div>
                </b-card>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
    import StudentEducationalList from '../../components/student/StudentEducationalList';
    import StudentDetails from '../../components/student/StudentDetails';

    export default {
        props: ['id'],
        components: {
            StudentEducationalList,
            StudentDetails,
        },
        created() {
            axios.get('/admin/studentmanagement/edit/' + this.id)
            .then(response => {
                console.log(response.data);
                Event.$emit('studentmanagement-edit', response.data);
            })
            .catch(err=>{
                swal("Error!", 
                    "Looks like something went wrong, please try again. If issue persist, please report this to your system developer.", 
                    "error");
            });
        },
    }
</script>
