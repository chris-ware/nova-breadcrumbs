<template>
    <div>
        <custom-dashboard-pre-breadcrumb :dashboard-name="dashboardName" />

        <breadcrumbs :dashboard-name="dashboardName" />

        <custom-dashboard-post-breadcrumb :dashboard-name="dashboardName"/>

    </div>
</template>

<script>

    export default {
        props: ['dashboardName'],
    }
</script>
