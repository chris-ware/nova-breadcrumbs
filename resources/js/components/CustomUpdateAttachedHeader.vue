<template>
    <div>
        <custom-update-attached-pre-breadcrumb
            :resource-id="resourceId"
            :resource-name="resourceName"
        />

        <breadcrumbs
            :resource-id="resourceId"
            :resource-name="resourceName"
        />

        <custom-update-attached-post-breadcrumb
            :resource-id="resourceId"
            :resource-name="resourceName"
        />

    </div>
</template>

<script>
    export default {
        props: ['resourceName', 'resourceId'],
    };
</script>
