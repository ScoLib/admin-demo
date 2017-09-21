export default [
    {
        path: 'logs',
        component (resolve) {
            require(['./components/logs.vue'], resolve);
        },
        name: 'admin.logs',
        meta: {
            title: '操作日志',
            auth: true,
        },
    }
];