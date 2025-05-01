<form action="{{ route('stripe.payment') }}" method="POST" id="payment-form">
    @csrf
    <input type="text" name="amount" placeholder="Amount" required>
    <div id="card-element"></div>
    <button type="submit">Pay</button>
</form>

<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ env("STRIPE_KEY") }}');
    const elements = stripe.elements();
    const card = elements.create('card');
    card.mount('#card-element');

    const form = document.getElementById('payment-form');
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                alert(result.error.message);
            } else {
                const tokenInput = document.createElement('input');
                tokenInput.setAttribute('type', 'hidden');
                tokenInput.setAttribute('name', 'stripeToken');
                tokenInput.setAttribute('value', result.token.id);
                form.appendChild(tokenInput);
                form.submit();
            }
        });
    });
</script>
