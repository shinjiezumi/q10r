import React from 'react'
import Navbar from '../components/Navbar'
import Footer from "../components/Footer";
import {connect} from "react-redux";
import {Field, reduxForm} from 'redux-form';
import {
  Box,
  Button,
  Checkbox,
  Container,
  CssBaseline,
  FormControlLabel,
  Link,
  TextField,
  Typography,
  withStyles,
} from "@material-ui/core";
import {compose} from "recompose";
import {Link as RouterLink} from 'react-router-dom';

const styles = {
  main: {
    display: 'flex',
    flexDirection: 'column',
    height: '100vh',
  },
  content: {
    flex: '1 0 auto'
  },
  '@global': {
    body: {
      backgroundColor: '#FFF',
    },
  },
  box: {
    textAlign: 'center',
  },
  link: {
    textDecoration: 'none'
  },
  paper: {
    marginTop: '10px',
    display: 'flex',
    flexDirection: 'column',
    alignItems: 'center',
  },
  form: {
    width: '100%', // Fix IE 11 issue.
    marginTop: '10px',
  },
  row: {
    margin: '1rem',
  },
  submit: {
    marginTop: '10px',
  },
};


class Login extends React.Component {
  constructor(props) {
    super(props);
    this.onSubmit = this.onSubmit.bind(this);
  }

  async onSubmit(values) {
    // todo
    // await this.props.postEvent(values);
    // this.props.history.push('/')
  }

  render() {
    const {handleSubmit, pristine, submitting, invalid} = this.props;
    const classes = this.props.classes;

    return (
      <React.Fragment>
        <CssBaseline />
        <Navbar conponent="header"/>
        <Container component="main" maxWidth="xs" className={classes.main}>
          <div className={classes.paper}>
            <Typography component="h1" variant="h5">
              ログイン
            </Typography>
            <Button
              fullWidth
              variant="contained"
              color="primary"
              className={classes.submit}
            >
              <Link
                href="/login/qiita"
                color="textPrimary"
              >
                Qiitaアカウントでログイン
              </Link>
            </Button>
          </div>
        </Container>

        {/*<Container>*/}
        {/*  <form onSubmit={handleSubmit(this.onSubmit())}>*/}
        {/*  </form>*/}
        {/*</Container>*/}
        <Footer/>
      </React.Fragment>
    )
  }
}

const validate = values => {
  const errors = {};

  if (!values.title) errors.title = 'Enter a title, please.';
  if (!values.body) errors.body = 'Enter a body, please.';

  return errors;
};

const enhance = compose(connect(null, null), reduxForm({validate, form: 'loginForm'}), withStyles(styles));

export default enhance(Login)
