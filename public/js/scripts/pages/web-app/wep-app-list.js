$(function () {
    'use strict';

    (function () {

        let webAppOption = {}

        webAppOption.DataTable = $('.web-app-table');

        document.cookie = "app_id=;";



        if (webAppOption.DataTable.length) {
            webAppOption.DataTable.DataTable({
                processing: true,
                serverSide: true,

                // ajax: assetPath + 'data/user-list.json',
                // JSON file to add data

                ajax: {
                    url: route('web-app-list-for-table'),
                    type: 'get',
                    data: {},
                },
                columns: [
                    {data: 'app_name', name: 'app_name', orderable: false, "visible": true, width: "50%"},
                    {data: 'players', name: 'players', orderable: false, "visible": true, width: "15%"},
                    {data: 'messageable_players', name: 'messageable_players', orderable: false, "visible": true, width: "15%"},
                    {data: 'action', name: 'action', orderable: false, "visible": true, width: "20%"},
                ],

                autoWidth: true
            });
        }


        webAppOption.DataTable.on('click', '.delete-app', function () {
            let data_id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete this app!',
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
                    let response = $.makeAjaxRequest('web-app-delete', "POST", data)

                    console.log(response)
                    if (response.status === $.Response.HTTP_OK) {
                        webAppOption.DataTable.DataTable().ajax.reload(null, false);
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
