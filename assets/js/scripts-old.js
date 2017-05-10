
jQuery(document).ready(function() {
    
    /* Fullscreen background */
    $.backstretch("assets/img/backgrounds/background.jpg");

    
    /***** Login form validation *****/
    /*********************************/

    /* Show input error area alert */
    $('.login-form input[type="text"], .login-form input[type="password"]').on('focus', function() {
        $(this).removeClass('input-error');
    });
    
    /* Show or remove input error area alert */
    $('.login-form').on('submit', function(e) {
        $(this).find('input[type="text"], input[type="password"]').each(function(){
            if( $(this).val() == "" ) {
                e.preventDefault();
                $(this).addClass('input-error');
            }
            else {
                $(this).removeClass('input-error');
            }
        });
        
    });
    

    /***** Registration form validation *****/
    /****************************************/

    /* Verify password pattern */
    $('#form-password').on('focusout', function() {
        var regex = /(?=^.{8,}$)((?=.*\w)|(?=.*\W+))(?![.\n])(?!.*\s).*$/;
        if (!regex.test(this.value)) {
            alert('Password should be 8 characters long.');
        };
    });

     /* Registration form validation */
    $('.registration-form input[type="text"], .registration-form textarea').on('focus', function() {
        $(this).removeClass('input-error');
    });

    /* Check username availability */
    $('#form-username').on('input propertychange paste', function(){
        if (this.value) {
            $.ajax({
                type: 'POST',
                url: 'chechUsernameAvailabilityHandler.php',
                data: {
                    username: this.value
                },
                success: function (response) {
                    if (response == 'non_existent') {
                        $('#form-username').width('5%');
                        $('#username-yes').show();
                        $('#username-no').hide();
                        $('#usernameAvailInfo').text('Username is available :)');
                    } else if (response == 'existent') {
                        $('#form-username').width('5%');
                        $('#username-yes').hide();
                        $('#username-no').show();
                        $('#usernameAvailInfo').text('Username has already existed.');
                    }
                    else
                        alert('Error in checking username availability.');
                }
            });
        };
    });
    
    /* Show or remove input error area alert */
    $('.registration-form').on('submit', function(e) {
        
        $(this).find('input[type="text"], textarea').each(function(){
            if( $(this).val() == "" ) {
                e.preventDefault();
                $(this).addClass('input-error');
            }
            else {
                $(this).removeClass('input-error');
            }
        });
    });




    /****** addWork page *****/
    // Check if any checkbox is selected
    $('#addWork-submit-btn').click(function() {
        var len = $('input[type=checkbox]:checked').length;

        if (!len) {
            alert('Please select at least one category.');
            return false;
        };
    });

});

/****** Password validation *****/
function checkForm(form) {
    if (form.formPassword.value != form.formConfirmedPassword.value) {
        alert('Two passwords should be identical!');
        return false;
    } else
        return true;
}
