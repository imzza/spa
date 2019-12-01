<template>
    <div>
        <section class="content-header mb-4">
            <b-card tag="article" class="mb-2">
                <div class="row justify-content-center">
                    <div class="col-9 ">
                        <div class="row justify-content-center">
                            <h4>Edit Employee</h4>
                        </div>
                        <form @submit.prevent="updateEmployee">
                            <div class="form-group row">
                                <label for="EEFN" class="col-sm-2 form-control-label">First Name</label>
                                <div class="col-sm-10">
                                    <input id="EEFN" v-model="model.EEFN" v-validate="'required'" type="text" class="form-control" name="EEFN" />
                                    <span v-show="errors.has('EEFN')" class="help is-danger">{{ errors.first('EEFN') }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="EEMI" class="col-sm-2 form-control-label">Middle Name</label>
                                <div class="col-sm-10">
                                    <input id="EEMI" v-model="model.EEMI" type="text" class="form-control" name="EEMI" />
                                    <span v-show="errors.has('EEMI')" class="help is-danger">{{ errors.first('EEMI') }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="EELN" class="col-sm-2 form-control-label">Last Name</label>
                                <div class="col-sm-10">
                                    <input id="EELN" v-model="model.EELN" v-validate="'required'" type="text" class="form-control" name="EELN" />
                                    <span v-show="errors.has('EELN')" class="help is-danger">{{ errors.first('EELN') }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="eeName" class="col-sm-2 form-control-label">Full Name</label>
                                <div class="col-sm-10">
                                    <input id="eeName" v-model="model.eeName" v-validate="'required'" type="text" class="form-control" name="eeName" />
                                    <span v-show="errors.has('eeName')" class="help is-danger">{{ errors.first('eeName') }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="SSN" class="col-sm-2 form-control-label">SSN</label>
                                <div class="col-sm-10">
                                    <input id="SSN" v-model="model.SSN" v-validate="'required'" type="text" class="form-control" name="SSN" />
                                    <span v-show="errors.has('SSN')" class="help is-danger">{{ errors.first('SSN') }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Add1" class="col-sm-2 form-control-label">Adddress1</label>
                                <div class="col-sm-10">
                                    <input id="Add1" v-model="model.Add1" v-validate="'required'" type="text" class="form-control" name="Add1" />
                                    <span v-show="errors.has('Add1')" class="help is-danger">{{ errors.first('Add1') }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Add2" class="col-sm-2 form-control-label">Adddress2</label>
                                <div class="col-sm-10">
                                    <input id="Add2" v-model="model.Add2" type="text" class="form-control" name="Add2" />
                                    <span v-show="errors.has('Add2')" class="help is-danger">{{ errors.first('Add2') }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="City" class="col-sm-2 form-control-label">City</label>
                                <div class="col-sm-10">
                                    <input id="City" v-model="model.City" type="text" class="form-control" name="City" />
                                    <span v-show="errors.has('City')" class="help is-danger">{{ errors.first('City') }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="AddState" class="col-sm-2 form-control-label">State</label>
                                <div class="col-sm-10">
                                    <input id="AddState" v-model="model.AddState" type="text" class="form-control" name="AddState" />
                                    <span v-show="errors.has('AddState')" class="help is-danger">{{ errors.first('AddState') }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Zip" class="col-sm-2 form-control-label">Zip</label>
                                <div class="col-sm-10">
                                    <input id="Zip" v-model="model.Zip" type="text" class="form-control" name="Zip" />
                                    <span v-show="errors.has('Zip')" class="help is-danger">{{ errors.first('Zip') }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Phone1" class="col-sm-2 form-control-label">Phone1</label>
                                <div class="col-sm-10">
                                    <input id="Phone1" v-model="model.Phone1" type="text" class="form-control" name="Phone1" />
                                    <span v-show="errors.has('Phone1')" class="help is-danger">{{ errors.first('Phone1') }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Phone2" class="col-sm-2 form-control-label">Phone2</label>
                                <div class="col-sm-10">
                                    <input id="Phone2" v-model="model.Phone2" type="text" class="form-control" name="Phone2" />
                                    <span v-show="errors.has('Phone2')" class="help is-danger">{{ errors.first('Phone2') }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="DOB" class="col-sm-2 form-control-label">DOB</label>
                                <div class="col-sm-10">
                                    <date-picker v-model="model.DOB" v-validate="'required'" type="date" data-vv-name="DOB" format="MM/DD/YYYY" lang="en" />
                                    <span v-show="errors.has('DOB')" class="help is-danger">{{ errors.first('DOB') }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="OpenFileDate" class="col-sm-2 form-control-label">OpenFileDate</label>
                                <div class="col-sm-10">
                                    <date-picker v-model="model.OpenFileDate" v-validate="'required'" type="date" data-vv-name="OpenFileDate" format="MM/DD/YYYY" lang="en" />
                                    <span v-show="errors.has('OpenFileDate')" class="help is-danger">{{ errors.first('OpenFileDate') }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="EndOfServiceDate" class="col-sm-2 form-control-label">EndOfServiceDate</label>
                                <div class="col-sm-10">
                                    <date-picker v-model="model.EndOfServiceDate" type="date" data-vv-name="EndOfServiceDate" format="MM/DD/YYYY" lang="en" />
                                    <span v-show="errors.has('EndOfServiceDate')" class="help is-danger">{{ errors.first('EndOfServiceDate') }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email1" class="col-sm-2 form-control-label">Email1</label>
                                <div class="col-sm-10">
                                    <input id="email1" v-model="model.email1" v-validate="'required|email'" type="email" class="form-control" name="email1" />
                                    <span v-show="errors.has('email1')" class="help is-danger">{{ errors.first('email1') }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="isMinor" class="col-sm-2 form-control-label">isMinor</label>
                                <div class="col-sm-10">
                                    <input id="isMinor" v-model="model.isMinor" type="checkbox" class="form-check" :true-value="1" name="isMinor" />
                                    <span v-show="errors.has('isMinor')" class="help is-danger">{{ errors.first('isMinor') }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="FedStatus" class="col-sm-2 form-control-label">FedStatus</label>
                                <div class="col-sm-10">
                                    <input id="FedStatus" v-model="model.FedStatus" v-validate="'required'" type="text" class="form-control" name="FedStatus" />
                                    <span v-show="errors.has('FedStatus')" class="help is-danger">{{ errors.first('FedStatus') }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="FedAllow" class="col-sm-2 form-control-label">FedAllow</label>
                                <div class="col-sm-10">
                                    <input id="FedAllow" v-model="model.FedAllow" v-validate="'decimal:4'" type="number" step="any" class="form-control" name="FedAllow" />
                                    <span v-show="errors.has('FedAllow')" class="help is-danger">{{ errors.first('FedAllow') }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="EFWT" class="col-sm-2 form-control-label">EFWT</label>
                                <div class="col-sm-10">
                                    <input id="EFWT" v-model="model.EFWT" v-validate="'decimal:4'" type="number" step="any" class="form-control" name="EFWT" />
                                    <span v-show="errors.has('EFWT')" class="help is-danger">{{ errors.first('EFWT') }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="EFW_PER" class="col-sm-2 form-control-label">EFW%</label>
                                <div class="col-sm-10">
                                    <input id="EFW_PER" v-model="model.EFW_PER" v-validate="'decimal:4'" type="number" step="any" class="form-control" name="EFW_PER" />
                                    <span v-show="errors.has('EFW_PER')" class="help is-danger">{{ errors.first('EFW_PER') }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="EFW" class="col-sm-2 form-control-label">EFW$</label>
                                <div class="col-sm-10">
                                    <input id="EFW" v-model="model.EFW" v-validate="'decimal:4'" type="number" step="any" class="form-control" name="EFW" />
                                    <span v-show="errors.has('EFW')" class="help is-danger">{{ errors.first('EFW') }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="StStatus" class="col-sm-2 form-control-label">StStatus</label>
                                <div class="col-sm-10">
                                    <input id="StStatus" v-model="model.StStatus" v-validate="'required'" type="text" class="form-control" name="StStatus" />
                                    <span v-show="errors.has('StStatus')" class="help is-danger">{{ errors.first('StStatus') }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="StAllow" class="col-sm-2 form-control-label">StAllow</label>
                                <div class="col-sm-10">
                                    <input id="StAllow" v-model="model.StAllow" v-validate="'decimal:4'" type="number" step="any" class="form-control" name="StAllow" />
                                    <span v-show="errors.has('StAllow')" class="help is-danger">{{ errors.first('StAllow') }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ESWT" class="col-sm-2 form-control-label">ESWT</label>
                                <div class="col-sm-10">
                                    <input id="ESWT" v-model="model.ESWT" v-validate="'decimal:4'" type="number" step="any" class="form-control" name="ESWT" />
                                    <span v-show="errors.has('ESWT')" class="help is-danger">{{ errors.first('ESWT') }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-secondary">
                                        Save
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
import Vue from 'vue';
import VeeValidate from 'vee-validate'; // events: '', , { enableAutoClasses: true }

import DatePicker from 'vue2-datepicker';
import employees from '~/api/employees.js';
Vue.use(VeeValidate);

var moment = require('moment');
export default {
    name: 'ClientEdit',
    components: { DatePicker },
    data() {
        return {
            msg: '',
            clients: [],
            model: {},
        };
    },
    mounted() {
        this.getEmployee();
    },
    beforeRouteEnter(to, from, next) {
        if (to.params.id) {
            console.log(to.params.id);

            next();
        } else {
            next({ path: '/admin/employees_all' });
        }
    },
    destroyed() {},
    methods: {
        updateEmployee() {
            const self = this;
            self.$validator.validateAll().then(result => {
                if (result) {
                    const id = self.$route.params.id;
                    employees.update(
                        id,
                        self.model,
                        data => {
                            Notify.success('Updated Successfully.');
                            self.$router.push({ path: '/admin/employees_all' });
                            self.model = {};
                            self.errors.items = [];
                        },
                        err => {
                            self.$setErrorsFromResponse(err.response.data);
                            Notify.error(err.response.data.message);
                            // console.log('Rdata', err.response.data);
                            // console.log('Data', err.data);
                        }
                    );
                }
            });
        },
        getEmployee() {
            const self = this;
            const id = self.$route.params.id;
            if (id) {
                employees.get_single(
                    id,
                    data => {
                        self.model = data;
                        // self.model = data.department;

                        self.$nextTick(() => {
                            self.$validator.reset();
                        });
                    },
                    err => {
                        Notify.error(err.response.data.message);
                        self.$router.push({ path: '/admin/departments_all' });
                    }
                );
            } else {
                Notify.error('Record Not Found');
                self.$router.push({ path: '/admin/departments_all' });
            }
        },
    },
};
</script>
<style type="text/css" scoped lang="scss"></style>
