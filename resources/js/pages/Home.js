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
  CircularProgress,
  Snackbar,
  Button,
  Fab
} from "@material-ui/core";
import {
  FolderTwoTone,
  LocalOfferRounded,
  SearchRounded,
  Add as AddIcon,
  Cancel as CancelIcon,
  AddCircle as AddCircleIcon
} from "@material-ui/icons";
import Pagination from "material-ui-flat-pagination";
import {connect} from "react-redux";
import {compose} from "recompose";
import {getItems, getTags, addTag, importQiita, removeNotice} from "../actions/qiita";
import moment from "moment";
import MySnackbarContentWrapper from "../components/Notice";

const styles = {
  mr05: {
    marginRight: '.5rem',
  },
  tac: {
    textAlign: 'center',
  },
  df: {
    display: 'flex',
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
  tagModifyContainer: {
    display: 'flex',
    flexDirection: 'column',
  },
  button: {
    width: '300px'
  }
};

class Home extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      offset: 0,
      tagAdd: false
    };
    this.handleClose = this.handleClose.bind(this);
    this.importQiita = this.importQiita.bind(this);
  }

  componentDidMount() {
    this.props.getItems({
      page: 1,
      per_page: 10
    });
    this.props.getTags();
  }

  importQiita() {
    this.props.importQiita();
  };

  handleTagAdd() {
    this.setState({tagAdd: true});
  }

  tagAdd() {
    this.props.addTag(document.getElementById('addTagName').value);
    this.setState({tagAdd: false});

  }

  tagAddCancel() {
    this.setState({tagAdd: false});
  }

  handleClose(event, reason) {
    const {error} = this.props;

    if (reason === 'clickaway') {
      return;
    }
    this.props.removeNotice();
    if (!error) {
      this.props.getItems({
        page: 1,
        per_page: 10
      });
    }
  }

  renderFilterMenu() {
    const {classes, tags} = this.props;

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
          <Typography component="h3" variant="subtitle1"><LocalOfferRounded/>QMタグ</Typography>
          {
            _.map(tags, tag => (
              <li className={classes.listItem} key={tag.id}>
                <div className={classes.mr05}>{tag.name}</div>
                <div>{tag.count}</div>
              </li>
            ))
          }
          {
            this.state.tagAdd && (
              <div className={classes.df}>
                <Input id="addTagName" type="text" placeholder=""/>
                <div className={classes.tagModifyContainer}>
                  <div>
                    <button onClick={() => this.tagAdd()}><AddCircleIcon color='primary'/></button>
                  </div>
                  <div>
                    <button onClick={() => this.tagAddCancel()}><CancelIcon color='secondary'/></button>
                  </div>
                </div>
              </div>
            )
          }
          {
            !this.state.tagAdd && (
              <div className={classes.tac}>
                <Fab color="primary" aria-label="add" size="small" onClick={() => this.handleTagAdd()}>
                  <AddIcon />
                </Fab>
              </div>
            )
          }
        </Box>
      </React.Fragment>
    )
  }

  renderItems() {
    const {classes, items, isLoading} = this.props;

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

    return _.map(items.data, (item, i) => (
      <Box key={item.id}>
        <div className={classes.item}>
          <div className={classes.user}>
            <div className={classes.avatar}>
              <img src={item.user.profile_image_url} alt="" className={classes.avatarImg}/>
            </div>
          </div>
          <div className={classes.itemContent}>
            <div>
              <Link href={`https://qiita.com/${item.user.user_id}`} target="_blank">{item.user.user_id}</Link>
              が
              {moment(item.item_created_at).format('YYYY/MM/DD')}
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
    const page = offset / 10 + 1;
    this.setState({offset: offset, page: page});
    this.props.getItems({
      page: page,
      per_page: 10
    });
  }

  renderPagination() {
    const {classes, isLoading, error, items} = this.props;
    const className = [classes.box, classes.tac].join(' ');

    if (isLoading || error) {
      return ""
    }
    return (
      <Box className={className}>
        <Pagination
          limit={10}
          offset={this.state.offset}
          total={items.total}
          onClick={(e, offset) => this.handlePaginate(offset)}
        />
      </Box>
    );
  }

  render() {
    const {classes, isNotice, message, error} = this.props;

    const variant = error ? 'error' : 'success';
    const showMessage = error || message;
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
                isNotice && (
                  <Snackbar
                    anchorOrigin={{
                      vertical: 'bottom',
                      horizontal: 'right',
                    }}
                    open={isNotice}
                  >
                    <MySnackbarContentWrapper
                      variant={variant}
                      m={10}
                      message={showMessage}
                      onClose={this.handleClose}
                    />
                  </Snackbar>
                )
              }
              {!error && this.renderItems()}
              {!error && this.renderPagination()}
              <Box m={10} className={classes.tac}>
                <Button variant="contained" color="primary" className={classes.button} onClick={this.importQiita}>
                  Qiitaインポート
                </Button>
              </Box>
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
  tags: state.qiita.tags,
  message: state.qiita.message,
  error: state.qiita.error
});
const mapDispatchToProps = ({getItems, getTags, addTag, removeNotice, importQiita});
const enhance = compose(connect(mapStateToProps, mapDispatchToProps), withStyles(styles));

export default enhance(Home);