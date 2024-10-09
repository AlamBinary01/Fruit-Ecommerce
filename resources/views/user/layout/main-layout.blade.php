<!DOCTYPE html>
<html lang="en">
@include('user.layout.components.head')

<body style="background-color:white">
    @include('user.layout.components.navbar')

    <div class="mt-3 mb-3">
        @yield('content')
    </div>

    @include('user.layout.components.footer')
    @include('user.layout.components.script')
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

</body>

@stack('scripts')

</html>
