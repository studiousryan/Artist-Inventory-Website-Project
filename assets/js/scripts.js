
jQuery(document).ready(function() {
    
    /*
        Fullscreen background
    */
    $.backstretch("assets/img/backgrounds/background.jpg");
    
    /*
        Login form validation
    */
    $('.login-form input[type="text"], .login-form input[type="password"], .login-form textarea').on('focus', function() {
        $(this).removeClass('input-error');
    });
    
    $('.login-form').on('submit', function(e) {
        
        $(this).find('input[type="text"], input[type="password"], textarea').each(function(){
            if( $(this).val() == "" ) {
                e.preventDefault();
                $(this).addClass('input-error');
            }
            else {
                $(this).removeClass('input-error');
            }
        });
        
    });
    
    /***** Verify password pattern *****/
    $('#form-password').on('focusout', function() {
        var regex = /(?=^.{8,}$)((?=.*\w)|(?=.*\W+))(?![.\n])(?!.*\s).*$/;
        if (!regex.test(this.value)) {
            alert('Password should be 8 characters long.');
        };
    });

     /*   Registration form validation */
    $('.registration-form input[type="text"], .registration-form textarea').on('focus', function() {
        $(this).removeClass('input-error');
    });

    $('#form-username').on('input propertychange paste', function(){
        if (this.value) {
            $.ajax({
                type: 'POST',
                url: 'chechUsernameAvailabilityHandler.php',
                data: {
                    username: this.value
                },
                success: function (response) {
                    $('#form-username').width('5%');
                    if (response == 'non_existent') {
                        $('#username-yes').show();
                        $('#username-no').hide();
                        $('#usernameAvailInfo').text('Username is available :)');
                    } else if (response == 'existent') {
                        $('#username-yes').hide();
                        $('#username-no').show();
                        $('#usernameAvailInfo').text('Username has already existed.');
                    }
                }
            });
        };
    });
    
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
        
        // if ($('#form-password').val() != $('#form-confirmed-password').val()) {
        //     alert('Two passwords should be identical!');
        // }

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
