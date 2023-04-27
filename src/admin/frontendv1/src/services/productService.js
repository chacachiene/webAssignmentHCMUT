import axios from 'axios';

const PRO_API_URL = process.env.REACT_APP_URL + '/product/index.php'; //index.php


export const getProducts = async() =>{
    try{
       
        const response = await axios.get(PRO_API_URL);
        
        return response.data;
    } catch(error){
        console.log(error);
        return null;
    }
}
export const createProduct = async (product)=>{
    try{
        const response= await axios.post(PRO_API_URL, product, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
        console.log(response);
        if(response.status == 200){
            return response.data;
        }
        else {
            return response.statusText;
        }
    } catch(error){
        console.log(error);
        return null;
    }
}
export const getProductById = async (productId) =>{
    try{
        const response = await axios.get(PRO_API_URL + '/' + productId);
        return response.data;
    } catch(error){
        console.log(error);
        return null;
    }
}

export const updateProduct= async (product) =>{
    try{
        //const response = await axios.put(PRO_API_URL + '/' + productId+'/edit', product);
        
        const response = await axios.post(PRO_API_URL, product, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
        if(response.status == 200){
            return response.data;
        }
        else {
            return response.statusText;
        }
    } catch(error){
        console.log(error);
        return null;
    }
}

export const deleteProduct = async (productIds)=>{
    try{
        const response = await axios.delete(PRO_API_URL + '/' + productIds+'/delete');
        console.log(response);
       
        return response;
    } catch(error){
        console.log(error);
        return null;
    }
}
const COM_API_URL=process.env.REACT_APP_URL + '/product/comment.php'; //index.php
export const getCommentById = async (productId) =>{
    try{
        const response = await axios.get(COM_API_URL + '/' + productId);
        return response.data;
    }
    catch(error){
        console.log(error);
        return null;
    }
}