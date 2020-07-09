<template>
    <nav v-if="this.breadcrumbs != null">
        <ul class="breadcrumbs">
            <li class="breadcrumbs__item" v-for="breadcrumb in breadcrumbs">
                <router-link v-if="breadcrumb.path != null" :to="breadcrumb.path">
                    {{ __(breadcrumb.title) }}
                </router-link>
                <span v-else>{{ __(breadcrumb.title) }}</span>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        props: ['dashboardName'],
        data: function () {
            return {
                breadcrumbs: null
            };
        },
        methods: {
            fetchBreadcrumbs() {
                Nova.request().post('/nova-vendor/chris-ware/nova-breadcrumbs/', {
                    location: window.location,
                    query: this.$route.query,
                    view: this.$route.name,
                    name: this.dashboardName,
                }).then(({ data }) => {
                    this.breadcrumbs = data;
                });
            }
        },
        mounted() {
            this.fetchBreadcrumbs();
        },
        watch: {
            $route() {
                this.fetchBreadcrumbs();
            }
        }
    };

</script>
