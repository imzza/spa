<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header mb-4">
            <b-card tag="article" class="mb-2">
                <div class="row">
                    <div class="col">
                        <!--   <div class="field">
                            <label>Per Page:</label>
                            <select class="ui simple dropdown" v-model="perPage">
                                <option value=10>10</option>
                                <option value=15>15</option>
                                <option value=20>20</option>
                                <option value=25>25</option>
                            </select>
                        </div> -->
                        <div class="vuetable-wrapper">
                            <!--Wrapper Element -->
                            <div class="loader">
                                LOADING
                            </div>
                            <!--Your Loading Message -->
                            <vuetable ref="vuetable" api-url="/api/v1/employees" pagination-path="" :fields="fields" :css="css" :sort-order="sortOrder" :per-page="perPage" :http-fetch="myFetch" wrapper-class="vuetable-wrapper" @vuetable:pagination-data="onPaginationData">
                                <!-- slot-scoped slots https://vuejs.org/v2/guide/components.html#slot-scoped-Slots -->
                                <template slot="actions" slot-scope="props">
                                    <div class="custom-actions">
                                        <button class="btn btn-default btn-sm" @click="onAction('edit-item', props.rowData, props.rowIndex)">
                                            Edit
                                        </button>
                                        <button class="btn btn-info btn-sm" @click="onAction('assign-roles', props.rowData, props.rowIndex)">
                                            Roles
                                        </button>
                                        <button class="btn btn-danger btn-sm" @click="onAction('delete-item', props.rowData, props.rowIndex)">
                                            " > Delete
                                        </button>
                                    </div>
                                </template>
                            </vuetable>
                        </div>
                        <!-- Wrapper End -->
                        <div class="vuetable-footer">
                            <!-- <button class="btn btn-info footer-button" @click="onGroupAction()">Group action</button> -->
                            <!-- <vuetable-pagination-dropdown ref="paginationDropdown"></vuetable-pagination-dropdown> -->

                            <vuetable-pagination-info ref="paginationInfo" />

                            <vuetable-pagination ref="pagination" :css="paginationCss" @vuetable-pagination:change-page="onChangePage" />
                        </div>
                    </div>
                </div>
            </b-card>
        </section>

        <b-modal id="rolesMdl" ref="rolesMdl" title="BootstrapVue" hide-header hide-footer>
            <form @submit.prevent="assignRole">
                <div class="form-group">
                    <h3>Assign Roles</h3>
                    <div v-for="role in roles" :key="role.id">
                        <li>
                            <input v-model="emp_roles" :id="role.id" type="checkbox" :value="role.name" :true-value="role.name" /><label :for="role.id">{{ role.name }}</label>
                        </li>
                    </div>
                    <!-- <multiselect
                      v-model="emp_roles"
                      :options="roles"
                      :close-on-select="false"
                      :show-labels="true"
                      >
                    </multiselect> -->
                </div>
                <input v-model="eid" type="hidden" />
                <div class="form-group">
                    <button type="submit">
                        Submit
                    </button>
                </div>
            </form>
        </b-modal>
    </div>
</template>
<script>
import Vue from "vue";
import Vuetable from 'vuetable-2/src/components/Vuetable';
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination';
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo';
import VueTablePaginationDropdown from 'vuetable-2/src/components/VueTablePaginationDropdown';
import BootstrapStyle from '../../bootstrap-css.js';

import Multiselect from "vue-multiselect";

import employees from '~/api/employees.js';
var moment = require("moment");

