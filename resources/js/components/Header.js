import React from 'react'
import {withStyles} from '@material-ui/core/styles';
import AppBar from '@material-ui/core/AppBar';
import Toolbar from '@material-ui/core/Toolbar';
import Typography from '@material-ui/core/Typography';
import Button from '@material-ui/core/Button';
import {Link} from 'react-router-dom';
import {Box} from "@material-ui/core";
import {APP_NAME} from "../constants";
import {compose} from "recompose";
import {connect} from "react-redux";
import {currentUser, logout} from "../actions/user";

const styles = {
  root: {
    flexGrow: 1,
  },
  menuButton: {
    marginRight: '2rem',
  },
  title: {
    flexGrow: 1,
  },
  link: {
    color: '#000',
    textDecoration: 'none',
    padding: '1rem',
    '&:hover': {
      color: '#000',
      textDecoration: 'none',
    }
  },
};

class Header extends React.Component {
  constructor(props) {
    super(props);
    this.logout = this.logout.bind(this);
  }

  componentDidMount() {
    this.props.currentUser();
  }

  async logout() {
    const {logout, history} = this.props;

    await logout();
    history.push('/');
  }

  render() {
    const {classes, user} = this.props;
    const isLogin = !!user.name;

    return (
      <Box className={classes.root}>
        <AppBar position="static">
          <Toolbar>
            <Typography component="h1" variant="h6" className={classes.title} color="inherit">
              <Link to="/" className={classes.link}>{APP_NAME}</Link>
            </Typography>
            {!isLogin ?
              <Link to="/login" className={classes.link}>ログイン</Link> :
              <Button className={classes.link} onClick={this.logout}>ログアウト</Button>
            }
            <Link to="https://s9i.work/contact" className={classes.link}>お問い合わせ</Link>
          </Toolbar>
        </AppBar>
      </Box>
    )
  }
}

const mapStateToProps = state => ({user: state.user});
const mapDispatchToProps = ({currentUser, logout});
const enhance = compose(connect(mapStateToProps, mapDispatchToProps), withStyles(styles));

export default enhance(Header);