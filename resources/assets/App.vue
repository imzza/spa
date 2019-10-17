<template>
  <div id="app">
    <router-view/>
  </div>
</template>
<script>
import Vue from "vue";
import BootstrapVue from "bootstrap-vue";
import store from "./store/store.js";
Vue.use(BootstrapVue);

export default {
  name: "mian",
  data() {
    return {
      model: {
       
      }
    };
  },

  created() {
    let self = this;
    // if (store.state.token) {
      self.test();
      console.log('Called');
    // }
  },
  computed: {
  },
  mounted() {
  },
  methods: {
    async test(){
       try{
           let { data, status } =  await axios.get(API_URL + "/permissions");
            console.log('Data', data);
            store.commit('set_perms', data);
            store.commit('set_user', data.me);
        }catch(error) {
              console.log(error);
        };
    }
  }
};
</script>
<style lang="scss" src="assets/sass/bootstrap/bootstrap.scss"></style>
<style src="font-awesome/css/font-awesome.css"></style>
<style src="bootstrap-vue/dist/bootstrap-vue.css"></style>