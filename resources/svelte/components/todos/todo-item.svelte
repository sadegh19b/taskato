<script>
    import { createEventDispatcher } from "svelte";
    import { scale } from 'svelte/transition';
    import { Inertia } from "@inertiajs/inertia";
    import { todoDetail } from "../../stores/todo-detail-store";

    import Icon from "../icon.svelte";

    const dispatch = createEventDispatcher();
    const route = window.route;

    export let todo;
    export let active = false;
    export let editMode = false;

    $: todoChecked = todo.done_at;
    $: importantChecked = todo.is_important;
    $: importantStatus = importantChecked ? 'star' : 'star-outline';
    $: inputValue = todo.title;

    function toggleTodo() {
        const audio = document.getElementById('completeTodoSound');

        todoChecked = !todoChecked;
        todo.done_at = todoChecked;

        Inertia.post(route('todos.toggle_todo', todo.id));

        if (todoChecked)
            audio.play();
    }

    function toggleImportant() {
        importantChecked = !importantChecked;
        importantStatus = importantChecked ? 'star' : 'star-outline';
        todo.is_important = importantChecked;

        Inertia.post(route('todos.toggle_important', todo.id));
    }

    function showTodoDetail() {
        if ($todoDetail.showCard && $todoDetail.todo.id === todo.id)
            todoDetail.reset();
        else
            todoDetail.show(todo);
    }

    function todoEditBlurInput() {
        dispatch('updateTodoTitle', inputValue);
    }

    function sanitize(e) {
        e.preventDefault();
        inputValue = e.target.value;
    }
</script>

<div class="todo-container w-full relative" class:active={active} class:todo-item={!editMode} in:scale={{ duration: 500, opacity: 0.5, start: 0.7 }}>
    <div class="absolute right-4 mt-1.5">
        <input type="checkbox" class="checkbox rounded-full border-2" bind:checked={todoChecked} on:click={toggleTodo} />
    </div>
    {#if editMode}
        <input type="text" class="input input-bordered input-primary w-full" on:input={sanitize} value={inputValue} on:blur={todoEditBlurInput}/>
    {:else}
        <span class="flex flex-wrap items-center w-full h-full py-3 cursor-pointer" on:click={showTodoDetail}>{todo.title}</span>
    {/if}
    <div class="absolute left-2 p-2 hover:text-primary cursor-pointer" on:click={toggleImportant}>
        <Icon name={importantStatus} />
    </div>
</div>

<style>
    .todo-container {
        @apply flex items-center transition transition-all duration-200 rounded-lg min-h-[3.5rem] px-14 select-none;
    }
    .todo-item {
        @apply bg-base-content bg-opacity-10 hover:bg-opacity-20;
    }
    .todo-item.active {
        @apply bg-primary bg-opacity-20 hover:bg-opacity-30;
    }
    .checkbox:checked, .checkbox:checked:hover, .checkbox[checked="true"] {
        --chkbg: var(--bc);
        --chkfg: var(--b1);
        background-image: linear-gradient(-45deg, transparent 65%, hsl(var(--chkbg)) 65.99%),
            linear-gradient(45deg, transparent 75%, hsl(var(--chkbg)) 75.99%),
            linear-gradient(-45deg, hsl(var(--chkbg)) 40%, transparent 40.99%),
            linear-gradient(45deg, hsl(var(--chkbg)) 30%, hsl(var(--chkfg)) 30.99%, hsl(var(--chkfg)) 40%, transparent 40.99%),
            linear-gradient(-45deg, hsl(var(--chkfg)) 50%, hsl(var(--chkbg)) 50.99%);
        border-color: hsl(var(--chkbg));
    }
    .checkbox:hover {
        --chkbg: var(--b1);
        --chkfg: var(--bc);
        background-image: linear-gradient(-45deg, transparent 65%, hsl(var(--chkbg)) 65.99%),
            linear-gradient(45deg, transparent 75%, hsl(var(--chkbg)) 75.99%),
            linear-gradient(-45deg, hsl(var(--chkbg)) 40%, transparent 40.99%),
            linear-gradient(45deg, hsl(var(--chkbg)) 30%, hsl(var(--chkfg)) 30.99%, hsl(var(--chkfg)) 40%, transparent 40.99%),
            linear-gradient(-45deg, hsl(var(--chkfg)) 50%, hsl(var(--chkbg)) 50.99%);
        border-color: hsl(var(--chkfg));
    }
</style>
