<template>
    <header class="header">
        <b-navbar type="dark" variant="dark">
            <!-- <a href="javascript:void(0)" class="sidebar-toggle" @click="toggle_menu">
          <i class="fa fa-bars"></i>
      </a>-->
            <b-navbar-nav class="ml-auto">
                <b-nav-item-dropdown right>
                    <!-- Using 'button-content' slot -->
                    <template slot="button-content">
                        <div class="hasImg">
                            <div class="userImg">
                                <img v-if="$store.state.user" :src="this.$store.state.user.image" alt="img" />
                                <img v-else src="https://placeimg.com/640/480/any" />
                            </div>
                            <div v-if="$store.state.user" class="userName">
                                <em>{{ $store.state.user.name }}</em>
                                <p>{{ $store.getters.roles[0] }}</p>
                            </div>
                        </div>
                    </template>
                    <b-dropdown-item>
                        <router-link exact :to="{ path: '/admin/profile' }">
                            Profile
                        </router-link>
                    </b-dropdown-item>

                    <b-dropdown-item class="dropdown_content">
                        <router-link to exact class="drpodowtext" @click.native="logout"> <i class="fa fa-sign-out" /> Logout </router-link>
                    </b-dropdown-item>
                </b-nav-item-dropdown>
            </b-navbar-nav>
        </b-navbar>
    </header>
</template>
<script>
import Cookies from 'js-cookie';
// import { mapGetters } from 'vuex'

export default {
    name: 'vueadmin_header',
    computed: {
        // ...mapGetters({
        //   user: user
        // })
    },
    methods: {
        toggle_menu() {
            this.$store.commit('left_menu', 'toggle');
        },
        async logout() {
            const vm = this;
            vm.$store.commit('routeChange', 'start');
            try {
                const { status } = await axios.get(vm.$store.state.baseUrl + '/api/logout');
                vm.$store.commit('routeChange', 'end');
                if (status == 200) {
                    // Cookies.remove('token');
                    this.$store.commit('LOGOUT');
                    this.$router.push({ path: '/login' });
                }
            } catch (error) {
                console.log('error');
            }
        },
    },
};
</script>
<style lang="scss" scoped>
header.header {
    background-color: #fff;
    .hasImg {
        display: flex;
        align-items: center;
        .userImg {
            width: 46px;
            height: 46px;
            border-radius: 50px;
            background-color: #e5eaed;
            img {
                width: 100%;
                height: 100%;
                vertical-align: top;
            }
        }
        .userName {
            padding-left: 16px;
            p {
                margin: 0;
                font-weight: 400;
                font-size: 13px;
                color: #8a949f;
            }
            em {
                font-size: 14px;
                color: #475f79;
                font-weight: bold;
            }
        }
    }
    .navbar-light .navbar-nav .nav-link {
        color: #a6b4bd;
    }
    .navbar-nav {
        flex-direction: row;
        align-items: center;
        a:after {
            display: none;
        }
    }
}
li.nav-item.btn-logout a.nav-link {
    width: 22px;
}
</style>
