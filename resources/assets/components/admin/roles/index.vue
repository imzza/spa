<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header mb-4">
            <b-card tag="article" class="mb-2">
                <!--  <div class="row justify-content-end">
                    <div class="col-2">
                        <router-link class="btn btn-primary mb-1" :to="{path: '/admin/role_add' }">Add</router-link>
                    </div>
                </div> -->
                <div class="row">
                    <div class="col">
                        <table class="table table-inverse">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Role</th>
                                    <th>Display Name</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(role, ind) in roles" v-if="roles.length > 0" :key="role.id">
                                    >
                                    <td>{{ role.id }}</td>
                                    <td>{{ role.name }}</td>
                                    <td>{{ role.rolename }}</td>
                                    <td>{{ role.role_descrip }}</td>
                                    <td>
                                        <router-link class="btn btn-sm btn-info" :to="{ name: 'role_edit', params: { id: role.id } }">
                                            Edit
                                        </router-link>
                                        <button class="btn btn-sm btn-danger" @click="deleteRole(role)">
                                            Delete
                                        </button>
                                        <router-link
                                            class="btn btn-sm btn-info"
                                            :to="{
                                                name: 'permissions_assign',
                                                params: { id: role.id },
                                            }"
                                        >
                                            Permissions
                                        </router-link>
                                    </td>
                                </tr>
                                <tr v-else>
                                    <div class="alert alert-warning text-center" role="alert">
                                        No Records Found
                                    </div>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </b-card>
        </section>
    </div>
</template>
<script>
import Vue from 'vue';
import roles from '~/api/roles.js';
// var moment = require("moment");

export default {
    name: 'roles',
    components: {},
    data() {
        return {
            msg: '',
            roles: [],
        };
    },
    mounted() {
        this.viewRoles();
    },
    destroyed() {},
    methods: {
        viewRoles() {
            const self = this;
            roles.view_roles(
                data => {
                    self.roles = data;
                    Notify.success('');
                },
                err => {
                    Notify.error(err.response.data.message);
                }
            );
        },
        deleteRole(role) {
            const self = this;
            Notify.confirm().then(r => {
                roles.delete_role(
                    role.id,
                    data => {
                        Notify.success('Deleted Successfully');
                        self.roles.splice(self.roles.indexOf(role), 1);
                    },
                    err => {
                        Notify.error(err.response.data.message);
                    }
                );
            });
        },
    },
};
</script>

<style type="text/css" scoped lang="scss"></style>
