<template>
    <tr v-for="(object, index) in this.objects" :key="index">
        <th v-for="(value, key) in removeProperties(object)" :key="key">{{value}}</th>
        <td v-if="this.action != null && this.action == 'button' "><a v-bind:href= "this.route + objects[index].id" class="btn btn-primary btn-sm">{{this.titleAction}}</a></td>
        <td v-if="this.action != null && this.action == 'checkbox' ">
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" :checked="isHere(index)" v-on:change="attendancesEvent(objects[index],this.extra,$event)">
            <label class="form-check-label" for="flexSwitchCheckChecked"></label>
          </div>
        </td>
    </tr>
</template>

<script>
import AttendanceWS from '@/ws/AttendanceWS';

export default {
  name:'CTr',
  props:{
      objects:Array,
      action:String,
      route:String,
      exclude:Array,
      titleAction:String,
      extra:Object
  },
  methods:{
    /**
    * Remove properties from an object
    * 
    * @param {Object} object The object to be removed properties
    */
      removeProperties: function (object){
          let tmp = JSON.parse(JSON.stringify(object))
          if( this.exclude !=  undefined){
            this.exclude.forEach(element => {
              delete tmp[element]
            });
          }
          return tmp;
      }, 
      isHere: function (index){
        return (this.objects[index].attendances != undefined && this.objects[index].attendances.length > 0);
      },
      attendancesEvent(student,extra){
          if(student.attendances==undefined||student.attendances.length==0){
            AttendanceWS.store({student_id:student.id,course_id:extra.id}).then(response => {
              student.attendances.push(response.data.data);
              console.log(student)
            });
          }else if(student.attendances.length>0){
            AttendanceWS.delete(student.attendances[0].id).then(function(){
              student.attendances = [];
            });
          }
      }
  }
}
</script>