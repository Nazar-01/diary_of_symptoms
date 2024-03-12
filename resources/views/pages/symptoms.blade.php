@extends('layout')
@section('content')

<link href="{{ asset('assets/css/symptoms.css') }}" rel="stylesheet">

<br>
<center>
  <h1>Симптомы</h1>
</center>
<br>

<div class="container">
  <div class="row">
    <div class="col-12">
      <ul class="list-group">

        @foreach($symptoms_array as $date => $symptoms)

        <p class="text-muted">
          {{$date}}
        </p>

        @foreach($symptoms as $key => $symptom)
        <li class="list-group-item

        @if ($symptom['rating'] <= 3)
        list-group-item-success
        @elseif (3 < $symptom['rating'] and $symptom['rating'] <= 6)
        list-group-item-warning
        @else
        list-group-item-danger
        @endif">

        <a href="{{ route('symptoms.show', $symptom['id']) }}">
          <p class="fw-bold">{{ $symptom['name'] }}</p>
          <p class="second_p">{{ Str::limit($symptom['description'], 100) }}</p>
        </a>

        <form action="{{ route('symptoms.destroy', $symptom['id']) }}" method="POST">
          @csrf
          @method('DELETE')
          <button onclick="myConfirm(this, event)" data-id="{{ $symptom['id'] }}" class="btn btn-danger btn-sm">Удалить</button>
        </form>
      </li>
      @endforeach

      @endforeach

    </ul>

  </div>
</div>
</div>

<a href="{{ route('symptoms.create') }}">
  <div class="add_symptom">
    +
  </div>
</a>

@endsection

@php
$lastKeyDate = key(array_slice($symptoms_array, -1, 1, true));
@endphp

<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>

<script type="text/javascript">
let currentDate = '{{ $lastKeyDate }}';
let currentPage = 1;
let requestInProgress = false;
$(window).scroll(function() {
  if($(window).scrollTop() + $(window).height() >= $(document).height() && !requestInProgress) {
    requestInProgress = true;
    currentPage++;
    $.ajax({
      url: "{{ route('symptoms.load-more') }}?page=" + currentPage,
      type: 'get',
      success: function(response) {
        if (typeof response.data === 'object' && !Array.isArray(response.data) && response.data !== null) {

          // Получаем ссылку на ul элемент, куда будем вставлять новые данные
          const ul = document.querySelector('.list-group');

          // Перебираем объект new_data
          for (const new_date in response.data) {
            const symptoms = response.data[new_date];

            // Создаем элемент для отображения даты
            const dateElement = document.createElement('p');
            dateElement.className = 'text-muted';
            if (new_date != currentDate) {
              currentDate = new_date;
              dateElement.textContent = new_date;
              ul.appendChild(dateElement);
            }

            // Перебираем симптомы для текущей даты
            symptoms.forEach(symptom => {
              // Создаем элемент для отображения симптома
              const li = document.createElement('li');
              li.className = 'list-group-item';
              if (symptom.rating <= 3) {
                li.classList.add('list-group-item-success');
              } else if (symptom.rating > 3 && symptom.rating <= 6) {
                li.classList.add('list-group-item-warning');
              } else {
                li.classList.add('list-group-item-danger');
              }

              const nameElement = document.createElement('p');
              nameElement.className = 'fw-bold';
              nameElement.textContent = symptom.name;

              const link = document.createElement("a");
              const responseId = symptom.id;
              link.href = "{{ route('symptoms.show', ['symptom' => ':responseId']) }}".replace(':responseId', responseId);
              link.appendChild(nameElement);

              const descriptionElement = document.createElement('p');
              descriptionElement.className = 'second_p';
              link.appendChild(descriptionElement);

              try {
                if ((symptom.description).length >= 100) {
                  descriptionElement.textContent = (symptom.description).slice(0, 100) + '...';
                }
                else {
                  descriptionElement.textContent = symptom.description;
                }
              } catch (e) {

              }

              var form = document.createElement('form');
              form.action = "{{ route('symptoms.destroy', ['symptom' => ':responseId']) }}".replace(':responseId', responseId);
              form.method = "POST";

              // Добавляем скрытое поле для CSRF-токена
              var csrfTokenInput = document.createElement('input');
              csrfTokenInput.type = 'hidden';
              csrfTokenInput.name = '_token';
              csrfTokenInput.value = "{{ csrf_token() }}";
              form.appendChild(csrfTokenInput);

              // Добавляем скрытое поле для метода DELETE
              var methodInput = document.createElement('input');
              methodInput.type = 'hidden';
              methodInput.name = '_method';
              methodInput.value = 'DELETE';
              form.appendChild(methodInput);

              // Создаем кнопку
              var button = document.createElement('button');
              button.className = "btn btn-danger btn-sm";
              button.setAttribute('onclick', 'myConfirm(this, event)');
              button.setAttribute('data-id', responseId);
              button.textContent = "Удалить";
              form.appendChild(button);

              li.appendChild(link);
              li.appendChild(form);
              ul.appendChild(li);
              setTimeout(() => {requestInProgress = false;}, 500);
            });
          }
        }
      }
    });
  }
});
</script>

<script>
function myConfirm(element, event) {
  event.preventDefault();
  if (confirm('Вы уверены что хотите удалить запись?')) {
      const recordId = element.getAttribute('data-id');
      const button = document.querySelector(`button[data-id="${recordId}"]`);
      const form = button.closest('form');
      console.log(form);
      if (form) {
          form.submit();
      }
  }
}
</script>
