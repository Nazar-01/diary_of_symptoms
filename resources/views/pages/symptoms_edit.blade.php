@extends('layout')
@section('content')

<link href="{{ asset('assets/css/authorization.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/symptoms_add.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/symptoms_edit.css') }}" rel="stylesheet">

<div class="container">
  <div class="row">
    <div class="col-12">
      <br>
      <center><h1>Редактирование симптома</h1></center>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-12">

      <div class="registration-form">
        <form method="POST" action="{{ route('symptoms.update', $symptom['id']) }}">
          @csrf
          @method('PUT')

          <br><br>

          <div class="form-group">
            <input name="name" type="text" class="form-control item" placeholder="Название" value="{{ $symptom['name'] }}">
          </div>

          <div class="form-group">
            <textarea class="form-control item" name="description" rows="8" cols="80" placeholder="Описание">{{ $symptom['description'] }}</textarea>
          </div>

          <div class="form-group">
            <select name="rating" id="mySelect" class="form-select">
              <option selected>Насколько выраженный симптом</option>
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

          <div class="form-group btns">
            <button class="btn btn-block create-account">Сохранить</button>
          </div>

          <br>

        </form>
      </div>

    </div>
  </div>
</div>

<script type="text/javascript">
var selectElement = document.getElementById("mySelect");
selectElement.value = {{ $symptom['rating'] }};
</script>

@endsection
