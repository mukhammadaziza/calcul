<script setup>
import { ref, watch } from 'vue'

const props = defineProps({
  logistics_warehouses: Object
})



</script>

<template>


<div>
    <tr v-for="logistics_warehouse in logistics_warehouses">
                    <td>Logistics</td>
                    <td>{{ logistics_warehouse.warehouse_name }}</td>
                    <td><input  v-model="storedValuesArray" type="checkbox" 
                            :value="{ 
                                id: logistics_warehouse.id, 
                                name: logistics_warehouse.warehouse_name, 
                                units: numberOfUnits }"></td>
                    <td><input v-model="numberOfWarehouse" type="number"></td>
                    <td>{{ getPrice(numberOfWarehouse) }}</td>
                    <td>12</td>
                    <td><input @click="" v-model="storedValuesArray" type="checkbox"></td>
                    <td><input type="number" value="0"></td>
                    <td><input type="number" value="0"></td>
                    <td><input type="number"  value="0"></td>
                    <td><input type="number"  value="0"></td>
                </tr>
</div>

       
                
                
         
</template>

