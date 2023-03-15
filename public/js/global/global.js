"use strict";

let globalObjectVariables = {
    graphChartOption: {},
    graphChart: {},
}

$.extend({
    globalConstant: {
        success: 200,
        unAuthienticate: 401
    }
})

/*=========================================================================================
    Action : Make Ajax Request
    Description: Different types of ajax call
==========================================================================================*/
$.extend({
    makeAjaxRequest: function (url, method, data = null) {
        let form = this;
        var result = null;

        $.ajax({
            type: method,
            url: route(url),
            async: false,
            dataType: "json",
            data: data,
            beforeSend: function () {
                $(form).find('span.error-text').text('');
            },
            success: function (data) {
                result = successFunction(data)
            },
            error: function (errors) {
                errorFunction(errors)
            },
            complete: function () {
            },
            statusCode: {
                500: function () {
                    // Server error
                },
                422: function (response) {
                    $.showServerSideValidation(response.responseJSON.errors)
                }
            }
        });

        return result;
    }
});

function successFunction(data) {
    return data;
}

function errorFunction(errors) {
    return errors;
}

/*=========================================================================================
    Action : Render graph chart
    Description: Render a graph dynamically based on graphChartParams
    Parameters : Object : graphChartParams  Values : ( totalImage , cleanImage, dateFrame,$graphStrokeColor2,$strokeColor,$textMutedColor,$graphChart)
==========================================================================================*/
$.extend({
    initiateRenderChart: function (graphChartParams) {

        let $graphChartClassName = document.querySelector(graphChartParams.$graphChart)

        if ($graphChartClassName.hasChildNodes()) {
            globalObjectVariables.graphChart.destroy()
        }

        renderChart(
            graphChartParams.totalSubscription,
            graphChartParams.totalActiveSubscription,
            graphChartParams.dateFrame,
            $graphChartClassName,
            graphChartParams.seriesNameOne,
            graphChartParams.seriesNameTwo
        )
    },
    initiateRenderDonutChart: function (doughnutChartExClassName, labelsNames, chartData) {
        // let doughnutChartEx = $('.doughnut-chart-ex');
        let doughnutChartEx = doughnutChartExClassName;
        let tooltipShadow = 'rgba(0, 0, 0, 0.25)';
        let successColorShade = '#097969';
        let warningLightColor = '#FF0000';

        let labels = labelsNames;
        let data = chartData;

        renderDonutChart(
            doughnutChartEx,
            tooltipShadow,
            successColorShade,
            warningLightColor,
            labels,
            data
        )
    }
});


function renderChart(totalCountOne, totalCountTwo, dateFrame, $graphChartClassName, seriesNameOne, seriesNameTwo) {

    let graphChartConfigParams = {
        $graphStrokeColor2: '#d0ccff',
        $strokeColor: '#ebe9f1',
        $textMutedColor: '#b9b9c3',
        $graphChart: $graphChartClassName,
    }

    globalObjectVariables.graphChartOption = {
        chart: {
            height: 240,
            toolbar: {show: false},
            zoom: {enabled: false},
            type: 'line',
            offsetX: -10
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            dashArray: [0, 12],
            width: [4, 3]
        },
        grid: {
            xaxis: {
                lines: {
                    show: false
                }
            }
        },
        legend: {
            show: true,
            position: 'top',
            horizontalAlign: 'start'
        },
        colors: [graphChartConfigParams.$graphStrokeColor2, graphChartConfigParams.$strokeColor],
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                inverseColors: false,
                gradientToColors: [window.colors.solid.primary, graphChartConfigParams.$strokeColor],
                shadeIntensity: 1,
                type: 'horizontal',
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100, 100, 100]
            }
        },
        markers: {
            size: 0,
            hover: {
                size: 5
            }
        },
        xaxis: {
            labels: {
                style: {
                    colors: graphChartConfigParams.$strokeColor,
                    fontSize: '1rem'
                }
            },
            axisTicks: {
                show: false
            },

            categories: dateFrame,
            axisBorder: {
                show: false
            },
            tickPlacement: 'on'
        },
        yaxis: {
            tickAmount: 5,
            labels: {
                style: {
                    colors: graphChartConfigParams.$textMutedColor,
                    fontSize: '1rem'
                },
                formatter: function (val) {
                    return val > 999 ? (val / 1000).toFixed(0) + 'k' : val;
                }
            }
        },
        tooltip: {
            x: {show: false}
        },

        series: [
            {
                name: seriesNameOne,
                data: totalCountOne
            },
            {
                name: seriesNameTwo,
                data: totalCountTwo
            }
        ]
    };
    globalObjectVariables.graphChart = new ApexCharts($graphChartClassName, globalObjectVariables.graphChartOption);
    globalObjectVariables.graphChart.render();
};

function renderDonutChart(
    doughnutChartEx,
    tooltipShadow,
    successColorShade,
    warningLightColor,
    labels,
    data) {

    var chartWrapper = $('.chartjs');
    // Wrap charts with div of height according to their data-height
    if (chartWrapper.length) {
        chartWrapper.each(function () {
            $(this).wrap($('<div style="height:' + this.getAttribute('data-height') + 'px"></div>'));
        });
    }

    // Doughnut Chart
    // --------------------------------------------------------------------
    var doughnutExample = new Chart(doughnutChartEx, {
        type: 'doughnut',
        options: {
            responsive: true,
            maintainAspectRatio: false,
            responsiveAnimationDuration: 500,
            cutoutPercentage: 60,
            legend: {display: false},
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        var label = data.datasets[0].labels[tooltipItem.index] || '',
                            value = data.datasets[0].data[tooltipItem.index];
                        var output = ' ' + label + ' : ' + value;
                        return output;
                    }
                },
                // Updated default tooltip UI
                shadowOffsetX: 1,
                shadowOffsetY: 1,
                shadowBlur: 8,
                shadowColor: tooltipShadow,
                backgroundColor: window.colors.solid.white,
                titleFontColor: window.colors.solid.black,
                bodyFontColor: window.colors.solid.black
            }
        },
        data: {
            datasets: [
                {
                    labels: labels,
                    data: data,
                    backgroundColor: [successColorShade, warningLightColor, window.colors.solid.primary],
                    borderWidth: 0,
                    pointStyle: 'rectRounded'
                }
            ]
        }
    });
}


