document.getElementById('add-order').addEventListener('click', function () {
    var ordersContainer = document.getElementById('orders');
    var orderGroup = document.querySelector('.order-group').cloneNode(true);

    // Increment index in the name attributes
    var index = ordersContainer.querySelectorAll('.order-group').length;
    var inputs = orderGroup.querySelectorAll('select, input');

    inputs.forEach(function(input) {
        var name = input.getAttribute('name');
        input.setAttribute('name', name.replace(/\[\d+\]/, '[' + index + ']'));

        input.value = '';
    });



    // Show delete button for all except the first repeater
    var deleteButton = orderGroup.querySelector('.remove-order');
    if (index === 0) {
        deleteButton.style.display = 'none'; // Hide delete button for the first repeater
    } else {
        deleteButton.style.display = 'inline-block'; // Show delete button for other repeaters
    }

    ordersContainer.appendChild(orderGroup);
});

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-order')) {
        var orderGroup = e.target.closest('.order-group');
        if (!orderGroup.previousElementSibling) {
            return; // Prevent removing the first repeater
        }
        orderGroup.remove();
    }
});

