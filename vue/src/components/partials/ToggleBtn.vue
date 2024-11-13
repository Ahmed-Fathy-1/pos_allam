<template>
    <button
        @click="onButtonClick"
        class="birgier-icon d-lg-none d-flex d-flex flex-column justify-content-between align-items-center"
    >
        <span></span>
        <span></span>
        <span></span>
    </button>
</template>

<script>
export default {
    props:{
        onButtonClick:{
            type:Function,
            required: false
        }
    }
}
</script>

<style >
    .birgier-icon {
        min-height: 20px;
        cursor: pointer;
        transition: 1s;
        padding: 5px;
        span {
            display: block;
            width: 30px;
            height: 2px;
            margin-bottom: 3px;
            background-color: var(--bs-white);
        }
    }
</style>