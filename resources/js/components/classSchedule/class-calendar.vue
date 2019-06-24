<template>
    <div>
        <full-calendar 
        default-view="dayGridMonth" 
        :plugins="calendarPlugins"
        :weekends="true"
        :events="events"
        @dateClick="handleDateClick"
        @eventClick="editForm"
        />
        <b-modal :id="'modal_' + infoModal.student_id" :title="modaltitle" :ok-title="okName" @ok="handleOk" size="lg">
            <b-form @submit.stop.prevent="handleSubmit">
                <b-row class="pl-4 pr-4 pt-3 pb-0">
                    <b-col class="p-2">
                        <b-form-group label="Class Date">
                            <b-form-input v-model="infoModal.classDate" type="date"></b-form-input>
                        </b-form-group>
                    </b-col>
                    <b-col class="p-2">
                        <b-form-group label="Start Time">
                            <div class="input-group">
                                <b-form-select v-model="infoModal.startHrs" :options="optionTime.hrs"></b-form-select>
                                <b-form-select v-model="infoModal.startMin" :options="optionTime.mnts"></b-form-select>
                                <b-form-select v-model="infoModal.startAmPm" :options="optionTime.ampm"></b-form-select>
                            </div>
                        </b-form-group>
                    </b-col>
                    <b-col class="p-2">
                        <b-form-group label="End Time">
                            <div class="input-group">
                                <b-form-select v-model="infoModal.endHrs" :options="optionTime.hrs"></b-form-select>
                                <b-form-select v-model="infoModal.endMin" :options="optionTime.mnts"></b-form-select>
                                <b-form-select v-model="infoModal.endAmPm" :options="optionTime.ampm"></b-form-select>
                            </div>
                        </b-form-group>
                    </b-col>
                    <b-col class="p-2">
                        <b-form-group label="Class Type">
                            <b-form-select v-model="infoModal.classType">
                                <option value="" disabled>-- Select Type --</option>
                                <option v-for="classType in classTypes" :value="classType.id">{{ classType.name }}</option>
                            </b-form-select>
                        </b-form-group>
                    </b-col>
                </b-row>
                <b-row class="pl-4 pr-4 pt-0 pb-3">
                    <b-col class="p-2">
                        <b-form-group label="Subject">
                            <b-form-select v-model="infoModal.subject">
                                <option value="" disabled>-- Select Subject --</option>
                                <option v-for="subject in subjects" :value="subject.id">{{ subject.name }}</option>
                            </b-form-select>
                        </b-form-group>
                    </b-col>
                    <b-col class="p-2">
                        <b-form-group label="Classroom">
                            <b-form-select v-model="infoModal.classroom">
                                <option value="" disabled>-- Select classroom --</option>
                                <option v-for="classroom in classrooms" :value="classroom.id">{{ classroom.name }}</option>
                            </b-form-select>
                        </b-form-group>
                    </b-col>
                    <b-col class="p-2">
                        <b-form-group label="Instructor">
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
                    <b-col class="p-2">
                        <b-form-group label="Status">
                            <b-form-select v-model="infoModal.status">
                                <option value="1">Enabled</option>
                                <option value="0">Disabled</option>
                            </b-form-select>
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
                        :titles="['Student List', 'Students in this Classroom']">
                    </el-transfer>
                </b-col>
            </b-row>
        </b-form>
    </b-modal>
</div>
</template>

