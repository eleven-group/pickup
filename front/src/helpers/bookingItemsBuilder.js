export default products => {
  const bookingItems = [];
  products.forEach(product => {
    const { name, quantity, description, imageUrl, price } = product;
    const bookingItem = {
      quantity: product.ordered,
      price: product.price,
      product: {
        name,
        quantity,
        description,
        imageUrl,
        price
      }
    };
    bookingItems.push(bookingItem);
  });
  return bookingItems;
};
