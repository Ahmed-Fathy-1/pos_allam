<script>
    $('.addToCart').on('click', function () {
        let that = $(this);
        var productId = $(this).data('product');
        var unitId = $(this).closest('.productsetcontent').find('.select-product').val();
        var quantityInput = $(this).closest('.productsetcontent').find('.quantity');
        var quantity = quantityInput.val();
        var increaseDecrease = $(this).closest('.add-to-cart-button').find('.increase-decrese');
        var price = $(this).closest('.productsetcontent').find('.select-product option:selected').data('price');
         console.log(productId,unitId,price,quantity)
        if (!quantity){
            alert('Please enter a quantity');
            quantityInput.focus();
            return; // Prevent the AJAX request from being sent
        }
       $.ajax({
            type: 'POST',
            url: '{{ route('cashier.add-cart') }}',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: {
                'product_id': productId,
                "unit_id" : unitId,
                "quantity" : quantity,
                'price' : price,
            },
            success:function(data) {
                console.log(data);
                $('#cartdetails').load(" #cartdetails > *");
                $('#checkout_cart').load(" #checkout_cart > *");
            },
            error: function (data) {
                console.log(data)
            }
        });

    });


    $('#cartdetails').on('click', '.increment-decrement .decrease_quantity, .increment-decrement .increase_quantity', function () {
            var productId = $(this).data('product');
            var unitId = $(this).data('unit');
            var quantityField = $(this).closest('.product-lists').find('.quantity-field');
            var quantity = parseInt(quantityField.val()); // Parse the quantity value as an integer

            // Determine whether to increase or decrease the quantity based on the button clicked
            if ($(this).hasClass('increase_quantity')) {
                quantity += 1;
            } else {
                // Ensure the quantity does not go below 1
                quantity = Math.max(1, quantity - 1);
            }

            $.ajax({
                method: "POST",
                url: '{{ route('cashier.add-cart') }}',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    'product_id': productId,
                    'unit_id': unitId,
                    'quantity': quantity
                },
                success: function (data) {
                    console.log(data);
                    // Update quantity field with new value from server response
                    quantityField.val(data.new_quantity);

                    // Reload cart details and checkout cart sections
                    $('#cartdetails').load(" #cartdetails > *");
                    $('#checkout_cart').load(" #checkout_cart > *");
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });

    $(document).on('click', '.deleteproduct', function (){
        let that = $(this);
        $.ajax({
            type: 'DELETE',
            url: '{{ route('cashier.delete.product') }}',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: {
                'cart_detail_id': $(this).data('detail'),
            },
            success:function(data) {
                $('#cartdetails').load(" #cartdetails > *");
                $('#checkout_cart').load(" #checkout_cart > *");
            },
            error: function (data) {
                console.log(data)
            }
        });
    });

</script>
