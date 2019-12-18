import {
  GET_ITEMS_SUCCESS,
  LOADING,
  API_REQUEST_FAILURE,
  SHOW_NOTICE,
  REMOVE_NOTICE
} from "../actions/qiita";

const initialState = {
  isLoading: false,
  isNotice: false,
  items: [],
  error: null
};

export default (state = initialState, action) => {
  const response = action.response;

  switch (action.type) {
    case LOADING:
      return {
        ...state,
        isLoading: true,
        items: [],
      };
    case GET_ITEMS_SUCCESS:
      return {
        ...state,
        isLoading: false,
        items: response.data,
      };
    case API_REQUEST_FAILURE:
      return {
        ...state,
        isLoading: false,
        error: 'エラーが発生しました',
        isNotice: true
      };
    case SHOW_NOTICE:
      return {
        ...state,
        message: response.data.message,
        isLoading: false,
        isNotice: true
      };
    case REMOVE_NOTICE:
      return {
        ...state,
        isNotice: false
      };
    default:
      return state;
  }
}