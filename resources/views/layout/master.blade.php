<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CleanCo</title>

    {{-- import bootstrap --}}
    <link href="{{ asset('bootstrap-5.2-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap-icons-1.13.1/bootstrap-icons.css') }}" rel="stylesheet">

    {{-- import styling --}}
    <link rel="stylesheet" href="{{ 'css/style.css' }}">
</head>

<body>
    {{-- supaya responsif --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        {{-- <div class="container-fluid"> --}}
        @include('layout.navbar')
        {{-- </div> --}}
    </nav>


    {{-- Konten halaman --}}
    {{-- yield wajib sebagai turunan supaya bisa nampilin home --}}
    <main class="container mt-4">
        @yield('content')
    </main>

    {{-- bagian footer --}}
    @include('layout.footer')
    {{-- supaya responsif --}}
    <script src="{{ asset('bootstrap-5.2-dist/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
