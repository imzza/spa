<template>
  <div>
    
    <!-- Content Header (Page header) -->
    <section class="page-content mb-4">

      <Dashboard v-if="isEmp"></Dashboard>
      
      <div v-else>
        <b-card tag="article">
          <div class="row">
            <div class="container">
              <p>Not a Employee</p>
            </div>
          </div>
        </b-card>
      </div>
    </section>
  </div>
</template>
<script>


// import Vue from "vue";

import Dashboard from '~/components/admin/employees/dashboard';

export default {
  name: "index",
  components: {Dashboard},
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
  computed: {
    isEmp(){
      return this.$store.getters.roles.includes('EE');
    }
  },
  destroyed: function() {}
};
</script>

<style type="text/css" scoped  lang="scss">
</style>
