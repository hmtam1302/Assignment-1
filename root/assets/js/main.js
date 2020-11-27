$(document).ready(function () {
    // Add smooth scrolling to page-body
    $(".back-to-top").on('click', function (event) {

        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
            // Prevent default anchor click behavior
            event.preventDefault();

            // Store hash
            var hash = this.hash;

            // Using jQuery's animate() method to add smooth page scroll
            // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 800, function () {

                // Add hash (#) to URL when done scrolling (default click behavior)
                window.location.hash = hash;
            });
        } // End if
    });
});

function validateData() {
    var flag1 = checkName(document.getElementById("name"), document.getElementById("validateName"))
    var flag2 = checkEmail(document.getElementById("email"), document.getElementById("validateEmail"))
    var flag3 = checkSubject(document.getElementById("subject"), document.getElementById("validateSubject"))
    var flag4 = checkMsg(document.getElementById("message"), document.getElementById("validateMessage"));
    if (flag1 && flag2 && flag3 && flag4) {
        var load = document.getElementById("message-box");
        load.style.display = "block";
        return false;
    }
    return false;
}


function checkName(name, validate) {
    if (name.value.length < 4) {
        validate.innerHTML = name.getAttribute("data-msg");
        validate.style.display = "block"
        return false;
    }
    else {
        validate.style.display = "none"
        return true;
    }
}

function checkEmail(email, validate) {
    var reg = /[^@]+@[^@]+.[^@]+/;
    if (!email.value.match(reg)) {
        validate.innerHTML = email.getAttribute("data-msg");
        validate.style.display = "block"
        return false;
    }
    else {
        validate.style.display = "none"
        return true;
    }
}

function checkSubject(subject, validate) {
    if (subject.value.length < 8) {
        validate.innerHTML = subject.getAttribute("data-msg");
        validate.style.display = "block"
        return false;
    }
    else {
        validate.style.display = "none"
        return true;
    }
}

function checkMsg(msg, validate) {
    if (msg.value == "") {
        validate.innerHTML = msg.getAttribute("data-msg");
        validate.style.display = "block"
        return false;
    }
    else {
        validate.style.display = "none"
        return true;
    }
}