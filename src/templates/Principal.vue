<template>
  
    <div class="d-flex fundoDesenvolvedor">
        <div class="container">
          <slot />
        </div>
      </div>
</template>
<script>

export default {
  name: "principal",
  components: {
    
  },
  data() {
    return {
      usuario:false 
    };
  },
  created() {
  
  },
  mothods:{
    loginEvent(){

    }
  }
};
</script>
<style>
hr {
  border-top: 5px solid rgba(0, 0, 0, 0.1);
}
.configContainer{
  padding-top: 20px;
  max-width: none;
  margin-top: 0px;
  margin-right: 0px
}
</style>
