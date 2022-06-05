<template>
    <tr v-for="(object, index) in this.objects" :key="index">
        <th v-for="(value, key) in removeProperties(object)" :key="key">{{value}}</th>
        <td v-if="this.withAction"><a v-bind:href= "this.route + objects[index].id" class="btn btn-primary btn-sm">{{this.titleAction}}</a></td>
    </tr>
</template>

<script>
export default {
  name:'CTr',
  props:{
      objects:Array,
      withAction:Boolean,
      route:String,
      exclude:Array,
      titleAction:String
  },
  methods:{
    /**
    * Remove properties from an object
    * 
    * @param {Object} object The object to be removed properties
    */
      removeProperties: function (object){
          if( this.exclude !=  undefined){
            this.exclude.forEach(element => {
              delete object[element]
            });
          }
          return object;
      }
  }
}
</script>