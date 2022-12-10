import {
  createClient,
} from '@supabase/supabase-js';

const BASE_URL = import.meta.env.VITE_BASE_URL;
const SUPABASE_KEY = import.meta.env.VITE_SUPABASE_ANON_PUBLIC;

const supabaseUrl = BASE_URL;
const supabaseKey = SUPABASE_KEY;
const supabase = createClient(supabaseUrl, supabaseKey);

export {
  // eslint-disable-next-line import/prefer-default-export
  supabase,
};
