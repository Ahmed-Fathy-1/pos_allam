import{_ as w,l as d,z as _,o as b,c as y,b as o,A as h,s as k,d as n,w as i,f as a,t as C,k as x,r as m}from"./index-BCy9y8-H.js";import{_ as S}from"./login-cover-BdXe3Wum.js";const E={class:"login-pag"},P={class:"row"},A={class:"col-lg-5 mt-4"},L={class:"container"},N={class:"content w-100 pt-5"},z={class:"mb-3"},B={class:"position-relative"},V={class:"mb-3"},D={class:"position-relative"},I=["type"],$={__name:"LoginPage",setup(j){const t=d(!0),p=d({name:"",email:""}),u=x(),c=_(),r=e=>{const{name:s,value:l}=e.target;p.value[s]=l},v=()=>{t.value=!t.value},f=async()=>{await c.login({email:"SuperAdmin@admin.com",password:"12345678"}),u.push("/")};return(e,s)=>{const l=m("v-icon"),g=m("router-link");return b(),y("div",E,[o("div",P,[o("div",A,[o("div",L,[o("div",{class:"image d-flex justify-content-center",onClick:s[0]||(s[0]=M=>e.$router.push("/"))},s[1]||(s[1]=[o("img",{src:h,width:"220",alt:"Logo"},null,-1)])),o("div",N,[s[8]||(s[8]=o("h2",null,"Sign In",-1)),s[9]||(s[9]=o("p",null,"Access the Dreamspos panel using your email and passcode.",-1)),o("form",{onSubmit:k(f,["prevent"]),class:"form pt-3 pb-3"},[o("div",z,[s[3]||(s[3]=o("label",{for:"email",class:"form-label"},"Email address",-1)),o("div",B,[n(l,{class:"email-icon position-absolute",size:"small",color:"#808080"},{default:i(()=>s[2]||(s[2]=[a("mdi-email-outline")])),_:1}),o("input",{type:"email",id:"email",class:"form-control",name:"email",placeholder:"Enter Email",onChange:r},null,32)])]),o("div",V,[s[4]||(s[4]=o("label",{for:"password",class:"form-label"},"Password",-1)),o("div",D,[n(l,{onClick:v,class:"eye-icon position-absolute",size:"small",color:"#808080"},{default:i(()=>[a(C(t.value?"mdi-eye":"mdi-eye-off"),1)]),_:1}),o("input",{type:t.value?"text":"password",id:"password",class:"form-control",name:"password",placeholder:"Enter Password",onChange:r},null,40,I)])]),s[5]||(s[5]=o("button",{type:"submit",class:"btn btn-primary text-white w-100 mt-4 fw-bold"},"Submit",-1))],32),o("p",null,[s[7]||(s[7]=a(" New on our platform? ")),n(g,{to:"/register",class:"text-black"},{default:i(()=>s[6]||(s[6]=[a("Create an account")])),_:1})])])])]),s[10]||(s[10]=o("div",{class:"col-lg-7 p-0 d-lg-block d-md-none d-none"},[o("img",{src:S,width:"100%",class:"vh-100",alt:"Cover"})],-1))])])}}},q=w($,[["__scopeId","data-v-765701aa"]]);export{q as default};
