<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
  logistics_warehouses: Object,
  work_types: Object
})

const addForm = ref(false);
const editForm = ref(false);

const logistics_warehouse_id = ref(null);
const warehouse_name = ref(null);
const value_0 = ref(null);
const value_1 = ref(null);
const value_2 = ref(null);
const value_3 = ref(null);
const value_4 = ref(null);
const value_5 = ref(null);
const value_6 = ref(null);
const value_7 = ref(null);
const value_8 = ref(null);
const value_9 = ref(null);
const value_10 = ref(null);
const work_type_id = ref(null);


const data = useForm({
    logistics_warehouse_id: '',
    work_type_id: '',
    warehouse_name: '',
    value_0: '',
    value_1: '',
    value_2: '',
    value_3: '',
    value_4: '',
    value_5: '',
    value_6: '',
    value_7: '',
    value_8: '',
    value_9: '',
    value_10: '',
})

const openAddForm = () => {
    addForm.value = true;
    logistics_warehouse_id.value = null;
    warehouse_name.value = null;
    work_type_id.value = null;
    value_0.value = null;
    value_1.value = null;
    value_2.value = null;
    value_3.value = null;
    value_4.value = null;
    value_5.value = null;
    value_6.value = null;
    value_7.value = null;
    value_8.value = null;
    value_9.value = null;
    value_10.value = null;
}

const openEditForm = (logistics_warehouse) => {
    editForm.value = true;
    logistics_warehouse_id.value = logistics_warehouse.id;
    warehouse_name.value = logistics_warehouse.warehouse_name;
    value_0.value = logistics_warehouse.value_0;
    value_1.value = logistics_warehouse.value_1;
    value_2.value = logistics_warehouse.value_2;
    value_3.value = logistics_warehouse.value_3;
    value_4.value = logistics_warehouse.value_4;
    value_5.value = logistics_warehouse.value_5;
    value_6.value = logistics_warehouse.value_6;
    value_7.value = logistics_warehouse.value_7;
    value_8.value = logistics_warehouse.value_8;
    value_9.value = logistics_warehouse.value_9;
    value_10.value = logistics_warehouse.value_10;
}

const add = () => {
    data.work_type_id = work_type_id.value;
    data.warehouse_name = warehouse_name.value;
    data.value_0 = value_0.value;
    data.value_1 = value_1.value;
    data.value_2 = value_2.value;
    data.value_3 = value_3.value;
    data.value_4 = value_4.value;
    data.value_5 = value_5.value;
    data.value_6 = value_6.value;
    data.value_7 = value_7.value;
    data.value_8 = value_8.value;
    data.value_9 = value_9.value;
    data.value_10 = value_10.value;
    data.post('/logistics_warehouses', {
        onSuccess() {
            addForm.value = false;
        }
    });
}

const update = () => {
    data.logistics_warehouse_id = logistics_warehouse_id.value;
    data.warehouse_name = warehouse_name.value;
    data.value_0 = value_0.value;
    data.value_1 = value_1.value;
    data.value_2 = value_2.value;
    data.value_3 = value_3.value;
    data.value_4 = value_4.value;
    data.value_5 = value_5.value;
    data.value_6 = value_6.value;
    data.value_7 = value_7.value;
    data.value_8 = value_8.value;
    data.value_9 = value_9.value;
    data.value_10 = value_10.value;
    data.put(`/logistics_warehouses/${logistics_warehouse_id.value}`, {
        onSuccess() {
            editForm.value = false;
        }
    });
}

const remove = (logistics_warehouse_id) => {
    data.delete(`/logistics_warehouses/${logistics_warehouse_id.id}`);
}

</script>

