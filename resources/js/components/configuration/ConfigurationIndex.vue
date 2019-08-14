<template>
    <b-container fluid>
        <b-row>
            <b-col cols="6">
                <h1>Configurations</h1>
            </b-col>
        </b-row>
        <b-row>
            <b-col cols="8">
                <ul class="nav nav-tabs custom-tab-headers" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" @click="changeTab('tab_1')" href="#tab_1" data-toggle="tab" role="tab" aria-controls="tab_1" aria-selected="true">Subjects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" @click="changeTab('tab_2')" href="#tab_2" data-toggle="tab" role="tab" aria-controls="tab_2" aria-selected="false">Classrooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" @click="changeTab('tab_3')" href="#tab_3" data-toggle="tab" role="tab" aria-controls="tab_3" aria-selected="false">Grade Level</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" @click="changeTab('tab_4')" href="#tab_4" data-toggle="tab" role="tab" aria-controls="tab_4" aria-selected="false">System Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" @click="changeTab('tab_5')" href="#tab_5" data-toggle="tab" role="tab" aria-controls="tab_5" aria-selected="false">Class Type</a>
                    </li>
                </ul>
                <b-card>
                    <div class="tab-content" id="student-account-details-tab">
                        <div id="tab_1" class="row tab-pane fade show active p-3 pb-0" role="tabpanel" aria-labelledby="tab_1">
                            <subject-list></subject-list>
                        </div>
                        <div id="tab_2" class="row tab-pane fade p-3 pb-0" role="tabpanel" aria-labelledby="tab_2">
                            <classroom-list></classroom-list>
                        </div>
                        <div id="tab_3" class="row tab-pane fade p-3 pb-0" role="tabpanel" aria-labelledby="tab_3">
                            <student-level-list></student-level-list>
                        </div>
                        <div id="tab_4" class="row tab-pane fade p-3 pb-0" role="tabpanel" aria-labelledby="tab_4">
                            <user-list></user-list>
                        </div>
                        <div id="tab_5" class="row tab-pane fade p-3 pb-0" role="tabpanel" aria-labelledby="tab_5">
                            <class-rate-list></class-rate-list>
                        </div>
                    </div>
                </b-card>
            </b-col>
            <b-col cols="4">
                <configuration-form></configuration-form>
                <configuration-modal></configuration-modal>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
    import SubjectList from '../../components/configuration/SubjectList';
    import ClassroomList from '../../components/configuration/ClassroomList';
    import StudentLevelList from '../../components/configuration/StudentLevelList';
    import ClassRateList from '../../components/configuration/ClassRateList';
    import UserList from '../../components/configuration/UserList';
    import ConfigurationForm from '../../components/configuration/ConfigurationForm';
    import ConfigurationModal from '../../components/configuration/ConfigurationModal';

    export default {
        components: {
            SubjectList,
            ClassroomList,
            StudentLevelList,
            ClassRateList,
            UserList,
            ConfigurationForm,
            ConfigurationModal
        },
        created() {
            axios.get('/admin/configuration')
            .then(response => {
                Event.$emit('configuration-subject-list', response.data.subject);
                Event.$emit('configuration-classroom-list', response.data.classroom);
                Event.$emit('configuration-studentLevel-list', response.data.studentLevel);
                Event.$emit('configuration-user-list', response.data.user);
                Event.$emit('configuration-classRate-list', response.data.classRate);
            })
            .catch(err=>{
                swal("Error!", 
                    "Looks like something went wrong, please try again. If issue persist, please report this to your system developer.", 
                    "error");
            });
        },
        methods: {
            changeTab(data) {
                Event.$emit('configuration-form', data);
            }
        }
    }
</script>
