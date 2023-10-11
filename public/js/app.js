
// Define an array of container IDs
var containerIds = ['container-notification', 'container-header-login'];

// Function to toggle container visibility
function toggleContainerVisibility(containerId) {
    var container = document.getElementById(containerId);
    var currentDisplay = container.style.display;

    if (currentDisplay === 'none' || currentDisplay === '') {
        container.style.display = 'block';
    } else {
        container.style.display = 'none';
    }
}

// Function to hide all containers except the specified one
function hideAllContainersExcept(containerIdToKeepOpen) {
    containerIds.forEach(function (containerId) {
        if (containerId !== containerIdToKeepOpen) {
            var container = document.getElementById(containerId);
            container.style.display = 'none';
        }
    });
}

// notification
function toggleNotification() {
    toggleContainerVisibility('container-notification');
    hideAllContainersExcept('container-notification');
}

// header login
function toggleHeaderLogin() {
    var container = document.getElementById('container-header-login');
    var currentDisplay = container.style.display;
    if (currentDisplay === 'none' || currentDisplay === '') {
        container.style.display = 'flex';
    } else {
        container.style.display = 'none';
    }
    hideAllContainersExcept('container-header-login');
}



document.addEventListener("DOMContentLoaded", function () {
    //Austin Chung's JS
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
            <h1>Online Banking</h1>

            <td>
                <label for="username:">Username: </label>   
            </td>

            <td>
                <input type="text" id="username" name="username" placeholder="Username" required>
            </td>
            
            <br><br>

            <td>
                <label for="password:">Password: </label>   
            </td>

            <td>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </td>
            
            <br><br>

            <td>
                <label for="recipient_account_number">Receipient Account Number: </label>
            </td>

            <td>
                <input type="text" id="recipient_account_number" name="recipient_account_number" placeholder="Receipient Account Number" required>
            </td>

            <br><br>

            <td>
                <label for="amount">Amount: </label>
            </td>

            <td>
                <input type="text" id="amount" name="amount" placeholder="Amount" required>
            </td>

            <br><br>

            <td>
                <label for="description">Description: </label>
            </td>

            <td>
                <input type="text" id="description" name="description" placeholder="Description" required>
            </td>
            
            `;
        
        } 
        else if (SelectedPaymentChoice === 'CreditCard') 
        {

            htmlToInsert = `
            <h1>Credit Card</h1>

            <td>
                <label for="cardNumber:">Card Number: </label>   
            </td>

            <td>
                <input type="text" id="cardNumber" name="cardNumber" placeholder="Card Number" required>
            </td>
            
            <br><br>

            <td>
                <label for="cvv">CVV: </label>
            </td>

            <td>
                <input type="text" id="cvv" name="cvv" placeholder="CVV" required>
            </td>

            <br><br>

            <td>
                <label for="cardholder">Card Holder Name: </label>
            </td>

            <td>
                <input type="text" id="cardholder" name="cardholder" placeholder="Card Holder Name" required>
            </td>

            <br><br>

            <td>
                <label for="billingAddress">Billing Address: </label>
            </td>

            <td>
                <input type="text" id="billingAddress" name="billingAddress" placeholder="Billing Address" required>
            </td>

            <br><br>

            <td>
                <label for="amount">Amount: </label>
            </td>

            <td>
                <input type="text" id="amount" name="amount" placeholder="Amount" required>
            </td>

            <br><br>

            <td>
                <label for="description">Description: </label>
            </td>

            <td>
                <input type="text" id="description" name="description" placeholder="Description" required>
            </td>
            `;
        }
        else if (SelectedPaymentChoice === 'DebitCard') 
        {

            htmlToInsert = `
            <h1>Debit Card</h1>

            <td>
                <label for="cardNumber:">Card Number: </label>   
            </td>

            <td>
                <input type="text" id="cardNumber" name="cardNumber" placeholder="Card Number" required>
            </td>
            
            <br><br>

            <td>
                <label for="cvv">CVV: </label>
            </td>

            <td>
                <input type="text" id="cvv" name="cvv" placeholder="CVV" required>
            </td>

            <br><br>

            <td>
                <label for="cardholder">Card Holder Name: </label>
            </td>

            <td>
                <input type="text" id="cardholder" name="cardholder" placeholder="Card Holder Name" required>
            </td>

            <br><br>

            <td>
                <label for="billingAddress">Billing Address: </label>
            </td>

            <td>
                <input type="text" id="billingAddress" name="billingAddress" placeholder="Billing Address" required>
            </td>

            <br><br>

            <td>
                <label for="amount">Amount: </label>
            </td>

            <td>
                <input type="text" id="amount" name="amount" placeholder="Amount" required>
            </td>

            <br><br>

            <td>
                <label for="description">Description: </label>
            </td>

            <td>
                <input type="text" id="description" name="description" placeholder="Description" required>
            </td>
            `;
        }
        else if (SelectedPaymentChoice === 'Ewallet') 
        {

            htmlToInsert = `
            <h1>E-Wallet</h1>

            <td>
                <label for="eWallet_type">E-Wallet Type: </label>
            </td>

            <td>
                <select id="eWallet_type" name="eWallet_type">
                    <option value="Touch_and_Go">Touch and Go</option>
                    <option value="Boost">Boost</option>
                    <option value="Sarawak_Pay">Sarawak Pay</option>
                    <option value="Grab_Pay">Grab Pay</option>
                </select>
            </td>

            <br><br>

            <td>
                <label for="receipient_name">Receipient Name: </label>
            </td>

            <td>
                <input type="text" id="receipient_name" name="receipient_name" placeholder="Receipient Name" required>
            </td>

            <br><br>

            <td>
                <label for="amount">Amount: </label>
            </td>

            <td>
                <input type="text" id="amount" name="amount" placeholder="Amount" required>
            </td>

            <br><br>

            <td>
                <label for="description">Description: </label>
            </td>

            <td>
                <input type="text" id="description" name="description" placeholder="Description" required>
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

//jesse'js 
// customer-orders-listings's js 
function confirmCancel(status) {
    if (status === 'preparing') {
        alert("Sorry, you cannot cancel that order that is currently preparing.");
        return false;
    }
    return confirm("Are you sure you want to cancel this order?");
}
