import { writable } from 'svelte/store';

function createDeleteModal() {
    const defaultData = {
        showDialog: false,
        confirmed: false,
        canceled: false,
        title: '',
        //description: 'دقت کنید که پس از حذف، دیگر امکان بازگشت وجود ندارد.',
        deleteUrl: '',
        urlParams: [],
    };
    const { subscribe, set, update } = writable(defaultData);

    return {
        subscribe,
        show: (title, deleteUrl, urlParams = []) => {
            update(() => ({
                ...defaultData,
                showDialog: true,
                title: title,
                deleteUrl: deleteUrl,
                urlParams: urlParams,
            }));
        },
        confirm: () => update(() => ({...defaultData, confirmed: true})),
        cancel: () => update(() => ({...defaultData, canceled: true})),
        reset: () => set(defaultData)
    };
}

export const deleteModal = createDeleteModal();
