$(document).ready(function(){

    $('body').append('<div class="page-loader" style="display: none;"><div class="page-loader__spinner"><svg viewBox="25 25 50 50"><circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle></svg></div></div>');

    $('#loginButton').click(function(){
        const user = $('#user').val();
        const pass = $('#pass').val();
        $('.page-loader').css('display', 'flex');
        $.post('/login', {user, pass}, function(resp) {
            if(resp.status == 'ok') {
                window.top.locaion = '/dashboard';
                $('#page-loader').css('display', 'none');
            } else {
                $('#user').css('border', '1px solid red');
                $('#pass').css('border', '1px solid red');
                $('#pass').val('');
                $('#page-loader').css('display', 'none');
            }
        });
    });

});