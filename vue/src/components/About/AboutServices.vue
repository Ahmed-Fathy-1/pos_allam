<template>
   <section class="about-services">
        <div class="services__img">
            <img src="/images/about/about-services-labtop.webp" alt="">
        </div>
        <div class="servces__text">
            <article class="serve">
                <div class="icon">
                    <img src="/images/about/design.png" alt="">
                </div>
                <div class="content">
                    <h3>Ui design</h3>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rerum at iusto nihil.
                    </p>
                </div>
            </article> 
            
            <article class="serve">
                <div class="icon">
                    <img src="/images/about/programing.png" alt="">
                </div>
                <div class="content">
                    <h3>web developing</h3>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rerum at iusto nihil.
                    </p>
                </div>
            </article>            


            <article class="serve">
                <div class="icon">
                    <img src="/images/about/ai.png" alt="">
                </div>
                <div class="content">
                    <h3>Ai services</h3>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rerum at iusto nihil.
                    </p>
                </div>
            </article>            

        </div>
   </section>
</template>


<style lang="scss" scoped>
    .about-services{
        @media (min-width:767px) {
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 10px;
            padding-bottom: 10px; 
        }
    }
    .services__img {
        position: relative;
        text-align: center;
        margin-bottom:3rem;

        &::before{
                content: '';
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%,-50%);
                width: 320px;
                height: 220px;

              
                border-radius: 50%;
                background-color: var(--bs-primary);

                border: 15px solid #ffebd7;
                z-index: -1;

                @media (min-width:767px){
                    width: 450px;
                    height: 450px;
                }
            }

    }
    .services__img img{
        max-width:250px;

        @media (min-width:767px){
            max-width: 550px;
        }
    }
    .servces__text{
        max-width: 350px;
        padding-left: 2rem;
    }

    /* #ffebd7 */

    .serve{
        display: flex;
        gap: 1rem;

        &:not(:last-of-type){
            margin-bottom: 1.2rem;
        }

        @media (min-width:767px){
            &:not(:last-of-type){
             margin-bottom: 1.7rem;
            }
        }

        

        .icon{
            min-width:40px;
            height: 40px;
            margin-top:4px;
            border-radius: 50%;
            border: 1px solid #ccc;


            display: flex;
            align-items: center;
            justify-content: center;

            img{
                width: 26px;
            }
        }

        h3{
            font-size: 1.3rem;
            color: #002b41;

            @media (min-width:767px){
                font-size: 1.7rem;
            }
        }
    }
    
</style>