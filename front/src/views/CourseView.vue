<template>
<header class="d-flex align-items-center pb-3 mb-5 border-bottom">
    <c-navbar></c-navbar>
  </header>
   <main v-if="state != 'init'">
    <h1 class="text-start">{{this.course.name}}</h1>

    <blockquote class="blockquote text-start">
      <p>{{this.course.description}}</p>
    </blockquote>

    <table class="table table-striped mt-5">
      <thead>
       <c-thead 
       :columns="['Id','First Name','Last Name','Email']" 
       :with-action="true"/>
      </thead>
      <tbody>
        <c-tr v-if="this.course.students.length > 0" 
          :objects="this.course.students"  
          :action="'checkbox'"
          :title-action="'Roster'"
          :exclude="['pivot']" 
        />
      </tbody>
    </table>
    <c-status :state="this.state" :show="this.showStatusView" :errorMessage="this.errorMessage"></c-status>

  </main>
  <main v-else>
      <div class="card-body">
          <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
      </div>
    </main>
</template>

<script>
import CNavbar from '@/components/CNavbar.vue';
import CThead from '@/components/CThead.vue';
import CTr from '@/components/CTr.vue';
import CStatus from '@/components/CStatus.vue';

import CourseWS from '@/ws/CourseWS';

export default {
  name: "CourseView",
  data : function () {
    
      return {
        course:null,
        state: "init",
        errorMessage: "",
      }
  },
  components: {
    CNavbar,
    CThead,
    CTr,
    CStatus
  },
  computed:{
    /**
    * Validate if the status view should be visible
    */
    showStatusView: function(){
      return this.course == null;
    },
    
  },
  mounted : function () {
   CourseWS.show(this.$route.params.course_id).then(response => {
      this.course = response.data.data
      this.state='result'
    }).catch(error => {
      this.errorMessage = error.message;
      this.state='error';
    });
  }
}
</script>