<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="page-content mb-4">
            <div v-if="isEmp">
                <b-card tag="article">
                    <div class="row">
                        <div class="container">
                            <p>Student Dashboard</p>
                        </div>
                    </div>
                </b-card>
            </div>
            <div v-else>
                <b-card tag="article">
                    <div class="row">
                        <div class="container">
                            <p>Admin Dashboard</p>
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
    name: 'index',
    components: { Dashboard },
    data() {
        return {
            msg: '',
        };
    },
    computed: {
        isEmp() {
            return this.$store.getters.roles.includes('EE');
        },
    },
    created() {},
    mounted() {},
    destroyed: function() {},
    methods: {
        test() {
            console.log('Test');
        },
    },
};
</script>
<style type="text/css" scoped lang="scss"></style>
