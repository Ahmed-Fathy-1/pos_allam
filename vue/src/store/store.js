import axios from 'axios';
import { defineStore } from 'pinia';
import { extrnalUrl } from '@/config';

export const useAuthStore = defineStore('auth', {
    state: () => ({
        authUser: null,
        token: '',
    }),
    getters: {
        user: (state) => state.authUser,
        isAuthenticated: (state) => !!state.token, 
    },
    actions: {
        setAuthorizationHeader() {
            if (this.token) {
                axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
            } else {
                delete axios.defaults.headers.common['Authorization'];
            }
        },
        async login(credentials) {
            try {
                const response = await axios.post(`${extrnalUrl}auth/login`, credentials);
                this.authUser = response.data.data.user; 
                this.token = response.data.data.user.token; 

                localStorage.setItem('token', this.token);
                localStorage.setItem('authUser', JSON.stringify(this.authUser));
                // this.setAuthorizationHeader();

            } catch (error) {
                console.error('Login failed:', error);
                throw error;
            }
        }, 
        async register(credentials) {
            try {
                const response = await axios.post(`${extrnalUrl}auth/register`, credentials);
                this.authUser = response.data.data.user; 
                this.token = response.data.data.user.token; 

                localStorage.setItem('token', this.token);
                localStorage.setItem('authUser', JSON.stringify(this.authUser));
                //this.setAuthorizationHeader();

            } catch (error) {
                console.error('Login failed:', error);
                throw error;
            }
        },
        async logout() {
            try{
                const response = await axios.post(`${extrnalUrl}auth/logout`,{}, {
                    headers:{
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${this.token}`,
                    },
                });
            }
            catch(error){
                console.log(error);
            }
            this.authUser = null;
            this.token = '';
            localStorage.removeItem('token'); 
            localStorage.removeItem('authUser')
        },
        async initialize() {
            const token = localStorage.getItem('token');
            const authUser = JSON.parse(localStorage.getItem('authUser'))
            if (token) {
                this.token = token;
                this.authUser = authUser;
               //this.setAuthorizationHeader();
               // await this.getUser();
            }
        },
        async getUser() {
            const token = localStorage.getItem('token');
            const authUser = JSON.parse(localStorage.getItem('authUser'))
            if (token) {
                this.token = token;
                this.authUser = authUser;
                return  authUser
            }
        },
    },
});
