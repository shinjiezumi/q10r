import {combineReducers} from "redux";
import user from "./user";
import qiita from "./qiita";

export default combineReducers({user, qiita});