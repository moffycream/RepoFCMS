document.addEventListener("DOMContentLoaded", function () {
    var addMenuCheckboxes = document.querySelectorAll(".add-menu-checkbox");
    var addMenuFormPrice = document.getElementById("add-menu-form-price");
    var paragraphElement = document.createElement("span");
    var addMenuFormPriceSubmission = document.getElementById("add-menu-form-price-submission");
    var hiddenInputsContainer = document.getElementById("hidden-inputs-container");

    for (var i = 0; i < addMenuCheckboxes.length; i++) {
        addMenuCheckboxes[i].addEventListener("change", function () {
            var totalPrice = 0;
            var selectedFoodIDs = [];

            for (var j = 0; j < addMenuCheckboxes.length; j++) {
                if (addMenuCheckboxes[j].checked) {
                    totalPrice += parseFloat(addMenuCheckboxes[j].value);
                    selectedFoodIDs.push(addMenuCheckboxes[j].getAttribute("name"));
                }
            }

            // Update the total price display
            paragraphElement.textContent = totalPrice;
            addMenuFormPrice.replaceWith(paragraphElement);
            addMenuFormPriceSubmission.value = totalPrice;

            // Update the hidden input fields
            hiddenInputsContainer.innerHTML = ""; // Clear existing hidden inputs

            selectedFoodIDs.forEach(function (foodID) {
                var hiddenInput = document.createElement("input");
                hiddenInput.type = "hidden";
                hiddenInput.name = "selectedFoodIDs[]";
                hiddenInput.value = foodID;
                hiddenInputsContainer.appendChild(hiddenInput);
            });
        });
    }
});