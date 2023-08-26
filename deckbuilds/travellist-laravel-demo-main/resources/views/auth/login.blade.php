<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Login</title>
</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section"></h2>
                </div>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-10">
                        <div class="wrap d-md-flex">
                            <div class="img" style="background-image: url({{ url('img/dado.jpg') }});">
                            </div>
                            <div class="login-wrap p-4 p-md-5">
                                <div class="d-flex">
                                    <div class="w-100">
                                        <h3 class="mb-4">Iniciar Sesión</h3>
                                    </div>
                                </div>
                                <form action="#" class="signin-form">
                                    <div class="form-group mb-3">
                                        <label class="label" for="name">Email</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
										@error('email')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
									</div>
                                    <div class="form-group mb-3">
                                        <label class="label" for="password">Contraseña</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
										@error('password')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
									</div>
                                    <div class="form-group">
                                        <button type="submit"
                                            class="form-control btn btn-primary rounded submit px-3">Login</button>
                                    </div>
                                    <div class="form-group d-md-flex">
                                        <div class="w-50 text-left">
                                            <label class="checkbox-wrap checkbox-primary mb-0">Mostrar Contraseña
                                                <input type="checkbox" id="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
										@if (Route::has('password.request'))
                                        <div class="w-50 text-md-right">
                                            <a href="{{ route('password.request') }}">Contraseña Olvidada</a>
                                        </div>
										@endif
                                    </div>
                                </form>
                                <p class="text-center">No eres usuario? <a 
                                        href="{{ route('register') }}">Regístrate</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/loginContraseña.js') }}"></script>
</body>

</html>