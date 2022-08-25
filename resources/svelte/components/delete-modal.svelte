<script>
    import { afterUpdate } from "svelte";
    import { fly, fade } from "svelte/transition";
    import { Inertia } from "@inertiajs/inertia";
    import { deleteModal } from "../stores/delete-modal-store";

    const toggleSidebarZIndex = () => {
        document.querySelector('.drawer-side').classList.toggle('drawer-side-z-index');
    }

    afterUpdate(() => {
        if ($deleteModal.showDialog)
            toggleSidebarZIndex();
    });

    function cancel () {
        toggleSidebarZIndex();
        deleteModal.cancel();
    }

    function confirm () {
        Inertia.delete($deleteModal.deleteUrl, {data: $deleteModal.urlParams});
        toggleSidebarZIndex();
        deleteModal.confirm();
    }

    function handleKeydown(event) {
        // 27 : Esc
        if (event.keyCode === 27 && $deleteModal.showDialog) {
            cancel();
        }
    }
</script>

<svelte:window on:keydown={handleKeydown}/>

{#if $deleteModal.showDialog}
    <div class="modal-overlay" in:fade={{ duration: 200 }} out:fade={{ delay: 200, duration: 200 }} on:click={cancel}></div>
    <div class="modal opacity-100 visible pointer-events-auto" in:fly={{ y: -10, delay: 200, duration: 200 }} out:fly={{ y: -10, duration: 200 }}>
        <div class="modal-box z-[999]">
            <h3 class="font-bold text-lg">آیا از حذف {$deleteModal.title}، اطمینان دارید؟</h3>
            <p class="py-4">دقت کنید که پس از حذف، دیگر امکان بازگشت وجود ندارد.</p>
            <div class="modal-action">
                <button class="modal-btn-cancel" on:click={cancel}>انصراف</button>
                <button class="modal-btn-confirm" on:click={confirm}>بله، حذف کن!</button>
            </div>
        </div>
    </div>
{/if}
