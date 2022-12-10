import {
  supabase,
} from '../config/supabase';

export const switchGet = async () => {
  const {
    data,
  } = await supabase
    .from('akuator')
    .select('*')
    .order('id', {
      ascending: false,
    })
    .eq('id', 1)
    .limit(1)
    .single();

  return data;
};

export const switchUpdate = async (newValue) => {
  const {
    data,
  } = await supabase
    .from('akuator')
    .update({
      switch: newValue === 0 ? 1 : 0,
    })
    .eq('id', 1);

  return data;
};
