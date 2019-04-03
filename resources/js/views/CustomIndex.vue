<template>

    <div>
        <div class="mb-3">
            <breadcrumbs
                :headingTitle="headingTitle"
            />
        </div>

        <index
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
        mixins: [Index],
        computed: {
            headingTitle() {
                if (this.resourceResponse == null) {
                    return null;
                }
                return this.isRelation && this.field ? this.field.name : this.resourceResponse.label
            },
        }
    }

</script>
