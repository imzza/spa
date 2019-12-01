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
                                    <th>Permission</th>
                                    <th>Display Name</th>
                                    <th>Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(permission, ind) in permissions" v-if="permissions.length > 0" :key="permission.id">
                                    <td>{{ permission.id }}</td>
                                    <td>{{ permission.name }}</td>
                                    <td>{{ permission.key }}</td>
                                    <td>{{ permission.type }}</td>
                                    <td>
                                        <router-link
                                            class="btn btn-sm btn-info"
                                            :to="{
                                                name: 'permission_edit',
                                                params: { id: permission.id },
                                            }"
                                        >
                                            Edit
                                        </router-link>
                                        <button class="btn btn-sm btn-danger" @click="deletePermission(permission)">
                                            Delete
                                        </button>
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
    name: 'permissions',
    components: {},
    data() {
        return {
            msg: '',
            permissions: [],
        };
    },
    mounted() {
        this.viewPermissions();
    },
    destroyed() {},
    methods: {
        viewPermissions() {
            const self = this;
            roles.view_permissions(
                data => {
                    self.permissions = data;
                    Notify.success('');
                },
                err => {
                    Notify.error(err.response.data.message);
                }
            );
        },
        deletePermission(permission) {
            const self = this;
            Notify.confirm().then(r => {
                roles.delete_permission(
                    permission.id,
                    data => {
                        Notify.success('Deleted Successfully');
                        self.permissions.splice(self.permissions.indexOf(permission), 1);
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
