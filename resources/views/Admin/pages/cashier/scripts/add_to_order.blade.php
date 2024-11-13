<script>
    $('.addToCart').on('click', function () {
        let that = $(this);
        var productId = $(this).data('product');
        var unitId = $(this).closest('.productsetcontent').find('.select-product').val();
        var quantityInput = $(this).closest('.productsetcontent').find('.quantity');
        var quantity = quantityInput.val();
        var increaseDecrease = $(this).closest('.add-to-cart-button').find('.increase-decrese');
        var price = $(this).closest('.productsetcontent').find('.select-product option:selected').data('price');
        var id = $(this).closest('.productsetcontent').find('input[name="order_id"]').val();

        if (!quantity){
            alert('Please enter a quantity');
            quantityInput.focus();
            return; // Prevent the AJAX request from being sent
        }
        $.ajax({
            type: 'POST',
            url: '{{ route('update-order') }}',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: {
                'product_id': productId,
                "unit_id" : unitId,
                "quantity" : quantity,
                'price' : price,
                "id" : id
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

    $(document).on('click', '.deleteproduct', function (){
        let that = $(this);
        $.ajax({
            type: 'DELETE',
            url: '{{ route('delete-from-order-detail') }}',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: {
                'order_detail_id': $(this).data('detail'),
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
