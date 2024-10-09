<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('admin.layout.components.style')
    @stack('css')
    <title>Dashboard</title>
</head>

<body>
    @include('admin.layout.components.header')

    @include('admin.layout.components.sidebar')

    <main id="main" class="main">
        <section class="section">
            @yield('content')
        </section>
    </main>
    <script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000", // 5 seconds
    }

    @if(Session::has('success'))
    console.log('toaster')
    toastr.success("{{ Session::get('success') }}");
    @endif

    @if(Session::has('error'))
    toastr.error("{{ Session::get('error') }}");
    @endif
    </script>
    @include('admin.layout.components.js')
    @stack('scripts')


</body>

</html>