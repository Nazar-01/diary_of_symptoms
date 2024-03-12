@extends('layout')
@section('content')

<div class="container">
  <div class="row">

    <div class="col border border-info border-2">
      <h4>Недельный индес стресса</h4>
      <div class="hit-the-floor">{{ $data_index }}</div>
      <br>
    </div>

    <!-- <div class="w-100"> <br><br> </div> -->

    <div class="col p-0">
      <div class="border border-info border-2 p-2">
        <h4>График недельного контроля симптомов</h4>
        <div class="ct-chart2 ct-perfect-fourth"></div>
      </div>
    </div>

    <div class="w-100"> <br><br> </div>

    <div class="col-12 p-0">
      <div id="gr-1">
        <div class="border border-info border-2 p-2">
          <h4>График изменения индекса стресса</h4>
          <div class="ct-chart ct-golden-section" id="line-chart"></div>
        </div>
      </div>

      <div id="gr-2">
        <div class="border border-info border-2 p-2">
          <h4>График изменения индекса стресса</h4>
          <div class="ct-chart ct-golden-section" id="line-chart2"></div>
        </div>
      </div>

      <div>
        <button id="btn-1" class="btn btn-primary">День</button>
        <button id="btn-2" class="btn btn-outline-primary">Месяц</button>
      </div>

    </div>

  </div>
</div>

<link rel="stylesheet" href="{{ asset('/assets/css/chartist.min.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/main_page.css') }}">
<script src="{{ asset('/assets/js/chartist.min.js') }}"></script>



<script>

function drawData(dataFromBack, id) {
  document.addEventListener('DOMContentLoaded', function() {

    var data_mounth = dataFromBack;

    var labels = [];
    var series = [[]];

    for (var date in data_mounth) {
      if (data_mounth.hasOwnProperty(date)) {
        labels.push(date);
        series[0].push(parseFloat(data_mounth[date]));
      }
    }

    var data = {
      labels: labels,
      series: series
    };

    var options = {

    };

    new Chartist.Line(id, data, options);
  });
}

drawData({!! json_encode($data_mounth) !!}, '#line-chart2');
drawData({!! json_encode($data_day) !!}, '#line-chart');

</script>

<script>

var data = {
  series: [{{ $data_colors['green'] }}, {{ $data_colors['red'] }}, {{ $data_colors['yellow'] }}]
};

if (data.series.length === 0 || data.series.every(item => item === undefined)) {
    data = 0;
}

var options = {
  donut: true,
  donutWidth: 50,
  donutSolid: true,
  startAngle: 270,
  showLabel: true,
  labelInterpolationFnc: function(value) {
    return value + '%';
  }
};

new Chartist.Pie('.ct-chart2', data, options);
</script>

<script>
document.getElementById('btn-1').addEventListener('click', function() {
  document.getElementById('btn-1').classList.add('btn-primary');
  document.getElementById('btn-1').classList.remove('btn-outline-primary');
  document.getElementById('btn-2').classList.remove('btn-primary');
  document.getElementById('btn-2').classList.add('btn-outline-primary');
  document.getElementById('gr-1').style.display = 'block';
  document.getElementById('gr-2').style.display = 'none';
});

document.getElementById('btn-2').addEventListener('click', function() {
  document.getElementById('btn-2').classList.add('btn-primary');
  document.getElementById('btn-2').classList.remove('btn-outline-primary');
  document.getElementById('btn-1').classList.remove('btn-primary');
  document.getElementById('btn-1').classList.add('btn-outline-primary');
  document.getElementById('gr-2').style.display = 'block';
  document.getElementById('gr-1').style.display = 'none';
  document.getElementById('gr-2').style.opacity = '1';
});

setTimeout(() => {
  document.getElementById('btn-1').click();
}, 300);
</script>

@endsection
