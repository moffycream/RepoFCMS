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
    //add menu form price
    var addMenuCheckboxes = document.querySelectorAll(".add-menu-checkbox");
    var addMenuFormPrice = document.getElementById("add-menu-form-price");
    var paragraphElement = document.createElement("span");
    var addMenuFormPriceSubmission = document.getElementById("add-menu-form-price-submission");
    var hiddenInputsContainer = document.getElementById("hidden-inputs-container");

    //add menu form required ingredient
    var addMenuFormRequiredIngredient = document.querySelectorAll(".add-menu-required-ingredient");
    var addMenuFormRequiredIngredientID = document.querySelectorAll(".add-menu-required-ingredient-ID");

    for (var i = 0; i < addMenuCheckboxes.length; i++) {
        addMenuCheckboxes[i].addEventListener("change", function () {
            //update price
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

            //update required ingredient
            var requiredIngredients = [];
            var requiredEachIngredients = {};

            //initialize requiredEachIngredients
            addMenuFormRequiredIngredientID.forEach(function (requiredIngredientID) {
                requiredEachIngredients[requiredIngredientID.value] = 0;
            });

            for (var j = 0; j < addMenuCheckboxes.length; j++) {
                if (addMenuCheckboxes[j].checked) {
                    //split string into array by using |
                    requiredIngredients = addMenuCheckboxes[j].value.split("|");
                    //remove first and last element
                    //first element is price
                    //last element is empty string
                    requiredIngredients.shift();
                    requiredIngredients.pop();

                    requiredIngredients.forEach(function (ingredient) {
                        //split string into array by using -
                        var ingredientArray = ingredient.split("-");

                        if (ingredientArray[0] in requiredEachIngredients) {
                            requiredEachIngredients[ingredientArray[0]] += parseInt(ingredientArray[1]);
                        }
                    });
                }
            }

            console.log(requiredEachIngredients);

            addMenuFormRequiredIngredientID.forEach(function (requiredIngredientID) {
                const row = requiredIngredientID.closest('tr');
                for (const ingredientID in requiredEachIngredients) {
                    if (requiredIngredientID.value == ingredientID) {
                        const ingredientAmount = row.querySelector(".add-menu-required-ingredient");
                        ingredientAmount.innerHTML = requiredEachIngredients[ingredientID];
                    }
                }
            });
        });
    }

    //close error window
    var closeButton = document.getElementById("close-window-button");
    var errorWindow = document.getElementById("add-menu-error-window");

    if (closeButton && errorWindow) {
        closeButton.addEventListener("click", function () {
            errorWindow.style.display = "none";

        });
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

    var dropdownCheckbox = document.querySelectorAll(".food-dropdown-list");
    var dropdownAnchor = document.querySelectorAll(".food-dropdown-anchor")

    if (dropdownCheckbox) {
        dropdownAnchor.forEach(function (anchor) {
            anchor.addEventListener("click", function () {
                dropdownCheckbox.forEach(function (checkbox) {
                    if (checkbox.classList.contains('visible'))
                        checkbox.classList.remove('visible');
                    else
                        checkbox.classList.add('visible');
                });
            });
        });
    }

    //inventory edit, save, cancel and delete button
    var inventoryEditButton = this.querySelectorAll('.inventory-edit-button');
    var inventoryCancelButton = this.querySelectorAll('.inventory-cancel-button');

    if (inventoryEditButton && inventoryCancelButton) {
        document.querySelectorAll('.inventory-edit-button').forEach(function (button) {
            button.addEventListener('click', function () {
                const row = this.closest('tr');
                const inventoryValue = row.querySelectorAll('.inventory-value');
                const inventoryEditValue = row.querySelectorAll('.inventory-edit-value');
                const saveButton = row.querySelector('.inventory-save-button');
                const cancelButton = row.querySelector('.inventory-cancel-button');
                const deleteButton = row.querySelector('.inventory-delete-button');
                const deleteButtonNo = row.querySelector('.inventory-delete-button-no');

                // Hide the item value and "Edit" button
                inventoryValue.forEach(element => {
                    element.style.display = 'none';
                });

                inventoryEditValue.forEach(element => {
                    element.style.display = 'inline';
                });

                button.style.display = 'none';
                saveButton.style.display = 'inline';
                cancelButton.style.display = 'inline';
                if (deleteButton) {
                    deleteButton.style.display = 'none';
                }
                if (deleteButtonNo) {
                    deleteButtonNo.style.display = 'none';
                }
            });
        });

        document.querySelectorAll('.inventory-cancel-button').forEach(function (button) {
            button.addEventListener('click', function () {
                const row = this.closest('tr');
                const inventoryValue = row.querySelectorAll('.inventory-value');
                const inventoryEditValue = row.querySelectorAll('.inventory-edit-value');
                const saveButton = row.querySelector('.inventory-save-button');
                const editButton = row.querySelector('.inventory-edit-button');
                const deleteButton = row.querySelector('.inventory-delete-button');
                const deleteButtonNo = row.querySelector('.inventory-delete-button-no');

                // Hide the item value and "Edit" button
                inventoryValue.forEach(element => {
                    element.style.display = 'inline';
                });

                inventoryEditValue.forEach(element => {
                    element.style.display = 'none';
                });

                button.style.display = 'none';
                saveButton.style.display = 'none';
                editButton.style.display = 'inline';
                if (deleteButton) {
                    deleteButton.style.display = 'inline';
                }
                if (deleteButtonNo) {
                    deleteButtonNo.style.display = 'inline';
                }
            });
        });
    }

    //add food edit, save and cancel
    var addFoodEditButton = this.querySelectorAll('.add-food-edit-button');
    var addFoodCancelButton = this.querySelectorAll('.add-food-cancel-button');

    if (addFoodEditButton && addFoodCancelButton) {
        document.querySelectorAll('.add-menu-edit-button').forEach(function (button) {
            button.addEventListener('click', function () {
                const row = this.closest('div');
                const addMenuValue = row.querySelectorAll('.add-menu-value');
                const addMenuEditValue = row.querySelectorAll('.add-menu-edit-value');
                const saveButton = row.querySelector('.add-menu-save-button');
                const cancelButton = row.querySelector('.add-menu-cancel-button');

                // Hide the item value and "Edit" button
                addMenuValue.forEach(element => {
                    element.style.display = 'none';
                });

                addMenuEditValue.forEach(element => {
                    element.style.display = 'block';
                });

                button.style.display = 'none';
                saveButton.style.display = 'block';
                cancelButton.style.display = 'block';
            });
        });

        document.querySelectorAll('.add-menu-cancel-button').forEach(function (button) {
            button.addEventListener('click', function () {
                const row = this.closest('div');
                const addMenuValue = row.querySelectorAll('.add-menu-value');
                const addMenuEditValue = row.querySelectorAll('.add-menu-edit-value');
                const saveButton = row.querySelector('.add-menu-save-button');
                const editButton = row.querySelector('.add-menu-edit-button');

                // Hide the item value and "Edit" button
                addMenuValue.forEach(element => {
                    element.style.display = 'block';
                });

                addMenuEditValue.forEach(element => {
                    element.style.display = 'none';
                });

                button.style.display = 'none';
                saveButton.style.display = 'none';
                editButton.style.display = 'block';
            });
        });
    }
});

