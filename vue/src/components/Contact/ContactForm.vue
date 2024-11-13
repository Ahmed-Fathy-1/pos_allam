<template>
  <div class="contact__form form-contact">
    <h2>Message <span>Saas cashier</span></h2>


    <form
      ref="formRef"
      @submit.prevent="handleSubmitMessage"
      action="http://localhost:5000/mails"
      method="POST"
    >
      <div class="input-wrapper">
        <label for="name">Enter Your Name *</label>
        <input
          type="text"
          id="name"
          name="name"
          @input="handleMessageInfoChange"
          required
        />
      </div>
      <div class="input-wrapper">
        <label for="email">Enter Your Email *</label>
        <input
          type="email"
          id="email"
          name="email"
          @input="handleMessageInfoChange"
          required
        />
      </div>
      <div class="input-wrapper">
        <label for="subject">Enter Msg Title *</label>
        <input
          type="text"
          id="subject"
          name="subject"
          @input="handleMessageInfoChange"
          required
        />
      </div>
      <div class="input-wrapper">
        <label for="phone">Enter Your Phone</label>
        <input
          type="tel"
          id="phone"
          name="phone"
          @input="handleMessageInfoChange"
        />
      </div>
      <div class="input-wrapper">
        <label for="message">Your Message *</label>
        <textarea
          id="message"
          name="message"
          @input="handleMessageInfoChange"
          required
        ></textarea>
      </div>
      <button type="submit" class="submit">Submit</button>
    </form>
  </div>
</template>

<script>
import axios from "axios";
import { ref } from "vue";
import RatingServices from "../General/RatingServices.vue";
import sendFormData from "@/api/post/secdFormData";

export default {

  components: {
    RatingServices,
  },

  setup() {
    const formRef = ref(null);
    const messageInfo = ref({
      name: "",
      email: "",
      subject: "",
      phone: "",
      message: "",
    });
    const error = ref("");
    const successMessage = ref("");

    const handleMessageInfoChange = (e) => {
      const { name, value } = e.target;
      messageInfo.value[name] = value;      
    };

    const handleSubmitMessage = async () => {
      try {
        sendFormData('contact-us' , messageInfo.value)
      } catch (err) {
        error.value = 'An error occurred: ' + err.message;
        console.error('Error:', err);
      }
    };

    return {
      formRef,
      messageInfo,
      error,
      successMessage,
      handleMessageInfoChange,
      handleSubmitMessage,
    };
  },
};
</script>


<style lang="scss" scoped>
.form-contact {
  min-width: 330px;
  flex: 2;

  @media (min-width: 500px) {
    min-width: 490px;
    max-width: 950px;
  }

  & form {
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    column-gap: 1rem;
    margin: 1.5rem auto 1rem;

    & div {
      position: relative;
      flex: 1;
      min-width: 100%;
      margin: 0 auto 1.5rem;
      border: 1px solid #002b41;
      box-shadow: 0 0 4px 0px #002b41;
      padding: 5px;
      border-radius: 4px;

      @media (min-width: 500px) {
        min-width: 45%;
      }
    }

    & div label {
      position: absolute;
      top: -1rem;
      left: 0.5rem;
      background: #fff;
      font-size: 0.85rem;
      font-weight: 400;
      padding: 0.4rem 1rem;
    }

    & div input,
    & textarea {
      min-width: 100%;
      border: none;
      outline: none;
      padding: 5px 0 0.5rem 0;
      color: var(--mainTxt-color);
      background: transparent;
    }

    & div input {
      min-height: 50px;
      border-radius: 0.5rem;
    }

    div:has(textarea) {
      min-width: 100% !important;
    }

    & textarea {
      height: 160px;
      min-width: 100%;
      resize: none;
    }

    & button {
      padding: 0.5rem 1.5rem;
      background: #002b41;
      color: #fff;

      &:hover {
        opacity: 0.5;
      }
    }
  }
}
</style>
