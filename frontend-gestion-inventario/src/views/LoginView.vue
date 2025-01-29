<script setup>
    import { ref } from 'vue';
    import { useAuthStore } from '@/stores/auth';
    
    const authStore = useAuthStore();
    const form = ref({email:'',password:''});
    const loading = ref(false);
</script>
<template>
    <div class="row mt-5">
        <div class="col-md-4 offset-md-4">
            <form @submit.prevent="$event=>{authStore.login(form);loading = true;}">
                <img v-show="loading" style="margin: 15px auto;" src="@/assets/loading5.gif" />
                <div class="card">
                    <div class="card-header bg-purple border border-success text-white">
                        LOGIN
                    </div>
                    <div class="card-body">
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
                        <div class="d-grid col-10 mx-auto">
                            <button class="btn btn-dark btn-block">Login</button>
                        </div>
                        <br />
                        <router-link :to="{name:'resetPassword'}">Olvide mi password</router-link>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>