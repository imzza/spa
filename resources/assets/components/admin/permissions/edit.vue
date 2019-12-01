<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header mb-4">
            <b-card tag="article" class="mb-2">
                <div class="row justify-content-center">
                    <div class="col-9 ">
                        <form @submit.prevent="saveRole">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 form-control-label">Permission Name</label>
                                <div class="col-sm-10">
                                    <input
                                        id="name"
                                        v-model="model.name"
                                        v-validate="'required'"
                                        type="text"
                                        class="form-control"
                                        name="name"
                                        placeholder="Permission Name"
                                        data-vv-as="Permission Name"
                                    />
                                    <span v-show="errors.has('name')" class="help is-danger">{{ errors.first('name') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="key" class="col-sm-2 form-control-label">Permission Display Name</label>
                                <div class="col-sm-10">
                                    <input
                                        id="key"
                                        v-model="model.key"
                                        v-validate="'required'"
                                        type="text"
                                        class="form-control"
                                        name="key"
                                        placeholder="Permission Display Name"
                                        data-vv-as="Permission Display Name"
                                    />
                                    <span v-show="errors.has('key')" class="help is-danger">{{ errors.first('key') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="type" class="col-sm-2 form-control-label">Permission Type</label>
                                <div class="col-sm-10">
                                    <input
                                        id="type"
                                        v-model="model.type"
                                        v-validate="'required'"
                                        type="text"
                                        class="form-control"
                                        name="type"
                                        placeholder="Permission Type"
                                        data-vv-as="Permission Type"
                                    />
                                    <span v-show="errors.has('type')" class="help is-danger">{{ errors.first('type') }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-secondary">
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
import Vue from 'vue';
import VeeValidate from 'vee-validate';

// <span v-show="errors.has('confirm_password')" class="text-danger">{{ errors.first('confirm_password') }}</span>

// var moment = require("moment");
import roles from '~/api/roles.js';
// Vue.use(VeeValidate); //events: '', , { enableAutoClasses: true }

Vue.use(VeeValidate, { fieldsBagName: 'formFields' });
export default {
    name: 'role_add',
    components: {},
    data() {
        return {
            msg: '',
            model: {
                name: '',
                key: '',
                type: '',
            },
        };
    },
    mounted() {
        this.getRole();
    },
    destroyed() {},
    methods: {
        saveRole() {
            const self = this;
            self.$validator.validateAll().then(result => {
                if (result) {
                    const id = self.$route.params.id;
                    roles.update_permission(
                        id,
                        self.model,
                        data => {
                            Notify.success('Updated Successfully.');
                            self.$router.push({ path: '/admin/permissions' });
                            self.model = {};
                            self.errors.items = [];
                        },
                        err => {
                            self.$setErrorsFromResponse(err.response.data);
                            Notify.error(err.response.data.message);
                        }
                    );
                }
            });
        },
        getRole() {
            const self = this;
            const id = self.$route.params.id;
            if (id) {
                roles.get_permission(
                    id,
                    data => {
                        self.model = data;
                        self.$nextTick(() => {
                            self.$validator.reset();
                        });
                    },
                    err => {
                        Notify.error(err.response.data.message);
                        self.$router.push({ path: '/admin/permissions_all' });
                    }
                );
            } else {
                Notify.error('Record Not Found');
                self.$router.push({ path: '/admin/roles_all' });
            }
        },
    },
};
</script>

<style type="text/css" scoped lang="scss"></style>
