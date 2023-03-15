@extends('user.layouts/userContentLayoutMaster')

@section('title', $pageConfigs['title'])

@section('vendor-style')

@endsection
@section('page-style')

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@11.7.0/build/styles/default.min.css">

    <style>
        .light-gray-bg {
            background: #f1f2f6;
        }


        label {
            color: #222222;
            font-weight: 600;
        }

        .switch-inner .card-header {
            background: #dfe4ea;
        }

        .switch-inner .card-body {
            background: #f1f2f6;
        }

        .switch-header-inner {
            margin-bottom: 0;
        }


        .content-header h3 {
            color: #000;
            font-weight: 600;
        }

        .document-content .title {
            color: #000;
            font-weight: 600;
        }

        .custom-switch .custom-control-label::before {
            background: #b4b7bd;
        }

        .label-choose-text {
            position: absolute;
            color: #000000;
            right: 8%;
            font-weight: 800;
        }

        .title-inner-icon .title-svg, .message-inner-icon .message-svg {
            position: relative;
        }

        .title-inner-icon .title-svg {
            position: absolute;
            color: red;
            right: 5%;
            top: 29%;
            font-weight: 800;
        }

        .message-inner-icon .message-svg {
            position: absolute;
            color: #000000;
            right: 5%;
            bottom: 25%;
            font-weight: 800;
        }

        /* .message-inner-icon span{
          position: absolute;
          right:5%;
            bottom:10%;
        } */
        .document-icon span svg {
            width: 56px;
            height: 56px;
        }

        .content-text {
            font-size: 16px;
            line-height: 1.48;
            color: #000;
        }

        .content-text span {
            font-weight: 600;
            color: #000;
        }

        .contet-headers {
            font-size: 18px;
            font-weight: 600;
            color: #222;
            text-transform: capitalize;
        }

        .document-icon {
            color: #7367f0;;
        }


        .web-image-inner {
            width: 100%;
            background: url('https://i.ibb.co/xjXz51d/web.jpg');
            height: 70vh;
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
        }

        .web-img-icon img {
            width: 56px;
            height: 56px;
            margin-right: 15px;
            border-radius: 50%;
        }

        .top-left-inner .top-left {
            position: absolute;
            top: 25%;
            left: 10%;
        }

        .top-right-inner .top-right {
            position: absolute;
            top: 25%;
            right: 10%;
        }

        .top-center-inner .top-center {
            position: absolute;
            top: 25%;
            right: 50%;
        }

        .bottom-left-inner .bottom-left {
            position: absolute;
            bottom: 15%;
            left: 10%;
        }

        .bottom-right-inner .bottom-right {
            position: absolute;
            bottom: 15%;
            right: 10%;
        }
    </style>
@endsection

@section('content')

    <main>
        <section class="site-setup-section">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header"></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-7 col-md-7 col-sm-12">
                                            <div class="site-wrapper">
                                                <div class="header mb-2">
                                                    <h4>Site Setup</h4>
                                                </div>
                                                <div class="card light-gray-bg">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-4 col-form-label">
                                                                        <label for="first-name">SITE NAME</label>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <input type="text"
                                                                               class="form-control"
                                                                               name="site_name"
                                                                               id="site_name"
                                                                               placeholder="Site Name"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end col  -->
                                                            <div class="col-12">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-4 col-form-label">
                                                                        <label for="site-url">SITE URL </label>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <input type="text"
                                                                               class="form-control"
                                                                               name="chrome_web_origin"
                                                                               id="chrome_web_origin"
                                                                               placeholder="https://www.example.com"/>
                                                                        <i class="text-danger">https://www.example.com
                                                                            or http://www.example.com</i>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-4 col-form-label">
                                                                        <label for="site-url">DEFAULT ICON</label>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <div class="custom-file">
                                                                            <input type="file"
                                                                                   class="custom-file-input"
                                                                                   id="default-icon-url"
                                                                            />
                                                                            <label class="custom-file-label"
                                                                                   for="customFile">Choose file</label>
                                                                            <i class="text-danger">We are allow .jpeg,
                                                                                .jpg, .png file.</i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- end form grp  -->
                                                                <!-- Start switch header  -->
                                                            </div>
                                                            <!-- end col  -->
                                                        </div>
                                                        <!-- end row  -->
                                                    </div>
                                                    <!-- end card-body  -->
                                                </div>
                                                <!-- end card  -->
                                            </div>
                                        </div>
                                        <!-- end col  -->
                                        <div class="col-lg-5 col-md-5 col-sm-12">

                                            @include('.web-app.side-message.http-web-push')
                                            <!-- end setup-content  -->
                                        </div>
                                        <!-- end col  -->
                                    </div>
                                    <!-- end row  -->
                                </div>
                                <div class="advance-wrapper mx-2 mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="">
                                                        <button type="button"
                                                                id="app_create_by_click"
                                                                class="btn btn-primary mr-1 waves-effect waves-float waves-light">
                                                            Create
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end card  -->
                    </div>
                    <!-- end col  -->
                </div>
                <!-- end row  -->

            </div>
            <!-- end card  -->
        </section>
        <!-- end section  -->
    </main>

@endsection

@section('vendor-script')


@endsection
@section('page-script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
    <script>
        hljs.highlightAll();
    </script>


    <script>


        function blockUICustom() {
            $.blockUI({
                message: '<div class="spinner-border text-primary" role="status"></div>',
                css: {
                    backgroundColor: 'transparent',
                    border: '0'
                },
                overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.8
                }
            });
        }

        $(document).on('click', '#app_create_by_click', function () {

            let name = $('#site_name').val();
            let site_name = $('#site_name').val();
            let chrome_web_origin = $('#chrome_web_origin').val().trim();

            if (name === '') {
                $.showWarningAlert('Site name can not be empty !!');
                return;
            }

            if (chrome_web_origin === '') {
                $.showWarningAlert('Site url can not be empty !!');
                return;
            }

            if (chrome_web_origin !== '') {
                if (!$.validURL(chrome_web_origin)) {
                    $.showWarningAlert('Please provide valid site url');
                    return;
                }
            }

            let imageFile = $('#default-icon-url')[0].files[0];

            let formData = new FormData();
            formData.append('name', name);
            formData.append('site_name', site_name);
            formData.append('chrome_web_origin', chrome_web_origin);

            if (imageFile !== undefined) {

                let fileType = imageFile.type;
                const validFileTypes = ['image/jpeg', 'image/jpg', 'image/png'];

                let imageCheck = validFileTypes.find(function (element) {
                    return element === imageFile.type;
                });

                if (imageCheck === undefined) {
                    $.showWarningAlert("<p>Please provide valid image. Your file type is <span class='text-danger'>" + fileType + "</span></p>");
                    return;
                }

                formData.append('file', $('#default-icon-url')[0].files[0]);
            }


            blockUICustom();

            $.ajax({
                url: '{!! route('web-app-create') !!}',
                type: 'POST',
                data: formData,
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType
                success: function (response) {
                    $.unblockUI();
                    if (response.status === 200) {
                        $.showSuccessAlert(response.message);
                        let id = response.data.app_id;
                        setTimeout(() => {
                            window.location.href = route('web-app-code-show', {id: id});
                        }, 3000);
                    } else {
                        $.showErrorAlert(response.message);
                    }
                }
            });
        })

    </script>

@endsection
