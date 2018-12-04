Nova.booting((Vue, router) => {

    Vue.component('custom-index-header', require('./components/Breadcrumbs'));
    Vue.component('custom-detail-header', require('./components/Breadcrumbs'));
    Vue.component('detail-index-pre-breadcrumb', require('./components/BlankTemplate'));
    Vue.component('detail-index-post-breadcrumb', require('./components/BlankTemplate'));
    Vue.component('detail-header-pre-breadcrumb', require('./components/BlankTemplate'));
    Vue.component('detail-header-post-breadcrumb', require('./components/BlankTemplate'));

})
