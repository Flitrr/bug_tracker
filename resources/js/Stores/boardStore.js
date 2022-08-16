import {defineStore} from "pinia";
import {ref} from "vue";

export const useBoardStore = defineStore('board', () => {
    const board = ref(null);
    const boards = ref(null);

    async function update(boardId) {
        try {
            const response = await window.axios.get(`/api/boards/${boardId}`, {headers: {'Accept': 'application/json'}});
            board.value = response.data;
        } catch (e) {
            console.error(e);
        }
    }

    async function updateMany(boardIds) {
        const boards_list = [];
        for (const id of boardIds) {
            try {
                const response = await window.axios.get(`/api/boards/${id}`, {headers: {'Accept': 'application/json'}});
                boards_list.push(response.data);
            } catch (e) {
                console.error(e);
            }
        }
        boards.value = boards_list;
    }

    return {board, update, updateMany, boards}
})
