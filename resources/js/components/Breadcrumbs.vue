<template>
    <div>
        <nav v-if="this.breadcrumbs != null">
            <ul class="breadcrumbs">
                <li class="breadcrumbs__item" v-for="breadcrumb in breadcrumbs">
                    <a v-if="breadcrumb.path != null" :href="breadcrumb.path">{{ __(breadcrumb.title) }}</a>
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
