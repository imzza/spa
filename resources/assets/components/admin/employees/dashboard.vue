<template>
    <div id="emp_dashboard">
        <b-card tag="article">
            <div>
                <div class="row mb-5">
                    <div class="col">
                        <h5 class="text-warning">
                            Welcome,
                        </h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <p>Work Weekend</p>
                    </div>
                    <div class="col-3">
                        <b>{{ time }}</b>
                    </div>
                    <div class="col-3">
                        <p>
                            Current Time:
                            <span
                                ><b>{{ ctime }}</b></span
                            >
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Logging Hours For:</label>
                            <input type="text" class="form-control" />
                        </div>
                    </div>
                </div>
            </div>
        </b-card>
        <b-card tag="article">
            <div>
                <div v-if="$store.getters.clockInStatus == 'IN'" class="row justify-content-center">
                    <div class="col-4">
                        <h1>{{ loggedInTime }}</h1>
                    </div>
                </div>

                <!-- <div class="row">
					<div class="col-6">
						<div class="form-group">
			              <label>Choose Shift:</label>
			              <input type="text" class="form-control">
			            </div>
					</div>
					<div class="col-6">
						<div class="form-group">
			              <label>Choose Department:</label>
			              <input type="text" class="form-control">
			            </div>
					</div>
				</div> -->

                <div class="row">
                    <div class="col-3">
                        <button type="button" class="btn btn-warning btn-lg btn-block h80" :disabled="$store.getters.clockInStatus != null && ['IN', 'BK'].includes($store.getters.clockInStatus) == true" @click="clockIn">
                            Clock IN
                        </button>
                    </div>
                    <div class="col-3">
                        <button type="button" class="btn btn-primary btn-lg btn-block h80" :disabled="$store.getters.clockInStatus == null || ['IN', 'BK'].includes($store.getters.clockInStatus) == false" @click="clockOut">
                            Clock Out
                        </button>
                    </div>
                    <div class="col-3">
                        <button type="button" class="btn btn-warning btn-lg btn-block h80" :disabled="$store.getters.clockInStatus == null || $store.getters.clockInStatus == 'IN'" @click="breakIn">
                            Break IN
                        </button>
                    </div>
                    <div class="col-3">
                        <button type="button" class="btn btn-primary btn-lg btn-block h80" :disabled="$store.getters.clockInStatus == null || $store.getters.clockInStatus == 'BK'" @click="breakOut">
                            Break OUT
                        </button>
                    </div>
                </div>
            </div>
        </b-card>
        <clock-modal />
        <clock-out-modal />
        <b-card tag="article">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Select a Company<span>*</span></label>
                    <select class="form-control" @change="onChange($event)">
                        <option>Company Name</option>
                        <option v-for="(client, ind) in clients" v-if="clients.length > 0" :value="client.clientid">
                            {{ client.clientname }}
                        </option>
                    </select>
                </div>
            </div>
        </b-card>
        <b-card tag="article" class="mb-2">
            <div class="row">
                <div class="col">
                    <table class="table table-bordered table-hover cus-table">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Date</th>
                                <th>Total Hours</th>
                                <th>Status</th>
                                <th>Approved</th>
                                <th />
                            </tr>
                        </thead>
                        <!-- v-for="(hour,ind) in hours" :key="hour" v-if="hours.length > 0" -->
                        <tbody class="text-center">
                            <tr v-for="(user, ind) in users" v-if="users.length > 0 && user.status == 'IN'">
                                <td>{{ user.ID }}</td>
                                <td class="max-300">
                                    <div class="d-flex input-group">
                                        <input type="text" :value="user.dateIN | dateFormat" class="form-control" />
                                        <input type="text" class="form-control" :value="user.day" />
                                    </div>
                                </td>
                                <td class="max-120">
                                    <input type="text" class="form-control" :value="user.hours" />
                                </td>
                                <td>
                                    <div class="checkbox">
                                        <label>
                                            <input v-model="user.submitted" type="checkbox" name="" />
                                            <span class="cr"><i class="cr-icon fa fa-check"/></span>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex input-group">
                                        <div class="checkbox">
                                            <label>
                                                <input v-model="user.approved" type="checkbox" name="" />
                                                <span class="cr"><i class="cr-icon fa fa-check"/></span>
                                            </label>
                                        </div>
                                        <button class="btn btn-sm btn-primary" data-toggle="modal" @click="showModal()">
                                            View
                                        </button>
                                        <!-- <a href="#" class="btn btn-sm btn-primary" role="button">View</a> -->
                                        <button class="btn btn-sm btn-info">
                                            Open
                                        </button>
                                    </div>
                                </td>
                                <td class="w-400" />
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </b-card>
    </div>
