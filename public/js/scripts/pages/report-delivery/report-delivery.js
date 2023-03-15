$(function () {
    'use strict';

    (function () {

        let reportDelivery = {}

        reportDelivery.DataTable = $('.report-delivery-table');

        if (reportDelivery.DataTable.length) {
            reportDelivery.DataTable.DataTable({
                processing: true,
                serverSide: true,

                // ajax: assetPath + 'data/user-list.json',
                // JSON file to add data

                ajax: {
                    url: route('report-delivery-list'),
                    type: 'post',
                    data: {
                        app_id: app_id,
                    },
                },
                columns: [
                    // columns according to JSON
                    // 'message', 'status', 'delivered'
                    {data: 'message', name: 'message', orderable: false, "visible": true, width: "40%"},
                    {data: 'status', name: 'status', orderable: false, "visible": true, width: "5%"},
                    {data: 'sent_at', name: 'sent_at', orderable: false, "visible": true, width: "15%"},
                    {data: 'delivered', name: 'delivered', orderable: false, "visible": true, width: "15%"},
                    {data: 'sent', name: 'sent', orderable: false, "visible": true, width: "15%"},
                    {data: 'action', name: 'action', orderable: false, "visible": true, width: "10%"},
                ],

                autoWidth: true
            });
        }


        reportDelivery.DataTable.on('click', '.delete-report', function () {
            let data_id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete this report!',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ml-1'
                },
                buttonsStyling: false
            }).then(function (result) {
                if (result.value) {
                    // add button loader
                    buttonLoaderShow('button-submit', 'button-loader');
                    const data = {
                        id : data_id,
                    };
                    let response = $.makeAjaxRequest('broadcast-delete-by-id', "POST", data)

                    console.log(response)
                    if (response.status === $.Response.HTTP_OK) {
                        reportDelivery.DataTable.DataTable().ajax.reload(null, false);
                        if (response.status === 0) {
                            $.showServerSideValidation(response.error)
                        } else {
                            $.showSuccessAlert(response.message)
                        }
                        // add button loader
                        buttonLoaderHide('button-submit', 'button-loader');
                    }
                }
            });
        });

    })();

});
