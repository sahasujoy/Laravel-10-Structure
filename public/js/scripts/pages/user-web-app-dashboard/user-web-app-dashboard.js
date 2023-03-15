/*=========================================================================================
    File Name: web-app-dashboard.js
    Description: web-app dashboard analytic report
==========================================================================================*/

$(function () {
    'use strict';

    (function () {

        let userWebAppDashboard = {};
        userWebAppDashboard.getAppDashboardGraphData = getAppDashboardGraphData;
        userWebAppDashboard.setDifferenceDifferenceType = setDifferenceDifferenceType;
        userWebAppDashboard.getStateCountReport = getStateCountReport;

        /*====== Date range picker document id  ======*/
        userWebAppDashboard.rangePickr = $('.flatpickr-range');
        userWebAppDashboard.totalSubscription = $('.total_subscription');
        userWebAppDashboard.totalActiveSubscription = $('.total_active_subscription');
        userWebAppDashboard.totalNotification = $('.total_notification');

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
        userWebAppDashboard.getAppDashboardGraphData(dateVariables.fromDate, dateVariables.toDate, dateVariables.dayDifference, dateVariables.durationType);
        userWebAppDashboard.getStateCountReport(dateVariables.fromDate, dateVariables.toDate, dateVariables.dayDifference, dateVariables.durationType);

        /*====== Range Date picker event fire for date filter ======*/
        if (userWebAppDashboard.rangePickr.length) {
            userWebAppDashboard.rangePickr.flatpickr({
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

                    userWebAppDashboard.setDifferenceDifferenceType(dateStart, dateEnd, difference)
                    userWebAppDashboard.getAppDashboardGraphData(dateVariables.fromDate, dateVariables.toDate, dateVariables.dayDifference, dateVariables.durationType);
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

            let ajaxResponse = $.makeAjaxRequest('user.app-dashboard-get-graph-data-report', 'POST', data);

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

            let ajaxResponse = $.makeAjaxRequest('user.app-dashboard-get-state-count-data', 'GET', data);

            if (ajaxResponse) {
                userWebAppDashboard.totalSubscription.html(ajaxResponse.data?.subscriptions);
                userWebAppDashboard.totalActiveSubscription.html(ajaxResponse.data?.activeSubscriptions);
            }
        }

    })();

});
