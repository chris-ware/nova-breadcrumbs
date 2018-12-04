<template>
    <div>
        <nav v-if="crumbs.length">
            <ul class="breadcrumbs">
                <li class="breadcrumbs__item">
                    <router-link to="/">Home</router-link>
                </li>
                <li class="breadcrumbs__item" v-for="crumb in crumbs" v-if="crumb.text != 'Resources'">
                    <router-link :to="crumb.to" >{{ crumb.text }}</router-link>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
    export default {
        computed: {
            crumbs: function () {
                let pathArray = this.$router.currentRoute.path.split('/');
                pathArray.shift()
                let breadcrumbs = pathArray.reduce((breadcrumbArray, path, idx) => {
                    breadcrumbArray.push({
                        path: path,
                        to: breadcrumbArray[idx - 1]
                            ? breadcrumbArray[idx - 1].to + "/" + path
                            : "/" + path,
                        text: isNaN(path) ? path.charAt(0).toUpperCase() + path.slice(1) : 'Detail',
                    });
                    return breadcrumbArray;
                }, [])
                console.log(breadcrumbs);
                return breadcrumbs;
            }
        },
    }

</script>
