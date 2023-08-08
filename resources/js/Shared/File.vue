<template>
  <div>
    <img class ="h-16 sm:h-12 m-5 object-contain" :src="source">
    <p class="text-sm w-16 inline-block break-all m-2">{{ name }}</p>
  </div>
</template>

<script>


export default {
  props: {
    name: {
      required: true,
      type: String,
    },
    source: {
      required: true,
      type: String,
    },
  },
  data() {
    return {
      itemType: 'file',
      itemName: this.name,
      itemPatch: this.source,
    }
  },
}
</script>
