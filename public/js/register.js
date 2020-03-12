$(document).ready(function(){
    if(location.href.includes('register.html')){
        console.log('register ajax')
        $.ajax({
            url:'../includes/checksession.php',
            method:'GET',
            success: function(data){
                if(data==='ok'){
                    console.log('register ok',data);
                    window.location.href='profile.html'; //reloading a lot of times since loading profile loads also register from same html
                }else{
                    console.log('register not ok',data);
                }
            }
        })
    }
});

function validateRegistration(name,email,password){
    if(email.trim().length===0 || password.trim().length===0||name.trim().length===0){
        $('#modal-value').text('Please fill all fields');
        $('#warning').modal('show');
    }
    else{
        $.ajax({
            url:'../includes/register.php',
            method:'POST',
            data: {
                username: name,
                password: password,
                email: email
            },
            success: function(data){
                $('#modal-value').html(data);
                $('#warning').modal('show');
            },
            error: function (error) {
                $('#modal-value').html("<div class='alert alert-danger' role='alert'>Unable to Create User Account!!! The Most Possibe Explanation is DataBase is Down!!!</div>");
                $('#warning').modal('show');
            }
        })
    }
}

$('form').submit(function(event) {
    event.preventDefault();
    var name = $('#registerUsername').val();
    var email = $('#registerEmail').val();
    var password = $('#registerPassword').val();
    var confirmPassword = $('#registerConfirmPassword').val();
    if(password === confirmPassword){
        validateRegistration(name,email,password);
    }
    else{
        $('#modal-value').text('Passwords doesn\'t match. Please change!!!');
        $('#warning').modal('show');
    }
})