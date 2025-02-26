let form = document.getElementsByTagName("form")[0];
let nameDiv = document.getElementById("name");
let addressDiv = document.getElementById("address");
let contactNumDiv = document.getElementById("contactNum");
let pass1 = document.getElementsByClassName("password")[0];
let pass2 = document.getElementsByClassName("password")[1];
let pass3 = document.getElementsByClassName("password")[2];

let regName = /^[a-zA-Z]{3,}/;
let regAddress = /^[\W\s\w]{1,},[\s\w]{3,},[\s\S\w]{3,}\.$/;
let regEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
let regContactNum = /^[0-9]{10}$/;
let regPassword = /(?=.*\d.*)(?=.*[A-Z].*)(?=.*[a-z].*)(?=.*[!#\$%_&\?].*).{8,}/;

function validateAddress() {
    addressDiv.innerHTML = "";
    let address = addressDiv.previousSibling.value;
    if (address == "" || !regAddress.test(address)) {
        addressDiv.classList.remove("hint");
        addressDiv.classList.add("alert");
        addressDiv.innerHTML = "<ul>\n" +
            "    <li>Please enter a valid address.</li>\n" +
            "</ul>"
    }
}

addressDiv.previousSibling.addEventListener("blur", validateAddress, false)

addressDiv.previousSibling.addEventListener("focus", function () {
    addressDiv.classList.remove("alert");
    addressDiv.classList.add("hint");
    addressDiv.innerHTML = "<ul class='inputMsg'>\n" +
        "    <li>Address should contain 3 parts ending with a fullstop(.).</li>\n" +
        "</ul>";
    ;

    // alert("Hai");
}, false)

function validateName() {
    nameDiv.innerHTML = "";
    var name = nameDiv.previousSibling.value;
    if (name == "" || !regName.test(name)) {
        nameDiv.classList.remove("hint");
        nameDiv.classList.add("alert");
        nameDiv.innerHTML = "<ul class='inputMsg'>\n" +
            "    <li>Please enter a valid name.</li>\n" +
            "</ul>"
    }
}

nameDiv.previousSibling.addEventListener("blur", validateName, false)

nameDiv.previousSibling.addEventListener("focus", function () {
    nameDiv.classList.remove("alert");
    nameDiv.classList.add("hint");
    nameDiv.innerHTML = "<ul class='inputMsg'>\n" +
        "    <li>Name should contain more than 2 characters and no numbers.</li>\n" +
        "</ul>";
    ;

    // alert("Hai");
}, false)


function validateContactNum() {
    contactNumDiv.innerHTML = "";
    var contactNum = contactNumDiv.previousSibling.value;
    if (contactNum == "" || !regContactNum.test(contactNum)) {
        contactNumDiv.classList.remove("hint");
        contactNumDiv.classList.add("alert");
        contactNumDiv.innerHTML = "<ul class='inputMsg'>\n" +
            "    <li>Please enter a valid contact number.</li>\n" +
            "</ul>"
    }
}

contactNumDiv.previousSibling.addEventListener("blur", validateContactNum, false)

contactNumDiv.previousSibling.addEventListener("focus", function () {
    contactNumDiv.classList.remove("alert");
    contactNumDiv.classList.add("hint");
    contactNumDiv.innerHTML = "<ul class='inputMsg'>\n" +
        "    <li>Contact number should contain 10 integers.</li>\n" +
        "</ul>"
    // alert("Hai");
}, false)

function validatePassword1() {
    pass1.innerHTML = "";
    var password = pass1.previousSibling.value;
    if (password == "" || !regPassword.test(password)) {
        pass1.classList.remove("hint");
        pass1.classList.add("alert");
        pass1.innerHTML = "<ul class='inputMsg'>\n" +
            "    <li>Please enter a valid password.</li>\n" +
            "</ul>"
    }
}

pass1.previousSibling.addEventListener("blur", validatePassword1, false)

pass1.previousSibling.addEventListener("focus", function () {
    pass1.classList.remove("alert");
    pass1.classList.add("hint");
    pass1.innerHTML = "<ul class='inputMsg'>\n" +
        "<li>It contains at least 8 characters and at most 20 characters.</li>\n" +
        "<li>It contains at least one digit.</li>\n" +
        "<li>It contains at least one upper case alphabet.</li>\n" +
        "<li>It contains at least one lower case alphabet.</li>\n" +
        "<li>It contains at least one special character which includes !@#$%&*()-+=^.</li>\n" +
        "<li>It doesn’t contain any white space.</li>\n" +
        "</ul>"
}, false)

function validatePassword2() {
    pass2.innerHTML = "";
    var password = pass2.previousSibling.value;
    if (password == "" || !regPassword.test(password)) {
        pass2.classList.remove("hint");
        pass2.classList.add("alert");
        pass2.innerHTML = "<ul class='inputMsg'>\n" +
            "    <li>Please enter a valid password.</li>\n" +
            "</ul>"
    }
}

pass2.previousSibling.addEventListener("blur", validatePassword2, false)

pass2.previousSibling.addEventListener("focus", function () {
    pass2.classList.remove("alert");
    pass2.classList.add("hint");
    pass2.innerHTML = "<ul class='inputMsg'>\n" +
        "<li>It contains at least 8 characters and at most 20 characters.</li>\n" +
        "<li>It contains at least one digit.</li>\n" +
        "<li>It contains at least one upper case alphabet.</li>\n" +
        "<li>It contains at least one lower case alphabet.</li>\n" +
        "<li>It contains at least one special character which includes !@#$%&*()-+=^.</li>\n" +
        "<li>It doesn’t contain any white space.</li>\n" +
        "</ul>"
}, false)

function validatePassword3() {
    pass3.innerHTML = "";
    var password = pass3.previousSibling.value;
    if (password == "" || !regPassword.test(password)) {
        pass3.classList.remove("hint");
        pass3.classList.add("alert");
        pass3.innerHTML = "<ul class='inputMsg'>\n" +
            "    <li>Please enter a valid password.</li>\n" +
            "</ul>"
    }
}

pass3.previousSibling.addEventListener("blur", validatePassword3, false)

pass3.previousSibling.addEventListener("focus", function () {
    pass3.classList.remove("alert");
    pass3.classList.add("hint");
    pass3.innerHTML = "<ul class='inputMsg'>\n" +
        "<li>It contains at least 8 characters and at most 20 characters.</li>\n" +
        "<li>It contains at least one digit.</li>\n" +
        "<li>It contains at least one upper case alphabet.</li>\n" +
        "<li>It contains at least one lower case alphabet.</li>\n" +
        "<li>It contains at least one special character which includes !@#$%&*()-+=^.</li>\n" +
        "<li>It doesn’t contain any white space.</li>\n" +
        "</ul>"
}, false)

function validatePasswordForm() {
    let password1 = pass1.previousSibling.value;
    let password2 = pass2.previousSibling.value;
    let password3 = pass3.previousSibling.value;

    if (regPassword.test(password1) &&
        regPassword.test(password2) &&
        regPassword.test(password3)) {
        return true;}
    else{
        if(!regPassword.test(password1)){
            pass1.classList.remove("hint");
            pass1.classList.add("alert");
            pass1.innerHTML = "<ul class='inputMsg'>\n" +
                "    <li>Please enter a valid password.</li>\n" +
                "</ul>"
        }
        if(!regPassword.test(password2)){
            pass2.classList.remove("hint");
            pass2.classList.add("alert");
            pass2.innerHTML = "<ul class='inputMsg'>\n" +
                "    <li>Please enter a valid password.</li>\n" +
                "</ul>"
        }
        if(!regPassword.test(password3)){
            pass3.classList.remove("hint");
            pass3.classList.add("alert");
            pass3.innerHTML = "<ul class='inputMsg'>\n" +
                "    <li>Please enter a valid password.</li>\n" +
                "</ul>"
        }
    }
}

function validateUpdateForm() {
    let address = addressDiv.previousSibling.value;
    let contactNum = contactNumDiv.previousSibling.value;
    let name = nameDiv.previousSibling.value;

    if (regContactNum.test(contactNum) &&
        regAddress.test(address) &&
        regName.test(name)) {
        return true;}
    else{
        if(!regContactNum.test(contactNum)){
            contactNumDiv.classList.remove("hint");
            contactNumDiv.classList.add("alert");
            contactNumDiv.innerHTML = "<ul class='inputMsg'>\n" +
                "    <li>Please enter a valid contact number.</li>\n" +
                "</ul>"
        }

        if(!regName.test(name)){
            nameDiv.classList.remove("hint");
            nameDiv.classList.add("alert");
            nameDiv.innerHTML = "<ul class='inputMsg'>\n" +
                "    <li>Please enter a valid name.</li>\n" +
                "</ul>"
        }

        if(!regAddress.test(address)){
            addressDiv.classList.remove("hint");
            addressDiv.classList.add("alert");
            addressDiv.innerHTML = "<ul class='inputMsg'>\n" +
                "    <li>Please enter a valid name.</li>\n" +
                "</ul>"
        }


        form.scrollIntoView();
        return false;
    }
}
