<script>
    import { afterUpdate } from "svelte";
    import { Inertia } from "@inertiajs/inertia";
    import { todoDetail } from "~store/todo-detail-store";
    import { deleteModal } from "~store/delete-modal-store";

    import TodoItem from "~component/todos/todo-item";
    import Icon from "~component/icon";

    const route = window.route;

    export let todo;

    $: todoChecked = todo.done_at;
    $: todoStatus = todoChecked ? 'circle-checked' : 'circle-outline';
    $: importantChecked = todo.is_important;
    $: importantStatus = importantChecked ? 'star' : 'star-outline';
    $: titleInput = todo.title;
    $: descriptionInput = todo.description;

    let editTodo = false;

    function updateTodo() {
        const formData = {
            title: titleInput,
            description: descriptionInput,
        };

        todo.title = titleInput === '' ? todo.title : titleInput;
        todo.description = descriptionInput === '' ? null : descriptionInput;

        Inertia.put(route('todos.update', todo.id), formData);
        editTodo = false;
    }

    function deleteTodo() {
        deleteModal.show('تسک', route('todos.destroy', todo.id));
    }

    function cancelEdit() {
        editTodo = false;
        descriptionInput = todo.description;
    }

    function sanitize(e) {
        e.preventDefault();
        descriptionInput = e.target.value;
    }

    afterUpdate(() => {
        if ($deleteModal.confirmed) {
            todoDetail.reset();
            deleteModal.reset();
        }
    });
</script>

<div class="card bg-base-200 shadow-xl">
    <div class="card-body min-h-[90vh] max-h-[90vh] pb-32 relative">
        {#if editTodo}
            <TodoItem {todo} editMode={true} on:updateTodoTitle={event => titleInput = event.detail} />
            <div class="my-4">
                <textarea class="textarea textarea-primary w-full resize-none" on:input={sanitize} placeholder="توضیحات تسک ..." rows="16">{descriptionInput}</textarea>
            </div>
            <div class="absolute left-0 bottom-0 w-full">
                <div class="flex justify-around items-center">
                    <button class="btn-cancel" on:click={cancelEdit}>
                        <Icon name="undo" />
                        <span class="mr-1">انصراف</span>
                    </button>
                    <button class="btn-save" on:click={updateTodo}>
                        <Icon name="save" />
                        <span class="mr-1">ذخیره</span>
                    </button>
                </div>
            </div>
        {:else}
            <div class="flex items-center w-full relative px-8">
                <div class="absolute right-0">
                    <Icon name={todoStatus} />
                </div>
                <strong class="flex flex-wrap items-center w-full h-full py-3">{todo.title}</strong>
                <div class="absolute left-0">
                    <Icon name={importantStatus} />
                </div>
            </div>
            <div class="flex my-4 overflow-hidden" title="توضیحات تسک">
                <div class="mt-1">
                    <Icon name="note" />
                </div>
                {#if todo.description !== null}
                    <p class="mr-2 leading-loose overflow-y-auto">{todo.description}</p>
                {:else}
                    <p class="mt-1 mr-2 text-base-content text-opacity-40">بدون توضیحات</p>
                {/if}
            </div>
            <!--Todo: need to updated times after submit actions like edit or done todo or ...-->
            <div class="absolute left-0 bottom-14 w-full px-8 py-5">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <Icon name="date" />
                        <div class="mr-2">
                            <div>زمان ایجاد: </div>
                            <div>{todo.created_at_persian}</div>
                        </div>
                    </div>
                    {#if todo.updated_at_persian !== null}
                    <div class="flex items-center">
                        <Icon name="date-edit" />
                        <div class="mr-2">
                            <div>زمان ویرایش: </div>
                            <div>{todo.updated_at_persian}</div>
                        </div>
                    </div>
                    {/if}
                    {#if todo.done_at !== null}
                        <div class="flex items-center">
                            <Icon name="date-checked" />
                            <div class="mr-2">
                                <div>زمان انجام: </div>
                                <div>{todo.done_at_persian}</div>
                            </div>
                        </div>
                    {/if}
                </div>
            </div>
            <div class="absolute left-0 bottom-0 w-full">
                <div class="flex justify-around items-center">
                    <button class="btn-edit" on:click={() => editTodo = true}>
                        <Icon name="rename" />
                        <span class="mr-1">ویرایش تسک</span>
                    </button>
                    <button class="btn-delete" on:click={deleteTodo}>
                        <Icon name="delete" />
                        <span class="mr-1">حذف تسک</span>
                    </button>
                </div>
            </div>
        {/if}
    </div>
</div>
