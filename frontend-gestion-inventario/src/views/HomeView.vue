<script setup>
</script>

<template>
  <div class="contenido">
    <div style="width:60%;color:white;text-align: center;">
      <h1>Implementación de funcionalidades de gestión de inventario</h1>
      <router-link class="btn btn-success" :to="{name:'login'}">ir al login</router-link>
    </div>
  </div>
</template>
<style scoped>
.contenido{
  background-image: url(../assets/fondo_inventario.jpg);
  background-repeat: no-repeat;
  background-size: cover;
  background-color: antiquewhite;
  display: flex;
  flex-direction: column;
  flex-wrap: nowrap;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: calc(100vh - 56px);
  box-sizing: border-box;
}

h1{
  text-shadow: 3px 3px 3px rgba(0, 0, 0,.5);
}
</style>