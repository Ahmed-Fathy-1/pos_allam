document.addEventListener('DOMContentLoaded', function() {

    var addOrderButton = document.getElementById('add-order');
    addOrderButton.addEventListener('click', function () {
        var ordersContainer = document.getElementById('prices');
        var orderGroup = document.querySelector('.price-group').cloneNode(true);

        // Increment index in the name attributes
        var index = ordersContainer.querySelectorAll('.price-group').length;
        var inputs = orderGroup.querySelectorAll('select, input');
        inputs.forEach(function(input) {
            var name = input.getAttribute('name');
            input.setAttribute('name', name.replace(/\[\d+\]/, '[' + index + ']'));
            input.value = '';
        });
        ordersContainer.appendChild(orderGroup);

        // Show delete button for all except the first repeater
        var deleteButton = orderGroup.querySelector('.remove-order');
        if (index !== 0) {
            deleteButton.style.display = 'inline-block'; // Show delete button for other repeaters
        }
    });



    var addOrderSpecialButton = document.getElementById('add-special-price');
    addOrderSpecialButton.addEventListener('click', function (){
        var ordersContainer = document.getElementById('special_prices_edit');
        var orderGroup = document.querySelector('.price-special_edit').cloneNode(true);

        // Increment index in the name attributes
        var index = ordersContainer.querySelectorAll('.price-special_edit').length;
        var inputs = orderGroup.querySelectorAll('select, input');
        inputs.forEach(function(input) {
            var name = input.getAttribute('name');
            input.setAttribute('name', name.replace(/\[\d+\]/, '[' + index + ']'));
            input.value = '';
        });

        ordersContainer.appendChild(orderGroup);
       // ordersContainer.parentNode.insertBefore(orderGroup, addOrderSpecialButton.parentNode);

        // Show delete button for all except the first repeater
        var deleteButton = orderGroup.querySelector('.remove-special-price-edit');
        if (index !== 0) {
            deleteButton.style.display = 'inline-block'; // Show delete button for other repeaters
        }
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-order')) {
            var orderGroup = e.target.closest('.price-group');
            if (!orderGroup.previousElementSibling) {
                return; // Prevent removing the first repeater
            }
            orderGroup.remove();
        }

        if (e.target.classList.contains('remove-special-price-edit')) {
            var orderGroup2 = e.target.closest('.price-special_edit');
            if (!orderGroup2.previousElementSibling) {
                return; // Prevent removing the first repeater
            }
            orderGroup2.remove();
        }
    });
});

/* if no already exists customers on edit */
/* special price component js*/
document.getElementById('add-special-price').addEventListener('click', function () {
    var ordersContainer = document.getElementById('special_prices');
    var orderGroup = document.querySelector('.price-special').cloneNode(true);

    // Increment index in the name attributes
    var index = ordersContainer.querySelectorAll('.price-special').length;
    var inputs = orderGroup.querySelectorAll('select, input');
    inputs.forEach(function(input) {
        var name = input.getAttribute('name');
        input.setAttribute('name', name.replace(/\[\d+\]/, '[' + index + ']'));
        input.value = '';
    });
    // Show delete button for all except the first repeater
    var deleteButton = orderGroup.querySelector('.remove-special-price');
    if (index === 0) {
        deleteButton.style.display = 'none'; // Hide delete button for the first repeater
    } else {
        deleteButton.style.display = 'inline-block'; // Show delete button for other repeaters
    }
    ordersContainer.appendChild(orderGroup);
});

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-special-price')) {
        var orderGroup = e.target.closest('.price-special');
        if (!orderGroup.previousElementSibling) {
            return; // Prevent removing the first repeater
        }
        orderGroup.remove();
    }
});

