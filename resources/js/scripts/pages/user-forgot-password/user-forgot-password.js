/*=========================================================================================
  File Name: form-validation.js
  Description: User login form validation js
==========================================================================================*/

$(function () {
  'use strict';

    (function () {
        let userForgetPassword = {}
        userForgetPassword.pageForgotPasswordForm = $('.auth-forgot-password-form');
        userForgetPassword.forgetPasswordButton = $('.forget-password-btn');

        // User login form Validation
        // --------------------------------------------------------------------
        if (userForgetPassword.pageForgotPasswordForm.length) {
            userForgetPassword.pageForgotPasswordForm.validate({
                rules: {
                    'forgot-password-email': {
                        required: true,
                        email: true
                    }
                }
            });
        }

        // ajax request for reset password mail send
        userForgetPassword.forgetPasswordButton.on('click', function (e) {
            const isValid = userForgetPassword.pageForgotPasswordForm.valid();
            e.preventDefault();

            if (isValid) {

                userForgetPassword.data = userForgetPassword.pageForgotPasswordForm.serialize();
                let email = userForgetPassword.pageForgotPasswordForm.find('input[name="email"]').val();

                let response = $.makeAjaxRequest('user-forgot-password-token-send', "POST", userForgetPassword.data)

                if (response?.status === 0) {
                    $.showServerSideValidation(response.error)
                }

                if (response?.status === $.Response.HTTP_UNPROCESSABLE_ENTITY) {
                    $('.send_otp_error').text(response.message);
                }

                if (response?.status === $.Response.HTTP_OK) {
                    window.location.href = route('user-reset-password',email);
                }
            }
        });
    })()


});
