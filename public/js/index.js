$(document).ready(function () {
    $.ajax({
        url: 'includes/checksession.php',
        method: 'GET',
        success: function (data) {
            if (data == 'ok') {
                console.log("session Present from login", data);
                window.location.href = 'html/profile.html';
            } else {
                console.log("session Not present from login", data)
            }
        }
    })
});



$('form').submit(function (event) {
    event.preventDefault();
    var email = $('#loginEmail').val();
    var password = $('#loginPassword').val();
    if (email.trim().length === 0 || password.trim().length === 0) {
        $('#modal-value').text("Please enter a valid email and password");
        $('#warning').modal('show');
    } else {
        $.ajax({
            url: 'includes/signin.php',
            method: 'POST',
            data: {
                email: email,
                password: password
            },
            success: function (data) {
                if (data === 'success') {
                    location.href = 'html/profile.html';
                } else {
                    $('#modal-value').text(data);
                    $('#warning').modal('show');
                }
            },
            error: function (error) {
                $('#modal-value').html("<div class='alert alert-danger' role='alert'>Unable to Create User Account!!! The Most Possibe Explanation is DataBase is Down!!!</div>");
                $('#warning').modal('show');
            }
        });
    }
})