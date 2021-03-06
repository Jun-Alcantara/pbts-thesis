@include('layouts.header')
    <div class="container d-flex justify-content-center align-items-center">
        {{-- <h1 class="text-center text-white">Basa Muna!</h1> --}}
        <img src="{{ asset("images/basamuna-logo.png") }}" style="margin: 0 auto;">
    </div>
    <div class="container">
        <div id="app">
            @yield('content')
        </div>
    </div>
@include('layouts.footer')