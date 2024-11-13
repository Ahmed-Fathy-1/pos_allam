<template>
    <div class="about-cover">
        <div>
            <div class="cover__intro">
                <h2>{{ data.title }}</h2>
                <p class="cover__desc text-center">
                   {{ data.desc }}
                </p>
                <div class="btns d-none">
                    <RouterLink to="/">
                        <div></div>
                        <img :src="data.image" alt="">
                        <span>Back to home</span>
                    </RouterLink>
                    <RouterLink to="/">
                        <div></div>
                        <img src="/images/about/plan-icon.png" alt="">
                        <span>Go to plan</span>
                    </RouterLink>
                </div>
            </div> 

            <div class="cover__wrapper">
                <!--img src="/images/about/about-cover-labtop.webp" alt=""-->
                <img src="/images/about/about-screen-monitor.jpg" alt="">
            </div>
        </div>
    </div>
</template>

<script setup>
import { RouterLink } from 'vue-router';


const props = defineProps({
    data:{
        type:Object,
        Required:true
    }
})


console.log('cover' , props.data);


</script>


<style lang="scss">

    .about-cover{
        padding-top: 50px;
        

        @media (min-width:665px) {
            padding-top: 0px;
        }

    }

    .cover__wrapper{
        margin-bottom: 3rem;
    }


    .about-cover , .cover__wrapper{
        display: flex;
        justify-content: center;
        align-items: center;
        color: #1c1c1c;
    }


    .about-cover{
       /* position: relative;
        height: 100vh;
        max-height: 650px;*/
    }

    .cover__intro{
        text-align: center;
    }


    .cover__intro .cover__desc{
        max-width: 1000px;
        font-size:1rem;
        color: #666;
        padding: 0 .5rem;
        margin: 1rem auto;
        white-space: wrap;

        @media (min-width:767px){
            margin: 2rem auto;
        }
    }

    .cover__intro .btns{
        a{
            position: relative;
            display: block;
            width:220px;
            margin:1rem auto;
            padding: .75rem 0 .75rem 70px;
            font-weight: 500;
            text-align: start;

            background: #fff;
            border-radius: 4px;
            border: 1px solid  rgb(255 159 67);
            color: #1c1c1c;
            box-shadow: 1px 1px 5px 1px #ddd;
            text-decoration: none;
            transition: color .5s ease-in-out;
            overflow: hidden;

            @media (min-width:665px) {
                display: inline-block;
                margin:0 .5rem;
            }

            img{
                max-width: 20px;
                position: absolute;
                top: 50%;
                left: 1rem;
                transform: translateY(-50%);
            }

            &:hover{
                background-color: rgb(255 159 67);
                div{
                    background-color: #fff;
                }
            }
            
        }
    }

</style>


<style lang="scss" scoped>
     .cover__wrapper{


        @media (min-width:767px){

        }

         img{
          /*  max-width: 90%;*/
        }


    }
</style>