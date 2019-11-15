import CustomCreate from '@local/views/CustomCreate';
import CustomDashboard from '@local/views/CustomDashboard';

Nova.booting((Vue, router) => {

    Vue.component('create-view', require('./views/CustomCreate'));
    Vue.component('dashboard.custom-view', require('./views/CustomDashboard'));

    Vue.component('breadcrumbs', require('./components/Breadcrumbs'));
    Vue.component('custom-attach-header', require('./components/CustomAttachHeader'));
    Vue.component('custom-attach-pre-breadcrumb', require('./components/CustomAttachPreBreadcrumbs'));
    Vue.component('custom-attach-post-breadcrumb', require('./components/CustomAttachPostBreadcrumbs'));
    Vue.component('custom-detail-header', require('./components/CustomDetailHeader'));
    Vue.component('custom-detail-pre-breadcrumb', require('./components/CustomDetailPreBreadcrumbs'));
    Vue.component('custom-detail-post-breadcrumb', require('./components/CustomDetailPostBreadcrumbs'));
    Vue.component('custom-index-header', require('./components/CustomIndexHeader'));
    Vue.component('custom-index-pre-breadcrumb', require('./components/CustomIndexPreBreadcrumbs'));
    Vue.component('custom-index-post-breadcrumb', require('./components/CustomIndexPostBreadcrumbs'));
    Vue.component('custom-update-header', require('./components/CustomUpdateHeader'));
    Vue.component('custom-update-pre-breadcrumb', require('./components/CustomUpdatePreBreadcrumbs'));
    Vue.component('custom-update-post-breadcrumb', require('./components/CustomUpdatePostBreadcrumbs'));
    Vue.component('custom-update-attached-header', require('./components/CustomUpdateAttachedHeader'));
    Vue.component('custom-update-attached-pre-breadcrumb', require('./components/CustomUpdateAttachedPreBreadcrumbs'));
    Vue.component('custom-update-attached-post-breadcrumb', require('./components/CustomUpdateAttachedPostBreadcrumbs'));

    router.beforeEach(function (to, from, next) {
        var customComponent = null;
        var globalViews = ['create', 'dashboard.custom'];
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

    router.addRoutes([
        {
            name: 'custom-create',
            path: '/resources/:resourceName/new',
            component: CustomCreate,
            props: route => {
                return {
                    resourceName: route.params.resourceName,
                    viaResource: route.query.viaResource,
                    viaResourceId: route.query.viaResourceId,
                    viaRelationship: route.query.viaRelationship,
                }
            },
        },
        {
            name: 'custom-dashboard.custom',
            path: '/dashboards/:name',
            component: CustomDashboard,
            props: true,
        },
    ]);

})
