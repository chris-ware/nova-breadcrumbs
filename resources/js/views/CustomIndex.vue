<template>
    <div>
        <div class="mb-3">
            <breadcrumbs
                :headingTitle="headingTitle"
            />
        </div>

        <index
            ref="rview"
            :field="field"
            :resourceName="resourceName"
            :viaResource="viaResource"
            :viaResourceId="viaResourceId"
            :viaRelationship="viaRelationship"
            :relationshipType="relationshipType"
        />
    </div>

</template>

<script>
    import Index from "@nova/views/Index";

    export default {
        components: {Index},
        props: [
            'field',
            'resourceName',
            'viaResource',
            'viaResourceId',
            'viaRelationship',
            'relationshipType',
        ],
        data() {
            return {
                headingTitle: null,
            }
        }, 
        mounted() {
            this.$watch(() => this.$refs.rview.resourceResponse, (resourceResponse) => {
                if (resourceResponse != null) {
                    this.headingTitle = this.$refs.rview.isRelation && this.$refs.rview.field ? this.$refs.rview.field.name : resourceResponse.label
                }
            })
        }
    }
</script>
