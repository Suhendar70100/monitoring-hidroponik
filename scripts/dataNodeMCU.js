import {
  supabase,
} from '../config/supabase';

export const arrGet = async () => {
  const {
    data,
  } = await supabase
    .from('data')
    .select('*')
    .order('id', {
      ascending: false,
    })
    .limit(20);

  const suhu = data.map((e) => e.suhu);
  const kelembaban = data.map((e) => e.kelembaban);
  const ph = data.map((e) => e.ph);

  return {
    suhu,
    kelembaban,
    ph,
  };
};

export const singleGet = async () => {
  const {
    data,
  } = await supabase
    .from('data')
    .select('*')
    .order('id', {
      ascending: false,
    })
    .limit(1);

  return data[0];
};
