<template>
  <div class="mt-2 flex flex-wrap">
    <template v-for="(link, key) in links">
      <div v-if="link.url === null" :key="key" class="mr-1 mb-1 px-4 py-2 text-sm border rounded text-white">{{ link.label }}</div>
      <button v-else :key="key" @click="$emit('change_pagination', link.url)" class="mr-1 mb-1 px-4 py-2 text-sm border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500" :class="{ 'bg-red': link.active }">{{ link.label }}</button>
    </template>
  </div>
</template>

<script>
export default {
  props: {
    links: Array,
  },


}
</script>
