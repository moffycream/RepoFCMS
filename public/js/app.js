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
    var isMenuImageEmpty = true;
    var isMenuNameEmpty = true;
    var isMenuCheckEmpty = true;
    var menuAlert = "";

    function validateCheckboxes() {
        for (var i = 0; i < addMenuCheckboxes.length; i++) {
            if (addMenuCheckboxes[i].checked) {
                isMenuCheckEmpty = false;
                break; // Exit the loop if at least one checkbox is checked
            }
        }
        return isMenuCheckEmpty;
    }

    function validationMenuForm() {

        // Reset bool
        isMenuImageEmpty = true;
        isMenuNameEmpty = true;
        isMenuCheckEmpty = true;
        menuAlert = "";

        if (!menuImage.files.length) {
            isMenuImageEmpty = true;
        } else {
            isMenuImageEmpty = false;
        }
        if (menuName.value === "") {
            isMenuNameEmpty = true;
        } else {
            isMenuNameEmpty = false;
        }

        isMenuCheckEmpty = validateCheckboxes(); // Call the checkbox validation function

        if (isMenuImageEmpty) {
            menuAlert += "Image cannot be empty";
        }
        if (isMenuNameEmpty) {
            menuAlert += "\nName cannot be empty";
        }
        if (isMenuCheckEmpty) {
            menuAlert += "\nAt least 1 food must be checked";
        }

        if (isMenuImageEmpty || isMenuNameEmpty || isMenuCheckEmpty) {
            alert(menuAlert);
            return false;
        } else {
            return true;
        }
    }

    if (addMenuForm) {
        addMenuForm.onsubmit = validationMenuForm;
    }

    //add food form
    var addFoodForm = document.getElementById("add-food-form");
    var foodImage = document.getElementById("food-image");
    var foodName = document.getElementById("food-name");
    var foodDescription = document.getElementById("food-description");
    var foodPrice = document.getElementById("food-price");

    function validateFoodForm() {
        var isFoodImageEmpty = true;
        var isFoodNameEmpty = true;
        var isFoodDescriptionEmpty = true;
        var isFoodPriceEmpty = true;
        var isFoodPatternCorrect = false;
        var pricePattern = /^[0-9. ]+$/;
        var foodAlert = "";

        if (!foodImage.files.length) {
            isFoodImageEmpty = true;
        } else {
            isFoodImageEmpty = false;
        }
        if (foodName.value === "") {
            isFoodNameEmpty = true;
        } else {
            isFoodNameEmpty = false;
        }
        if (foodDescription.value === "") {
            isFoodDescriptionEmpty = true;
        } else {
            isFoodDescriptionEmpty = false;
        }
        if (foodPrice.value === "") {
            isFoodPriceEmpty = true;
        } else {
            isFoodPriceEmpty = false;
        }
        if (pricePattern.test(foodPrice.value)) {
            isFoodPatternCorrect = true;
        } else {
            isFoodPatternCorrect = false;
        }

        if (isFoodImageEmpty) {
            foodAlert += "Image cannot be empty\n";
        }
        if (isFoodNameEmpty) {
            foodAlert += "Name cannot be empty\n";
        }
        if (isFoodDescriptionEmpty) {
            foodAlert += "Description cannot be empty\n";
        }
        if (isFoodPriceEmpty) {
            foodAlert += "Price cannot be empty\n";
        }
        if (!isFoodPatternCorrect) {
            foodAlert += "Price only accept number\n";
        }

        if (isFoodImageEmpty || isFoodNameEmpty || isFoodDescriptionEmpty || isFoodPriceEmpty) {
            alert(foodAlert);
            return false;
        } else {
            return true;
        }
    }

    if (addFoodForm) {
        addFoodForm.onsubmit = validateFoodForm;
    }





    // -------------------------- Guilbert Lam's JS --------------------------
    const PaymentChocie = document.getElementById('PaymentMethod');
    const OnlineBankingForm = document.getElementById('OnlineBankingForm');
    const CreditCardForm = document.getElementById('CreditCardForm');
    const DebitCardForm = document.getElementById('DebitCardForm');
    const EwalletForm = document.getElementById('EwalletForm');
    
    PaymentChocie.addEventListener('change', function () {

        const SelectedPaymentChoice = PaymentChocie.value;

        // empty variable string
        let htmlToInsert = '';
        
        if (SelectedPaymentChoice === 'OnlineBanking') 
        {

            htmlToInsert = `
            <h1>111</h1>
            <td>
            <label for="recipient_account">Recipient's Account Number:</label>
            </td>

            <td>
                <input type="text" id="recipient_account" name="recipient_account" required>
            </td>
            
            <br>

            <td>
                <label for="amount">Amount:</label>
            </td>

            <td>
                <input type="number" id="amount" name="amount" required>
            </td>

            <br>

            <td>
                <label for="description">Description:</label>
            </td>

            <td>
                <textarea id="description" name="description" rows="4" cols="50"></textarea>
            </td>
            `;
        
        } 
        else if (SelectedPaymentChoice === 'CreditCard') 
        {

            htmlToInsert = `
            <h1>222</h1>
            <td>
            <label for="recipient_account">Recipient's Account Number:</label>
            </td>

            <td>
                <input type="text" id="recipient_account" name="recipient_account" required>
            </td>
            
            <br>

            <td>
                <label for="amount">Amount:</label>
            </td>

            <td>
                <input type="number" id="amount" name="amount" required>
            </td>

            <br>

            <td>
                <label for="description">Description:</label>
            </td>

            <td>
                <textarea id="description" name="description" rows="4" cols="50"></textarea>
            </td>
            `;
        }
        else if (SelectedPaymentChoice === 'DebitCard') 
        {

            htmlToInsert = `
            <h1>333</h1>
            <td>
            <label for="recipient_account">Recipient's Account Number:</label>
            </td>

            <td>
                <input type="text" id="recipient_account" name="recipient_account" required>
            </td>
            
            <br>

            <td>
                <label for="amount">Amount:</label>
            </td>

            <td>
                <input type="number" id="amount" name="amount" required>
            </td>

            <br>

            <td>
                <label for="description">Description:</label>
            </td>

            <td>
                <textarea id="description" name="description" rows="4" cols="50"></textarea>
            </td>
            `;
        }
        else if (SelectedPaymentChoice === 'Ewallet') 
        {

            htmlToInsert = `
            <h1>444</h1>
            <td>
            <label for="recipient_account">Recipient's Account Number:</label>
            </td>

            <td>
                <input type="text" id="recipient_account" name="recipient_account" required>
            </td>
            
            <br>

            <td>
                <label for="amount">Amount:</label>
            </td>

            <td>
                <input type="number" id="amount" name="amount" required>
            </td>

            <br>

            <td>
                <label for="description">Description:</label>
            </td>

            <td>
                <textarea id="description" name="description" rows="4" cols="50"></textarea>
            </td>
            `;
        }

        // reset 
        OnlineBankingForm.innerHTML = '';
        CreditCardForm.innerHTML = '';
        DebitCardForm.innerHTML = '';
        EwalletForm.innerHTML = '';

        // Update the content of the forms
        if (SelectedPaymentChoice === 'OnlineBanking') 
        {
            OnlineBankingForm.innerHTML = htmlToInsert;
        } 
        else if (SelectedPaymentChoice === 'CreditCard') 
        {
            CreditCardForm.innerHTML = htmlToInsert;
        }
        else if (SelectedPaymentChoice === 'DebitCard') 
        {
            DebitCardForm.innerHTML = htmlToInsert;
        }
        else if (SelectedPaymentChoice === 'Ewallet') 
        {
            EwalletForm.innerHTML = htmlToInsert;
        }
    });

});

