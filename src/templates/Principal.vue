<template>
    <div class="d-flex fundoDesenvolvedor">
        <div class="container">
          <slot />
        </div>
        <footer></footer>
      </div>
      
</template>
<script>

export default {
  name: "principal",
  components: {
    
  },
  data() {
    return {
    
    };
  },
};
</script>
<style>
.configContainer{
  padding-top: 20px;
  max-width: none;
  margin-top: 0px;
  margin-right: 0px
}

</style>
