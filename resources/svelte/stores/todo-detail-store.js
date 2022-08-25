import { writable } from 'svelte/store';

function createTodoDetail() {
    const defaultData = {
        showCard: false,
        todo: [],
    };
    const { subscribe, set, update } = writable(defaultData);

    return {
        subscribe,
        show: (todo) => {
            update(() => ({
                showCard: true,
                todo: todo,
            }));
        },
        reset: () => set(defaultData)
    };
}

export const todoDetail = createTodoDetail();
