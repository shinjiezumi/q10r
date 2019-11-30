export const GET_ITEMS = 'GET_ITEMS';

export const getItems = () => async dispatch => {
  const response = await axios.get('/api/items');
  dispatch({type: GET_ITEMS, response});
};