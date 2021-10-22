<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .content {
            border-top: 5px solid #141b43;
        }

        body {
            background-color: #f4f6f8;
            margin-top: 25vh;
            overflow: hidden;
            margin: 0;
            font-family: Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
        }

        .content {
            border-top: 5px solid #141b43;
        }

        .payment-details {
            background-color: #f4f6f8 !important;
            padding: 5px 10px;
            font-size: 12px;
            font-weight: bold;
            min-height: 160px;
        }

        .payment-title {
            font-size: 14px;
            font-weight: bold;
        }

        .other-details h5 {
            font-size: 14px;
            padding-top: 35px;
            font-weight: bold;
        }

        .other-details p {
            font-weight: normal;
            font-size: 13px;
        }

        .clearfix {
            display: block;
            clear: both;
            content: "";
        }

        .float-left {
            float: left;
        }

        .float-right {
            float: right;
        }

        .font-weight-bold {
            font-weight: 700 !important;
        }

        .mt-5, .my-5 {
            margin-top: 7rem !important;
        }

        .p-1 {
            padding: 0.25rem !important;
        }

        .email-content {
            background: #ffffff;
            width: 40%;
            margin: auto;
        }

        .text-center {
            text-align: center;
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .btn-confirm {
            background-color: #141b43;
            text-decoration: none;
            color: #ffffff;
        }

        .btn-block {
            display: block;
            width: 100%;
        }

        .p-4 {
            padding: 1.5rem !important;
        }
    </style>

</head>
<body>
<div class="email-content mt-5">
    <div class="content bg-white">
        <div class="text-left p-4">
            <p class="font-weight-bold pt-4 pb-2">Hello {{ucwords($appointment->user->name)}}.</p>
            <p class="font-weight-semibold ">You have an appointment booking with {{$appointment->client_name}} for
                {{$appointment->service->name }} for {{ $appointment->service->duration }} minutes on {{ $appointment->date->format('D jS M Y') }} at {{$appointment->start_time->format('g:i A')}}</p>
            <p>Best Regards.<br>
        </div>
    </div>
</div>
</body>
</html>
