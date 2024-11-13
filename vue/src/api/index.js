import axios from "axios";


const api = axios.create({
   baseURL: "http://cashier.test/api/",
   timeout:0
 });


 export default api



