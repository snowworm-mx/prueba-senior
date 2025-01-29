<script setup>
    import axios from 'axios';
    import { nextTick, onMounted, reactive, ref } from 'vue';
    import Modal from '@/components/Modal.vue';
    import { show_alerta } from '@/functions';
    import { useAuthStore } from '@/stores/auth';

    const authStore = useAuthStore();
    axios.defaults.headers.common['Authorization'] = 'Bearer '+authStore.authToken;
    const pedidos = ref([]);
    const listaPedido = ref([]);
    const productos = ref([]);
    const rows = ref(0);
    const loading = ref(false);
    const estado = ref("");
    const title = ref("");
    const operation = ref(1);
    const _id = ref("");
    const form = reactive({
        descripcion:"",
    });
    onMounted(async()=>{
        await getPedidos();
        await getProductos();
    });

   
    const getProductos = async(page = 1,search = "")=>{
        await axios.get('/api/productos',{params:{page,search}}).then(response=>{
            productos.value = response.data.data;
            rows.value = response.data.last_page;
            loading.value = false;
        });
    }

    const getPedidos = async(page = 1)=>{
        loading.value = true;
        await axios.get('/api/pedidos',{params:{page}}).then(response=>{
            pedidos.value = response.data.data;
            //rows.value = response.data.last_page;
            loading.value = false;
        });
    }

    const changeStatus = async()=>{
        loading.value = true;
        await axios.put('/api/pedidos/change-status/'+_id.value,{'estado':estado.value}).then(response=>{
            //rows.value = response.data.last_page;
            loading.value = false;
            show_alerta(response.data,'success',null)
        });
    }

    const agregarProducto = (producto)=>{
        const index = listaPedido.value.findIndex(p=>p.id==producto.id);
        if(index == -1)
        {
            producto.cantidad = 1;
            listaPedido.value.push(producto);
        }
        else{
            listaPedido.value[index].cantidad = listaPedido.value[index].cantidad +1;
        }
        console.log(producto, listaPedido.value)
    }

    const quitarProducto = (producto)=>{
        listaPedido.value = listaPedido.value.filter(p=>p.id!=producto.id);
        console.log(index,listaPedido.value)
    }

    const openModal = (op,pedido)=>{
        clear();
        //setTimeout(() => nextTick(()=>nameInput.value.focus()), 600);
        operation.value = op;
        //id.value = employee;
        if(op == 1){
            title.value = 'Nuevo pedido';
        }
        else{
            title.value = 'Editar pedido: '+pedido.id;
            console.log('pedido',pedido)
            _id.value = pedido.id;
            form.fecha = pedido.created_at?.slice(0,10);
            listaPedido.value = [];
            for(let d of pedido.detalle_pedidos)
            {
                const prod = d.producto;
                prod.cantidad = d.cantidad;
                listaPedido.value.push(prod);
            }
            console.log(listaPedido.value);
        }
    }

    const clear = ()=>{
        _id.value = '';
        form.descripcion = '';
        listaPedido.value = [];
    }

    const save = async()=>{
        try {

            if(_id.value == "")
            {
                //nuevo
                const {data} = await axios.post('/api/pedidos',{'pedido':form.value,'detallePedido':listaPedido.value});
                show_alerta(data.message,'success',null);
            }
            else{
                //editar
                const {data} = await axios.put('/api/pedidos/'+_id.value,{'pedido':form.value,'detallePedido':listaPedido.value});
                show_alerta(data.message,'success',null);
            }
        } catch (error) {
            console.log(error)    
        }
    }
</script>
<template>
    <h3>Lista Pedidos</h3>
    <button @click.prevent="openModal(1,{})" data-toggle="modal" data-target="#modal" class="btn btn-sm btn-success">
        <span class="fa fa-plus"></span>
        Nuevo
    </button>
    <img v-show="loading" src="@/assets/loading5.gif" />
    <table class="table">
        <thead class="bg-dark text-white text-center table-bordered">
            <tr>
                <td>ID</td>
                <td>Usuario</td>
                <td>Estado</td>
                <td>Fecha</td>
                <td>Opciones</td>
            </tr>
        </thead>
        <tbody>
            <tr v-for="p of pedidos">
                <td class="text-center">{{ p.id }}</td>
                <td>{{ p.user.name }}</td>
                <td>{{ p.estado }}</td>
                <td>{{ p.created_at?.substring(0,10) }}</td>
                <td class="text-center">
                    <button @click.prevent="openModal(2,p)" data-toggle="modal" data-target="#modal" class="btn btn-sm btn-primary">Editar</button>&nbsp;
                    <button @click.prevent="_id=p.id" data-toggle="modal" data-target="#modal_cambiar_estado" class="btn btn-sm btn-warning">Cambiar Estado</button>
                </td>
            </tr>
        </tbody>
    </table>
    <Modal :id="'modal'" :title="title">
        <div class="modal-body">
            <form @submit.prevent="save">
                <input v-model="_id" type="hidden" />
                <div class="form-group">
                    <label>Fecha:</label>
                    <input v-model="form.fecha" placeholder="Fecha" readonly  class="form-control" />
                </div>
                <div class="form-group">
                    <label>Descripción:</label>
                    <textarea v-model="form.descripcion" placeholder="descripción"  class="form-control" ></textarea>
                </div>
                <div>
                    Pedidos
                    <table class="table">
                        <thead class="bg-purple text-white text-center table-bordered">
                            <tr>
                                <td>ID</td>
                                <td>Nombre</td>
                                <td>Descripcion</td>
                                <td>Precio</td>
                                <td>Cantidad</td>
                                <td>Opciones</td>
                            </tr>
                        </thead>
                        <tbody v-for="l of listaPedido">
                            <td class="text-center">{{ l.id }}</td>
                            <td>{{ l.nombre }}</td>
                            <td>{{ l.descripcion }}</td>
                            <td class="text-right">${{ l.precio }}</td>
                            <td class="text-center">
                                <input :value="l.cantidad" type="number" class="form-control" />
                            </td>
                            <td class="text-center">
                                <button @click.prevent="quitarProducto(l)" class="btn btn-danger btn-sm">
                                    Quitar
                                </button>
                            </td>
                        </tbody>
                    </table>
                </div>
                <div>
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
                                    <button @click.prevent="agregarProducto(p)" class="btn btn-success btn-sm">
                                        Agregar
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-grid col-10 mx-auto">
                <button class="btn btn-success btn-block"  @click="$event=>save">
                    <i class="fa-solid fa-floppy-disk"></i> Guardar
                </button>
            </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-dark" ref="close" data-dismiss="modal">Close</button>
        </div>
    </Modal>

    <Modal :id="'modal_cambiar_estado'" :title="'Cambiar Estado: '+_id">
        <div class="modal-body">
            <form>
                <input v-model="_id" type="hidden" />
                <div class="form-group">
                    <label>Estado:</label>
                    <select v-model="estado"  class="form-control">
                        <option value="PENDIENTE">PENDIENTE</option>
                        <option value="PROCESO">PROCESO</option>
                        <option value="FINALIZADO">FINALIZADO</option>
                        <option value="CANCELADO">CANCELADO</option>
                    </select>
                </div>
                <div class="d-grid col-10 mx-auto">
                <button class="btn btn-success btn-block"  @click.prevent="changeStatus">
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
