/*=========================================================================================
    File Name: user-dashboard.js
    Description: User dashboard analytic report
==========================================================================================*/

$(function () {
    'use strict';

    var _token = $('input[name="_token"]').val();

    (function (_token) {

        let projectCount = {};
        projectCount.setDifferenceDifferenceType = setDifferenceDifferenceType;

        /*====== Date range picker document id  ======*/
        projectCount.rangePickr = $('.flatpickr-range');
        projectCount.totalUser = $('.total_user');
        projectCount.totalProject = $('.total_project');
        projectCount.totalNotification = $('.total_notification');
        projectCount.projectCountDataTable = $('.project-count-table');
        projectCount.userDropdown = $('.user_list');
        projectCount.userId = "";

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
        Action : Initial function call
        Parameters : userId, fromDate, toDate, dayDifference, durationType
        ==========================================================================================*/
        fetchDataTable(projectCount.userId, dateVariables.fromDate, dateVariables.toDate, dateVariables.dayDifference, dateVariables.durationType)

        /*====== Range Date picker event fire for date filter ======*/
        if (projectCount.rangePickr.length) {
            projectCount.rangePickr.flatpickr({
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

                    projectCount.setDifferenceDifferenceType(dateStart, dateEnd, difference)

                    $("#filter_date_label").html(dateStart + ' - ' + dateEnd)

                    if (projectCount.projectCountDataTable) {
                        /*====== Destroy datatable and reinitialize ======*/
                        projectCount.projectCountDataTable.DataTable().clear().destroy()
                        fetchDataTable(projectCount.userId, dateVariables.fromDate, dateVariables.toDate, dateVariables.dayDifference, dateVariables.durationType)
                    }
                }
            });
        }

        /*====== Select user for user wise filter ======*/
        if (projectCount.userDropdown.length) {
            projectCount.userDropdown.on('change', function () {
                projectCount.userId = $(this).val()
                let username = this.options[this.selectedIndex].getAttribute('data-name')
                $("#filter_user_label").html(username)

                if (projectCount.projectCountDataTable) {
                    /*====== Destroy datatable and reinitialize ======*/
                    projectCount.projectCountDataTable.DataTable().clear().destroy();
                    fetchDataTable(projectCount.userId, dateVariables.fromDate, dateVariables.toDate, dateVariables.dayDifference, dateVariables.durationType)
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
           Action : Project count datatable list
           Parameters : fromDate, toDate, dayDifference, durationType
       ==========================================================================================*/
        function fetchDataTable(userId, fromDate, toDate, dayDifference, durationType) {
            if (projectCount.projectCountDataTable) {
                projectCount.projectCountDataTable.DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: route('admin.project-list-datatable'),
                        type: 'get',
                        data: {
                            user_id: userId,
                            from_date: fromDate,
                            to_date: toDate,
                            difference: dayDifference,
                            duration_type: durationType,
                        }
                    },
                    columns: [
                        // columns according to JSON
                        {data: 'userInfo', name: 'userInfo', "searchable": true},
                        {data: 'total_project', name: 'total_project'},
                        {data: 'total_notification', name: 'total_notification'},
                        {data: 'total_players', name: 'total_players'},
                        {data: 'total_messageable_players', name: 'total_messageable_players'},
                    ],
                });
            }
        }

    })(_token);


});
