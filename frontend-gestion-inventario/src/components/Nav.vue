<script setup>
    import {useAuthStore} from '../stores/auth';
    const authStore = useAuthStore();

    const logout = async()=>{
        await authStore.logout();
    }
</script>
<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-purple">
        <router-link class="navbar-brand" :to="{name:'home'}">Gestion Inventario</router-link>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul v-if="authStore.user" class="navbar-nav mr-auto">
                <li class="nav-item text-white mt-2">       
                    {{ authStore.user.name }}
                </li>
                <li class="nav-item px-lg-3">
                    <RouterLink :to="{name:'productos'}" class="nav-link">Productos</RouterLink>
                </li>
                <li class="nav-item px-lg-3">
                    <RouterLink :to="{name:'pedidos'}" class="nav-link">Pedidos</RouterLink>
                </li>
                <li v-if="authStore.user?.rol == 'admin'" class="nav-item px-lg-3">
                    <RouterLink :to="{name:'historial'}" class="nav-link">Historial</RouterLink>
                </li>
                <li v-if="authStore.user?.rol == 'admin'" class="nav-item px-lg-3">
                    <router-link :to="{path:'register'}" class="nav-link">Registro</router-link>
                </li>
                <li class="nav-item px-lg-3">
                    <router-link :to="{path:'perfil'}" class="nav-link">Perfil</router-link>
                </li>
            </ul>
            <ul v-if="authStore.user" class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item px-lg-5">
                    <button @click="$event => logout()" class="btn btn-success">Salir</button>
                </li>
            </ul>
        </div>
    </nav>
</template>
<style>
.bg-purple{
  background-color: purple !important;
}
</style>