<template>
    <div class="p-8 text-xs">
        <p class="text-center text-xl">Логистика Забор/доставка на склады маркетплейса  </p>
        <p class="text-center">*1 а не более 250 кг привышение веса ы стоимость умножается на 2 </p>
        <table>
          <thead>
            <tr>
              <th>Тип работы</th>
              <th>Склады</th>
              <th>0</th>
              <th>1</th>
              <th>2</th>
              <th>3</th>
              <th>4</th>
              <th>5</th>
              <th>6</th>
              <th>7</th>
              <th>8</th>
              <th>9</th>
              <th>10</th>
              <th>Action</th>
            </tr>
          </thead>
          
          <tbody>
            <tr v-for="logistics_warehouse in logistics_warehouses">
              <td>
                {{ logistics_warehouse.work_type['name'] }}
              </td>
              <td>
                {{ logistics_warehouse.warehouse_name }}
              </td>
              <td>
                {{ logistics_warehouse.value_0  }}
              </td>
              <td>
                {{ logistics_warehouse.value_1  }}
              </td>
              <td>
                {{ logistics_warehouse.value_2  }}
              </td>
              <td>
                {{ logistics_warehouse.value_3  }}
              </td>
              <td>
                {{ logistics_warehouse.value_4  }}
              </td>
              <td>
                {{ logistics_warehouse.value_5  }}
              </td>
              <td>
                {{ logistics_warehouse.value_6  }}
              </td>
              <td>
                {{ logistics_warehouse.value_7  }}
              </td>
              <td>
                {{ logistics_warehouse.value_8  }}
              </td>
              <td>
                {{ logistics_warehouse.value_9  }}
              </td>
              <td>
                {{ logistics_warehouse.value_10  }}
              </td>

              <td>
                <button @click="openEditForm(logistics_warehouse)" class="mr-2">Редактировать</button>
                <button @click="remove(logistics_warehouse)">Удалит</button>
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
                <input v-model="warehouse_name" type="text" class="border p-1 w-full rounded" />
              </td>
              <td>
                <input v-model="value_0" type="number" class="border p-1 w-full rounded" />
              </td>
              <td>
                <input v-model="value_1" type="number" class="border p-1 w-full rounded" />
              </td>
              <td>
                <input v-model="value_2" type="number" class="border p-1 w-full rounded" />
              </td>
              <td>
                <input v-model="value_3" type="number" class="border p-1 w-full rounded" />
              </td>
              <td>
                <input v-model="value_4" type="number" class="border p-1 w-full rounded" />
              </td>
              <td>
                <input v-model="value_5" type="number" class="border p-1 w-full rounded" />
              </td>
              <td>
                <input v-model="value_6" type="number" class="border p-1 w-full rounded" />
              </td>
              <td>
                <input v-model="value_7" type="number" class="border p-1 w-full rounded" />
              </td>
              <td>
                <input v-model="value_8" type="number" class="border p-1 w-full rounded" />
              </td>
              <td>
                <input v-model="value_9" type="number" class="border p-1 w-full rounded" />
              </td>
              <td>
                <input v-model="value_10" type="number" class="border p-1 w-full rounded" />
              </td>
              <td>
                <button @click="addForm = false" class="mr-2">Отмена</button>
                <button @click="add()">Сохранить</button>
              </td>
            </tr>


            <tr v-if="editForm">
              <td>
                  <!-- work type -->
              </td>
              <td>
                <input v-model="warehouse_name" type="text" class="border p-1 w-full rounded" />
              </td>
              <td>
                <input v-model="value_0" type="number" class="border p-1 w-full rounded" />
              </td>
              <td>
                <input v-model="value_1" type="number" class="border p-1 w-full rounded" />
              </td>
              <td>
                <input v-model="value_2" type="number" class="border p-1 w-full rounded" />
              </td>
              <td>
                <input v-model="value_3" type="number" class="border p-1 w-full rounded" />
              </td>
              <td>
                <input v-model="value_4" type="number" class="border p-1 w-full rounded" />
              </td>
              <td>
                <input v-model="value_5" type="number" class="border p-1 w-full rounded" />
              </td>
              <td>
                <input v-model="value_6" type="number" class="border p-1 w-full rounded" />
              </td>
              <td>
                <input v-model="value_7" type="number" class="border p-1 w-full rounded" />
              </td>
              <td>
                <input v-model="value_8" type="number" class="border p-1 w-full rounded" />
              </td>
              <td>
                <input v-model="value_9" type="number" class="border p-1 w-full rounded" />
              </td>
              <td>
                <input v-model="value_10" type="number" class="border p-1 w-full rounded" />
              </td>
              <td>
                <button @click="editForm = false" class="mr-2">Отмена</button>
                <button @click="update()">Редактировать</button>
              </td>
            </tr>
          </tbody>
        </table>
        <button @click="openAddForm()" class="p-1 m-1 bg-blue-200">Добавить новую услугу хранения</button>
     
        <!-- <div v-if="addForm" class="bg-black bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-6 rounded w-full max-w-md shadow-xl z-50">
                <h2 class="text-lg font-semibold mb-4">Добавить новую услугу хранения:</h2>

                <div class="mb-3">
                    <label class="block text-sm mb-1">Названия</label>
                    <input v-model="warehouse_name" type="text" class="border p-2 w-full rounded" />
                </div>
                <div class="mb-3">
                    <label class="block text-sm mb-1">Цена 0</label>
                    <input v-model="value_0" type="number" class="border p-2 w-full rounded"/>
                </div>
                <div class="mb-3">
                    <label class="block text-sm mb-1">Цена 1</label>
                    <input v-model="value_1" type="number" class="border p-2 w-full rounded"/>
                </div>
                <div class="mb-3">
                    <label class="block text-sm mb-1">Цена 2</label>
                    <input v-model="value_2" type="number" class="border p-2 w-full rounded"/>
                </div>
                <div class="mb-3">
                    <label class="block text-sm mb-1">Цена 3</label>
                    <input v-model="value_3" type="number" class="border p-2 w-full rounded"/>
                </div>
                <div class="mb-3">
                    <label class="block text-sm mb-1">Цена 4</label>
                    <input v-model="value_4" type="number" class="border p-2 w-full rounded"/>
                </div>
                <div class="mb-3">
                    <label class="block text-sm mb-1">Цена 5</label>
                    <input v-model="value_5" type="number" class="border p-2 w-full rounded"/>
                </div>
                <div class="mb-3">
                    <label class="block text-sm mb-1">Цена 6</label>
                    <input v-model="value_6" type="number" class="border p-2 w-full rounded"/>
                </div>
                <div class="mb-3">
                    <label class="block text-sm mb-1">Цена 7</label>
                    <input v-model="value_7" type="number" class="border p-2 w-full rounded"/>
                </div>
                <div class="mb-3">
                    <label class="block text-sm mb-1">Цена 8</label>
                    <input v-model="value_8" type="number" class="border p-2 w-full rounded"/>
                </div>
                <div class="mb-3">
                    <label class="block text-sm mb-1">Цена 9</label>
                    <input v-model="value_9" type="number" class="border p-2 w-full rounded"/>
                </div>
                <div class="mb-3">
                    <label class="block text-sm mb-1">Цена 10</label>
                    <input v-model="value_10" type="number" class="border p-2 w-full rounded"/>
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