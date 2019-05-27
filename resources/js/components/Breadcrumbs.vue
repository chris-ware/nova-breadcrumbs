<template>
    <div>
        <nav v-if="this.breadcrumbs != null">
            <ul class="breadcrumbs">
                <li class="breadcrumbs__item" v-for="breadcrumb in breadcrumbs">
                    <router-link v-if="breadcrumb.path != null" :to="breadcrumb.path">{{ __(breadcrumb.title) }}</router-link>
                    <span v-else>{{ __(breadcrumb.title) }}</span>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                breadcrumbs: null
            }
        },
        mounted() {
            Nova.request()
                .post('/nova-vendor/chris-ware/nova-breadcrumbs/', {
                    location: window.location,
                    query: this.$route.query,
                    view: this.$route.name
                })
                .then(({ data }) => {
                    this.breadcrumbs =  data;
                });
        },
    }

</script>
