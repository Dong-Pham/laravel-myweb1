<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'My Web')</title>
    {{-- Vite --}}
    @vite(['resources/css/client.css', 'resources/js/client.js'])
</head>

<body>
    {{-- ===================== HEADER TOP================= --}}
    @include('client._partials.header')

    {{-- ===================== NAVBAR ================= --}}
    @include('client._partials.navbar')

    {{-- ===================== CONTENT ================= --}}
    <main class='container mt-3'>
        @yield('content')
    </main>

    {{-- ===================== FOOTER TOP================= --}}
    @include('client._partials.footer')

</body>

</html>
