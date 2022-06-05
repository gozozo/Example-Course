<template>
    <tr>
        <th v-for="(column,index) in columns" scope="col" :key="index">{{column}}</th>
        <th v-if="withAction" scope="col">Action</th>
    </tr>
</template>

<script>
export default {
  name:'CThead',
  props:{
      columns:Array,
      withAction:Boolean
  }
}
</script>