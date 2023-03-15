/*=========================================================================================
  File Name: form-validation.js
  Description: Admin login form validation js
==========================================================================================*/

$(function () {
    'use strict';

    (function () {
        let adminLogin = {}

        adminLogin.adminLoginForm = $('.admin-login-form')
        adminLogin.signInButton = $('.sign-in-btn');

        // Admin login form Validation
        // --------------------------------------------------------------------
        if (adminLogin.adminLoginForm.length) {
            adminLogin.adminLoginForm.validate({
                rules: {
                    'email': {
                        required: true,
                        email: true
                    },
                    'password': {
                        required: true
                    }
                }
            });
        }

        adminLogin.signInButton.on('click', function (e) {
            const isValid = adminLogin.adminLoginForm.valid();
            e.preventDefault();

            if (isValid) {

                adminLogin.data = adminLogin.adminLoginForm.serialize();
                let response = $.makeAjaxRequest('login-admin', "POST", adminLogin.data)

                if (response.status === 0) {
                    $.showServerSideValidation(response.error)
                }

                if (response.status === $.Response.HTTP_UNAUTHORIZED) {
                    $('.credential_error').text(response.message);
                }

                if (response.status === $.Response.HTTP_OK) {
                    window.location.href = route('admin-dashboard');
                }
            }
        });

    })()

});
