<template>
    <div>
        <nav v-if="crumbs.length">
            <ul class="breadcrumbs">
                <li class="breadcrumbs__item" v-for="crumb in crumbs" v-if="crumb.text != false">
                    <router-link :to="crumb.to">{{ __(crumb.text) }}</router-link>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
    export default {
        props: [
            'headingTitle',
            'relatedResourceLabel',
            'resource',
            'resourceName',
            'selectedResource',
            'singularName',
        ],
        computed: {
            crumbs: function () {
                let pathArray = this.$router.currentRoute.path.split('/').filter(function(e){return e});
                pathArray.unshift('');

                return pathArray.reduce((breadcrumbArray, path, idx) => {
                    breadcrumbArray.push({
                        path: path,
                        to: (breadcrumbArray[idx - 1] ? (breadcrumbArray[idx - 1].to === '/' ? '' : breadcrumbArray[idx - 1].to) :'') + "/" + path,
                        text: this.breadcrumbLabel(path, idx),
                    });

                    return breadcrumbArray;
                }, []);
            }
        },
        methods : {
            breadcrumbLabel(path, idx) {
                if (['resources', 'attach', 'edit-attached'].includes(path) || idx == 5) {
                    return false;
                } else if (path == '') {
                    return this.__('Home');
                } else if (typeof this.resource !== 'undefined' && this.resource !== null) {
                    if (path == this.resource.id.value) {
                        return this.resource.title;
                    } else if (typeof this.selectedResource !== 'undefined' && this.selectedResource !== null && path == this.selectedResource.value) {
                        return this.selectedResource.display;
                    } else if (idx < 4) {
                        return this.resource.label;
                    } else if (idx >= 4) {
                        return path.replace('-', ' ').replace(/(?:^|\s)\S/g, function (a) {
                            return a.toUpperCase();
                        });
                    }

                } else if (typeof this.relatedResourceLabel !== 'undefined' && this.relatedResourceLabel !== null) {
                    return this.relatedResourceLabel;
                } else if (typeof this.headingTitle !== 'undefined' && this.headingTitle !== null) {
                        return this.headingTitle;
                }
                else if (typeof this.singularName !== 'undefined' && this.singularName !== null) {
                    if (idx >= 3) {
                        return path.replace('-', ' ').replace(/(?:^|\s)\S/g, function (a) {
                            return a.toUpperCase();
                        });
                    }
                    return this.singularName;
                }
                return '...';

            }
        }
    }

</script>
