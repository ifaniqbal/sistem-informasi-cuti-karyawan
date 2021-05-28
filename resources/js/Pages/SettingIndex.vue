<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Pengaturan
      </h2>
    </template>

    <div>
      <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <jet-form-section @submitted="submit">
          <template #title>
            Total Maksimal Cuti
          </template>

          <template #description>
            Total cuti maksimal per tahun.
          </template>

          <template #form>
            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
              <jet-label
                for="max_annual_furlough"
                value="Total Maksimal Cuti" />
              <jet-input
                id="max_annual_furlough"
                v-model="form.max_annual_furlough"
                type="text"
                class="mt-1 block w-full"
                autocomplete="max_annual_furlough" />
              <jet-input-error
                :message="form.errors.max_annual_furlough"
                class="mt-2" />
            </div>
          </template>

          <template #actions>
            <jet-action-message
              :on="form.recentlySuccessful"
              class="mr-3">
              Pengaturan disimpan.
            </jet-action-message>

            <jet-button
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing">
              Simpan
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
  props: ['maxAnnualFurlough'],
  data() {
    return {
      form: this.$inertia.form({
        _method: 'POST',
        max_annual_furlough: this.maxAnnualFurlough,
      }),
    }
  },

  methods: {
    submit() {
      this.form.post(route('settings.store'), {
        preserveScroll: true,
        onSuccess: () => {},
      });
    },
  },
}
</script>
