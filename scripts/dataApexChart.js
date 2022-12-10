import ApexCharts from 'apexcharts';
import {
  arrGet,
} from './dataNodeMCU';

const ApexGraph = async (selector) => {
  const {
    suhu,
    kelembaban,
    ph,
  } = await arrGet();

  const chart = new ApexCharts(selector, {
    chart: {
      type: 'area',
      height: '500px',
      animations: {
        enabled: true,
        easing: 'ease-out',
        dynamicAnimation: {
          speed: 100,
        },
      },

    },
    stroke: {
      curve: 'smooth',
    },
    dataLabels: {
      enabled: false,
    },
    series: [{
      name: 'Suhu',
      data: suhu,
    }, {
      name: 'Kelembaban',
      data: kelembaban,
    }, {
      name: 'PH',
      data: ph,
    }],
  });

  await chart.render();
  await chart.updateSeries([{
    name: 'Suhu',
    data: suhu,
  }, {
    name: 'Kelembaban',
    data: kelembaban,
  }, {
    name: 'PH',
    data: ph,
  }]);
};

export {
  // eslint-disable-next-line import/prefer-default-export
  ApexGraph,
};
