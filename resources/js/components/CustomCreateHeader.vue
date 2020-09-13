<template>
    <div>
        <custom-create-pre-breadcrumb :resource-name="resourceName"/>

        <breadcrumbs :resource-name="resourceName"/>

        <custom-create-post-breadcrumb :resource-name="resourceName"/>

    </div>
</template>

<script>
    export default {
        props: ['resource', 'resourceName', 'resourceId'],
    };
</script>