// -------------------------- Guilbert Lam's JS--------------------------
//  payment pages - display various payment
document.addEventListener('DOMContentLoaded', function () {

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

                <br><br>

                <td>
                <label for="selected_bank">Select your bank:</label>

                </td>

                <td>
                    <select id="selected_bank" name="selected_bank">
                        <option value="none" disabled selected>Select Your Bank</option>
                        <option value="RHB Bank">RHB Bank</option>
                        <option value="MayBank">MayBank</option>
                        <option value="CIMB Bank">CIMB Bank</option>
                        <option value="BSN Bank">BSN Bank</option>
                        <option value="AM Bank">AM Bank</option>
                    </select>
                </td>

                <br><br>
    
                <td>
                    <label for="bank_username:">Username: </label>   
                </td>
    
                <td>
                    <input type="text" id="bank_username" name="bank_username" placeholder="Username" required>
                </td>
                
                <br><br>

                <td>
                    <label for="account_number:">Account Number: </label>   
                </td>

                <td>
                    <input type="text" id="account_number" name="account_number" placeholder="Account Number" required>
                </td>

                <br><br>
    
                <td>
                    <label for="bank_password:">Password: </label>   
                </td>
    
                <td>
                    <input type="password" id="bank_password" name="bank_password" placeholder="Password" required>
                </td>

                <br><br>
    
                <td>
                    <label for="payment_amount">Amount: </label>
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
                    <label for="payment_amount">Amount: </label>
                </td>
    
                <td>
                    <input type="text" id="payment_amount" name="payment_amount" placeholder="Amount" required>
                </td>
    
                <br><br>
    
                <td>
                    <label for="payment_description">Description: </label>
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
                        <option value="none" disabled selected>E-Wallet Type</option>
                        <option value="Touch_and_Go">Touch and Go</option>
                        <option value="Boost">Boost</option>
                        <option value="Sarawak_Pay">Sarawak Pay</option>
                        <option value="Grab_Pay">Grab Pay</option>
                    </select>
                </td>
    
                <br><br>

                <td>
                    <label for="ewallet_username:">Username: </label>   
                </td>

                <td>
                    <input type="text" id="ewallet_username" name="ewallet_username" placeholder="Username" required>
                </td>
                
                <br><br>
    
                <td>
                    <label for="payment_amount">Amount: </label>
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
                // Clear the QRcontainer
                const QRcontainer = document.getElementById('qr_code_container');
                QRcontainer.innerHTML = '';
            }
            else if (SelectedPaymentChoice === 'CreditCard') {
                CreditCardForm.innerHTML = htmlToInsert;
                // Clear the QRcontainer
                const QRcontainer = document.getElementById('qr_code_container');
                QRcontainer.innerHTML = '';
            }
            else if (SelectedPaymentChoice === 'DebitCard') {
                DebitCardForm.innerHTML = htmlToInsert;
                // Clear the QRcontainer
                const QRcontainer = document.getElementById('qr_code_container');
                QRcontainer.innerHTML = '';
            }
            else if (SelectedPaymentChoice === 'Ewallet') {
                EwalletForm.innerHTML = htmlToInsert;

                const QRcontainer = document.getElementById('qr_code_container');
                const QRinsert = `
                    <img src="${assetUrl}" alt="QR code" width="200">
                `;

                QRcontainer.innerHTML = QRinsert;
            }
        });
    }

    function ValidatePaymentForm() {
        const errors = [];
        var pattern = /^[a-zA-Z ]+$/
        var Numpattern = /^[0-9]+$/;

        if (PaymentChoice.value === "OnlineBanking") {
            const selectedBank = document.getElementById('selected_bank');
            const username = document.getElementById('bank_username').value;
            const password = document.getElementById('bank_password').value;
            const accountNumber = document.getElementById('account_number').value;
            const amount = document.getElementById('payment_amount').value;

            //  validate selected bank mehtod
            if (selectedBank.value === "none") {
                errors.push("Please select a bank to do online banking.\n");
            };

            //  validation for name
            if (username.length < 5 || username.length > 25) {
                errors.push('Username must be within 5 to 25 characters long.\n');
            }

            //  validation for password
            if (password.length < 5 || password.length > 25) {
                errors.push('Password must be within 5 to 15 characters long.\n');
            }

            //  validation for Account Numbers
            if (accountNumber.length < 8 || accountNumber.length > 16) {
                errors.push('Account Numbers must be within 8 to 16 characters long.\n');
            }

            if (!Numpattern.test(accountNumber)) {
                errors.push('Account Numbers must only contain numbers only.\n');
            }

            //  validation for Amount
            if (!Numpattern.test(amount)) {
                errors.push('Amount must contain numbers only.\n');
            }

        } else if (PaymentChoice.value === "CreditCard" || PaymentChoice.value === "DebitCard") {
            const cardNumber = document.getElementById('payment_cardNumber').value;
            const cvv = document.getElementById('payment_cvv').value;
            const cardHolder = document.getElementById('payment_cardholder').value;
            const billingAddress = document.getElementById('payment_billingAddress').value;
            const amount = document.getElementById('payment_amount').value;

            //  validation for Card Number
            if (!Numpattern.test(cardNumber)) {
                errors.push('Card Number must contain numbers only.\n');
            }
            if (cardNumber.length != 16) {
                errors.push('Card Number must be 16 numbers.\n');
            }

            //  validation for CVV
            if (!Numpattern.test(cvv)) {
                errors.push('CVV number must contain numbers only.\n');
            }
            if (cvv.length < 3 || cvv.length > 4) {
                errors.push('CVV number must only contain 3-4 digits.\n');
            }

            //  validation for Card Holder Name
            if (!pattern.test(cardHolder)) {
                errors.push('Your Card Holder Name must only contain alpha character only.\n');
            }
            if (cardHolder.length < 5 || cardHolder.length > 25) {
                errors.push('Card Holder name must be within 5 to 25 characters long.\n');
            }

            //  validation for billing address
            if (billingAddress.length < 10 || billingAddress.length > 255) {
                errors.push('Billing Address must be within 10 to 255 characters long.\n');
            }

            //  validation for Amount
            if (!Numpattern.test(amount)) {
                errors.push('Amount must contain numbers only.\n');
            }

        } else if (PaymentChoice.value === "Ewallet") {
            const userName = document.getElementById('ewallet_username').value;
            const ewalletType = document.getElementById('eWallet_type');
            const amount = document.getElementById('payment_amount').value;

            //  validate selected bank mehtod
            if (ewalletType.value === "none") {
                errors.push("Please select a E-Wallet to do payment.\n");
            };

            //  validation for e wallet username
            if (userName.length < 5 || userName.length > 25) {
                errors.push('Username must be within 5 to 25 characters long.\n');
            }

            //  validation for Amount
            if (!Numpattern.test(amount)) {
                errors.push('Amount must contain numbers only.\n');
            }

        } else if (PaymentChoice.value === "none") {
            errors.push("Please select a payment method.");
        }

        //  display error msg
        if (errors.length > 0) {
            event.preventDefault(); // Prevent form submission
            alert(errors.join('')); // Display all error messages
        }
    }

    if (PaymentForm) {
        PaymentForm.onsubmit = ValidatePaymentForm;
    }
});

