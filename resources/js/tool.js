Nova.booting((Vue, router) => {
    Vue.component('breadcrumbs', require('./components/Breadcrumbs'));

    ['attach', 'create', 'dashboard', 'detail', 'index', 'update', 'update-attached'].forEach((view) => {
        Vue.component('custom-' + view + '-header', require('./components/Custom' + snakeToPascal(view) + 'Header'));
        Vue.component('custom-' + view + '-pre-breadcrumb', require('./components/Custom' + snakeToPascal(view) + 'PreBreadcrumbs'));
        Vue.component('custom-' + view + '-post-breadcrumb', require('./components/Custom' + snakeToPascal(view) + 'PostBreadcrumbs'));
    });
});

const snakeToPascal = (str) => str.charAt(0).toUpperCase() + str.slice(1).replace(
    /([-_][a-z])/g,
    (group) => group.toUpperCase()
    .replace('-', '')
    .replace('_', '')
);
