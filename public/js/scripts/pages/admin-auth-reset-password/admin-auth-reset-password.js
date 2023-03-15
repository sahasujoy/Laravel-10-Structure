/*=========================================================================================
  File Name: form-validation.js
  Description: Reset password form validation js
==========================================================================================*/

$(function () {
    'use strict';

    (function () {
        let adminResetPassword = {};
        adminResetPassword.pageResetPasswordForm = $('.auth-reset-password-form');
        adminResetPassword.resetPasswordButton = $('.reset-password-btn')

        // jQuery Validation
        // --------------------------------------------------------------------
        if (adminResetPassword.pageResetPasswordForm.length) {
            adminResetPassword.pageResetPasswordForm.validate({
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
        adminResetPassword.resetPasswordButton.on('click', function (e) {
            const isValid = adminResetPassword.pageResetPasswordForm.valid();
            e.preventDefault();

            if (isValid) {

                adminResetPassword.data = adminResetPassword.pageResetPasswordForm.serialize();
                let response = $.makeAjaxRequest('admin-forgot-password-token-verify', "POST", adminResetPassword.data)

                if (response?.status === $.Response.HTTP_BAD_REQUEST) {
                    $('.token_validate_error').text(response.message);
                }

                if (response?.status === $.Response.HTTP_OK) {
                    window.location.href = route('admin-login-view');
                }
            }
        });
    })()


});
