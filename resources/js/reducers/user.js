import {
  CURRENT_USER,
  LOGOUT
} from "../actions/user";
import {OK} from "../util"

export default (user = {}, action) => {
  const response = action.response;
  switch (action.type) {
    case CURRENT_USER:
      if(response.status === OK) {
        user = response.data;
        return user;
      }
      return user;
    case LOGOUT:
      if(response.status === OK) {
        user = {};
        return user;
      }
      return user;
    default:
      return user;
  }
}