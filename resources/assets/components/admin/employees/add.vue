<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header mb-4">
            <b-card tag="article" class="mb-2">
                <div class="row justify-content-center">
                    <div class="col-9 ">
                        <div class="row justify-content-center">
                            <h4>Add Employee</h4>
                        </div>
                        <form @submit.prevent="addEmployee">
                            <div class="form-group row">
                                <label for="EEFN"class="col-sm-2 form-control-label">First Name</label >
                                <div class="col-sm-10">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="EEFN"
                                        name="EEFN"
                                        v-model="model.EEFN"
                                        v-validate="'required'"
                                    />
                                    <span v-show="errors.has('EEFN')" class="help is-danger">{{ errors.first('EEFN') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="EEMI"class="col-sm-2 form-control-label">Middle Name</label >
                                <div class="col-sm-10">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="EEMI"
                                        name="EEMI"
                                        v-model="model.EEMI"
                                    />
                                    <span v-show="errors.has('EEMI')" class="help is-danger">{{ errors.first('EEMI') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="EELN"class="col-sm-2 form-control-label">Last Name</label >
                                <div class="col-sm-10">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="EELN"
                                        name="EELN"
                                        v-model="model.EELN"
                                        v-validate="'required'"
                                    />
                                    <span v-show="errors.has('EELN')" class="help is-danger">{{ errors.first('EELN') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="eeName"class="col-sm-2 form-control-label">Full Name</label >
                                <div class="col-sm-10">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="eeName"
                                        name="eeName"
                                        v-model="model.eeName"
                                        v-validate="'required'"
                                    />
                                    <span v-show="errors.has('eeName')" class="help is-danger">{{ errors.first('eeName') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="SSN"class="col-sm-2 form-control-label">SSN</label >
                                <div class="col-sm-10">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="SSN"
                                        name="SSN"
                                        v-model="model.SSN"
                                        v-validate="'required'"
                                    />
                                    <span v-show="errors.has('SSN')" class="help is-danger">{{ errors.first('SSN') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Add1"class="col-sm-2 form-control-label">Adddress1</label >
                                <div class="col-sm-10">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="Add1"
                                        name="Add1"
                                        v-model="model.Add1"
                                        v-validate="'required'"
                                    />
                                    <span v-show="errors.has('Add1')" class="help is-danger">{{ errors.first('Add1') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Add2"class="col-sm-2 form-control-label">Adddress2</label >
                                <div class="col-sm-10">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="Add2"
                                        name="Add2"
                                        v-model="model.Add2"
                                    />
                                    <span v-show="errors.has('Add2')" class="help is-danger">{{ errors.first('Add2') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="City"class="col-sm-2 form-control-label">City</label >
                                <div class="col-sm-10">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="City"
                                        name="City"
                                        v-model="model.City"
                                    />
                                    <span v-show="errors.has('City')" class="help is-danger">{{ errors.first('City') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="AddState"class="col-sm-2 form-control-label">State</label >
                                <div class="col-sm-10">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="AddState"
                                        name="AddState"
                                        v-model="model.AddState"
                                    />
                                    <span v-show="errors.has('AddState')" class="help is-danger">{{ errors.first('AddState') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Zip"class="col-sm-2 form-control-label">Zip</label >
                                <div class="col-sm-10">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="Zip"
                                        name="Zip"
                                        v-model="model.Zip"
                                    />
                                    <span v-show="errors.has('Zip')" class="help is-danger">{{ errors.first('Zip') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Phone1"class="col-sm-2 form-control-label">Phone1</label >
                                <div class="col-sm-10">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="Phone1"
                                        name="Phone1"
                                        v-model="model.Phone1"
                                    />
                                    <span v-show="errors.has('Phone1')" class="help is-danger">{{ errors.first('Phone1') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Phone2"class="col-sm-2 form-control-label">Phone2</label >
                                <div class="col-sm-10">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="Phone2"
                                        name="Phone2"
                                        v-model="model.Phone2"
                                    />
                                    <span v-show="errors.has('Phone2')" class="help is-danger">{{ errors.first('Phone2') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="DOB"class="col-sm-2 form-control-label">DOB</label >
                                <div class="col-sm-10">
                                    <date-picker  type="date" data-vv-name="DOB" format="MM/DD/YYYY" lang="en" v-model="model.DOB" v-validate="'required'">
                                    </date-picker>
                                    <span v-show="errors.has('DOB')" class="help is-danger">{{ errors.first('DOB') }}</span>
                                </div>
                            </div>
                            
                            

                            <div class="form-group row">
                                <label for="OpenFileDate"class="col-sm-2 form-control-label">OpenFileDate</label >
                                <div class="col-sm-10">
                                    <date-picker  type="date" data-vv-name="OpenFileDate" format="MM/DD/YYYY" lang="en" v-model="model.OpenFileDate" v-validate="'required'">
                                    </date-picker>
                                    <span v-show="errors.has('OpenFileDate')" class="help is-danger">{{ errors.first('OpenFileDate') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="EndOfServiceDate"class="col-sm-2 form-control-label">EndOfServiceDate</label >
                                <div class="col-sm-10">
                                    <date-picker  type="date" data-vv-name="EndOfServiceDate" format="MM/DD/YYYY" lang="en" v-model="model.EndOfServiceDate">
                                    </date-picker>
                                    <span v-show="errors.has('EndOfServiceDate')" class="help is-danger">{{ errors.first('EndOfServiceDate') }}</span>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="email1"class="col-sm-2 form-control-label">Email1</label >
                                <div class="col-sm-10">
                                    <input
                                        type="email"
                                        class="form-control"
                                        id="email1"
                                        name="email1"
                                        v-model="model.email1"
                                        v-validate="'required|email'"
                                    />
                                    <span v-show="errors.has('email1')" class="help is-danger">{{ errors.first('email1') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="isMinor"class="col-sm-2 form-control-label">isMinor</label >
                                <div class="col-sm-10">
                                    <input
                                        type="checkbox"
                                        class="form-check"
                                        id="isMinor"
                                        :true-value="1"
                                        name="isMinor"
                                        v-model="model.isMinor"
                                    />
                                    <span v-show="errors.has('isMinor')" class="help is-danger">{{ errors.first('isMinor') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="FedStatus"class="col-sm-2 form-control-label">FedStatus</label >
                                <div class="col-sm-10">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="FedStatus"
                                        name="FedStatus"
                                        v-model="model.FedStatus"
                                        v-validate="'required'"
                                    />
                                    <span v-show="errors.has('FedStatus')" class="help is-danger">{{ errors.first('FedStatus') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="FedAllow"class="col-sm-2 form-control-label">FedAllow</label >
                                <div class="col-sm-10">
                                    <input
                                        type="number"
                                        step="any"
                                        class="form-control"
                                        id="FedAllow"
                                        name="FedAllow"
                                        v-model="model.FedAllow"
                                        v-validate="'decimal:4'"
                                    />
                                    <span v-show="errors.has('FedAllow')" class="help is-danger">{{ errors.first('FedAllow') }}</span>
                                </div>
                            </div>

                          

                            <div class="form-group row">
                                <label for="EFWT"class="col-sm-2 form-control-label">EFWT</label >
                                <div class="col-sm-10">
                                    <input
                                        type="number"
                                        step="any"
                                        class="form-control"
                                        id="EFWT"
                                        name="EFWT"
                                        v-model="model.EFWT"
                                        v-validate="'decimal:4'"
                                    />
                                    <span v-show="errors.has('EFWT')" class="help is-danger">{{ errors.first('EFWT') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="EFW_PER"class="col-sm-2 form-control-label">EFW%</label >
                                <div class="col-sm-10">
                                    <input
                                        type="number"
                                        step="any"
                                        class="form-control"
                                        id="EFW_PER"
                                        name="EFW_PER"
                                        v-model="model.EFW_PER"
                                        v-validate="'decimal:4'"
                                    />
                                    <span v-show="errors.has('EFW_PER')" class="help is-danger">{{ errors.first('EFW_PER') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="EFW"class="col-sm-2 form-control-label">EFW$</label >
                                <div class="col-sm-10">
                                    <input
                                        type="number"
                                        step="any"
                                        class="form-control"
                                        id="EFW"
                                        name="EFW"
                                        v-model="model.EFW"
                                        v-validate="'decimal:4'"
                                    />
                                    <span v-show="errors.has('EFW')" class="help is-danger">{{ errors.first('EFW') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="StStatus"class="col-sm-2 form-control-label">StStatus</label >
                                <div class="col-sm-10">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="StStatus"
                                        name="StStatus"
                                        v-model="model.StStatus"
                                        v-validate="'required'"
                                    />
                                    <span v-show="errors.has('StStatus')" class="help is-danger">{{ errors.first('StStatus') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="StAllow"class="col-sm-2 form-control-label">StAllow</label >
                                <div class="col-sm-10">
                                    <input
                                        type="number"
                                        step="any"
                                        class="form-control"
                                        id="StAllow"
                                        name="StAllow"
                                        v-model="model.StAllow"
                                        v-validate="'decimal:4'"
                                    />
                                    <span v-show="errors.has('StAllow')" class="help is-danger">{{ errors.first('StAllow') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ESWT"class="col-sm-2 form-control-label">ESWT</label >
                                <div class="col-sm-10">
                                    <input
                                        type="number"
                                        step="any"
                                        class="form-control"
                                        id="ESWT"
                                        name="ESWT"
                                        v-model="model.ESWT"
                                        v-validate="'decimal:4'"
                                    />
                                    <span v-show="errors.has('ESWT')" class="help is-danger">{{ errors.first('ESWT') }}</span>
                                </div>
                            </div>
                            




                          

                            <!-- <div class="form-group row">
                                <label for="corpid"class="col-sm-2 form-control-label">Client</label >
                                <div class="col-sm-10">
                                    <select name="corpid" id="corpid" class="form-control" v-model="model.clientid" v-validate="'required'">
                                        <option v-for="(client, ind) in clients" :key="client.id" :value="client.id">{{ client.EEFN }}</option>
                                            
                                    </select>
                                    <span v-show="errors.has('clientid')" class="help is-danger">{{ errors.first('clientid') }}</span>
                                </div>
                            </div> -->

                         
                           
                            <div class="form-group row">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button
                                        type="submit"
                                        class="btn btn-secondary"
                                    >
                                        Add
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </b-card>
        </section>
    </div>
</template>
<script>
import Vue from "vue";
import VeeValidate from "vee-validate";
Vue.use(VeeValidate); //,{enableAutoClasses: true }


import DatePicker from "vue2-datepicker";

var moment = require("moment");


 // <span v-show="errors.has('confirm_password')" class="text-danger">{{ errors.first('confirm_password') }}</span>

var moment = require("moment");
// import clients from '~/api/clients.js';
import employees from '~/api/employees.js';

export default {
    name: "corporations_add",
    components: {DatePicker},
    data() {
        return {
            clients: [],
            model:{
            }
        };
    },
    mounted() {
        // this.getClients();
    },
    methods: {
        getClients(){
            clients.view(data => {
                this.clients = data;
            }, err => {
                console.log(err.response);
            });
        },

        addEmployee(){
            let self = this
            self.$validator.validateAll().then(result => {
                if (result) {
                    if (self.model.EndOfServiceDate !='') {
                        self.model.EndOfServiceDate =  moment(self.model.EndOfServiceDate).format('YYYY-MM-DD HH:mm:ss');
                    }
                   
                   self.model.DOB =  moment(self.model.DOB).format('YYYY-MM-DD HH:mm:ss');
                   self.model.OpenFileDate =  moment(self.model.OpenFileDate).format('YYYY-MM-DD HH:mm:ss');
                    

                    employees.add(self.model, data => {
                        Notify.success('Created Successfully.');
                        self.$router.push({path: '/admin/employees_all'});
                        // console.log(data);
                        self.model = {};
                        self.errors.items = [];
                        // self.$nextTick(() => self.$validator.reset())
                    }, err => {
                        self.$setErrorsFromResponse(err.response.data);
                       Notify.error(err.response.data.message);
                        // console.log('Rdata', err.response.data);
                        // console.log('Data', err.data);
                    });
                }
            });
        },
    },
    destroyed() {}
};
</script>

<style type="text/css" scoped lang="scss"></style>
