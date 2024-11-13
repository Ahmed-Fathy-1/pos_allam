<script setup lang="ts">
import SocialBar from "./SocialBar.vue";
</script>

<template>
  <div className="contact__info flex-1">
    <h2>contact <span>information</span></h2>
    <p>
      You can find me via all these soical for hiring or freelancing work, or
      send me mail via form.
    </p>

    <div className="contact__list">
      <a
        target="_blank"
        rel="noopener"
        href="https://mailto:ibrahimYoussef95.12@gmail.com"
        className="contact-item"
      >
        <div className="flex-center">
          <img src="/mail.png" alt="mail" />
        </div>
        <div>
          <h3>Email</h3>
          <p>ibrahimYoussef95.12@gmail</p>
        </div>
      </a>
      <a
        target="_blank"
        rel="noopener"
        href="tel:01147359396"
        className="contact-item"
      >
        <div className="flex-center">
          <img src="/phone.png" alt="mobile" />
        </div>
        <div>
          <h3>Phone</h3>
          <p>01147359396</p>
        </div>
      </a>
      <div className="contact-item">
        <div className="flex-center">
          <img src="/location.png" alt="location" />
        </div>
        <div>
          <h3>Residence</h3>
          <p>Egypt, Cairo</p>
        </div>
      </div>
    </div>

    <h3>
      <i className="fa-solid fa-user"></i>
      <span>Visit my social profiles and get contact </span>
    </h3>

    <SocialBar />
  </div>
</template>

<style scoped>
.contact__info {
  min-width: 330px;
  padding-left: 1rem;
  flex: 1;

  @media (min-width: 600px) {
    padding-left: 2rem;
  }

  .contact-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
    max-width: fit-content;
    color: #1c1c1c;

    & div:first-of-type {
      width: 60px;
      height: 60px;
      border-radius: 4px;
      border: 0.1px solid #1c1c1c;
      color: #fff;
      background-color: #002b41;
      font-size: 1.7rem;
      transition: transform 0.3s ease-in-out;
    }

    & div:last-of-type {
      h3 {
        font-weight: 500;
        font-size: 1rem;
      }
    }

    i {
      transition: transform 0.3s ease-in-out;
    }

    &:hover {
      & div:first-of-type {
        transform: perspective(500px) translate3d(-5px, -5px, 50px);
      }
    }
  }

  & > h3 {
    position: relative;
    font-weight: 500;
    font-size: 1rem;
    margin: 2rem 0 1.5rem;
    padding-left: 5px;

    span {
      padding-left: 0.5rem;
    }
  }
}
</style>
