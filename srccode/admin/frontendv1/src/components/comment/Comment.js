import React from "react";
import { useState } from "react";
import {
  Button,
  TextField,
  Box,
  Select,
  MenuItem,
  InputLabel,
  Snackbar,
  Alert,
  Card,
  CardContent,
  CardMedia,
  Typography,
  CardActionArea,
  Table,
  TableBody,
  TableCell,
  TableContainer,
  TableHead,
  TableRow,
  Paper,
} from "@mui/material";
import {
  useLocation,
  useNavigate,
  useParams,
  useResolvedPath,
} from "react-router-dom";
import axios from "axios";
import { useEffect } from "react";
import { getProductById, getProducts } from "services/productService";
import { getCommentById } from "services/commentService";
import ListUserComment from "./ListUserComment";
import ListProductComment from "./ListProductComment";
function Comment() {
  const location = useLocation();
  const navigate = useNavigate();
  const [message, setMessage] = useState(null);

  const [product, setProduct] = useState({
    id: "",
    name: "",
    image: "",
    price: "",
  });
  const [comment, setComment] = useState([
    {
      indx: "",
      name: "",
      image: "",
      content: "",
      comment_date: "",
    },
  ]);
  //at here
  const { id } = useParams();

  const [open, setOpen] = React.useState(false);
  const handleClose = () => {
    setOpen(false);
  };
  React.useEffect(() => {
    async function fetchData() {
      try {
        // const responseAll = await getProducts();
        // setProduct(responseAll);
        // console.log("product: ");
        // console.log(responseAll);
        const responseProduct= await getProductById(id);
        setProduct(responseProduct[0]);
        console.log("product: ");
        console.log(responseProduct);

        const responseComment = await getCommentById(id);
        setComment(responseComment);

        // console.log('comment: ');
        // console.log(responseComment);
      } catch (error) {
        console.error(error);
      }
    }
    fetchData();
  }, []);

  // const image = "http://localhost:80/image/customer/" + comment.image;
  const image = "http://localhost:80/image/product/" + product.image;

  return (
    <div>
      <h1> Comment Product</h1>
      <Card sx={{ maxWidth: 345, ml:'20vw' }} center>
        <CardActionArea>
          <CardMedia
            component="img"
            height="140"
            image={image}
            alt="green iguana"
          />
          <CardContent>
            <Typography gutterBottom variant="h5" component="div">
              {product.name}
            </Typography>
            <Typography variant="body2" color="text.secondary">
              Id: {product.id}
            </Typography>
            <Typography variant="body2" color="text.secondary">
              Price: {product.price}
            </Typography>
          </CardContent>
        </CardActionArea>
      </Card>
      {/* <Box
        component="form"
        sx={{
          "& > :not(style)": { m: 1, width: "100%" },
        }}
        noValidate
        autoComplete="off"
      >
        <InputLabel id="status">Status</InputLabel>
        <Select
          labelId="Status"
          id="status"
          value={order.status}
          label="Status"
          onChange={handleChange}
          name="status"
        >
          <MenuItem value="waiting">Waiting</MenuItem>
          <MenuItem value="checked">Checked</MenuItem>
          <MenuItem value="done">Done</MenuItem>
          <MenuItem value={""}></MenuItem>
        </Select>
        <TableContainer component={Paper}>
          <Table sx={{ minWidth: 650 }} aria-label="simple table">
            <TableHead>
              <TableRow>
                <TableCell>ID</TableCell>
                <TableCell align="right"> Avatar </TableCell>
                <TableCell align="right"> Name</TableCell>
                <TableCell align="right"> Content</TableCell>
                <TableCell align="right"> Date</TableCell>
              </TableRow>
            </TableHead>
            <TableBody>
              {comment.map((row) => (
                <TableRow
                  key={row.id}
                  sx={{ "&:last-child td, &:last-child th": { border: 0 } }}
                >
                  <TableCell component="th" scope="row">
                    {row.indx}
                  </TableCell>
                  <TableCell component="th" scope="row" align="right">
                    {row.image}
                  </TableCell>
                  <TableCell align="right">{row.name}</TableCell>
                  <TableCell align="right">{row.content}</TableCell>
                  <TableCell align="right">{row.comment_date}</TableCell>
                </TableRow>
              ))}
            </TableBody>
          </Table>
        </TableContainer>
      </Box> */}
      <ListUserComment />
    </div>
  );
}

export default Comment;
