import React from 'react'
import { makeStyles } from '@material-ui/core/styles';
import AppBar from '@material-ui/core/AppBar';
import Toolbar from '@material-ui/core/Toolbar';
import Typography from '@material-ui/core/Typography';
import Button from '@material-ui/core/Button';
import IconButton from '@material-ui/core/IconButton';
import MenuIcon from '@material-ui/core/Icon';
import {Link} from 'react-router-dom';
import {Menu, MenuItem} from "@material-ui/core";

const useStyles = makeStyles(theme => ({
  // root: {
  //   flexGrow: 1,
  // },
  menuButton: {
    marginRight: theme.spacing(2),
  },
  title: {
    flexGrow: 1,
  },
  titleText: {
    color: "#FFF !important",
  },
  link: {
    color: '#000',
    textDecoration: 'none',
    '&:hover': {
      color: '#000',
      textDecoration: 'none',
    }
  },
}));

export default function Navbar() {
  const classes = useStyles();
  const [anchorEl, setAnchorEl] = React.useState(null);

  const handleClick = event => {
    setAnchorEl(event.currentTarget);
  };

  const handleClose = () => {
    setAnchorEl(null);
  };

  return (
    <div className={classes.root}>
      <AppBar position="static">
        <Toolbar>
          <Typography component="h1" variant="h6" className={classes.title} color="inherit">
            <Link to="/" className={classes.link + " " + classes.titleText}>Qiita管理君</Link>
          </Typography>
          <Button color="inherit" aria-controls="simple-menu" aria-haspopup="true" onClick={handleClick}>
            メニュー
          </Button>
          <Menu
            id="simple-menu"
            anchorEl={anchorEl}
            keepMounted
            open={Boolean(anchorEl)}
            onClose={handleClose}
          >
            <MenuItem onClick={handleClose}>
              <Link to="/register" className={classes.link}>会員登録</Link>
            </MenuItem>
            <MenuItem onClick={handleClose}>
              <Link to="/login" className={classes.link}>ログイン</Link>
            </MenuItem>
          </Menu>
        </Toolbar>
      </AppBar>
    </div>
  )
}