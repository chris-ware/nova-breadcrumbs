<template>
    <div>
        <custom-lens-pre-breadcrumb :resource-name="resourceName" />

        <breadcrumbs :resource-name="resourceName" />

        <custom-lens-post-breadcrumb :resource-name="resourceName" />

    </div>
</template>

<script>

    export default {
        props: ['resourceName'],
    }
</script>
