<template>
    <div>
        <custom-update-attached-pre-breadcrumb
            :resource="resource"
            :resource-id="resourceId"
            :resource-name="resourceName"
        />

        <breadcrumbs
            :resource="resource"
            :resource-id="resourceId"
            :resource-name="resourceName"
        />

        <custom-update-attached-post-breadcrumb
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
