<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
  storing_services: Object,
  work_types: Object
})

const addForm = ref(false);
const editForm = ref(false);

const storing_id = ref(null);
const storing_name = ref(null);
const storing_price = ref(null);
const work_type_id = ref(null);


const data = useForm({
    storing_id: '',
    work_type_id: '',
    storing_name: '',
    storing_price: ''
})

const openAddForm = () => {
    addForm.value = true;
    storing_id.value = null;
    storing_name.value = null;
    storing_price.value = null;
}

const openEditForm = (storing_service) => {
    editForm.value = true;
    storing_id.value = storing_service.id;
    storing_name.value = storing_service.service_name;
    service_price.value = storing_service.price;
}

const add = () => {
    data.work_type_id = work_type_id.value;
    data.storing_name = storing_name.value;
    data.storing_price = storing_price.value;
    data.post('/storings', {
        onSuccess() {
            addForm.value = false;
        }
    });
}


const update = () => {
    data.service_id = service_id.value;
    data.service_name = service_name.value;
    data.service_price = service_price.value;
    data.put(`/update_storing_service/${service_id.value}`, {
        onSuccess() {
            editForm.value = false;
        }
    });
}

const remove = (storing_service) => {
    data.delete(`/delete_storing_service/${storing_service.id}`);
}
</script>

<template>
    <div class="p-8 text-xs">
        <p class="text-center text-xl">Хранение </p>
        <p class="text-center">*Хранение расчитываеться автомотический исходя из габаритов товара которые тянуться по АПИ ключу исходя из габариты упаковки товара. При этом учитываеться только сами габариты товара паддон и внешная транспартировачная упаковка не береться в расчет.</p>
        <table>
          <thead>
            <tr>
              <th>Тип работы</th>
              <th>Названия</th>
              <th>Цена</th>
              <th>Action</th>
            </tr>
          </thead>
          
          <tbody>
            <tr v-for="storing_service in storing_services">
              <td>
                {{ storing_service.work_type['name'] }}
              </td>
              <td>
                {{ storing_service.service_name }}
              </td>
              <td>
                {{ storing_service.price }}
              </td>
              <td>
                <button @click="openEditForm(storing_service)">edit</button>
                <button @click="remove(storing_service)">delete</button>
              </td>
            </tr>
            <tr v-if="addForm">
                <td>
                    <select v-model="work_type_id">
                        <option  v-for="work_type in work_types" :value="work_type.id">
                            {{ work_type.name }}
                        </option>
                    </select>
                </td>
                <td>
                    <input v-model="service_name" type="text" class="border p-1 w-full rounded" />
                </td>
                <td>
                    <input v-model="service_price" type="number" class="border p-1 w-full rounded"/>
                </td>
                <td>
                    <button @click="addForm = false" class="mr-2">Отмена</button>
                    <button @click="add()">Сохранить</button>
                </td>
            </tr>
          </tbody>
        </table>
        <button @click="openAddForm()" class="p-1 m-1 bg-blue-200">Добавить новую услугу хранения</button>
     
        <!-- <div v-if="addForm" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white p-6 rounded w-full max-w-md shadow-xl z-50">
                <h2 class="text-lg font-semibold mb-4">Добавить новую услугу хранения:</h2>

                
                <select v-model="work_type_id">
                    <option  value="">Нет услуг</option>
                    <option  v-for="work_type in work_types" :value="work_type.id">
                        {{ work_type.name }}
                    </option>
                </select>
                    
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
        </div>
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