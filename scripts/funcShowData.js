import {
  singleGet,
} from './dataNodeMCU';

const updateDataCard = async (objElement) => {
  const {
    suhu,
    kelembaban,
    ph,
  } = await singleGet();

  objElement.suhu.html(suhu.toFixed(2));
  objElement.kelembaban.html(kelembaban.toFixed(2));
  objElement.ph.html(ph.toFixed(2));
};

export {
  // eslint-disable-next-line import/prefer-default-export
  updateDataCard,
};
