<script setup>
    import { ref } from 'vue';
    import { useAuthStore } from '@/stores/auth';
    
    const authStore = useAuthStore();
    const form = ref({name:'',email:'',password:'',rol:'user'});
</script>
<template>
    <div class="row mt-5">
        <div class="col-md-4 offset-md-4">
            <form @submit.prevent="$event=>authStore.register(form)">
                <div class="card">
                    <div class="card-header bg-purple border border-success text-white">
                        REGISTRO
                    </div>
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fa-solid fa-user"></i>
                            </span>
                            <input v-model="form.name" type="text" placeholder="Name" class="form-control" autofocus>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fa-solid fa-at"></i>
                            </span>
                            <input v-model="form.email" type="text" placeholder="Email" class="form-control" autofocus>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fa-solid fa-key"></i>
                            </span>
                            <input v-model="form.password" type="password" placeholder="Password" class="form-control">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fa-solid fa-users"></i>
                            </span>
                            <select v-model="form.rol" class="form-control">
                                <option value="user">user</option>
                                <option value="admin">admin</option>
                            </select>
                        </div>
                        <div class="d-grid col-10 mx-auto">
                            <button class="btn btn-dark btn-block">Registrar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>