<script>
    import FullCalendar from '@fullcalendar/vue';
    import dayGridPlugin from '@fullcalendar/daygrid';
    import interactionPlugin from "@fullcalendar/interaction";
    import 'bootstrap-vue/dist/bootstrap-vue.css';
    import 'element-ui/lib/theme-chalk/index.css';

    export default {
        props: ['classTypes', 'schedules', 'students', 'classrooms', 'subjects', 'instructors'],
        data() {
            return {
                options: [],
                listInstructor: [],
                loading: false,
                allStudent: [],
                calendarPlugins: [ dayGridPlugin, interactionPlugin ],
                events: [],
                modaltitle: '',
                editId: '',
                okName: '',
                infoModal: {
                    classDate: '',
                    classType: '',
                    subject: '',
                    classroom: '',
                    status: '1',
                    startHrs: 'Hrs',
                    startMin: 'Min',
                    startAmPm: 'AM/PM',
                    endHrs: 'Hrs',
                    endMin: 'Min',
                    endAmPm: 'AM/PM',
                    students: [],
                    startTimeFull: '',
                    endTimeFull: '',
                    instructor_id: '',
                    credits: ''
                },
                optionTime: {
                    hrs: ['Hrs', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
                    mnts: ['Min', '00', '30'],
                    ampm: ['AM/PM', 'AM', 'PM']
                },
            }
        },
        components: {
            FullCalendar
        },
        created() {
            this.allStudent = this.students.map(item => {
                return { key: item.id, label: item.first_name + ' ' + item.middle_name + ' ' + item.last_name };
            });

            this.listInstructor = this.instructors.map(item => {
                return { value: item.id, label: item.first_name + ' ' + item.middle_name + ' ' + item.last_name };
            });

            this.displaySchedule(this.schedules);
        },
        methods: {
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
            handleDateClick(arg) {
                var d = new Date(arg.date);
                d.setDate( d.getDate() + 1 );
                this.infoModal.classDate = d.toISOString().slice(0, 10); 

                this.addForm();
            },
            filterMethod(query, item) {
                return item.label.toLowerCase().indexOf(query.toLowerCase()) > -1;
            },

            onFiltered(filteredItems) {
                this.totalRows = filteredItems.length
                this.currentPage = 1
            },
            addForm() {
                this.modaltitle = 'ADD NEW SCHEDULE'
                this.okName = 'Save'

                this.$nextTick(() => {
                    this.$root.$emit('bv::show::modal', 'modal_' + this.infoModal.student_id)
                })
            },
            editForm(arg) { 
                console.log('sched id: ', arg.event.extendedProps.eventId);

                this.modaltitle = 'EDIT SCHEDULE';
                this.okName = 'Update';
                this.editId = arg.event.extendedProps.eventId;

                var startDate = arg.event.extendedProps.date_start;
                var endDate = arg.event.extendedProps.date_end;
                this.infoModal.classDate = this.beautifyDate(startDate)[0].classDate;
                this.infoModal.classType = arg.event.extendedProps.class_rate_id;
                this.infoModal.subject = arg.event.extendedProps.subject_id;
                this.infoModal.classroom = arg.event.extendedProps.classroom_id;
                this.infoModal.status = arg.event.extendedProps.status;
                this.infoModal.instructor_id = arg.event.extendedProps.instructor_id;
                this.infoModal.endHrs = this.beautifyDate(endDate)[0].Hrs;
                this.infoModal.endMin = this.beautifyDate(endDate)[0].Min;
                this.infoModal.endAmPm = this.beautifyDate(endDate)[0].AmPm;
                this.infoModal.startHrs = this.beautifyDate(startDate)[0].Hrs;
                this.infoModal.startMin = this.beautifyDate(startDate)[0].Min;
                this.infoModal.startAmPm = this.beautifyDate(startDate)[0].AmPm;

                axios.get('/api/classschedule/getStudentByClass/' + this.editId)
                .then(response => {
                    
                    this.infoModal.students = [];

                    for(var x = 0; x < response.data.length; x++) {
                        this.infoModal.students.push( response.data[x].student_id );
                    }
                })
                .catch(err=>{
                    console.log("error", err);
                });

                this.$nextTick(() => {
                    this.$root.$emit('bv::show::modal', 'modal_' + this.infoModal.student_id)
                })
            },
            handleOk(bvModalEvt) {

                var url = "";

                if(this.okName == 'Save')
                    url = '/api/classschedule/store';
                else if(this.okName == 'Update')
                    url = '/api/classschedule/update/' + this.editId;


                this.SetTimeProperly();


                axios.post(url, this.infoModal)
                .then(response => {

                    this.displaySchedule(response.data.newlist);
                    this.messageToastr('success', response.data.message );

                    this.resetInfoModal();
                })
                .catch(err=>{
                    console.log("error", err);
                    this.messageToastr('error', response.data.message );
                });

                this.$nextTick(() => {
                    this.$bvModal.hide()
                })
            },
            resetInfoModal() {
                this.modaltitle = '';
                this.infoModal.classDate = '';
                this.infoModal.classType = '';
                this.infoModal.subject = '';
                this.infoModal.classroom = '';
                this.infoModal.status = '1';
                this.infoModal.startHrs = 'Hrs';
                this.infoModal.startMin = 'Min';
                this.infoModal.startAmPm = 'AM/PM';
                this.infoModal.endHrs = 'Hrs';
                this.infoModal.endMin = 'Min';
                this.infoModal.endAmPm = 'AM/PM';
                this.infoModal.students = [];
                this.infoModal.startTimeFull = '';
                this.infoModal.endTimeFull = '';
                this.infoModal.instructor_id = '';
            },
            displaySchedule(sched) {

                this.events = [];
                for(var x = 0; x < sched.length; x++) {
                    this.events.push({
                        title  : 'event1',
                        start  : sched[x].date_start,
                        end    : sched[x].date_end,
                        eventId : sched[x].id,
                        date_start: sched[x].date_start,
                        date_end: sched[x].date_end,
                        instructor_id: sched[x].instructor_id,
                        class_rate_id: sched[x].class_rate_id,
                        subject_id: sched[x].subject_id,
                        classroom_id: sched[x].classroom_id,
                        status: sched[x].status
                    });
                }
            },
            messageToastr(type, msg) {

                toastr[type](msg, (type=='success'? 'Success':'Error'));

                toastr.options = {
                  "closeButton": true,
                  "debug": false,
                  "positionClass": "toast-top-right",
                  "onclick": null,
                  "showDuration": "3000",
                  "hideDuration": "10000",
                  "timeOut": "500000",  
                  "extendedTimeOut": "100000",
                  "showEasing": "swing",
                  "hideEasing": "linear",
                  "showMethod": "fadeIn",
                  "hideMethod": "fadeOut"
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
            const convertTime12to24 = (time12h) => {
                const [time, modifier] = time12h.split(' ');
                let [hours, minutes] = time.split(':');

                if (hours === '12')
                    hours = '00';
                if (modifier === 'PM')
                    hours = parseInt(hours, 10) + 12;

                hours = ('0' + hours).slice(-2);

                return this.infoModal.classDate + `T${hours}:${minutes}:00`;
            }

            var startD = convertTime12to24(this.infoModal.startHrs + ':' + this.infoModal.startMin + ' ' + this.infoModal.startAmPm);
            var endD = convertTime12to24(this.infoModal.endHrs + ':' + this.infoModal.endMin + ' ' + this.infoModal.endAmPm);

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
    }
}
</script>