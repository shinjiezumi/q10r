import React from "react"
import {Box, Container, makeStyles} from "@material-ui/core";
import {Link} from "react-router-dom";
import {GitHub, Twitter} from '@material-ui/icons';

const useStyles = makeStyles(theme => ({
  footer: {
    display: 'flex',
    justifyContent: 'center',
    borderTop: '1px solid rgba(0, 0, 0, 0.14)',
    height: '3rem',
    minHeight: '3rem',
  },
  footerWrap: {
    display: 'flex',
    alignItems: 'center',
  },
  footerCopyright: {
    marginRight: '.5rem',
    color: '#000',
  },
  footerSnsList: {
    display: 'flex',
    listStyle: 'none',
  },
  snsIcon: {
    color: '#000',
    fontSize: '1.5rem',
    marginRight: '.5rem',
  },
  link: {
    color: '#000',
    textDecoration: 'none',
    '&:hover': {
      color: '#000',
      textDecoration: 'none',
    },
  },
  copyrightLink: {
    marginLeft: '.5rem',
    marginRight: '.5rem',
    color: '#000',
    textDecoration: 'none',
    '&:hover': {
      color: '#000',
      textDecoration: 'none',
    },
  },
}));

export default function Footer() {
  const classes = useStyles();

  const currentYear = new Date().getFullYear()

  return (
    <Box component="footer">
      <Container className={classes.footer}>
        <div className={classes.footerWrap}>
          <div className={classes.footerCopyright}>
            <span>&copy; {currentYear}</span>
            <a href="https://shinjiezumi.work/contact" className={classes.copyrightLink}>shinjiezumi</a>
          </div>
          <div>
            <ul className={classes.footerSnsList}>
              <li>
                <Link to="https://twitter.com/shinjiezumi" target="_blank">
                  <Twitter className={classes.snsIcon}/>
                </Link>
              </li>
              <li>
                <Link to="https://github.com/shinjiezumi" target="_blank">
                  <GitHub className={classes.snsIcon}/>
                </Link>
              </li>
            </ul>
          </div>
        </div>
      </Container>
    </Box>
  )
}
