<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Demo Laravel mix Vue</title>
    <style>
        .header_p:hover {
            color: rgb(219, 64, 64);
        }
        .img_div {
            height: 90vh;
        }
    </style>
</head>
<body>
        <header class="flex justify-center content-center gap-16 bg-red-300 h-16">
            <div class="py-4">
                <a href="{{ url('/') }}" class="flex gap-2">
                    <i class="fa-solid fa-house mt-3 fa-xl" style="color: #cbd0d7;"></i>
                    <p class="header_p text-xl text-green-200">Home</p>
                </a>
            </div>
            <div class="py-4">
                <a href="{{ url('/category') }}">
                    <p class="header_p text-xl text-green-200">Category</p>
                </a>
            </div>
            <div class="py-4">
                <a href="{{ url('/hotel') }}">
                    <p class="header_p text-xl text-green-200">Hotel</p>
                </a>
            </div>
        </header>
