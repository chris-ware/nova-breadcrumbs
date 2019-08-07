
Nova.booting((Vue, router) => {

    Vue.component('attach-view', require('./views/CustomAttach'));
    Vue.component('create-view', require('./views/CustomCreate'));
    Vue.component('dashboard-view', require('./views/CustomDashboard'));
    Vue.component('edit-attached-view', require('./views/CustomUpdateAttached'));
    Vue.component('edit-view', require('./views/CustomUpdate'));
    Vue.component('index-view', require('./views/CustomIndex'));

    Vue.component('breadcrumbs', require('./components/Breadcrumbs'));
    Vue.component('custom-detail-header', require('./components/CustomDetailHeader'));
    Vue.component('custom-detail-pre-breadcrumb', require('./components/CustomDetailPreBreadcrumbs'));
    Vue.component('custom-detail-post-breadcrumb', require('./components/CustomDetailPostBreadcrumbs'));

    router.beforeEach(function (to, from, next) {
        var customComponent = null;
        var globalViews = ['dashboard', 'index', 'create', 'edit', 'attach', 'edit-attached'];
        if (globalViews.includes(to.name)) {
            customComponent = to.name + '-view';
        }
        if (customComponent && Vue.options.components[customComponent]) {
            next({
                name: 'custom-' + to.name,
                params: Object.assign({}, to.params, {component: customComponent}),
                query: to.query
            });
        } else {
            next();
        }
    });
})
