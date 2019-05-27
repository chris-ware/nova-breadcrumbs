<template>
    <div>
        <custom-detail-pre-breadcrumb
            :resource="resource"
            :resource-id="resourceId"
            :resource-name="resourceName"
        />

        <breadcrumbs />

        <custom-detail-post-breadcrumb
            :resource="resource"
            :resource-id="resourceId"
            :resource-name="resourceName"
        />

    </div>
</template>

<script>

    export default {
        props: ['resource', 'resourceName', 'resourceId'],
    }
</script>
