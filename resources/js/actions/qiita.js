import {OK} from "../util";

export const LOADING = 'LOADING';
export const GET_ITEMS_SUCCESS = 'GET_ITEMS_SUCCESS';
export const API_REQUEST_FAILURE= 'API_REQUEST_FAILURE';
export const SHOW_NOTICE= 'SHOW_NOTICE';
export const REMOVE_NOTICE= 'REMOVE_NOTICE';

export const getItems = (params) => async dispatch => {
  dispatch({type: LOADING});
  const response = await axios.get(`/api/items?page=${params.page}&per_page=${params.per_page}`);

  if(response.status === OK) {
    dispatch({type: GET_ITEMS_SUCCESS, response});
  } else {
    dispatch({type: API_REQUEST_FAILURE, response});
  }
};

export const removeNotice = ()=> dispatch => {
  dispatch({type: REMOVE_NOTICE}) ;
};

export const importQiita = () => async dispatch => {
  dispatch({type: LOADING});
  const response = await axios.post('/api/importQiita');

  if(response.status === OK) {
    dispatch({type: SHOW_NOTICE, response});
  } else {
    dispatch({type: API_REQUEST_FAILURE, response});
  }
};