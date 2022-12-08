@extends('layouts.app')
@section('content')



<div>
  <h1 class="display-5 fw-semibold mt-5 text-center">Automatic <span class="fw-normal">Hydroponic <br> Monitoring</span>
    System</h1>
  <div class="row justify-content-center p-2 mt-5">
    <div class="col-xs-8 col-lg-3 col-sm-6">
      <div class="containers">
        <div class="cards">
          <div class="box">
            <div class="percent">
              <svg class="icon">
                <circle cx="70" cy="70" r="70"></circle>
                <circle cx="70" cy="70" r="70"></circle>
              </svg>
              <div class="number">
                <h2 id="suhu"><span>%</span></h2>
              </div>
            </div>
            <h2 class="text">Suhu</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-8 col-lg-3 col-sm-6">
      <div class="containers">
        <div class="cards">
          <div class="box">
            <div class="percent">
              <svg class="icon">
                <circle cx="70" cy="70" r="70"></circle>
                <circle cx="70" cy="70" r="70"></circle>
              </svg>
              <div class="number">
                <h2 id="kelembaban"><span>%</span></h2>
              </div>
            </div>
            <h2 class="text">Kelembaban</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-8 col-lg-3 col-sm-6">
      <div class="containers">
        <div class="cards">
          <div class="box">
            <div class="percent">
              <svg class="icon">
                <circle cx="70" cy="70" r="70"></circle>
                <circle cx="70" cy="70" r="70"></circle>
              </svg>
              <div class="number">
                <h2 id="nilaiPh"><span>%</span></h2>
              </div>
            </div>
            <h2 class="text">Nilai PH</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-8 col-lg-3 col-sm-6">
      <div class="containers">
        <div class="cards">
          <div class="box">
            <div class="mid">

              <label class="rocker">
                <input id="switcher" type="checkbox">
                <span class="switch-left">On</span>
                <span class="switch-right">Off</span>
              </label>

            </div>
            <h2 class="text">Water Pump</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row d-flex mtt-5 justify-content-center align-items-center">
    <div class="col-6 w-100">
      <div id="chart"></div>
    </div>
  </div>
</div>

@endsection
@push('js')
<script>
  const syncSwitch = () => {
    $.ajax({
        type: "get",
        url: "/api/switcher",
        dataType: "json",
        success: function (res) {
          console.log(res);
          $('#switcher').prop('checked', res.waterpump);
        }
      });
  }

  $(document).ready(function() {
    syncSwitch();
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
            $('#nilaiPh').html(response.data.ph);
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
        // console.log(data);
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

  $('#switcher').click(function (e) { 
    // e.preventDefault();
    console.log(e.target.checked);
    $.post( "/api/switcher/store", { 
      switch: () => e.target.checked ? 1 : 0 
    })
    .done(function( data ) {
      console.log("success");
    });
  });
</script>
@endpush