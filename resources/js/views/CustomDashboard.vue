<template>

    <loading-view :loading="loading">
        <div class="mb-3">
            <breadcrumbs/>
        </div>

        <dashboard/>
    </loading-view>

</template>

<script>
    import Dashboard from "@nova/views/Dashboard";

    export default {
        components: {Dashboard}
    }

</script>
