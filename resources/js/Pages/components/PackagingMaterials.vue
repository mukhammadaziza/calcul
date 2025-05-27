<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    packaging_materials: Object,
    work_types: Object
})

const addForm = ref(false);
const editForm = ref(false);

const packaging_material_id = ref(null);
const packaging_material_name = ref(null);
const packaging_material_price = ref(null);
const work_type_id = ref(null);

const data = useForm({
    packaging_material_id: '',
    work_type_id: '',
    packaging_material_name: '',
    packaging_material_price: ''
})

const openAddForm = () => {
    addForm.value = true;
    packaging_material_id.value = null;
    packaging_material_name.value = null;
    packaging_material_price.value = null;
}

const openEditForm = (packaging_material) => {
    editForm.value = true;
    packaging_material_id.value = packaging_material.id;
    packaging_material_name.value = packaging_material.name;
    packaging_material_price.value = packaging_material.price;
}

const add = () => {
    data.packaging_material_id = packaging_material_id.value;
    data.work_type_id = work_type_id.value;
    data.packaging_material_name = packaging_material_name.value;
    data.packaging_material_price = packaging_material_price.value;
    data.post('/packaging_materials', {
        onSuccess() {
            addForm.value = false;
        }
    });
}

const update = () => {
    data.packaging_material_id = packaging_material_id.value;
    data.packaging_material_name = packaging_material_name.value;
    data.packaging_material_price = packaging_material_price.value;
    data.put(`/packaging_materials/${packaging_material_id.value}`, {
        onSuccess() {
            editForm.value = false;
        }
    });
}

const remove = (packaging_material_id) => {
    data.delete(`/packaging_materials/${packaging_material_id.id}`);
}

</script>

<template>
    <div class="p-8 text-xs">
        <p class="text-center text-xl">Упаковочные матералы</p>
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
            
            <tr v-for="packaging_material in packaging_materials">
              <td>
                {{ packaging_material.work_type['name'] }}
              </td>
              <td>
                {{ packaging_material.name }}
              </td>
              <td>
                {{ packaging_material.price }}
              </td>
              <td>
                <button @click="openEditForm(packaging_material)" class="mr-2">Редактировать</button>
                <button @click="remove(packaging_material)">Удалит</button>
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
                    <input v-model="packaging_material_name" type="text" class="border p-1 w-full rounded" />
                </td>
                <td>
                    <input v-model="packaging_material_price" type="number" class="border p-1 w-full rounded"/>
                </td>
                <td>
                    <button @click="addForm = false" class="mr-2">Отмена</button>
                    <button @click="add()">Сохранить</button>
                </td>
            </tr>

            <tr v-if="editForm">
                <td></td>
                <td>
                    <input v-model="packaging_material_name" type="text" class="border p-1 w-full rounded" />
                </td>
                <td>
                    <input v-model="packaging_material_price" type="number" class="border p-1 w-full rounded"/>
                </td>
                <td>
                    <button @click="editForm = false" class="mr-2">Отмена</button>
                    <button @click="update()">Редактировать</button>
                </td>
            </tr>

          </tbody>
        </table>
        <button @click="openAddForm()" class="p-1 m-1 bg-blue-200">Добавить новую упаковочные матералы </button>
     
        <!-- <div v-if="addForm" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white p-6 rounded w-full max-w-md shadow-xl z-50">
                <h2 class="text-lg font-semibold mb-4">Добавить новую упаковочные матерал:</h2>

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