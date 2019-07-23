<template>
    <div>
        <div class="mb-3">
            <breadcrumbs :resource="resource"/>
        </div>

        <update
            :resourceName="resourceName"
            :resourceId="resourceId"
            :viaResource="viaResource"
            :viaResourceId="viaResourceId"
            :viaRelationship="viaRelationship"
        />
    </div>
</template>

<script>
    import Update from '@nova/views/Update'
    import FetchResource from "../mixins/FetchResource";

    export default {
        components: {Update},
        mixins: [FetchResource],
        props: [
            'resourceName',
            'resourceId',
            'viaResource',
            'viaResourceId',
            'viaRelationship',
        ],
        data() {
            return {
                resource: null,
            }
        }, 
        mounted() {
            this.getResource()
        },
    }
</script>
