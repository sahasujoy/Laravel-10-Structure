/*=========================================================================================
	File Name: global-setting.js
	Description: Global setting.
==========================================================================================*/

$(function () {
    'use strict';

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var _token = $('meta[name="csrf-token"]').attr('content');

    (function (_token){

        var isRtl = $('html').attr('data-textdirection') === 'rtl';

        // variables
        var profileInformationForm = $('.profile-information-form');
        var resetPasswordForm = $('.reset-password-form');
        var profileImageUploadButton = $('#myform');
        // jQuery Validation
        // --------------------------------------------------------------------
        if (profileInformationForm.length) {
            profileInformationForm.each(function () {
                var $this = $(this);

                $this.validate({
                    rules: {
                        firstname: {
                            required: true
                        },
                        lastname: {
                            required: true
                        },
                        phone: {
                            required: true
                        }
                    }
                });

                profileInformationForm.on('submit', function (e) {

                    var isValid = profileInformationForm.valid();
                    e.preventDefault();

                    // add button loader
                    buttonLoaderShow();

                    if (isValid) {
                        setTimeout(function () {
                            $.ajax({
                                data: $(".profile-information-form").serialize(),
                                type: "POST",
                                dataType: "json",
                                url: route('admin-profile-information-data-update'),
                                success: function (response) {
                                    if (response.status === 200) {
                                        showSuccessToaster(response.message)
                                    }else {
                                        showErrorToaster(response.message)
                                    }
                                    buttonLoaderHide();

                                },
                                error: function (err) {
                                    console.log(err);
                                    buttonLoaderHide();
                                },
                                statusCode: {
                                    500: function() {
                                        // Server error
                                    },
                                    422: function(response) {
                                        buttonLoaderHide();
                                        printErrorMsg(response.responseJSON.errors)
                                    }
                                }
                            });
                        },2000);
                    }
                });

            });
        }

        if (resetPasswordForm.length) {
            resetPasswordForm.each(function () {
                var $this = $(this);

                $this.validate({
                    rules: {
                        password: {
                            required: true
                        },
                        confirm_password: {
                            required: true
                        }
                    }
                });

                resetPasswordForm.on('submit', function (e) {

                    var isValid = resetPasswordForm.valid();
                    e.preventDefault();

                    // add button loader
                    buttonLoaderShow();

                    if (isValid) {
                        setTimeout(function () {
                            $.ajax({
                                data: $(".reset-password-form").serialize(),
                                type: "POST",
                                dataType: "json",
                                url: route('admin-reset-password-update'),
                                success: function (response) {
                                    if (response.status === 200) {
                                        showSuccessToaster(response.message)
                                    }else {
                                        showErrorToaster(response.message)
                                    }
                                    buttonLoaderHide();

                                },
                                error: function (err) {
                                    console.log(err);
                                },
                                statusCode: {
                                    500: function() {
                                        // Server error
                                    },
                                    422: function(response) {
                                        buttonLoaderHide();
                                        printErrorMsg(response.responseJSON.errors)
                                    }
                                }
                            });
                        },2000);
                    }
                });

            });
        }


        if (profileImageUploadButton.length) {
            profileImageUploadButton.each(function () {
                var $this = $(this);

                profileImageUploadButton.on('change', function (e) {

                    // add button loader
                    buttonLoaderShow();

                    e.preventDefault();
                    var fd = new FormData();
                    var files = $('#account-upload')[0].files;
                    if(files.length > 0 ) {
                        fd.append('profile_image', files[0]);
                        fd.append('_token', $('meta[name="csrf-token"]').attr('content'));

                        setTimeout(function () {
                            $.ajax({
                                url: route('admin-image-update'),
                                type: 'post',
                                data: fd,
                                contentType: false,
                                processData: false,
                                success: function (response) {
                                    if (response.status === 200) {
                                        showSuccessToaster(response.message)
                                    }else {
                                        showErrorToaster(response.message)
                                    }
                                    buttonLoaderHide();

                                },
                                error: function (err) {
                                    console.log(err);
                                },
                                statusCode: {
                                    500: function() {
                                        // Server error
                                    },
                                    422: function(response) {
                                        buttonLoaderHide();
                                        printErrorMsg(response.responseJSON.errors)
                                    }
                                }
                            });
                        },2000);
                    }

                });

            });
        }


        // Show toaster for success
        function showSuccessToaster(message) {

            toastr['success'](
                message,
                {
                    closeButton: true,
                    tapToDismiss: false,
                    rtl: isRtl
                }
            );
        }

        function showErrorToaster(message) {

            toastr['error'](
                message,
                {
                    closeButton: true,
                    tapToDismiss: false,
                    rtl: isRtl
                }
            );
        }

        // Print error message from laravel validation
        function printErrorMsg(msgs) {
            $.each(msgs, function (key, val) {
                $('.' + key + '_err').text(val);
            })
        }
    })(_token)

});
