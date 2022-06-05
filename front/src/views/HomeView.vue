<template>
  <header class="d-flex align-items-center pb-3 mb-5 border-bottom">
    <c-navbar></c-navbar>
  </header>
  <main>
    <h1 class="text-start">Intructors</h1>

    <blockquote class="blockquote text-start">
      <p>List of available instructors</p>
    </blockquote>

    <table class="table table-striped mt-5">
      <thead>
       <c-thead :columns="['Id','First Name','Last Name','Email']" :with-action="true"></c-thead>
      </thead>
      <tbody>
        <c-tr v-if="this.instructors.length > 0" 
        :objects="instructors"
        :action="'button'" 
        :title-action="'View'" 
        :route="'/instructor/'"></c-tr>
      </tbody>
    </table>
    <c-status :state="this.state" :show="this.showStatusView" :errorMessage="this.errorMessage"></c-status>

  </main>
</template>

<script>
import CNavbar from '@/components/CNavbar.vue';
import CThead from '@/components/CThead.vue';
import CTr from '@/components/CTr.vue';
import CStatus from '@/components/CStatus.vue';
import InstruictorWS from '@/ws/InstructorWS';

export default {
  name: "HomeView",
  data : function () {
      return {
        instructors:[],
        state: "init",
        errorMessage: ""
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
      return this.instructors.length == 0;
    }
  },
  mounted : function () {
    InstruictorWS.get().then(response => {
        this.instructors = response.data.data
        this.state='result'
        console.log(this.instructors)
    }).catch(error => {
      this.errorMessage = error.message;
      this.state='error';
    });
  }
};
</script>
