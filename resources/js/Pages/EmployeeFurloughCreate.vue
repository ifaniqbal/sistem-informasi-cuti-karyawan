<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Ajukan Cuti
      </h2>
    </template>

    <div>
      <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <jet-form-section @submitted="submit">
          <template #title>
            Cuti
          </template>

          <template #description>
            Isi detail cuti yang ingin diajukan.
          </template>

          <template #form>
            <!-- Perihal -->
            <div class="col-span-6 sm:col-span-4">
              <jet-label
                for="subject"
                value="Perihal" />
              <jet-input
                id="subject"
                v-model="form.subject"
                type="text"
                class="mt-1 block w-full"
                autocomplete="subject" />
              <jet-input-error
                :message="form.errors.subject"
                class="mt-2" />
            </div>

            <!-- Tanggal -->
            <div class="col-span-6 sm:col-span-4">
              <jet-label
                for="started_at"
                value="Tanggal" />
              <jet-input
                id="started_at"
                v-model="form.started_at"
                type="text"
                class="mt-1 block w-full"
                autocomplete="started_at" />
              <jet-input-error
                :message="form.errors.started_at"
                class="mt-2" />
            </div>

            <!-- Durasi Hari Kerja -->
            <div class="col-span-6 sm:col-span-4">
              <jet-label
                for="duration"
                value="Durasi Hari Kerja" />
              <jet-input
                id="duration"
                v-model="form.duration"
                type="text"
                class="mt-1 block w-full"
                autocomplete="duration" />
              <jet-input-error
                :message="form.errors.duration"
                class="mt-2" />
            </div>
          </template>


          <template #actions>
            <jet-action-message
              :on="form.recentlySuccessful"
              class="mr-3">
              Cuti berhasil diajukan.
            </jet-action-message>

            <jet-button
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing">
              Ajukan
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
  props: ['employee'],
  data() {
    return {
      form: this.$inertia.form({
        _method: 'POST',
        subject: null,
        started_at: null,
        duration: null,
      }),
    }
  },

  methods: {
    submit() {
      this.form.post(route('employees.furloughs.store', { employee: this.employee }), {
        preserveScroll: true,
        onSuccess: () => {
          this.form.subject = null
          this.form.started_at = null
          this.form.duration = null
        },
      });
    },
  },
}
</script>
