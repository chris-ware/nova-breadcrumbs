<template>
    <div>
        <custom-update-pre-breadcrumb
            :resource-id="resourceId"
            :resource-name="resourceName"
        />

        <breadcrumbs
            :resource-id="resourceId"
            :resource-name="resourceName"
        />

        <custom-update-post-breadcrumb
            :resource-id="resourceId"
            :resource-name="resourceName"
        />

    </div>
</template>

<script>

    export default {
        props: ['resourceName', 'resourceId'],
    }
</script>
