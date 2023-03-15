/*=========================================================================================
    File Name: user-dashboard.js
    Description: User dashboard analytic report
==========================================================================================*/

$(function () {
    'use strict';

    var _token = $('input[name="_token"]').val();

    (function (_token) {

        let userWiseProject = {};
        userWiseProject.setDifferenceDifferenceType = setDifferenceDifferenceType;

        /*====== Date range picker document id  ======*/
        userWiseProject.rangePickr = $('.flatpickr-range');
        userWiseProject.totalUser = $('.total_user');
        userWiseProject.totalProject = $('.total_project');
        userWiseProject.totalNotification = $('.total_notification');
        userWiseProject.projectDataTable = $('.apps-list-table');

        /*====== Set local variable for date time  ======*/
        let dateVariables = {
            fromDate: moment().subtract(7, 'days').format("YYYY-MM-DD"),
            toDate: moment(new Date()).format("YYYY-MM-DD"),
            dayDifference: 7,
            durationType: 'week',
            fromDateDisable: moment(new Date()).format("YYYY-MM-DD"),
            toDateDisable: moment().add(100, 'years').format("YYYY-MM-DD"),
        }

        /*====== Range Date picker event fire for date filter ======*/
        if (userWiseProject.rangePickr.length) {
            userWiseProject.rangePickr.flatpickr({
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

                    $("#filter_date_label").html(dateStart + ' - ' + dateEnd)

                    userWiseProject.setDifferenceDifferenceType(dateStart, dateEnd, difference)
                }
            });
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
           Action : User wise project list datatable
           Parameters : fromDate, toDate, dayDifference, durationType
       ==========================================================================================*/

        if (userWiseProject.projectDataTable) {
            let userId = $(".user_wise_id").val();
            console.log(userId,'user_wise_id')
            userWiseProject.projectDataTable.DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: route('admin.dashboard-get-project-datatable-list'),
                    type: 'get',
                    data: {
                        from_date: dateVariables.fromDate,
                        to_date: dateVariables.toDate,
                        difference: dateVariables.dayDifference,
                        duration_type: dateVariables.durationType,
                        user_id: userId,
                    }
                },
                columns: [
                    // columns according to JSON
                    {data: 'app_name', name: 'app_name', "searchable": true},
                    {data: 'players', name: 'players'},
                    {data: 'messageable_players', name: 'messageable_players'},
                    {data: 'status', name: 'status', width: "5%", orderable: false},
                    {data: 'action', name: 'action'},
                ],
            });
        }

    })(_token);


});
