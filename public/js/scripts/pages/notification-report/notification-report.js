/*=========================================================================================
    File Name: web-app-dashboard.js
    Description: web-app dashboard analytic report
==========================================================================================*/

$(function () {
    'use strict';

    (function () {

        let notificationReport = {};
        notificationReport.setDifferenceDifferenceType = setDifferenceDifferenceType;
        notificationReport.getStateCountReport = getStateCountReport;

        /*====== Stat count document id  ======*/
        notificationReport.rangePickr = $('.flatpickr-range');
        notificationReport.totalSent = $('.total_sent');
        notificationReport.totalDelivery = $('.total_delivery');
        notificationReport.totalFailed = $('.total_failed');
        notificationReport.totalFailedUnsubscribed = $('.total_failed_unsubscribed');
        notificationReport.totalFailedErrored = $('.total_failed_errored');
        notificationReport.totalRemaining = $('.total_remaining');

        notificationReport.webPushChrome = $('.chrome');
        notificationReport.webPushSafari = $('.safari');
        notificationReport.webPushFirefox = $('.firefox');

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
        notificationReport.getStateCountReport(dateVariables.fromDate, dateVariables.toDate, dateVariables.dayDifference, dateVariables.durationType);

        /*====== Range Date picker event fire for date filter ======*/
        if (notificationReport.rangePickr.length) {
            notificationReport.rangePickr.flatpickr({
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

                    notificationReport.setDifferenceDifferenceType(dateStart, dateEnd, difference)
                    notificationReport.getStateCountReport(dateVariables.fromDate, dateVariables.toDate, dateVariables.dayDifference, dateVariables.durationType);
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

        function percentage(partialValue, totalValue) {
            return (100 * partialValue) / totalValue;
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
                web_app_id: app_id,
                notification_id: notification_id
            };

            let ajaxResponse = $.makeAjaxRequest('user.notification-report-get-state-count-data', 'GET', data);

            if (ajaxResponse) {
                console.log(ajaxResponse.data.platform_delivery_stats?.firefox_web_push.successful,'jjj')
                // Delivery statistic report
                notificationReport.totalSent.html(ajaxResponse.data?.successful + ajaxResponse.data?.failed);
                notificationReport.totalDelivery.html(ajaxResponse.data?.successful);
                notificationReport.totalFailed.html(ajaxResponse.data?.failed);
                notificationReport.totalFailedUnsubscribed.html(ajaxResponse.data?.failed);
                notificationReport.totalFailedErrored.html(ajaxResponse.data?.errored);
                notificationReport.totalRemaining.html(ajaxResponse.data?.remaining);

                let deliveryChart = $('.deliveryChart')
                let platformChart = $('.platform-chart')
                let deliveryStatisticLabelsNames = ['Delivery', 'Failed'];
                let deliveryStatisticChartData = [ajaxResponse.data?.successful, ajaxResponse.data?.failed];
                $.initiateRenderDonutChart(deliveryChart, deliveryStatisticLabelsNames, deliveryStatisticChartData);

                // Platform statistic report
                let platformStatisticLabelsNames = ['Chrome', 'Safari', 'Firefox'];
                let platformChartData = [0, 0, 0];
                notificationReport.webPushChrome.html(ajaxResponse.data.platform_delivery_stats.length === 0 ? 0 : 0);
                notificationReport.webPushSafari.html(ajaxResponse.data.platform_delivery_stats.length === 0 ? 0 : 0);
                notificationReport.webPushFirefox.html(ajaxResponse.data.platform_delivery_stats.length === 0 ? 0 : 0);
                $.initiateRenderDonutChart(platformChart, platformStatisticLabelsNames, platformChartData);

            }
        }


    })();

});
