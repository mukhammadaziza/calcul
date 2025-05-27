<script setup>

const props = defineProps({
  product_preparations_dimensions: Object,
  product_preparations_names: Object
})

const getPivotValue = (product_preparations_name, product_preparations_dimension) => {
  const found = product_preparations_name.dimensions.find(
    dim => dim.id === product_preparations_dimension.id
  )
  return found?.pivot?.value || null
}

</script>


<template>
    <div class="p-8 text-xs">
        <p class="text-center text-xl">Услуги подготовки товара</p>
        <p class="text-center">*Товары в количестве до 100 едениц либо сумма счета меньше чем 3000 рублей тарифицируеться как 3000 рублей.</p>
        <table class="border-collapse border border-gray-300">
          <thead>
            <tr>
              <th class="border border-gray-300 p-2">Вид работ</th>
              <th v-for="product_preparations_dimension in product_preparations_dimensions" :key="product_preparations_dimension.id" class="border border-gray-300 p-2">
               <p>Сумма сторон до {{ product_preparations_dimension.product_dimension }} см</p>
               <p>Вес до {{ product_preparations_dimension.product_weight }} кг</p> 
              </th>
            </tr>
          </thead>
          
          <tbody>
            <tr v-for="product_preparations_name in product_preparations_names" :key="product_preparations_name.id">
              <td class="border border-gray-300 p-2 font-medium">
                <button>{{ product_preparations_name.name }}</button>
              </td>
              <td v-for="product_preparations_dimension in product_preparations_dimensions" :key="product_preparations_dimension.id">
                {{ getPivotValue(product_preparations_name, product_preparations_dimension) }}
              </td>
            </tr>
          </tbody>
    </table>
    </div>
</template>