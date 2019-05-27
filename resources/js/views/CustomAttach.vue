<template>
    <loading-view :loading="loading">
        <div class="mb-3">
            <breadcrumbs />
        </div>

        <attach
            :resourceName="resourceName"
            :resourceId="resourceId"
            :relatedResourceName="relatedResourceName"
            :viaResource="viaResource"
            :viaResourceId="viaResourceId"
            :viaRelationship="viaRelationship"
            :polymorphic="polymorphic"
        />
    </loading-view>
</template>

<script>
    import Attach from '@nova/views/Attach'

    export default {
        components: {Attach},
        mixins: [Attach],
    }
</script>
