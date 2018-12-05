Nova.booting((Vue, router) => {

    Vue.component('breadcrumbs', require('./components/Breadcrumbs'));
    Vue.component('custom-index-header', require('./components/CustomIndexHeader'));
    Vue.component('custom-detail-header', require('./components/CustomDetailHeader'));
    Vue.component('custom-detail-pre-breadcrumb', require('./components/CustomDetailPreBreadcrumbs'));
    Vue.component('custom-detail-post-breadcrumb', require('./components/CustomDetailPostBreadcrumbs'));
    Vue.component('custom-index-pre-breadcrumb', require('./components/CustomIndexPreBreadcrumbs'));
    Vue.component('custom-index-post-breadcrumb', require('./components/CustomIndexPostBreadcrumbs'));

})
