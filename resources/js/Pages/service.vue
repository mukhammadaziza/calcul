<script setup>

import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  services: Object
})

const changeServiceForm = ref(false);
const serviceName = ref(null);

const changeService = (service) => {
  serviceName.value = service.name; 
  changeServiceForm.value = true;
}

const data = useForm({
  newServiceName: ''
})

const changeServiceName = () => {
  data.newServiceName = serviceName.value;

  console.log(data.newServiceName);
}
const newForm = ref(false);
const newPrName = ref(null);




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
    <div v-for="service in services">
      <button @click="changeService(service)">{{ service.name }}</button>
    </div>
    <div v-if="changeServiceForm">
      <input v-model="serviceName"  type="text" class="border border-blue-500">
      <button @click="changeServiceName()">Save</button>
    </div>
    
  </div>
</template>