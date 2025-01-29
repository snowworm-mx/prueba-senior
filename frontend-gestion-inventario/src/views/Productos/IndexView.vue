<script setup>
    import axios from 'axios';
    import { nextTick, onMounted, reactive, ref } from 'vue';
    import Modal from '@/components/Modal.vue';
    import { confirmation, show_alerta } from '@/functions';
    import { useAuthStore } from '@/stores/auth';
    import Paginate from 'vuejs-paginate-next';

    const authStore = useAuthStore();
    axios.defaults.headers.common['Authorization'] = 'Bearer '+authStore.authToken;
    const productos = ref([]);
    const rows = ref(0);
    const loading = ref(false);
    const title = ref("");
    const nameInput = ref([]);
    const searchInput = ref("");
    const operation = ref(1);
    const _id = ref("");
    const form = reactive({
        nombre:"",
        descripcion:"",
        precio:0.0,
        cantidad:0
    });
    onMounted(()=>{
        getProductos();
    });

    const getProductos = async(page = 1,search = "")=>{
        loading.value = true;
        await axios.get('/api/productos',{params:{page,search}}).then(response=>{
            productos.value = response.data.data;
            rows.value = response.data.last_page;
            loading.value = false;
        });
    }

    const guardarProducto = async()=>{
        try{
            
            if(_id.value == "")
            {
                //Nuevo registro
                const {data} = await axios.post('/api/productos',form);
                console.log(data);
                show_alerta(data.message,'success','');
                setTimeout(()=>window.location.reload(),2000);
            }
            else{
                //Editar registro
                const {data} = await axios.put('/api/productos/'+_id.value,form);
                console.log(data);
                show_alerta(data.message,'success','');
                setTimeout(()=>window.location.reload(),2000);
            }
            
        }
        catch(error)
        {
            console.log(error);
        }
    }

    const eliminarProducto = (id,name)=>{
        confirmation(name,{},('/api/productos/'+id),'/productos');
    }


    const buscar = async()=>{
        getProductos(1,searchInput.value);
    }

    const openModal = (op,{id, nombre,descripcion,precio,cantidad})=>{
        clear();
        setTimeout(() => nextTick(()=>nameInput.value.focus()), 600);
        operation.value = op;
        //id.value = employee;
        if(op == 1){
            title.value = 'Nuevo producto';
        }
        else{
            title.value = 'Editar producto';
            _id.value = id;
            form.nombre = nombre;
            form.descripcion = descripcion;
            form.precio = precio;
            form.cantidad = cantidad;
        }
    }

    const clear = ()=>{
        _id.value = "";
        form.nombre = '';
        form.descripcion = '';
        form.precio = 0.0;
        form.cantidad = 0;
    }

    const cleanSearch = () =>{
        searchInput.value = "";
        getProductos();
    }

</script>
<template>
    <h3>Lista Productos</h3>
    <div class="row">
        <div class="col-md-6">
            <button @click.prevent="openModal(1,{})" data-toggle="modal" data-target="#modal" class="btn btn-sm btn-success">
                <span class="fa fa-plus"></span>
                Nuevo
            </button>
        </div>
        <div class="col-md-6">
            <input  @keypress.enter="buscar" v-model="searchInput" type="text" />
            <button @click.prevent="buscar" class="btn btn-sm btn-primary">buscar</button>
            <button @click.prevent="cleanSearch" class="btn btn-sm btn-secondary">limpiar</button>
        </div>


    </div>
    <img v-show="loading" style="margin: 15px auto;" src="@/assets/loading5.gif" />
    <table class="table">
        <thead class="bg-dark text-white text-center table-bordered">
            <tr>
                <td>ID</td>
                <td>Nombre</td>
                <td>Descripcion</td>
                <td>Precio</td>
                <td>Cantidad</td>
                <td>Opciones</td>
            </tr>
        </thead>
        <tbody>
            <tr v-for="p of productos">
                <td class="text-center">{{ p.id }}</td>
                <td>{{ p.nombre }}</td>
                <td>{{ p.descripcion }}</td>
                <td class="text-right">${{ p.precio }}</td>
                <td class="text-center">{{ p.cantidad }}</td>
                <td class="text-center">
                    <button @click.prevent="openModal(2,p)" data-toggle="modal" data-target="#modal" class="btn btn-sm btn-primary">Editar</button>&nbsp;
                    <button @click="$event=>eliminarProducto(p.id,p.nombre)" class="btn btn-sm btn-danger">Eliminar</button>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="text-center">
        <Paginate
            :page-count="rows"
            :click-handler="getProductos"
            :prev-text="'Anterior'" :next-text="'Siguiente'"
        ></Paginate>
    </div>
    <Modal :id="'modal'" :title="title">
        <div class="modal-body">
            <form @submit.prevent="save">
                <input v-model="_id" type="hidden" />
                <div class="form-group">
                    <label>Nombre:</label>
                    <input v-model="form.nombre" type="text" placeholder="Nombre" class="form-control" autofocus
                    ref="nameInput" required>
                </div>
                <div class="form-group">
                    <label>Descripción:</label>
                    <textarea v-model="form.descripcion" placeholder="descripción"  class="form-control" ></textarea>
                </div>
                <div class="form-group">
                    <label>Precio:</label>
                    <input v-model="form.precio" type="number" class="form-control" 
                    required>
                </div>
                <div class="form-group">
                    <label>Cantidad:</label>
                    <input v-model="form.cantidad" type="number" class="form-control" 
                    required>
                </div>
                <div class="d-grid col-10 mx-auto">
                <button class="btn btn-success btn-block"  @click.prevent="guardarProducto">
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
