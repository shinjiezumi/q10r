import React from 'react'
import Header from '../components/Header'
import Footer from "../components/Footer";
import {Container, CssBaseline, makeStyles, Typography} from "@material-ui/core";

const useStyles = makeStyles(theme => ({
  main: {
    display: 'flex',
    flexDirection: 'column',
    height: '100vh',
  },
  content: {
    flex: '1 0 auto'
  },
}));

export default function Home() {
  const classes = useStyles();
  return (
    <React.Fragment>
      <CssBaseline />
      <Header />
      <Container component="main" maxWidth="xs" className={classes.main}>
        <Typography component="h1" variant="h5">
          ホーム
        </Typography>
      </Container>
      <Footer />
    </React.Fragment>
  )
}