<template>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-aside sidebar-offcanvas">
        <!-- sidebar: style can be found in sidebar-->
        <section class="sidebar">
            <div id="menu" role="navigation">
                <template>
                    <div class="vuemenu navigation">
                        <div class="site-logo">
                            <img src="~img/logo.webp" class="logo" />
                        </div>
                        <ul>
                            <template v-for="item in menuitems">
                                <li v-if="item.name && !item.child && has_permission(item.url)">
                                    <router-link :to="item.link" exact>
                                        <i :class="item.icon"></i>
                                        {{ item.name }}
                                    </router-link>
                                </li>
                                <li v-if="item.child && has_permission(item.url)"
                                    :title="item.name"
                                    :icon="item.icon":class="{'router-link-parent-active': subIsActive(item.child ) }"> 
                                    
                                    <b-btn block href="#"v-b-toggle="item.name"variant="link">
                                        <i :class="item.icon"></i>
                                        {{ item.name }}
                                        <span class="submenu_icon float-right">
                                            <i class="fa fa-angle-right"></i>
                                        </span>
                                    </b-btn>

                                    <span v-for="child in item.child">
                                        <span v-if="has_permission(child.url) == true">
                                            <div class="with-child">
                                                <b-collapse  :id="item.name"v-if="subIsActive(item.child) == true"accordion="my-accordion"role="tabpanel">
                                                    <div class="inner_menue">
                                                        <router-link :to="child.link"exact >
                                                            <i :class="child.icon"></i>
                                                            {{ child.name }}
                                                        </router-link>
                                                    </div>
                                                </b-collapse>
                                                <b-collapse :id="item.name"v-else accordion="my-accordion"role="tabpanel">
                                                    <div class="inner_menue">
                                                        <router-link :to="child.link"exact >
                                                            <i :class="child.icon"></i>
                                                            {{ child.name }}
                                                        </router-link>
                                                    </div>
                                                </b-collapse>
                                            </div>
                                        </span>
                                    </span>
                                </li>
                            </template>
                        </ul>
                    </div>
                </template>
            </div>
            <!-- menu -->
        </section>
        <!-- /.sidebar -->
    </aside>
</template>
<script>

import menu_items from "../../../../menu.js";
export default {
  name: "left-side",
  components: {
  },
  data() {
    return {
      menuitems: menu_items
    };
  },
  mounted(){
        // this.has_permission('dashboard');

      // if(this.$store.state.permissions.length == 0){
      //   this.$store.dispatch('permissions');
      // }

       this.$on("closeall", (index) => {
            this.openByIndex(index);
      })
  },
  methods: {

    has_permission(url) {
        let self = this;
        let perms = self.$store.state.permissions;
        
        if (perms.includes(url)) {
            return true;
        }else{
            return false;
        }

        return perms.includes(url);
    },
    subIsActive(input) {
      const paths = Array.isArray(input) ? input : [input];
      return paths.some(path => {
        if ("/admin/" + path.url == this.$route.path) {
          return true;
          //alert(path.url +' => /admin/'+path.url);
        }

        //return this.$route.path.indexOf('/admin/'+path.url) === 0 // current path starts with this path string
      });
    },
    openByIndex(index) {
            this.$collapseItems.forEach((item, i) => {
                if (i !== index) {
                    item.isActived = false
                }
            })
        }
  },
  computed: {
        $collapseItems() {
            return this.$children.filter(child => child._isCollapseItem)
        }
    },

};
</script>
<style scoped lang="scss">
.left-aside {
    width: 100%;
    background-color: transparent;
    height: 100%;
    .vuemenu {
        text-align: center;
        img.logo {
            width: 147px;
            height: 147px;
        }
        .site-logo {
            padding: 30px 0;
        }
    }
    ul {
        margin: 0;
        list-style-type: none;
        padding: 0;
        li {
            a {
                color: #fff;
                font-size: 17px;
                text-transform: uppercase;
                width: 100%;
                display: block;
                padding: 28px 16px;
                font-weight: 400;
                text-decoration: none;
                border-bottom: 1px solid #8eb4b0;
                &.router-link-exact-active {
                    background-color: #fff;
                    color: #2e2e2e;
                    font-weight: bold;
                }
            }
            ul {
                background-color: #629892;
                li {
                    .collapse.show {
                    border-top: 1px solid #8eb4b0;
                }
                }
            }
        }
    }
}
</style>
