document.addEventListener("DOMContentLoaded", function () {
    //add menu form
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

    //add menu form
    var addMenuForm = document.getElementById("add-menu-form");
    var menuImage = document.getElementById("menu-image");
    var menuName = document.getElementById("menu-name");
    var addMenuCheckboxes = document.querySelectorAll(".add-menu-checkbox");

    function validateCheckboxes() {
        var isCheckEmpty = true;
        for (var i = 0; i < addMenuCheckboxes.length; i++) {
            if (addMenuCheckboxes[i].checked) {
                isCheckEmpty = false;
                break; // Exit the loop if at least one checkbox is checked
            }
        }
        return isCheckEmpty;
    }

    addMenuForm.addEventListener("submit", function (event) {
        // Prevent the form from submitting by default
        event.preventDefault();

        if (!menuImage.files.length) {
            alert("Image cannot be empty");
        }
        if (menuName.value === "") {
            alert("Name cannot be empty");
        }

        var isCheckEmpty = validateCheckboxes(); // Call the checkbox validation function

        if (isCheckEmpty) {
            alert("You must choose at least 1 food");
        }
    });

    //add food form

});

