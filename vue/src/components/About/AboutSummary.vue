<template>
    <div class="summary">
        <div class="summary__wrapper">
            <div class="bg-wavy">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                    <path fill="#ff9f43" fill-opacity="1" d="M0,192L17.1,176C34.3,160,69,128,103,96C137.1,64,171,32,206,58.7C240,85,274,171,309,176C342.9,181,377,107,411,69.3C445.7,32,480,32,514,48C548.6,64,583,96,617,96C651.4,96,686,64,720,42.7C754.3,21,789,11,823,32C857.1,53,891,107,926,133.3C960,160,994,160,1029,144C1062.9,128,1097,96,1131,106.7C1165.7,117,1200,171,1234,170.7C1268.6,171,1303,117,1337,85.3C1371.4,53,1406,43,1423,37.3L1440,32L1440,320L1422.9,320C1405.7,320,1371,320,1337,320C1302.9,320,1269,320,1234,320C1200,320,1166,320,1131,320C1097.1,320,1063,320,1029,320C994.3,320,960,320,926,320C891.4,320,857,320,823,320C788.6,320,754,320,720,320C685.7,320,651,320,617,320C582.9,320,549,320,514,320C480,320,446,320,411,320C377.1,320,343,320,309,320C274.3,320,240,320,206,320C171.4,320,137,320,103,320C68.6,320,34,320,17,320L0,320Z"></path>
                </svg>

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                    <path fill="#ff9f43" fill-opacity="1" d="M0,96L30,85.3C60,75,120,53,180,90.7C240,128,300,224,360,266.7C420,309,480,299,540,282.7C600,267,660,245,720,224C780,203,840,181,900,160C960,139,1020,117,1080,128C1140,139,1200,181,1260,192C1320,203,1380,181,1410,170.7L1440,160L1440,0L1410,0C1380,0,1320,0,1260,0C1200,0,1140,0,1080,0C1020,0,960,0,900,0C840,0,780,0,720,0C660,0,600,0,540,0C480,0,420,0,360,0C300,0,240,0,180,0C120,0,60,0,30,0L0,0Z"></path>
                </svg>
            </div>
            
            <div class="summary__content">
                <div class="summary__text">
                    <h2>{{ data.title }}</h2>
                    <p>
                      {{ data.desc }}
                    </p>
                </div>
                <div class="summary__img">
                    <img :src="data.image" alt="">
                </div>
            </div>
            
            
        </div>
    </div>
</template>

<script setup>

const props = defineProps({

    data:{
        type:Object,
        Required:false
    }
})

</script>

<style scoped lang="scss" >
    .summary__wrapper{
        position: relative;
        top: -10px;
        min-height: 600px;
        z-index: -1;
        margin-bottom:150px;

        @media (max-width:1180px){
            background-color: #ff9f43;
            top: -10px;
            min-height: 600px;
            margin-bottom:50px;
            
        }

        @media (max-width:666px){
            top: -10px;
            min-height: 325px;
            margin-bottom:50px;
            
        }

    }

    .bg-wavy{
        position: absolute;
        top: 0;
        left: 0;
       width: 100%;
        min-height: 400px;
        z-index: 0;

        @media (max-width:667px) {
            width: 200%;
        }
    }

    .summary__content{

        
        min-height: inherit;
        width: 100%;
        max-width: 900px;
        z-index: 1;


        @media (min-width:667px) {
            display: flex;
            justify-content: center;
            align-items: center;

            position: absolute;
            top: 30%;
            left: 50%;
            transform: translate(-50% , -10%);
            width: 100%;
            width: 100%;
            max-width: 900px;
            z-index: 1;
        }

        @media (min-width:1180px){
            top: 40%;
        }
    }

    .summary__text{
        position: relative;
        z-index: 5;
        max-width: 450px;
        min-height: inherit;
        color: #fff;

        @media (max-width:666px){
            padding:  1rem;
            background-color: rgba(255, 159, 67, .8);
        }


        h2{
            font-size: 3.1rem;

            @media (min-width:666px){
                font-size: 3.7rem;
            }
        }

        p{
            font-weight:400;
            font-size: 1rem;
            color: #fefefe;
        }
    }

    .summary__img {
        position: relative;
        top: 50px;
        img{
            max-width: 300px;
        }

        @media (max-width:666px) {
            position: absolute;
            top: 50%;
            right: 0;
            transform: translateY(-50%);

            img{
                max-width: 200px;
                z-index: 500;
            }
        }
    }
</style>