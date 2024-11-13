import api from '..';

const payPackage = async (path, body)=>{
    let data = null;
    let token = '';
    
    if (localStorage.getItem('token') && localStorage.getItem('token') !== 'undifined') {
        token = localStorage.getItem('token');
    }

    try{
       await api.post(`${path}`, body , {
            headers:{
                'Authorization': `Bearer ${token}`
            },

        }).then((response) => {
            data = response.data.data;

            //console.log(response.data);
          //  token = response.data.data.token;
           // localStorage.setItem('token', token);
        });
    }
    catch(error){
       // data = null
        console.log(error);
    }    
    return data
}

export default payPackage;