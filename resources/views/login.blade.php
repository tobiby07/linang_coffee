<!DOCTYPE html>
<html lang="en">

<head>

    <title>Login -  Linang Kopi</title>

    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<div class="auth-wrapper">
    <div class="auth-content text-center">
        <img src="assets/images/logo.png" alt="" class="img-fluid mb-4">
        <div class="card borderless">
            <div class="row align-items-center ">
                <div class="col-md-12">
                    <div class="card-body">
                        <h4 class="mb-3 f-w-400">Signin</h4>
                        <hr>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group mb-3">
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    id="Email" name="email" placeholder="Email address"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>

                            <div class="form-group mb-4">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="Password" name="password" placeholder="Password" required
                                    autocomplete="current-password">
                            </div>

                            <button class="btn btn-block btn-primary mb-4"> Signin</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Required Js -->
<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/js/plugins/bootstrap.min.js"></script>

<script src="assets/js/pcoded.min.js"></script>



</body>

</html>
