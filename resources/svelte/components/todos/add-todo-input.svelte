<script>
    import { createEventDispatcher } from "svelte";

    import Icon from "~component/icon";

    const dispatch = createEventDispatcher();

    let inputValue;
    let iconName = 'plus';
    const _placeholderText = 'تسک را بنویسید و Enter بزنید';
    let placeholder = _placeholderText;

    function handleFocus() {
        iconName = 'circle-outline';
        placeholder = '';
    }

    function handleBlur() {
        iconName = 'plus';
        placeholder = _placeholderText;
    }

    function save() {
        let formData = {
            input: inputValue,
        }

        inputValue = '';
        dispatch("save", formData);
    }

    function handleKeydown(event) {
        // 13 : Enter
        if (event.keyCode === 13) {
            save();
        }
    }
</script>

<svelte:window on:keydown={handleKeydown}/>

<div class="absolute bottom-8 left-8 right-8 flex items-center">
    <Icon name="{iconName}" sizeClass="w-8 h-8" className="absolute right-2" />
    <input type="text" placeholder="{placeholder}" class="input input-bordered input-primary w-full pr-12"
           bind:value={inputValue} on:focus={handleFocus} on:blur={handleBlur} />
</div>
