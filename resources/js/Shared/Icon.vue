<template>
    <component v-if="isLoaded" :is="heroIcons[fullName]" class="h-6 w-6" v-bind="$attrs" />
</template>

<script>

import * as heroIcons from '@heroicons/vue/24/outline'
import _ from 'lodash'
/* TrashIcon, LanguageIcon, ChevronDownIcon, Cog6ToothIcon, XCircleIcon, XMarkIcon, PencilSquareIcon, Square3Stack3DIcon, CircleStackIcon, DocumentTextIcon, DocumentDuplicateIcon */
export default {
  inheritAttrs: false,
    props: {
        name: String,
    },
    data() {
        return {
            isLoaded: false,
            heroIcons: heroIcons
        };
    },
    mounted() {
        this.isLoaded = true;
    },
    computed: {
        fullName() {
            return _.upperFirst(_.camelCase(this.name + 'Icon'))
        },
    },
}
</script>
