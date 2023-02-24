import React from 'react'
import Header from '../components/Header'
import Footer from "../components/Footer";
import {Box, Button, Container, Link, makeStyles,} from "@material-ui/core";
import {APP_NAME} from "../constants";

const useStyles = makeStyles(theme => ({
  '@global': {
    body: {
      backgroundColor: '#FFF',
    },
  },
  main: {
    display: 'flex',
    flexDirection: 'column',
    textAlign: 'center'
  },
  content: {
    flex: '1 0 auto'
  },
  button: {
    width: '300px'
  }
}));

export default function Login() {
  const classes = useStyles();

  return (
    <React.Fragment>
      <Header conponent="header"/>
      <Box component="main">
        <Container className={classes.main}>
          <Box m={10}>
            {APP_NAME}を利用するためにはQiitaアカウントでログインする必要があります。
          </Box>
          <Box mb={20}>
            <Button variant="contained" color="primary" className={classes.button}>
              <Link href="/login/qiita" color="textSecondary">
                Qiitaアカウントでログイン
              </Link>
            </Button>
          </Box>
        </Container>
      </Box>
      <Footer/>
    </React.Fragment>
  )
}
