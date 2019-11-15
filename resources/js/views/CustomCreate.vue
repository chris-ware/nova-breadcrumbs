<template>
    <div>
        <div class="mb-3">
            <breadcrumbs
                :singularName="singularName"
                :rview="'create'"
            />
        </div>

        <create
            ref="rview"
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
        props: [
            'resourceName',
            'viaResource',
            'viaResourceId',
            'viaRelationship',
        ],
        data() {
            return {
                singularName: null,
            }
        },
        mounted() {
            this.$watch(() => this.$refs.rview.loading, (loading) => {
                if (!loading) {
                    this.singularName = (!this.$refs.rview.resourceInformation.singularLabel && this.$refs.rview.relationResponse)
                        ? this.$refs.rview.relationResponse.singularLabel
                        : this.$refs.rview.resourceInformation.singularLabel
                }
            })
        }
    }
</script>