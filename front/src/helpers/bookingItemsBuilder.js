export default products => {
  const bookingItems = [];
  products.forEach(product => {
    const { ordered, price, id } = product;
    const bookingItem = {
      quantity: ordered,
      price: price,
      product: id
    };
    bookingItems.push(bookingItem);
  });
  return bookingItems;
};
