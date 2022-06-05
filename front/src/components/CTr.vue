<template>
    <tr v-for="(object, index) in this.objects" :key="index">
        <th v-for="(value, key) in removeProperties(object)" :key="key">{{value}}</th>
        <td v-if="this.action != null && this.action == 'button' "><a v-bind:href= "this.route + objects[index].id" class="btn btn-primary btn-sm">{{this.titleAction}}</a></td>
        <td v-if="this.action != null && this.action == 'checkbox' ">
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" :checked="isHere(index)" v-on:change="attendancesEvent(objects[index],$event)">
            <label class="form-check-label" for="flexSwitchCheckChecked"></label>
          </div>
        </td>
    </tr>
</template>

<script>
export default {
  name:'CTr',
  props:{
      objects:Array,
      action:String,
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
      }, 
      isHere: function (index){
        console.log((this.objects[index].attendances != undefined && this.objects[index].attendances.length > 0));
        return (this.objects[index].attendances != undefined && this.objects[index].attendances.length > 0);
      },
      attendancesEvent(student,e){
          console.log(student)
          console.log(e)
      }
  }
}
</script>