<!doctype html>
<html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <!-- css -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/produk.css">
    <link rel="stylesheet" href="/css/profile.css">
    <link rel="stylesheet" href="/css/brandsection.css">

    <!-- fa -->
    <link rel="stylesheet" href="/fontawesome-free/css/all.min.css">
    <style>
    .badge {
      font-size: 8px;
      vertical-align: top;
      margin-left: -0.8em;
    }

    </style>
    <title>Campzone.co</title>

  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <!-- Left navbar links -->
        <a class="navbar-brand" href="/home">
          <img src="/img/brand2.png" alt="">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
          aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <ul class="navbar-nav">
            <li class="nav-item d-none d-sm-inline-block">
              <a class="nav-link" href="/home">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
              <a class="nav-link" href="/produk">Produk</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
              <a class="nav-link" href="/kontak">Kontak</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
              <a class="nav-link" href="#">Syarat & Ketentuan</a>
            </li>

          </ul>

          <!-- Right navbar links -->
          <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
            <a class="nav-item nav-link btn btn-warning mr-2" data-toggle="modal" data-target="#loginModal">
              {{ __('Login') }}
            </a>
            <!-- <a class="nav-item nav-link btn btn-warning mr-3" href="{{ route('login') }}">{{ __('Login') }}</a> -->
            @if (Route::has('register'))

            <a class="nav-item nav-link btn btn-warning" href="{{ route('register') }}">{{ __('Register') }}</a>

            @endif
            @else
            <?php
                $pesanan_baru = \App\Pesanan::where('user_id', Auth::user()->id)->whereNull('bukti_pembayaran')->first();
                if(!empty($pesanan_baru))
                {
                    $notif = \App\PesananDetail::where('pesanan_id',$pesanan_baru->id)->count();
                }
            ?>
            <a class="nav-item nav-link ml-3 mr-3 " href="{{url('checkout')}}">
              <i class="fas fa-cart-plus"></i>
              @if(!empty($notif))
              <span class="badge badge-danger navbar-badge">{{ $notif }}</span>
              @endif
            </a>
            <a class="nav-item nav-link fas fa-envelope mt-1 mr-3" href="#msg"></a>
            <a class="nav-item nav-link text-gray fas fa-bell mt-1 mr-3" href="#notif">

            </a>
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ url('profil') }}"><i class="fa fa-user"></i> Profil</a>
                <a class="dropdown-item" href="{{ url('pembayaran') }}"><i class="fa fa-money-check-alt"></i>
                  Pembayaran</a>
                <a class="dropdown-item" href="{{ url('pesanan') }}"><i class="fa fa-history"></i> Riwayat Transaksi</a>


                <a class="btn btn-xs btn-danger mt-3 w-100" href="{{ route('logout') }}" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>
    @yield('konten')



    <!-- Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Login</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{ route('login') }}">
              @csrf

              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                <div class="col-md-6">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                  @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">

                  @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                      {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                      {{ __('Remember Me') }}
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-warning">
                    {{ __('Login') }}
                  </button>
                  <div class="mt-2">
                    @if (Route::has('password.request'))
                    <a class="btn-link" href="{{ route('password.request') }}">
                      {{ __('Forgot Your Password?') }}
                    </a>
                  </div>
                  @endif
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- footer -->
    <footer class="mt-5 bg-light">
      <span>©Copyright Campzone 2020. Allrights Reserved.</span>
    </footer>
    <!-- end footer -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="/js/jquery.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>

    @yield('scripts')
  </body>

</html>
