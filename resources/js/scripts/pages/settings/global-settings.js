$(function () {
    'use strict';

    (function () {

        let integrationManage = {}

        integrationManage.defaultLimitSettingForm = $('.default-limit-setting-form');

        // Form Validation and submit form for setup onesignal auth key
        if (integrationManage.defaultLimitSettingForm.length) {
            integrationManage.defaultLimitSettingForm.validate({
                errorClass: 'error',
                rules: {
                    'apps_limit': {
                        required: true,
                        min: 1,
                        number: true,
                    },
                    'monthly_limit': {
                        required: true,
                        min: 1,
                        number: true,
                    }
                },
                messages: {
                    apps_limit: {
                        required: "Enter a apps limit ",
                        min: "The apps limit must be at least 1 number.",
                        number: "The apps limit must be a number."
                    },
                    monthly_limit: {
                        required: "Enter a monthly limit ",
                        min: "The monthly limit must be at least 1 number.",
                        number: "The apps limit must be a number."
                    },
                },
                errorPlacement: function (error, element) {
                    var name = $(element).attr("name");
                    $("." + name + "_err").html("")
                    error.appendTo($("." + name + "_err"));
                },
            });
            integrationManage.defaultLimitSettingForm.on('submit', function (e) {

                let isValid = integrationManage.defaultLimitSettingForm.valid();
                e.preventDefault();
                let form = this;
                if (isValid) {
                    // add button loader
                    buttonLoaderShow();
                    setTimeout(function () {
                        integrationManage.defaultLimitSettingFormData = integrationManage.defaultLimitSettingForm.serialize();
                        let response = $.makeAjaxRequest('default-limit-data-update', "POST", integrationManage.defaultLimitSettingFormData)

                        if (response.status === $.Response.HTTP_OK) {
                            // Reset all form input value
                            $.showSuccessAlert(response.message)
                        }else {
                            $.showSuccessAlert(response.message)
                        }
                        buttonLoaderHide();
                    },2000);
                }
            });
        }


    })();

});
