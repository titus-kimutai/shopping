<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link href="{{ asset('/css/app.css') }}" rel="stylesheet" />
<title>@yield('title', 'Online Store')</title>
</head>
<body>
<!-- header -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary py-4">
<div class="container">
<a class="navbar-brand" href="{{ route('home.index') }}">Online Store</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
<div class="navbar-nav ms-auto">
<a class="nav-link active" href="{{ route('home.index') }}">Home</a>
<a class="nav-link active" href="{{ route('product.index') }}">Products</a>
<a class="nav-link active" href="{{ route('cart.index') }}">Cart</a>
<a class="nav-link active" href="{{ route('home.about') }}">About</a>
<div class="vr bg-white mx-2 d-none d-lg-block"></div>
@guest
<a class="nav-link active" href="{{ route('login') }}">Login</a>
<a class="nav-link active" href="{{ route('register') }}">Register</a>
@else
<a class="nav-link active" href="{{ route('myaccount.orders') }}">My Orders</a>
<form id="logout" action="{{ route('logout') }}" method="POST">
<a role="button" class="nav-link active"
onclick="document.getElementById('logout').submit();">Logout</a>
@csrf
</form>
@endguest
</div>
</div>
</div>
</nav>
<header class="masthead bg-primary text-white text-center py-4">
<div class="container d-flex align-items-center flex-column">
<h2>@yield('subtitle', 'Online Store')</h2>
</div>
</header>
<!-- header -->
<div class="container my-4">
@yield('content')
</div>
<!-- footer -->
<div class="copyright py-4 text-center text-white">
<div class="container">
<small>
Copyright - <a class="text-reset fw-bold text-decoration-none" target="_blank"
href="https://twitter.com/@tkimutai276">
Titus Kimutai
</a> - <b>Software Tech</b>
</small>
</div>
</div>
<!-- footer -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel Daraja</title>
</head>
<body>
    <div class="container">
       
        <div class="row mt-5">
            <div class="col-sm-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        Obtain Access Token
                    </div>
                    <div class="card-body">
                        <h4 id="access_token"></h4>
                        <button id="getAccessToken" class="btn btn-primary">Request Access Token</button>
                    </div>
                </div>

                <div class="card mt-5">
                    <div class="card-header">Register URLs</div>
                    <div class="card-body">
                        <div id="response"></div>
                        <button id="registerURLS" class="btn btn-primary">Register URLs</button>
                    </div>
                </div>

                <div class="card mt-5">
                    <div class="card-header">Simulate Transaction</div>
                    <div class="card-body">
                        <div id="c2b_response"></div>
                        <form action="">
                            @csrf
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="number" name="amount" class="form-control" id="amount">
                            </div>
                            <div class="form-group">
                                <label for="account">Account</label>
                                <input type="text" name="account" class="form-control" id="account">
                            </div>
                            <button id="simulate" class="btn btn-primary">Simulate Payment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        document.getElementById('simulate').addEventListener('click', (event) => {
            event.preventDefault()

            const requestBody = {
                amount: document.getElementById('amount').value,
                account: document.getElementById('account').value
            }

            axios.post('/simulate', requestBody)
            .then((response) => {
                if(response.data.ResponseDescription){
                    document.getElementById('c2b_response').innerHTML = response.data.ResponseDescription
                } else {
                    document.getElementById('c2b_response').innerHTML = response.data.errorMessage
                }
            })
            .catch((error) => {
                console.log(error);
            })
        })
    </script>
</body>
</html>