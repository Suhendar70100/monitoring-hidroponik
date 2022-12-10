import {
  switchGet,
  switchUpdate,
} from './dataSwitch';

const switcher = async (element) => {
  element.click(async () => {
    const dataGet = await switchGet();
    await switchUpdate(dataGet.switch);
  });
};

export {
  // eslint-disable-next-line import/prefer-default-export
  switcher,
};
