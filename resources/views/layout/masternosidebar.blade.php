<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @include('admin.layout.bootstrap')
    <script src="{{ asset('js/profile.js') }}"></script>
</head>

<body>

    <div style="flex-grow: 1;">

        <!-- Header -->
        @include('admin.layout.header')

        <div style="padding: 20px;">
            @yield('content')
        </div>

    </div>
    @include('admin.layout.scripts')
    @yield('scripts')

</body>

</html>
