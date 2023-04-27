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
import { getOrderById, getProductOfBill, updateOrder } from "services/orderService";
import { getUserById } from "services/userService";

function ViewOrder() {
  const location = useLocation();
  const navigate = useNavigate();
  const [message, setMessage] = useState(null);
  const [order, setOrder] = useState({
    indx: "",
    id: "",
    customerId: "",
    total: "",
    payMethod: "",
    status: "",
  });
  const [user, setUser] = useState({
    name: "",
    phone: "",
    address: "",
    image: "",
  });
  const [product, setProduct] = useState([
    {
      id: "",
      bill_id: "",
      name: "",
      price: "",
      amount: "",
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
        const response = await getOrderById(id);
        
        setOrder(response[0]);
        const responseUser = await getUserById(response[0].customerID);

        setUser(responseUser[0]);

        const responseProduct = await getProductOfBill(
          response[0].id,
          response[0].customerID
        );
        console.log(responseProduct);
        setProduct(responseProduct);
      } catch (error) {
        console.error(error);
      }
    }
    fetchData();
  }, []);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setOrder({ ...order, [name]: value });
  };
  const handleSubmit = async (e) => {
    // e.preventDefault();
    // updateuser(id, user).then(function(response){
    //     navigate('/user');
    // }
    // );
    e.preventDefault();
    const data = new FormData();
    data.append("id", order.indx);
    data.append("status", order.status);

    const response = await updateOrder(data);
    console.log(response);
    if (response.status == 200) {
      setMessage("Edit Order successfully!");
    } else {
      setMessage("Edit Order fail!");
    }
    setOpen(true);
    setTimeout(() => {
      navigate("/Orders");
    }, 2000);
  };
  console.log(product);

  const image = "http://localhost:80/image/customer/" + user.image;
  const TAX_RATE = 0.1;
  function subtotal(items) {
    var sum = 0;
    items.map((item) => {
      sum += Number(item.price * item.amount);
    });
    return sum.toFixed(2);
  }
  function ccyFormat(num) {
    return;
  }
  const invoiceSubtotal = subtotal(product);
  const invoiceTaxes = (TAX_RATE * invoiceSubtotal).toFixed(2);
  const invoiceTotal = Number(invoiceTaxes) + Number(invoiceSubtotal);

  return (
    <div>
      <h1> EDIT Order</h1>

      <Card sx={{ maxWidth: 345 }} center>
        <CardActionArea>
          <CardMedia
            component="img"
            height="140"
            image={image}
            alt="green iguana"
          />
          <CardContent>
            <Typography gutterBottom variant="h5" component="div">
              {user.name}
            </Typography>
            <Typography variant="body2" color="text.secondary">
              Address: {user.address}
            </Typography>
            <Typography variant="body2" color="text.secondary">
              Phone: {user.phone}
            </Typography>
          </CardContent>
        </CardActionArea>
      </Card>
      <Box
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
                <TableCell>Bill ID</TableCell>
                <TableCell align="right">Product ID </TableCell>
                <TableCell align="right">Product Name</TableCell>
                <TableCell align="right">Price&nbsp;(VND)</TableCell>
                <TableCell align="right">Quantity&nbsp;(unit)</TableCell>
                <TableCell align="right">Total&nbsp;(VND)</TableCell>
              </TableRow>
            </TableHead>
            <TableBody>
              {product.map((row) => (
                <TableRow
                  key={row.id}
                  sx={{ "&:last-child td, &:last-child th": { border: 0 } }}
                >
                  <TableCell component="th" scope="row">
                    {row.bill_id}
                  </TableCell>
                  <TableCell component="th" scope="row" align="right">
                    {row.id}
                  </TableCell>
                  <TableCell align="right">{row.name}</TableCell>
                  <TableCell align="right">{row.price}</TableCell>
                  <TableCell align="right">{row.amount}</TableCell>
                  <TableCell align="right">{row.price * row.amount}</TableCell>
                </TableRow>
              ))}
              <TableRow>
                <TableCell rowSpan={3} />
                <TableCell colSpan={2}>Subtotal</TableCell>
                <TableCell align="right">{invoiceSubtotal}</TableCell>
              </TableRow>
              <TableRow>
                <TableCell>VAT</TableCell>
                <TableCell align="right">{`${(TAX_RATE * 100).toFixed(
                  0
                )} %`}</TableCell>
                <TableCell align="right">{invoiceTaxes}</TableCell>
              </TableRow>
              <TableRow>
                <TableCell colSpan={2}>Total</TableCell>
                <TableCell align="right">{invoiceTotal}</TableCell>
              </TableRow>
            </TableBody>
          </Table>
        </TableContainer>

        <Button variant="contained" onClick={handleSubmit}>
          Submit
        </Button>
      </Box>
      <Snackbar
        anchorOrigin={{ vertical: "top", horizontal: "center" }}
        open={open}
        onClose={handleClose}
        message="Chỉ được chọn một sản phẩm để sửa!"
      >
        <Alert onClose={handleClose} severity="success" sx={{ width: "100%" }}>
          Create user successfully!
        </Alert>
      </Snackbar>
    </div>
  );
}

export default ViewOrder;
