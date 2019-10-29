<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header mb-4">
            <b-card tag="article" class="mb-2">
                <div class="row justify-content-center">
                    <div class="col-9 ">
                        <form @submit.prevent="addRole">
                            <div class="form-group row">
                                <label
                                    for="name"
                                    class="col-sm-2 form-control-label"
                                    >Role Name</label
                                >
                                <div class="col-sm-10">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="name"
                                        name="name"
                                        v-model="model.name"
                                        placeholder="Role Name"
                                        v-validate="'required'"
                                        data-vv-as="Role Name"
                                    />
                                    <span v-show="errors.has('name')" class="help is-danger">{{ errors.first('name') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label
                                    for="rolename"
                                    class="col-sm-2 form-control-label"
                                    >Role Display Name</label
                                >
                                <div class="col-sm-10">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="rolename"
                                        name="rolename"
                                        v-model="model.rolename"
                                        placeholder="Role Display Name"
                                        v-validate="'required'"
                                        data-vv-as="Role Display Name"
                                    />
                                    <span v-show="errors.has('rolename')" class="help is-danger">{{ errors.first('rolename') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label
                                    for="roledescription"
                                    class="col-sm-2 form-control-label"
                                    >Role Description</label
                                >
                                <div class="col-sm-10">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="roledescription"
                                        name="roledescription"
                                        v-model="model.roledescription"
                                        placeholder="Role Description"
                                        v-validate="'required'"
                                        data-vv-as="Role Description"
                                    />
                                 <span v-show="errors.has('roledescription')" class="help is-danger">{{ errors.first('roledescription') }}</span>
                                </div>

                            </div>
                           
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


// Vue.use(VeeValidate);
Vue.use(VeeValidate, {fieldsBagName: 'formFields'})

 // <span v-show="errors.has('confirm_password')" class="text-danger">{{ errors.first('confirm_password') }}</span>

// var moment = require("moment");
import roles from '~/api/roles.js';
export default {
    name: "role_add",
    components: {},
    data() {
        return {
            msg: "",
            model:{
                name: '',
                rolename: '',
                roledescription: '',
            }
        };
    },
    mounted() {},
    methods: {
        addRole(){
            let self = this
            self.$validator.validateAll().then(result => {
                if (result) {
                    roles.add_role(self.model, data => {
                        Notify.success('Created Successfully.');
                        self.$router.push({path: '/admin/roles_all'});
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
