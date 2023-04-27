import React from 'react';
import { useState } from 'react';
import { Button, TextField,Box } from '@mui/material';
import {useLocation, useNavigate, useParams} from 'react-router-dom';
import axios from 'axios';
import { useEffect } from 'react';
import { getProductById, updateProduct } from 'services/productService';
import { Row } from 'react-bootstrap';


function EditProduct() {
    const location = useLocation();
    const navigate = useNavigate();
    const [myFile, setMyfile1] = useState(null);
    const [myFile1, setMyfile2] = useState(null);
    const [myFile2, setMyfile3] = useState(null);
    const [myFile3, setMyfile4] = useState(null);
    const [message, setMessage]= useState(null);
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
      image: '',
      image1: '',
      image2: '',
      image3: '',
    });
    const [srcFile, setSrcFile] = useState('http://localhost:80/image/products/'+ product.image);
    const [srcFile1, setSrcFile1] = useState('http://localhost:80/image/products/'+ product.image1);
    const [srcFile2, setSrcFile2] = useState('http://localhost:80/image/products/'+ product.image2);
    const [srcFile3, setSrcFile3] = useState('http://localhost:80/image/products/'+ product.image3);
    const {id} = useParams();
    React.useEffect(() => {
      async function fetchData() {
        try {
          const response = await getProductById(id);
          setProduct(response[0]);
          console.log(response[0]);
          setMyfile1(response[0].image);
          setMyfile2(response[0].image1);
          setMyfile3(response[0].image2);
          setMyfile4(response[0].image3);
          setSrcFile('http://localhost:80/image/products/'+response[0].image);
          setSrcFile1('http://localhost:80/image/products/'+response[0].image1);
          setSrcFile2('http://localhost:80/image/products/'+response[0].image2);
          setSrcFile3('http://localhost:80/image/products/'+response[0].image3);
        } catch (error) {
          console.error(error);
        }
      }
      fetchData();
    }, []);



    const handleChange = (e) => {
        e.preventDefault();
        const { name, value } = e.target;
        setProduct({ ...product, [name]: value });
    }
    const handleSubmit = async (e) => {
        // e.preventDefault();
        // updateProduct(id, product).then(function(response){
        //     navigate('/product');
        // }
        // );
        e.preventDefault();
        const data = new FormData();
        data.append('id', id);
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
        data.append('image', myFile);
        data.append('image1', myFile1);
        data.append('image2', myFile2);
        data.append('image3', myFile3);
        console.log(myFile);
        console.log(myFile1);
        console.log(myFile2);
        console.log(myFile3);
        const response = await updateProduct(data);
        console.log(response);
        setTimeout(()=> {
          alert(response.message);
          navigate('/product');
        }, 2000);
     
    }
    const handleFile =  (e, index) => {
        console.log('aaaa');
        e.preventDefault();
        const file =  e.target.files[0];
        if(index == 0){
          setMyfile1(file);
        }
        if(index == 1){
          setMyfile2(file);
        }
        if(index == 2){
          setMyfile3(file);
        }
        if(index == 3){
          setMyfile4(file);
        }
        // setProduct({ ...product, image: file });
        // setMyfile(oldFile => [...oldFile, file]);
       // setSrcFile('http://localhost:80/admin/img/'+file.name);
    }

  return (
      <div>
      <h1 > EDIT PRODUCT</h1>
     <Box
      component="form"
      sx={{
        '& > :not(style)': { m: 1, width: "100%" },
      }}
      noValidate
      autoComplete="off"
    >

      <TextField value={product.name} id="outlined-basic" label="Name" variant="outlined" type="text" required name="name" onChange={handleChange}/>
      <TextField value={product.price} id="filled-basic" label="Price" variant="filled" type="number" required name="price" onChange={handleChange}/>
      <TextField value={product.amount} id="amo" label="Amount" variant="filled" type="number" required name="amount" onChange={handleChange}/>
      <TextField value={product.type} id="type" label="Type" variant="filled" type="text" required name="type" onChange={handleChange}/>
      <TextField value={product.rating} id="rating" label="Rating" variant="filled" type="number" required name="rating" onChange={handleChange}/>
      <TextField value={product.chip} id="chip" label="Chip" variant="filled" type="text" required name="chip" onChange={handleChange}/>
      <TextField value={product.ram} id="ram" label="Ram" variant="filled" type="text" required name="ram" onChange={handleChange}/>
      <TextField value={product.screen} id="screen" label="Screen" variant="filled" type="text" required name="screen" onChange={handleChange}/>
      <TextField value={product.battery} id="battery" label="Battery" variant="filled" type="text" required name="battery" onChange={handleChange}/>
      <TextField value={product.guarantee} id="guarantee" label="Guarantee" variant="filled" type="text" required name="guarantee" onChange={handleChange}/>
      <TextField value={product.outstanding} id="outstanding" label="Outstanding" variant="filled" type="text" required name="outstanding" onChange={handleChange}/>
      <img src={srcFile} alt="image" width="100px" height="100%" ></img>
      <img src={srcFile1} alt="image" width="100px" height="100%" ></img>
      <img src={srcFile2} alt="image" width="100px" height="100%" ></img>
      <img src={srcFile3} alt="image" width="100px" height="100%" ></img>
      <input  type='file' id="file" lable= "image" name="image" onChange={e =>handleFile(e,0)} ></input>
      <input  type='file' id="file1" lable= "image" name="image1" onChange={e =>handleFile(e,1)} ></input>
      <input  type='file' id="file2" lable= "image" name="image2" onChange={e =>handleFile(e,2)} ></input>
      <input  type='file' id="file3" lable= "image" name="image3" onChange={e =>handleFile(e,3)} ></input>
      <Button variant="contained" onClick={handleSubmit}>Submit</Button>
      <p>{message}</p>
    </Box>

    </div>
  )
}

export default EditProduct;
