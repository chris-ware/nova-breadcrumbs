<template>
    <div>
        <div class="mb-3">
            <breadcrumbs/>
        </div>
        <create
            :resourceName="resourceName"
            :viaResource="viaResource"
            :viaResourceId="viaResourceId"
            :viaRelationship="viaRelationship"
        />
    </div>
</template>

<script>
    import Create from '@nova/views/Create'

    export default {
        components: {Create},
        mixins: [Create],
    }
</script>
