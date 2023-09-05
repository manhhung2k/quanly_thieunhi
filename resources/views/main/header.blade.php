<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Quản lý Thiếu nhi Thánh Thể</title>
    <style>
        .header_p:hover {
            color: black;
        }
        .img_div {
            height: 90vh;
        }
        .full-form {
            height: 93vh;
        }
        header {
            background-image: linear-gradient( yellow, red);
        }
        .image_background {
            height: 94vh;
        }
        .list_children {
            width: 100vw;
        }
    </style>
</head>
<body>
        <header class="flex justify-center content-center gap-16 h-16">
            <div class="py-4">
                <a href="{{ url('/') }}" class="flex gap-2">
                    <i class="fa-solid fa-house mt-3 fa-xl" style="color: #cbd0d7;"></i>
                    <p class="header_p text-xl text-green-200">Home</p>
                </a>
            </div>
            <div class="py-4">
                <a href="{{ url('/children') }}">
                    <p class="header_p text-xl text-green-200">Quản lý thiếu nhi</p>
                </a>
            </div>
        </header>