//  purchase pages - display various payment
document.addEventListener('DOMContentLoaded', function () {
    const PurchaseForm = document.getElementById('PurchaseForm');
    var pattern = /^[a-zA-Z ]+$/

    function ValidatePurchaseForm() {
        const errors = [];
        const realname = document.getElementById('purchase_realname').value;
        const address = document.getElementById('purchase_address').value;
        const contact = document.getElementById('purchase_contact').value;
        const deliveryMethod = document.getElementById("DeliveryMethod");
        const orderNotes = document.getElementById("purchase_orderNotes");
        const overallTotalPrice = parseFloat(document.getElementById("purchase_overall_total_price").value);

        //  validation for name
        if (!pattern.test(realname)) {
            errors.push('Your name must only contain alpha character only.\n');
        }

        // validation for address
        if (address.length < 15) {
            errors.push('Address must be at least 15 characters long.\n');
        } else if (address.length > 100) {
            errors.push('Address must be within 255 characters long.\n');
        }

        //  validation for contact
        if (contact.length > 11 || contact.length < 10) {
            errors.push('Your contact number must within 10-11 digit only.\n');
        };

        //  validate delivery mehtod
        if (deliveryMethod.value === "none") {
            errors.push("Please select a valid delivery method.");
        };

        //  validate delivery mehtod
        if (orderNotes.value === "") {
            errors.push("Please put some order notes for this order.");
        };

        if (overallTotalPrice === 0) {
            errors.push("You have no orders right now.");
        }

        //  display error msg
        if (errors.length > 0) {
            event.preventDefault(); // Prevent form submission
            alert(errors.join('')); // Display all error messages
        }
    }

    if (PurchaseForm) {
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
        if (status === 'Preparing' || status === 'Order Cancelled. The refund will be done within 5-7 working days.') {
            button.disabled = true;
        }

        // Add click event listeners
        button.addEventListener('click', function (event) {
            if (status !== 'Preparing' && status !== 'Order Cancelled. The refund will be done within 5-7 working days.' || status === 'Refund process in 5-7 days.') {
                // Ask for confirmation
                const confirmation = confirm("Are you sure you want to cancel this order?");
                if (!confirmation) {
                    event.preventDefault(); // Prevent form submission
                }
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Get delete button
    const deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach(function (button) {
        // Add click event listeners
        button.addEventListener('click', function (event) {
            const confirmation = confirm("Are you sure you want to delete this order?");
            if (!confirmation) {
                event.preventDefault(); // Prevent form submission
            }

        });
    });
});


document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.edit-button').forEach(function (button) {
        button.addEventListener('click', function () {
            const row = this.closest('tr');
            const profileImage = row.querySelector('.image');
            const profileName = row.querySelectorAll('.profile-attribute');
            const profileAttribute = row.querySelectorAll('.profile-Attribute');
            const saveButton = row.querySelector('.save-button');
            const cancelButton = row.querySelector('.cancel-button');
            cancelButton.style.display = 'block';
            profileName.forEach(element => {
                element.style.display = 'none';
            });

            profileAttribute.forEach(element => {
                element.style.display = 'block';
            });

            button.style.display = 'none';
            saveButton.style.display = 'block';
            profileImage.style.display = 'block';
        });
    });

    document.querySelectorAll('.profile-form').forEach(function (form) {
        form.addEventListener('submit', function () {
            const row = this.closest('tr');
        });
    });
});

