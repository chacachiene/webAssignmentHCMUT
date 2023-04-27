import React from 'react';
import { useState } from 'react';
import { Button, Box, TextField } from '@mui/material';
import {useLocation, useNavigate} from 'react-router-dom';
import axios from 'axios';
import { useEffect } from 'react';
import { getProducts, createProduct } from 'services/productService';
function CreateProduct() {
    const location = useLocation();
    const navigate = useNavigate();
    const [myFile, setMyfile] = useState([]);
    const [message, setMessage] = useState('');
    const [product, setProduct] = useState({
        name: '',
        price: '',
        amount: '',
        type: '',
        rating: '',
        chip: '',
        ram: '',
        screen: '',
        battery: '',
        guarantee: '',
        outstanding: '',
    });

    const handleChange = (e) => {
        e.preventDefault();
        const { name, value } = e.target;
        setProduct({ ...product, [name]: value });
    }
    const handleSubmit = async (e) => {
        e.preventDefault();
        const data = new FormData();
        data.append('name', product.name);
        data.append('price', product.price);
        data.append('amount', product.amount);
        data.append('type', product.type);
        data.append('rating', product.rating);
        data.append('chip', product.chip);
        data.append('ram', product.ram);
        data.append('screen', product.screen);
        data.append('battery', product.battery);
        data.append('guarantee', product.guarantee);
        data.append('outstanding', product.outstanding);    
        data.append('image', myFile[0]);
        data.append('image1', myFile[1]);
        data.append('image2', myFile[1]);
        data.append('image3', myFile[3]);

        console.log(myFile);
        // const response= await axios.post(process.env.REACT_APP_URL, data, {
        //     headers: {
        //         'Content-Type': 'multipart/form-data'
        //     }
        // });
        const response = await createProduct(data);
          setTimeout(()=> {
            alert(response.message);
            navigate('/product');
          }, 2000);
       
    }
   
    const handleFile = (e) => {
        e.preventDefault();
        const file = e.target.files[0];
        setMyfile(oldFile => [...oldFile, file]);
    }
    // just test
 
  return (
    <div>
      <h1 > CREATE NEW PRODUCT</h1>
     <Box
      component="form"
      sx={{
        '& > :not(style)': { m: 1, width: "100%" },
      }}
      noValidate
      autoComplete="off"
    >
      <TextField id="outlined-basic" label="Name" variant="outlined" type="text" required name="name" onChange={handleChange}/>
      <TextField id="filled-basic" label="Price" variant="filled" type="number" required name="price" onChange={handleChange}/>
      <TextField id="amo" label="Amount" variant="filled" type="number" required name="amount" onChange={handleChange}/>
      <TextField id="type" label="Type" variant="standard" type="text" required name="type" onChange={handleChange}/>
      <TextField id="rating" label="Rating" variant="standard" type="text" required name="rating" onChange={handleChange}/>
      <TextField id="chip" label="Chip" variant="standard" type="text" required name="chip" onChange={handleChange}/>
      <TextField id="ram" label="Ram" variant="standard" type="text" required name="ram" onChange={handleChange}/>
      <TextField id="screen" label="Screen" variant="standard" type="text" required name="screen" onChange={handleChange}/>
      <TextField id="battery" label="Battery" variant="standard" type="text" required name="battery" onChange={handleChange}/>
      <TextField id="guarantee" label="Guarantee" variant="standard" type="text" required name="guarantee" onChange={handleChange}/>
      <TextField id="out" label="Outstading" variant="standard" type="text" required name="outstanding" onChange={handleChange}/>
      <br/>
      <input type='file' id="file1" lable= "image" name="image" onChange={handleFile}></input>
      <input type='file' id="file2" lable= "image" name="image" onChange={handleFile}></input>
      <input type='file' id="file3" lable= "image" name="image" onChange={handleFile}></input>
      <input type='file' id="file4" lable= "image" name="image" onChange={handleFile}></input>
      
      <Button variant="contained" onClick={handleSubmit}>Submit</Button>
      
    </Box>
    </div>
  )
}

export default CreateProduct;
{/* <input type="text" required name="name" onChange={handleChange} className="form-control" /> */}
            {/* <br />
            <label>Price </label>
            <input type="number" required name="price" onChange={handleChange} className="form-control" />
            <br />
            <label>Amount </label>
            <input type="number" required name="amount" onChange={handleChange} className="form-control" />
            <br />
            <label>Description </label>
           

            <input type="text" required name="description" onChange={handleChange} className="form-control" />
            <br /> */}