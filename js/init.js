$(document).ready(function () {
    $('.parallax').parallax();
    $('.button-collapse').sideNav();
    $('.collapsible').collapsible();
    $('.modal').modal();
    $('.materialboxed').materialbox();
    $('select').material_select();
    var ff = $('#regDiv');
    ff.hide();
    var fd = $('#logDiv');
    var signbtn = $('#rBtn');
    var logbtn = $('#lBtn');
    signbtn.on("click", function () {
        ff.fadeIn(300);
        fd.hide(300);
    });
    logbtn.on("click", function () {
        ff.hide(300);
        fd.show(300);
    });
    var err = $('#err-panel');
    var err1 = $('#err-panel1');
    err1.hide();
    err.hide();
    var remal = $('#rem');
    var rpas = $('#rps');
    var crpas = $('#crps');
    var rb = $('#rbtn');
    rb.click(function (event) {
        var eml = remal.val();
        if (eml.localeCompare("") == 0) {
            err.html("<p>Email field cannot be empty!!</p>");
            err.show(150);
        } else {
            err.hide();
            if (eml.indexOf('@') > -1) {
                if (eml.split('@')[1].localeCompare("ada.edu.az") !== 0) {
                    err.html("<p>Email must be ADA email!</p>");
                    err.show(150);
                } else {
                    if (rpas.val().localeCompare("") != 0 && crpas.val().localeCompare("") != 0) {
                        err.hide();
                        if (rpas.val().localeCompare(crpas.val()) == 0) {
                            err.hide();
                            $('#regForm').submit();
                        } else {
                            err.html("<p>Passwords must be same!</p>");
                            err.show(150);
                        }
                    } else {
                        err.html("<p>Password fields cannot be empty!</p>");
                        err.show(150);
                    }
                }
            } else {
                err.html("<p>Email must be ADA email!</p>");
                err.show(150);
            }
        }

        event.preventDefault();
    });
});