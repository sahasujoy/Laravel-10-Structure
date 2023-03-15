/*=========================================================================================
  File Name: form-validation.js
  Description: jquery bootstrap validation js
==========================================================================================*/

$(function () {
  'use strict';

    (function () {
        let userResetPassword = {}
        userResetPassword.pageResetPasswordForm = $('.auth-reset-password-form');
        userResetPassword.resetPasswordButton = $('.reset-password-btn')

        // jQuery Validation
        // --------------------------------------------------------------------
        if (userResetPassword.pageResetPasswordForm.length) {
            userResetPassword.pageResetPasswordForm.validate({
                rules: {
                    'otp': {
                        required: true
                    },
                    'reset-password-new': {
                        required: true
                    },
                    'reset-password-confirm': {
                        required: true,
                        equalTo: '#reset-password-new'
                    }
                }
            });
        }

        /*====== Ajax request for reset password  ======*/
        userResetPassword.resetPasswordButton.on('click', function (e) {
            const isValid = userResetPassword.pageResetPasswordForm.valid();
            e.preventDefault();

            if (isValid) {

                userResetPassword.data = userResetPassword.pageResetPasswordForm.serialize();
                let response = $.makeAjaxRequest('user-forgot-password-token-verify', "POST", userResetPassword.data)

                if (response?.status === $.Response.HTTP_BAD_REQUEST) {
                    $('.token_validate_error').text(response.message);
                }

                if (response?.status === $.Response.HTTP_OK) {
                    window.location.href = route('user-login-view');
                }
            }
        });
    })()
});
