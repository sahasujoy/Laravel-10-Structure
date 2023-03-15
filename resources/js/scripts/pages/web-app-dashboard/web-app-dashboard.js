/*=========================================================================================
    File Name: web-app-dashboard.js
    Description: web-app dashboard analytic report
==========================================================================================*/

$(function () {
    'use strict';

    (function () {

        let adminWebAppDashboard = {};
        adminWebAppDashboard.getAppDashboardGraphData = getAppDashboardGraphData;
        adminWebAppDashboard.setDifferenceDifferenceType = setDifferenceDifferenceType;
        adminWebAppDashboard.getStateCountReport = getStateCountReport;

        /*====== Date range picker document id  ======*/
        adminWebAppDashboard.rangePickr = $('.flatpickr-range');
        adminWebAppDashboard.totalSubscription = $('.total_subscription');
        adminWebAppDashboard.totalActiveSubscription = $('.total_active_subscription');
        adminWebAppDashboard.totalNotification = $('.total_notification');

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
            Action : call getAppDashboardGraphData function
            Parameters : fromDate, toDate, dayDifference, durationType
        ==========================================================================================*/
        adminWebAppDashboard.getAppDashboardGraphData(dateVariables.fromDate, dateVariables.toDate, dateVariables.dayDifference, dateVariables.durationType);
        adminWebAppDashboard.getStateCountReport(dateVariables.fromDate, dateVariables.toDate, dateVariables.dayDifference, dateVariables.durationType);

        /*====== Range Date picker event fire for date filter ======*/
        if (adminWebAppDashboard.rangePickr.length) {
            adminWebAppDashboard.rangePickr.flatpickr({
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

                    dateVariables.dayDifference = difference;

                    adminWebAppDashboard.setDifferenceDifferenceType(dateStart, dateEnd, difference)
                    adminWebAppDashboard.getAppDashboardGraphData(dateVariables.fromDate, dateVariables.toDate, dateVariables.dayDifference, dateVariables.durationType);
                    // adminWebAppDashboard.getStateCountReport(dateVariables.fromDate, dateVariables.toDate, dateVariables.dayDifference, dateVariables.durationType);
                }
            });
        }

        /*=========================================================================================
            Action : Set Day Difference And Duration Type based on date picker data
            Parameters : from_date, to_date, difference
        ==========================================================================================*/
        function setDifferenceDifferenceType(from_date, to_date, difference) {
            console.log(from_date, to_date, difference,'from_date, to_date, difference')
            dateVariables.fromDate = from_date
            dateVariables.toDate = to_date

            console.log(typeof(difference),'typeof difference')

            if (difference < 7) {
                dateVariables.durationType = 'week'
            } else if (difference > 7 ) {
                dateVariables.durationType = 'month'
            } else if (difference > 365) {
                dateVariables.durationType = 'year'
            }
        }

        /*=========================================================================================
            Action : Get app wise Graph report Data by ajax call and render graph chart
            Parameters : fromDate, toDate, dayDifference, durationType
        ==========================================================================================*/
        function getAppDashboardGraphData(fromDate, toDate, dayDifference, durationType) {
            let data = {
                from_date: fromDate,
                to_date: toDate,
                difference: dayDifference,
                duration_type: durationType,
                web_app_id: $('.app_id').val()
            };

            let ajaxResponse = $.makeAjaxRequest('admin.app-dashboard-get-graph-data-report', 'POST', data);

            if (ajaxResponse) {

                let graphChartParams = {
                    seriesNameOne: "Total subscription",
                    seriesNameTwo: "Total active subscription",
                    totalSubscription: ajaxResponse?.data?.total_players,
                    totalActiveSubscription: ajaxResponse?.data?.total_messageable_players,
                    dateFrame: ajaxResponse?.data?.date_format,
                    // $graphChart: document.querySelector('#app-dashboard-chart'),
                    $graphChart: "#app-dashboard-chart",
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
                web_app_id: $('.app_id').val()
            };

            let ajaxResponse = $.makeAjaxRequest('admin.app-dashboard-get-state-count-data', 'GET', data);

            if (ajaxResponse) {
                adminWebAppDashboard.totalSubscription.html(ajaxResponse.data?.subscriptions);
                adminWebAppDashboard.totalActiveSubscription.html(ajaxResponse.data?.activeSubscriptions);
            }
        }

    })();

});
