<template>
  <div class="pb-8 w-full pr-6" :class="classDiv">
    <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
    <textarea :id="id" ref="input" v-bind="$attrs" class="form-textarea" :class="{ error: error }" :value="modelValue" :rows="rows" @input="$emit('update:modelValue', $event.target.value)" />
    <div v-if="error" class="form-error">{{ error }}</div>
  </div>
</template>

<script>

import { v1 as uuid1 } from "uuid"
export default {
  inheritAttrs: false,
  props: {
    id: {
      type: String,
      default() {
        return `textarea-input-`+uuid1()
      },
    },
    modelValue: String,
    label: String,
    error: String,
    classDiv: {
        type: String,
        default: 'mt-6',
    },
    rows: {
      type: String,
      default() {
        return '3'
      },
    },
  },
  methods: {
    focus() {
      this.$refs.input.focus()
    },
    select() {
      this.$refs.input.select()
    },
  },
}
</script>
