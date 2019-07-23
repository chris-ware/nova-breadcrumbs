<template>
    <div>
        <div class="mb-3">
            <breadcrumbs :resource="resource" :selectedResource="selectedResource"/>
        </div>

        <update-attached
            ref="rview"
            :resourceName="resourceName"
            :resourceId="resourceId"
            :relatedResourceName="relatedResourceName"
            :relatedResourceId="relatedResourceId"
            :viaResource="viaResource"
            :viaResourceId="viaResourceId"
            :viaRelationship="viaRelationship"
            :polymorphic="polymorphic"
        />
    </div>
</template>

<script>
    import UpdateAttached from '@nova/views/UpdateAttached'
    import FetchResource from "../mixins/FetchResource";

    export default {
        components: {UpdateAttached},
        mixins: [FetchResource],
         data() {
            return {
                resource: null,
                selectedResource: null,
            }
        }, 
        mounted() {
            this.getResource()

            this.$watch(() => this.$refs.rview.selectedResource, (selectedResource) => {
                if (selectedResource) {
                    this.selectedResource = selectedResource
                }
            })
        }
    }
</script>
