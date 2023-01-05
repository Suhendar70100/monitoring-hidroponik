import {
  supabase,
} from '../config/supabase';
// import {
//   updateNilai,
//   updateNilai2,
//   // eslint-disable-next-line import/no-unresolved
// } from './scripts/funcMinMax';

// eslint-disable-next-line import/prefer-default-export
export const catchData = async () => {
  const {
    data,
  } = await supabase
    .from('minmax')
    .select('*')
    .order('id', {
      ascending: false,
    })
    .eq('id', 1)
    .limit(1);

  return data[0];
};

// export const dataUpdate = async () => {
//   const {
//     data,
//   } = await supabase
//     .from('minmax')
//     .update({ nilai, nilai2 })
//     .eq('id', 1);

//   return data[0];
// };
