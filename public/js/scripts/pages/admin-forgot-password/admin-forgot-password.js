/*=========================================================================================
  File Name: form-validation.js
  Description: Admin forget-password form validation
==========================================================================================*/

$(function () {
    'use strict';

    var _token = $('input[name="_token"]').val();

    (function (_token) {
        let adminForgetPassword = {}
        adminForgetPassword.pageForgotPasswordForm = $('.auth-forgot-password-form');
        adminForgetPassword.forgetPasswordButton = $('.forget-password-btn');

        // Admin forget-password form validation
        // --------------------------------------------------------------------
        if (adminForgetPassword.pageForgotPasswordForm.length) {
            adminForgetPassword.pageForgotPasswordForm.validate({

                rules: {
                    'email': {
                        required: true,
                        email: true
                    }
                }
            });
        }

        adminForgetPassword.forgetPasswordButton.on('click', function (e) {
            const isValid = adminForgetPassword.pageForgotPasswordForm.valid();
            e.preventDefault();

            if (isValid) {

                adminForgetPassword.data = adminForgetPassword.pageForgotPasswordForm.serialize();
                let email = adminForgetPassword.pageForgotPasswordForm.find('input[name="email"]').val();

                let response = $.makeAjaxRequest('admin-forgot-password-token-send', "POST", adminForgetPassword.data)

                if (response.status === 0) {
                    $.showServerSideValidation(response.error)
                }

                if (response?.status === $.Response.HTTP_UNPROCESSABLE_ENTITY) {
                    $('.send_otp_error').text(response.message);
                }

                if (response.status === $.Response.HTTP_OK) {
                    console.log('response forgot password',response)
                    window.location.href = route('admin-reset-password',email);
                }
            }
        });
    })(_token)


});
