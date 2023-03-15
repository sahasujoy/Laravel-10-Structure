/*=========================================================================================
    File Name: user-dashboard.js
    Description: User dashboard analytic report
==========================================================================================*/

$(function () {
    'use strict';

    var _token = $('input[name="_token"]').val();

    (function (_token) {

        let dashboard = {};
        dashboard.getImageProcessGraphData = getImageProcessGraphData;
        dashboard.setDifferenceDifferenceType = setDifferenceDifferenceType;

        /*====== Date range picker document id  ======*/
        dashboard.rangePickr = $('.flatpickr-range');

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
        dashboard.getImageProcessGraphData(dateVariables.fromDate, dateVariables.toDate, dateVariables.dayDifference, dateVariables.durationType);

        /*====== Range Date picker event fire for date filter ======*/
        if (dashboard.rangePickr.length) {
            dashboard.rangePickr.flatpickr({
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

                    dashboard.setDifferenceDifferenceType(dateStart, dateEnd, difference)
                    dashboard.getImageProcessGraphData(dateVariables.fromDate, dateVariables.toDate, dateVariables.dayDifference, dateVariables.durationType);
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
          Return statement should be used when need to re-use code another module.Otherwise, it is not mandatory.
        ==========================================================================================*/
        // return {
        //     dashboard
        // }

    })(_token);


});
