<template>
  <Head title="Bitrix" />

  <GuestLayout>
    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
        Fill Contacts from Bitrix
      </h2>
      <div class="flex items-center pt-4 pb-2">
        <div style="margin-right: 20px">
          <InputLabel value="From Id"> </InputLabel>
          <input
            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
            type="text"
            id="text"
            name="text"
          />
        </div>
        <div>
          <InputLabel value="To Id"> </InputLabel>
          <input
            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
            type="text"
            id="text"
            name="text"
          />
        </div>
      </div>
      <div class="flex content-center justify-center pt-2">
        <Spinner v-if="loading" />
        <p v-else class="flex content-center justify-center pt-2">
          Total : {{ total }}, Now: {{ now }}
        </p>
      </div>
      <div class="text-center p-2" id="btn">
        <button
          @click="getAllData"
          class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
        >
          Go
        </button>
      </div>
    </div>
  </GuestLayout>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import Spinner from "@/Components/Spinner.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { ref, onMounted, watch } from "vue";
import axios from "axios";

let total = ref(0);
let now = ref(0);
let loading = ref(false);
let fromID = ref(0);
let toID = ref(500);

onMounted(() => {
  // loading.value = true;
  // // add contact from BX24
  // axios.get("api/contacts/bitrix").then((res) => {
  //   total.value = res.data.total;
  //   now.value = res.data.now;
  //   loading.value = false;
  //   console.log(res);
  // });
});
function getAllData() {
  fromID.value += 500;
  toID.value += 500;
  axios
    .post("api/contacts/bitrix", {
      fromID: fromID.value,
      toID: toID.value,
    })
    .then((res) => {
      total.value = res.data.total;
      now.value = res.data.now;
      if (res.data.now < res.data.total) {
        getAllData();
      }
      loading.value = false;
      console.log(res);
    });
}
</script>
<style></style>
