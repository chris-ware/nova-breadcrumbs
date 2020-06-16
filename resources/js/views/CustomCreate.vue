<template>
    <div>
        <div class="mb-3">
            <breadcrumbs
                :singularName="singularName"
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
            this.$watch(() => this.$refs.rview.$children[0].loading, (loading) => {
                if (!loading) {
                    // this.singularName = (!this.$refs.rview.$children[0].resourceInformation.singularLabel && this.$refs.rview.$children[0].relationResponse)
                    //     ? this.$refs.rview.$children[0].relationResponse.singularLabel
                    //     : this.$refs.rview.$children[0].resourceInformation.singularLabel
                }
            })
        }
    }
</script>
