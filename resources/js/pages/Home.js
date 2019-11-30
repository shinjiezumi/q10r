import React from 'react'
import _ from "lodash"
import Header from '../components/Header'
import Footer from "../components/Footer";
import {Box, Container, CssBaseline, Link, Typography, withStyles} from "@material-ui/core";
import {connect} from "react-redux";
import {compose} from "recompose";
import {getItems} from "../actions/qiita";
import moment from "moment";

const styles = {
  main: {
    display: 'flex',
  },
  content: {
    flex: '1 0 auto',
  },
  box: {
    padding: '2rem',
  },
  listItem: {
    display: 'flex',
  },
  item: {
    display: 'flex',
    padding: '2rem'
  },
  user: {},
  avatar: {
    width: '3rem',
    height: '3rem',
  },
  avatarImg: {
    width: '100%',
    height: '100%',
  },
  userName: {
    fontSize: '1rem',
  },
  itemContent: {},
  title: {
    fontSize: '2rem',
  },
  tagList: {
    display: 'flex',
  },
  tagListItem: {
    listStyle: 'none',
  }
};

class Home extends React.Component {
  componentDidMount() {
    this.props.getItems();
  }

  renderFilterMenu() {
    const {classes} = this.props;

    return (
      <React.Fragment>
        <Box className={classes.box}>
          <input type="search" placeholder="検索"/>
        </Box>
        <Box className={classes.box}>
          <h3>カテゴリー</h3>
          <ul>
            <li className={classes.listItem}>
              <div>
                <img src="https://placehold.jp/16x16.png" alt=""/>
              </div>
              <div>Javascript</div>
              <div>20</div>
            </li>
            <li className={classes.listItem}>
              <div>
                <img src="https://placehold.jp/16x16.png" alt=""/>
              </div>
              <div>Docker</div>
              <div>10</div>
            </li>
          </ul>
        </Box>
        <Box className={classes.box}>
          <h3>タグ</h3>
          <li className={classes.listItem}>
            <div>
              <img src="https://placehold.jp/16x16.png" alt=""/>
            </div>
            <div>Javascript</div>
            <div>20</div>
          </li>
          <li className={classes.listItem}>
            <div>
              <img src="https://placehold.jp/16x16.png" alt=""/>
            </div>
            <div>Docker</div>
            <div>10</div>
          </li>
        </Box>
        <Box className={classes.box}>
          <h3>Qiitaタグ</h3>
          <li className={classes.listItem}>
            <div>
              <img src="https://placehold.jp/16x16.png" alt=""/>
            </div>
            <div>Javascript</div>
            <div>20</div>
          </li>
          <li className={classes.listItem}>
            <div>
              <img src="https://placehold.jp/16x16.png" alt=""/>
            </div>
            <div>Docker</div>
            <div>10</div>
          </li>
        </Box>
      </React.Fragment>
    )
  }

  renderItems() {
    const {classes, items} = this.props;

    const renderTags = (tags) => {
      return _.map(tags, tag => (
        <li className={classes.tagListItem} key={tag.name}>
          <Link href={`https://qiita.com/tags/${tag.name}`} target="_blank">{tag.name}</Link>
        </li>
      ));
    };

    return _.map(items, item => (
      <Box className={classes.item} key={item.id}>
        <div className={classes.user}>
          <div className={classes.avatar}>
            <img src={item.user.profile_image_url} alt="" className={classes.avatarImg}/>
          </div>
        </div>
        <div className={classes.itemContent}>
          <div className={classes.userName}>
            <Link href={`https://qiita.com/${item.user.id}`} target="_blank">{item.user.id}</Link>
            が
            {moment(item.created_at).format('YYYY/MM/DD')}
            に投稿
          </div>
          <Typography component="h2" variant="h5" className={classes.title}>
            <Link href={item.url} target='_blank' color='inherit'>{item.title}</Link>
          </Typography>
          <div>
            <ul className={classes.tagList}>
              {renderTags(item.tags)}
            </ul>
          </div>
        </div>
      </Box>
    ));
  }

  render() {
    const {classes} = this.props;

    return (
      <React.Fragment>
        <CssBaseline/>
        <Header/>
        <Container component="main" className={classes.main}>
          <Box key='filterMenu'>
            {this.renderFilterMenu()}
          </Box>
          <Box key='items'>
            {this.renderItems()}
          </Box>
        </Container>
        <Footer/>
      </React.Fragment>
    )
  }
}

const mapStateToProps = state => ({items: state.items});
const mapDispatchToProps = ({getItems});
const enhance = compose(connect(mapStateToProps, mapDispatchToProps), withStyles(styles));

export default enhance(Home);