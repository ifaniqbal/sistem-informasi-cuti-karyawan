<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Tambah Karyawan
      </h2>
    </template>

    <div>
      <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <jet-form-section @submitted="createEmployee">
          <template #title>
            Karyawan
          </template>

          <template #description>
            Isi data karyawan yang ingin ditambahkan.
          </template>

          <template #form>
            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
              <jet-label
                for="name"
                value="Nama" />
              <jet-input
                id="name"
                v-model="form.name"
                type="text"
                class="mt-1 block w-full"
                autocomplete="name" />
              <jet-input-error
                :message="form.errors.name"
                class="mt-2" />
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
              <jet-label
                for="email"
                value="Email" />
              <jet-input
                id="email"
                v-model="form.email"
                type="email"
                class="mt-1 block w-full" />
              <jet-input-error
                :message="form.errors.email"
                class="mt-2" />
            </div>

            <!-- Password -->
            <div class="col-span-6 sm:col-span-4">
              <jet-label
                for="password"
                value="Password" />
              <jet-input
                id="password"
                v-model="form.password"
                type="password"
                class="mt-1 block w-full" />
              <jet-input-error
                :message="form.errors.password"
                class="mt-2" />
            </div>
          </template>

          <template #actions>
            <jet-action-message
              :on="form.recentlySuccessful"
              class="mr-3">
              Karyawan ditambahkan.
            </jet-action-message>

            <jet-button
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing">
              Tambahkan
            </jet-button>
          </template>
        </jet-form-section>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import JetButton from '@/Jetstream/Button'
import JetFormSection from '@/Jetstream/FormSection'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'
import JetLabel from '@/Jetstream/Label'
import JetActionMessage from '@/Jetstream/ActionMessage'

export default {
  components: {
    AppLayout,
    JetActionMessage,
    JetButton,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
  },
  props: [],
  data() {
    return {
      form: this.$inertia.form({
        _method: 'POST',
        name: null,
        email: null,
        password: null,
      }),
    }
  },

  methods: {
    createEmployee() {
      this.form.post(route('employees.store'), {
        preserveScroll: true,
        onSuccess: () => {},
      });
    },
  },
}
</script>
