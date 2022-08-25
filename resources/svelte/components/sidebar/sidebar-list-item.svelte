<script>
    import { createEventDispatcher } from "svelte";
    import { fly, slide } from 'svelte/transition';
    import { quintOut } from 'svelte/easing';
    import { Inertia } from "@inertiajs/inertia";
    import { inertia, page } from '@inertiajs/inertia-svelte'
    import { SortableList } from '@jhubbardsf/svelte-sortablejs';
    import { deleteModal } from "~store/delete-modal-store";

    import TextInput from "~component/text-input";
    import Icon from "~component/icon";

    const dispatch = createEventDispatcher();
    const route = window.route;

    export let item;
    export let isSub = false;

    $: subList = item.children;
    $: isActiveItem = window.location.href === route('todos.show', item.id);

    let isOpenGroup = $page.props.current_list ? $page.props.current_list.parent_id === item.id : false;
    let isOpenGroupSettings = false;
    let addListInputEnable = false;
    let editGroupInputEnable = false;

    const saveList = (event) => {
        let sort = Object.keys(subList);
        sort = subList.length ? parseInt(sort[subList.length - 1]) + 1 : 0;

        const formData = {
            title: event.detail.input,
            is_group: false,
            sort: sort,
            parent_id: item.id
        };

        Inertia.post(route('categories.store'), formData);
        addListInputEnable = false;
    }

    const updateGroup = (event) => {
        const formData = {
            title: event.detail.input,
        };

        item.title = formData.title;

        Inertia.put(route('categories.update', item.id), formData);
        editGroupInputEnable = false;
    }

    function ungroupLists() {
        Inertia.post(route('categories.ungroup', item.id));
    }

    function deleteGroupAndUngroupLists() {
        deleteModal.show('گروه و خروج لیست ها از گروه', route('categories.destroy', item.id), {mode: 'delete_without_list'});
    }

    function deleteGroupWithLists() {
        let modalTitle = subList.length > 0 ? 'گروه به همراه لیست های آن' : 'گروه';
        deleteModal.show(modalTitle, route('categories.destroy', item.id), {mode: 'delete_with_list'});
    }
</script>

<style>
    button {
        @apply text-right;
    }
</style>

{#if item.is_group}
    <button class="collapse collapse-arrow relative flex flex-col items-start p-0 active:bg-base-100 w-full" in:fly={{ x: 200 }}>
        <input class="absolute left-0 right-0 top-0 bottom-0 p-0" type="checkbox" bind:checked={isOpenGroup}/>
        <div class="collapse-title px-4 py-3 flex w-full">
            <Icon name="folder" className="ml-3 mt-1"/>
            {#if editGroupInputEnable}
                <TextInput widthClass="max-w-xl -mt-1 z-10" inputValue={item.title}
                          on:save={updateGroup} on:cancel={() => editGroupInputEnable = false} />
            {:else}
                <span class="truncate w-56">{item.title}</span>
            {/if}
        </div>
        <div class="collapse-content p-0 w-full -my-2">
            <ul>
                <SortableList animation="500" onSort={event => dispatch("subSort", event)}>
                    {#each subList as item (item.id)}
                        <li data-id="{item.id}">
                            <svelte:self {item} isSub={!!subList.length} />
                        </li>
                    {/each}
                </SortableList>
                {#if addListInputEnable}
                    <li>
                        <TextInput type="list" on:save={saveList} on:cancel={() => addListInputEnable = false} />
                    </li>
                {:else}
                    <li class="relative">
                        <button class="add-new-btn align-middle w-full pr-12" on:click={() => addListInputEnable = true}>
                            <Icon name="plus"/>
                            <span>افزودن لیست</span>
                        </button>
                        <div class="tooltip tooltip-left add-new-btn absolute left-0" data-tip="تنظیمات گروه"
                             on:click={() => isOpenGroupSettings = !isOpenGroupSettings}>
                            <button>
                                <Icon name="folder-setting"/>
                            </button>
                        </div>
                    </li>
                {/if}
            </ul>
            {#if isOpenGroupSettings}
                <ul transition:slide={{ delay: 100, duration: 300, easing: quintOut }}>
                    <li>
                        <button class="add-new-btn w-full pr-12" on:click={() => editGroupInputEnable = true}>
                            <Icon name="folder-edit"/>
                            <span>ویرایش نام گروه</span>
                        </button>
                    </li>
                    {#if subList.length > 0 }
                        <li>
                            <button class="add-new-btn w-full pr-12" on:click={ungroupLists}>
                                <Icon name="folder-off"/>
                                <span>خروج لیست ها از گروه</span>
                            </button>
                        </li>
                        <li>
                            <button class="add-new-btn w-full pr-12" on:click={deleteGroupAndUngroupLists}>
                                <Icon name="folder-remove"/>
                                <span>خروج لیست ها و حذف گروه</span>
                            </button>
                        </li>
                    {/if}
                    <li>
                        <button class="add-new-btn w-full pr-12" on:click={deleteGroupWithLists}>
                            <Icon name="folder-delete"/>
                            {#if subList.length > 0 }
                                <span>حذف گروه به همراه لیست ها</span>
                            {:else}
                                <span>حذف گروه</span>
                            {/if}
                        </button>
                    </li>
                </ul>
            {/if}
        </div>
    </button>
{:else}
    <button use:inertia={{ href: route('todos.show', item.id) }} class="w-full" class:active={isActiveItem} class:pr-12={isSub} in:fly={{ x: 200 }}>
        <Icon name="list"/>
        <span class="truncate {isSub ? 'w-56' : 'w-64'}">{item.title}</span>
    </button>
{/if}
