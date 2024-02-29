<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Cashier Sperpart</title>
    <link rel="stylesheet" href="/vendor/admin/assets/css/bootstrap.css">
    <style>
        body {
    background-image: url('/vendor/admin/assets/images/background/pexels-pixabay-162553.jpg');
    /* Mengatur ukuran background untuk menutupi seluruh halaman */
    background-size: cover;
    /* Menetapkan bahwa background akan diulang secara vertikal dan horizontal */
    background-repeat: no-repeat;
    /* Mengatur posisi background di tengah halaman */
    background-position: center;
}

    </style>

    <link rel="stylesheet" href="/vendor/admin/assets/css/app.css">
</head>

<body>
    <div id="auth">

        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 mt-5 mx-auto">
                    <div class="card pt-5">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <h3>Log In</h3>
                                <p>Please log in to continue to Cashier Sperpart</p>
                            </div>

                            @if(session()->has('loginError'))
                            <div class="alert alert-danger">{{(session('loginError'))}}</div>
                            @endif

                            <form action="/login/do" method="post">
                                @csrf
                                <div class="form-group position-relative has-icon-left">
                                    <label for="email">Email</label>
                                    <div class="position-relative">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email">
                                        <div class="form-control-icon">
                                            <i data-feather="at-sign"></i>
                                        </div>
                                    </div>
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group position-relative has-icon-left">
                                    <div class="clearfix">
                                        <label for="password">Password</label>
                                    </div>
                                    <div class="position-relative">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">
                                        <div class="form-control-icon">
                                            <i data-feather="lock"></i>
                                        </div>
                                    </div>
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                 <!-- - -->

                                <div class='form-check clearfix my-2'>
                                </div>
                                <div class="clearfix">
                                    <button type="submit" class="btn btn-primary btn-block float-end">Login</button>
                                </div>
                            </form>
                            <div class="divider">
                                <div class="divider-text">Atau</div>
                            </div>
                            <div class="row">
                                <div class="">
                                    <a href="/register"><button class="btn btn-secondary btn-block float-end">Register</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <script src="/vendor/admin/assets/js/feather-icons/feather.min.js"></script>
    <script src="/vendor/admin/assets/js/app.js"></script>

    <script src="/vendor/admin/assets/js/main.js"></script>
</body>

</html>