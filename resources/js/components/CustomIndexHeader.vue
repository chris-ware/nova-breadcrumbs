<template>
    <div>
        <custom-index-pre-breadcrumb
            :resource="resource"
            :resource-id="resourceId"
            :resource-name="resourceName"
        />

        <breadcrumbs
            :resource="resource"
            :resource-id="resourceId"
            :resource-name="resourceName"
        />

        <custom-index-post-breadcrumb
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
