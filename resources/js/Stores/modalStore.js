import {defineStore} from "pinia";
import {ref} from "vue";

export const useModalStore = defineStore('modals',   () => {
    const showNewColumnModalBoardsOne = ref(false)
    const showAddBugToColumn = ref(false);
    const createBoardModal = ref(false);
    const editBugOnBoard = ref(false);

    return {showNewColumnModalBoardsOne, showAddBugToColumn, createBoardModal, editBugOnBoard}
})
