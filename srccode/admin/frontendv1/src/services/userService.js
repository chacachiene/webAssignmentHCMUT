import axios from 'axios';

const PRO_API_URL = process.env.REACT_APP_URL + '/user/index.php'; //index.php


export const getUsers = async() =>{
    try{
        console.log(PRO_API_URL);
        const response = await axios.get(PRO_API_URL);
        console.log(response.data);
        return response.data;
    } catch(error){
        console.log(error);
        return null;
    }
}
// export const createUser = async (User)=>{
//     try{
//         const response = await axios.post(PRO_API_URL, User);
//         return response.data;
//     } catch(error){
//         console.log(error);
//         return null;
//     }
// }
export const getUserById = async (UserId) =>{
    try{
        const response = await axios.get(PRO_API_URL + '/' + UserId);
        console.log(PRO_API_URL + '/' + UserId);
        return response.data;
    } catch(error){
        console.log(error);
        return null;
    }
}

export const updateUser= async (User) =>{
    try{
        const response = await axios.post(PRO_API_URL, User, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
        return response.data;
    } catch(error){
        console.log(error);
        return null;
    }
}

export const deleteUser = async (UserIds)=>{
    try{
        const response = await axios.delete(PRO_API_URL + '/' + UserIds+'/delete');
        //console.log(response);
        return response;
    } catch(error){
        console.log(error);
        return null;
    }
}