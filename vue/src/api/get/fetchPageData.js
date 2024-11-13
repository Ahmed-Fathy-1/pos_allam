import api from '..';

const fetchPageData = async (path)=>{
    let data = null;
    let token = '';
    
    if (localStorage.getItem('token') && localStorage.getItem('token') !== 'undifined') {
        token = localStorage.getItem('token');
    }

    try{
       await api.get(`${path}`, {
            headers:{
                'Authorization': `Bearer ${token}`
            }
        }).then((response) => {
            data = response.data.data;
            //console.log(response.data);
          //  token = response.data.data.token;
           // localStorage.setItem('token', token);
        });
    }
    catch(error){
        console.log(error);
    }    
    return data
}

export default fetchPageData;