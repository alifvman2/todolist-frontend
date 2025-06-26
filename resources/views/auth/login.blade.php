<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Todo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .nav-tabs .nav-link {
            border: none;
            color: black;
            background-color: transparent; /* Warna primary transparan */
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .nav-tabs .nav-link.active {
            background-color: #0d6efd !important; /* Warna primary solid */
            color: white !important;
            box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.5);
        }
    </style>
</head>
<body style="background: linear-gradient(to right, #4facfe, #00f2fe);">
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center" style="margin-top: 10%;">
            <div class="col-md-6">
                <center>
                    <div class="card p-3" style="width: 28rem;">
                        <div class="card-body">
                            <div class="card-title text-center">
                                <h3>Login TODO</h3>
                                <ul class="nav nav-tabs justify-content-center mt-3" style="border: none">
                                    <li class="nav-item">
                                        <button class="nav-link active bg-primary text-white" id="login-tab" data-bs-toggle="tab" data-bs-target="#login">Login</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register">Registrasi</button>
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="tab-content mt-3">
                                <!-- Login Form -->
                                <div class="tab-pane fade show active" id="login">
                                    <form method="POST" action="{{ route('login') }}" enctype="multipart/form-data" class="mt-3">
                                        @csrf
                                        <div class="mb-3">
                                            <input type="email" name="email" class="form-control" placeholder="Masukan Email" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" name="password" class="form-control" placeholder="Masukan Password" required>
                                            <div class="mt-2 text-end">
                                                <a href="#" class="text-decoration-none">Lupa password?</a>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">Login</button>
                                    </form>
                                </div>
                                
                                <!-- Register Form -->
                                <div class="tab-pane fade" id="register">
                                    <form method="POST" action="{{ route('registration') }}" enctype="multipart/form-data" class="mt-3">
                                        @csrf
                                        <div class="mb-3">
                                            <input type="email" name="email" class="form-control" placeholder="Masukkan Email" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">Daftar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </center>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
    function switchToRegister() {
        new bootstrap.Tab('#register-tab').show();
    }
    
    function switchToLogin() {
        new bootstrap.Tab('#login-tab').show();
    }

    document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
        tab.addEventListener('shown.bs.tab', function() {
            document.querySelectorAll('[data-bs-toggle="tab"]').forEach(t => {
                t.classList.remove('active', 'bg-primary', 'text-white');
            });
            this.classList.add('active', 'bg-primary', 'text-white');
        });
    });
    </script>
</body>
</html>