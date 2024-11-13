<template>
    <v-app>
        <v-container>
            <v-dialog v-model="isRatingModalOpen" max-width="600px">
                <v-card>
                    <v-card-title>
                        <img src="/star.png" alt="Star icon" />
                        Rate the application
                        <img src="/star.png" alt="Star icon" />
                    </v-card-title>
                    <v-card-text>
                        <p class="rating__sub-title">
                            Your rating helps us improve our services to fit your aspirations.
                        </p>
                    </v-card-text>

                    <v-container>
                        <h3>Rate the app:</h3>
                        <v-rating
                            v-model="rating"
                            :items="5"
                            class="mb-4"
                            hover
                            @change="updateRating"
                        />
                        {{ rating }}
                    </v-container>
                    <v-card-actions>
                        <form 
                            ref="formRateRef"
                            @submit.prevent="handleSubmitMessage"
                            id="send-rating"
                            class="send-rating"
                        >
                            <textarea
                                class="form-control"
                                placeholder="Leave a comment here"
                                name="text"
                                @input="handleChangeRating"
                            ></textarea>
                        </form>
                    </v-card-actions>
                    <v-card-actions>
                        <v-btn @click="closeDialog" color="primary">Close</v-btn>
                        <v-btn form="send-rating" type="submit">Submit</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-container>
    </v-app>
</template>

<script>
import { inject, ref } from 'vue';
import axios from 'axios';

export default {
    setup() {

        const isRatingModalOpen = inject('isRatingModalOpen');
        const openRatingModal = inject('openRatingModal');
        const closeRatingModal = inject('closeRatingModal');        

        const rating = ref(0);
        const messageInfo = ref({ 
            name: "ibrahim",
            email: "ibrahim@m",
            avatar: "Req",
            value: null,
            text: "",
        });
        const error = ref("");
        const successProcess = ref("");
        

        const openDialog = ()=>{
            openRatingModal()
        }

        const closeDialog = ()=>{
            closeRatingModal()
        }

        const updateRating = (newRating) => {
            rating.value = newRating;
        };

        const handleChangeRating = (e) => {
            messageInfo.value.text = e.target.value; 
            messageInfo['value'].value = rating
        };

        const handleSubmitMessage = async () => {
            console.log(isRatingModalOpen);
            
            try {
                const response = await axios.post('http://localhost:5001/ratings', messageInfo.value);
                successProcess.value = 'Message sent successfully!';
                closeDialog(); 
            } catch (err) {
                error.value = 'An error occurred: ' + err.message;
                console.error('Error:', err);
            }
        };

        return {
            rating,
            messageInfo,
            error,
            successProcess,
            isRatingModalOpen,
            openDialog,
            closeDialog,
            updateRating,
            handleChangeRating,
            handleSubmitMessage,
        };
    },
};
</script>


<style >
.v-application{
    display: none;
}

.v-application__wrap{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50% , -50%);
    z-index: 1000;
    width: 100%;
    background-color: #1c1c1c0d;
}

.v-overlay__content{
    margin: .75rem !important;
    width: calc(100% - .75rem) !important;
}

.v-overlay__content * {
    margin: 0;
    color: #1c1c1c;
}
.v-card-title {
    margin: 0;
    display: flex;
    align-items: center;
    gap: .5rem;
}
.v-card-title img {
    max-width: 15px;
}
.v-card-text {
    padding: .5rem 1.5rem !important;
    margin: 0;
    font-weight: 500;
}
.v-card-text p {
    font-size: 13px;
}
.v-container:has(.v-rating) {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    padding: 0 1.5rem 1rem;
}
.v-container h3 {
    font-size: 1rem;
    min-width: 100px;
}
.v-rating {
    padding: 0 !important;
    margin-bottom: 0 !important;
}
.form{
    width: 100%;
}
.send-rating{
    width: 90% !important;
    margin: auto;
}
</style>
