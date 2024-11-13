<template>

    <div className='social-bar'>
        <a className='facebook' href="https://web.facebook.com/facebook.comibrahimyoussef.saleh/?locale=ar_AR" target="_blank" rel="noopener noreferrer">
            <img src="/facebook.png" alt="f">
        </a>
        <a className='linkedin' href="https://web.facebook.com/facebook.comibrahimyoussef.saleh/?locale=ar_AR" target="_blank" rel="noopener noreferrer">
            <img src="/linkedin.png" alt="In">
        </a>
        <a className='github' href="https://web.facebook.com/facebook.comibrahimyoussef.saleh/?locale=ar_AR" target="_blank" rel="noopener noreferrer">
            <img src="/github.png" alt="git">
        </a>
        <a className='whatsapp' href="https://web.facebook.com/facebook.comibrahimyoussef.saleh/?locale=ar_AR" target="_blank" rel="noopener noreferrer">
            <img src="/whatsapp.png" alt="Wup">
        </a>
    </div>

</template>


<style scoped>
    .social-bar{
        display: flex;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
        padding-left: 1rem;

        a{
            display:block;
            width: 35px;
            max-width: 35px;
            height: 35px;
            box-sizing: border-box;
            border-radius: 4px;
            transition: transform .2s ease-in-out;
            overflow: hidden;

            &:hover{
                transform: perspective(500px) translate3d(-5px, -5px, 50px);
            }

            &:last-of-type{
                padding: 5px;
                background: #2daa2d;
            }

            img{
                width: 100%;
                height: 100%;
            }
        }
    }
</style>