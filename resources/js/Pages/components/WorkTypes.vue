<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    work_types: Object
})

const addForm = ref(false);
const editForm = ref(false);


const work_type_id = ref(null);
const work_type_name = ref(null);

const data = useForm({
    work_type_id: '',
    work_type_name: ''
})

const openAddForm = () => {
    addForm.value = true;
    work_type_id.value = null;
    work_type_name.value = null;
}

const openEditForm = (work_type) => {
    editForm.value = true;
    work_type_id.value = work_type.id;
    work_type_name.value = work_type.name;
}

const add = () => {
    data.work_type_name = work_type_name.value;
    data.post('/work_types', {
        onSuccess() {
            addForm.value = false;
        }
    });
}

const update = () => {
    data.work_type_id = work_type_id.value;
    data.work_type_name = work_type_name.value;
    data.put(`/work_types/${work_type_id.value}`, {
        onSuccess() {
            editForm.value = false;
        }
    });
}

const remove = (work_type) => {
    data.delete(`/work_types/${work_type.id}`);
}

</script>

<template>
    <div class="p-8 text-xs">
        <p class="text-center text-xl">Тип работы</p>
        <table>
          <thead>
            <tr>
              <th>Названия</th>
              <th>Action</th>
            </tr>
          </thead>
          
          <tbody>
            <tr v-for="work_type in work_types">
              <td>
                {{ work_type.name }}
              </td>
              <td>
                <button @click="openEditForm(work_type)">Редактировать/</button>
                <button @click="remove(work_type)">Удалит</button>
              </td>
            </tr>

            <tr v-if="addForm">
              <td>
                <input v-model="work_type_name" type="text" class="border p-1 w-full rounded" />
              </td>
              <td>
                <button @click="addForm = false" class="mr-2">Отмена</button>
                <button @click="add()">Сохранить</button>
              </td>
            </tr>

            <tr v-if="editForm">
              <td>
                <input v-model="work_type_name" type="text" class="border p-1 w-full rounded" />
              </td>
              <td>
                <button @click="editForm = false" class="mr-2">Отмена</button>
                <button @click="update()">Сохранить</button>
              </td>
            </tr>
          </tbody>
        </table>
        <button @click="openAddForm()" class="p-1 m-1 bg-blue-200">Добавить</button>
     
        <!-- <div v-if="addForm" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white p-6 rounded w-full max-w-md shadow-xl z-50">
                <h2 class="text-lg font-semibold mb-4">Добавить новую упаковочные матерал:</h2>

                <div class="mb-3">
                    <label class="block text-sm mb-1">Названия</label>
                    <input v-model="service_name" type="text" class="border p-2 w-full rounded" />
                </div>

                <div class="mt-4 flex justify-end gap-2">
                    <button @click="addForm = false" class="bg-gray-300 px-3 py-1 rounded">Отмена</button>
                    <button @click="add()" class="bg-green-500 text-white px-4 py-1 rounded">Сохранить</button>
                </div>
            </div>
        </div>

        <div v-if="editForm" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
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

<!-- <style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #ece5e5;
    }
</style> -->