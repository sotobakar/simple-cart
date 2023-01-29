<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Cart</title>
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.10.5/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css')}}" />
    <style>
        [x-cloak] { display: none !important; }
    </style>
    @stack('css')
</head>

<body>
    <div class="relative overflow-hidden bg-white">
        <div x-data="{ open: false }" class="relative pt-6 pb-8 sm:pb-12">
            @include('components.navbar')
            <main class="mt-4 sm:mt-8">
                @yield('content')
            </main>
        </div>
        @include('components.footer')
    </div>
    @stack('scripts')
</body>

</html>