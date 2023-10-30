
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


    var adminExpandedDashboard = this.getElementById("admin-dashboard-container-expand");
    var adminMinimizedDashboard = this.getElementById("admin-dashboard-container-minimize");

    var adminDashboardExpand = this.getElementById("admin-dashboard-expand-icon");
    var adminDashboardMinimize = this.getElementById("admin-dashboard-minimize-icon");

    if (adminExpandedDashboard && adminMinimizedDashboard && adminDashboardExpand && adminDashboardMinimize) {
        function expandDashboard() {
            adminMinimizedDashboard.style.display = "none";
            adminExpandedDashboard.style.display = "flex";
        }

        function minimizeDashboard() {
            adminMinimizedDashboard.style.display = "flex";
            adminExpandedDashboard.style.display = "none";
        }

        // Attach the event listeners
        adminDashboardExpand.addEventListener("click", expandDashboard);
        adminDashboardMinimize.addEventListener("click", minimizeDashboard);
    }


    //Dropdown checkbox

    var dropdownCheckbox = document.getElementById("food-dropdown-list");
    var dropdownAnchor = document.getElementById("food-dropdown-anchor")

    if (dropdownCheckbox) {
        dropdownAnchor.addEventListener("click", function () {
            if (dropdownCheckbox.classList.contains('visible'))
                dropdownCheckbox.classList.remove('visible');
            else
                dropdownCheckbox.classList.add('visible');
        });
    }

});

