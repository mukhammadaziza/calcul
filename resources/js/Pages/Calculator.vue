<script setup>
import { ref, watch, reactive } from 'vue';

const props = defineProps({
  services: Object,
  storing_services: Object,
  packaging_materials: Object,
  packaging_materials_box_pallet: Object,
  loading_unloadings: Object,
  logistics_warehouses: Object,
  product_preparation_dimensions: Object,
  product_preparation_names: Array,
  work_types: Object
})


const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const numberOfUnits = ref(null);
const lenght = ref(null);
const height = ref(null);
const width = ref(null);
const sumOfSides = ref(null);
const m3 = ref(null);
const volume = ref(null);
const loading_unloading_service = ref('');
const sumOfService = ref(null);
const numberOfPlaces = ref(null);
const loading_unloading_service_price = ref(null);
const loading_unloading_service_price_after_discount = ref('');
const box_60_40_40 = ref(null);
const pallet = ref(null);
const numberOfWarehouse = ref(0);
const wareHousePrice = ref(null);
const discountMap = reactive({});


const WorkTypesBeforeDiscount = ref(null);
const WorkTypesAfterDiscount = ref(null);
const storedValuesArray = ref([]);
const workTypesArray = ref([]);



function getPriceAfterDiscount(work_type_id) {
  const total = getTotalPriceForWorkType(work_type_id);
  const discount = discountMap[work_type_id] || 0;
  return total - (total * discount / 100);
}



const calculateQuantity = (index, volume) => {
  if (index === 0) {
    const value = Math.ceil(volume/0.096);
    box_60_40_40.value = value;
    return value;
  } else {
    const value = Math.ceil(volume/1.73);
    pallet.value = value;
    return value;
  }
};


function getSumm(numberOfUnits, price){
    return sumOfService.value = numberOfUnits * price;
}

function getSummBoxPallet(numberOfUnits, price){
    return sumOfService.value = numberOfUnits * price;
}

function getSummStoring(volume, price){
  return sumOfService.value = volume * price
}


const getPriceForDimension = (product_preparation_name) => {
  const sum = parseFloat(sumOfSides.value);


  const dimension_array = product_preparation_name.dimensions
    .map(d => d.product_dimension)
    .sort((a, b) => a - b);


  const matchDimension = dimension_array.find(d => d >= sum);

  if (!matchDimension) {
    return null;
  }


  const match = product_preparation_name.dimensions.find(
    d => d.product_dimension === matchDimension
  );

  return match ? match.pivot.value : null;
};




watch([width, height, lenght, numberOfUnits], () => {
    
    if (height.value && width.value && lenght.value) {
        sumOfSides.value = height.value + width.value + lenght.value;
        m3.value = (height.value * width.value * lenght.value)/1000000;
        volume.value = numberOfUnits.value * m3.value;
    };

})


watch([numberOfPlaces, loading_unloading_service], () => {
    loading_unloading_service_price.value = numberOfPlaces.value * loading_unloading_service.value;
})




const warehouseQuantities = reactive({});


if (props.logistics_warehouses) {
  props.logistics_warehouses.forEach(warehouse => {
    warehouseQuantities[warehouse.id] = null;
  });
}



function getPrice(warehouse, quantityIndex) {

  if (quantityIndex === null || quantityIndex === undefined) {
    return 0;
  }
  

  const index = Number(quantityIndex);
  if (isNaN(index) || index < 0 || index > 10) {
    return 0;
  }
  

  const valueProp = `value_${index}`;
  if (warehouse && warehouse[valueProp] !== undefined) {
    return warehouse[valueProp];
  }
  
  return 0;
}


function getTotal(warehouse, quantityIndex) {
  return getPrice(warehouse, quantityIndex);
}





function getTotalPriceForWorkType(work_type_id){
  const result = storedValuesArray.value.filter((element) => element.work_type == work_type_id);

  let summall = 0;
  result.forEach((element) => summall = summall + element.summ);

  return summall;
}



