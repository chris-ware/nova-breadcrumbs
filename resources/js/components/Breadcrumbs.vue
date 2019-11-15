<template>
    <div>
        <nav v-if="crumbs.length">
            <ul class="breadcrumbs">
                <li class="breadcrumbs__item" v-for="crumb in crumbs" v-if="crumb.text != false">
                    <router-link :to="crumb.to" v-html="__(crumb.text)"></router-link>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
    export default {
        props: [
            'resource',
            'resourceId',
            'rview',
        ],
        computed: {
            crumbs: function () {
                let pathArray = this.$router.currentRoute.path.split('/').filter((e) => e);
                let view = this.$parent;
                if (this.rview == null) {
                    view = this.$parent.$parent.$parent;
                }
                if (pathArray[0] != 'dashboards') {
                    pathArray.unshift('');
                }

                let crumb = null;
                return pathArray.reduce((breadcrumbArray, path, idx) => {
                    crumb = {
                        path: path,
                        to: this.breadcrumbLink(breadcrumbArray, path, idx),
                        text: this.breadcrumbLabel(path, idx, view, crumb),
                    };
                    breadcrumbArray.push(crumb);
                    return breadcrumbArray;
                }, []);
            }
        },
        methods: {
            breadcrumbLink(breadcrumbArray, path, idx) {
                return (breadcrumbArray[idx - 1] ? (breadcrumbArray[idx - 1].to === '/' ? '' : breadcrumbArray[idx - 1].to) : '') + "/" + path
            },
            breadcrumbLabel(path, idx, view, prev) {
                if (prev != null
                    && prev.path == 'dashboards'
                    && view.$attrs.name == 'main') {
                    return this.__('Home');
                }

                if (prev != null
                    && prev.path == 'dashboards') {
                    return view.$attrs.name.replace('-', ' ').replace(/(?:^|\s)\S/g, function (a) {
                        return a.toUpperCase();
                    });
                }

                if (idx == 5
                    && prev.path == 'attach') {
                    return view.headingTitle;
                }

                if (['resources', 'attach', 'edit-attached', 'dashboards'].includes(path) || idx == 5) {
                    return false;
                }

                if (path == '') {
                    return this.__('Home');
                }

                if (path == 'new') {
                    return this.__('Create');
                }

                if (idx == 2
                    && typeof view.singularName !== 'undefined'
                    && view.singularName !== null) {
                    return view.singularName;
                }

                if (typeof view.resource !== 'undefined'
                    && view.resource !== null
                    && path == view.resource.id.value) {
                    return view.resource.title;
                }


                if (typeof view.resource !== 'undefined'
                    && view.resource !== null
                    && typeof view.selectedResource !== 'undefined'
                    && view.selectedResource !== null
                    && path == view.selectedResource.value) {
                    return view.selectedResource.display;
                }

                if (typeof view.resource !== 'undefined'
                    && view.resource !== null
                    && idx < 4) {
                    return view.resource.label;
                }

                if (typeof view.resource !== 'undefined'
                    && view.resource !== null
                    && idx >= 4) {
                    return path.replace('-', ' ').replace(/(?:^|\s)\S/g, function (a) {
                        return a.toUpperCase();
                    });
                }

                if (typeof view.relatedResourceLabel !== 'undefined'
                    && view.relatedResourceLabel !== null
                    && idx > 4) {
                    return this.__('Edit Attached') + ' ' + view.relatedResourceLabel;
                }

                if (typeof view.relatedResourceLabel !== 'undefined'
                    && view.relatedResourceLabel !== null
                    && idx <= 4) {
                    return path.replace('-', ' ').replace(/(?:^|\s)\S/g, function (a) {
                        return a.toUpperCase();
                    });
                }

                if (typeof view.headingTitle !== 'undefined'
                    && view.headingTitle !== null) {
                    return view.headingTitle;
                }

                if (typeof view.singularName !== 'undefined'
                    && view.singularName !== null
                    && idx >= 3) {
                    return path.replace('-', ' ').replace(/(?:^|\s)\S/g, function (a) {
                        return a.toUpperCase();
                    });
                }



                return '...';

            }
        }
    }

</script>
