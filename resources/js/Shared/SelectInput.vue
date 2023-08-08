<template>
  <div class="pb-8 pr-6" :class="classDiv">
    <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
    <select :id="id" ref="input" v-model="selected" v-bind="$attrs" class="form-select" :class="{ error: error }">
      <slot />
    </select>
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
        return `select-input-`+uuid1()
      },
    },
    modelValue: [String, Number, Boolean, Object],
    label: String,
    error: String,
    classDiv: {
        type: String,
        default: 'mt-6',
    },
  },
  data() {
    return {
      selected: this.modelValue,
    }
  },
  watch: {
    selected(selected) {
      this.$emit('input', selected)
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
