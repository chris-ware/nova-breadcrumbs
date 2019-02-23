<template>

    <div>
        <div class="mb-3">
            <breadcrumbs
                :headingTitle="headingTitle"
            />
        </div>

        <index
            :resourceName="resourceName"
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
