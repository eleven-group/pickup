export default (shop, item, day) => {
  if (checkPartDay(shop, item, day, 'morning') ||
        checkPartDay(shop, item, day, 'afternoon')) {
    return true;
  }
  return false;
};

const checkPartDay = (shop, item, day, part) => {
  if (shop[item][day][part] && (shop[item][day][part].opening &&
      shop[item][day][part].closing)) {
    return true;
  }
  return false;
};

export {
  checkPartDay
};
