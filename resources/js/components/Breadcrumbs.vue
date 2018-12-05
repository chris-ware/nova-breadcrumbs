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
        props: ['resource'],
        computed: {
            crumbs: function () {
                let pathArray = this.$router.currentRoute.path.split('/');
                pathArray.shift();
                return pathArray.reduce((breadcrumbArray, path, idx) => {
                    breadcrumbArray.push({
                        path: path,
                        to: breadcrumbArray[idx - 1]
                            ? breadcrumbArray[idx - 1].to + "/" + path
                            : "/" + path,
                        text: isNaN(path) ? path.replace('-', ' ').replace(/(?:^|\s)\S/g, function (a) {
                            return a.toUpperCase();
                        }) : this.resource.title,
                    });
                    return breadcrumbArray;
                }, []);
            }
        },
    }

</script>
