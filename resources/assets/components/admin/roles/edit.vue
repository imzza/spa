<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header mb-4">
            <b-card tag="article" class="mb-2">
                <div class="row justify-content-center">
                    <div class="col-9 ">
                        <form @submit.prevent="saveRole">
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
                                        data-vv-as="Role name"
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
                                        data-vv-as="Role display name"
                                    />
                                    <span v-show="errors.has('rolename')" class="help is-danger">{{ errors.first('rolename') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label
                                    for="role_descrip"
                                    class="col-sm-2 form-control-label"
                                    >Role Description</label
                                >
                                <div class="col-sm-10">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="role_descrip"
                                        name="role_descrip"
                                        v-model="model.role_descrip"
                                        placeholder="Role Description"
                                        v-validate="'required'"
                                        data-vv-as="Role description"
                                        
                                    /><!--  data-vv-as="Role Description" -->
                                 <span v-show="errors.has('role_descrip')" class="help is-danger">{{ errors.first('role_descrip') }}</span>
                                </div>

                            </div>
                           
                            <div class="form-group row">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button
                                        type="submit"
                                        class="btn btn-secondary"
                                    >
                                        Update
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
//Vue.use(VeeValidate); //events: '', , { enableAutoClasses: true }

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
                role_descrip: '',
            }
        };
    },
    mounted() {
        this.getRole();
    },
    methods: {
        saveRole(){
            let self = this
            self.$validator.validateAll().then(result => {
                if (result) {
                    let id = self.$route.params.id;
                    roles.update_role(id,self.model, data => {
                        Notify.success('Updated Successfully.');
                        self.$router.push({path: '/admin/roles'});
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
        getRole(){
            let self=  this;
            let id = self.$route.params.id;
            if (id) {
                roles.get_role(id, data => {
                    self.model = data;
                    self.$nextTick(() => {
                      self.$validator.reset();
                    });
                }, err =>{
                    Notify.error(err.response.data.message);
                    self.$router.push({ path: '/admin/roles_all' });
                });
            }else{
                Notify.error('Record Not Found');
                self.$router.push({ path: '/admin/roles_all' });
            }
        },
    },
    destroyed() {}
};
</script>

<style type="text/css" scoped lang="scss"></style>
