<template>
  <div className="contact">
    <div className="container">
      <ContactIntro />

      <div className="contact__content ">
        <ContactInfo />

        <ContactForm />
      </div>
    </div>
  </div>
</template>

<script setup>
import ContactForm from "@/components/Contact/ContactForm.vue";
import ContactInfo from "@/components/Contact/ContactInfo.vue";
import ContactIntro from "@/components/Contact/ContactIntro.vue";
</script>


<style lang="scss" scoped>
.contact {
  color: #1c1c1c;
  padding: 6rem 0;

  @media (min-width: 767px) {
    background-image: url(../../../public/wave2.svg);
    background-size: contain;
    background-position: 100% 100%;
  }

  & h2 {
    text-transform: uppercase;
  }

  .container > p {
    line-height: 2;
  }

  .contact__content {
    padding: 3rem 0;
    gap: 3rem;
    display: flex;
    align-items: flex-start;
    flex-wrap: wrap;
    flex-direction: row-reverse;
  }
}
</style>
