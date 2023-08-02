@include('main.header')

<div class="content">
    @yield('content')
</div>
<div class="img_div flex justify-center items-center ">
    <img src="{{ asset('image/background.png') }}" alt="Background Image" class="rounded-3xl shadow-red-900">
</div>

