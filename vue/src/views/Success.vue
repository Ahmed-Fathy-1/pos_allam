<template>
    <div class="success">
        <div>
            <img src="/images/success.png" alt="success">
            <h1>Thank you for subscripe</h1>
            <a href="/" class="link" >back to home</a>
        </div>
    </div>
</template>


<style>
    .success{
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 1rem;
        height: 100vh;

       /* background:url('/src/assets/images/banner-svg.svg'); */
        background-size: cover;
        background-position: 0 0;
    }

    .success div{
        max-width: 650px;
        gap: 3rem;
        text-align: center;
    }
    .success h1{
        margin: 1rem 0 1rem;
        padding:0;
        font-size: 3rem;
    }
    .success div img{
        max-width: 300px;
    }
    .link{
        font-weight: 500;
        font-size: 1.2rem;
        color: darkcyan;
    }
</style>