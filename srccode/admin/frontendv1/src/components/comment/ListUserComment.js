import * as React from "react";
import Box from "@mui/material/Box";
import CssBaseline from "@mui/material/CssBaseline";
import Dialog from "@mui/material/Dialog";
import DialogActions from "@mui/material/DialogActions";
import DialogContent from "@mui/material/DialogContent";
import DialogContentText from "@mui/material/DialogContentText";
import DialogTitle from "@mui/material/DialogTitle";
import List from "@mui/material/List";
import ListItem from "@mui/material/ListItem";
import ListItemAvatar from "@mui/material/ListItemAvatar";
import ListItemText from "@mui/material/ListItemText";
import Avatar from "@mui/material/Avatar";
import Button from "@mui/material/Button";
import { getCommentById } from "services/commentService";
import {
  useLocation,
  useNavigate,
  useParams,
  useResolvedPath,
} from "react-router-dom";
import { useEffect, useState } from "react";
import Typography from "@mui/material/Typography";
import { IconButton } from "@mui/material";
import DeleteIcon from "@mui/icons-material/Delete";
import { deleteComment } from "services/commentService";
const ListUserComment= () => {
  const location = useLocation();
  const navigate = useNavigate();
  const [message, setMessage] = React.useState(null);
  const [comment, setComment] = useState([
    {
      indx: "",
      name: "",
      image: "",
      content: "",
      comment_date: "",
    },
  ]);
  const {id} = useParams();
  const [value, setValue] = React.useState(0);
  const ref = React.useRef(null);
  const [messages, setMessages] = React.useState(() => refreshMessages());

  React.useEffect(() => {
    ref.current.ownerDocument.body.scrollTop = 0;
    setMessages(refreshMessages());
  }, [value, setMessages]);

  React.useEffect(() => {
    async function fetchData() {
      try {
        const responseComment = await getCommentById(id);
        setComment(responseComment);
        console.log("comment: ");
        console.log(responseComment);
      } catch (error) {
        console.error(error);
      }
    }
    fetchData();
  }, []);

  function refreshMessages() {
    const getRandomInt = (max) => Math.floor(Math.random() * Math.floor(max));

    return Array.from(new Array(50)).map(
      () => comment[getRandomInt(comment.length)]
    );
  }

  const handleDelete = async (indx) => {
    const response = await deleteComment(indx);
    console.log(response);

    if (response.status === 200) {
      alert("Xóa thành công");
      const newComment = comment.filter((item) => item.indx !== indx);
      setComment(newComment);
    } else {
      alert("Xóa thất bại");
    }
    setOpen(false);
  };

  const [open, setOpen] = React.useState(false);
  const [indx, setIndx] = React.useState("");
  const handleClickOpen = (indx) => {
    setOpen(true);
    setIndx(indx);
  };

  const handleClose = () => {
    setOpen(false);
  };

  return (
    <>
      <Box sx={{ pb: 7 }} ref={ref}>
        <CssBaseline />
        <List>
           {comment.map(({ indx, name, content, image, comment_date }) => (
            <ListItem
              button
              key={indx}
              secondaryAction={
                <IconButton
                  aria-label="comment"
                  onClick={() => handleClickOpen(indx)}
                >
                  <DeleteIcon />
                </IconButton>
              }
            >
              <ListItemAvatar>
                <Avatar alt="Profile Picture" src={`http://localhost:80/image/customer/${image}`} />
              </ListItemAvatar>
              <ListItemText
                primary={name}
                secondary={
                  <React.Fragment>
                    <Typography
                      sx={{ display: "inline" }}
                      component="span"
                      variant="body2"
                      color="text.primary"
                    >
                      {content}
                    </Typography>
                    <br />
                    {` — ${comment_date}`}
                  </React.Fragment>
                }
              />
            </ListItem>
            ))}
        </List>
      </Box>
      <Dialog
        open={open}
        onClose={handleClose}
        aria-labelledby="alert-dialog-title"
        aria-describedby="alert-dialog-description"
      >
        <DialogTitle id="alert-dialog-title">{"Be careful!"}</DialogTitle>
        <DialogContent>
          <DialogContentText id="alert-dialog-description">
            Are you sure to delete this comment??
          </DialogContentText>
        </DialogContent>
        <DialogActions>
          <Button onClick={handleClose}>Disagree</Button>
          <Button onClick={() => handleDelete(indx)} autoFocus>
            Agree
          </Button>
        </DialogActions>
      </Dialog>
    </>
  );
}
export default ListUserComment;