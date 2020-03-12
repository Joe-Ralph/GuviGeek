$(document).ready(function () {
    $.ajax({
        url: '../includes/checksession.php',
        method: 'GET',
        success: function (data) {
            if (data == 'ok') {
                console.log('Session present', data);
            } else {
                console.log('Session not Present', data);
                window.location.href='../index.html';
            }
        }
    });
    queryInformation();
});
$
function queryInformation() {
    $.ajax({
        url: '../includes/getProfile.php',
        method: 'GET',
        success: function (data) {
            console.log('Querying Profile Success');
            $('#content').html(data);
        }
    })
}
$('#logout').click(function () {
    $.ajax({
        url: '../includes/logout.php',
        method: 'GET',
        success: function (data) {
            if (data === 'ok') {
                console.log('session logged out from profile', data);
                window.location.href = '../index.html';
            } else {
                console.log('session not logged out', data);
            }
        }
    })
});
$('#editProfile').click(function(){
    $('#profileAdder').modal('show');
});
$('form').submit(function(event){
    event.preventDefault();
    const profileObj = {
        Firstname : $('#firstname').val(),
        Lastname : $('#lastname').val(),
        DateOfBirth : $('#dob').val(),
        Contact : $('#contact').val()
    };
    $('#profileAdder').modal('hide');
    $.ajax({
        url:'../includes/addProfile.php',
        method:'POST',
        data:{
            profile: JSON.stringify(profileObj)
        },
        success : function(data){
            console.log(data);
            queryInformation();
        }
    });
});