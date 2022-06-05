<template>
 <div v-if="this.show" class="card">
      <div class="card-body">
        <div v-if="this.state == 'init'" class="spinner-border" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <span v-else-if="this.state == 'error'"> {{this.errorMessage}}</span>
        <span v-else> Not result</span>
      </div>
    </div>
</template>

<script>
export default {
  name:'CStatus',
  props:{
      show:Boolean,
      state:String,
      errorMessage: String
  }
}
</script>