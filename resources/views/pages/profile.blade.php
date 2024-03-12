@extends('layout')
@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link href="{{ asset('assets/css/authorization.css') }}" rel="stylesheet">
<div class="registration-form">
  <form>
    <div class="form-icon">
      <span><i class="icon icon-user"></i></span>
    </div>

    <br><br>

    <div class="form-group">
      <input type="text" class="form-control item" id="email" placeholder="Имя">
    </div>

    <div class="form-group">
      <input type="text" class="form-control item" id="email" placeholder="Фамилия">
    </div>

    <div class="form-group">
      <input type="text" class="form-control item" id="email" placeholder="Возраст">
    </div>

    <div class="form-group">
      <input type="text" class="form-control item" id="email" placeholder="Email">
    </div>

    <div class="form-group">
      <input type="password" class="form-control item" id="password" placeholder="Пароль">
    </div>

    <div class="form-group">
      <input type="password" class="form-control item" id="password" placeholder="Повторите пароль">
    </div>

    <br>

    <div class="form-group">
      <button type="button" class="btn btn-block create-account">Вход</button>
    </div>

    <br>

    <center>
      <a href="#">Авторизация</a>
    </center>
  </form>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

@endsection
