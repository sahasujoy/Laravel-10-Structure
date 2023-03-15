$(function () {
    'use strict';

    (function () {

        let broadcast = {}

        broadcast.DataTable = $('.report-delivery-table');
        broadcast.DataTableSent = $('.sent-report-delivery-table');
        broadcast.DataTableSchedule = $('.schedule-report-delivery-table');

        if (broadcast.DataTable.length) {
            broadcast.DataTable.DataTable({
                processing: true,
                serverSide: true,

                // ajax: assetPath + 'data/user-list.json',
                // JSON file to add data

                ajax: {
                    url: route('broadcast-list'),
                    type: 'post',
                    data: {
                        app_id: app_id,
                        'send_type' : 1
                    },
                },
                columns: [
                    // columns according to JSON
                    // 'message', 'status', 'delivered'
                    {data: 'message', name: 'message', orderable: false, "visible": true, width: "40%"},
                    {data: 'segment_type', name: 'segment_type', orderable: false, "visible": true, width: "40%"},
                    {data: 'status', name: 'status', orderable: false, "visible": true, width: "5%"},
                    {data: 'sent_at', name: 'sent_at', orderable: false, "visible": true, width: "15%"},
                    {data: 'delivered', name: 'delivered', orderable: false, "visible": true, width: "15%"},
                    {data: 'sent', name: 'sent', orderable: false, "visible": true, width: "15%"},
                    {data: 'action', name: 'action', orderable: false, "visible": true, width: "10%"},
                ],

                autoWidth: true
            });
        }
        if (broadcast.DataTableSent.length) {
            broadcast.DataTableSent.DataTable({
                processing: true,
                serverSide: true,

                // ajax: assetPath + 'data/user-list.json',
                // JSON file to add data

                ajax: {
                    url: route('broadcast-list'),
                    type: 'post',
                    data: {
                        app_id: app_id,
                        'send_type' : 2
                    },
                },
                columns: [
                    // columns according to JSON
                    // 'message', 'status', 'delivered'
                    {data: 'message', name: 'message', orderable: false, "visible": true, width: "40%"},
                    {data: 'segment_type', name: 'segment_type', orderable: false, "visible": true, width: "40%"},
                    {data: 'status', name: 'status', orderable: false, "visible": true, width: "5%"},
                    {data: 'sent_at', name: 'sent_at', orderable: false, "visible": true, width: "15%"},
                    {data: 'delivered', name: 'delivered', orderable: false, "visible": true, width: "15%"},
                    {data: 'sent', name: 'sent', orderable: false, "visible": true, width: "15%"},
                    {data: 'action', name: 'action', orderable: false, "visible": true, width: "10%"},
                ],

                autoWidth: true
            });
        }
        if (broadcast.DataTableSchedule.length) {
            broadcast.DataTableSchedule.DataTable({
                processing: true,
                serverSide: true,

                // ajax: assetPath + 'data/user-list.json',
                // JSON file to add data

                ajax: {
                    url: route('broadcast-list'),
                    type: 'post',
                    data: {
                        app_id: app_id,
                        'send_type' : 3
                    },
                },
                columns: [
                    // columns according to JSON
                    // 'message', 'status', 'delivered'
                    {data: 'message', name: 'message', orderable: false, "visible": true, width: "40%"},
                    {data: 'segment_type', name: 'segment_type', orderable: false, "visible": true, width: "40%"},
                    {data: 'status', name: 'status', orderable: false, "visible": true, width: "5%"},
                    {data: 'sent_at', name: 'sent_at', orderable: false, "visible": true, width: "15%"},
                    {data: 'delivered', name: 'delivered', orderable: false, "visible": true, width: "15%"},
                    {data: 'sent', name: 'sent', orderable: false, "visible": true, width: "15%"},
                    {data: 'action', name: 'action', orderable: false, "visible": true, width: "10%"},
                ],

                autoWidth: true
            });
        }
        broadcast.DataTable.on('click', '.delete-report', function () {
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

                    if (response.status === $.Response.HTTP_OK) {
                        broadcast.DataTable.DataTable().ajax.reload(null, false);
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