// -------------------------- Guilbert Lam's JS--------------------------
//  payment pages - display various payment
document.addEventListener('DOMContentLoaded', function(){

    const PaymentForm = document.getElementById('PaymentForm');
    const PaymentChoice = document.getElementById('PaymentMethod');
    const OnlineBankingForm = document.getElementById('OnlineBankingForm');
    const CreditCardForm = document.getElementById('CreditCardForm');
    const DebitCardForm = document.getElementById('DebitCardForm');
    const EwalletForm = document.getElementById('EwalletForm');
    var pattern = /^[a-zA-Z ]+$/
    var Numpattern = /^[0-9]+$/;

    // Display payment method based on user choice
    if (PaymentChoice) {
        PaymentChoice.addEventListener('change', function () {
            const SelectedPaymentChoice = PaymentChoice.value;

            // empty variable string
            let htmlToInsert = '';

            if (SelectedPaymentChoice === 'OnlineBanking') {

                htmlToInsert = `
                <h1>Online Banking</h1>
    
                <td>
                    <label for="username:">Username: </label>   
                </td>
    
                <td>
                    <input type="text" id="payment_username" name="payment_username" placeholder="Username" required>
                </td>
                
                <br><br>
    
                <td>
                    <label for="password:">Password: </label>   
                </td>
    
                <td>
                    <input type="password" id="payment_password" name="payment_password" placeholder="Password" required>
                </td>
                
                <br><br>
    
                <td>
                    <label for="recipient_account_number">Receipient Account Number: </label>
                </td>
    
                <td>
                    <input type="text" id="payment_recipient_account_number" name="payment_recipient_account_number" placeholder="Receipient Account Number" required>
                </td>
    
                <br><br>
    
                <td>
                    <label for="amount">Amount: </label>
                </td>
    
                <td>
                    <input type="text" id="payment_amount" name="payment_amount" placeholder="Amount" required>
                </td>
    
                <br><br>
    
                <td>
                    <label for="description">Description: </label>
                </td>
    
                <td>
                    <input type="text" id="payment_description" name="payment_description" placeholder="Description" required>
                </td>
                
                `;

            }
            else if (SelectedPaymentChoice === 'CreditCard') {

                htmlToInsert = `
                <h1>Credit Card</h1>
    
                <td>
                    <label for="cardNumber:">Card Number: </label>   
                </td>
    
                <td>
                    <input type="text" id="payment_cardNumber" name="payment_cardNumber" placeholder="Card Number" required>
                </td>
                
                <br><br>
    
                <td>
                    <label for="cvv">CVV: </label>
                </td>
    
                <td>
                    <input type="text" id="payment_cvv" name="payment_cvv" placeholder="CVV" required>
                </td>
    
                <br><br>
    
                <td>
                    <label for="cardholder">Card Holder Name: </label>
                </td>
    
                <td>
                    <input type="text" id="payment_cardholder" name="payment_cardholder" placeholder="Card Holder Name" required>
                </td>
    
                <br><br>
    
                <td>
                    <label for="billingAddress">Billing Address: </label>
                </td>
    
                <td>
                    <input type="text" id="payment_billingAddress" name="payment_billingAddress" placeholder="Billing Address" required>
                </td>
    
                <br><br>
    
                <td>
                    <label for="amount">Amount: </label>
                </td>
    
                <td>
                    <input type="text" id="payment_amount" name="payment_amount" placeholder="Amount" required>
                </td>
    
                <br><br>
    
                <td>
                    <label for="description">Description: </label>
                </td>
    
                <td>
                    <input type="text" id="payment_description" name="payment_description" placeholder="Description" required>
                </td>
                `;
            }
            else if (SelectedPaymentChoice === 'DebitCard') {

                htmlToInsert = `
                <h1>Debit Card</h1>
    
                <td>
                    <label for="cardNumber:">Card Number: </label>   
                </td>
    
                <td>
                    <input type="text" id="payment_cardNumber" name="payment_cardNumber" placeholder="Card Number" required>
                </td>
                
                <br><br>
    
                <td>
                    <label for="cvv">CVV: </label>
                </td>
    
                <td>
                    <input type="text" id="payment_cvv" name="payment_cvv" placeholder="CVV" required>
                </td>
    
                <br><br>
    
                <td>
                    <label for="cardholder">Card Holder Name: </label>
                </td>
    
                <td>
                    <input type="text" id="payment_cardholder" name="payment_cardholder" placeholder="Card Holder Name" required>
                </td>
    
                <br><br>
    
                <td>
                    <label for="billingAddress">Billing Address: </label>
                </td>
    
                <td>
                    <input type="text" id="payment_billingAddress" name="payment_billingAddress" placeholder="Billing Address" required>
                </td>
    
                <br><br>
    
                <td>
                    <label for="amount">Amount: </label>
                </td>
    
                <td>
                    <input type="text" id="payment_amount" name="payment_amount" placeholder="Amount" required>
                </td>
    
                <br><br>
    
                <td>
                    <label for="description">Description: </label>
                </td>
    
                <td>
                    <input type="text" id="payment_description" name="payment_description" placeholder="Description" required>
                </td>
                `;
            }
            else if (SelectedPaymentChoice === 'Ewallet') {

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
                    <input type="text" id="payment_receipient_name" name="payment_receipient_name" placeholder="Receipient Name" required>
                </td>
    
                <br><br>
    
                <td>
                    <label for="amount">Amount: </label>
                </td>
    
                <td>
                    <input type="text" id="payment_amount" name="payment_amount" placeholder="Amount" required>
                </td>
    
                <br><br>
    
                <td>
                    <label for="description">Description: </label>
                </td>
    
                <td>
                    <input type="text" id="payment_description" name="payment_description" placeholder="Description" required>
                </td>
                `;
            }

            // reset 
            OnlineBankingForm.innerHTML = '';
            CreditCardForm.innerHTML = '';
            DebitCardForm.innerHTML = '';
            EwalletForm.innerHTML = '';

            // Update the content of the forms
            if (SelectedPaymentChoice === 'OnlineBanking') {
                OnlineBankingForm.innerHTML = htmlToInsert;
            }
            else if (SelectedPaymentChoice === 'CreditCard') {
                CreditCardForm.innerHTML = htmlToInsert;
            }
            else if (SelectedPaymentChoice === 'DebitCard') {
                DebitCardForm.innerHTML = htmlToInsert;
            }
            else if (SelectedPaymentChoice === 'Ewallet') {
                EwalletForm.innerHTML = htmlToInsert;
            }
        });
    }

    function ValidatePaymentForm(){
        const errors = [];

        if(PaymentChoice.value === "OnlineBanking"){
            const username = document.getElementById('payment_username').value;
            const password = document.getElementById('payment_password').value;
            const recipientAccountNumber = document.getElementById('payment_recipient_account_number').value;
            const amount = document.getElementById('payment_amount').value;

            //  validation for name
            if(username.length < 5 || username.length > 25){
                errors.push('Username must be within 5 to 25 characters long.\n');
            }

            //  validation for password
            if(password.length < 5 || password.length > 25){
                errors.push('Password must be within 5 to 15 characters long.\n');
            }

            //  validation for Receipient Account Numbers
            if(recipientAccountNumber.length < 8 || recipientAccountNumber.length > 16){
                errors.push('Receipient Account Numbers must be within 8 to 16 characters long.\n');
            }

            if(!Numpattern.test(recipientAccountNumber)){
                errors.push('Receipient Account Numbers must only contain numbers only.\n');
            }

            //  validation for Amount
            if(!Numpattern.test(amount)){
                errors.push('Amount must contain numbers only.\n');
            }

        }else if(PaymentChoice.value === "CreditCard" || PaymentChoice.value === "DebitCard"){
            const cardNumber = document.getElementById('payment_cardNumber').value;
            const cvv = document.getElementById('payment_cvv').value;
            const cardHolder = document.getElementById('payment_cardholder').value;
            const billingAddress = document.getElementById('payment_billingAddress').value;
            const amount = document.getElementById('payment_amount').value;

            //  validation for Card Number
            if(!Numpattern.test(cardNumber)){
                errors.push('Card Number must contain numbers only.\n');
            }
            if(cardNumber.length != 16){
                errors.push('Card Number must be 16 numbers.\n');
            }

            //  validation for CVV
            if(!Numpattern.test(cvv)){
                errors.push('CVV number must contain numbers only.\n');
            }
            if(cvv.length < 3 || cvv.length > 4){
                errors.push('CVV number must only contain 3-4 digits.\n');
            }

            //  validation for Card Holder Name
            if(!pattern.test(cardHolder)){
                errors.push('Your Card Holder Name must only contain alpha character only.\n');
            }
            if(cardHolder.length < 5 || cardHolder.length > 25){
                errors.push('Card Holder name must be within 5 to 25 characters long.\n');
            }
            
            //  validation for billing address
            if(billingAddress.length < 10 || billingAddress.length > 255){
                errors.push('Billing Address must be within 10 to 255 characters long.\n');
            }

            //  validation for Amount
            if(!Numpattern.test(amount)){
                errors.push('Amount must contain numbers only.\n');
            }

        }else if(PaymentChoice.value === "Ewallet"){
            const recipientName = document.getElementById('payment_receipient_name').value;
            const amount = document.getElementById('payment_amount').value;

            //  validation for Receipient Name
            if(!pattern.test(recipientName)){
                errors.push('Receipient Name must only contain alpha character only.\n');
            }
            if(recipientName.length < 5 || recipientName.length > 25){
                errors.push('Receipient name must be within 5 to 25 characters long.\n');
            }

            //  validation for Amount
            if(!Numpattern.test(amount)){
                errors.push('Amount must contain numbers only.\n');
            }
        }

        //  display error msg
        if(errors.length > 0){
            event.preventDefault(); // Prevent form submission
            alert(errors.join('')); // Display all error messages
        }
    }

    if(PaymentForm){
        PaymentForm.onsubmit = ValidatePaymentForm;
    }
});

//  purchase pages - display various payment
document.addEventListener('DOMContentLoaded', function(){
    const PurchaseForm = document.getElementById('PurchaseForm');
    var pattern = /^[a-zA-Z ]+$/

    function ValidatePurchaseForm(){
        const errors = [];
        const realname = document.getElementById('purchase_realname').value;
        const address = document.getElementById('purchase_address').value;
        const contact = document.getElementById('purchase_contact').value;

        //  validation for name
        if(!pattern.test(realname)){
            errors.push('Your name must only contain alpha character only.\n');
        }

        // validation for address
        if(address.length < 15){
            errors.push('Address must be at least 10 characters long.\n');
        }else if(address.length > 100){
            errors.push('Address must be within 255 characters long.\n');
        }

        //  validation for contact
        if(contact.length > 11 || contact.length < 10){
            errors.push('Your contact number must within 10-11 digit only.\n');
        };

        //  display error msg
        if(errors.length > 0){
            event.preventDefault(); // Prevent form submission
            alert(errors.join('')); // Display all error messages
        }
    }

    if(PurchaseForm){
        PurchaseForm.onsubmit = ValidatePurchaseForm;
    }


});

//jesse'js 
// customer-orders-listings's js 
document.addEventListener('DOMContentLoaded', function () {
    // Get cancel buttons
    const cancelButtons = document.querySelectorAll('.customer-container-cancel-button');

    cancelButtons.forEach(function (button) {
        // Get the order status from the data-status attribute from the data-status
        const status = button.getAttribute('data-status');

        // Check the status and disable the button if it's "preparing" or "Order Cancelled"
        if (status === 'preparing' || status === 'Order Cancelled. The refund will be done within 5-7 working days.'|| status==='Refund process in 5-7 days.') {
            button.disabled = true;
        }

        // Add click event listeners
        button.addEventListener('click', function (event) {
            if (status !== 'preparing' && status !== 'Order Cancelled. The refund will be done within 5-7 working days.'||status==='Refund process in 5-7 days.') {
                // Ask for confirmation
                const confirmation = confirm("Are you sure you want to cancel this order?");
                if (!confirmation) {
                    event.preventDefault(); // Prevent form submission
                }
            }
        });
    });
});
