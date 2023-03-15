/*=========================================================================================
  File Name: form-validation.js
  Description: jquery bootstrap validation js
==========================================================================================*/

$(function () {
    'use strict';

    var registerForm = $('.user-register-form'),
        signUpButton = $('.sign-up');
    var isRtl = $('html').attr('data-textdirection') === 'rtl';

    // jQuery Validation
    // --------------------------------------------------------------------
    if (registerForm.length) {
        registerForm.validate({
            /*
            * ? To enable validation onkeyup
            onkeyup: function (element) {
              $(element).valid();
            },*/
            /*
            * ? To enable validation on focusout
            onfocusout: function (element) {
              $(element).valid();
            }, */
            rules: {
                'first_name': {
                    required: true,
                    specialChars: true
                },
                'last_name': {
                    required: true,
                    specialChars: true
                },
                'email': {
                    required: true,
                    specialCharsEmail : true,
                    emailFirstCharacterAlpha : true,
                    emailFirstCharacterValidate : true,
                },
                // 'password': {
                //     required: true,
                //     minlength: 6,
                //     maxlength: 100,
                // }
            },
            messages: {
                first_name: {
                    required : "Enter your first name.",
                    specialChars : "Please use only alphanumeric or alphabetic characters."
                },
                last_name: {
                    required : "Enter your last name.",
                    specialChars : "Please use only alphanumeric or alphabetic characters."
                },
                email: {
                    required: "Enter an email.",
                    email: "Enter a valid email.",
                },
                // password: {
                //     required: "Enter a password",
                //     minlength: "The password should be at least 6-100 characters.",
                //     maxlength: "The password should be at least 6-100 characters."
                // }
            },
            errorPlacement: function (error, element) {
                var name = $(element).attr("name");
                $("." + name + "_err").html("")
                error.appendTo($("." + name + "_err"));
            },

        });
    }


    // $.validator.methods.email = function( value, element ) {
    //     var regex = /^[a-zA-Z0-9]+(?:[._-][a-zA-Z0-9]+)*@[a-zA-Z0-9]+\.[a-zA-Z]{2,}$/;
    //     return regex.test(value);
    // }

    signUpButton.on('click', function (e) {
        const isValid = registerForm.valid();
        e.preventDefault();

        if (isValid) {

            $.ajax({
                data: registerForm.serialize(),
                type: "POST",
                dataType: "json",
                ajax: route('user-registration'),
                beforeSend: function () {
                    $(document).find('span.error-text').text('');
                },
                success: function (response) {
                    console.log(response)

                    if (response.status === 0) {
                        printErrorMsg(response.error)
                    } else {
                        if (response.status === 201) {
                            showResponseMessage();
                            setTimeout(() => {
                                window.location = route('user-login');
                            }, 3000)
                            registerForm.trigger("reset"); // Reset all input form value
                        }
                    }
                },
                error: function (err) {
                    if (err.responseJSON.errors.email[0] !== undefined) {
                        $.showErrorAlert(err.responseJSON.errors.email[0])
                    }

                }
            });
            // newUserSidebar.modal('hide');
            // dtUserTable.draw(); // Reload datatable
        }
    });

    // Print error messages from laravel validation for user input
    function printErrorMsg(errorMessages) {
        $.each(errorMessages, function (key, val) {
            $('.' + key + '_err').text(val[0]);
        })
    }

    function showResponseMessage() {
        Swal.fire({
            title: 'Account created!',
            text: 'Need to approvel!',
            icon: 'success',
            customClass: {
                confirmButton: 'btn btn-primary'
            },
            buttonsStyling: false
        });
    }
});
