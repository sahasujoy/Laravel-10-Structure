/*=========================================================================================
    File Name: profile-settings.js
    Description: Admin Profile Setting
==========================================================================================*/

$(function () {
    'use strict';

    (function () {



        /*=========================================================================================
           We declare a global object for manage all data
       ==========================================================================================*/
        let profileManage = {}

        profileManage.profileInformationForm = $('.profile-information-form');
        profileManage.profileManageresetPasswordForm = $('.reset-password-form');
        profileManage.profileImageUploadButton = $('#myProfileImageform');

        /*=========================================================================================
           Action : Admin profile information update
           Description : Form Validation and submit form for update admin info
           Backend Route Name : admin-profile-information-data-update
       ==========================================================================================*/
        if (profileManage.profileInformationForm.length) {
            profileManage.profileInformationForm.validate({
                errorClass: 'error',
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
                        email: true
                    },
                    'phone': {
                        required: true,
                        number: true,
                        minlength: 8,
                    }
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
                        required: "Enter a email.",
                        email: "Enter a valid email."
                    },
                    phone: {
                        required: "Enter a password",
                        number: "The phone number is invalid",
                        minlength: "The phone number is invalid",
                    }
                },
                errorPlacement: function (error, element) {
                    var name = $(element).attr("name");
                    $("." + name + "_err").html("")
                    error.appendTo($("." + name + "_err"));
                },
            });

            profileManage.profileInformationForm.on('submit', function (e) {
                let isValid = profileManage.profileInformationForm.valid();
                e.preventDefault();
                let form = this;

                if (isValid) {
                    // add button loader
                    buttonLoaderShow('button-submit', 'button-loader');
                    setTimeout(function () {
                        profileManage.profileInformationFormData = profileManage.profileInformationForm.serialize();
                        let response = $.makeAjaxRequest('admin-profile-information-data-update', "POST", profileManage.profileInformationFormData)

                        if (response.status === $.Response.HTTP_OK) {
                            $.showSuccessAlert(response.message)
                        }else if (response.status === 0) {
                            $.showServerSideValidation(response.message)
                        }else{
                            $.showErrorAlert(response.message)
                        }
                        // add button loader
                        console.log('sdf')
                        buttonLoaderHide('button-submit', 'button-loader');
                    }, 2000);

                }

            });
        }


        /*=========================================================================================
           Action : Admin password change
           Description : Form Validation and submit form for password
           Backend Route Name : admin-reset-password-update
       ==========================================================================================*/
        if (profileManage.profileManageresetPasswordForm.length) {
            profileManage.profileManageresetPasswordForm.validate({
                errorClass: 'error',
                rules: {
                    new_password: {
                        required: true,
                        minlength: 6,
                        maxlength: 100,
                    },
                    confirm_password: {
                        required: true,
                        equalTo: '#account-new-password'
                    }
                },
                messages: {
                    new_password: {
                        required: "Enter a password",
                        minlength: "The password should be at least 6-100 characters.",
                        maxlength: "The password should be at least 6-100 characters."
                    },
                    confirm_password: {
                        required: "Enter a confirmation password",
                        equalTo: "The password does not match."
                    }
                },
                errorPlacement: function (error, element) {
                    var name = $(element).attr("name");
                    $("." + name + "_err").html("")
                    error.appendTo($("." + name + "_err"));
                },
            });

            profileManage.profileManageresetPasswordForm.on('submit', function (e) {
                let isValid = profileManage.profileManageresetPasswordForm.valid();
                e.preventDefault();
                let form = this;

                if (isValid) {
                    // add button loader
                    buttonLoaderShow('button-submit', 'button-loader');
                    setTimeout(function () {
                        profileManage.profileManageresetPasswordFormData = profileManage.profileManageresetPasswordForm.serialize();
                        let response = $.makeAjaxRequest('admin-reset-password-update', "POST", profileManage.profileManageresetPasswordFormData)
                        if (response.status === $.Response.HTTP_OK) {
                            $.showSuccessAlert(response.message)
                        }else if (response.status === 0) {
                            $.showServerSideValidation(response.error)
                        }else{
                            $.showErrorAlert(response.message)
                        }
                        // add button loader
                        buttonLoaderHide('button-submit', 'button-loader');

                    }, 2000);


                }

            });
        }


        /*=========================================================================================
          Action : Admin profile image change
          Description : Form Validation and submit form for profile image
          Backend Route Name : admin-reset-password-update
      ==========================================================================================*/
        if (profileManage.profileImageUploadButton.length) {
            profileManage.profileImageUploadButton.each(function () {
                var $this = $(this);

                profileManage.profileImageUploadButton.on('change', function (e) {

                    // add button loader
                    buttonLoaderShow('account-upload','button-loader-image');

                    e.preventDefault();
                    var fd = new FormData();
                    var files = $('#account-upload')[0].files;
                    if(files.length > 0 ) {
                        fd.append('profile_image', files[0]);
                        fd.append('_token', $('meta[name="csrf-token"]').attr('content'));

                        setTimeout(function () {
                            $.ajax({
                                url: route('admin-profile-image-update'),
                                type: 'post',
                                data: fd,
                                contentType: false,
                                processData: false,
                                success: function (response) {
                                    if (response.status === $.Response.HTTP_OK) {
                                        $.showSuccessAlert(response.message)
                                        setTimeout(function () {
                                            window.location.reload()
                                        },2000)
                                    }else if (response.status === 0) {
                                        $.showServerSideValidation(response.error)
                                    }else{
                                        $.showErrorAlert(response.message)
                                    }
                                    buttonLoaderHide('account-upload', 'button-loader-image');

                                },
                                error: function (err) {
                                    console.log(err);
                                },
                                statusCode: {
                                    500: function() {
                                        // Server error
                                    },
                                    422: function(response) {
                                        buttonLoaderHide('account-upload', 'button-loader-image');
                                        $.showErrorAlert(response.responseJSON.errors)
                                    }
                                }
                            });
                        },2000);
                    }

                });

            });
        }


    })();

});
