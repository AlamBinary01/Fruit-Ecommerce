<div class="container-fluid fixed-top">
    <div class="container topbar bg-primary d-none d-lg-block">
        <div class="d-flex justify-content-between">
            <div class="top-info ps-2">
                <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#"
                        class="text-white">123 Street, New York</a></small>
                <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#"
                        class="text-white">Email@Example.com</a></small>
            </div>
            <div class="top-link pe-2">
                <a href="#" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                <a href="#" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                <a href="#" class="text-white"><small class="text-white ms-2">Sales and Refunds</small></a>
            </div>
        </div>
    </div>
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="{{ route('user.home') }}" class="navbar-brand">
                <h1 class="text-primary display-6">Fruitables</h1>
            </a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="{{ route('user.home') }}" class="nav-item nav-link active">Home</a>
                    <a href="{{ route('user.shop') }}" class="nav-item nav-link">Shop</a>

                    @if (Auth::check())
                    @endif
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Categories</a>
                        <div class="dropdown-menu m-0 bg-secondary rounded-0">
                            @foreach ($categories as $category)
                                <a href="{{ route('user.shop', ['category' => $category->id]) }}"
                                    class="dropdown-item">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <a href="{{ route('user.contact') }}" class="nav-item nav-link">Contact</a>
                    <a href="{{ route('about.show') }}" class="nav-item nav-link">About</a>
                </div>
                <div class="d-flex m-3 me-0">
                    <button
                        class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4"
                        data-bs-toggle="modal" data-bs-target="#searchModal"><i
                            class="fas fa-search text-primary"></i></button>
                    @if (Auth::check())
                        <a href="{{ route('user.modules.cart.index') }}" class="position-relative me-4 my-auto text-primary"
                            id="cart-icon">
                            <i class="fa fa-shopping-bag fa-2x"></i>
                            <span id="cart-count"
                                class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                                style="top: -5px; left: 15px; height: 20px; min-width: 20px;">0</span>
                        </a>
                        <form id="logout-form" action="{{ route('user.logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                        <a href="#"  class="position-relative me-4 my-auto text-primary""
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt fa-2x" ></i>
                        </a>
                    @else
                        <a href="{{ route('user.login') }}"  class="position-relative me-4 my-auto text-primary">
                            <i class="fas fa-user fa-2x" ></i>
                        </a>
                    @endif
                </div>
            </div>
        </nav>
    </div>
</div>

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $.get("{{ route('cart.count') }}", function(data) {
                $('#cart-count').text(data.count);
            });
        });
    </script>
@endpush

