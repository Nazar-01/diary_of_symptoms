@extends('layout')
@section('content')

<link href="{{ asset('assets/css/authorization.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/symptoms_add.css') }}" rel="stylesheet">

<div class="container">
  <div class="row">
    <div class="col-12">
      <br>
      <center><h1>Добавление симптома</h1></center>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-12">

      <div class="registration-form">
        <form method="POST" action="{{ route('symptoms.store') }}">
          @csrf

          <br><br>

          <div class="form-group">
            <input name="name" type="text" class="form-control item" placeholder="Название">
          </div>

          <div class="form-group">
            <textarea class="form-control item" name="description" rows="8" cols="80" placeholder="Описание"></textarea>
          </div>

          <div class="form-group">
            <select required name="rating" class="form-select">
              <option value="" selected>Насколько выраженный симптом</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
            </select>
          </div>

          <br>

          <div class="form-group">
            <button class="btn btn-block create-account">Сохранить</button>
          </div>

          <br>

        </form>
      </div>

    </div>
  </div>
</div>

@endsection
