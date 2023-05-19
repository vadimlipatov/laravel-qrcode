<template>
  <div class="w-2/3 mx-auto text-center">
    <h1 class="text-lg mb-4">Table</h1>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
          <tr>
            <th scope="col" class="px-6 py-3">ID</th>
            <th scope="col" class="px-6 py-3">Name</th>
            <th scope="col" class="px-6 py-3">Content</th>
            <th scope="col" class="px-6 py-3">Created</th>
            <th scope="col" class="px-6 py-3">Actions</th>
          </tr>
        </thead>
        <tbody v-if="contacts.length">
          <tr
            v-for="contact in contacts"
            :key="contact.id"
            class="bg-white border-b hover:bg-gray-50"
          >
            <th
              scope="row"
              class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
            >
              {{ contact.id }}
            </th>
            <td class="px-6 py-4">{{ contact.name }}</td>
            <td class="px-6 py-4">{{ contact.content }}</td>
            <td class="px-6 py-4">{{ contact.created_at }}</td>
            <td class="px-6 py-4">
              <button
                @click="printCertificate(contact)"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
              >
                Print
              </button>
            </td>
          </tr>
        </tbody>
        <tbody v-else>
          <p class="text-center p-2">No data..</p>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { defineEmits, inject } from "vue";

defineProps({
  contacts: { type: Array },
});
let { printCertificate } = inject("printCertificate");
</script>
