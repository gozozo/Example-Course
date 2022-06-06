<template>
  <header class="d-flex align-items-center pb-3 mb-5 border-bottom">
    <c-navbar></c-navbar>
  </header>
  <main v-if="state != 'init'">
    <h1 class="text-start">Welcome {{getFullName}}</h1>

    <blockquote class="blockquote text-start">
      <p>List of current courses</p>
    </blockquote>
    
     <table class="table table-striped mt-5">
      <thead>
       <c-thead :columns="['Id','Name','Description']" :with-action="true"/>
      </thead>
      <tbody>
        <c-tr v-if="this.instructor.courses.length > 0" 
          :objects="instructor.courses"  
          :with-action="true"
          :action="'button'"
          :title-action="'Roster'"
          :exclude="['instructor_id']" 
          :route="getRoute">
        </c-tr>
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

import InstruictorWS from '@/ws/InstructorWS';

export default {
  name: "InstructorView",
  data : function () {
      return {
        instructor:null,
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
    * Get the full name of an instructor
    */
    getFullName: function(){
      return this.instructor.first_name+ ' ' + this.instructor.last_name  
    },
    /**
    * Validate if the status view should be visible
    */
    showStatusView: function(){
      return this.instructor == null||this.instructor.courses == 0;
    },
    /**
    * Build resource route
    */
    getRoute: function(){
      return '/couser/';
    }
  },
  mounted : function () {
    InstruictorWS.show(this.$route.params.instructor_id).then(response => {
      this.instructor = response.data.data
      this.state='result'
    }).catch(error => {
      this.errorMessage = error.message;
      this.state='error';
    });
  }
};
</script>
