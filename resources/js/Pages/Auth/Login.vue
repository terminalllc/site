<template>
  <div class="p-6 bg-indigo-800 min-h-screen flex justify-center items-center">
    <div class="w-full max-w-md">
      <form class="mt-8 bg-white rounded-lg shadow-xl overflow-hidden" @submit.prevent="login">
        <div class="px-10 py-12">
          <h1 class="text-center font-bold text-3xl">Вхід</h1>
          <div class="mx-auto mt-6 w-24 border-b-2" />
          <text-input v-model="form.email" :error="$page.props.errors.email" label="Email" type="email" autofocus autocapitalize="off" />
          <text-input v-model="form.password" :error="$page.props.errors.password" label="Password" type="password" />
        </div>
        <div class="px-10 py-4 bg-gray-100 border-t border-gray-100 flex">
          <loading-button :loading="form.processing" class="ml-auto btn-indigo" type="submit">LOGIN</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import TextInput from '@/Shared/TextInput.vue'
import LoadingButton from '@/Shared/LoadingButton.vue'
import { router } from '@inertiajs/vue3'

export default {
  metaInfo: { title: 'Login to the admin panel ' },
  components: {
    LoadingButton,
    TextInput,
  },
  data() {
    return {
      form: {
        email: '',
        password: '',
        remember: false,
      },
    }
  },
  methods: {
      login() {
        router.post(this.$route('login.store'), this.form)
    },
  },
}
</script>
