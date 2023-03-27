<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>System Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="jquery.min.js"></script>
    <style>
        body {
            background-color: grey;
        }

        @media screen and (max-width: 600px) {
            h4 {
                font-size: 85%;
            }
        }
    </style>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
</head>

<body>
    <div align="center">
        <img src="{{ asset('logoinka.png') }}" width="50%" style="margin-top:5%">

        <br \><br \>
        <div class="container">
            <div style="color:white">
            </div><br>
            <form action="{{ url('login') }}" method="post">
                @csrf
                @if (session()->has('loginError'))
                    <div class="form-group col-4">
                        <div class="alert alert-danger alert-dismissable fade show" role="alert">
                            {{ session('loginError') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif
                <div class="form-group col-4">
                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                        placeholder="Username" name="username" autofocus required value="{{ old('username') }}">
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-4">
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="Password" name="password" required value="{{ old('password') }}">
                </div>
                <button type="submit" class="btn btn-primary" name="btn-login">Masuk</button>
            </form>
            <br \>
        </div>
    </div>
</body>

</html>
