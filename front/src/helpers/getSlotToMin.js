export default slot => {
  const hours = slot.substring(1, 2);
  const minutes = slot.substring(3);
  return (parseInt(hours) * 60) + parseInt(minutes);
};
