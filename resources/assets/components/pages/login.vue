<template>
  <section class="login-block">
    <div class="container">
      <div class="row">
        
        <div class="col-md-4 login-sec">
          <h2 class="text-center">Login Now</h2>
            <form class="login-form" @submit.prevent="onSubmit">
                <div class="form-group">
                  <label for="username" class="text-uppercase">Email address</label>
                  <input type="email" class="form-control" name="username" data-vv-as="email" v-model="form.username" id="username" placeholder="Enter email" v-validate="'required|email'">
                   <span v-show="errors.has('username')" class="help text-danger">{{ errors.first('username') }}</span>

                </div>
                <div class="form-group">
                  <label for="password" class="text-uppercase">Password</label>
                  <input type="password" class="form-control"  name="password" v-model="form.password" id="password" placeholder="Password" v-validate="'required'">
                  <span v-show="errors.has('password')" class="help text-danger">{{ errors.first('password') }}</span>
                </div>


                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input">
                    <small>Remember Me</small>
                  </label>
                  <!-- <button type="submit" class="btn btn-login float-right">Submit</button> -->
                  <v-button class="btn btn-login float-right" :loading="busy">Submit</v-button>
                </div>
            </form>
          <div class="copy-text">Created with <i class="fa fa-heart"></i> by Grafreez</div>
        </div>
        
        <div class="col-md-8 banner-sec">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
               <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
              </ol>

              <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                  <img class="d-block img-fluid" src="https://static.pexels.com/photos/33972/pexels-photo.jpg" alt="First slide">
                  <div class="carousel-caption d-none d-md-block">
                    <div class="banner-text">
                      <h2>This is Heaven</h2>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                    </div>  
                  </div>
                </div>
              </div>
        </div>
      </div>

    </div>
</div>
  </section>
</template>
<script>
import Vue from "vue";
import VeeValidate from "vee-validate";
Vue.use(VeeValidate); //,{enableAutoClasses: true }

export default {
  name: "login",

  data: () => ({
    busy: false,
    form: {
      username: "",
      password: ""
    }
  }),
  methods: {
    async onSubmit() {
      let self = this
      let res = await self.$validator.validateAll();
      if(res){
        self.busy = true;
        try {
          let resp = await axios.post(this.$store.state.baseUrl+'/api/login', self.form);
          console.log(resp);
          let token = resp.data.access_token;
          self.$store.commit('SAVE_TOKEN',  {token: token, remember: false});
          this.$store.dispatch('permissions');
          self.busy = false;
          self.$router.push({path: 'admin/dashboard'});
        } catch (e) {  console.log(e.response.data); }
      }
    }
  },
  mounted() {

  },
  destroyed() {

  },

}
</script>

<style lang="scss" scoped>
.login-block{
    background: #DE6262;  /* fallback for old browsers */
background: -webkit-linear-gradient(to bottom, #FFB88C, #DE6262);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to bottom, #FFB88C, #DE6262); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
float:left;
width:100%;
padding : 50px 0;
}
.banner-sec{background:url(https://static.pexels.com/photos/33972/pexels-photo.jpg)  no-repeat left bottom; background-size:cover; min-height:500px; border-radius: 0 10px 10px 0; padding:0;}
.container{background:#fff; border-radius: 10px; box-shadow:15px 20px 0px rgba(0,0,0,0.1);}
.carousel-inner{border-radius:0 10px 10px 0;}
.carousel-caption{text-align:left; left:5%;}
.login-sec{padding: 50px 30px; position:relative;}
.login-sec .copy-text{position:absolute; width:80%; bottom:20px; font-size:13px; text-align:center;}
.login-sec .copy-text i{color:#FEB58A;}
.login-sec .copy-text a{color:#E36262;}
.login-sec h2{margin-bottom:30px; font-weight:800; font-size:30px; color: #DE6262;}
.login-sec h2:after{content:" "; width:100px; height:5px; background:#FEB58A; display:block; margin-top:20px; border-radius:3px; margin-left:auto;margin-right:auto}
.btn-login{background: #DE6262; color:#fff; font-weight:600;}
.banner-text{width:70%; position:absolute; bottom:40px; padding-left:20px;}
.banner-text h2{color:#fff; font-weight:600;}
.banner-text h2:after{content:" "; width:100px; height:5px; background:#FFF; display:block; margin-top:20px; border-radius:3px;}
.banner-text p{color:#fff;}
</style>