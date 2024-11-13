<script>
    $(document).ready(function () {

        $('select[name="customer_id"]').on('change', function () {
            var Customer_id = $(this).val();
            const addressSelect = $('select[name="address_id"]');
            if (Customer_id){
                $.ajax({
                    url: "{{--{{ URL::to('admin/cashier/customer-address') }}--}}/" + Customer_id, // THIS IS ROUTE
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        addressSelect.empty();
                        addressSelect.append('<option value="" selected disabled>Select Address Of Customer...</option>');
                        if (Array.isArray(data) && data.length > 0) {
                            const addressData = [];
                            for (let i = 0; i < data.length; i++) {
                                const option = $('<option></option>').attr('value', data[i].id).text(data[i].address + ', ' + data[i].city + ', ' + data[i].state + ' ' + data[i].post_code);
                                addressData.push(option)
                            }
                            addressSelect.append(addressData);
                        } else {
                            console.error("Invalid data format or empty data array");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
            else {
                console.log('AJAX load did not work');
            }
        });

        var products = $('.order-group').length;
        $('#orders').delegate('select.select-product','change', function () {
            var Product_id = $(this).val();
            // console.log(Product_id);
            let unitSelect = $(this).closest('.order-group').find('select.unit-select');
            $(unitSelect).find('option').remove();
            if (Product_id) {
                $.ajax({
                    url: "{{ URL::to('admin/cashier/product-unit') }}/" + Product_id, // THIS IS ROUTE
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        // console.log(data);
                        $(unitSelect).empty();
                        $(unitSelect).append('<option value="" selected disabled>Select Unit ...</option>');

                        if (Array.isArray(data) && data.length > 0) {
                            const unitData = [];

                            for (let i = 0; i < data.length; i++) {
                                const option = $('<option></option>').attr('value', data[i].id).text(data[i].name);
                                unitData.push(option)
                            }

                            unitSelect.append(unitData);
                        } else {
                            console.error("Invalid data format or empty data array");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
            else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>
