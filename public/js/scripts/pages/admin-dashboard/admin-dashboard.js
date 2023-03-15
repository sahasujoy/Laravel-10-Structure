/*=========================================================================================
    File Name: user-dashboard.js
    Description: User dashboard analytic report
==========================================================================================*/

$(function () {
    'use strict';

    var _token = $('input[name="_token"]').val();

    (function (_token) {

        let adminDashboard = {};
        adminDashboard.getImageProcessGraphData = getImageProcessGraphData;
        adminDashboard.setDifferenceDifferenceType = setDifferenceDifferenceType;
        adminDashboard.getStateCountReport = getStateCountReport;

        /*====== Date range picker document id  ======*/
        adminDashboard.rangePickr = $('.flatpickr-range');
        adminDashboard.totalUser = $('.total_user');
        adminDashboard.totalProject = $('.total_project');
        adminDashboard.totalNotification = $('.total_notification');
        adminDashboard.projectDataTable = $('.apps-list-table');
        adminDashboard.userDropdown = $('.user_list');
        adminDashboard.userId = "";

        /*====== Set local variable for date time  ======*/
        let dateVariables = {
            fromDate: moment().subtract(7, 'days').format("YYYY-MM-DD"),
            toDate: moment(new Date()).format("YYYY-MM-DD"),
            dayDifference: 7,
            durationType: 'week',
            fromDateDisable: moment(new Date()).format("YYYY-MM-DD"),
            toDateDisable: moment().add(100, 'years').format("YYYY-MM-DD"),
        }

        /*=========================================================================================
            Action : call getImageProcessGraphData function
            Parameters : fromDate, toDate, dayDifference, durationType
        ==========================================================================================*/
        // adminDashboard.getImageProcessGraphData(dateVariables.fromDate, dateVariables.toDate, dateVariables.dayDifference, dateVariables.durationType);
        fetchDataTable(adminDashboard.userId, dateVariables.fromDate, dateVariables.toDate)
        adminDashboard.getStateCountReport(dateVariables.fromDate, dateVariables.toDate, dateVariables.dayDifference, dateVariables.durationType);

        /*====== Range Date picker event fire for date filter ======*/
        if (adminDashboard.rangePickr.length) {
            adminDashboard.rangePickr.flatpickr({
                mode: 'range',
                dateFormat: "Y-m-d",
                disable: [
                    {
                        from: dateVariables.fromDateDisable,
                        to: dateVariables.toDateDisable
                    }
                ],
                onClose: function (selectedDates, dateStr, instance) {
                    let dateStart = instance.formatDate(selectedDates[0], "Y-m-d");
                    let dateEnd = instance.formatDate(selectedDates[1], "Y-m-d");

                    let startDate = moment(selectedDates[0], "DD.MM.YYYY");
                    let endDate = moment(selectedDates[1], "DD.MM.YYYY");
                    let difference = endDate.diff(startDate, 'days');

                    dateVariables.dayDifference = difference

                    $("#filter_date_label").html(dateStart + ' - ' + dateEnd)

                    adminDashboard.setDifferenceDifferenceType(dateStart, dateEnd, difference)
                    // adminDashboard.getImageProcessGraphData(dateVariables.fromDate, dateVariables.toDate, dateVariables.dayDifference, dateVariables.durationType);
                    adminDashboard.getStateCountReport(dateVariables.fromDate, dateVariables.toDate, dateVariables.dayDifference, dateVariables.durationType);

                    if (adminDashboard.projectDataTable) {
                        /*====== Destroy datatable and reinitialize ======*/
                        adminDashboard.projectDataTable.DataTable().clear().destroy();
                        fetchDataTable(adminDashboard.userId, dateVariables.fromDate, dateVariables.toDate)
                    }
                }
            });
        }

        /*====== Select user for user wise filter ======*/
        if (adminDashboard.userDropdown.length) {
            adminDashboard.userDropdown.on('change', function () {
                adminDashboard.userId = $(this).val()
                // let username = $(this).data('id');
                let username = this.options[this.selectedIndex].getAttribute('data-name')
                adminDashboard.getStateCountReport(dateVariables.fromDate, dateVariables.toDate, dateVariables.dayDifference, dateVariables.durationType);

                $("#filter_user_label").html(username)

                if (adminDashboard.projectDataTable) {
                    /*====== Destroy datatable and reinitialize ======*/
                    adminDashboard.projectDataTable.DataTable().clear().destroy();
                    fetchDataTable(adminDashboard.userId, dateVariables.fromDate, dateVariables.toDate)
                }
            })
        }

        /*=========================================================================================
            Action : Set Day Difference And Duration Type based on date picker data
            Parameters : from_date, to_date, difference
        ==========================================================================================*/
        function setDifferenceDifferenceType(from_date, to_date, difference) {
            dateVariables.fromDate = from_date
            dateVariables.toDate = to_date

            if (parseInt(difference) < 7) {
                dateVariables.durationType = 'week'
            } else if (parseInt(difference) > 7 && parseInt(difference) > 30) {
                dateVariables.durationType = 'month'
            } else if (parseInt(difference) > 365) {
                dateVariables.durationType = 'year'
            }
        }

        /*=========================================================================================
            Action : Get Image Process Graph Data by ajax call and render graph chart
            Parameters : fromDate, toDate, dayDifference, durationType
        ==========================================================================================*/
        function getImageProcessGraphData(fromDate, toDate, dayDifference, durationType) {
            let data = {
                from_date: fromDate,
                to_date: toDate,
                difference: dayDifference,
                duration_type: durationType,
            };

            let ajaxResponse = $.makeAjaxRequest('user-dashboard-graph-data', 'GET', data);

            if (ajaxResponse) {

                let graphChartParams = {
                    totalImage: [50, 30],
                    cleanImage: [30, 20],
                    dateFrame: ['2022-12-29', '2022-12-29'],
                    $graphStrokeColor2: '#d0ccff',
                    $strokeColor: '#ebe9f1',
                    $textMutedColor: '#b9b9c3',
                    $graphChart: document.querySelector('#revenue-chart'),
                }

                $.initiateRenderChart(graphChartParams);
            }
        }

        /*=========================================================================================
            Action : Get get State Count Report Data by ajax call and render in card
            Parameters : fromDate, toDate, dayDifference, durationType
        ==========================================================================================*/
        function getStateCountReport(fromDate, toDate, dayDifference, durationType) {
            let data = {
                from_date: fromDate,
                to_date: toDate,
                difference: dayDifference,
                duration_type: durationType,
                user_id: adminDashboard.userId,
            };

            let ajaxResponse = $.makeAjaxRequest('admin-dashboard-get-state-count-data', 'POST', data);

            if (ajaxResponse) {
                adminDashboard.totalUser.html(ajaxResponse.data?.total_user);
                adminDashboard.totalProject.html(ajaxResponse.data?.total_project);
                adminDashboard.totalNotification.html(ajaxResponse.data?.total_notification);
            }
        }

        /*=========================================================================================
           Action : Show Datatable for project list
           Parameters : userId,fromDate,toDate
       ==========================================================================================*/
        function fetchDataTable(userId, fromDate, toDate) {

            if (adminDashboard.projectDataTable) {
                adminDashboard.projectDataTable.DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: route('admin.dashboard-get-project-datatable-list'),
                        type: 'get',
                        data: {
                            user_id: userId,
                            from_date: fromDate,
                            to_date: toDate,
                        }
                    },
                    columns: [
                        // columns according to JSON
                        {data: 'app_info', name: 'app_info', "searchable": true},
                        {data: 'players', name: 'players'},
                        {data: 'messageable_players', name: 'messageable_players'},
                        {data: 'status', name: 'status', width: "5%", orderable: false},
                        {data: 'action', name: 'action'},
                        {data: 'app_name', name: 'app_name', "visible": false},
                    ],
                });
            }
        }


        /*=========================================================================================
          Return statement should be used when need to re-use code another module.Otherwise, it is not mandatory.
        ==========================================================================================*/
        // return {
        //     dashboard
        // }

    })(_token);


});
