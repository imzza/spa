export default  [
    {
        path: '/',
        redirect: {path: '/login'},

    },
    {
        path: '/admin',
        component: resolve => require(['src/layout'], resolve),
        children: [
            {
                path: 'dashboard',
                component: resolve => require(['admin/index'], resolve),
                meta: {
                    title: "Dashboard",
                    isLoggedIn: true,
                }
            },
            {
                path: 'table',
                component: resolve => require(['admin/table/index'], resolve),
                meta: {
                    title: "Table",
                    isLoggedIn: true,
                }
            },
            //Employees Routes
            {
                path: 'employees_all/:cid?',
                component: resolve => require(['admin/employees/index'], resolve),
                props: (route) => ({ co: route.query.co },{login: route.query.login},{f: route.query.f}),
                name: 'employees_all',
                meta: {
                    title: "All Employees",
                    isLoggedIn: true,
                }
            },
            {
                path: 'employees_add/:cid?',
                component: resolve => require(['admin/employees/add'], resolve),
                name: 'employees_add',
                meta: {
                    title: "Add Employee",
                    isLoggedIn: true,
                }
            },
            {
                path: 'employees_edit/:id/:cid?',
                component: resolve => require(['admin/employees/edit'], resolve),
                name: 'employees_edit',
                meta: {
                    title: 'Edit Employee',
                    isLoggedIn: true
                }
            },

            {
                path: 'profile',
                component: resolve => require(['admin/profile'], resolve),
                meta: {
                    title: 'Profile',
                    isLoggedIn: true,
                }
            },
            // Roles and Permissions Route
            {
                path: 'roles_all',
                component: resolve => require(['admin/roles/index'], resolve),
                meta: {
                    title: "Roles",
                    isLoggedIn: true,
                }
            },
            
            {
                path: 'roles_add',
                component: resolve => require(['admin/roles/add'], resolve),
                meta: {
                    title: "Add Role",
                    isLoggedIn: true,
                }
            },

            {
                path: 'roles_edit/:id',
                name: 'role_edit',
                component: resolve => require(['admin/roles/edit'], resolve),
                meta: {
                    title: "Edit Role",
                    isLoggedIn: true,
                }
            },

            {
                path: 'permissions_assign/:id?',
                component: resolve => require(['admin/permissions/permissions_assign'], resolve),
                name: 'permissions_assign',
                meta: {
                    title: "Assign Permissions",
                    isLoggedIn: true,
                }
            },
        ]
    },
    
    {
        path: '/login',
        component: resolve => require(['pages/login'], resolve),
        meta: {
            title: "Login",
            isNotLoggedIn: true,
        }
    },

    {
        path: '/create_profile',
        component: resolve => require(['pages/create_profile'], resolve),
        props: (route) => ({ code: route.query.code }),
        meta: {
            title: "Create Profile",
            forSite: true,
        }
    },
    {
        path: '/no_access',
        component: resolve => require(['pages/403'], resolve),
        meta: {
            title: "403",
            isLoggedIn: true,
        }
    },
    {
        path: '*',
        component: resolve => require(['pages/404'], resolve),
        meta: {
            title: "404",
            isNotLoggedIn: true,
        }
    }
]