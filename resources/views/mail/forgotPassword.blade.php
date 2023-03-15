<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    <title>Document</title>
    <style type="text/css">
        body {
            font-family: 'Lato', sans-serif;
        }

        table {
            border-spacing: 0;
            font-family: 'Lato', sans-serif;
        }

        td {
            padding: 0;
            font-family: 'Lato', sans-serif;
        }

        img {
            border: 0;
        }
    </style>
</head>
<body style="margin: 0;
background-color: #fff;
font-family: 'Lato', sans-serif;">

<center class="wrapper" style="background-color: rgb(255,255,255);width: 100%;
    table-layout: fixed;
    padding-bottom: 20px;
    font-family: 'Lato', sans-serif;">
    <table style="width:100%;border-spacing: 0;">
        <tr>
            <td style="height: 178px; padding: 0 25px;
               background-color: #c0bfbf;width:100%; text-align: center;">
                <img
                    src="{{env('LIVE_SITE_LOGO')}}"
                    alt="Logo" style="width: 120px">
                <p style="margin:6px 0 0 0; color:#fff; text-align: center;">Greetings and welcome!</p>
            </td>
        </tr>
        <tr>
            <td style="padding:0;">
                <table style="max-width: 700px; text-align: center;
                    margin: 0 auto;border-spacing: 0;width: 100%;">
                    <tr>
                        <table style="margin:24px auto 20px auto; width:100%;width:600px;max-width: 640px; background:#fff;box-shadow: 0px 3px 1px -2px rgba(148, 157, 178, 0.2), 0px 2px 2px rgba(148, 157, 178, 0.14), 0px 1px 5px rgba(148, 157, 178, 0.12);
                        border-radius: 4px;text-align: center; ">
                            <tr>
                                <td style="padding:20px">

                                        <h3 style="color: #6438BC;
                                margin:0 0 10px 0;
                                font-size: 36px;
                                font-weight: 700;
                                line-height: 48px;
                                text-align: center;

                                ">Hello, {{$name}}</h3>
                                        <p style="color: #20A4F3;margin:0; text-align: center;">You're almost there!</p>
                                        <p style="
                                color: rgba(3, 6, 11, 0.5);
                                margin:30px 0 40px 0;
                                font-size: 16px;
                                font-weight: 400;
                                line-height: 28px;
                                letter-spacing: 0.15px;
                                text-align: center;
                                ">
                                            Your password reset information given
                                            below.
                                        </p>
{{--                                    <p style="--}}
{{--                                color: rgba(3, 6, 11, 0.5);--}}
{{--                                margin:30px 0 40px 0;--}}
{{--                                font-size: 16px;--}}
{{--                                font-weight: 400;--}}
{{--                                line-height: 28px;--}}
{{--                                letter-spacing: 0.15px;--}}
{{--                                text-align: center;--}}
{{--                                ">--}}
{{--                                        Click here {{$resetLink}} and reset your password.--}}
{{--                                    </p>--}}

                                    <table style="
                                    margin: 0 auto;
                                    border:1px solid rgba(148, 157, 178, 0.12);
                                    border-radius: 4px;
                                    padding: 4px;
                                ">
                                        <tr>
                                            <td style="
                                            color: rgba(3, 6, 11, 0.5);
                                            font-size: 16px;
                                            font-weight: 400;
                                            line-height: 24px;
                                            letter-spacing: 0.15px;;
                                            padding: 0 38px 0 8px;

                                        ">Token :
                                            </td>
                                            <td style="
                                            background-color: rgba(32, 164, 243, 1);
                                            padding: 8px 12px;
                                            border-radius: 4px;
                                            color: #fff;
                                            font-size: 15px;
                                            font-weight: 500;
                                            line-height: 26px;
                                            letter-spacing: 0.46px;
                                        "> {{$password}} </td>

                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </tr>

                    <tr style="text-align: center">
                        <td>
                            <p style="color:#03060B;
                            font-size:14px;
                            font-weight:400;
                            line-height:24px;
                            margin: 40px 0 4px 0;
                            letter-spacing:0.15px;
                            text-align: center;">
                                @ 2022 - All Rights Reserved
                            </p>
                            <a href="#" style="color:#00B4D8;
                                font-size:14px;
                                font-weight:400;
                                line-height:24px;
                                margin: 0;
                                letter-spacing:0.15px;
                                text-decoration: none;
                                text-align: center"> Terms and Conditions</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</center>
</body>
</html>

