<template>
    <loading-view :loading="loading">
        <div class="mb-3">
            <breadcrumbs />
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

    export default {
        components: {UpdateAttached},
        mixins: [UpdateAttached],
    }
</script>
