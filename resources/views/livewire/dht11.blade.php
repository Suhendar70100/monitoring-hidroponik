<div>
  {{-- <pre>
    {{ print_r($suhu) }}
  </pre> --}}
  {{-- {{ $data }} --}}
  {{-- <input type="text" wire:model="data_akhir"> --}}
  <h1 class="text-center">CURRENT TIME</h1>
  <div wire:poll="data" class="row justify-content-center my-5">
    <div class="col-sm-4">
      <div class="card">
        <div class="card-header bg-primary text align-center">
          <h1 style="text-align: center">SUHU</h1>
        </div>
        <div class="card-body">
          <h1 class="display-4" style="text-align: center">
            {{ $data_akhir }}
          </h1>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card">
        <div class="card-header bg-primary text align-center">
          <h1 style="text-align: center">KELEMBABAN</h1>
        </div>
        <div class="card-body">
          <h1 class="display-4" style="text-align: center">
            {{ $data_kelembaban }}
          </h1>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
        <div class="w-full">
            <div class="px-10" id="chart"></div>
        </div>
    </div>
</div>

@push('js')
<script>
     var options = {
    chart: {
      type: 'line',
      height: '250px',
    },
    series: [{
      name: 'sales',
      data: @json($subscriber)
    }],
    xaxis: {
      categories: @json($days)
    },
    stroke: {
curve: 'smooth',
}
  }
  
  var chart = new ApexCharts(document.querySelector("#chart"), options);
  
  chart.render();

  // document.addEventListener('livewire:load', () => {
  //   @this.on('refreshChart', (chartData) => {
  //     chart.updateSeries([[
  //       data: chartData.seriesData
  //     ]])
  //   })
  // })
</script>
    
@endpush
</div>

</div>

   