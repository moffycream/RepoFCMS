//import './bootstrap';
document.addEventListener("DOMContentLoaded", function () {
    var addMenuCheckboxes = document.querySelectorAll(".add-menu-checkbox");
    var addMenuFormPrice = document.getElementById("add-menu-form-price");
    var paragraphElement = document.createElement("span");
    var addMenuFormPriceSubmission = document.getElementById("add-menu-form-price-submission");
    var addMenuFormFoodIDSubmission = document.getElementById("add-menu-form-foodID-submission");
    var selectedFoodIDs = []; // Array to store selected food IDs

    for (var i = 0; i < addMenuCheckboxes.length; i++) {
        var totalPrice = 0;

        addMenuCheckboxes[i].addEventListener("change", function () {
            if (this.checked) {
                totalPrice += parseFloat(this.value);
                selectedFoodIDs.push(this.getAttribute("name"));
            } else {
                totalPrice -= parseFloat(this.value);
                var index = selectedFoodIDs.indexOf(this.getAttribute("name"));
                if (index !== -1) {
                    selectedFoodIDs.splice(index, 1);
                }
            }
            // Join the selectedFoodIDs array back into a comma-separated string
            addMenuFormFoodIDSubmission.value = selectedFoodIDs.join(",");

            paragraphElement.textContent = totalPrice;
            addMenuFormPrice.replaceWith(paragraphElement);
            addMenuFormPriceSubmission.value = totalPrice;
        });
    }
});



