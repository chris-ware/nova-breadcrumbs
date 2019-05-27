<template>
    <loading-view :loading="loading">

        <div class="mb-3">
            <breadcrumbs/>
        </div>

        <update
            :resourceName="resourceName"
            :resourceId="resourceId"
            :viaResource="viaResource"
            :viaResourceId="viaResourceId"
            :viaRelationship="viaRelationship"
        />
    </loading-view>
</template>

<script>
    import Update from '@nova/views/Update'

    export default {
        components: {Update},
        mixins: [Update],
    }
</script>
