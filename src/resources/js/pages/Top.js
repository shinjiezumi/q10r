import React from 'react'
import {connect} from "react-redux";
import About from "./About";
import Home from "./Home";

class Top extends React.Component {
  render() {
    const {user} = this.props;
    const isLogin = !!user.name;
    return (isLogin ? <Home/> : <About/>)
  }
}

const mapStateToProps = state => ({user: state.user});
export default connect(mapStateToProps, null)(Top)