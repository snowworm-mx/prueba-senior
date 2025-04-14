<script setup>
import { show_alerta } from '@/functions';
import { reactive } from 'vue';

    const form = reactive({
        email:""
    });

    const resetPassword = async()=>{
        try{
            const {data} = await axios.post('/api/auth/reset-password',{email:form.email});
            show_alerta(data.message,'success','');
        }
        catch(error)
        {
            console.log(error)
        }
    }
</script>
<template>
     <div class="row mt-5">
        <div class="col-md-4 offset-md-4">
            <form @submit.prevent="$event=>authStore.login(form)">
                <div class="card">
                    <div class="card-header bg-purple border border-success text-white">
                        Olvide mi password
                    </div>
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fa-solid fa-at"></i>
                            </span>
                            <input v-model="form.email" type="text" placeholder="Email" class="form-control" autofocus>
                        </div>
                        <div class="d-grid col-10 mx-auto">
                            <button @click="resetPassword()" class="btn btn-dark btn-block">Enviar</button>
                        </div>
                        <router-link :to="{path:'login'}">ir al Login</router-link>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>