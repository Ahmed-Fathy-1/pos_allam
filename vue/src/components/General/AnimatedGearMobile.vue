<template setup>
    <div class="gear-parent">
        <img src="/settings.png" alt="">
    </div>
</template>

<style scoped>
    .gear-parent{
        width: 45px;
        height: 45px;
        margin: 20px auto 0;
        animation: gear-rotation 3s linear infinite;
    }

    .gear-parent img{
        width: 100%;
        height: 100%;
    }
</style>


<style scoped>
    @media (min-width:1024px){
        .gear-parent{ 
            height: 80px;
            width: 80px;
            margin: 40px auto 0;
        }
    }
</style>