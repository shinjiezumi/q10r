import React from 'react'
import {Button, Container, Typography} from '@material-ui/core';
import {makeStyles} from '@material-ui/core/styles';
import {GitHub, Twitter} from '@material-ui/icons';

const useStyles = makeStyles((theme) => ({
  container: {
    paddingTop: theme.spacing(10),
    paddingBottom: theme.spacing(10),
  },
  button: {
    margin: theme.spacing(1),
  },
}));

function App() {
  const classes = useStyles();

  return (
    <Container className={classes.container} maxWidth="md">
      <Typography variant="h2" align="center" color="primary" gutterBottom>
        Welcome to My App
      </Typography>
      <Typography variant="h5" align="center" color="textSecondary" paragraph>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
        magna aliqua.
      </Typography>
      <div align="center">
        <Button
          className={classes.button}
          variant="contained"
          color="primary"
          startIcon={<GitHub/>}
          href="https://github.com/"
        >
          GitHub
        </Button>
        <Button
          className={classes.button}
          variant="outlined"
          color="primary"
          startIcon={<Twitter/>}
          href="https://twitter.com/"
        >
          Twitter
        </Button>
      </div>
    </Container>
  );
}

export default App;
