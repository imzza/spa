<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <p>Add Record</p>
                <form @submit.prevent="onSubmit">
                    <div class="form-group">
                        <label for="email" class="control-label">Email:</label>
                        <input type="text" name="email" v-model="model.email" class="form-control form-control-lg" v-validate="'required|email'" :class="{ 'is-invalid': errors.has('email') }" />
                        <span v-if="errors.has('email')" class="help text-danger">{{ errors.first('email') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">Password:</label>
                        <input id="password" type="password" v-validate="'required|min:3'" name="password" v-model="model.password" class="form-control form-control-lg" :class="{ 'is-invalid': errors.has('password') }" />
                        <span v-if="errors.has('password')" class="help text-danger">{{ errors.first('password') }}</span>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control form-control-lg" id="first_name" data-vv-as="First Name" v-model="model.first_name" name="first_name" v-validate="'required'" placeholder="First Name" :class="{ 'is-invalid': errors.has('first_name') }" />
                            <span v-if="errors.has('first_name')" class="help text-danger">{{ errors.first('first_name') }}</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="last_name">last Name</label>
                            <input type="text" class="form-control form-control-lg" id="last_name" data-vv-as="Last Name" v-model="model.last_name" name="last_name" v-validate="'required'" placeholder="Last Name" :class="{ 'is-invalid': errors.has('last_name') }" />
                            <span v-if="errors.has('last_name')" class="help text-danger">{{ errors.first('last_name') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input id="address" type="text" class="form-control form-control-lg" v-model="model.address" name="address" v-validate="'required'" placeholder="1234 Main St" :class="{ 'is-invalid': errors.has('address') }" />
                        <span v-if="errors.has('address')" class="help text-danger">{{ errors.first('address') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="address2">Address 2</label>
                        <input type="text" id="address2" class="form-control form-control-lg" v-model="model.address2" name="address2" placeholder="" :class="{ 'is-invalid': errors.has('address2') }" />
                        <span v-if="errors.has('address2')" class="help text-danger">{{ errors.first('address2') }}</span>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="city">City</label>
                            <input id="city" type="text" v-model="model.city" class="form-control form-control-lg" v-validate="'required'" name="city" :class="{ 'is-invalid': errors.has('city') }" />
                            <span v-if="errors.has('city')" class="help text-danger">{{ errors.first('city') }}</span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="state">State</label>
                            <select id="state" v-model="model.state" class="form-control form-control-lg" v-validate="'required'" name="state" :class="{ 'is-invalid': errors.has('state') }">
                                <option v-for="(st, ind) in states" :key="st.value" :value="st.value">
                                    {{ st.name }}
                                </option>
                            </select>
                            <span v-if="errors.has('state')" class="help text-danger">{{ errors.first('state') }}</span>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="zip">Zip</label>
                            <input id="zip" type="text" v-model="model.zip" class="form-control form-control-lg" v-validate="'required'" name="zip" :class="{ 'is-invalid': errors.has('zip') }" />
                            <span v-if="errors.has('zip')" class="help text-danger">{{ errors.first('zip') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <!-- <label for="chk"></label> -->
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" id="offers" class="custom-control-input" v-model="model.offers" name="offers" :true-value="1" />
                            <label class="custom-control-label" for="offers">Send Me offers</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <div class="custom-control custom-radio">
                            <input id="male" type="radio" name="gender" v-model="model.gender" class="custom-control-input" v-validate="'required'" :value="'male'" />
                            <label class="custom-control-label" for="male">Male</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="female" type="radio" v-model="model.gender" name="gender" v-validate="'required'" class="custom-control-input" :value="'female'" />
                            <label class="custom-control-label" for="female">Female</label>
                        </div>
                        <span v-if="errors.has('gender')" class="help text-danger">{{ errors.first('gender') }}</span>
                    </div>
                    <div v-if="model.image != ''" class="image-preview">
                        <img :src="model.image" alt="prfileimage" class="img-thumbnail" height="200px" width="200px" />
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Profile Image</label>
                        <input v-validate="'required|mimes:image/*'" type="file" class="form-control-file form-control form-control-lg" name="image" data-vv-name="image" data-vv-as="image" :class="{ 'is-invalid': errors.has('image') }" @change="readFile($event)" />
                        <span v-if="errors.has('image')" class="help text-danger">{{ errors.first('image') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="about">Example textarea</label>
                        <textarea id="about" class="form-control form-control-lg" v-model="model.about" name="about" v-validate="'required|min:100'" rows="4" :class="{ 'is-invalid': errors.has('about') }" />
                        <span v-if="errors.has('about')" class="help text-danger">{{ errors.first('about') }}</span>
                    </div>
                    <div class="form-group">
                        <v-button :loading="busy">
                            Submit
                        </v-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import User from '~/api/user';
import Vue from 'vue';
import VeeValidate from 'vee-validate';
// Vue.use(VeeValidate);

Vue.use(VeeValidate, { fieldsBagName: 'formFields' });

export default {
    name: 'Add',

    data() {
        return {
            busy: false,
            states: [
                { name: 'Choose...', value: '' },
                { name: 'Los Angles', value: 'LA' },
                { name: 'New Yark', value: 'NY' },
                { name: 'Paris', value: 'PA' },
            ],
            model: {
                image: '',
            },
            bimage: '',
        };
    },
    mounted() {
        // User.all(data => {
        //     console.log(data);
        // }, err =>{
        //     console.log(err);
        // });
    },
    methods: {
        readFile(e) {
            const files = e.target.files || e.dataTransfer.files;
            if (!files.length) {
                return;
            }
            this.createImage(files[0]);
            this.bimage = files[0];
        },
        createImage(file) {
            const reader = new FileReader();
            let vm = this;
            reader.onload = e => {
                vm.model.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },

        onSubmit() {
            const self = this;
            self.$validator.validateAll().then(result => {
                if (result) {
                    self.busy = true;
                    console.log(self.model);
                    User.save(
                        self.model,
                        data => {
                            self.busy = false;
                            self.$router.push({ name: 'students_all' });
                            Notify.success('Oh Yes Scuuess ...');
                        },
                        err => {
                            self.busy = false;
                            console.log(err);
                            this.$setErrorsFromResponse(err);
                        }
                    );
                }
            });
        },
    },
};
</script>
<style lang="css" scoped></style>
