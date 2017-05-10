
jQuery(document).ready(function() {
    
    /* Fullscreen background */
    $.backstretch("assets/img/backgrounds/background.jpg");

    
    /***** Login form validation *****/
    /*********************************/
    $('#login-form-btn').click(function() {
        if ( $('#loginFormUsername').val() && $('#loginFormPassword').val() ) {
            $.ajax({
                type: 'POST',
                url: 'loginHandler2.php',
                data: {
                    username: $('#loginFormUsername').val(),
                    password: $('#loginFormPassword').val()
                },
                success: function(response) {
                    alert('ajax succeeded');
                    // $('#loginFormUsername').val('working');
                },
                error: function(){
                    alert("failure");
                }
            });
        }
    });
    

    /***** Registration form validation *****/
    /****************************************/

    /* Check username availability */
    $('#registration-form-username').on('input propertychange paste', function(){
        if (this.value) {
            $.ajax({
                type: 'POST',
                url: 'checkUsernameAvailabilityHandler.php',
                data: {
                    username: this.value
                },
                success: function (response) {
                    if (response == 'non_existent') {
                        $('#registration-form-username').width('5%');
                        $('#username-yes').show();
                        $('#username-no').hide();
                        $('#usernameAvailInfo').text('Username is available :)');
                    } else if (response == 'existent') {
                        $('#registration-form-username').width('5%');
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

    /* Verify password pattern */
    $('#registration-form-password').on('focusout', function() {
        var regex = /(?=^.{8,}$)((?=.*\w)|(?=.*\W+))(?![.\n])(?!.*\s).*$/;
        if (!regex.test(this.value)) {
            alert('Password should be at least 8 characters long.');
        };
    });
    
    /* Password validation */
    $('#registration-form').submit(function(){
        $pwd = $(this).find("#registration-form-password").val();
        $confirmedPwd = $(this).find("#registration-form-confirmed-password").val();

        if ($pwd != $confirmedPwd) {
            alert('Two passwords should be identical!');
            return false;
        } else {
            return true;
        }
    });




    /********** addWork page *********/
    /*********************************/

    /* Check if any checkbox is selected */
    $('#addWork-submit-btn').click(function() {
        var len = $('input[type=checkbox]:checked').length;
        if (!len) {
            alert('Please select at least one category.');
            return false;
        };
    });

});