export default {
  name: "employees",
  components: {
    Multiselect,
    Vuetable,
    VuetablePagination,
    VuetablePaginationInfo,
    VueTablePaginationDropdown
  },
  data() {
    return {
      msg: "",
      employees: [],
      roles: [],
      emp_roles: [],
      eid: null,
      css: BootstrapStyle,
      perPage: 10,
      filterText: "",
      paginationCss: {
        wrapperClass: "pagination",
        activeClass: "btn-primary",
        disabledClass: "disabled",
        pageClass: "btn btn-border",
        linkClass: "btn btn-border",
        icons: {
          first: "",
          prev: "",
          next: "",
          last: ""
        }
      },

      fields: [
        {
          name: "__sequence",
          title: "#",
          titleClass: "text-center",
          dataClass: "text-right"
        },

        {
          name: "eeName",
          title: "Full Name",
          titleClass: "text-center",
          dataClass: "text-left",
          sortField: "eeName"
        },
        {
          name: "email1",
          title: "Email",
          titleClass: "text-center",
          dataClass: "text-left",
          sortField: "email1"
        },
        // {
        //     name: 'user.roles.name',
        //     title: 'Roles',
        //     dataClass: 'text-left'
        // },
        // {
        //     name: 'salary',
        //     title: 'Salary',
        //     titleClass: 'text-center',
        //     dataClass: 'text-right',
        //     callback: 'formatNumber',
        //     sortField: 'salary'
        // },

        {
          name: "__slot:actions",
          title: "Actions",
          titleClass: "text-center",
          dataClass: "text-center"
        }
      ],

      sortOrder: [
        {
          field: "eeName",
          sortField: "eeName",
          direction: "asc"
        }
      ]
    };
  },
  watch: {
    perPage: function(val, oldVal) {
      this.moreParams.per_page = Number(event.target.value)
      Vue.nextTick(() => this.$refs.vuetable.refresh())
      // Vue.nextTick( () => this.$refs.vuetable.refresh())
    }
  },
  mounted () {
    // this.view();
  },
  destroyed () {},
  methods: {
    doFilter () {
      // this.$events.fire('filter-set', this.filterText)
    },
    resetFilter() {
      this.filterText = ""; // clear the text in text input
      // this.$events.fire('filter-reset')
    },
    onPaginationData(paginationData) {
      this.$refs.pagination.setPaginationData(paginationData);
      this.$refs.paginationInfo.setPaginationData(paginationData);
    },

    onChangePage(page) {
      this.$refs.vuetable.changePage(page);
    },
    myFetch(apiUrl, httpOptions) {
      return axios.get(apiUrl, httpOptions);
    },
    // Column formatting
    genderLabel(value) {
      return value.toUpperCase();
    },

    formatNumber(value) {
      return value.toFixed(2);
    },

    formatDate(value, fmt = "D MMM YYYY") {
      return value == null ? "" : moment(value, "YYYY-MM-DD").format(fmt);
    },

    // Row button action handler
    onAction(action, data, index) {
      if (action == "edit-item") {
        this.$router.push({
          name: "employees_edit",
          params: { id: data.weeid }
      }
      if (action == "delete-item") {
        this.deleteEmp(data);
      }

      if (action == "assign-roles") {
        if (data.user_id == null) {
          Notify.error("Employee perofile is not created Yet");
          return false
        }
        this.rolesMdl(data.user_id);
      }
    },
    rolesMdl(id) {
      if (id == 0) {
        Notify.error("User profile is not created.");
        return false
      }
      this.eid = id;
      axios.get(API_URL + '/get_user_role/' + id)
        .then(resp => {
          this.roles = resp.data.roles;
          this.emp_roles = resp.data.user_roles
          this.$refs.rolesMdl.show()
        }).catch(err => {
          console.log(err.response);
          Notify.error('You made a mistake')
        })
    },

    assignRole() {
      if (this.emp_roles.length == 0) {
        Notify.error("Please select atlease one role");
      }
      alert("This Is Called");
      axios.post(API_URL + '/assign_role/', { id: this.eid, roles: this.emp_roles })
        .then(resp => {
          Notify.success("Roles assigned successfully");
          this.roles = []
          this.emp_roles = []
          this.$refs.rolesMdl.hide()
        }).catch(err => {
          Notify.error(err.response.data.message);
        })
    },
    // End Pagination Objects
    view() {
      const self = this;
      employees.view(data => {
        self.employees = data;
        Notify.success('')
      },
      err => {
          Notify.error(err.response.data.message);
      }
      );
    },
    deleteEmp(emp) {
      const self = this;
      Notify.confirm().then(r => {
        employees.delete(
          emp.weeid,
          data => {
            Notify.success("Deleted Successfully");
          self.$refs.vuetable.refresh()
            // self.employees.splice(self.employees.indexOf(emp), 1);
        }, err => {
          Notify.error(err.response.data.message);
        })
      });
    }
  },
  events: {
    "vuetable:loading": function() {
      console.log('load started')
    },
    'vuetable:load-success': function(response) {
      console.log('load completed')
    }
  }
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style type="text/css" scoped lang="scss">
.vuetable-body > tr > td {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/*
     * Column width
     */
table.vuetable {
    width: 1140px;
    table-layout: fixed;
}

.vuetable-th-sequence {
    width: 35px;
}

.vuetable-th-checkbox-id {
    width: 25px;
}

.vuetable th#_name {
    width: 120px;
}

.vuetable th#_email {
    width: 120px;
}

.vuetable th#_birthday {
    width: 80px;
}

.vuetable th#_address {
    width: 200px;
}

.vuetable th#_gender {
    width: 80px;
}

.vuetable th#_salary {
    width: 130px;
}

.vuetable .vuetable-th-slot-actions {
    width: 120px;
}

/**
     * Footer
     */
.vuetable-footer {
    height: 40px;
    margin: 0 0 20px 0;
}
.vuetable-pagination-info,
.footer-button {
    float: left;
}
.vuetable-pagination-info {
    padding: 12px 25px;
    line-height: 14px;
}
.pagination {
    float: right;
    margin: 0;
}
.vuetable-footer:after {
    clear: both;
}

.vuetable-wrapper {
    position: relative;
    opacity: 1;
}
.loader {
    visibility: hidden;
    opacity: 0;
    transition: opacity 0.3s linear;
    // background: url('loader.gif') no-repeat bottom center;
    width: 200px;
    height: 30px;
    font-size: 1em;
    text-align: center;
    margin-left: -100px;
    letter-spacing: 4px;
    color: #3e97f6;
    position: absolute;
    top: 160px;
    left: 50%;
}
.loading .loader {
    visibility: visible;
    opacity: 1;
    z-index: 100;
}
.loading .vuetable {
    opacity: 0.3;
    filter: alpha(opacity=30); /* IE8 and earlier */
}
</style>
