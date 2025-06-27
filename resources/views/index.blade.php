<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none; 
        }
    </style>
</head>
<body>
    <nav class="navbar-light bg-light">
        <div class="container py-3">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Todo List</h3>
                    <a></a>
                </div>
                <div class="col-auto">
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profile" class="rounded-circle" width="48" height="48">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li class="px-3 py-2">
                                <strong>{{ Auth::user() ? Auth::user()->name : 'Guest' }}</strong><br>
                                <small>{{ Auth::user() ? Auth::user()->email : 'Guset@gmail.com' }}</small>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            @if(session('auth_token'))
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item" type="submit">Logout</button>
                                    </form>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container d-flex flex-column gap-4 mt-3 overflow-x-auto hide-scrollbar"> 
        <div class="border-bottom mb-3 w-100">
            <h1>Board</h1>
        </div>
        <div id="container" class="row d-flex justify-content-start gap-3 flex-row flex-nowrap">
            @foreach($data as $board)
                <a href="{{ route('home.show', encrypt($board['id'])) }}" class="text-decoration-none">
                    <div class="card p-0 btn" id="{{ $board['id'] }}" style="width: 20rem;">
                        <div class="card-img-top" id="cardGradient1" style="height: 150px;">

                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $board['name'] }}</h5>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <script>
        function getHarmoniousColors() {
            const baseHue = Math.floor(Math.random() * 360);
            const saturation = 70 + Math.floor(Math.random() * 30); // 70-100%
            const lightness1 = 40 + Math.floor(Math.random() * 20); // 40-60%
            const lightness2 = 60 + Math.floor(Math.random() * 20); // 60-80%
            
            return [
                `hsl(${baseHue}, ${saturation}%, ${lightness1}%)`,
                `hsl(${(baseHue + 30) % 360}, ${saturation}%, ${lightness2}%)`
            ];
        }

        function createHarmoniousGradient() {
            const [color1, color2] = getHarmoniousColors();
            const angle = Math.floor(Math.random() * 360);
            
            return `linear-gradient(${angle}deg, ${color1}, ${color2})`;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const cardImg = document.getElementById('cardGradient1');
            if (cardImg) {
                cardImg.style.background = createHarmoniousGradient();
            }
        });
    </script>
</body>
</html>