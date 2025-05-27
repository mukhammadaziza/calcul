<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
  loading_unloadings: Object
})

const addForm = ref(false);
const editForm = ref(false);


const loading_unloading_id = ref(null);
const loading_unloading_name = ref(null);
const loading_unloading_price = ref(null);

const data = useForm({
    loading_unloading_id: '',
    loading_unloading_name: '',
    loading_unloading_price: ''
})

const openAddForm = () => {
    addForm.value = true;
    loading_unloading_id.value = null;
    loading_unloading_name.value = null;
    loading_unloading_price.value = null;
}

const openEditForm = (loading_unloading) => {
    editForm.value = true;
    loading_unloading_id.value = loading_unloading.id; 
    loading_unloading_name.value = loading_unloading.name;
    loading_unloading_price.value = loading_unloading.price;
}

const add = () => {
    data.loading_unloading_name = loading_unloading_name.value;
    data.loading_unloading_price = loading_unloading_price.value;
    data.post('/loadings_unloadings', {
        onSuccess() {
            addForm.value = false;
        }
    });
}

const update = () => {
    data.loading_unloading_id = loading_unloading_id.value;
    data.loading_unloading_name = loading_unloading_name.value;
    data.loading_unloading_price = loading_unloading_price.value;
    data.put(`/loadings_unloadings/${loading_unloading_id.value}`, {
        onSuccess() {
            editForm.value = false;
        }
    });
}

const remove = (loading_unloading_id) => {
    data.delete(`/loadings_unloadings/${loading_unloading_id.id}`);
}


</script>

<template>
    <div class="p-8 text-xs">
        <p class="text-center text-xl">Погрузка-разгрузочные работы (ПРР)  </p>
        <p class="text-center">*Разгрузка погрузка расчитываеться штуками или кубами зависит от обьема.</p>
        <table>
          <thead>
            <tr>
              <th>Названия</th>
              <th>Цена</th>
              <th>Action</th>
            </tr>
          </thead>
          
          <tbody>
            <tr v-for="loading_unloading in loading_unloadings">
              <td>
                {{ loading_unloading.name }}
              </td>
              <td>
                {{ loading_unloading.price }}
              </td>
              <td>
                <button @click="openEditForm(loading_unloading)" class="mr-2">Редактировать</button>
                <button @click="remove(loading_unloading)">Удалит</button>
              </td>
            </tr>
            <tr v-if="addForm">
                <td><input v-model="loading_unloading_name" type="text" class="border p-1 w-full rounded" /></td>
                <td><input v-model="loading_unloading_price" type="number" class="border p-1 w-full rounded"/></td>
                <td>
                    <button @click="addForm = false" class="mr-2">Отмена</button>
                    <button @click="add()">Сохранить</button>
                </td>
            </tr>
            <tr v-if="editForm">
                <td><input v-model="loading_unloading_name" type="text" class="border p-1 w-full rounded" /></td>
                <td><input v-model="loading_unloading_price" type="number" class="border p-1 w-full rounded"/></td>
                <td>
                    <button @click="editForm = false" class="mr-2">Отмена</button>
                    <button @click="update()">Редактировать</button>
                </td>

            </tr>
          </tbody>
        </table>
        <button @click="openAddForm()" class="p-1 m-1 bg-blue-200">Добавить новую услугу</button>
     
        <!-- <div v-if="addForm" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white p-6 rounded w-full max-w-md shadow-xl z-50">
                <h2 class="text-lg font-semibold mb-4">Добавить новую услугу:</h2>

                <div class="mb-3">
                    <label class="block text-sm mb-1">Названия</label>
                    <input v-model="service_name" type="text" class="border p-2 w-full rounded" />
                </div>
                <div class="mb-3">
                    <label class="block text-sm mb-1">Цена</label>
                    <input v-model="service_price" type="number" class="border p-2 w-full rounded"/>
                </div>

                <div class="mt-4 flex justify-end gap-2">
                    <button @click="addForm = false" class="bg-gray-300 px-3 py-1 rounded">Отмена</button>
                    <button @click="add()" class="bg-green-500 text-white px-4 py-1 rounded">Сохранить</button>
                </div>
            </div>
        </div> -->

        <!-- <div v-if="editForm" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white p-6 rounded w-full max-w-md shadow-xl z-50">
                <h2 class="text-lg font-semibold mb-4">Edit:</h2>

                <div class="mb-3">
                    <label class="block text-sm mb-1">Названия</label>
                    <input v-model="service_name" type="text" class="border p-2 w-full rounded" />
                </div>
                <div class="mb-3">
                    <label class="block text-sm mb-1">Цена</label>
                    <input v-model="service_price" type="number" class="border p-2 w-full rounded"/>
                </div>

                <div class="mt-4 flex justify-end gap-2">
                    <button @click="editForm = false" class="bg-gray-300 px-3 py-1 rounded">Отмена</button>
                    <button @click="update()" class="bg-green-500 text-white px-4 py-1 rounded">Edit</button>
                </div>
            </div>
        </div> -->
    </div>
</template>
