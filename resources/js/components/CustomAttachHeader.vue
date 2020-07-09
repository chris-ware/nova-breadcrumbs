<template>
    <div>
        <custom-attach-pre-breadcrumb
            :resource-id="resourceId"
            :resource-name="resourceName"
        />

        <breadcrumbs
            :resource-id="resourceId"
            :resource-name="resourceName"
        />

        <custom-attach-post-breadcrumb
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
