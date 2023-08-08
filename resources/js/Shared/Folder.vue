<template>
  <div class="mx-1">   
    <icon name="folder" class="block w-10 h-10 m-5 fill-gray-400 cursor-pointer mx-auto" />  
    {{name}}
  </div>
</template>

<script>

import Icon from '@/Shared/Icon'


export default {
  components: {
    Icon,
  },
  props: {
    name: {
      required: true,
      type: String,
    }    
  },
  data() {
    return {
      itemType: 'folder',
      itemName: this.name,
    }
  },
}
</script>