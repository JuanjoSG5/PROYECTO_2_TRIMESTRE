import { defineStore } from 'pinia'

export const useAuthStore = defineStore('auth', {
    state: () => ({
        
        user: {}
    }),
    getters: {
        isLoggedIn() {
            return !!this.token
        }
    },
    actions: {
        async logIn(formData) {
            console.log('Logging in');
            const postRequest = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(formData)
            };

            console.log('Sending post request:', postRequest);
            await fetch('http://localhost:9000/api/login', postRequest)
                .then(response => response.json())
                .then(data => {
                    this.user = data;
                    console.log('User:', this.user);
                })
                .catch((error) => {
                    return false
                });
        },

        async register(formData) {
            console.log(JSON.stringify(formData));

            const postRequest = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(formData)
            };
            console.log('Sending post request:', postRequest);
            await fetch('http://localhost:9000/api/register', postRequest)
                .then(response => response.json())
                .then(data => {
                    this.user = data;
                    console.log('User:', this.user);
                })
                .catch((error) => {
                    formData[formData.length - 1] = { errorMessage: 'Error:', error };
                });
        },
        logout() {
            this.user = {
                id: "",
                username: "",
                email: "",
                token: null
            }
        },
    },


    persist: {
        enabled: true,
        strategies: [{
            key: 'my-user-store',
            storage: localStorage,

        }]
        // If you want to use a custom storage provider
        // storage: myStorageProvider,
    }
})