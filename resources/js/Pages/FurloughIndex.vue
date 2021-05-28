<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Daftar Cuti
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg sm:p-6 lg:p-8">
          <table class="w-full">
            <thead>
              <tr class="text-left">
                <th>Karyawan</th>
                <th>Perihal</th>
                <th>Mulai Tanggal</th>
                <th>Durasi</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="furlough in furloughs"
                class="">
                <td>{{ furlough.employee.name }}</td>
                <td>{{ furlough.subject }}</td>
                <td>{{ furlough.started_at }}</td>
                <td>{{ furlough.duration }} hari kerja</td>
                <td />
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
  components: {
    AppLayout,
  },
  props: ['furloughs'],
}
</script>
