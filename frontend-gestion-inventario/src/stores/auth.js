import {defineStore} from 'pinia';
import { show_alerta } from '@/functions';
import axios from 'axios';

export const useAuthStore = defineStore('auth',{
    persist: true,
    state:()=>({authUser:null,authToken:null}),
    getters:{
        user:(state)=>state.authUser,
        token:(state)=>state.authToken
    },
    actions:{
        async getToken(){
            await axios.get('/sanctum/csrf-cookie');
        },
        async login(form){
            await this.getToken();
            await axios.post('/api/auth/login',form).then((res)=>{
                this.authToken = res.data.token;
                this.authUser = res.data.data;
                this.router.push('/productos');
            }).catch((errors)=>{
                let desc = '';
                errors.response.data.errors.map((e)=>{
                    desc = desc + ' '+e;
                });
                show_alerta(desc,'error','');
            });
        },
        async register(form){
            await this.getToken();
            await axios.post('/api/auth/register',form).then((res)=>{
                show_alerta(res.data.message,'success','');
                setTimeout(()=>this.router.push('/productos'),2000);
            }).catch((errors)=>{
                let desc = '';
                console.log('errors',errors)
                errors.response.data.errors.map((e)=>{
                    desc = desc + ' '+e;
                });
                show_alerta(desc,'error','');
            });
        },
        async logout()
        {
            axios.defaults.headers.common['Authorization'] = 'Bearer '+this.authToken;
            await axios.get('/api/auth/logout');
            this.authToken = null;
            this.authUser = null;
            this.router.push('/login');
        }
    }
});