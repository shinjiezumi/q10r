/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');

import {createMuiTheme, MuiThemeProvider} from "@material-ui/core";
import 'ress'
import React from 'react'
import ReactDOM from 'react-dom'
import {createStore, applyMiddleware} from 'redux'
import {Provider} from 'react-redux'
import thunk from 'redux-thunk'
import {BrowserRouter, Route, Switch} from 'react-router-dom'
import {composeWithDevTools} from 'redux-devtools-extension'
import {library} from '@fortawesome/fontawesome-svg-core'
import {fab} from '@fortawesome/free-brands-svg-icons'
import {fas} from '@fortawesome/free-solid-svg-icons'
import {far} from '@fortawesome/free-regular-svg-icons'
import {green} from '@material-ui/core/colors'
import reducer from './reducers'
import Top from './pages/Top'
import Login from './pages/Login'
import QiitaImport from './pages/QiitaImport'

const enhancer = process.env.NODE_ENV === 'development' ? composeWithDevTools(applyMiddleware(thunk)) : applyMiddleware(thunk);
const store = createStore(reducer, enhancer);

library.add(fab, fas, far);

const theme = createMuiTheme({
  palette: {
    primary: green,
  },
});

ReactDOM.render(
  <MuiThemeProvider theme={theme}>
    <Provider store={store}>
      <BrowserRouter>
        <Switch>
          <Route exact path="/" component={Top}/>
          <Route exact path="/login" component={Login}/>
          {/*<Route exact path="/qiitaImport" component={QiitaImport}/>*/}
        </Switch>
      </BrowserRouter>
    </Provider>
  </MuiThemeProvider>,
  document.getElementById('app')
);