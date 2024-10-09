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
    <title>User Registration</title>
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

                            <!-- Registration Form -->
                            <h2 class="fs-5 fw-bold text-center text-dark mb-4">Create an Account</h2>
                            <form id="register-form" method="POST" action="{{ route('register.post') }}">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingName" name="name" 
                                           placeholder="John Doe" required autofocus value="{{ old('name') }}">
                                    <label for="floatingName">Full Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="floatingEmail" name="email" 
                                           placeholder="name@example.com" required value="{{ old('email') }}">
                                    <label for="floatingEmail">Email address</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="floatingPassword" name="password" 
                                           placeholder="Password" required>
                                    <label for="floatingPassword">Password</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="floatingPasswordConfirm" 
                                           name="password_confirmation" placeholder="Confirm Password" required>
                                    <label for="floatingPasswordConfirm">Confirm Password</label>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary btn-lg w-100">Sign Up</button>
                                    </div>
                                </div>
                            </form>

                            <!-- Already have an account? -->
                            <div class="text-center mt-3">
                                <p class="text-muted">Already have an account? 
                                    <a href="{{ route('user.login') }}" class="text-primary fw-bold">Login</a>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://unpkg.com/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @include('user.layout.components.script')
</body>
</html>
