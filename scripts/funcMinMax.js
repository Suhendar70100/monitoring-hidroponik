/* eslint-disable consistent-return */
/* eslint-disable no-unused-vars */
/* eslint-disable no-plusplus */
/* eslint-disable no-undef */
/* eslint-disable no-const-assign */
import {
  catchData,
} from './dataMinMax';

import {
  supabase,
} from '../config/supabase';

const updateMinMax = async (objElement) => {
  const {
    nilai,
    nilai2,
  } = await catchData();
  // console.log(nilai);

  objElement.nilai.html(nilai);
  objElement.nilai2.html(nilai2);
};

const increment = async () => {
  const dat = document.getElementById('count').textContent;
  // eslint-disable-next-line radix
  const b = parseInt(dat);
  // console.log(typeof (b));
  // console.log(b + 1);
  if (b < 60) {
    // b++;
    // console.log(dat.innerText++);
    console.log(b);
    const {
      data,
    } = await supabase
      .from('minmax')
      .update({
        nilai: b + 1,
      })
      .eq('id', 1);

    return data;
  }
  // console.log(dat.innerText++);

  // eslint-disable-next-line no-unreachable
};

const decrement = async () => {
  const dat = document.getElementById('count').textContent;
  // eslint-disable-next-line radix
  const b = parseInt(dat);
  // console.log(typeof (b));
  // console.log(b + 1);
  if (b > -20) {
    // b++;
    // console.log(dat.innerText++);
    console.log(b);
    const {
      data,
    } = await supabase
      .from('minmax')
      .update({
        nilai: b - 1,
      })
      .eq('id', 1);

    return data;
  }
  // console.log(dat.innerText++);

  // eslint-disable-next-line no-unreachable
};

const increment2 = async () => {
  const dat = document.getElementById('count2').textContent;
  // eslint-disable-next-line radix
  const b = parseInt(dat);
  // console.log(typeof (b));
  // console.log(b + 1);
  if (b < 60) {
    // b++;
    // console.log(dat.innerText++);
    console.log(b);
    const {
      data,
    } = await supabase
      .from('minmax')
      .update({
        nilai2: b + 1,
      })
      .eq('id', 1);

    return data;
  }
  // console.log(dat.innerText++);

  // eslint-disable-next-line no-unreachable
};

const decrement2 = async () => {
  const dat = document.getElementById('count2').textContent;
  // eslint-disable-next-line radix
  const b = parseInt(dat);
  // console.log(typeof (b));
  // console.log(b + 1);
  if (b > -20) {
    // b++;
    // console.log(dat.innerText++);
    console.log(b);
    const {
      data,
    } = await supabase
      .from('minmax')
      .update({
        nilai2: b - 1,
      })
      .eq('id', 1);

    return data;
  }
  // console.log(dat.innerText++);

  // eslint-disable-next-line no-unreachable
};

export {
  // eslint-disable-next-line import/prefer-default-export
  updateMinMax,
  increment,
  decrement,
  increment2,
  decrement2,
};
