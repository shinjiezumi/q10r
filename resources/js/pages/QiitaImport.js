import React from 'react'
import Header from '../components/Header'
import Footer from "../components/Footer";
import {
  Box,
  Button,
  Container,
  withStyles,
} from "@material-ui/core";
import {connect} from "react-redux";
import {compose} from "recompose";
import {importQiita} from "../actions/qiita";

const styles = {
  '@global': {
    body: {
      backgroundColor: '#FFF',
    },
  },
  main: {
    display: 'flex',
    flexDirection: 'column',
    // height: '100vh',
    textAlign: 'center'
  },
  content: {
    flex: '1 0 auto'
  },
  button: {
    width: '300px'
  }
};

class QiitaImport extends React.Component {
  render() {
    const {classes} = this.props;

    const importQiita = () => {
      this.props.importQiita();
    };

    return (
      <React.Fragment>
        <Header conponent="header"/>
        <Box component="main">
          <Container className={classes.main}>
            <Box mt={20} mb={20}>
              <Button variant="contained" color="primary" className={classes.button} onClick={importQiita}>
                Qiitaインポート
              </Button>
            </Box>
          </Container>
        </Box>
        <Footer/>
      </React.Fragment>
    )
  }
}

const mapStateToProps = state => ({result: state.result});
const mapDispatchToProps = ({importQiita});
const enhance = compose(connect(mapStateToProps, mapDispatchToProps), withStyles(styles));

export default enhance(QiitaImport);