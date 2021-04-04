function setCookie(cname, cvalue, exdays) {
    var d = new Date();

    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));

    var expires = "expires=" + d.toUTCString();
    var path = "path=/";
    document.cookie = cname + "=" + cvalue + "; " + expires + "; " + path;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
}

function checkCookie(value) {
    var user = getCookie("delivery");
    var days = (value === "no") ? 60 : 365
    //    console.log(value + "cookie");
    if (user != "") {
        // alert("Welcome again " + user);
    } else {
        //user = prompt("Please enter your name:", "");
        setCookie("delivery", value, days);

        if (user != "" && user != null) {
        }
    }
}

function checkCookiePolicy(cname) {
    var cookie_policy = getCookie(cname);
    if (cname == "cookie-policy") {
        if (cookie_policy != "") {
            $('.cookie-policy-bar').hide();
        }
        else {
            $('.cookie-policy-bar').show();
        }
    }
}

$(window).on('load', function () {
    setTimeout(() => {
        $('.secondary-bar').css('display', 'block');
    }, 100);
});

$('.close-button').click(function () {
    setCookie('cookie-policy', 'agree', 90);
    $('.cookie-policy-bar').hide();
});