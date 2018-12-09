<template>
    <loading-view :loading="loading">
        <div class="mb-3">
            <breadcrumbs :resource="resource" />
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
    import FetchResource from "../mixins/FetchResource";

    export default {
        components: {Attach},
        mixins: [Attach, FetchResource],
        data: () => ({
            resource: null,
        }),
        mounted() {
            this.getResource()
        },
    }
</script>
