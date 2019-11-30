import {
  GET_ITEMS
} from "../actions/qiita";
import {OK} from "../util";

export default (items = {}, action) => {
  const response = action.response;
  switch (action.type) {
    case GET_ITEMS:
      if(response.status === OK) {
        items = response.data;
        return items;
      }
      return items;
    default:
      return items;
  }
}