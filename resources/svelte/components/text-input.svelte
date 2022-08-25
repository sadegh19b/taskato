<script>
    import { afterUpdate, createEventDispatcher } from "svelte";
    import { fly } from 'svelte/transition';

    import Icon from "./icon.svelte";

    const dispatch = createEventDispatcher();

    export let type = ''; // list or group
    export let inputValue = '';
    export let placeholder = '';
    export let widthClass = 'w-full';
    export let textSelected = true;
    export let inputFocus = true;

    let inputRef = null;

    if (type === 'list') {
        placeholder = 'عنوان لیست';
        inputValue = inputValue === '' ? 'لیست جدید' : inputValue;
    } else if (type === 'group') {
        placeholder = 'عنوان گروه';
        inputValue = inputValue === '' ? 'گروه جدید' : inputValue;
    }

    const onFocus = (event) => {
        if (textSelected) {
            event.target.select();
        }
    }

    function save() {
        let formData = {
            input: inputValue,
        }

        dispatch("save", formData);
    }

    function handleKeydown(event) {
        // 27 : Esc
        if (event.keyCode === 27 && inputRef !== null) {
            inputRef = null;
            dispatch("cancel");
        }

        // 13 : Enter
        if (event.keyCode === 13 && inputRef !== null) {
            save();
        }
    }

    afterUpdate(() => {
        if (inputRef !== null && inputFocus) {
            inputRef.focus();
        }
    });
</script>

<svelte:window on:keydown={handleKeydown}/>

<div in:fly={{ x: 200 }} class={widthClass}>
    {#if type === 'list'}
        <Icon name="list" sizeClass="w-8 h-8" />
    {:else if type === 'group'}
        <Icon name="folder" sizeClass="w-8 h-8" />
    {/if}
    <input type="text" placeholder={placeholder}
           class="input input-bordered input-primary {widthClass}"
           on:focus={onFocus} bind:value={inputValue} bind:this={inputRef} />
</div>
