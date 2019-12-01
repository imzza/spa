<template>
    <div class="row justify-content-lg-center">
        <div class="col-10">
            <div class="card mt-5">
                <div class="card-body">
                    <h2 class="card-title text-center">
                        Employee Profile
                    </h2>
                    <div class="row justify-content-center">
                        <div class="col-10">
                            <form @submit.prevent="createProfile">
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input v-model="model.email" v-validate="'required|email'" type="email" class="form-control form-control-lg" name="email" placeholder="Enter email" />
                                    <span v-show="errors.has('email')" class="help is-danger">{{ errors.first('email') }}</span>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" ref="password" v-model="model.password" v-validate="'required|min:6'" type="password" class="form-control form-control-lg" name="password" placeholder="Password" />
                                    <span v-show="errors.has('password')" class="help is-danger">{{ errors.first('password') }}</span>
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">Password Confirmation</label>
                                    <input id="password_confirmation" v-model="model.password_confirmation" v-validate="'required|confirmed:password'" type="password" class="form-control form-control-lg" name="password_confirmation" placeholder="Confirm Password" data-vv-as="Confirm Password" />
                                    <span v-show="errors.has('password_confirmation')" class="help is-danger">{{ errors.first('password_confirmation') }}</span>
                                </div>

                                <button type="submit" class="btn btn-lg btn-primary float-right">
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Vue from 'vue';
import VeeValidate from 'vee-validate';

import employees from '~/api/employees.js';
Vue.use(VeeValidate);

export default {
    name: 'create_profile',
    data() {
        return {
            is_submit_disable: false,
            code: '',
            model: {
                email: '',
            },
        };
    },
    created() {
        if (!this.$route.query.code || this.$route.query.code == '') {
            Notify.error('Emial code is missing');
            this.$router.push({ path: '/admin' });
        }
    },
    mounted() {
        const self = this;
        self.code = self.$route.query.code;
        if (self.code != '') {
            employees.verify_code(
                self.code,
                data => {
                    self.model.email = data;
                },
                err => {
                    // console.log(err);
                    Notify.error(err.response.data.message);
                }
            );
        } else {
            Notify.error('Url is invalid');
        }
    },
    destroyed() {},
    methods: {
        createProfile() {
            const self = this;
            self.$validator.validateAll().then(result => {
                if (result) {
                    const pdata = { ...self.model, ...{ code: self.code } };
                    employees.create_profile(
                        pdata,
                        data => {
                            Notify.success('Profile created successfully.');
                            self.model = {};
                            self.$router.push({ path: '/admin' });
                        },
                        err => {
                            self.$setErrorsFromResponse(err.response.data);
                            Notify.error(err.response.data.message);
                        }
                    );
                }
            });
        },
    },
};
</script>

<style lang="scss" scoped></style>
