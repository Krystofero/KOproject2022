<!-- Scripts -->
@vite(['resources/js/app.js'])
@vite(['resources/js/checkBrowser.js']) {{-- Sprawdza czy przeglądarka to IE --}}

<!-- Styles -->
{{-- <link href="{{ asset('/css/app.css') }}" rel="stylesheet"> --}}
@vite('resources/css/app.css')
@vite('resources/js/app.js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script> --}}
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
