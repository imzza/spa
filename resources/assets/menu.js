const admin = "/admin";

const menu_items = [
    {
        name: 'Dashboard',
        url: 'dashboard',
        link: '/admin/dashboard',
        icon: 'Dashboard'
    },
    {
        name: 'Datatable',
        url: 'table',
        link: '/admin/table',
        icon: 'User'
    },
    
    {
        name: 'Roles & Permissions',
        url: 'role_and_permissions',
        icon: 'fa fa-lock',
        child: [
            {
                name: 'Roles',
                url: 'roles',
                link: admin+'/roles_all',
                icon: 'fa fa-angle-double-right'
            },
            {
                name: 'Add Role',
                url: 'roles_add',
                link: admin+'/roles_add',
                icon: 'fa fa-angle-double-right'
            },
            {
                name: 'Permissions',
                url: 'permissions_all',
                link: admin+'/permissions_all',
                icon: 'fa fa-angle-double-right'
            },
            {
                name: 'Add Permissions',
                url: 'permission_add',
                link: admin+'/permission_add',
                icon: 'fa fa-angle-double-right'
            },
            {
                name: 'Assign Permissions',
                url: 'permissions_assign',
                link: admin+'/permissions_assign',
                icon: 'fa fa-angle-double-right'
            },
        ]
    }
];
export default menu_items;
