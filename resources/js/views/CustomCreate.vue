<template>
    <loading-view :loading="loading">
        <div class="mb-3">
            <breadcrumbs
                :singularName="singularName"
            />
        </div>

        <create
            :resourceName="resourceName"
            :viaResource="viaResource"
            :viaResourceId="viaResourceId"
            :viaRelationship="viaRelationship"
        />
    </loading-view>
</template>

<script>
    import Create from '@nova/views/Create'

    export default {
        components: {Create},
        mixins: [Create],
    }
</script>
