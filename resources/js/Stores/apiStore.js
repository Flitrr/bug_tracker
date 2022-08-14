import {defineStore} from "pinia";
import {ref} from "vue";

export const useApiStore = defineStore('api',   () => {
    const userData = ref(null)
    async function update() {
        try {
            const response = await axios.get('/user')
            userData.value = response.data;
        } catch (e) {
            console.error(e);
        }
    }
    return { userData, update }

})
