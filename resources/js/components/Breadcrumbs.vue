<template>
    <div>
        <nav v-if="crumbs.length">
            <ul class="breadcrumbs">
                <li class="breadcrumbs__item" v-for="crumb in crumbs" v-if="crumb.path != 'resources'">
                    <router-link :to="crumb.to">{{ __(crumb.text) }}</router-link>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
    export default {
        props: ['resource', 'selectedResource', 'relatedResourceLabel'],
        computed: {
            crumbs: function () {
                let pathArray = this.$router.currentRoute.path.split('/').filter(function(e){return e});
                pathArray.unshift('');

                return pathArray.reduce((breadcrumbArray, path, idx) => {
                    breadcrumbArray.push({
                        path: path,
                        to: breadcrumbArray[idx - 1]
                            ? (breadcrumbArray[idx - 1].to === '/' ? '' : breadcrumbArray[idx - 1].to) + "/" + path
                            : "/" + path,
                        text: isNaN(path) ? (typeof this.relatedResourceLabel !== 'undefined' && this.relatedResourceLabel !== null && idx > 4 ? this.relatedResourceLabel : typeof this.resource !== 'undefined' && this.resource !== null && idx < 4 ? this.resource.label : path.replace('-', ' ').replace(/(?:^|\s)\S/g, function (a) {
                            return a.toUpperCase();
                        })) : (typeof this.selectedResource !== 'undefined' && this.selectedResource !== null && idx > 3 ? this.selectedResource.display : (typeof this.resource !== 'undefined' && this.resource !== null && path !== '' ? this.resource.title : this.__('Home'))),
                    });

                    return breadcrumbArray;
                }, []);
            }
        },
    }

</script>
