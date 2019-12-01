<template>
    <div class="d-flex mainWrap">
        <preloader v-show="this.$store.state.preloader" />
        <div class="flex-left">
            <left_side v-show="this.$store.state.left_open" />
        </div>
        <div class="flex-right d-flex">
            <vueadmin_header />
            <right_side>
                <router-view />
            </right_side>
        </div>
    </div>
</template>
<script>
import Vue from 'vue';

import preloader from 'components/layouts/preloader/preloader';
import right_side from 'components/layouts/right-side';
import left_side from 'components/layouts/left-side/default/left-side';
import vueadmin_header from 'components/layouts/header/fixed-header';
import 'assets/sass/global.scss';

export default {
    name: 'Layout',
    components: {
        preloader,
        vueadmin_header,
        left_side,
        right_side,
    },
    data() {
        return {
            showtopbtn: false,
        };
    },
    mounted() {
        if (window.innerWidth <= 992) {
            this.$store.commit('left_menu', 'close');
        }
    },
};
</script>
<style lang="scss" scoped>
.mainWrap {
    height: 100vh;
    overflow: auto;
    .flex-right {
        flex: auto;
        flex-direction: column;
    }
    .flex-left {
        width: 300px;
        background-color: #769995;
        height: 100%;
        overflow: auto;
    }
}

::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
    border-radius: 10px;
    background-color: #f5f5f5;
}

::-webkit-scrollbar {
    width: 12px;
    background-color: #f5f5f5;
}

::-webkit-scrollbar-thumb {
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
    background-color: #555;
}
</style>
