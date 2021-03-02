export const CURRENT_USER = 'CURRENT_USER';
export const LOGOUT = 'LOGOUT';

export const currentUser = () => async dispatch => {
  const response = await axios.get('/api/user');
  dispatch({type: CURRENT_USER, response});
};

export const logout = () => async dispatch => {
  const response = await axios.post('/api/logout');
  dispatch({type: LOGOUT, response});
};
