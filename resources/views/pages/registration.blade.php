@extends('displaying_information')
@section('info')

<div class="registration-form">
  <form method="POST" action="{{ route('user-create') }}">

    @csrf

    <div class="form-icon">
      <span><i class="icon icon-user"></i></span>
    </div>

    <br><br>

    <div class="form-group">
      <input name="first_name" type="text" class="form-control item" id="email" placeholder="Имя">
    </div>

    <div class="form-group">
      <input name="last_name" type="text" class="form-control item" id="email" placeholder="Фамилия">
    </div>

    <div class="form-group">
      <input name="age" type="text" class="form-control item" id="email" placeholder="Возраст">
    </div>

    <div class="form-group">
      <input name="email" type="text" class="form-control item" id="email" placeholder="Email">
    </div>

    <div class="form-group">
      <input name="password" type="password" class="form-control item" id="password" placeholder="Пароль">
    </div>

    <div class="form-group">
      <input name="password_confirmation" type="password" class="form-control item" id="password" placeholder="Повторите пароль">
    </div>

    <br>

    <div class="form-group">
      <button class="btn btn-block create-account">Регистрация</button>
    </div>

    <br>

    <center>
      <a href="{{ route('login-page') }}">Авторизация</a>
    </center>
  </form>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

@endsection
