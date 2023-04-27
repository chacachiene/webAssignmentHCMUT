import axios from 'axios';

const PRO_API_URL = process.env.REACT_APP_URL + '/dashboard/getNumOfProductSellInDay.php'; 
export const getNumberProduct = async() =>{
    try{
        const response = await axios.get(PRO_API_URL);     
        console.log(response.data);
        return response.data;
    } catch(error){
        console.log(error);
        return null;
    }
}
const SELL_API_URL = process.env.REACT_APP_URL + '/dashboard/getTotalNotSell.php'; 
export const getProductNotSell = async()=>{
    try{
        const response = await axios.get(SELL_API_URL);     
        console.log(response.data);
        return response.data;
    } catch(error){
        console.log(error);
        return null;
    }
}
const ACT_API_URL = process.env.REACT_APP_URL + '/dashboard/getUserActiveStatus.php'; 
export const getUserActive = async()=>{
    try{
        const response = await axios.get(ACT_API_URL);     
        console.log(response.data);
        return response.data;
    } catch(error){
        console.log(error);
        return null;
    }
}
// const OFF_API_URL = process.env.REACT_APP_URL + '/dashboard/getTotalNotSell.php'; 
// export const getUserOff = async()=>{
//     try{
//         const response = await axios.get(OFF_API_URL);     
//         console.log(response.data);
//         return response.data;
//     } catch(error){
//         console.log(error);
//         return null;
//     }
// }

const TYPE_API_URL = process.env.REACT_APP_URL + '/dashboard/getTotalNotSellEachType.php';
export const getProductType = async()=>{
    try{
        const response = await axios.get(TYPE_API_URL);     
        console.log(response.data);
        return response.data;
    } catch(error){
        console.log(error);
        return null;
    }
}
