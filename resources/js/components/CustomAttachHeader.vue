<template>
    <div>
        <custom-attach-pre-breadcrumb
            :resource="resource"
            :resource-id="resourceId"
            :resource-name="resourceName"
        />

        <breadcrumbs
            :resource="resource"
            :resource-id="resourceId"
            :resource-name="resourceName"
        />

        <custom-attach-post-breadcrumb
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
