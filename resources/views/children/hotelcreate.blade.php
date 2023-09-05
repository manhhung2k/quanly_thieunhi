@include('main.header')
    <div class="content">
        @yield('content')
    </div>
    <div id="app" class="relative">
        <div class="img_div w-full h-full ">
            <img src="{{ asset('images/thieunhi.jpg') }}" alt="Background Image" class="rounded-3xl shadow-red-900 w-full image_background">
        </div>
        <hotel-create class="absolute top-0 list_children"></hotel-create>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
