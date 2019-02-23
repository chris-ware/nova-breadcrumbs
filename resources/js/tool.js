import CustomAttach from '@local/views/CustomAttach';
import CustomCreate from '@local/views/CustomCreate';
import CustomDashboard from '@local/views/CustomDashboard';
import CustomIndex from '@local/views/CustomIndex';
import CustomUpdate from '@local/views/CustomUpdate';
import CustomUpdateAttached from '@local/views/CustomUpdateAttached';

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

    router.addRoutes([
        {
            name: 'custom-dashboard',
            path: '/',
            component: CustomDashboard,
            props: true
        },
        {
            name: 'custom-index',
            path: '/resources/:resourceName',
            component: CustomIndex,
            props: true
        },
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
            name: 'custom-edit',
            path: '/resources/:resourceName/:resourceId/edit',
            component: CustomUpdate,
            props: function props(route) {
                return {
                    component: route.params.component,
                    resourceName: route.params.resourceName,
                    resourceId: route.params.resourceId,
                    viaResource: route.query.viaResource,
                    viaResourceId: route.query.viaResourceId,
                    viaRelationship: route.query.viaRelationship
                };
            }
        }, {
            name: 'custom-attach',
            path: '/resources/:resourceName/:resourceId/attach/:relatedResourceName',
            component: CustomAttach,
            props: function props(route) {
                return {
                    component: route.params.component,
                    resourceName: route.params.resourceName,
                    resourceId: route.params.resourceId,
                    relatedResourceName: route.params.relatedResourceName,
                    viaRelationship: route.query.viaRelationship,
                    polymorphic: route.query.polymorphic == '1'
                };
            }
        }, {
            name: 'custom-edit-attached',
            path: '/resources/:resourceName/:resourceId/edit-attached/:relatedResourceName/:relatedResourceId',
            component: CustomUpdateAttached,
            props: function props(route) {
                return {
                    component: route.params.component,
                    resourceName: route.params.resourceName,
                    resourceId: route.params.resourceId,
                    relatedResourceName: route.params.relatedResourceName,
                    relatedResourceId: route.params.relatedResourceId,
                    viaRelationship: route.query.viaRelationship
                };
            }
        }
    ]);

})
