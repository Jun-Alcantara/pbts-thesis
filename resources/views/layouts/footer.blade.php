
    @stack('bottom-nav')
    {{-- <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script> --}}
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script scr="{{ asset('js/core.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    @stack('custom-js')
</body>
</html>