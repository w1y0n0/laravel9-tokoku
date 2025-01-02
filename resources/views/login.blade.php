<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Laravel 9 | Login</title>
    <style>
        .login-box {
            width: 500px
        }
    </style>
</head>

<body>
    <div class="vh-100 d-flex flex-column justify-content-center align-items-center">
        {{-- @if (Session::has('status'))
        <div class="login-box alert alert-danger" role="alert">
            {{Session::get('message')}}
        </div>
        @endif --}}
        {{-- implementasi pesan error --}}
        @if ($errors->any())
            <div class="login-box alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="login-box p-5 border rounded shadow bg-light">
            <p class="h2 text-center mb-3">SignIn</p>
            <form action="login" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" autocomplete="off"
                        required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" autocomplete="off"
                        required>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary form-control">Login</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
