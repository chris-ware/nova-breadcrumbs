<template>
    <div>
        <div class="mb-3">
            <breadcrumbs :resource="resource"
                         :relatedResourceLabel="relatedResourceLabel" />
        </div>

        <attach
            ref="rview"
            :resourceName="resourceName"
            :resourceId="resourceId"
            :relatedResourceName="relatedResourceName"
            :viaResource="viaResource"
            :viaResourceId="viaResourceId"
            :viaRelationship="viaRelationship"
            :polymorphic="polymorphic"
        />
    </div>
</template>

<script>
    import Attach from '@nova/views/Attach'
    import FetchResource from "../mixins/FetchResource";

    export default {
        components: {Attach},
        mixins: [FetchResource],
        props: [
            'resourceName',
            'resourceId',
            'relatedResourceName',
            'viaResource',
            'viaResourceId',
            'viaRelationship',
            'polymorphic',
        ],

        data() {
            return {
                resource: null,
                relatedResourceLabel: null,
            }
        }, 
        mounted() {
            this.getResource()
            this.$watch(() => this.$refs.rview.field, (field) => {
                if (field) {
                    this.relatedResourceLabel = field.singularLabel
                }
            })
        }
    }
</script>