</template>

<script>
import Vue from 'vue';
import employees from '~/api/employees.js';
var moment = require('moment');
Vue.filter('dateFormat', function(value) {
    if (value) {
        return moment(String(value)).format('DD/MM/YYYY');
    }
});

export default {
    name: 'employee_dashboard',

    data() {
        return {
            te: '',
            ctime: '',
            loggedInTime: '',
            interval: '',
            clients: [],
            departments: [],
            shifts: [],
            users: [],
            weeks: [],
        };
    },
    computed: {
        time() {
            return moment(Date.now()).format('dddd, MMMM Do YYYY');
        },
    },
    created() {
        this.interval = setInterval(() => {
            this.ctime = moment(Date.now()).format('hh:mm:ss a');
            if (this.$store.getters.clockInTime != null) {
                this.countUpFromTime(this.$store.getters.clockInTime);
            }
        }, 1000);
    },
    mounted() {
        this.getClient();
    },
    destroyed() {
        clearInterval(this.interval);
    },
    methods: {
        clockIn() {
            if (this.$store.state.user.clocked_in == 0) {
                EventBus.$emit('SM', 'IN');
            } else {
                const cdate = moment().format('YYYY-MM-DD');
                const ctime = moment().format('HH:mm:ss');
                const inTime = cdate + ' ' + ctime;

                // self.inModal.inTime = moment(self.inModal.inTime).format('HH:mm:ss');
                const inDate = moment(new Date()).format('YYYY-MM-DD HH:mm:ss');

                employees.clock_in(
                    { inTime: inTime, inDate: inDate },
                    data => {
                        // console.log();
                        this.$store.commit('clockIn', data.clockIn);
                        Notify.success('Clocked in successfully');
                    },
                    err => {
                        console.log('Catch is Running');
                        // console.log(err.response.message);
                    }
                );
            }
        },
        clockOut() {
            const self = this;
            const cdate = moment(new Date()).format('YYYY-MM-DD');
            const ctime = moment(new Date()).format('HH:mm:ss');
            const outTime = cdate + ' ' + ctime;

            // self.inModal.inTime = moment(self.inModal.inTime).format('HH:mm:ss');
            // self.outModal.outDate = moment(new Date).format('YYYY-MM-DD HH:mm:ss');

            employees.clock_out(
                { outTime: outTime, outDate: outTime },
                data => {
                    self.$store.commit('clockIn', data.clockOut);
                    Notify.success('You have eclocked out successfully');
                    // self.$refs.outmodal.hide();
                },
                err => {
                    console.log('Catch is Running');
                    // console.log(err.response.message);
                }
            );

            // EventBus.$emit('SMCO', 'OUT');
        },
        breakIn() {
            const self = this;
            alert('In');
            employees.break_in(
                { status: 'BK' },
                data => {
                    self.$store.commit('clockIn', data.breakIn);
                },
                err => {
                    console.log(err);
                }
            );
        },
        breakOut() {
            const self = this;
            employees.break_out(
                { status: 'IN' },
                data => {
                    self.$store.commit('clockIn', data.breakOut);
                },
                err => {
                    console.log('error');
                }
            );
        },

        countUpFromTime(countFrom) {
            countFrom = new Date(countFrom).getTime();

            var now = new Date();
            var countFrom = new Date(countFrom);
            var timeDifference = now - countFrom;

            var secondsInADay = 60 * 60 * 1000 * 24;
            var secondsInAHour = 60 * 60 * 1000;

            let days, hours, mins, secs;
            // days = Math.floor(timeDifference / (secondsInADay) * 1);
            hours = Math.floor(((timeDifference % secondsInADay) / secondsInAHour) * 1);
            mins = Math.floor((((timeDifference % secondsInADay) % secondsInAHour) / (60 * 1000)) * 1);
            secs = Math.floor(((((timeDifference % secondsInADay) % secondsInAHour) % (60 * 1000)) / 1000) * 1);

            if (hours < 10) {
                hours = '0' + hours;
            }

            if (mins < 10) {
                mins = '0' + mins;
            }

            if (secs < 10) {
                secs = '0' + secs;
            }

            this.loggedInTime = hours + ':' + mins + ':' + secs;

            // this.loggedInTime = moment(this.loggedInTime).format('hh:mm:ss');
        },
        onChange(event) {
            alert(event.target.value);
            var id = event.target.value;
            axios.get(API_URL + '/manageTimeCard/' + id).then(response => {
                this.users = response.data.user;
                console.log(response);
                // alert('hihi');
                // console.log(response);
            });
        },
    },
};
</script>

<style lang="css" scoped>
.h80 {
    height: 80px;
    border-radius: 0px;
    font-weight: 600;
}
</style>
