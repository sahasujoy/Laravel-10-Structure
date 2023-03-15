$(function () {
    'use strict';

    (function () {

        let integrationManage = {}

         integrationManage.onesignalIntegrationForm = $('.onesignal-provider-integration-form');
         integrationManage.onesignalIntegrationStatus = $('.onesignal-status-change-click');
         integrationManage.sendgridIntegrationForm = $('.sendgrid-provider-integration-form');
         integrationManage.sendgridIntegrationStatus = $('.sendgrid-status-change-click');

        // Form Validation and submit form for setup onesignal auth key
        if (integrationManage.onesignalIntegrationForm.length) {
            integrationManage.onesignalIntegrationForm.validate({
                errorClass: 'error',
                rules: {
                    api_name: {
                        required: true
                    },
                    api_key: {
                        required: true
                    }
                }
            });

            integrationManage.onesignalIntegrationForm.on('submit', function (e) {
                let isValid = integrationManage.onesignalIntegrationForm.valid();
                e.preventDefault();
                let form = this;
                // add button loader
                buttonLoaderShow('button-submit_1', 'button-loader_1');

                if (isValid) {
                    setTimeout(function () {
                        integrationManage.onesignalData = $(".onesignal-provider-integration-form").serialize();
                        let response = $.makeAjaxRequest('set-gateway-provider-data', "POST", integrationManage.onesignalData)

                        if (response.status === $.Response.HTTP_OK) {
                            // Reset all form input value
                            $.showSuccessAlert(response.message)
                        }else{
                            $.showErrorAlert(response.message)
                        }
                        buttonLoaderHide('button-submit_1', 'button-loader_1');
                    },2000);
                }
            });
        }

        // Form Validation and submit form for setup sendgrid auth key
        if (integrationManage.sendgridIntegrationForm.length) {
            integrationManage.sendgridIntegrationForm.validate({
                errorClass: 'error',
                rules: {
                    from_email: {
                        required: true
                    },
                    api_key: {
                        required: true
                    }
                }
            });

            integrationManage.sendgridIntegrationForm.on('submit', function (e) {
                let isValid = integrationManage.sendgridIntegrationForm.valid();
                e.preventDefault();
                let form = this;
                // add button loader
                buttonLoaderShow('button-submit_2', 'button-loader_2');

                if (isValid) {
                    setTimeout(function () {
                        integrationManage.sendgridData = $(".sendgrid-provider-integration-form").serialize();
                        let response = $.makeAjaxRequest('set-gateway-provider-data', "POST", integrationManage.sendgridData)

                        if (response.status === $.Response.HTTP_OK) {
                            // Reset all form input value
                            $.showSuccessAlert(response.message)
                        }else{
                            $.showErrorAlert(response.message)
                        }
                        buttonLoaderHide('button-submit_2', 'button-loader_2');
                    },2000);
                }
            });
        }

        // Onesignal change status
        integrationManage.onesignalIntegrationStatus.on('click', function (e) {
            e.preventDefault();
            let onesignalStatus = false;
            let titleText = 'Your users won\'t be able to create any apps.';
            let confirmText = 'Yes, activate it';
            if ($('.onesignal-status-change-click').is(":checked"))
            {
                onesignalStatus = true;
                titleText = 'Your user will be able to create any apps.';
                confirmText = 'Yes, deactivate it';
            }

            Swal.fire({
                title: 'Are you sure?',
                text: titleText,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: confirmText,
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ml-1'
                },
                buttonsStyling: false
            }).then(function (result) {

                if (result.value) {

                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        ajax: route('delete-user'),
                        success: function (data) {

                        },
                        error: function (err) {

                        }
                    });


                }
            });
        });

    })();

});
