<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Keypedia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
    <style>
        h1{
            font-size: 30px;
        }
        h2{
            font-size: 25px;
        }
    </style>
        <nav class="navbar navbar-expand-lg navbar-light bg-light" role="navigation">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">KEYPEDIA</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @guest
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('login')}}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('register')}}">Register</a>
                        </li>
                    </ul>
                @endguest
                @auth
                    @if ($user->role == 'C')
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item">My Cart</a></li>
                            <li><a class="dropdown-item">Transaction History</a></li>
                            <li><a class="dropdown-item">Change Password</a></li>
                            <li><a class="dropdown-item">Logout</a></li>
                        </ul>
                    @elseif ($user->role == 'M')
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item">Add Keyboard</a></li>
                            <li><a class="dropdown-item">Manage Categories</a></li>
                            <li><a class="dropdown-item">Change Password</a></li>
                            <li><a class="dropdown-item">Logout</a></li>
                        </ul>
                    @endif
                @endauth
              </div>
            </div>
          </nav>
    </header>
        @yield("content")
    <footer>
        <p>Copyright 2022 - Keypedia Corporation</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