function addAdditonalData(){
    storedValuesArray.value.push({
        numberOfUnits: numberOfUnits.value,
        sumOfSides: sumOfSides.value,
        volume: volume.value
    })
}






watch(workTypesArray, () => {

  const summOfWorkTypes = workTypesArray.value.map((element) => element.summ);
  const summOfWorkTypesAfterDis = workTypesArray.value.map((element) => element.summAfterDiscount);

  const total = summOfWorkTypes.reduce((accumulator, currentValue) => accumulator + currentValue, 0);
  const afterDiscount = summOfWorkTypesAfterDis.reduce((accumulator, currentValue) => accumulator + currentValue, 0);

  WorkTypesBeforeDiscount.value = total;
  WorkTypesAfterDiscount.value = afterDiscount;

})


</script>




<template>
  <div class="p-8 text-xs">
    <div>
        <p class="text-center text-xl">Калькулятор услуг </p>

        <table>
            <thead>
                <tr>
                    <th colspan="2">Погрузка-разгрузочные работы (ПРР)</th>
                    <th colspan="6">Габариты товара</th>
                    <th rowspan="2">Количество Едениц</th>
                    <th rowspan="2">Количество мест</th>
                </tr>
                <tr>
                    <th>услуг</th>
                    <th>Цена</th>
                    <th>Длина</th>
                    <th>Высота</th>
                    <th>Ширина</th>
                    <th>Сумма 3x сторон</th>
                    <th>Обьем, куб</th>
                    <th>m 3</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select v-model="loading_unloading_service">
                            <option  value="">Нет услуг</option>
                            <option  v-for="loading_unloading in loading_unloadings" :value="loading_unloading.price">
                                {{ loading_unloading.name }}, 
                                {{ loading_unloading.price }}
                            </option>
                        </select>
                    </td>
                    <td><input v-model="loading_unloading_service_price" class="border border-blue-200" type="number"></td>
                    <td><input v-model="lenght" class="border border-blue-200" type="number"></td>
                    <td><input v-model="height" class="border border-blue-200" type="number"></td>
                    <td><input v-model="width" class="border border-blue-200" type="number"></td>
                    <td><input v-model="sumOfSides" class="border border-blue-200"></td>
                    <td><input v-model="volume" class="border border-blue-200" type="number"></td>
                    <td><input v-model="m3" class="border border-blue-200"></td>
                    <td><input v-model="numberOfUnits" class="border border-blue-200"></td>
                    <td><input v-model="numberOfPlaces" class="border border-blue-200"></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="mt-12">
        <table>
            <thead>
                <tr>
                    <th colspan="2"></th>
                    <th colspan="4">Автоматический ввод</th>
                    <th colspan="4">Ручной ввод</th>
                    <th rowspan="2">Разница расчетов</th>
                </tr>
                <tr>
                    <th>Тип работ</th>
                    <th>Виды работ</th>
                    <th>Выбор</th>
                    <th>Количество</th>
                    <th>Цена единицы/ Тариф</th>
                    <th>Общая сумма</th>
                    <th>Выбор</th>
                    <th>Количество</th>
                    <th>Цена единицы/Тариф</th>
                    <th>Общая сумма</th>
                </tr>
            </thead>
            <tbody>

                <tr v-for="product_preparation_name in product_preparation_names" :key="product_preparation_name.id">
                      <td>{{ product_preparation_name.work_type['name'] ? product_preparation_name.work_type['name'] : '' }}</td>
                      <td>{{ product_preparation_name.name }},</td>
                      <td><input v-model="storedValuesArray" type="checkbox" 
                              :value="{ 
                                  id: product_preparation_name.id, 
                                  name: product_preparation_name.name, 
                                  units: numberOfUnits, 
                                  price: getPriceForDimension(product_preparation_name), 
                                  summ: getSumm(numberOfUnits, getPriceForDimension(product_preparation_name)),
                                  work_type: product_preparation_name.work_type['id']  }"></td>
                      <td>{{ numberOfUnits }}</td>
                      <td>{{ getPriceForDimension(product_preparation_name) }}</td>
                      <td>{{ getSumm(numberOfUnits, getPriceForDimension(product_preparation_name)) }}</td>
                      <td><input @click="" v-model="storedValuesArray" type="checkbox"></td>
                      <td><input type="number" value="0"></td>
                      <td><input type="number" value="0"></td>
                      <td><input type="number" readonly value="0"></td>
                      <td><input type="number" readonly value="0"></td>
                </tr>
                <tr v-for="(packaging_material_box_pallet, index) in packaging_materials_box_pallet" :key="packaging_material_box_pallet.id">
                    <td>{{ packaging_material_box_pallet.work_type['name'] }}</td>
                    <td>{{ packaging_material_box_pallet.name }}</td>
                    <td><input v-model="storedValuesArray" type="checkbox" 
                            :value="{ 
                                id: packaging_material_box_pallet.id, 
                                name: packaging_material_box_pallet.name, 
                                units: calculateQuantity(index, volume), 
                                price: packaging_material_box_pallet.price, 
                                summ: getSummBoxPallet(calculateQuantity(index, volume), packaging_material_box_pallet.price),
                                work_type: packaging_material_box_pallet.work_type['id']  }"></td>
                    <td>{{ calculateQuantity(index, volume) }}</td>
                    <td>{{ packaging_material_box_pallet.price }}</td>
                    <td>{{ getSummBoxPallet(calculateQuantity(index, volume), packaging_material_box_pallet.price) }}</td>
                    <td><input @click="" v-model="storedValuesArray" type="checkbox"></td>
                    <td><input type="number" value="0"></td>
                    <td><input type="number" value="0"></td>
                    <td><input type="number" readonly value="0"></td>
                    <td><input type="number" readonly value="0"></td>
                </tr>
                <tr v-for="packaging_material in packaging_materials" :key="packaging_material.id">
                    <td>{{ packaging_material.work_type?.name ?? '' }}</td>
                    <td>{{ packaging_material.name }}</td>
                    <td><input v-model="storedValuesArray" type="checkbox" 
                            :value="{ 
                                id: packaging_material.id, 
                                name: packaging_material.name, 
                                units: numberOfUnits, 
                                price: packaging_material.price, 
                                summ: getSumm(numberOfUnits, packaging_material.price),
                                work_type: packaging_material.work_type?.id || null }"></td>
                    <td>{{ numberOfUnits }}</td>
                    <td>{{ packaging_material.price }}</td>
                    <td>{{ getSumm(numberOfUnits, packaging_material.price) }}</td>
                    <td><input @click="" v-model="storedValuesArray" type="checkbox"></td>
                    <td><input type="number" value="0"></td>
                    <td><input type="number" value="0"></td>
                    <td><input type="number" readonly value="0"></td>
                    <td><input type="number" readonly value="0"></td>
                </tr>
                <tr v-for="storing_service in storing_services" :key="storing_service.id">
                    <td>{{ storing_service.work_type['name'] }}</td>
                    <td>{{ storing_service.service_name }}</td>
                    <td><input v-model="storedValuesArray" type="checkbox" 
                            :value="{ 
                                id: storing_service.id, 
                                name: storing_service.service_name, 
                                units: volume, 
                                price: storing_service.price, 
                                summ: getSummStoring(volume, storing_service.price),
                                work_type: storing_service.work_type['id']  }"></td>
                    <td>{{ volume }}</td>
                    <td>{{ storing_service.price }}</td>
                    <td>{{ getSummStoring(volume, storing_service.price) }}</td>
                    <td><input @click="" v-model="storedValuesArray" type="checkbox"></td>
                    <td><input type="number" value="0"></td>
                    <td><input type="number" value="0"></td>
                    <td><input type="number" readonly value="0"></td>
                    <td><input type="number" readonly value="0"></td>
                </tr>
                <tr v-for="logistics_warehouse in logistics_warehouses" :key="logistics_warehouse.id">
                  <td>{{ logistics_warehouse.work_type['name'] }}</td>
                  <td>{{ logistics_warehouse.warehouse_name }}</td>
                  <td>
                    <input v-model="storedValuesArray" type="checkbox"
                      :value="{
                        id: logistics_warehouse.id,
                        name: logistics_warehouse.warehouse_name,
                        units: warehouseQuantities[logistics_warehouse.id],
                        price: getPrice(logistics_warehouse, warehouseQuantities[logistics_warehouse.id]),
                        summ: getTotal(logistics_warehouse, warehouseQuantities[logistics_warehouse.id]),
                        work_type: logistics_warehouse.work_type['id'] }">
                  </td>
                  <!-- Each warehouse has its own quantity input -->
                  <td>
                    <input v-model.number="warehouseQuantities[logistics_warehouse.id]" 
                          type="number" min="0" max="10"
                          placeholder="0-10">
                  </td>
                  <!-- Price lookup based on the quantity value directly from props -->
                  <td>{{ getPrice(logistics_warehouse, warehouseQuantities[logistics_warehouse.id]) }}</td>
                  <td>{{ getTotal(logistics_warehouse, warehouseQuantities[logistics_warehouse.id]) }}</td>
                  <td>
                    <input type="checkbox">
                  </td>
                  <td><input type="number" value="0"></td>
                  <td><input type="number" value="0"></td>
                  <td><input type="number" value="0"></td>
                  <td><input type="number" value="0"></td>
                </tr>



            </tbody>
        </table>
    </div>

    <table class="mt-6">
      <thead>
        <tr>
          <th>Услуги</th>
          <th>Цена</th>
          <th>Скидка</th>
          <th>Сумма после скидка</th>
          <th>Выбор</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Погрузка-разгрузочные работы (ПРР)</td>
          <td>{{ loading_unloading_service_price }}</td>
          <td><input type="number" name="" id=""></td>
        </tr>
        <tr v-for="work_type in work_types">
          <td>{{ work_type.name }}</td>
          <td>{{ getTotalPriceForWorkType(work_type.id) }}</td>
          <td>
            <input v-model.number="discountMap[work_type.id]" type="number" min="0" max="100">
          </td>
          <td>{{ getPriceAfterDiscount(work_type.id).toFixed(2) }}</td>

          <td><input v-model="workTypesArray" type="checkbox" 
                            :value="{ 
                                id: work_type.id, 
                                name: work_type.name,
                                summ: getTotalPriceForWorkType(work_type.id),
                                discount: discountMap[work_type.id] || 0,
                                summAfterDiscount: getPriceAfterDiscount(work_type.id) }"></td>
        </tr>
      </tbody>
    </table>

      <div class="mt-6 text-right text-base font-bold">
        Погрузка-разгрузочные работы (ПРР): {{ loading_unloading_service_price }}
      </div>

      <div class="mt-6 text-right text-base font-bold">
        Сумма итог: {{ WorkTypesBeforeDiscount + loading_unloading_service_price}} 
      </div>

      <div class="mt-6 text-right text-base font-bold">
        Сумма итог дискоунт: {{ WorkTypesAfterDiscount }} 
      </div>
    <form method="POST" action="/generate_pdf" target="_blank">
        <input type="hidden" name="_token" :value="csrfToken">
        <input type="hidden" name="storedValuesArray" :value="JSON.stringify(storedValuesArray)">
        <input type="hidden" name="workTypesArray" :value="JSON.stringify(workTypesArray)">
        <input type="hidden" name="WorkTypesBeforeDiscount" :value="JSON.stringify(WorkTypesBeforeDiscount)">
        <input type="hidden" name="WorkTypesAfterDiscount" :value="JSON.stringify(WorkTypesAfterDiscount)">
        <input type="hidden" name="loading_unloading_service_price" :value="JSON.stringify(loading_unloading_service_price)">
        <button @click="addAdditonalData()" type="submit">Распечатать коммерческое предложение PDF</button>
    </form>
  </div>
</template>



<style>
    table{
        text-align: center;
        width: 100%;
    }
    input{
        width: 100%;
    }
    td, th {
        border: 1px solid #dddddd;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #f6f2f2;
    }
</style>
