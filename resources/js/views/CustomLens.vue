<template>
    <loading-view :loading="loading">

        <div class="mb-3">
            <breadcrumbs/>
        </div>

        <lens
            :resourceName="resourceName"
            :viaResource="viaResource"
            :viaResourceId="viaResourceId"
            :viaRelationship="viaRelationship"
            :relationshipType="relationshipType"
            :lens="lens"
        />
    </loading-view>
</template>

<script>
    import Lens from '@nova/views/Lens'

    export default {
        components: {Lens},
        mixins: [Lens],
    }
</script>
