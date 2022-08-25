<script>
    import { createEventDispatcher } from "svelte";
    import { Inertia } from "@inertiajs/inertia";
    import { page } from '@inertiajs/inertia-svelte';
    import { deleteModal } from "../../stores/delete-modal-store";

    import Icon from "../icon.svelte";

    const dispatch = createEventDispatcher();
    const route = window.route;

    $: current_list = $page.props.current_list;

    let groups = null;
    $: if (current_list !== null) {
        groups = $page.props.categories.filter(item => item.is_group === true && item.id !== current_list.parent_id) ?? null;
    }

    export let isListInGroup;
    export let canDeleteCompleteTodos;

    let showGroups = false;

    function transferToAnotherGroup(id) {
        Inertia.post(route('categories.transfer_to_group', current_list.id), {group_id: id});
    }

    function removeFromGroup() {
        Inertia.post(route('categories.remove_from_group', current_list.id));
    }

    function deleteList() {
        deleteModal.show('لیست', route('categories.destroy', current_list.id));
    }

    function deleteCompleteTodos() {
        deleteModal.show('تسک های تکمیل شده', route('todos.destroy_completed'), {category_id: current_list.id});
    }
</script>

<div class="dropdown dropdown-end" id="listActions">
    <label for="listActions" tabindex="0">
        <Icon name="more" />
    </label>
    <ul tabindex="0" class="dropdown-content menu bg-base-300 shadow rounded-box w-56">
        <li>
            <button on:click={() => dispatch('editListTitle')}>
                <Icon name="rename"/>
                <span>ویرایش نام لیست</span>
            </button>
        </li>
        {#if groups && groups.length}
            <li class:border={showGroups} class:border-base-100={showGroups}>
                <button class="flex justify-between" on:click={() => showGroups = !showGroups}>
                    <div class="flex">
                        <Icon name="folder-move"/>
                        <span class="mr-3">انتقال به گروه</span>
                    </div>
                    <Icon name="arrow-left" className="transition duration-200{showGroups ? ' transform -rotate-90' : ''}" />
                </button>
                {#if showGroups}
                    <ul class="flex position-initial">
                        {#each groups as group (group.id)}
                            <li>
                                <button class="pr-7" on:click={transferToAnotherGroup(group.id)}>
                                    <Icon name="folder"/>
                                    <span class="truncate w-36 text-right">{group.title}</span>
                                </button>
                            </li>
                        {/each}
                    </ul>
                {/if}
            </li>
        {/if}
        {#if isListInGroup}
            <li>
                <button on:click={removeFromGroup}>
                    <Icon name="folder-off"/>
                    <span>خروج لیست از گروه</span>
                </button>
            </li>
        {/if}
        {#if canDeleteCompleteTodos}
            <li class="text-red-400">
                <button on:click={deleteCompleteTodos}>
                    <Icon name="delete-sweep"/>
                    <span>حذف تکمیل شده ها</span>
                </button>
            </li>
        {/if}
        <li class="text-red-400">
            <button on:click={deleteList}>
                <Icon name="delete"/>
                <span>حذف لیست</span>
            </button>
        </li>
    </ul>
</div>

<style>
    label {
        @apply p-3 cursor-pointer;
    }
    .dropdown-content {
        @apply top-14
    }
</style>
