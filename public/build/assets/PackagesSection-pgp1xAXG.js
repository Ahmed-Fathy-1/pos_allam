import{_ as $,l as x,k as A,m as B,r as I,o as t,c as n,b as s,h as N,H as z,F as E,y as O,C as F,t as o,f as r,g as M,d as D,w as R,D as Y}from"./index-BCy9y8-H.js";import{f as j}from"./fetchPageData-mQ_U3Tfr.js";import"./index-BTnv5gsp.js";const q="data:image/svg+xml,%3csvg%20width='107'%20height='88'%20viewBox='0%200%20107%2088'%20fill='none'%20xmlns='http://www.w3.org/2000/svg'%3e%3cpath%20d='M95.4464%2061.8223C83.1573%2064.886%2068.4838%2065.4681%2057.6839%2057.7308C50.7821%2052.7862%2047.1171%2042.7876%2049.6965%2034.672C52.1325%2027.0074%2057.8212%2020.273%2066.3458%2020.4783C70.7891%2020.5853%2074.6202%2022.6296%2075.4291%2027.3089C76.6648%2034.4578%2069.5332%2041.8557%2063.863%2044.9653C46.1673%2054.67%2021.1341%2054.13%204.27692%2042.8655'%20stroke='%23007AFF'%20stroke-width='3'%20stroke-linecap='round'/%3e%3cpath%20d='M11.7068%2056.0693C9.64482%2053.1881%205.14208%2046.4664%203.62681%2042.63'%20stroke='%23007AFF'%20stroke-width='3'%20stroke-linecap='round'/%3e%3cpath%20d='M3.62689%2042.6304C7.13954%2042.1669%2015.1239%2040.8611%2018.9603%2039.3458'%20stroke='%23007AFF'%20stroke-width='3'%20stroke-linecap='round'/%3e%3c/svg%3e",G={class:"package mt-4"},H={class:"col-10 mr-auto ml-auto"},L={class:"row gy-3"},T={class:"d-flex justify-content-center mt-6"},U={class:"button-switch d-flex gap-3 align-items-center position-relative"},W={class:"form-check form-switch"},J={class:"card-body"},K={key:0,class:"price"},Q={key:1,class:"price"},X={class:"points mt-4"},Z={class:"point mb-2"},m={key:0},ss={class:"mb-0"},as={key:1},ls={class:"mb-0"},os={class:"mb-0"},ts={class:"mb-0"},ns={class:"mb-0"},es={class:"mb-0"},rs={class:"mb-0"},cs={class:"mb-0"},ds={key:2},us={class:"mb-0"},is={key:3},ps={class:"mb-0"},_s={class:"mb-0"},gs={__name:"Package",setup(S){const e=x(!0),c=x(null);return A(),B(async()=>{try{c.value=await j("packages"),console.log(c.value)}catch(u){console.error("Error fetching page data:",u)}}),(u,l)=>{const V=I("v-btn");return t(),n("div",G,[s("div",H,[s("div",L,[s("div",T,[s("div",U,[l[1]||(l[1]=s("span",null,"Pay Monthly ",-1)),s("div",W,[N(s("input",{class:"form-check-input",type:"checkbox",role:"switch","onUpdate:modelValue":l[0]||(l[0]=a=>e.value=a),id:"flexSwitchCheckDefault"},null,512),[[z,e.value]])]),l[2]||(l[2]=s("img",{src:q,class:"arrow",alt:"",loading:"lazy"},null,-1)),l[3]||(l[3]=s("p",{class:"mb-0 text-primary position-absolute right-0 descount"}," Save 25% ",-1)),l[4]||(l[4]=s("span",null,"Pay Yearly",-1))])]),(t(!0),n(E,null,O(Y(c.value),(a,d)=>{var i,p,_,g,k,h,v,y,b,w,f,C,P;return t(),n("div",{class:"col-lg-4 col-md-12 col-12",key:d},[s("div",{class:F(["card border-0",{"recommended-package":d==1}])},[s("div",J,[s("h4",null,o(a.title),1),s("p",null,o(a==null?void 0:a.description),1),e.value==!1?(t(),n("h3",K,[r(" $"+o((i=a==null?void 0:a.package_details)==null?void 0:i.Price_monthly)+" ",1),l[5]||(l[5]=s("sub",null,"/Month",-1))])):M("",!0),e.value==!0?(t(),n("h3",Q,[r(" $"+o((p=a==null?void 0:a.package_details)==null?void 0:p.Price_annually)+" ",1),l[6]||(l[6]=s("sub",null,"/Year",-1))])):M("",!0),D(V,{class:F([{"text-white":d==1,"text-primary":d==0||d==2},"text-capitalize elevation-0 mt-3 w-100"]),onClick:ys=>u.$router.push({name:"Checkout2",params:{packageId:a.id}}),variant:"outlined"},{default:R(()=>l[7]||(l[7]=[r("get start now")])),_:2},1032,["class","onClick"]),s("div",X,[s("div",Z,[e.value==!0?(t(),n("article",m,[l[8]||(l[8]=s("h3",null,"Price annually : ",-1)),s("p",ss,o((_=a==null?void 0:a.package_details)==null?void 0:_.Price_annually),1)])):(t(),n("article",as,[l[9]||(l[9]=s("h3",null,"Price monthly : ",-1)),s("p",ls,o((g=a==null?void 0:a.package_details)==null?void 0:g.Price_monthly),1)])),s("article",null,[l[10]||(l[10]=s("h3",null,"custom branding : ",-1)),s("p",os,o((k=a==null?void 0:a.package_details)==null?void 0:k.custom_branding),1)]),s("article",null,[l[11]||(l[11]=s("h3",null,"interactive archives : ",-1)),s("p",ts,o((h=a==null?void 0:a.package_details)==null?void 0:h.interactive_archives),1)]),s("article",null,[l[12]||(l[12]=s("h3",null,"main search : ",-1)),s("p",ns,o((v=a==null?void 0:a.package_details)==null?void 0:v.main_search),1)]),s("article",null,[l[13]||(l[13]=s("h3",null,"main show : ",-1)),s("p",es,o((y=a==null?void 0:a.package_details)==null?void 0:y.main_show),1)]),s("article",null,[l[14]||(l[14]=s("h3",null," priority : ",-1)),s("p",rs,o((b=a==null?void 0:a.package_details)==null?void 0:b.priority),1)]),s("article",null,[l[15]||(l[15]=s("h3",null,"statics : ",-1)),s("p",cs,o((w=a==null?void 0:a.package_details)==null?void 0:w.statics),1)]),e.value==!0?(t(),n("article",ds,[l[16]||(l[16]=s("h3",null,"storage annually : ",-1)),s("p",us,o((f=a==null?void 0:a.package_details)==null?void 0:f.storage_annually),1)])):(t(),n("article",is,[l[17]||(l[17]=s("h3",null,"storage monthly : ",-1)),s("p",ps,o((C=a==null?void 0:a.package_details)==null?void 0:C.storage_monthly),1)])),s("article",null,[l[18]||(l[18]=s("h3",null,"Messages : ",-1)),s("p",_s,o((P=a==null?void 0:a.package_details)==null?void 0:P.messages),1)])])])])],2)])}),128))])])])}}},ks=$(gs,[["__scopeId","data-v-1b4724ed"]]),hs={class:"container pb-10"},vs={__name:"PackagesSection",setup(S){return(e,c)=>(t(),n("div",hs,[c[0]||(c[0]=s("div",{class:"title text-center"},[s("h1",null,[r(" Get awesome for your daily needs Our "),s("br"),r(" Pricing Plan, Our Features ")]),s("p",null,[r(" With bolts, you can increase customer adoption, meet compliance "),s("br"),r(" requirements, secure APIs, and future-proof your enterprise. ")])],-1)),D(ks)]))}},Cs=$(vs,[["__scopeId","data-v-317db559"]]);export{Cs as default};
