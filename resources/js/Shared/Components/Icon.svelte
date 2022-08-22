<script>
    export let name;
    export let sizeClass = 'w-6 h-6';
    export let className = '';
</script>

{#if name === 'home'}
    <svg class="{sizeClass} {className}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <path d="M0 0h24v24H0V0z" fill="none"/>
        <path d="M10 19v-5h4v5c0 .55.45 1 1 1h3c.55 0 1-.45 1-1v-7h1.7c.46 0 .68-.57.33-.87L12.67 3.6c-.38-.34-.96-.34-1.34 0l-8.36 7.53c-.34.3-.13.87.33.87H5v7c0 .55.45 1 1 1h3c.55 0 1-.45 1-1z"/>
    </svg>
{:else if name === 'dashboard'}
    <svg class="{sizeClass} {className}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <path d="M0 0h24v24H0V0z" fill="none"/>
        <path d="M4 13h6c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v8c0 .55.45 1 1 1zm0 8h6c.55 0 1-.45 1-1v-4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v4c0 .55.45 1 1 1zm10 0h6c.55 0 1-.45 1-1v-8c0-.55-.45-1-1-1h-6c-.55 0-1 .45-1 1v8c0 .55.45 1 1 1zM13 4v4c0 .55.45 1 1 1h6c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1h-6c-.55 0-1 .45-1 1z"/>
    </svg>
{:else if name === 'plus'}
    <svg class="{sizeClass} {className}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <path d="M0 0h24v24H0V0z" fill="none"/>
        <path d="M18 13h-5v5c0 .55-.45 1-1 1s-1-.45-1-1v-5H6c-.55 0-1-.45-1-1s.45-1 1-1h5V6c0-.55.45-1 1-1s1 .45 1 1v5h5c.55 0 1 .45 1 1s-.45 1-1 1z"/>
    </svg>
{:else if name === 'folder'}
    <svg class="{sizeClass} {className}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <path d="M0 0h24v24H0V0z" fill="none"/>
        <path d="M10.59 4.59C10.21 4.21 9.7 4 9.17 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2h-8l-1.41-1.41z"/>
    </svg>
{:else if name === 'folder-add'}
    <svg class="{sizeClass} {className}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <path d="M0 0h24v24H0V0z" fill="none"/>
        <path d="M20 6h-8l-1.41-1.41C10.21 4.21 9.7 4 9.17 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-2 8h-2v2c0 .55-.45 1-1 1s-1-.45-1-1v-2h-2c-.55 0-1-.45-1-1s.45-1 1-1h2v-2c0-.55.45-1 1-1s1 .45 1 1v2h2c.55 0 1 .45 1 1s-.45 1-1 1z"/>
    </svg>
{:else if name === 'folder-list'}
    <svg class="{sizeClass} {className}" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="currentColor">
        <g>
            <rect fill="none" height="24" width="24"/>
            <path d="M20,6h-8l-1.41-1.41C10.21,4.21,9.7,4,9.17,4H4C2.9,4,2.01,4.9,2.01,6L2,18c0,1.1,0.9,2,2,2h16c1.1,0,2-0.9,2-2V8 C22,6.9,21.1,6,20,6z M13,16H7c-0.55,0-1-0.45-1-1c0-0.55,0.45-1,1-1h6c0.55,0,1,0.45,1,1C14,15.55,13.55,16,13,16z M17,12H7 c-0.55,0-1-0.45-1-1c0-0.55,0.45-1,1-1h10c0.55,0,1,0.45,1,1C18,11.55,17.55,12,17,12z"/>
        </g>
    </svg>
{:else if name === 'folder-move'}
    <svg class="{sizeClass} {className}" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="currentColor">
        <rect fill="none" height="24" width="24"/>
        <path d="M20,6h-8l-1.41-1.41C10.21,4.21,9.7,4,9.17,4H4C2.9,4,2,4.9,2,6v12c0,1.1,0.9,2,2,2h16c1.1,0,2-0.9,2-2V8 C22,6.9,21.1,6,20,6z M11.15,16.15l-2.79-2.79c-0.2-0.2-0.2-0.51,0-0.71l2.79-2.79C11.46,9.54,12,9.76,12,10.21V12h3 c0.55,0,1,0.45,1,1v0c0,0.55-0.45,1-1,1h-3v1.79C12,16.24,11.46,16.46,11.15,16.15z"/>
    </svg>
{:else if name === 'folder-off'}
    <svg class="{sizeClass} {className}" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="currentColor">
        <g><rect fill="none" height="24" width="24"/><rect fill="none" height="24" width="24"/></g>
        <g><g><path d="M2.81,2.81c-0.39-0.39-1.02-0.39-1.41,0C1,3.2,1,3.83,1.39,4.22l0.85,0.85C2.1,5.35,2.01,5.66,2.01,6L2,18 c0,1.1,0.9,2,2,2h13.17l2.61,2.61c0.39,0.39,1.02,0.39,1.41,0c0.39-0.39,0.39-1.02,0-1.41L2.81,2.81z"/>
            <path d="M20,6h-8l-1.41-1.41C10.21,4.21,9.7,4,9.17,4H6.83l14.93,14.93C21.91,18.65,22,18.34,22,18V8C22,6.9,21.1,6,20,6z"/></g></g>
    </svg>
{:else if name === 'folder-setting'}
    <svg class="{sizeClass} {className}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <path fill="currentColor" d="M4 4c-1.11 0-2 .89-2 2v12a2 2 0 0 0 2 2h8.08a7 7 0 0 1-.08-1a7 7 0 0 1 7-7a7 7 0 0 1 3 .69V8a2 2 0 0 0-2-2h-8l-2-2H4m14 10a.26.26 0 0 0-.26.21l-.19 1.32c-.3.13-.59.29-.85.47l-1.24-.5c-.11 0-.24 0-.31.13l-1 1.73c-.06.11-.04.24.06.32l1.06.82a4.193 4.193 0 0 0 0 1l-1.06.82a.26.26 0 0 0-.06.32l1 1.73c.06.13.19.13.31.13l1.24-.5c.26.18.54.35.85.47l.19 1.32c.02.12.12.21.26.21h2c.11 0 .22-.09.24-.21l.19-1.32c.3-.13.57-.29.84-.47l1.23.5c.13 0 .26 0 .33-.13l1-1.73a.26.26 0 0 0-.06-.32l-1.07-.82c.02-.17.04-.33.04-.5c0-.17-.01-.33-.04-.5l1.06-.82a.26.26 0 0 0 .06-.32l-1-1.73c-.06-.13-.19-.13-.32-.13l-1.23.5c-.27-.18-.54-.35-.85-.47l-.19-1.32A.236.236 0 0 0 20 14h-2m1 3.5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5c-.84 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5Z"></path>
    </svg>
{:else if name === 'folder-edit'}
    <svg class="{sizeClass} {className}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <path fill="currentColor" d="M19.39 10.74L11 19.13V20H4a2 2 0 0 1-2-2V6c0-1.11.89-2 2-2h6l2 2h8a2 2 0 0 1 2 2v2.15c-.26-.09-.54-.15-.83-.15c-.67 0-1.3.26-1.78.74M13 19.96V22h2.04l6.13-6.12l-2.04-2.05L13 19.96m9.85-6.49l-1.32-1.32c-.2-.2-.53-.2-.72 0l-.98.98l2.04 2.04l.98-.98c.2-.19.2-.52 0-.72Z"></path>
    </svg>
{:else if name === 'folder-remove'}
    <svg class="{sizeClass} {className}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <path fill="currentColor" d="M13 19c0 .34.04.67.09 1H4a2 2 0 0 1-2-2V6c0-1.11.89-2 2-2h6l2 2h8a2 2 0 0 1 2 2v5.81c-.88-.51-1.9-.81-3-.81c-3.31 0-6 2.69-6 6m9.54-2.12l-1.42-1.41L19 17.59l-2.12-2.12l-1.41 1.41L17.59 19l-2.12 2.12l1.41 1.42L19 20.41l2.12 2.13l1.42-1.42L20.41 19l2.13-2.12Z"></path>
    </svg>
{:else if name === 'folder-delete'}
    <svg class="{sizeClass} {className}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <g><rect fill="none" height="24" width="24"/></g>
        <g><path d="M16.5,15.5h-2v-4h2V15.5z M20,6h-8l-1.41-1.41C10.21,4.21,9.7,4,9.17,4H4C2.9,4,2.01,4.9,2.01,6L2,18c0,1.1,0.9,2,2,2h16 c1.1,0,2-0.9,2-2V8C22,6.9,21.1,6,20,6z M18.25,11.5H18v4c0,0.83-0.67,1.5-1.5,1.5h-2c-0.83,0-1.5-0.67-1.5-1.5v-4h-0.25 c-0.41,0-0.75-0.34-0.75-0.75c0-0.41,0.34-0.75,0.75-0.75h1.75V9.75C14.5,9.34,14.84,9,15.25,9h0.5c0.41,0,0.75,0.34,0.75,0.75V10 h1.75c0.41,0,0.75,0.34,0.75,0.75C19,11.16,18.66,11.5,18.25,11.5z"/></g>
    </svg>
{:else if name === 'list'}
    <svg class="{sizeClass} {className}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <path d="M0 0h24v24H0V0z" fill="none"/>
        <path d="M4 18h16c.55 0 1-.45 1-1s-.45-1-1-1H4c-.55 0-1 .45-1 1s.45 1 1 1zm0-5h16c.55 0 1-.45 1-1s-.45-1-1-1H4c-.55 0-1 .45-1 1s.45 1 1 1zM3 7c0 .55.45 1 1 1h16c.55 0 1-.45 1-1s-.45-1-1-1H4c-.55 0-1 .45-1 1z"/>
    </svg>
{:else if name === 'more'}
    <svg class="{sizeClass} {className}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <path d="M0 0h24v24H0z" fill="none"/>
        <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
    </svg>
{:else if name === 'circle-outline'}
    <svg class="{sizeClass} {className}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <path d="M0 0h24v24H0V0z" fill="none"/>
        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/>
    </svg>
{:else if name === 'circle-checked-outline'}
    <svg class="{sizeClass} {className}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <path d="M0 0h24v24H0V0z" fill="none"/>
        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.88-11.71L10 14.17l-1.88-1.88c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41l2.59 2.59c.39.39 1.02.39 1.41 0L17.3 9.7c.39-.39.39-1.02 0-1.41-.39-.39-1.03-.39-1.42 0z"/>
    </svg>
{:else if name === 'circle-checked'}
    <svg class="{sizeClass} {className}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <path d="M0 0h24v24H0V0z" fill="none"/>
        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM9.29 16.29L5.7 12.7c-.39-.39-.39-1.02 0-1.41.39-.39 1.02-.39 1.41 0L10 14.17l6.88-6.88c.39-.39 1.02-.39 1.41 0 .39.39.39 1.02 0 1.41l-7.59 7.59c-.38.39-1.02.39-1.41 0z"/>
    </svg>
{:else if name === 'star'}
    <svg class="{sizeClass} {className}" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="currentColor">
        <g>
            <path d="M0,0h24v24H0V0z" fill="none"/>
            <path d="M0,0h24v24H0V0z" fill="none"/>
        </g>
        <g><path d="M12,17.27l4.15,2.51c0.76,0.46,1.69-0.22,1.49-1.08l-1.1-4.72l3.67-3.18c0.67-0.58,0.31-1.68-0.57-1.75l-4.83-0.41 l-1.89-4.46c-0.34-0.81-1.5-0.81-1.84,0L9.19,8.63L4.36,9.04c-0.88,0.07-1.24,1.17-0.57,1.75l3.67,3.18l-1.1,4.72 c-0.2,0.86,0.73,1.54,1.49,1.08L12,17.27z"/></g>
    </svg>
{:else if name === 'star-outline'}
    <svg class="{sizeClass} {className}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <path d="M0 0h24v24H0V0z" fill="none"/>
        <path d="M19.65 9.04l-4.84-.42-1.89-4.45c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18-1.1 4.72c-.2.86.73 1.54 1.49 1.08l4.15-2.5 4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.73 3.67-3.18c.67-.58.32-1.68-.56-1.75zM12 15.4l-3.76 2.27 1-4.28-3.32-2.88 4.38-.38L12 6.1l1.71 4.04 4.38.38-3.32 2.88 1 4.28L12 15.4z"/>
    </svg>
{:else if name === 'delete'}
    <svg class="{sizeClass} {className}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <path d="M0 0h24v24H0V0z" fill="none"/>
        <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v10zM18 4h-2.5l-.71-.71c-.18-.18-.44-.29-.7-.29H9.91c-.26 0-.52.11-.7.29L8.5 4H6c-.55 0-1 .45-1 1s.45 1 1 1h12c.55 0 1-.45 1-1s-.45-1-1-1z"/>
    </svg>
{:else if name === 'delete-outline'}
    <svg class="{sizeClass} {className}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <path d="M0 0h24v24H0V0z" fill="none"/>
        <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v10zM9 9h6c.55 0 1 .45 1 1v8c0 .55-.45 1-1 1H9c-.55 0-1-.45-1-1v-8c0-.55.45-1 1-1zm6.5-5l-.71-.71c-.18-.18-.44-.29-.7-.29H9.91c-.26 0-.52.11-.7.29L8.5 4H6c-.55 0-1 .45-1 1s.45 1 1 1h12c.55 0 1-.45 1-1s-.45-1-1-1h-2.5z"/>
    </svg>
{:else if name === 'delete-sweep'}
    <svg class="{sizeClass} {className}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <path fill="currentColor" d="M15 16h4v2h-4v-2m0-8h7v2h-7V8m0 4h6v2h-6v-2M3 18a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V8H3v10M14 5h-3l-1-1H6L5 5H2v2h12V5Z"></path>
    </svg>
{:else if name === 'rename'}
    <svg class="{sizeClass} {className}" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="currentColor">
        <g><rect fill="none" height="24" width="24"/></g>
        <g><g>
            <path d="M15,16l-4,4h8c1.1,0,2-0.9,2-2v0c0-1.1-0.9-2-2-2H15z"/>
            <path d="M12.06,7.19l-8.77,8.77C3.11,16.14,3,16.4,3,16.66V19c0,0.55,0.45,1,1,1h2.34c0.27,0,0.52-0.11,0.71-0.29l8.77-8.77 L12.06,7.19z"/>
            <path d="M18.71,8.04c0.39-0.39,0.39-1.02,0-1.41l-2.34-2.34c-0.39-0.39-1.02-0.39-1.41,0l-1.83,1.83l3.75,3.75L18.71,8.04z"/>
        </g></g>
    </svg>
{:else if name === 'arrow-left'}
    <svg class="{sizeClass} {className}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <path d="M0 0h24v24H0V0z" fill="none"/>
        <path d="M14.71 6.71c-.39-.39-1.02-.39-1.41 0L8.71 11.3c-.39.39-.39 1.02 0 1.41l4.59 4.59c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L10.83 12l3.88-3.88c.39-.39.38-1.03 0-1.41z"/>
    </svg>
{:else if name === 'arrow-down'}
    <svg class="{sizeClass} {className}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <path d="M24 24H0V0h24v24z" fill="none" opacity=".87"/>
        <path d="M15.88 9.29L12 13.17 8.12 9.29c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41l4.59 4.59c.39.39 1.02.39 1.41 0l4.59-4.59c.39-.39.39-1.02 0-1.41-.39-.38-1.03-.39-1.42 0z"/>
    </svg>
{:else if name === 'arrow-back'}
    <svg class="{sizeClass} {className}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <path d="M20 11H6.83l2.88-2.88c.39-.39.39-1.02 0-1.41-.39-.39-1.02-.39-1.41 0L3.71 11.3c-.39.39-.39 1.02 0 1.41L8.3 17.3c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L6.83 13H20c.55 0 1-.45 1-1s-.45-1-1-1z"/>
    </svg>
{:else if name === 'undo'}
    <svg class="{sizeClass} {className}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <path d="M0 0h24v24H0V0z" fill="none"/>
        <path d="M12.5 8c-2.65 0-5.05.99-6.9 2.6L3.71 8.71C3.08 8.08 2 8.52 2 9.41V15c0 .55.45 1 1 1h5.59c.89 0 1.34-1.08.71-1.71l-1.91-1.91c1.39-1.16 3.16-1.88 5.12-1.88 3.16 0 5.89 1.84 7.19 4.5.27.56.91.84 1.5.64.71-.23 1.07-1.04.75-1.72C20.23 10.42 16.65 8 12.5 8z"/>
    </svg>
{:else if name === 'date'}
    <svg class="{sizeClass} {className}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <path d="M0 0h24v24H0V0z" fill="none"/>
        <path d="M20 3h-1V2c0-.55-.45-1-1-1s-1 .45-1 1v1H7V2c0-.55-.45-1-1-1s-1 .45-1 1v1H4c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-1 18H5c-.55 0-1-.45-1-1V8h16v12c0 .55-.45 1-1 1z"/>
    </svg>
{:else if name === 'date-edit'}
    <svg class="{sizeClass} {className}" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="currentColor">
        <rect fill="none" height="24" width="24"/>
        <path d="M12,22H5c-1.11,0-2-0.9-2-2L3.01,6c0-1.1,0.88-2,1.99-2h1V3c0-0.55,0.45-1,1-1s1,0.45,1,1v1h8V3c0-0.55,0.45-1,1-1 s1,0.45,1,1v1h1c1.1,0,2,0.9,2,2v6h-2v-2H5v10h7V22z M22.13,16.99l0.71-0.71c0.39-0.39,0.39-1.02,0-1.41l-0.71-0.71 c-0.39-0.39-1.02-0.39-1.41,0l-0.71,0.71L22.13,16.99z M21.42,17.7l-5.01,5.01c-0.18,0.18-0.44,0.29-0.7,0.29H14.5 c-0.28,0-0.5-0.22-0.5-0.5v-1.21c0-0.27,0.11-0.52,0.29-0.71l5.01-5.01L21.42,17.7z"/>
    </svg>
{:else if name === 'date-checked'}
    <svg class="{sizeClass} {className}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <path d="M0 0h24v24H0V0z" fill="none"/>
        <path d="M16 10.53c-.29-.29-.77-.29-1.06 0l-4.35 4.35L9 13.29c-.29-.29-.77-.29-1.06 0-.29.29-.29.77 0 1.06l1.94 1.94c.39.39 1.02.39 1.41 0l4.7-4.7c.3-.29.3-.77.01-1.06zM19 3h-1V2c0-.55-.45-1-1-1s-1 .45-1 1v1H8V2c0-.55-.45-1-1-1s-1 .45-1 1v1H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-1 16H6c-.55 0-1-.45-1-1V8h14v10c0 .55-.45 1-1 1z"/>
    </svg>
{:else if name === 'note'}
    <svg class="{sizeClass} {className}" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="currentColor">
        <rect fill="none" height="24" width="24"/>
        <path d="M19,3H4.99C3.89,3,3,3.9,3,5l0.01,14c0,1.1,0.89,2,1.99,2h10l6-6V5C21,3.9,20.1,3,19,3z M8,8h8c0.55,0,1,0.45,1,1v0 c0,0.55-0.45,1-1,1H8c-0.55,0-1-0.45-1-1v0C7,8.45,7.45,8,8,8z M11,14H8c-0.55,0-1-0.45-1-1v0c0-0.55,0.45-1,1-1h3 c0.55,0,1,0.45,1,1v0C12,13.55,11.55,14,11,14z M14,19.5V15c0-0.55,0.45-1,1-1h4.5L14,19.5z"/>
    </svg>
{:else if name === 'save'}
    <svg class="{sizeClass} {className}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <path d="M0 0h24v24H0V0z" fill="none"/>
        <path d="M17.59 3.59c-.38-.38-.89-.59-1.42-.59H5c-1.11 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V7.83c0-.53-.21-1.04-.59-1.41l-2.82-2.83zM12 19c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm1-10H7c-1.1 0-2-.9-2-2s.9-2 2-2h6c1.1 0 2 .9 2 2s-.9 2-2 2z"/>
    </svg>
{/if}
