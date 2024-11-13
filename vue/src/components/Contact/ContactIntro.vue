<template>
  <section class="intro">
    <h1 className="logo page-heading mb-1">
      Get In <span className="spiceal"> Touch </span>
    </h1>
    <p className="text-center">
      <span className="upper">I’M </span>ALWAYS OPEN TO DISCUSS PRODUCT DESIGN
      WORK OR PARTNERSHIPS
    </p>
  </section>
</template>

<style lang="scss" scoped>
.intro {
  margin-top: 2rem;
  text-align: center;

  h1 {
    font-weight: 900;
    font-size: 3rem;

    span {
      color: #00b9eb;
    }
  }

  h2 {
    margin-bottom: 0.5rem;
  }

  p {
    margin: 0 auto;
    color: var(--subText-color);
  }

  & > p {
    margin-bottom: 1rem;
    line-height: 2;
  }
}
</style>
