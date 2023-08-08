<template>
    <div class="pb-8 w-full pr-6" :class="classDiv">
        <label v-if="label" class="form-label">{{ label }}:</label>
        <p class="h-14 object-contain" > Status: {{ status }}</p>
        <div class="form-input p-0" :class="{ error: errors.length }">
            <input :id="id" ref="archive" type="file" :accept="accept" class="hidden" @change="change" />
           <!--  <p class="h-8 object-contain bg-gray-300">{{ filesCount }}</p> -->

            <div class="flex items-center justify-start p-2">
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
import { v1 as uuid1 } from "uuid"
export default {
    inheritAttrs: false,
    props: {
        id: {
            type: String,
            default() {
                return `textarea-input-` + uuid1()
            },
        },
        label: String,
        accept: {
            type: String,
            default: 'zip,application/zip,application/x-zip,application/x-zip-compressed'
        },
        modelValue: {
            type: Array,
        },
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
    data() {
        return {
            filesCount: null,
            status: null,
        }
    },
    methods: {
        filesize(size) {
            var i = Math.floor(Math.log(size) / Math.log(1024))
            return (size / Math.pow(1024, i)).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i]
        },
        browse() {
            this.$refs.archive.click()
        },
        change(e) {
            //1. Upload zip and return zip filename
            //2. Unzip zip, return count files and list files
            //3. optimized files and return file names

            const config = {
                headers: { 'content-type': 'multipart/form-data' },
            }

            this.status=''

            let formData = new FormData()
            formData.append('archive', e.target.files[0])

            this.axios.post(this.$route('files.uploadZip'), formData, config).then(response => {
                this.status = 'Zip upload success!'

                let formData = new FormData()
                formData.append('zipFilename', response.data)

                this.axios.post(this.$route('files.unZip'), formData).then(response => {
                    this.status = this.status +' Unzip success!'

                    let formData = new FormData()
                    formData.append('listFiles', response.data.zipFiles)

                    this.axios.post(this.$route('files.optimize'), formData).then(response => {
                        this.status = this.status + ' Images optimized success!'
                        this.$emit('update:modelValue', response.data.files)

                    }).catch(e => {
                       this.status = this.status + ' Error! Images optimized ('
                    })
                }).catch(e => {
                    this.status = this.status + ' Error! File Unzip ('
                })

            }).catch(e => {
                this.status = this.status + ' Error! File upload ('
            })
        },
    },
}
</script>