// Gavin's JS
document.addEventListener("DOMContentLoaded", function () {
    const slider = document.getElementById('rating');
    if (slider) {
        const stars = document.querySelectorAll('.star');
        const defaultRating = parseInt(slider.value);

        // Set the initial star colors based on the default rating
        stars.forEach(function (star, index) {
            if (index < defaultRating) {
                star.style.color = 'gold';
            } else {
                star.style.color = ''; // Reset star color to the default (black)
            }
        });
        // Add an event listener to the stars to handle clicks
        stars.forEach(function (star, index) {
            star.addEventListener('click', function () {
                const starValue = parseInt(star.getAttribute('data-star'));
                slider.value = starValue; // Update the slider value
                updateStarColors(starValue); // Update star colors
            });
        });

        slider.addEventListener('input', function () {
            const sliderValue = parseInt(slider.value);

            // Loop through each star and update its color
            stars.forEach(function (star, index) {
                if (index < sliderValue) {
                    star.style.color = 'gold';
                } else {
                    star.style.color = ''; // Reset star color to the default (black)
                }
                updateStarColors(sliderValue)
            });
        });

        // when pressing the stars, the slider will change
        function updateStarColors(selectedRating) {
            stars.forEach(function (star, index) {
                if (index < selectedRating) {
                    star.style.color = 'gold';
                } else {
                    star.style.color = ''; // Reset star color to the default (black)
                }
            });
        }
    }
});

