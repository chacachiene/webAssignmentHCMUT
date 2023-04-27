import React from 'react';
import { useState } from 'react';
import { Button, TextField,Box, Select, MenuItem, InputLabel, Snackbar, Alert,FormControl, NativeSelect  } from '@mui/material';
import {useLocation, useNavigate, useParams, useResolvedPath} from 'react-router-dom';
import axios from 'axios';
import { useEffect } from 'react';
import { getUserById, updateUser } from 'services/userService';
import { AdapterDayjs } from '@mui/x-date-pickers/AdapterDayjs';
import { LocalizationProvider } from '@mui/x-date-pickers/LocalizationProvider';
import { DatePicker } from '@mui/x-date-pickers/DatePicker';
import dayjs from 'dayjs';
function EditUser() {
    const location = useLocation();
    const navigate = useNavigate();
    const [myFile, setMyfile] = useState(null);
    const [message, setMessage]= useState(null);
    const [user, setUser] = useState({
        username: '',
        name: '',
        phone: '',
        birthday: '',
        address: '',
        status: '',
    });
    
    const [srcFile, setSrcFile] = useState('http://localhost:80/image/customer/'+ user.image); //at here
    const {id} = useParams();
    const [open, setOpen] = React.useState(false);
    const handleClose = () => {
      setOpen(false);
    }
    React.useEffect(() => {
      async function fetchData() {
        try {
          const response = await getUserById(id);
          console.log(response[0]);
          setUser(response[0]);
          setSrcFile('http://localhost:80/image/customer/'+response[0].image);
          console.log(user);
        } catch (error) {
          console.error(error);
        }
      }
      fetchData();
    }, []);

    const handleChange = (e) => {
        const { name, value } = e.target;
        setUser({ ...user, [name]: value });
    }
    const handleSubmit = async (e) => {
        // e.preventDefault();
        // updateuser(id, user).then(function(response){
        //     navigate('/user');
        // }
        // );
        e.preventDefault();
        const data = new FormData();
        data.append('id', id);
        data.append('username', user.username);
        data.append('name', user.name);
        data.append('phone', user.phone);
        data.append('address', user.address);
        data.append('birthday', user.birthday);
        data.append('status', user.status);
        data.append('image', myFile);

        const response = await updateUser(data);
        console.log(response);
        if(response.status==200){
          setMessage("Edit user successfully!");
        } else{
          setMessage("Edit user fail!");
        } 
        setOpen(true);
        setTimeout(()=> {
          navigate('/users');
        }, 2000);
    }

    const handleFile =  (e) => {
        e.preventDefault();
        const file =  e.target.files[0];
        // setUser({ ...user, image: file });
        setMyfile(file);
        
        console.log("name of file is " + file.name);
    }
  return (

      <div>
      <h1 > EDIT user</h1>

     <Box
      component="form"
      sx={{
        '& > :not(style)': { m: 1, width: "100%" },
      }}
      noValidate
      autoComplete="off"
    >
      <TextField value={user.name} id="outlined-basic" label="Name" variant="outlined" type="text" required name="name" onChange={handleChange}/>
      <TextField value={user.phone} id="filled-basic" label="Phone" variant="filled" type="text" required name="phone" onChange={handleChange}/>
      <TextField value={user.address} id="amo" label="Address" variant="filled" type="text" required name="address" onChange={handleChange}/>
      {/* <TextField value={user.birthday} id="amo" label="Birthday" variant="filled" type="date" required name="amount" onChange={handleChange}/> */}
       <LocalizationProvider dateAdapter={AdapterDayjs} >
        <DatePicker label= "Birthday" value = {dayjs(user.birthday)}
        onChange={(date) => handleChange({ target: { name: 'birthday', value: date.toISOString() } })}
        renderInput={(params) => <TextField {...params} />}
         />
      </LocalizationProvider>
     
      <InputLabel id="status">Status</InputLabel>
      <Select
            labelId="Status"
            id="status"
            value={user.status}
            label="Status"
            onChange={handleChange}
            name="status"
        >

            <MenuItem value="VIP">VIP</MenuItem>
            <MenuItem value="normal">Normal</MenuItem>
            <MenuItem value="Ban">Ban</MenuItem>
            <MenuItem value={""}></MenuItem>
        </Select>
      
      <img src={srcFile} alt="image" width="100px" height="100%"></img>
      <input  type='file' id="file" lable= "image" name="image" onChange={handleFile} ></input>
      <Button variant="contained" onClick={handleSubmit}>Submit</Button>
      <p>{message}</p>
    </Box>
    <Snackbar
    anchorOrigin={{ vertical: 'top', horizontal: 'center' }}
    open={open}
    onClose= {handleClose}
    message="Chỉ được chọn một sản phẩm để sửa!"
    >
        <Alert onClose={handleClose} severity="success" sx={{ width: '100%' }}>
           Create user successfully!
        </Alert>
    </Snackbar>
    </div>
  )
}

export default EditUser;