/*=========================================================================================
    Action : Alert message ( Sweet alert )
    Description: Show alert messages functions
    Parameters : title
==========================================================================================*/
$.extend({
    showSuccessAlert: function (title) {
        Swal.fire({
            position: 'bottom-end',
            icon: 'success',
            title: title,
            showConfirmButton: false,
            timer: 3000,
            customClass: {
                confirmButton: 'btn btn-primary'
            },
            buttonsStyling: false
        });
    },
    showErrorAlert: function (title) {
        Swal.fire({
            position: 'bottom-end',
            icon: 'error',
            title: title,
            showConfirmButton: false,
            timer: 7000,
            customClass: {
                confirmButton: 'btn btn-primary'
            },
            buttonsStyling: false,
            showCloseButton: true,
        });
    },
    showWarningAlert: function (title) {
        Swal.fire({
            position: 'bottom-end',
            icon: 'warning',
            title: title,
            showConfirmButton: false,
            timer: 3000,
            customClass: {
                confirmButton: 'btn btn-primary'
            },
            buttonsStyling: false
        });
    }
});

/*=========================================================================================
    Action : Toaster
    Description: Show alert messages using toaster functions
    Parameters : title
==========================================================================================*/
$.extend({
    showSuccessToaster: function (title, description) {
        toastr['success'](description, title, {
            closeButton: true,
            tapToDismiss: false,
            progressBar: true,
            ltl: false
        });
    },
    showErrorToaster: function (title, description) {
        toastr['error'](description, title, {
            closeButton: true,
            tapToDismiss: false,
            progressBar: false,
            ltl: false
        });
    },
    showWarningToaster: function (title, description) {
        toastr['warning'](description, title, {
            closeButton: true,
            tapToDismiss: false,
            progressBar: true,
            ltl: false
        });
    }
});

/*=========================================================================================
    Action : Server side validation
    Description: Show server side validation message in form input
    Parameters : errorMessages
==========================================================================================*/
$.extend({
    showServerSideValidation: function (errorMessages, _err = "_err") {
        $.each(errorMessages, function (key, val) {
            $('.' + key + _err).text(val[0]);
        })
    },
});

$.extend({
    validURL: function (str) {
        let pattern = new RegExp('^(https?:\\/\\/)?' + // protocol
            '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|' + // domain name
            '((\\d{1,3}\\.){3}\\d{1,3}))' + // OR ip (v4) address
            '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // port and path
            '(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
            '(\\#[-a-z\\d_]*)?$', 'i'); // fragment locator
        return !!pattern.test(str);
    },
});

// Add Jquery Custom Validation Here
jQuery.validator.addMethod("specialChars", function( value, element ) {
    var r = /^(?=.{1,50}$)[^\W_]+(?: [^\W_]+)*$/

    if (!r.test(value)) {
        return false;
    }
    return true;
}, "Please use only alphanumeric or alphabetic characters");

jQuery.validator.addMethod("emailSpecialChars", function( value, element ) {
    // var regex = /^[a-zA-Z0-9]+(?:[._-][a-zA-Z0-9]+)*@[a-zA-Z0-9]+\.[a-zA-Z]{2,}$/;

    var regex = /^[a-zA-Z0-9]+(?:[._-][a-zA-Z0-9]+)*@[a-zA-Z0-9]+\.[a-zA-Z]{2,}$/;


    if (!regex.test(value)) {
        return false;
    }
    return true;
}, "Sorry, only small letter a to z, numbers (0-9), and terminating punctuation marks (.) are allowed.The first character of your email must be an ascii letter (az) or number (0-9).");

jQuery.validator.addMethod("emailFirstCharacterValidate", function( value, element ) {
    // var regex = /^[a-zA-Z0-9]+(?:[._-][a-zA-Z0-9]+)*@[a-zA-Z0-9]+\.[a-zA-Z]{2,}$/;


    // let regex = /^([0-9a-zA-Z]+[-._+&amp;])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}$/;

    let regex = /^([0-9a-zA-Z]+[-._+&amp;])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}$/;


    if (!regex.test(value)) {
        return false;
    }
    return true;
}, "Sorry, only letters (az), numbers (0-9), and consecutive periods (.) are allowed.");

jQuery.validator.addMethod("emailFirstCharacterAlpha", function( value, element ) {
    let regex = /^[a-z.]/;

    if (!regex.test(value)) {
        return false;
    }
    return true;
}, "Sorry, Email address should not be starting with capital letter");

jQuery.validator.addMethod("specialCharsEmail", function( value, element ) {
    // var r = /^(?=.{1,50}$)[^\W_]+(?: [^\W_]+)*$/
    // var r = /^[^!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/\?][^!@$%^*+=\[\]{};:\\|<>\?]*$/;
    var r = /^[a-z0-9]/;

    if (!r.test(value)) {
        return false;
    }
    return true;
}, "First letter should not be special characters");