// for toggling 2FA
function toggle2FA() {
    var twoFactorAuthInput = document.querySelector('input[name="twoFactorAuth"]');
    var current2FAStatus = parseInt(twoFactorAuthInput.value);

    // Toggle the 2FA status
    if (current2FAStatus === 1) {
        twoFactorAuthInput.value = 0; // Toggle off
    } else {
        twoFactorAuthInput.value = 1; // Toggle on
    }
}

// for admin view enquiry
document.addEventListener('DOMContentLoaded', function () {
    const filterSelect = document.getElementById('filter');
    const orderSelect = document.querySelector('.order-select');

    // Initial visibility based on the selected value

    if (filterSelect) {
        toggleOrderSelectVisibility();
        filterSelect.addEventListener('change', toggleOrderSelectVisibility);
    }


    function toggleOrderSelectVisibility() {
        if (filterSelect && filterSelect.value) {
            if (filterSelect.value === 'General' || filterSelect.value === 'Compliment' || filterSelect.value === 'Complaint' || filterSelect.value === 'Suggestion') {
                orderSelect.style.display = 'none'; // Hide the Order select
            } else {
                orderSelect.style.display = 'block'; // Show the Order select
            }
        }
    }
});

// Review page
document.addEventListener('DOMContentLoaded', function () {
    // Set the initial state of comments and the reply input
    const comments = document.querySelectorAll('.comment');
    comments.forEach(function (comment) {
        if (comment.style.display !== 'none' && window.getComputedStyle(comment).display !== 'none') {
            comment.style.display = 'none';
        }
    });
});

// Toggle comment button to show and hide all the comments
function toggleComments(reviewID) {
    const review = document.querySelector(`#review-${reviewID}`);
    const comments = review.querySelectorAll('.comment');
    comments.forEach(function (comment) {
        if (comment.style.display === 'none' || comment.style.display === '') {
            comment.style.display = 'block';
        } else {
            comment.style.display = 'none';
        }
    });
}

// Toggle comment's replied comments to show and hide all the comments
function toggleRepliedComments(commentID) {
    const comment = document.querySelector(`#comment-${commentID}`);
    const comments = comment.querySelectorAll('.comment-reply');
    comments.forEach(function (comment) {
        if (comment.style.display === 'none' || comment.style.display === '') {
            comment.style.display = 'block';
        } else {
            comment.style.display = 'none';
        }
    });
}

// Toggle reply button to show input field for reply for a specific reply form
function toggleReply(replyFormId) {
    const replyForm = document.getElementById(`reply-${replyFormId}`);
    // Toggle the display of the reply form
    if (replyForm.style.display === 'none' || replyForm.style.display === '') {
        replyForm.style.display = 'block';
    } else {
        replyForm.style.display = 'none';
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const comments = document.querySelectorAll('.comment');

    comments.forEach(comment => {
        const nestingLevel = parseInt(comment.getAttribute('data-nesting-level'));
        const marginLeft = nestingLevel * 50; // 50px per nesting level
        comment.style.marginLeft = `${marginLeft}px`;
    });
});
