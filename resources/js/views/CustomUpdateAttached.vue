<template>
    <loading-view :loading="loading">
        <div class="mb-3">
            <breadcrumbs :resource="resource" :selectedResource="selectedResource"/>
        </div>

        <update-attached
            :resourceName="resourceName"
            :resourceId="resourceId"
            :relatedResourceName="relatedResourceName"
            :relatedResourceId="relatedResourceId"
            :viaResource="viaResource"
            :viaResourceId="viaResourceId"
            :viaRelationship="viaRelationship"
            :polymorphic="polymorphic"
        />
    </loading-view>
</template>

<script>
    import UpdateAttached from '@nova/views/UpdateAttached'
    import FetchResource from "../mixins/FetchResource";

    export default {
        components: {UpdateAttached},
        mixins: [UpdateAttached, FetchResource],
        data: () => ({
            resource: null,
        }),
        mounted() {
            this.initializeComponent()
            this.getResource()
        },
    }
</script>
