<script setup>

import Storing from './components/Storing.vue';
import PackagingMaterials from './components/PackagingMaterials.vue';
import LoadingUnloading from './components/LoadingUnloading.vue';
import LogisticsWarehouses from './components/LogisticsWarehouses.vue';
import WorkTypes from './components/WorkTypes.vue';
import ProductPreparation from './components/ProductPreparation.vue';

const props = defineProps({
  services: Object,
  product_preparations: Object,
  storing_services: Object,
  packaging_materials: Object,
  loading_unloadings: Object,
  logistics_warehouses: Object,
  product_preparations_dimensions: Object,
  product_preparations_names: Object,
  work_types: Object
});

</script>

<template>
  <div>
    <WorkTypes :work_types="work_types" />
    <PackagingMaterials :packaging_materials="packaging_materials" :work_types="work_types" />
    <LogisticsWarehouses :logistics_warehouses="logistics_warehouses" :work_types="work_types" />
    <Storing :storing_services = "storing_services" :work_types="work_types" />
    <LoadingUnloading :loading_unloadings="loading_unloadings" />
    <ProductPreparation :product_preparations_dimensions="product_preparations_dimensions" :product_preparations_names="product_preparations_names" />
  </div>
</template>
