/*=========================================================================================
  File Name: user-login.js
  ----------------------------------------------------------------------------------------
==========================================================================================*/

$(function () {
    'use strict';
    (function () {

        let userLogin = {}

        userLogin.userLoginForm = $('.user-login-form')
        userLogin.signInButton = $('.sign-in-btn')

        /*====== Login form Validation  ======*/
        if (userLogin.userLoginForm.length) {
            userLogin.userLoginForm.validate({
                rules: {
                    'email': {
                        required: true,
                        email: true
                    },
                    'password': {
                        required: false
                    }
                }
            });
        }

        /*====== Ajax request for login  ======*/
        userLogin.signInButton.on('click', function (e) {
            const isValid = userLogin.userLoginForm.valid();
            e.preventDefault();

            if (isValid) {

                userLogin.data = userLogin.userLoginForm.serialize();
                let response = $.makeAjaxRequest('user-login', "POST", userLogin.data)

                if (response.status === 0) {
                    $.showServerSideValidation(response.error)
                }

                if (response.status === $.Response.HTTP_UNAUTHORIZED) {
                    $('.credential_error').text(response.message);
                }

                if (response.status === $.Response.HTTP_OK) {
                    window.location.href = route('user-dashboard');
                }
            }
        });
    })()
});
