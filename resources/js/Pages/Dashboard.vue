<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
        QR Code
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex justify-between"
        >
          <div class="p-6 text-gray-900">
            <Spinner v-if="loading" />
            <video width="200" id="preview" src=""></video>
          </div>
          <div class="flex items-center p-6">
            <div class="" id="print">
              <template v-if="contact.name">
                <p>{{ contact.name }}</p>
                <p>{{ contact.lastName }}</p>
              </template>
              <template v-else>
                <p>Имя</p>
                <p>Фамилия</p>
              </template>
              <p>Название билета</p>
              <p class="pt-2" id="btn">
                <button
                  @click="printCertificate(contact)"
                  class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                >
                  Print
                </button>
              </p>
            </div>
          </div>
          <div class="flex items-center p-6">
            <InputLabel value="Scanner"> </InputLabel>
            <input
              class="ml-4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
              type="text"
              id="text"
              name="text"
              readonly
            />
          </div>
        </div>
      </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-8">
        <Table :contacts="contacts" />
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Table from "@/Components/Table.vue";
import Spinner from "@/Components/Spinner.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { ref, onMounted, watch, provide } from "vue";
import axios from "axios";

let contact = ref({});
let contacts = ref([]);
let qrcode = ref("");
let loading = ref(true);

defineProps({
  canLogin: {
    type: Boolean,
  },
  canRegister: {
    type: Boolean,
  },
  laravelVersion: {
    type: String,
    required: true,
  },
  phpVersion: {
    type: String,
    required: true,
  },
});

function printCertificate(contact) {
  const app = document.getElementById("app");
  // создание верстки
  const div = document.createElement("div");
  const firstName = document.createElement("p");
  firstName.textContent = contact.name;
  document.body.before(firstName);
  div.append(firstName);
  const lastName = document.createElement("p");
  lastName.textContent = contact.lastName;
  div.append(lastName);
  const ticket = document.createElement("p");
  ticket.textContent = "Название билета";
  div.append(ticket);

  document.body.before(div);

  app.style.visibility = "hidden";
  window.print();
  setTimeout(() => {
    div.remove();
    app.style.visibility = "visible";
  }, 100);
}
provide("printCertificate", {
  printCertificate,
});

watch(qrcode, (val) => {
  axios.get("api/contacts").then((res) => {
    contacts.value = res.data;
    console.log(res.data);
  });
});

setInterval(() => {
  axios.get("api/contacts").then((res) => {
    contacts.value = res.data;
  });
}, 5000);

onMounted(() => {
  axios.get("api/contacts").then((res) => {
    contacts.value = res.data;
    console.log(res);
  });

  let scanner = new Instascan.Scanner({
    video: document.getElementById("preview"),
  });

  Instascan.Camera.getCameras()
    .then(function (cameras) {
      if (cameras.length > 0) {
        scanner.start(cameras[0]);
        loading.value = false;
      } else {
        alert("No cameras");
        loading.value = false;
      }
    })
    .catch(function (e) {
      console.error(e);
    });

  scanner.addListener("scan", function (newCode) {
    qrcode.value = newCode;
    const oldCode = document.getElementById("text").value;
    document.getElementById("text").value = newCode;
    if (newCode !== oldCode) {
      axios
        // .post("https://market.sotnikov.studio/vadim/qrcode/contacts.php", {
        .post("api/contacts", {
          id: newCode,
        })
        .then((res) => {
          contact.value = res.data;
          console.log(res.data);
          printCertificate(contact.value);
        });
    }
  });
});
</script>
<style></style>
