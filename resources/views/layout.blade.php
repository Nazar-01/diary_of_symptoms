<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <title></title>
  </head>
  <body>

    <header class="p-3 mb-3 border-bottom">
      <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

          <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            <li><a href="{{ route('index') }}" class="nav-link px-2 link-secondary">Главная</a></li>
            <li><a href="{{ route('symptoms.index') }}" class="nav-link px-2 link-dark">Симптомы</a></li>
          </ul>

          <div class="dropdown text-end">
            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="{{ asset('assets/img/profile.png') }}" alt="mdo" width="32" height="32" class="rounded-circle">
            </a>
            <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1" style="">

              <!-- <li><a class="dropdown-item" href="#">Профиль</a></li>
              <li><hr class="dropdown-divider"></li> -->
              <li><a class="dropdown-item" href="{{ route('logout') }}">Выход</a></li>
            </ul>
          </div>
        </div>
      </div>
    </header>

    <br>

    <div class="container">
      <div class="row">
        <div class="col-12">

          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          @if (session()->has('error'))
          <div class="alert alert-danger">
            {{ session()->get('error') }}
          </div>
          @endif

          @if (session()->has('success'))
          <div class="alert alert-success">
            {{ session()->get('success') }}
          </div>
          @endif

        </div>
      </div>
    </div>


    @yield('content')

  </body>
</html>
