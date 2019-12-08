import {
  GET_ITEMS_SUCCESS,
  IMPORT,
  LOADING,
  API_REQUEST_FAILURE,
  REMOVE_NOTICE
} from "../actions/qiita";

const initialState = {
  isLoading: false,
  isNotice: false,
  items: [],
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
    case REMOVE_NOTICE:
      return {
        ...state,
        isNotice: false
      };
    // TODO
    // case IMPORT:
    //   if(response.status === OK) {
    //     return {result: 'OK'};
    //   }
    default:
      return state;
  }
}