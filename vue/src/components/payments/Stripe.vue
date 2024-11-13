<template>
  <div id="checkout">
    <!-- Checkout will insert the payment form here -->
  </div>
</template>

<script>
import { extrnalUrl } from '@/config';


// Initialize Stripe.js
const stripe = stripe(process.env.STRIPE_KEY);

initialize();

// Fetch Checkout Session and retrieve the client secret
async function initialize() {
  const fetchClientSecret = async () => {
    const response = await fetch(`${extrnalUrl}pay-package`, {
      method: "POST",
    });
    const { clientSecret } = await response.json();
    return clientSecret;
  };

  // Initialize Checkout
  const checkout = await stripe.initEmbeddedCheckout({
    fetchClientSecret,
  });

  // Mount Checkout
  checkout.mount('#checkout');
}

</script>

<style scoped>
#submit {
  display: flex;
  align-items: center;
  justify-content: center;
}
.spinner {
  border: 4px solid #f3f3f3;
  border-top: 4px solid #3498db;
  border-radius: 50%;
  width: 20px;
  height: 20px;
  animation: spin 1s linear infinite;
}
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>

<script>
export default {
  name: "checkout",

}
</script>