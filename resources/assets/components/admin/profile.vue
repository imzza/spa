<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header mb-4">
            <div class="container bootstrap snippet">
                <h1 class="text-primary"><span class="glyphicon glyphicon-user" />Edit Profile</h1>
                <hr />
                <div class="row">
                    <!-- left column -->

                    <!-- edit form column -->
                    <div class="col-md-9  personal-info">
                        <h3>Personal info</h3>

                        <form <form class="form-horizontal" role="form" @submit.prevent="updateUser">
                            <div class="col-md-3">
                                <div class="file-upload-form center">
                                    Upload an image file:
                                    <input type="file" accept="image/*" name="image" @change="previewImage" id="image" />
                                </div>
                                <div class="image-preview">
                                    <img class="preview" :src="imageData" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Name:</label>
                                <div class="col-lg-8">
                                    <input class="form-control" id="name" type="text" v-model="model.name" name="name" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">First name:</label>
                                <div class="col-lg-8">
                                    <input v-model="model.first_name" class="form-control" type="text" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Last name:</label>
                                <div class="col-lg-8">
                                    <input class="form-control" id="last_name" type="text" v-model="model.last_name" name="last_name" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Email:</label>
                                <div class="col-lg-8">
                                    <span v-show="errors.has('email')" class="help is-danger">{{ errors.first('email') }}</span>
                                    <input class="form-control" id="email" type="text" v-model="model.email" name="email" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Phone No:</label>
                                <div class="col-lg-8">
                                    <input class="form-control" id="phone_no" type="text" v-model="model.phone_no" name="phone_no" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Current Password:</label>
                                <div class="col-lg-8">
                                    <input class="form-control" id="current_password" type="password" v-model="model.current_password" name="current_password" />
                                    <span v-show="errors.has('current_password')" class="help is-danger">{{ errors.first('current_password') }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">New Password:</label>
                                <div class="col-lg-8">
                                    <input class="form-control" id="password" type="password" v-model="model.password" name="password" data-vv-as="Profile password" />
                                    <span v-show="errors.has('password')" class="help is-danger">{{ errors.first('password') }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Re Enter Password:</label>
                                <div class="col-lg-8">
                                    <input class="form-control" id="password_confirmation" type="password" v-model="model.password_confirmation" name="password_confirmation" />
                                    <span v-show="errors.has('password_confirmation')" class="help is-danger">{{ errors.first('password_confirmation') }}</span>
                                </div>
                            </div>
                            <div class="col-sm-offset-6 col-sm-6">
                                <button type="submit" class="btn btn-secondary">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <hr />
        </section>
    </div>
</template>

<script>
import Vue from 'vue';
import VeeValidate from 'vee-validate'; // events: '', , { enableAutoClasses: true }

import DatePicker from 'vue2-datepicker';
import users from "~/api/users.js";
Vue.use(VeeValidate)

var moment = require('moment');
export default {
  name: "profile",
  components: { DatePicker },
  data() {
    return {
      msg: "",
      users: [],
      model: {
        current_password: "",
        password: "",
        password_confirmation: ""
      },
      imageData: "",
      image: ""
    }
  },
  mounted() {
    this.getUser();
  },
  destroyed () {},
  methods: {
    updateUser () {
      const data = new FormData()
      // alert('hihi');
      // console.log(this.image);
      data.append("image", this.image);
      data.append("name", this.model.name);
      data.append("first_name", this.model.first_name);
      data.append("last_name", this.model.last_name);
      data.append("email", this.model.email);
      data.append("phone_no", this.model.phone_no);
      data.append("current_password", this.model.current_password);
      data.append("password", this.model.password);
      data.append("password_confirmation", this.model.password_confirmation);
      const settings = { headers: { "content-type": "multipart/form-data" } };
      axios.post(API_URL + "/profile", data, settings).then(
        response => {
        Notify.success('Updated Successfully.');
        // alert('hihi');
        // console.log(response);
        },
        err => {
          this.$setErrorsFromResponse(err.response.data)
        Notify.error(err.response.data.message)
          // console.log('Rdata', err.response.data);
          // console.log('Data', err.data);
        }
      );

      //   let self = this
      //   self.$validator.validateAll().then(result => {
      //       if (result) {
      //         axios.post(API_URL+'/profile', data, settings).then(response => {
      //   alert('hihi');
      //   console.log(response);
      // });
      //     let id = self.$route.params.id;
      //     users.update(self.model, data => {
      //         Notify.success('Updated Successfully.');
      //         // self.$router.push({path: '/admin/profile'});
      //         // self.model = {};
      //         self.errors.items = [];
      //     }, err => {
      //         self.$setErrorsFromResponse(err.response.data);
      //        Notify.error(err.response.data.message);
      //         // console.log('Rdata', err.response.data);
      //         // console.log('Data', err.data);
      //     });
      // }
      // });
    },
    getUser () {
      const self = this;

      users.get_single(
        data => {
          console.log(data)
        self.model = data
          self.imageData = self.model.image;

        self.$nextTick(() => {
            self.$validator.reset()
        })
        },
        err => {
        Notify.error(err.response.data.message)
        self.$router.push({ path: '/admin/profile' })
        }
    },
    previewImage: function (event) {
      // Reference to the DOM input element
      var input = event.target
      // Ensure that you have a file before attempting to read it
      if (input.files && input.files[0]) {
        // create a new FileReader to read this image and convert to base64 format
        this.image = input.files[0]
        var reader = new FileReader();
        // Define a callback function to run, when FileReader finishes its job
        reader.onload = e => {
          // Note: arrow function used here, so that "this.imageData" refers to the imageData of Vue component
          // Read image as base64 and set to imageData
          this.imageData = e.target.result
        }
        // Start the reader job - read file as a data url (base64 format)
        reader.readAsDataURL(input.files[0])
      }
    }
  }
};
</script>

<style type="text/css" scoped lang="scss">

body{margin-top:20px;}
}

.file-upload-form,
.image-preview {
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  padding: 20px;
}
img.preview {
  width: 200px;
  background-color: white;
  border: 1px solid #ddd;
  padding: 5px;
}
</style>

<!-- // import Vue from "vue";
// var moment = require("moment");

export default {
	name: "profile",
	components: {},
	data() {
		return {
			msg: ""
		};
	},
	created() {},
	mounted() {},
	methods: {
		test() {
			console.log("Test");
		}
	},
	destroyed: function() {}
}; -->
