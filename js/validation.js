function validateForm() {
    var name = document.getElementById("name").value;
    var address = document.getElementById("address").value;
    var email = document.getElementById("email").value;
    var mobile = document.getElementById("mobile").value;
    var password = document.getElementById("password").value;

    // Reset error messages
    clearErrors();

    // Check if any field is empty
    if (!name || !address || !email || !mobile || !password) {
        displayError("All fields are required!!!");
        return false;
    }

    // Check name format (alphabet only)
    if (!/^[a-zA-Z ]+$/.test(name)) {
        displayError("Name must be only in alphabet!!!");
        return false;
    }

    // Check email format
    if (!/\S+@\S+\.\S+/.test(email)) {
        displayError("Invalid email format.");
        return false;
    }

    // Check mobile format (numeric and 10 digits)
    if (!/^\d{10}$/.test(mobile)) {
        displayError("Mobile number should be exact 10 digits number!!!");
        return false;
    }

    // Check password length
    if (password.length < 8 || password.length > 16) {
        displayError("Password should be between 8 and 16 characters.");
        return false;
    }
    // Form is valid
    alert("Form submitted successfully!");
    return true;
}

function displayError(message) {
    var errorElement = document.getElementById("nameError");
    errorElement.innerHTML = message;
}

function clearErrors() {
    var errorElements = document.getElementsByClassName("error");
    for (var i = 0; i < errorElements.length; i++) {
        errorElements[i].innerHTML = "";
    }
}
