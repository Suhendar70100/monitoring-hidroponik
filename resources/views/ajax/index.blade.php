@extends('layouts.app')
@section('content')

<div>
  <div class="row justify-content-center p-2 mt-5">
    <div class="col-4">
      <div class="card">
        <div class="card-header bg-danger">
          <h4 class="card-title text-center">Suhu</h4>
        </div>
        <div class="card-body">
          <h4 class="display-4" id="suhu"></h4>
        </div>
      </div>
    </div>
    <div class="col-4">
      <div class="card">
        <div class="card-header bg-primary">
          <h4 class="card-title text-center">Kelembaban</h4>
        </div>
        <div class="card-body">
          <h4 class="display-4" id="kelembaban"></h4>
        </div>
      </div>
    </div>
    <div class="col-4">
      <div class="card">
        <div class="card-header bg-danger">
          <h4 class="card-title text-center">Nilai PH</h4>
        </div>
        <div class="card-body">
          <h4 class="display-4" id="nilaiPh"></h4>
        </div>
      </div>
    </div>
  </div>
  <div class="row d-flex vh-100 justify-content-center align-items-center">
    <div class="col-6 w-100">
      <div id="chart"></div>
    </div>
  </div>
</div>

@endsection
@push('js')
<script>
  $(document).ready(function () {

        setInterval(() => {
            updateData();
        }, 1000);
       
   });

   $(document).ready(function () {

setInterval(() => {
  updateData(); 

}, 1000);

});

$(document).ready(function () {

setInterval(() => {
    updateData();
}, 1000);

});

   function updateData(){
    $.ajax({
        type: "get",
        url: "/updateData",
        dataType: "json",
        success: function (response) {
            $('#suhu').html(response.data.suhu);
            $('#kelembaban').html(response.data.kelembaban);
            $('#nilaiPh').html(response.data.nilai_ph);
        }
    });
   }
</script>

<script>
  var options = {
    chart: {
      type: 'area',
      height: '250px',
      animations: {
            enabled: true,
            easing: 'linear',
            dynamicAnimation: {
              speed: 1000
            }
          }
      
    },
    stroke: {
          curve: 'smooth'
        },
    dataLabels: {
      enabled: false
    },
    series: [{
      name: 'Suhu',
      data: @json($suhu)
    }, {
        name: 'Kelembaban',
        data: @json($kelembaban)
    }],
  }

  var chart = new ApexCharts(document.querySelector("#chart"), options);

  chart.render();

  setInterval(() => {
    $.getJSON("/updateGrafik",
      function (data, textStatus, jqXHR) {
        console.log(data);
        chart.updateSeries([
          {
            name: 'suhu',
            data: data.suhu
          },
          {
            name: 'kelembaban',
            data: data.kelembaban
          },
        ])
      }
    );
  }, 1000);


</script>
@endpush