<template>
    <div>
        <section class="page-content mb-4">
            <b-card tag="article" class="cardFilters">
                <div class="row">
                    <div class="col-md-3">
                        <div class="d-flex inline-input">
                            <div class="form-group">
                                <label>eeidtxt</label>
                                <input type="text" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>eecodetxt</label>
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Select a Company<span>*</span></label>
                            <select class="form-control" @change="onChange($event)">
                                <option>Company Name</option>
                                <option v-for="(client, ind) in clients" :value="client.clientid" v-if="clients.length > 0">
                                    {{ client.clientname }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Your Shift</label>
                            <select class="form-control">
                                <option>Shift Name</option>
                                <option v-for="(shift, ind) in shifts" v-if="shifts.length > 0">
                                    {{ shift.shift }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Your Departments</label>
                            <select class="form-control">
                                <option>Department Name</option>
                                <option v-for="(department, ind) in departments" v-if="departments.length > 0">
                                    {{ department.deptname }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </b-card>

            <div class="row">
                <div class="col-md-5">
                    <b-card tag="article" header="Select a work week" header-tag="header" class="no-padding heding-colored">
                        <div class="inner-th d-flex">
                            <div>Weekbeg</div>
                            <div>Weekend</div>
                        </div>
                        <div class="inner-tbody">
                            <ul>
                                <li class="checkbox" v-for="(week, ind) in weeks" v-if="weeks.length > 0">
                                    <div>
                                        <label>
                                            <input type="checkbox" name="" :value="week.wwid" @click="select($event)" />
                                            <span class="cr"><i class="cr-icon fa fa-check"/></span>
                                            <div>{{ week.weekbeg | dateFormat }}</div>
                                        </label>
                                    </div>
                                    <div>{{ week.weekend | dateFormat }}</div>
                                </li>
                                <!--  <li>
                            <div class="checkbox">
                                <label>
                                <input type="checkbox" name="">
                                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                <div>3/4/2019</div>
                                </label>
                            </div>
                            <div>3/10/2019</div>
                        </li> -->
                            </ul>
                        </div>
                    </b-card>
                </div>
                <div class="col-md-7">
                    <b-card tag="article" header="Weekly Work" header-tag="header">
                        <div class="form-group d-flex align-items-center">
                            <label>Work Weekend</label>
                            <input type="text" class="form-control ml-auto" />
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <label>Work Weekend</label>
                            <input type="text" class="form-control ml-auto" />
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <label>Work Weekend</label>
                            <input type="text" class="form-control ml-auto" />
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <label>Work Weekend</label>
                            <input type="text" class="form-control ml-auto" />
                        </div>
                    </b-card>
                </div>
            </div>
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
                                <tr v-for="(winfo, ind) in winfos" v-if="winfos.length > 0 && winfo.status == 'IN'">
                                    <td>{{ winfo.ID }}</td>
                                    <td class="max-300">
                                        <div class="d-flex input-group">
                                            <input type="text" :value="winfo.dateIN | dateFormat" class="form-control" />
                                            <input type="text" class="form-control" :value="winfo.day" />
                                        </div>
                                    </td>
                                    <td class="max-120">
                                        <input type="text" v-for="(hour, ind) in hours" class="form-control" v-if="hours.length > 0" :value="hour.hours" />
                                    </td>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" v-model="winfo.submitted" name="" />
                                                <span class="cr"><i class="cr-icon fa fa-check"/></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex input-group">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" v-model="winfo.approved" name="" />
                                                    <span class="cr"><i class="cr-icon fa fa-check"/></span>
                                                </label>
                                            </div>
                                            <button class="btn btn-sm btn-primary" data-toggle="modal" @click="showModal(winfo)">
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

            <b-modal id="modalPopover" ref="modal" title="TIME CARD DETAIL">
                <div class="container">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="validationDefault01">DATE IN</label>
                            <input type="text" id="validationDefault01" class="form-control" :value="details.dateIN | dateFormat" placeholder="Date IN" required />
                            />
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationDefault02">DAY IN</label>
                            <input type="text" id="validationDefault02" class="form-control" placeholder="DAY IN" :value="details.day" required />
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationDefault02">TIME IN</label>
                            <input type="text" id="validationDefault02" class="form-control" placeholder="TIME IN" :value="details.time" required />
                        </div>
                        <div class="col-md-4 mb-3">
                            <button class="btn btn-sm btn-info" @click="showupdate()">
                                Edit
                            </button>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="validationDefault01">DATE OUT</label>
                            <input type="text" id="validationDefault01" class="form-control" :value="details.dateOUT | dateFormat" placeholder="First name" required />
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationDefault02">DAY OUT</label>
                            <input type="text" id="validationDefault02" class="form-control" placeholder="Day Out" :value="details.dayout" required />
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationDefault02">TIME OUT</label>
                            <input type="text" id="validationDefault02" class="form-control" placeholder="Time Out" :value="details.timeout" required />
                        </div>
                        <div class="col-md-4 mb-3">
                            <button class="btn btn-sm btn-info" @click="showDateOut()">
                                Edit
                            </button>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="validationDefault01">Department</label>
                            <input
                                v-for="(department, ind) in departments"
                                v-if="details.deptid == department.deptid"
                                type="text"
                                id="validationDefault01"
                                class="form-control"
                                :value="department.deptname"
                                placeholder="First name"
                                required
                            />
                            />
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationDefault02">Shift</label>
                            <input
                                type="text"
                                id="validationDefault02"
                                class="form-control"
                                v-for="(shift, ind) in shifts"
                                placeholder="Shift"
                                v-if="details.shiftid == shift.shiftid"
                                :value="shift.shift"
                                required
                            />
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationDefault02">Hours</label>
                            <input type="text" id="validationDefault03" class="form-control" placeholder="Hours" required />
                        </div>
                        <div class="col-md-4 mb-3">
                            <button class="btn btn-sm btn-info" @click="showDeptShift()">
                                Edit
                            </button>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div v-for="(winfo, ind) in winfos" class="form-row" v-if="winfos.length > 0 && winfo.status == 'BK'">
                        <div class="col-md-4 mb-3">
                            <label for="validationDefault01">Break IN</label>
                            <input :value="winfo.timeIN" type="text" class="form-control" id="breakIn" placeholder="Break Start" required />
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="breakEnd">Break Out</label>
                            <input type="text" id="breakEnd" class="form-control" v-model="winfo.timeOUT" placeholder="Break End" />
                        </div>
                        <!-- <div class="col-md-4 mb-3">
                          <label for="duration">Break Time</label>
                          <input type="text" class="form-control" id="duration" placeholder="Duration">
                        </div> -->
                        <div class="col-md-4 mb-3">
                            <button class="btn btn-sm btn-info" @click="deleteBreaks($winfo)">
                                DELETE BREAK
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <button class="btn btn-sm btn-info" @click="showBreaks()">
                            ADD BREAK
                        </button>
                    </div>
                </div>
            </b-modal>

            <b-modal id="modalDateIN" ref="modalDateIN" title="UPDATE DATE TIME IN">
                <form @submit.prevent="updateDateIN()">
                    <div class="container">
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationDefault01">DATE IN</label>
                                <!-- <input type="text" class="form-control" id="validationDefault01" v-model="details.dateIN " placeholder="First name"  required> -->
                                <date-picker
                                    v-model="details.dateIN"
                                    type="date"
                                    v-validate="'required'"
                                    data-vv-name="inTime"
                                    placeholder="In Time"
                                    lang="en"
                                    format="DD/MM/YYYY"
                                    class="form-control"
                                    :time-picker-options="timePickerOptions"
                                />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationDefault02">DAY IN</label>
                                <input type="text" id="validationDefault02" class="form-control" v-model="details.day" placeholder="Day IN" required disabled="" />
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="timeIN">TIME IN</label>
                                <!-- <input type="text" class="form-control" id="validationDefault02" placeholder="Time In" v-model="details.time" required> -->
                                <date-picker
                                    v-model="details.datetimeIN"
                                    type="time"
                                    v-validate="'required'"
                                    data-vv-name="inTime"
                                    placeholder="In Time"
                                    lang="en"
                                    format="HH:mm"
                                    class="form-control"
                                    :time-picker-options="timePickerOptions"
                                />
                            </div>
                            <div class="col-md-4 mb-3">
                                <button class="btn btn-sm btn-info">
                                    update
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </b-modal>
            <b-modal id="modalDateOUT" ref="modalDateOUT" title="UPDATE DATE TIME OUT">
                <form @submit.prevent="updateDateOut()">
                    <div class="container">
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationDefault01">DATE OUT</label>
                                <!-- <input type="text" class="form-control" id="dateOUT" v-model="details.dateOUT" placeholder="First name"  required> -->

                                <date-picker
                                    v-model="details.dateOUT"
                                    class="form-control"
                                    type="date"
                                    v-validate="'required'"
                                    data-vv-name="inTime"
                                    placeholder="Date Out"
                                    lang="en"
                                    format="DD/MM/YYYY"
                                    :time-picker-options="timePickerOptions"
                                />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="dayOut">DAY OUT</label>
                                <input type="text" id="validationDefault02" class="form-control" v-model="details.dayout" placeholder="Day Out" required />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationDefault02">TIME OUT</label>
                                <!-- <input type="text" class="form-control" id="timeOUT" placeholder="Time Out" v-model="details.timeout" required> -->
                                <date-picker
                                    v-model="details.datetimeOUT"
                                    type="time"
                                    v-validate="'required'"
                                    data-vv-name="inTime"
                                    placeholder="Out Time"
                                    lang="en"
                                    format="HH:mm"
                                    class="form-control"
                                    :time-picker-options="timePickerOptions"
                                />
                            </div>
                            <div class="col-md-4 mb-3">
                                <button class="btn btn-sm btn-info">
                                    update
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </b-modal>
            <b-modal id="modalDeptShift" ref="modalDeptShift" title="UPDATE DEPARTMENTS AND SHIFTS">
                <form @submit.prevent="updateDeptShift()">
                    <div class="container">
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="deptname">Department</label>
                                <!-- <input v-for="(department,ind) in departments" v-if="details.deptid==department.deptid" type="text" class="form-control" id="deptname" v-model="department.deptname" placeholder="First name"  required> -->
                                <select v-model="deptshift.deptid" class="form-control">
                                    <option>Department Name</option>
                                    <option v-for="(department, ind) in departments" :value="department.deptid" v-if="departments.length > 0">
                                        {{ department.deptname }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationDefault02">Shift</label>
                                <!-- <input type="text" class="form-control" id="validationDefault02" placeholder="Shift" v-for="(shift,ind) in shifts" v-if="details.shiftid==shift.shiftid" v-model="shift.shift" required> -->
                                <select v-model="deptshift.shiftid" class="form-control">
                                    <option>Shift Name</option>
                                    <option v-for="(shift, ind) in shifts" v-if="shifts.length > 0" v-bind:value="shift.shiftid">
                                        {{ shift.shift }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <button class="btn btn-sm btn-info">
                                    update
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </b-modal>

            <b-modal id="modalBreak" ref="modalBreak" title="Add BREAKS">
                <form @submit.prevent="addBreaks()">
                    <div class="container">
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationDefault01">Break IN</label>
                                <input type="text" id="breakIn" class="form-control" v-model="details.dateIN" placeholder="Break End" disabled="" />
                                <date-picker
                                    v-model="details.breakIN"
                                    type="time"
                                    v-validate="'required'"
                                    data-vv-name="inTime"
                                    placeholder="In Time"
                                    lang="en"
                                    format="HH:mm"
                                    class="form-control"
                                    :time-picker-options="timePickerOptions"
                                />
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="validationDefault02">Break Out</label>
                                <input type="text" id="breakOut" class="form-control" v-model="details.dateOUT" placeholder="Break End" />
                                <date-picker
                                    v-model="details.breakOut"
                                    type="time"
                                    v-validate="'required'"
                                    data-vv-name="inTime"
                                    placeholder="In Time"
                                    lang="en"
                                    format="HH:mm"
                                    class="form-control"
                                    :time-picker-options="timePickerOptions"
                                />
                            </div>

                            <div class="col-md-4 mb-3">
                                <button class="btn btn-sm btn-info">
                                    ADD BREAK
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </b-modal>
        </section>
    </div>
</template>
<script>
import Vue from "vue";
import VeeValidate from "vee-validate"; //, {enableAutoClasses: true }

import DatePicker from "vue2-datepicker";
import manageTimeCard from '~/api/manageTimeCard.js';

Vue.use(VeeValidate);

var moment = require("moment");
Vue.filter("dateFormat", function (value) {
  if (value) {
    return moment(String(value)).format("DD/MM/YYYY");
  }
})
export default {
  name: 'manageTimeCard',
  components: { DatePicker },
  data () {
    return {
      clients: [],
      departments: [],
      shifts: [],
      weeks: [],
      selected: [],
      winfos: [],
      hours: '',
      counter: [],
      details: [],
      deptshift: [],
      model: {},
      timePickerOptions: {
        start: '00:00',
        step: '00:30',
        end: '23:30'
      }
    };
  },
  mounted () {
    this.getClient();
  },
  destroyed() {},
  methods: {
    showupdate(id) {
      this.$refs.modalDateIN.show();
    },
    showDateOut(id) {
      this.$refs.modalDateOUT.show();
    },
    showDeptShift(id) {
      this.$refs.modalDeptShift.show();
    },
    showBreaks(id) {
      this.$refs.modalBreak.show();
    },

    updateDateIN(details) {
      const cdate = moment(this.details.dateIN).format('YYYY-MM-DD')
      let ctime = moment(this.details.datetimeIN).format('HH:mm:ss')
      let inTime = cdate + ' ' + ctime
      let id = this.details.ID;
      // alert(id);
      // return false;
      axios.post(API_URL + '/manageTimeCard/dateIN', {
          datetimeIN: inTime,
          id: id
        })
        .then(response => {
            Notify.success("Updated Successfully.");

          // alert('hihi');
          console.log(response);
        }, err => {
          this.$setErrorsFromResponse(err.response.data);
          Notify.error(err.response.data.message)
            // console.log('Rdata', err.response.data);
            // console.log('Data', err.data);
        })
    },
    updateDateOut(details) {
      const cdate = moment(this.details.dateOUT).format("YYYY-MM-DD");
      let ctime = moment(this.details.datetimeOUT).format('HH:mm:ss')
      let inTime = cdate + ' ' + ctime
      let id = this.details.ID;
      // alert(id);
      axios.post(API_URL + '/manageTimeCard/dateOut', {
          datetimeOUT: inTime,
          id: id
        })
        .then(response => {
            Notify.success("Updated Successfully.");
          console.log(response);
        }, err => {
          this.$setErrorsFromResponse(err.response.data);
          Notify.error(err.response.data.message)
        );
    },

    updateDeptShift(details) {
      const id = this.details.ID
      let shift = this.deptshift.shiftid
      let dept = this.deptshift.deptid



      axios.post(API_URL + '/manageTimeCard/updateDeptShift', {
          dept: dept,
          shift: shift,
          id: id
        })
        .then(response => {
            Notify.success("Updated Successfully.");
          console.log(response);
        }, err => {
          this.$setErrorsFromResponse(err.response.data);
          Notify.error(err.response.data.message)
                    })
        },
    addBreaks(details) {
      const cdate = moment(this.details.dateIN).format('YYYY-MM-DD')
      let ctime = moment(this.details.breakIN).format('HH:mm:ss')
      let inTime = cdate + ' ' + ctime
      this.details.timeIN = inTime;
      let bdate = moment(this.details.dateOUT).format('YYYY-MM-DD')
      let btime = moment(this.details.breakOut).format('HH:mm:ss')
      let outTime = bdate + ' ' + btime
      this.details.timeOUT = outTime;
      // this.details.inDate = moment(new Date).format('YYYY-MM-DD HH:mm:ss');

      let id = this.details.ID

      axios.post(API_URL + '/manageTimeCard/addBreaks', {
          breakIn: inTime,
          breakOut: outTime,
          maintimecode: this.details.maintimecode,
          status: this.details.status,
          id: id
        })
        .then(response => {
            Notify.success("Updated Successfully.");
          console.log(response);
        }, err => {
          this.$setErrorsFromResponse(err.response.data);
          Notify.error(err.response.data.message)
                    })
        },
    deleteBreaks(winfos) {},

    showModal(id) {
      const detail = id;
      this.details = detail
      // this.getClient();
      this.$refs.modal.show();
    },

    select(event) {
      const id = event.target.value
      axios.get(API_URL + '/manageTimeCard/info/' + id).then(response => {
        this.winfos = response.data.winfo;
        console.log(this.hours = response.data.hour)
        // console.log(response);
      })
        },
    onChange(event) {
      // console.log(event.target.value)
      var id = event.target.value;
      axios.get(API_URL + '/manageTimeCard/' + id).then(response => {
        this.weeks = response.data.week;
        // console.log(response);
        // Notify.success('Updated Successfully.');
        // alert('hihi');
        // console.log(response);
            })
    },
    getClient() {
      const self = this

      manageTimeCard.get_single(data => {
          self.clients = data.client;
        self.departments = data.department
        self.shifts = data.shift
      }, err => {
        Notify.error(err.response.data.message);
        self.$router.push({ path: '/admin/newDashboard' })
      })
        }

  }
}
</script>
<style scoped lang="scss">
.card.cardFilters {
    .card-body {
        .form-group {
            margin: 0;
            label {
                margin-bottom: 6px;
            }
        }
    }
}

.inner-th.d-flex {
    border-bottom: 1px solid #e5eaed;
    padding: 6px 16px;
    & > div {
        flex: auto;
        text-align: left;
    }
}
.inner-tbody ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
    li {
        position: relative;
        display: flex;
        align-items: center;
        border-bottom: 1px solid #e5eaed;
        padding: 8px 16px;
        cursor: pointer;
        div {
            flex: 0 50%;
            &.checkbox {
                height: 18px;
                margin: 0;
                flex: auto;
                .cr {
                    width: 18px;
                    height: 18px;
                    font-size: 14px;
                    margin: 0 6px 0 0;
                }
                input {
                    position: absolute;
                    left: 0;
                    right: 0;
                    top: 0;
                    bottom: 0;
                    display: inline-block;
                    width: 100%;
                    height: 100%;
                    opacity: 0;
                    cursor: pointer;
                }
                label {
                    width: 100%;
                }
            }
        }
        &.selected,
        &:hover {
            background-color: #e5eaed;
        }
    }
}
.d-flex.inline-input .form-group:first-child {
    margin-right: 32px;
}
.card.no-padding {
    .card-body {
        padding: 0;
    }
    &.heding-colored .card-header {
        background-color: #dbcda4;
        color: #fff;
    }
}
</style>
