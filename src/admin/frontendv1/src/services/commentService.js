import axios from 'axios';

const PRO_API_URL = process.env.REACT_APP_URL + '/product/comment.php'; //index.php
export const getCommentById = async (productId) =>{
    try{
        console.log(PRO_API_URL+'/'+productId);
        const response = await axios.get(PRO_API_URL + '/' + productId);
        console.log(response);
        return response.data;
    } catch(error){
        console.log(error);
        return null;
    }
}
export const deleteComment = async (indx)=>{
    try{
        const response = await axios.delete(PRO_API_URL + '/' +indx);
        //console.log(response);
        return response;
    } catch(error){
        console.log(error);
        return null;
    }
}
