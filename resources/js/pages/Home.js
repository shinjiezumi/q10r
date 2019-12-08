import React from 'react'
import _ from "lodash"
import Header from '../components/Header'
import Footer from "../components/Footer";
import {
  Box,
  Container,
  CssBaseline,
  Link,
  Grid,
  Typography,
  withStyles,
  Input,
  CircularProgress, Snackbar
} from "@material-ui/core";
import {
  CategoryRounded,
  FolderTwoTone,
  LabelRounded,
  LocalOfferRounded, SearchRounded
} from "@material-ui/icons";
import Pagination from "material-ui-flat-pagination";
import {connect} from "react-redux";
import {compose} from "recompose";
import {getItems, removeNotice} from "../actions/qiita";
import moment from "moment";
import MySnackbarContentWrapper from "../components/Notice";

const styles = {
  mr05: {
    marginRight: '.5rem',
  },
  tac: {
    textAlign: 'center',
  },
  main: {
    display: 'flex',
  },
  content: {
    flex: '1 0 auto',
  },
  box: {
    padding: '1rem',
  },
  listItem: {
    display: 'flex',
    padding: '.5rem'
  },
  item: {
    display: 'flex',
    padding: '1rem',
  },
  user: {
    marginRight: '.5rem',
  },
  avatar: {
    width: '3rem',
    height: '3rem',
  },
  avatarImg: {
    width: '100%',
    height: '100%',
  },
  itemContent: {},
  title: {},
  tags: {
    padding: '.2rem',
    fontSize: '.7rem',
    display: 'flex',
  },
  tagList: {
    display: 'flex',
  },
  tagListItem: {
    listStyle: 'none',
  },
  tag: {
    marginRight: '.5rem',
    padding: '.2rem',
    backgroundColor: '#d4d2d2',
    color: '#000',
    '&:before': {
      width: '1rem',
      height: '1rem',
      backgroundColor: '#d4d2d2',
      transform: 'rotate(45deg)',
      content: '""',
    }
  },
};

class Home extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      offset: 0,
    };
    this.handleClose = this.handleClose.bind(this);
  }

  componentDidMount() {
    this.props.getItems();
  }

  handleClose(event, reason) {
    if (reason === 'clickaway') {
      return;
    }
    this.props.removeNotice();
  }

  renderFilterMenu() {
    const {classes} = this.props;

    return (
      <React.Fragment>
        <Box className={classes.box}>
          <Typography component="h2" variant="h6">
            <FolderTwoTone/>ストック一覧
          </Typography>
        </Box>
        <Box className={classes.box}>
          <Typography component="h3" variant="subtitle1"><SearchRounded/>ストック内検索</Typography>
          <Input type="search" placeholder="検索"/>
        </Box>
        <Box className={classes.box}>
          <Typography component="h3" variant="subtitle1"><CategoryRounded/>QMカテゴリー</Typography>
          <ul>
            <li className={classes.listItem}>
              <div className={classes.mr05}>
                <img src="https://placehold.jp/16x16.png" alt=""/>
              </div>
              <div className={classes.mr05}>Javascript</div>
              <div>20</div>
            </li>
          </ul>
        </Box>
        <Box className={classes.box}>
          <Typography component="h3" variant="subtitle1"><LocalOfferRounded/>QMタグ</Typography>
          <li className={classes.listItem}>
            <div className={classes.mr05}>
              <img src="https://placehold.jp/16x16.png" alt=""/>
            </div>
            <div className={classes.mr05}>Javascript</div>
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
          <Typography component="h3" variant="subtitle1"><LabelRounded/>タグ</Typography>
          <li className={classes.listItem}>
            <div className={classes.mr05}>
              <img src="https://placehold.jp/16x16.png" alt=""/>
            </div>
            <div className={classes.mr05}>Javascript</div>
            <div>20</div>
          </li>
        </Box>
      </React.Fragment>
    )
  }

  renderItems() {
    const {classes, items, isLoading, error} = this.props;

    if (isLoading) {
      return (
        <Box mt={20} className={classes.tac}>
          <CircularProgress />
        </Box>
      )
    }

    const renderTags = (item) => {
      return (
        <div className={classes.tags}>
          <ul className={classes.tagList}>
            {_.map(item.tags, tag => (
              <li className={classes.tagListItem} key={tag.name}>
                <Link href={`https://qiita.com/tags/${tag.name}`} target="_blank">
                  <span className={classes.tag}>{tag.name}</span>
                </Link>
              </li>
            ))}
          </ul>
        </div>
      );
    };

    return _.map(items, (item, i) => (
      <Box key={item.id}>
        <div className={classes.item}>
          <div className={classes.user}>
            <div className={classes.avatar}>
              <img src={item.user.profile_image_url} alt="" className={classes.avatarImg}/>
            </div>
          </div>
          <div className={classes.itemContent}>
            <div>
              <Link href={`https://qiita.com/${item.user.id}`} target="_blank">{item.user.id}</Link>
              が
              {moment(item.created_at).format('YYYY/MM/DD')}
              に投稿
            </div>
            <Typography component="h2" variant="subtitle1">
              <Link href={item.url} target='_blank'>{item.title}</Link>
            </Typography>
            {renderTags(item)}
          </div>
        </div>
        {
          items.length !== (i + 1) && (
            <hr/>
          )
        }
      </Box>
    ));
  }

  handlePaginate(offset) {
    this.setState({offset})
  }

  renderPagination() {
    const {classes, isLoading, error} = this.props;
    const className = [classes.box, classes.tac].join(' ');

    if (isLoading || error) {
      return ""
    }
    return (
      <Box className={className}>
        <Pagination
          limit={10}
          offset={this.state.offset}
          total={100}
          onClick={(e, offset) => this.handlePaginate(offset)}
        />
      </Box>
    );
  }

  render() {
    const {classes, isNotice, error} = this.props;

    return (
      <React.Fragment>
        <CssBaseline/>
        <Header/>
        <Container component="main" className={classes.main}>
          <Grid container>
            <Grid item xs={12} sm={3}>
              {this.renderFilterMenu()}
            </Grid>
            <Grid item xs={12} sm={9}>
              {
                error && (
                  <Snackbar
                    anchorOrigin={{
                      vertical: 'bottom',
                      horizontal: 'right',
                    }}
                    open={isNotice}
                  >
                    <MySnackbarContentWrapper
                      variant="error"
                      m={10}
                      message={error}
                      onClose={this.handleClose}
                    />
                  </Snackbar>
                )
              }
              {!error && this.renderItems()}
              {!error && this.renderPagination()}
            </Grid>
          </Grid>
        </Container>
        <Footer/>
      </React.Fragment>
    )
  }
}

const mapStateToProps = state => ({
  isLoading: state.qiita.isLoading,
  isNotice: state.qiita.isNotice,
  items: state.qiita.items,
  error: state.qiita.error
});
const mapDispatchToProps = ({getItems, removeNotice});
const enhance = compose(connect(mapStateToProps, mapDispatchToProps), withStyles(styles));

export default enhance(Home);