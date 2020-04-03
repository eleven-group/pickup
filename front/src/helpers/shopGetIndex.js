export default (shops, { name, lng, lat }) => {
  let res = '';
  shops.shops.forEach((shop, index) => {
    if (shop.name === name && shop.longitude === lng.toString() && shop.latitude === lat.toString()) res = index;
  });
  return res;
};
