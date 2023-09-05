@include('main.header')

<div class="content">
    @yield('content')
</div>
<div class="img_div w-full h-full ">
    <img src="{{ asset('images/thieunhi.jpg') }}" alt="Background Image" class="rounded-3xl shadow-red-900 w-full image_background">
</div>

