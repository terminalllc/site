<template>
  <div>
    <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
    <input :id="id" ref="checkbox-input" v-bind="$attrs" class="w-8 h-8" :class="{ error: error }" type="checkbox" true-value="1" false-value="0" :value="value" @input="$emit('checkbox-input', $event.target.value)"/>
    <div v-if="error" class="form-error">{{ error }}</div>
  </div>
</template>

<script>
export default {
  inheritAttrs: false,
  props: {
    id: {
      type: String,
      default() {
        return `checkbox-input-${this._uid}`
      },
    },
    value: Boolean,
    label: String,
    error: String,
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
