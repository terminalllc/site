<template>
    <div class="pb-8 w-full pr-6" :class="classDiv">
        <label v-if="label" class="form-label">{{ label }}:</label>
        <div class="form-input p-0" :class="{ error: errors.length }">
            <input ref="video" type="file" :accept="accept" class="hidden" @change="change" />
            <div class="flex items-center justify-start p-2">
                <video :src="modelValue" class="h-16 object-contain bg-gray-100" />
                <div class="px-4">
                    <button type="button"
                        class="px-4 py-1 bg-gray-500 hover:bg-gray-700 rounded-sm text-xs font-medium text-white"
                        @click="browse">
                        Browse ...
                    </button>
                </div>

            </div>
        </div>
        <div v-if="errors.length" class="form-error">{{ errors[0] }}</div>
    </div>
</template>

<script>
export default {
    props: {
        label: String,
        accept: {
            type: String,
            default: 'video/*'
        },
        modelValue: String,
        emits: ['update:modelValue'],
        errors: {
            type: Array,
            default: () => [],
        },
        classDiv: {
            type: String,
            default: '',
        },
    },
    methods: {
        filesize(size) {
            var i = Math.floor(Math.log(size) / Math.log(1024))
            return (size / Math.pow(1024, i)).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i]
        },
        browse() {
            this.$refs.video.click()
        },
        change(e) {
            const config = {
                headers: { 'content-type': 'multipart/form-data' },
            }
            let formData = new FormData()
            formData.append('video', e.target.files[0])

            this.axios.post(this.$route('files.uploadVideo'), formData, config).then(response => {
                console.log(response.data);
                this.$emit('update:modelValue', response.data)
            })
        },
    },
}
</script>
