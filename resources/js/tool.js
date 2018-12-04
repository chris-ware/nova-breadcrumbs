Nova.booting((Vue, router) => {

    Vue.component('custom-index-header', require('./components/Breadcrumbs'));
    Vue.component('custom-detail-header', require('./components/Breadcrumbs'));
    Vue.component('custom-index-pre-breadcrumb', require('./components/BlankTemplate'));
    Vue.component('custom-index-post-breadcrumb', require('./components/BlankTemplate'));
    Vue.component('custom-detail-pre-breadcrumb', require('./components/BlankTemplate'));
    Vue.component('custom-detail-post-breadcrumb', require('./components/BlankTemplate'));

})
