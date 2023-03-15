$(function () {
    'use strict';

    (function () {

        let segment = {}
        let segmentModal = $(".segment");

        segment.DataTable = $('.segment-table');

        if (segment.DataTable.length) {
            segment.DataTable.DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: route('segment-list'),
                    type: 'post',
                    data: {
                        app_id: app_id,
                    },
                },
                columns: [
                    // columns according to JSON
                    // 'message', 'status', 'delivered'
                    {data: 'name', name: 'name', orderable: false, "visible": true, width: "20%"},
                    {data: 'filters', name: 'filters', orderable: false, "visible": true, width: "40%"},
                    {data: 'action', name: 'action', orderable: false, "visible": true, width: "10%"},
                ],

                autoWidth: true
            });
        }


        segment.DataTable.on('click', '.delete-segment', function () {
            let data_id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete this segment!',
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
                        id: data_id,
                    };
                    let response = $.makeAjaxRequest('segment-delete-by-id', "POST", data)

                    if (response.status === $.Response.HTTP_OK) {
                        segment.DataTable.DataTable().ajax.reload(null, false);
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

        /*====== Initially hide segment list  ======*/
        let segmentList = $('.segment_section');
        segmentList.hide();

        /*====== Conditionally show or hide segment list  ======*/

        $('input[type=radio][name=audience]').change(function () {
            if (this.value === "subscribers") {
                segmentList.hide();

            } else if (this.value === "particular_segment") {
                segmentList.show();
            }
        });

        /*====== Start: Modal popup for new segment create  ======*/
        $(".create_segment").on('click', function () {
            let response = $.makeAjaxRequest('get-segment-modal-form', "GET")

            segmentModal.modal('show')
            segmentModal.find('.segment-filter-input').html(response.html);
        });
        /*====== End: Modal popup for new segment create  ======*/

        /*====== Start: Toggle filter options menu  ======*/
        let addFilterButton = $(".add_filter")

        $(addFilterButton).on('click', function () {
            let filterAddSection = $(".filter_add_section")
            let filterOptionsSection = $(".filter_options_section")

            filterAddSection.removeClass('d-block').addClass('d-none')
            filterOptionsSection.addClass('d-block').removeClass('d-none')
        })

        let closeFilterOptionsButton = $(".close_filter_options")

        $(closeFilterOptionsButton).on('click', function () {
            let filterAddSection = $(".filter_add_section")
            let filterOptionsSection = $(".filter_options_section")

            filterAddSection.addClass('d-block').removeClass('d-none')
            filterOptionsSection.removeClass('d-block').addClass('d-none')
        })

        /*====== Append filter input  ======*/
        function segmentFilterAppend(filterValue) {
            let data = {
                segment_filter: filterValue
            }

            let response = $.makeAjaxRequest('get-segment-filter', "GET", data);
            $(".segment_filter_input").append(response.data)
        }

        $('#first_session_filter_menu').click(function () {
            let filter_id = $(this).data('id');

            if (filter_id == 1) {
                if ($('.segment_filter_input').find('.first_session').length !== 0) {
                    $.showErrorAlert("First session already selected")
                } else {
                    segmentFilterAppend(filter_id)
                }
            }

        });

        $('#last_session_filter_menu').click(function () {
            let filter_id = $(this).data('id');

            if (filter_id == 2) {
                if ($('.segment_filter_input').find('.last_session').length !== 0) {
                    $.showErrorAlert("Last session already selected")
                } else {
                    segmentFilterAppend(filter_id)
                }
            }
        });

        $('#session_filter_menu').click(function () {
            let filter_id = $(this).data('id');

            if (filter_id == 3) {
                if ($('.segment_filter_input').find('.session').length !== 0) {
                    $.showErrorAlert("Session already selected")
                } else {
                    segmentFilterAppend(filter_id)
                }
            }
        });

        $('#country_filter_menu').click(function () {
            let filter_id = $(this).data('id');

            if (filter_id == 4) {
                if ($('.segment_filter_input').find('.country').length !== 0) {
                    $.showErrorAlert("Country already selected")
                } else {
                    segmentFilterAppend(filter_id)
                }
            }
        });

        /*====== End: Toggle filter options menu  ======*/

        /*======Start: Remove input filed  ======*/
        $(document).on('click', '#remove_first_session', function () {
            $(".first_session").remove();
        })

        $(document).on('click', '#remove_last_session', function () {
            $(".last_session").remove();
        })

        $(document).on('click', '#remove_session', function () {
            $(".session").remove();
        })

        $(document).on('click', '#remove_country', function () {
            $(".country").remove();
        })
        /*======Start: Remove input filed  ======*/

        /*======Start: Segment form submit  ======*/
        let segmentForm = $(".segment_form");
        let createSegmentButton = $(".create_segment_button");
        let editSegmentButton = $(".edit_segment_button");

        if (segmentForm.length) {
            segmentForm.validate({
                errorClass: 'error',
                rules: {
                    'segment_name': {
                        required: true
                    },
                    'first_session_value': {
                        required: true
                    },
                    'last_session_value': {
                        required: true
                    },
                    'session_value': {
                        required: true
                    },
                },
            });

            let segmentArray = [];

            /*====== Segment form submit  ======*/
            function prepareSegmentData(segmentData) {
                segmentArray = []

                let firstSessionObj = {
                    field: "first_session",
                    relation: "",
                    hours_ago: "",
                }

                let lastSessionObj = {
                    field: "last_session",
                    relation: "",
                    hours_ago: "",
                }

                let sessionObj = {
                    field: "session_count",
                    relation: "",
                    value: "",
                }

                $.each(segmentData, function (index, data) {

                    if (data.name === 'first_session_relation') {
                        firstSessionObj.relation = data.value;
                    }

                    if (data.name === 'first_session_value') {
                        firstSessionObj.hours_ago = data.value;
                        segmentArray.push(firstSessionObj);
                    }

                    if (data.name === 'last_session_relation') {
                        lastSessionObj.relation = data.value;
                    }

                    if (data.name === 'last_session_value') {
                        lastSessionObj.hours_ago = data.value;
                        segmentArray.push(lastSessionObj);
                    }

                    if (data.name === 'session_relation') {
                        sessionObj.relation = data.value;
                    }

                    if (data.name === 'session_value') {
                        sessionObj.value = data.value;
                        segmentArray.push(sessionObj);
                    }
                })
            }

            if (createSegmentButton.length) {
                createSegmentButton.on('click', function (e) {
                    e.preventDefault();
                    let form = $(".form");
                    let isValid = segmentForm.valid();

                    if (isValid) {
                        // add button loader
                        buttonLoaderShow('button-submit', 'button-loader');
                        setTimeout(function () {
                            let segmentData = segmentForm.serializeArray()
                            prepareSegmentData(segmentData)
                            let filters = JSON.stringify(segmentArray)

                            let data = {
                                'app_id': app_id,
                                'segment_name': $(".segment_name").val(),
                                'filters': filters,
                            }
                            let response = $.makeAjaxRequest('create-segment', "POST", data)

                            if (response.status === $.Response.HTTP_CREATED) {
                                // Reset all form input value
                                $(form)[0].reset();
                                segmentModal.modal('hide');
                                $.showSuccessAlert(response.message)
                                segment.DataTable.DataTable().ajax.reload(null, false);
                            } else if (response.status === 0) {
                                $.showServerSideValidation(response.error, '_err')
                            } else {
                                $.showSuccessAlert(response.message)
                            }
                            // add button loader
                            buttonLoaderHide('button-submit', 'button-loader');

                        }, 2000);
                    }
                });
            }

            if (editSegmentButton.length) {
                editSegmentButton.on('click', function (e) {
                    e.preventDefault();

                    let form = $(".form");
                    let isValid = segmentForm.valid();

                    if (isValid) {
                        // add button loader
                        buttonLoaderShow('button-submit', 'button-loader');
                        setTimeout(function () {
                            let segmentData = segmentForm.serializeArray()
                            prepareSegmentData(segmentData)
                            let filters = JSON.stringify(segmentArray)

                            let data = {
                                'app_id': app_id,
                                'id': $("#segment_id").val(),
                                'segment_name': $(".segment_name").val(),
                                'filters': filters,
                            }

                            let response = $.makeAjaxRequest('segment-update', "POST", data)

                            if (response.status === $.Response.HTTP_OK) {
                                // Reset all form input value
                                $(form)[0].reset();
                                segmentModal.modal('hide');
                                $.showSuccessAlert(response.message)
                                segment.DataTable.DataTable().ajax.reload(null, false);
                            } else if (response.status === 0) {
                                $.showServerSideValidation(response.error, '_err')
                            } else {
                                $.showSuccessAlert(response.message)
                            }
                            // add button loader
                            buttonLoaderHide('button-submit', 'button-loader');

                        }, 2000);
                    }
                });
            }

        }
        /*====== End: Segment form submit  ======*/

        /*====== Start: Modal popup for edit segment  ======*/

        segment.DataTable.on('click', '.edit-segment', function () {
            let data_id = $(this).data('id');

            let response = $.makeAjaxRequest('get-segment-modal-form', "GET")

            segmentModal.modal('show')
            segmentModal.find('.segment-filter-input').html(response.html);
            segmentModal.find('.create_segment_button').remove()
            segmentModal.find('.edit_segment_button').removeClass('d-none')
            segmentModal.find('#segment_id').val(data_id)

            let data = {id: data_id}
            let segmentData = $.makeAjaxRequest('get-specific-segment-data', "GET",data)
            console.log(segmentData,"segmentData")
            if (segmentData.data) {

                segmentModal.find('.segment_name').val(segmentData.data.name);
                segmentModal.find('.segment_filter_input').html(segmentData.data.edit_input);
            }

        });
        /*====== End: Modal popup for edit segment  ======*/

    })();

});
