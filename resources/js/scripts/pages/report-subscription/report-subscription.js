$(function () {
    'use strict';

    (function () {

        let subscription = {}

        subscription.DataTable = $('.subscription-table');

        // if (subscription.DataTable.length) {
        //     subscription.DataTable.DataTable({
        //         processing: true,
        //         serverSide: true,
        //
        //         // ajax: assetPath + 'data/user-list.json',
        //         // JSON file to add data
        //
        //         ajax: {
        //             url: route('report-subscription-list'),
        //             type: 'post',
        //             data: {
        //                 app_id: app_id,
        //             },
        //         },
        //         columns: [
        //             {data: 'session_count', name: 'session_count', orderable: false, "visible": true, width: "5%"},
        //             {data: 'language', name: 'language', orderable: false, "visible": true, width: "5%"},
        //             {data: 'timezone', name: 'timezone', orderable: false, "visible": true, width: "5%"},
        //             {data: 'game_version', name: 'game_version', orderable: false, "visible": true, width: "5%"},
        //             {data: 'device_os', name: 'device_os', orderable: false, "visible": true, width: "5%"},
        //             {data: 'device_type', name: 'device_type', orderable: false, "visible": true, width: "5%"},
        //             {data: 'device_model', name: 'device_model', orderable: false, "visible": true, width: "5%"},
        //             {data: 'ad_id', name: 'ad_id', orderable: false, "visible": true, width: "5%"},
        //             {data: 'tags', name: 'tags', orderable: false, "visible": true, width: "5%"},
        //             {data: 'last_active', name: 'last_active', orderable: false, "visible": true, width: "5%"},
        //             {data: 'amount_spent', name: 'amount_spent', orderable: false, "visible": true, width: "5%"},
        //             {data: 'invalid_identifier', name: 'invalid_identifier', orderable: false, "visible": true, width: "5%"},
        //             {data: 'badge_count', name: 'badge_count', orderable: false, "visible": true, width: "5%"},
        //             {data: 'test_type', name: 'test_type', orderable: false, "visible": true, width: "5%"},
        //             {data: 'ip', name: 'ip', orderable: false, "visible": true, width: "5%"},
        //         ],
        //
        //         autoWidth: true
        //     });
        // }


        let tableBody = $("table tbody");
        renderDeviceList(0)

        function renderDeviceList(offset = 0) {
            let data = {
                offset: offset,
                web_app_id: app_id
            };
            let response = $.makeAjaxRequest('report-subscription-list', "GET", data)

            tableBody.html(response.data);
            let pagination = $(".device_pagination");
            pagination.html(response.extra_data);
        }

        $(document).on('click', '.page-item', function () {
            tableBody.html("");
            let offset = $(this).data('id');
            renderDeviceList(offset)
        })
    })();

});
