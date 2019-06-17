<template>
    <div>
        <full-calendar 
            default-view="dayGridMonth" 
            :plugins="calendarPlugins"
            :weekends="true"
            :events="events"
            @dateClick="handleDateClick"
            @eventClick="editSchedule"
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
                        <b-form-group label="Status">
                            <b-form-select v-model="infoModal.status">
                                <option value="1">Enabled</option>
                                <option value="0">Disabled</option>
                            </b-form-select>
                        </b-form-group>
                    </b-col>
                    <b-col class="p-2">
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
                            :titles="['Student List', 'Class Students']">
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
        props: ['classTypes', 'schedules', 'students', 'classrooms', 'subjects'],
        data() {
            return {
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
                    endTimeFull: ''
                },
                optionTime: {
                    hrs: ['Hrs', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
                    mnts: ['Min', '30', '00'],
                    ampm: ['AM/PM', 'AM', 'PM']
                },
            }
        },
        components: {
            FullCalendar
        },
        created() {

            for(var x = 0; x < this.students.length; x++) {
                this.allStudent.push({
                    label: this.students[x].first_name + ' ' + this.students[x].middle_name + ' ' + this.students[x].last_name,
                    key: this.students[x].id,
                });
            }

            this.displaySchedule(this.schedules);
        },
        methods: {
            handleDateClick(arg) {
                var d = new Date(arg.date);
                d.setDate( d.getDate() + 1 );
                this.infoModal.classDate = d.toISOString().slice(0, 10); 

                this.addForm();
            },
            editSchedule(arg) { 
                // console.log('Event', arg.event.extendedProps.eventId);

                this.modaltitle = 'EDIT SCHEDULE';
                this.infoModal.okName = 'Update';
                this.infoModal.classDate = arg.event.extendedProps.date_start;
                this.infoModal.classType = arg.event.extendedProps.class_rate_id;
                this.infoModal.subject = arg.event.extendedProps.subject_id;
                this.infoModal.classroom = arg.event.extendedProps.classroom_id;
                this.infoModal.status = arg.event.extendedProps.status;
                this.infoModal.startHrs = 'Hrs';
                this.infoModal.startMin = 'Min';
                this.infoModal.startAmPm = 'AM/PM';
                this.infoModal.endHrs = 'Hrs';
                this.infoModal.endMin = 'Min';
                this.infoModal.endAmPm = 'AM/PM';

                this.$nextTick(() => {
                    this.$root.$emit('bv::show::modal', 'modal_' + this.infoModal.student_id)
                })
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
            editForm(button, name, year_attended, notes, educId) {
                this.modaltitle = 'Edit History';
                this.okName = 'Update';
                this.editId = educId;
                this.infoModal.name = name;
                this.infoModal.year_attended = year_attended;
                this.infoModal.notes = notes;

                this.$nextTick(() => {
                    this.$root.$emit('bv::show::modal', 'modal_' + this.infoModal.student_id, button)
                })
            },
            handleOk(bvModalEvt) {

                var url = "";

                if(this.okName == 'Save')
                    url = '/api/classschedule/store';
                else if(this.okName == 'Update')
                    url = '/api/classschedule/update/' + this.editId;

                const convertTime12to24 = (time12h) => {
                    const [time, modifier] = time12h.split(' ');
                    let [hours, minutes] = time.split(':');

                    if (hours === '12')
                        hours = '00';
                    if (modifier === 'PM')
                        hours = parseInt(hours, 10) + 12;

                    return this.infoModal.classDate + `T${hours}:${minutes}:00`;
                }

                this.infoModal.startTimeFull = convertTime12to24(this.infoModal.startHrs + ':' + this.infoModal.startMin + ' ' + this.infoModal.startAmPm);
                this.infoModal.endTimeFull = convertTime12to24(this.infoModal.endHrs + ':' + this.infoModal.endMin + ' ' + this.infoModal.endAmPm);


                axios.post(url, this.infoModal)
                .then(response => {

                    this.displaySchedule(response.data.newlist);
                    this.messageToastr('success', response.data.message );
                    console.log('submitted', response.data.message);

                    this.resetInfoModal();
                })
                .catch(err=>{
                    console.log("error", err);
                    this.messageToastr('error', response.data.message );
                });

                console.log('send this: ', this.infoModal);

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
        }
    }
</script>