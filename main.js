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
  </div>
  <div class="row justify-content-center p-2 mt-5 mx-auto mb-5">
    <div class="col-xs-8 col-lg-9 col-sm-8">
      <div id="chart"></div>
    </div>
  </div>
`;

const chartElem = document.getElementById('chart');
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
});

setInterval(() => {
  updateDataCard(objElem);
  ApexGraph(chartElem);
}, 2500);
