$(function () {
    'use strict';

    (function () {

        console.log("=======================99999999999999999999999==========================")
        let userManage = {};
        userManage.userDataTable = $('.user-list-table');
        userManage.newUserModal = $('.new-user-modal');
        userManage.newUserForm = $('.add-new-user');
        userManage.editUserModal = $('.edit-user-modal');
        userManage.editUserForm = $('.edit-user-form');
        userManage.changePasswordModal = $('.change-password-modal');
        userManage.changePasswordForm = $('.change-password-form');
        userManage.limitAllocationModal = $('.limit-allocation-modal');
        userManage.limitAllocationForm = $('.limit-allocation-form');

        let taskManage = {};
        taskManage.newTaskForm = $('.add-new-task');
        taskManage.newTaskModal = $('.new-task-modal');
        taskManage.taskDataTable = $('.task-list-table');

        var isRtl = $('html').attr('data-textdirection') === 'rtl';

        var assetPath = '../../../app-assets/';

        if ($('body').attr('data-framework') === 'laravel') {
            assetPath = $('body').attr('data-asset-path');
        }

        // Users List datatable
        if (userManage.userDataTable.length) {
            userManage.userDataTable.DataTable({
                processing: true,
                serverSide: true,
                // ajax: assetPath + 'data/user-list.json', // JSON file to add data
                ajax: route('admin-user-list'),
                columns: [
                    // columns according to JSON
                    {data: 'user_info', name: 'user_info', "visible": true, width: "80%"},
                    {data: 'action', name: 'action', "visible": true, width: "20%"},
                    {data: 'type', "visible": false},
                    {data: 'status', "visible": false},
                    {data: 'email', "visible": false},
                    {data: 'first_name', "visible": false},
                    {data: 'last_name', "visible": false},
                    {data: 'phone', "visible": false},

                ],
                columnDefs: [],
                order: [[1, 'desc']],
                dom:
                    '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
                    '<"col-lg-12 col-xl-6" l>' +
                    '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
                    '>t' +
                    '<"d-flex justify-content-between mx-2 row mb-1"' +
                    '<"col-sm-12 col-md-6"i>' +
                    '<"col-sm-12 col-md-6"p>' +
                    '>',

                // Buttons with Dropdown
                buttons: [
                    {
                        text: 'Add New User',
                        className: 'add-new-btn btn btn-primary mt-50',

                        init: function (api, node, config) {
                            $(node).removeClass('btn-secondary');
                        }
                    }
                ],
                language: {
                    paginate: {
                        // remove previous & next text from pagination
                        previous: '&nbsp;',
                        next: '&nbsp;'
                    }
                },
                initComplete: function () {

                    // Adding type filter once table initialized
                    this.api()
                        .columns(2)
                        .every(function () {
                            var column = this;
                            var select = $(
                                '<select id="FilterTransaction" class="form-control text-capitalize mb-md-0 mb-2xx">' +
                                '<option value=""> Select Type </option>' +
                                '<option value="1"> Default </option>' +
                                '<option value="2"> Registration </option>' +
                                '</select>'
                            )
                                .appendTo('.user_type')
                                .on('change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                    // var val = 2;
                                    column.search(val ? '^' + val + '$' : '', true, false).draw();
                                });

                            column
                                .data()
                                .unique()
                                .sort();
                        });
                    // // Adding status filter once table initialized
                    this.api()
                        .columns(3)
                        .every(function () {
                            var column = this;
                            var select = $(
                                '<select id="FilterTransaction" class="form-control text-capitalize mb-md-0 mb-2xx">' +
                                '<option value=""> Select Status </option>' +
                                '<option value="1"> Active </option>' +
                                '<option value="0"> Inactive </option>' +
                                // '<option value="3"> Pending </option>' +
                                '</select>'
                            )
                                .appendTo('.user_status')
                                .on('change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                    // var val = 2;
                                    column.search(val ? '^' + val + '$' : '', true, false).draw();
                                });

                            column
                                .data()
                                .unique()
                                .sort()
                        });
                },
                autoWidth: true
            });
        }

        userManage.addNewUser = $('.add-new-btn');

        // Form Validation and submit form for create new user
        if (userManage.newUserForm.length) {
            userManage.newUserForm.validate({
                errorClass: 'error',
                rules: {
                    'first_name': {
                        required: true
                    },
                    'email': {
                        required: true,
                        specialCharsEmail : true,
                        emailFirstCharacterAlpha : true,
                        emailFirstCharacterValidate : true,
                    },
                    'password': {
                        required: true,
                        minlength: 6,
                    },
                    'apps_limit': {
                        required: true,
                        min: 1,
                        number: true,
                    },
                    'monthly_limit': {
                        required: true,
                        min: 1,
                        number: true,
                    }
                },
                messages: {
                    first_name: "Enter your firstname.",
                    email: {
                        required: "Enter a email.",
                        email: "Enter a valid email."
                    },
                    password: {
                        required: "Enter a password",
                        minlength: "The password must be at least 6 characters."
                    },
                    apps_limit: {
                        required: "Enter a apps limit ",
                        min: "The apps limit must be at least 1 number.",
                        number: "The apps limit must be a number."
                    },
                    monthly_limit: {
                        required: "Enter a monthly limit ",
                        min: "The monthly limit must be at least 1 number.",
                        number: "The apps limit must be a number."
                    },
                },
                errorPlacement: function (error, element) {
                    var name = $(element).attr("name");
                    $("." + name + "_err_for_add").html("")
                    error.appendTo($("." + name + "_err_for_add"));
                },
            });

            // Change add/edit form
            userManage.addNewUser.on('click', function () {
                $('#user_id').val(''); // hidden input value from create form
                $('#newUserForm').trigger("reset"); // Reset all input form value
                $('#myModalLabel33').html('New User');
            });

            userManage.newUserForm.on('submit', function (e) {
                let isValid = userManage.newUserForm.valid();
                e.preventDefault();
                let form = this;

                if (isValid) {
                    // add button loader
                    buttonLoaderShow('button-submit', 'button-loader');
                    setTimeout(function () {
                        userManage.data = userManage.newUserForm.serialize();
                        let response = $.makeAjaxRequest('create-user', "POST", userManage.data)

                        if (response.status === $.Response.HTTP_CREATED) {
                            // Reset all form input value
                            $(form)[0].reset();
                            userManage.newUserModal.modal('hide'); // Hide modal
                            userManage.userDataTable.DataTable().ajax.reload(null, false);
                            $.showSuccessAlert(response.message)
                        } else if (response.status === 0) {
                            $.showServerSideValidation(response.error, '_err_for_add')
                        }else{
                            $.showSuccessAlert(response.message)
                        }
                        // add button loader
                        buttonLoaderHide('button-submit', 'button-loader');

                    }, 2000);


                }

            });
        }

        // Modal popup for new user create
        userManage.addNewUser.on('click', function () {
            userManage.newUserModal.find('form')[0].reset();
            userManage.newUserModal.find('span.error-text').text('');
            userManage.newUserModal.modal('show')
        });

        // Modal popup for update user information
        userManage.userDataTable.on('click', '#edit-user', function () {
            let user_id = $(this).data('id');

            userManage.editUserModal.find('form')[0].reset();
            userManage.editUserModal.find('span.error-text').text('');

            let data = {user_id: user_id};
            let response = $.makeAjaxRequest('specific-user-data', "GET", data)

            if (response.status === $.Response.HTTP_OK) {
                userManage.editUserModal.find('input[name="user_id"]').val(user_id);
                userManage.editUserModal.find('input[name="first_name"]').val(response.data.first_name);
                userManage.editUserModal.find('input[name="last_name"]').val(response.data.last_name);
                userManage.editUserModal.find('input[name="email"]').val(response.data.email);
                userManage.editUserModal.find('input[name="phone"]').val(response.data.phone);
                userManage.editUserModal.modal('show')
            }
        });

        // Form submit for update user information
        // Form Validation and submit form for create new user
        if (userManage.editUserForm.length) {
            userManage.editUserForm.validate({
                errorClass: 'error',
                rules: {
                    'first_name': {
                        required: true
                    },
                    'email': {
                        required: true,
                        email: true
                    },
                    'password': {
                        required: true,
                        minlength: 6,
                    }
                },
                messages: {
                    first_name: "Enter your firstname.",
                    email: {
                        required: "Enter a email.",
                        email: "Enter a valid email."
                    },
                    password: {
                        required: "Enter a password",
                        minlength: "The password must be at least 6 characters."
                    }
                },
                errorPlacement: function (error, element) {
                    var name = $(element).attr("name");
                    $("." + name + "_err").html("")
                    error.appendTo($("." + name + "_err"));
                },
            });
            userManage.editUserForm.on('submit', function (e) {
                e.preventDefault();
                let form = this;
                let isValid = userManage.editUserForm.valid();
                // add button loader
                buttonLoaderShow('button-submit', 'button-loader');

                if (isValid) {
                    setTimeout(function () {

                        let data = userManage.editUserForm.serialize();
                        let response = $.makeAjaxRequest('update-user-data', "POST", data)

                        if (response.status === 0) {
                            $.showServerSideValidation(response.error)
                        }
                        if (response.status === $.Response.HTTP_OK) {
                            $(form)[0].reset();
                            userManage.editUserModal.modal('hide'); // Hide modal
                            userManage.userDataTable.DataTable().ajax.reload(null, false);
                            $.showSuccessAlert(response.message)
                        } else {
                            $.showSuccessAlert(response.message)
                        }
                        // add button loader
                        buttonLoaderHide('button-submit', 'button-loader');

                    }, 2000);
                }
            });
        }

        // Delete user confirm modal
        userManage.userDataTable.on('click', '#delete-user', function () {
            var user_id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ml-1'
                },
                buttonsStyling: false
            }).then(function (result) {

                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: route('delete-user'),
                        data: {
                            user_id: user_id
                        },
                        success: function (response) {

                            if (response.status === 200) {
                                $('.user-list-table').DataTable().ajax.reload(null, false);
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'User has been deleted.',
                                    customClass: {
                                        confirmButton: 'btn btn-success'
                                    }
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Delete failed!',
                                    text: '' +
                                        'Something went wrong.',
                                    customClass: {
                                        confirmButton: 'btn btn-error'
                                    }
                                });
                            }

                        },
                        error: function (err) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Delete failed!',
                                text: '' +
                                    'Something went wrong.',
                                customClass: {
                                    confirmButton: 'btn btn-error'
                                }
                            });
                        }
                    });
                }
            });
        });

        // Active user confirm modal
        userManage.userDataTable.on('click', '#active-user', function () {

            let user_id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "This user be able to login the panel!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, deactive this user!',
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
                        'user_id': user_id,
                        'status': 1
                    };
                    let response = $.makeAjaxRequest('admin.user-status', "POST", data)
                    if (response.status === $.Response.HTTP_OK) {
                        userManage.userDataTable.DataTable().ajax.reload(null, false);
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

        // Deactivate user confirm modal
        userManage.userDataTable.on('click', '#deactive-user', function () {
            let user_id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "This user wont be able to login the panel!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, deactive this user!',
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
                        'user_id': user_id,
                        'status': 0
                    };
                    let response = $.makeAjaxRequest('admin.user-status', "POST", data)
                    if (response.status === $.Response.HTTP_OK) {
                        if (response.status === 0) {
                            $.showServerSideValidation(response.error)
                        } else {
                            userManage.userDataTable.DataTable().ajax.reload(null, false);
                            $.showSuccessAlert(response.message)
                        }
                        // add button loader
                        buttonLoaderHide('button-submit', 'button-loader');
                    }
                }
            });
        });

        // Activate/Deactivate user confirm modal
        userManage.userDataTable.on('click', '#user-status', function () {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, activate it!',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ml-1'
                },
                buttonsStyling: false
            }).then(function (result) {

                if (result.value) {

                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        ajax: route('delete-user'),
                        success: function (data) {

                            Swal.fire({
                                icon: 'success',
                                title: 'Updated!',
                                text: 'User has been update.',
                                customClass: {
                                    confirmButton: 'btn btn-success'
                                }
                            });
                        },
                        error: function (err) {

                            Swal.fire({
                                icon: 'error',
                                title: 'Updated!',
                                text: 'User update failed.',
                                customClass: {
                                    confirmButton: 'btn btn-error'
                                }
                            });
                        }
                    });


                }
            });
        });

        // Modal popup for change user password
        userManage.userDataTable.on('click', '#change-user-password', function () {
            var user_id = $(this).data('id');

            userManage.changePasswordModal.find('form')[0].reset();
            userManage.changePasswordModal.find('span.error-text').text('');
            userManage.changePasswordModal.find('input[name="user_id"]').val(user_id);
            userManage.changePasswordModal.modal('show')
        });

        // Form Validation and submit form for change user password
        if (userManage.changePasswordForm.length) {
            userManage.changePasswordForm.validate({
                errorClass: 'error',
                rules: {
                    'password': {
                        required: true,
                        // minlength: 6,
                    },
                    'password_confirmation': {
                        required: true,
                        equalTo: '#password'
                    }
                },
                messages: {
                    password: {
                        required: "Enter a password",
                        // minlength: "The password must be at least 6 characters."
                    },
                    password_confirmation: {
                        required: "Enter a confirmation password",
                        equalTo: "The password does not match."
                    }
                },
                errorPlacement: function (error, element) {
                    var name = $(element).attr("name");
                    $("." + name + "_err").html("")
                    error.appendTo($("." + name + "_err"));
                },
            });

            userManage.changePasswordForm.on('submit', function (e) {
                let isValid = userManage.changePasswordForm.valid();
                e.preventDefault();
                let form = this;
                // add button loader
                buttonLoaderShow('button-submit', 'button-loader');

                setTimeout(function () {
                    if (isValid) {
                        userManage.changePasswordForm_data = $(".change-password-form").serialize();
                        let response = $.makeAjaxRequest('reset-user-password', "POST", userManage.changePasswordForm_data)

                        if (response.status === 0) {
                            $.showServerSideValidation(response.error)
                        }

                        if (response.status === $.Response.HTTP_OK) {
                            // Reset all form input value
                            $(form)[0].reset();
                            userManage.changePasswordModal.modal('hide'); // Hide modal
                            userManage.userDataTable.DataTable().ajax.reload(null, false);
                            $.showSuccessAlert(response.message)
                        }

                    }
                    // add button loader
                    buttonLoaderHide('button-submit', 'button-loader');
                }, 2000);
            });
        }

        // Modal popup for limit allocation
        userManage.userDataTable.on('click', '#limit-allocation', function () {
            var user_id = $(this).data('id');
            var appLimit = $(this).attr('data-app-limit');
            var monthlyNotificationLimit = $(this).attr('data-monthly-notification-limit');

            userManage.limitAllocationModal.find('form')[0].reset();
            userManage.limitAllocationModal.find('span.error-text').text('');

            $('#apps-limit').val(appLimit);
            $('#monthly-limit').val(monthlyNotificationLimit);

            userManage.limitAllocationModal.find('input[name="user_id"]').val(user_id);
            userManage.limitAllocationModal.modal('show')
        });

        // Form Validation and submit form for limit allocation
        if (userManage.limitAllocationForm.length) {
            userManage.limitAllocationForm.validate({
                errorClass: 'error',
                rules: {
                    'apps_limit': {
                        required: true,
                        min: 1,
                        number: true,
                    },
                    'monthly_limit': {
                        required: true,
                        min: 1,
                        number: true,
                    }
                },
                messages: {
                    apps_limit: {
                        required: "Enter a apps limit ",
                        min: "The apps limit must be at least 1 number.",
                        number: "The apps limit must be a number."
                    },
                    monthly_limit: {
                        required: "Enter a monthly limit ",
                        min: "The monthly limit must be at least 1 number.",
                        number: "The apps limit must be a number."
                    },
                },
                errorPlacement: function (error, element) {
                    var name = $(element).attr("name");
                    $("." + name + "_err").html("")
                    error.appendTo($("." + name + "_err"));
                },
            });

            userManage.limitAllocationForm.on('submit', function (e) {
                var isValid = userManage.limitAllocationForm.valid();
                e.preventDefault();
                var form = this;

                // add button loader
                buttonLoaderShow('button-submit', 'button-loader');

                setTimeout(function () {
                    if (isValid) {
                        userManage.changePasswordForm_data = userManage.limitAllocationForm.serialize();
                        let response = $.makeAjaxRequest('allocate-balance-limit', "POST", userManage.changePasswordForm_data)

                        if (response.status === 0) {
                            $.showServerSideValidation(response.error)
                        }

                        if (response.status === $.Response.HTTP_OK) {
                            // Reset all form input value
                            $(form)[0].reset();
                            userManage.limitAllocationModal.modal('hide'); // Hide modal
                            userManage.userDataTable.DataTable().ajax.reload(null, false);
                            $.showSuccessAlert(response.message)
                        }else{
                            $.showSuccessAlert(response.message)
                        }

                    }
                    // add button loader
                    buttonLoaderHide('button-submit', 'button-loader');
                }, 2000);
            });
        }

        // Task List datatable
        if (taskManage.taskDataTable.length) {
            taskManage.taskDataTable.DataTable({
                processing: true,
                serverSide: true,
                // ajax: assetPath + 'data/user-list.json', // JSON file to add data
                ajax: route('admin-task-list'),
                columns: [
                    // columns according to JSON
                    {data: 'task_info', name: 'task_info', "visible": true, width: "80%"},
                    {data: 'task_name', "visible": false},
                    {data: 'duration', "visible": false},
                    {data: 'status', "visible": false},

                ],
                columnDefs: [],
                order: [[1, 'desc']],
                dom:
                    '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
                    '<"col-lg-12 col-xl-6" l>' +
                    '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
                    '>t' +
                    '<"d-flex justify-content-between mx-2 row mb-1"' +
                    '<"col-sm-12 col-md-6"i>' +
                    '<"col-sm-12 col-md-6"p>' +
                    '>',

                // Buttons with Dropdown
                buttons: [
                    {
                        text: 'Add New Task',
                        className: 'add-new-btn btn btn-primary mt-50',

                        init: function (api, node, config) {
                            $(node).removeClass('btn-secondary');
                        }
                    }
                ],
                language: {
                    paginate: {
                        // remove previous & next text from pagination
                        previous: '&nbsp;',
                        next: '&nbsp;'
                    }
                },
                // initComplete: function () {
                //
                //     // Adding type filter once table initialized
                //     this.api()
                //         .columns(2)
                //         .every(function () {
                //             var column = this;
                //             var select = $(
                //                 '<select id="FilterTransaction" class="form-control text-capitalize mb-md-0 mb-2xx">' +
                //                 '<option value=""> Select Type </option>' +
                //                 '<option value="1"> Default </option>' +
                //                 '<option value="2"> Registration </option>' +
                //                 '</select>'
                //             )
                //                 .appendTo('.user_type')
                //                 .on('change', function () {
                //                     var val = $.fn.dataTable.util.escapeRegex($(this).val());
                //                     // var val = 2;
                //                     column.search(val ? '^' + val + '$' : '', true, false).draw();
                //                 });
                //
                //             column
                //                 .data()
                //                 .unique()
                //                 .sort();
                //         });
                //     // // Adding status filter once table initialized
                //     this.api()
                //         .columns(3)
                //         .every(function () {
                //             var column = this;
                //             var select = $(
                //                 '<select id="FilterTransaction" class="form-control text-capitalize mb-md-0 mb-2xx">' +
                //                 '<option value=""> Select Status </option>' +
                //                 '<option value="1"> Active </option>' +
                //                 '<option value="0"> Inactive </option>' +
                //                 // '<option value="3"> Pending </option>' +
                //                 '</select>'
                //             )
                //                 .appendTo('.user_status')
                //                 .on('change', function () {
                //                     var val = $.fn.dataTable.util.escapeRegex($(this).val());
                //                     // var val = 2;
                //                     column.search(val ? '^' + val + '$' : '', true, false).draw();
                //                 });
                //
                //             column
                //                 .data()
                //                 .unique()
                //                 .sort()
                //         });
                // },
                autoWidth: true
            });
        }

        taskManage.addNewTask = $('.add-new-btn');

        // Form Validation and submit form for create new user
        if (taskManage.newTaskForm.length) {
            taskManage.newTaskForm.validate({
                errorClass: 'error',
                rules: {
                    'task_name': {
                        required: true
                    },
                    'duration': {
                        required: true,
                    },
                    'status': {
                        required: true,
                    },
                },
                messages: {
                    task_name: "Enter task name",
                    duration: {
                        required: "Enter a duration",
                    },
                    status: {
                        required: "Enter a status",
                    },
                },
                // errorPlacement: function (error, element) {
                //     var name = $(element).attr("name");
                //     $("." + name + "_err_for_add").html("")
                //     error.appendTo($("." + name + "_err_for_add"));
                // },
            });

            // Change add/edit form
            taskManage.addNewTask.on('click', function () {
                $('#task_id').val(''); // hidden input value from create form
                $('#newUserForm').trigger("reset"); // Reset all input form value
                $('#myModalLabel33').html('New User');
            });

            taskManage.newTaskForm.on('submit', function (e) {
                let isValid = taskManage.newTaskForm.valid();
                e.preventDefault();
                let form = this;

                if (isValid) {
                    // add button loader
                    buttonLoaderShow('button-submit', 'button-loader');
                    setTimeout(function () {
                        taskManage.data = taskManage.newTaskForm.serialize();
                        let response = $.makeAjaxRequest('admin-task-create', "POST", taskManage.data)

                        if (response) {
                            // Reset all form input value
                            $(form)[0].reset();
                            taskManage.newTaskModal.modal('hide'); // Hide modal
                            taskManage.taskDataTable.DataTable().ajax.reload(null, false);
                            $.showSuccessAlert(response.message)
                        }
                        else{
                            $.showServerSideValidation(response.error, '_err_for_add')
                            $.showSuccessAlert(response.message)
                        }
                        // add button loader
                        buttonLoaderHide('button-submit', 'button-loader');

                    }, 2000);
                }
            });
        }

        // Delete user confirm modal
        taskManage.taskDataTable.on('click', '#delete-task', function () {
            var task_id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ml-1'
                },
                buttonsStyling: false
            }).then(function (result) {

                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: route('admin-task-delete'),
                        data: {
                            task_id: task_id
                        },
                        success: function (response) {

                            if (response.status === 200) {
                                $('.task-list-table').DataTable().ajax.reload(null, false);
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'Task has been deleted.',
                                    customClass: {
                                        confirmButton: 'btn btn-success'
                                    }
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Delete failed!',
                                    text: '' +
                                        'Something went wrong.',
                                    customClass: {
                                        confirmButton: 'btn btn-error'
                                    }
                                });
                            }

                        },
                        error: function (err) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Delete failed!',
                                text: '' +
                                    'Something went wrong.',
                                customClass: {
                                    confirmButton: 'btn btn-error'
                                }
                            });
                        }
                    });
                }
            });
        });

        // Modal popup for new user create
        taskManage.addNewTask.on('click', function () {
            taskManage.newTaskModal.find('form')[0].reset();
            taskManage.newTaskModal.find('span.error-text').text('');
            taskManage.newTaskModal.modal('show')
        });

        // To initialize tooltip with body container
        $('body').tooltip({
            selector: '[data-toggle="tooltip"]',
            container: 'body'
        });

    })();

});
