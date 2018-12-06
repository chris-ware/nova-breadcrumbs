<script>
    import {Minimum} from 'laravel-nova'

    export default {
        data: () => ({
            resource: null,
        }),
        mounted() {
            this.getResource()
        },

        methods: {

            /**
             * Get the resource information.
             */
            getResource() {
                this.resource = null

                return Minimum(
                    Nova.request().get('/nova-api/' + this.resourceName + '/' + this.resourceId)
                )
                    .then(({data: {panels, resource}}) => {
                        this.panels = panels
                        this.resource = resource
                        this.loading = false
                    })
                    .catch(error => {
                        if (error.response.status >= 500) {
                            Nova.$emit('error', error.response.data.message)
                            return
                        }

                        if (error.response.status === 404 && this.initialLoading) {
                            this.$router.push({name: '404'})
                            return
                        }

                        if (error.response.status === 403) {
                            this.$router.push({name: '403'})
                            return
                        }

                        this.$toasted.show(this.__('This resource no longer exists'), {type: 'error'})

                        this.$router.push({
                            name: 'index',
                            params: {resourceName: this.resourceName},
                        })
                    })
            },
        }
    }
</script>
