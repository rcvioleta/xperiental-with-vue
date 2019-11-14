<template>
    <b-container fluid>
        <b-row>
            <b-col cols="6">
                <h1>Class Calendar</h1>
            </b-col>
        </b-row>
        <b-row>
            <b-col>
                <b-card>
                    <full-calendar 
                    default-view="dayGridMonth" 
                    :plugins="calendarPlugins" 
                    :weekends="true" 
                    :events="events" 
                    :showNonCurrentDates="false" 
                    @dateClick="handleDateClick" 
                    @eventClick="editForm"/>
                    <b-modal 
                    v-model="show" 
                    :id="'modal_' + infoModal.student_id" 
                    :title="modaltitle" 
                    size="lg" 
                    hide-footer
                    >
                        <b-row v-if="!showEdit">
                            <b-col>
                                <b-row class="schedPreview">
                                    <b-col style="max-width: 18%">
                                        <p><span>CLASS DATE:</span></p>
                                        <p><span>TIME:</span></p>
                                        <p><span>CLASS TYPE:</span></p>
                                        <p><span>SUBJECT:</span></p>
                                        <p><span>GRADE:</span></p>
                                        <p><span>INSTRUCTOR:</span></p>
                                    </b-col>
                                    <b-col class="pl-0">
                                        <p><strong>{{ editClassDate }}</strong></p>
                                        <p><strong>{{ ("0" + infoModal.startHrs).slice(-2) }}:{{ infoModal.startMin }} - {{ ("0" + infoModal.endHrs).slice(-2) }}:{{ infoModal.endMin }}</strong></p>
                                        <p><strong>{{ editClassType }}</strong></p>
                                        <p><strong>{{ editSubject }}</strong></p>
                                        <p><strong>{{ editGrade }}</strong></p>
                                        <p><strong>{{ infoModal.instructor_id }}</strong></p>
                                    </b-col>
                                    <b-col cols="6">
                                        <p><span>STUDENTS IN THIS CLASS</span></p>
                                        <p v-for="student in editStudents"><strong> - {{ student }}</strong></p>
                                    </b-col>
                                </b-row>
                                <b-row>
                                    <b-col class="mt-5">
                                        <b-button variant="danger" class="float-left ml-2" @click="deleteForm" v-if="okName=='Update'">
                                            DELETE
                                        </b-button>
                                        <b-button variant="primary" class="float-right ml-2" @click="showEdit=true">
                                            Edit Schedule
                                        </b-button>
                                        <b-button class="float-right ml-2" @click="show=false">
                                            CANCEL
                                        </b-button>
                                    </b-col>
                                </b-row>
                            </b-col>
                        </b-row>
                        <b-row v-if="showEdit">
                            <b-col>
                                <b-row class="pl-4 pr-4 pt-3 pb-0">
                                    <b-col class="p-2">
                                        <b-form-group label="CLASS DATE">
                                            <b-form-input v-model="infoModal.classDate" type="date"></b-form-input>
                                        </b-form-group>
                                    </b-col>
                                    <b-col class="p-2" id="cstm-radio" v-if="modaltitle == 'ADD NEW SCHEDULE'">
                                        <b-form-group label="NO. OF DAYS">
                                            <b-form-radio-group name="radio-inline" v-model="infoModal.checkMultiple">
                                                <b-form-radio value="0">Single</b-form-radio>
                                                <b-form-radio value="1">Multiple</b-form-radio>
                                            </b-form-radio-group>
                                        </b-form-group>
                                    </b-col>
                                    <b-col class="p-2">
                                        <b-form-group label="START TIME">
                                            <div class="input-group">
                                                <b-form-select v-model="infoModal.startHrs" :options="optionTime.hrs"></b-form-select>
                                                <b-form-select v-model="infoModal.startMin" :options="optionTime.mnts"></b-form-select>
                                                <!-- <b-form-select v-model="infoModal.startAmPm" :options="optionTime.ampm"></b-form-select> -->
                                            </div>
                                        </b-form-group>
                                    </b-col>
                                    <b-col class="p-2">
                                        <b-form-group label="END TIME">
                                            <div class="input-group">
                                                <b-form-select v-model="infoModal.endHrs" :options="optionTime.hrs"></b-form-select>
                                                <b-form-select v-model="infoModal.endMin" :options="optionTime.mnts"></b-form-select>
                                                <!-- <b-form-select v-model="infoModal.endAmPm" :options="optionTime.ampm"></b-form-select> -->
                                            </div>
                                        </b-form-group>
                                    </b-col>
                                    <b-col class="p-2" v-if="modaltitle == 'EDIT SCHEDULE'"></b-col>
                                </b-row>
                                <b-row v-if="infoModal.checkMultiple == '1'" class="pl-4 pr-4 pt-0 pb-0">
                                    <b-col class="p-2" cols="12">
                                        <b-form-group>
                                            <label>
                                                Other Dates 
                                                <b-button @click="numDates++" variant="success" size="sm" class="mb-0"><i class="fa fa-plus"></i></b-button>
                                                <b-button @click="numDates--" variant="warning" size="sm" class="mb-0"><i class="fa fa-minus"></i></b-button>
                                            </label>
                                        </b-form-group>
                                    </b-col>
                                    <b-col class="p-2" cols="3">
                                        <b-form-group>
                                            <div v-for="(num, index) in numDates" class="mb-3">
                                                <b-form-input v-model="infoModal.otherClassDate[index]" type="date"></b-form-input>
                                            </div>
                                        </b-form-group>
                                    </b-col>
                                </b-row>
                                <b-row class="pl-4 pr-4 pt-0 pb-3">
                                    <b-col class="p-2">
                                        <b-form-group label="CLASS TYPE">
                                            <b-form-select v-model="infoModal.classType">
                                                <option value="" disabled>-- Select Type --</option>
                                                <option v-for="classType in data.classtypes" :value="classType.id">{{ classType.name }}</option>
                                            </b-form-select>
                                        </b-form-group>
                                    </b-col>
                                    <b-col class="p-2">
                                        <b-form-group label="SUBJECT">
                                            <b-form-select v-model="infoModal.subject">
                                                <option value="" disabled>-- Select Subject --</option>
                                                <option v-for="subject in data.subjects" :value="subject.id">{{ subject.name }}</option>
                                            </b-form-select>
                                        </b-form-group>
                                    </b-col>
                                    <b-col class="p-2">
                                        <b-form-group label="GRADE">
                                            <b-form-select v-model="infoModal.grade_id">
                                                <option value="" disabled>-- Select Grade --</option>
                                                <option v-for="grade in data.grades" :value="grade.id">{{ grade.name }}</option>
                                            </b-form-select>
                                        </b-form-group>
                                    </b-col>
                                    <b-col class="p-2">
                                        <b-form-group label="INSTRUCTOR">
                                            <el-select 
                                            v-model="infoModal.instructor_id" 
                                            filterable 
                                            remote 
                                            placeholder="Type to search" 
                                            :remote-method="remoteMethod" 
                                            :loading="loading">
                                                <el-option 
                                                v-for="item in options" 
                                                :key="item.value" 
                                                :label="item.label" 
                                                :value="item.value">
                                                </el-option>
                                            </el-select>
                                        </b-form-group>
                                    </b-col>
                                </b-row>
                                <b-row class="pl-3 pr-3 pt-3 pb-0">
                                    <b-col>
                                        <h3>SELECT STUDENT</h3>
                                    </b-col>
                                </b-row>
                                <b-row class="pl-4 pr-4 pt-0 pb-0">
                                    <b-col class="p-2">
                                        <el-transfer 
                                        filterable 
                                        :filter-method="filterMethod" 
                                        filter-placeholder="Search" 
                                        v-model="infoModal.students" 
                                        :data="allStudent" 
                                        :titles="['Student List', 'Students in this Class']">
                                        </el-transfer>
                                    </b-col>
                                </b-row>
                                <div slot="modal-footer" class="w-100 mt-5">
                                    <b-button variant="danger" class="float-left ml-2" @click="deleteForm" v-if="okName=='Update'">
                                        DELETE
                                    </b-button>
                                    <b-button variant="primary" class="float-right ml-2"@click="handleOk">
                                        {{ okName }}
                                    </b-button>
                                    <b-button class="float-right ml-2" @click="show=false">
                                        CANCEL
                                    </b-button>
                                </div>
                            </b-col>
                        </b-row>
                    </b-modal>
                </b-card>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
    import FullCalendar from '@fullcalendar/vue';
    import dayGridPlugin from '@fullcalendar/daygrid';
    import interactionPlugin from "@fullcalendar/interaction";
    import 'bootstrap-vue/dist/bootstrap-vue.css';
    import 'element-ui/lib/theme-chalk/index.css';
    import "@fullcalendar/core/main.css";
    import "@fullcalendar/daygrid/main.css";

    export default {
        data() {
            return {
                data: [],
                showEdit: false,
                show: false,
                options: [],
                listInstructor: [],
                loading: false,
                allStudent: [],
                calendarPlugins: [ dayGridPlugin, interactionPlugin ],
                events: [],
                modaltitle: '',
                editId: '',
                okName: '',
                instructor_id_old: '',
                infoModal: {
                    classDate: '',
                    classType: '',
                    subject: '',
                    grade_id: '',
                    status: '1',
                    startHrs: 'Hrs',
                    startMin: '00',
                    endHrs: 'Hrs',
                    endMin: '00',
                    students: [],
                    startTimeFull: '',
                    endTimeFull: '',
                    instructor_id: '',
                    credits: '',
                    checkMultiple: '0',
                    otherClassDate: [],
                },
                optionTime: {
                    hrs: ['Hrs', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24],
                    mnts: ['00', '30'],
                    ampm: ['AM/PM', 'AM', 'PM']
                },
                editClassType: '',
                editSubject: '',
                editGrade: '',
                editStudents: [],
                editClassDate: '',
                numDates: 1
            }
        },
        components: {
            FullCalendar
        },
        created() {
            axios.get('/admin/classschedule/')
            .then(response => {
                this.data = response.data;

                this.allStudent = this.data.students.map(item => {
                    var bool = false;
                    if(item.status == 1)
                        bool = false;
                    else
                        bool = true;

                    return { 
                        key: item.id, 
                        label: item.last_name + ', ' + 
                        item.first_name + ' ' + 
                        (item.middle_name == null || item.middle_name == 'null'? '' : item.middle_name) + 
                        ' (' + item.nickname + ') ' ,
                        disabled: bool
                    };
                });

                this.listInstructor = this.data.instructors.map(item => {
                    return { value: item.id, label: item.nickname };
                });

                this.displaySchedule(this.data.schedules);
            
            })
            .catch(err=>{
                console.log("error", err);
            });
        },
        methods: {
            handleDateClick(arg) {
                var d = new Date(arg.date);
                d.setDate( d.getDate() + 1 );
                this.infoModal.classDate = d.toISOString().slice(0, 10); 

                this.addForm();
            },
            addForm() {
                this.showEdit = true;
                this.modaltitle = 'ADD NEW SCHEDULE';
                this.okName = 'Save';

                this.$nextTick(() => {
                    this.resetInfoModal();
                    this.$root.$emit('bv::show::modal', 'modal_' + this.infoModal.student_id)
                })
            },
            editForm(arg) { 
                this.showEdit = false;
                this.modaltitle = 'EDIT SCHEDULE';
                this.okName = 'Update';
                this.infoModal.checkMultiple = '0';
                this.editId = arg.event.extendedProps.eventId;

                var startDate = arg.event.extendedProps.date_start;
                var endDate = arg.event.extendedProps.date_end;
                var startConverted = new Date(startDate);
                var endConverted = new Date(endDate);

                this.infoModal.classDate = this.beautifyDate(startDate)[0].classDate;
                this.infoModal.classType = arg.event.extendedProps.class_rate_id;
                this.infoModal.subject = arg.event.extendedProps.subject_id;
                this.infoModal.grade_id = arg.event.extendedProps.grade_id;
                this.infoModal.status = arg.event.extendedProps.status;

                this.infoModal.instructor_id = arg.event.extendedProps.instructor_nickname;
                this.instructor_id_old = arg.event.extendedProps.instructor_id;

                this.infoModal.startHrs = startConverted.getHours();
                this.infoModal.startMin = ("0" + startConverted.getMinutes()).slice(-2);
                this.infoModal.endHrs = endConverted.getHours();
                this.infoModal.endMin = ("0" + endConverted.getMinutes()).slice(-2);

                this.editClassDate = (this.infoModal.classDate).slice(5) + '-' + (this.infoModal.classDate).slice(0, 4);


                axios.get('/admin/classschedule/getStudentByClass/' + this.editId)
                .then(response => {
                    
                    this.infoModal.students = [];
                    this.editStudents = [];

                    for(var x = 0; x < response.data.length; x++) {
                        this.infoModal.students.push( response.data[x].student_id );

                        this.editStudents.push(response.data[x].nickname + ' ' + response.data[x].last_name);
                    }

                    this.editClassType = this.data.classtypes.filter( element => element.id == this.infoModal.classType)[0].name;
                    this.editSubject = this.data.subjects.filter( element => element.id == this.infoModal.subject)[0].name;
                    this.editGrade = this.data.grades.filter( element => element.id == this.infoModal.grade_id)[0].name;

                })
                .catch(err=>{
                    console.log("error", err);
                });

                this.$nextTick(() => {
                    this.$root.$emit('bv::show::modal', 'modal_' + this.infoModal.student_id)
                })
            },
            deleteForm() {
                swal({
                    title: "Schedule Deletion Warning",
                    text: "Are you sure you want to delete this schedule?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true
                }).then(willDelete => {
                    if (willDelete) {
                        axios.get('/admin/classschedule/delete/' + this.editId)
                        .then(response => {

                            this.displaySchedule(response.data.newlist);
                            swal("Schedule was deleted!", { icon: "success" });

                        })
                        .catch(err=>{
                            console.log("error", err);
                            swal("Error!", 
                                "Looks like something went wrong, please try again. If issue persist, please report this to your system developer.", 
                                "error");
                        });

                        this.$nextTick(() => {
                            this.show = false;
                        })
                    } else swal("Schedule was kept");
                });
            },
            handleOk() {

                var url = "";

                if(this.okName == 'Save')
                    url = '/admin/classschedule/store';
                else if(this.okName == 'Update')
                    url = '/admin/classschedule/update/' + this.editId;

                if(this.instructor_id_old != '' && isNaN(this.infoModal.instructor_id))
                    this.infoModal.instructor_id = this.instructor_id_old;

                this.SetTimeProperly();

                if(this.requireAllFields()) {
                    axios.post(url, this.infoModal)
                    .then(response => {

                        this.displaySchedule(response.data.newlist);
                        swal("Success!", response.data.message, "success");

                    })
                    .catch(err=>{
                        console.log("error", err);
                        swal("Error!", 
                            "Looks like something went wrong, please try again. If issue persist, please report this to your system developer.", 
                            "error");
                    });

                    this.$nextTick(() => {
                        this.show = false;
                    })
                }
                else {
                    swal("Error!", "Please fill-in all fields.", "error");
                }
            },
            displaySchedule(sched) {

                this.events = []; 

                for(var x = 0; x < sched.length; x++) {

                    this.events.push({
                        title : (sched[x].date_start).slice(11, 16) + 
                                "-" +
                                (sched[x].date_end).slice(11, 16) + 
                                " (" +
                                sched[x].grade_name + " - " + 
                                sched[x].instructor_nickname + ")",

                        start  : sched[x].date_start,
                        end    : sched[x].date_end,
                        eventId : sched[x].id,
                        date_start: sched[x].date_start,
                        date_end: sched[x].date_end,
                        instructor_id: sched[x].instructor_id,
                        class_rate_id: sched[x].class_rate_id,
                        subject_id: sched[x].subject_id,
                        grade_id: sched[x].grade_id,
                        status: sched[x].status,
                        instructor_nickname: sched[x].instructor_nickname
                    });
                }
            },
            beautifyDate(thisTime) {
                var startDate = new Date(thisTime);

                var classDate = startDate.getFullYear() + '-' + ('00' + (startDate.getMonth() + 1)).slice(-2) + '-' + ('00' + startDate.getDate()).slice(-2);
                var startHrs = ('00' + startDate.getHours()).slice(-2);
                var startMin = ('00' + startDate.getMinutes()).slice(-2);

                var time = startHrs+':'+startMin;
                time = time.toString().match(/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

                time = time.slice(1);

                var final = [];

                return final = [{
                    'classDate' : classDate,
                    'AmPm' : (time[0] < 12 ? 'AM' : 'PM'),
                    'Hrs' : time[0] = +time[0] % 12 || 12,
                    'Min' : startMin,
                }];
            },
            SetTimeProperly() {

                var startD = this.infoModal.classDate + 'T' + ('0' + this.infoModal.startHrs).slice(-2) + ':' + this.infoModal.startMin + ':00';
                var endD = this.infoModal.classDate + 'T' + ('0' + this.infoModal.endHrs).slice(-2) + ':' + this.infoModal.endMin + ':00';

                this.infoModal.startTimeFull = startD;
                this.infoModal.endTimeFull = endD;
 
                this.infoModal.credits = this.calcCredit(startD, endD); 
            },
            calcCredit(dt1, dt2) {
                var date1 = new Date(dt1);
                var date2 = new Date(dt2);

                var diff = date2.getTime() - date1.getTime();

                var msec = diff;
                var hh = Math.floor(msec / 1000 / 60 / 60);
                msec -= hh * 1000 * 60 * 60;
                var mm = Math.floor(msec / 1000 / 60);
                msec -= mm * 1000 * 60;
                var ss = Math.floor(msec / 1000);
                msec -= ss * 1000;

                return hh + "." + (mm == 30? '5':'');
            },
            requireAllFields() {
                var self = this
                var check = true;
                Object.keys(self.infoModal).forEach(function(key,index) {
                    if(self.infoModal[key] == '' || self.infoModal[key] == 'Hrs') {
                        if(self.infoModal.otherClassDate.length == 0 && self.infoModal.checkMultiple == '0')
                            check = true;
                        else
                            check = false;
                    }
                })

                return check;
            },
            resetInfoModal() {
                this.infoModal.classType = '';
                this.infoModal.subject = '';
                this.infoModal.grade_id = '';
                this.infoModal.status = '1';
                this.infoModal.startHrs = 'Hrs';
                this.infoModal.startMin = '00';

                this.infoModal.endHrs = 'Hrs';
                this.infoModal.endMin = '00';

                this.infoModal.students = [];
                this.infoModal.startTimeFull = '';
                this.infoModal.endTimeFull = '';
                this.infoModal.instructor_id = '';
                this.instructor_id_old = '';
                this.infoModal.otherClassDate = [];
                this.infoModal.checkMultiple = '0';
                this.numDates = 1;
            },
            remoteMethod(query) {
                if (query !== '') {
                    this.loading = true;
                    setTimeout(() => {
                        this.loading = false;
                        this.options = this.listInstructor.filter(item => {
                        return item.label.toLowerCase().indexOf(query.toLowerCase()) > -1;
                    });
                  }, 200);
                } else {
                    this.options = [];
                }
            },
            filterMethod(query, item) {
                return item.label.toLowerCase().indexOf(query.toLowerCase()) > -1;
            },
            onFiltered(filteredItems) {
                this.totalRows = filteredItems.length
                this.currentPage = 1
            },
        }
    }
</script>
<style type="text/css">
    .fc-title {
        white-space: pre-line;
        line-height: 0px;
        font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol" !important;
    }
    td.fc-event-container {
        padding-bottom: 6px !important;
    }
    a.fc-day-grid-event.fc-h-event.fc-event.fc-start.fc-end {
        padding: 4px 0 2px 0 !important;
    }
</style>