<script setup>
    import { ref, reactive } from 'vue';
    import { useAuthStore } from '@/stores/auth';
    import Modal from '@/components/Modal.vue';
    import { confirmation, show_alerta } from '@/functions';

    const authStore = useAuthStore();
    axios.defaults.headers.common['Authorization'] = 'Bearer '+authStore.authToken;

    const title = ref("Cambiar Password");
    const loading = ref(false);

    const form = reactive({
        password:'',
        confirmPassword:'',
        newPassword:''
    });
    const close = ref([]);

    const cambiarPassword = async()=>{
        try
        {
            loading.value = true;
            const {data} = await axios.put('api/auth/changePassword',form);
            if(data.status = 1)
            {
                show_alerta(data.message,'success',null);
            }
            else{
                show_alerta(data.message,'error',null);
            }
            loading.value = false;
        }
        catch(error)
        {
            console.log(error);
        }
    }
</script>
<template>
    <div class="row mt-5">
        <div class="col-md-4 offset-md-4">
            <form>
                <div class="card">
                    <div class="card-header bg-purple border border-success text-white">
                        PERFIL
                    </div>
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fa-solid fa-user"></i>
                            </span>
                            <input :value="authStore.user.name" type="text" readonly placeholder="Name" class="form-control" autofocus>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fa-solid fa-at"></i>
                            </span>
                            <input :value="authStore.user.email" type="text" readonly placeholder="Email" class="form-control" autofocus>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fa-solid fa-users"></i>
                            </span>
                            <input type="text" :value="authStore.user.rol" readonly class="form-control" />
                        </div>
                        <div class="d-grid col-10 mx-auto">
                            <button class="btn btn-dark btn-block" @click.prevent="" data-toggle="modal" data-target="#modal">cambiar password</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <Modal :id="'modal'" :title="title">
        <div class="modal-body">
            <form @submit.prevent="save">
                <img v-show="loading" src="@/assets/loading5.gif" />
                <div class="form-group">
                    <label>Password:</label>
                    <input v-model="form.password" type="password" class="form-control" autofocus
                    ref="nameInput" required>
                </div>
                <div class="form-group">
                    <label>confirma password:</label>
                    <input v-model="form.confirmPassword" type="password"  class="form-control" />
                </div>
                <div class="form-group">
                    <label>Nuevo Passsword:</label>
                    <input v-model="form.newPassword" type="password" class="form-control" 
                    required>
                </div>
                <div class="d-grid col-10 mx-auto">
                <button class="btn btn-success btn-block"  @click.prevent="cambiarPassword">
                    <i class="fa-solid fa-floppy-disk"></i> Guardar
                </button>
            </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-dark" ref="close" data-dismiss="modal">Close</button>
        </div>
    </Modal>
</template>