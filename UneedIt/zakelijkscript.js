function checkLoginStatus() {

    let xhr = new XMLHttpRequest();
    xhr.open("GET", "checklogstatus.php", true);


    xhr.onload = function() {
        if (xhr.status == 200) {

            if (xhr.responseText.trim() === "logged_in") {

                window.location.href = "bestellen.html";
            } else {

                window.location.href = "login_or_signup.html";
            }
        }
    };


    xhr.send();
}
