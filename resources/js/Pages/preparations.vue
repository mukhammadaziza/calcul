<script setup>

import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
  product_preparations: Object
})

const newForm = ref(false);
const newPrName = ref(null);

const data = useForm({
    newPrName: ''
})


const openForm = () => {
    newForm.value = true;
}

const submit = () => {
    data.newPrName = newPrName.value;
    data.post('/store_new_preparation');
}
</script>

<template>
  <div>
    <div v-for="product_preparation in product_preparations">
      <button>{{ product_preparation.name }}</button>
    </div>
    <button @click="openForm()">New preparation</button>
    <input v-if="newForm" type="text" v-model="newPrName">
    <button @click="submit()">Save</button>
  </div>
</template>
