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
                                    class="col-sm-4 form-control-label"
                                    >Permission Name</label
                                >
                                <div class="col-sm-8">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="name"
                                        name="name"
                                        v-model="model.name"
                                        placeholder="Permission Name"
                                        v-validate="'required'"
                                        data-vv-as="Permission Name"
                                    />
                                    <span v-show="errors.has('name')" class="help is-danger">{{ errors.first('name') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label
                                    for="permissionkey"
                                    class="col-sm-4 form-control-label"
                                    >Permission Display Name</label
                                >
                                <div class="col-sm-8">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="permissionkey"
                                        name="permissionkey"
                                        v-model="model.permissionkey"
                                        placeholder="Permission Display Name"
                                        v-validate="'required'"
                                        data-vv-as="Permission Display Name"
                                    />
                                    <span v-show="errors.has('permissionkey')" class="help is-danger">{{ errors.first('permissionkey') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label
                                    for="permissiontype"
                                    class="col-sm-4 form-control-label"
                                    >Permission Type</label
                                >
                                <div class="col-sm-8">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="permissiontype"
                                        name="permissiontype"
                                        v-model="model.permissiontype"
                                        placeholder="Permission Type"
                                        v-validate="'required'"
                                        data-vv-as="Permission Type"
                                    />
                                 <span v-show="errors.has('permissiontype')" class="help is-danger">{{ errors.first('permissiontype') }}</span>
                                </div>

                            </div>
                           
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button
                                        type="submit"
                                        class="btn btn-secondary pull-right"
                                    >
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
import Vue from "vue";
import VeeValidate from "vee-validate";
Vue.use(VeeValidate); //,{enableAutoClasses: true }
Vue.use(VeeValidate, {fieldsBagName: 'formFields'})
import roles from '~/api/roles.js';
export default {
    name: "role_add",
    components: {},
    data() {
        return {
            msg: "",
            model:{
                name: '',
                permissionkey: '',
                permissiontype: '',
            }
        };
    },
    mounted() {},
    methods: {
        addRole(){
            let self = this
            self.$validator.validateAll().then(result => {
                if (result) {
                    roles.add_permission(self.model, data => {
                        Notify.success('Created Successfully.');
                        self.$router.push({path: '/admin/permissions_all'});
                        self.model = {};
                        self.errors.items = [];
                    }, err => {
                        self.$setErrorsFromResponse(err.response.data);
                        Notify.error(err.response.data.message);
                    });
                }
            });
        },
    },
    destroyed() {}
};
</script>

<style type="text/css" scoped lang="scss"></style>
