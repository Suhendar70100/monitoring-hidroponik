/* eslint-disable no-plusplus */
import $ from 'jquery';
import './style.css';
import 'bootstrap/dist/js/bootstrap';
import 'bootstrap/dist/css/bootstrap.css';
import {
  ApexGraph,
} from './scripts/dataApexChart';
import {
  updateDataCard,
} from './scripts/funcShowData';
import {
  switcher,
} from './scripts/funcSwitch';
import {
  switchGet,
} from './scripts/dataSwitch';
import {
  updateMinMax,
  increment,
  decrement,
  increment2,
  decrement2,
} from './scripts/funcMinMax';

// import {
//   catchData,
// } from './dataMinMax';

document.querySelector('#app').innerHTML = `
  <h1 class="display-5 fw-normal mt-5 text-center">Automatic <span class="fw-semibold">Hydroponic <br> Monitoring</span> System</h1>
  <div class="row justify-content-center p-2 mt-5 mx-auto mb-5">
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
    <div class="col-xs-8 col-lg-3 col-sm-6">
      <div class="containers">
        <div class="cards">
          <div class="box">
          <div class="frame">

          <button class="btn" id="decrementButton">
              <i class="fas fa-backward"></i>
          </button>
  
          <h1>
              <span id="count"></span>
          </h1>
  
          <button class="btn" id="incrementButton">
              <i class="fas fa-forward"></i>
          </button>
  
      </div>
            <h2 class="text">MIN - MAX</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-8 col-lg-3 col-sm-6">
      <div class="containers">
        <div class="cards">
          <div class="box">
          <div class="frame">

          <button class="btn" id="decrementButton2">
              <i class="fas fa-backward"></i>
          </button>
  
          <h1>
              <span id="count2"></span>
          </h1>
  
          <button class="btn" id="incrementButton2">
              <i class="fas fa-forward"></i>
          </button>
  
      </div>
            <h2 class="text">MIN - MAX</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row justify-content-center p-2 mt-5 mx-auto mb-5">
    <div class="col-xs-8 col-lg-9 col-sm-8">
      <div id="chart"></div>
    </div>
  </div>
`;

const chartElem = document.getElementById('chart');
const nilaiElem = {
  nilai: $('#count'),
  nilai2: $('#count2'),
};
console.log(nilaiElem.nilai);
const switchElem = $('#switcher');
const objElem = {
  suhu: $('#suhu'),
  kelembaban: $('#kelembaban'),
  ph: $('#nilaiPh'),
};

$(async () => {
  const initSwitch = await switchGet();

  switchElem.prop('checked', initSwitch.switch === 1);
  switcher(switchElem);
  updateDataCard(objElem);
  ApexGraph(chartElem);
  document.getElementById('incrementButton').onclick = increment;
  document.getElementById('decrementButton').onclick = decrement;
  document.getElementById('incrementButton2').onclick = increment2;
  document.getElementById('decrementButton2').onclick = decrement2;
  updateMinMax(nilaiElem);
});

setInterval(() => {
  updateDataCard(objElem);
}, 750);

setInterval(() => {
  ApexGraph(chartElem);
}, 2500);

setInterval(() => {
  updateMinMax(nilaiElem);
}, 400);
