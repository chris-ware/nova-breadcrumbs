<template>
    <div>
        <custom-index-pre-breadcrumb
            :resource-name="resourceName"
        />

        <breadcrumbs
            :resource-name="resourceName"
        />

        <custom-index-post-breadcrumb
            :resource-name="resourceName"
        />

    </div>
</template>

<script>
    export default {
        props: ['resourceName'],
    };
</script>
