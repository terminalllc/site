<template>
  <div class="pb-8 w-full pr-6" :class="classDiv">
    <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
    <input :id="id" ref="input" v-bind="$attrs" class="form-input" :class="[ error ? error : '', classInput] " :type="type" :value="modelValue" :disabled="isDisabled" @input="$emit('update:modelValue', $event.target.value)" />
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
    type: {
      type: String,
      default: 'text',
    },
    modelValue: [String, Number, Date],
    label: String,
    error: String,
    classInput: String,
    classDiv: {
        type: String,
        default: '',
      },
    isDisabled: {
      type: Boolean,
          default: false
      },
    },
    emits: ['update:modelValue'],
    methods: {
        focus() {
            this.$refs.input.focus()
        },
        select() {
            this.$refs.input.select()
        },
        setSelectionRange(start, end) {
            this.$refs.input.setSelectionRange(start, end)
        },
    },

}
</script>
