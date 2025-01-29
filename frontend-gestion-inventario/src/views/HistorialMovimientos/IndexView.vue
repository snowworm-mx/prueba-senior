<script setup>
    import axios from 'axios';
    import { nextTick, onMounted, reactive, ref } from 'vue';
    import { confirmation } from '@/functions';

    const historial = ref([]);
    const load = ref(false);
    const title = ref("");
    const nameInput = ref([]);
    const operation = ref(1);
    const id = ref("");
    const form = reactive({
        nombre:"",
        descripcion:"",
        precio:0.0,
        cantidad:0
    });
    onMounted(()=>{
        getHistorial();
    });

    const getHistorial = async(page = 1)=>{
        await axios.get('/api/historial').then(response=>{
            console.log('historial',response.data);
            historial.value = response.data;
            load.value = true;
        });
    }

    const eliminarProducto = (id,name)=>{
        confirmation(name,('/api/pedidos/'+id),'/pedidos');
    }

    const openModal = (op,{nombre,descripcion,precio,cantidad})=>{
        clear();
        setTimeout(() => nextTick(()=>nameInput.value.focus()), 600);
        operation.value = op;
        //id.value = employee;
        if(op == 1){
            title.value = 'Nuevo pedido';
        }
        else{
            title.value = 'Editar pedido';
            form.nombre = nombre;
            form.descripcion = descripcion;
            form.precio = precio;
            form.cantidad = cantidad;
        }
    }

    const clear = ()=>{
        form.nombre = '';
        form.descripcion = '';
        form.precio = 0.0;
        form.cantidad = 0;
    }

</script>
<template>
    <h3>Historial Movimientos</h3>
    <table class="table">
        <thead class="bg-dark text-white text-center table-bordered">
            <tr>
                <td>ID</td>
                <td>Usuario</td>
                <td>Producto</td>
                <td>Cantidad</td>
                <td>Fecha</td>
            </tr>
        </thead>
        <tbody>
            <tr v-for="p of historial">
                <td class="text-center">{{ p.id }}</td>
                <td>{{ p.usuario }}</td>
                <td>{{ p.producto }}</td>
                <td class="text-center">{{ p.cantidad }}</td>
                <td class="text-center">{{ p.fecha }}</td>
            </tr>
        </tbody>
    </table>
</template>
