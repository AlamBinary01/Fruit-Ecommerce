<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>User Login</title>
    @include('user.layout.components.head')
</head>
<body>
    <section class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <div class="card shadow-sm">
                        <div class="card-body p-4">

                            <!-- Display Success or Error Messages -->
                            <div id="alerts">
                                @if ($errors->any())
                                    <div class="alert alert-danger mt-3">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger mt-3">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-success mt-3">
                                        {{ session('success') }}
                                    </div>
                                @endif
                            </div>

                            <!-- Admin Login Form -->
                            <h2 class="fs-5 fw-bold text-center text-dark mb-4">User Login</h2>
                            <form id="login-form" method="POST" action="{{ route('user.login') }}">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="floatingInput" name="email"
                                        placeholder="name@example.com" required autocomplete="email" autofocus>
                                    <label for="floatingInput">Email address</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="floatingPassword" name="password"
                                        placeholder="Password" required autocomplete="current-password">
                                    <label for="floatingPassword">Password</label>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary btn-lg w-100">Login</button>
                                    </div>
                                </div>
                            </form>

                            <!-- Sign Up Link -->
                            <div class="text-center mt-3">
                                <p class="text-muted">Don't have an account? 
                                    <a href="{{ route('register') }}" class="text-primary fw-bold">Sign Up</a>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Login Prompt Modal -->
    <div class="modal fade" id="loginPromptModal" tabindex="-1" aria-labelledby="loginPromptModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginPromptModalLabel">Please Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Before adding to your cart or purchasing, please login first.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @include('user.layout.components.script')

    <script>
        $(document).ready(function() {
            @auth
                // User is authenticated, do nothing
            @else
                if (!sessionStorage.getItem('loginPromptShown')) {
                    $('#loginPromptModal').modal('show');
                    sessionStorage.setItem('loginPromptShown', 'true');
                }
            @endauth
        });
    </script>
</body>
</html>
