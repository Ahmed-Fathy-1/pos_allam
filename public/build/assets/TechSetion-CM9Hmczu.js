import{u as i}from"./media-CZZYbaBY.js";import{f as d}from"./fetchPageData-mQ_U3Tfr.js";import{_,l as u,m,o as t,c as s,b as e,F as p,y as g,C as h,n as f,t as v,D as y}from"./index-BCy9y8-H.js";import"./index-BTnv5gsp.js";const x={class:"tech mb-5"},w={class:"container"},S={class:"row gy-5 mt-5"},k={class:"tech-logo d-flex align-items-center gap-3"},B=["src"],T={__name:"TechSetion",setup(b){const{pageSize:c}=i(),a=u(null);return m(async()=>{try{a.value=await d("technologies")}catch(o){console.error("Error fetching page data:",o)}}),(o,n)=>(t(),s("div",x,[e("div",w,[n[0]||(n[0]=e("p",{class:"text-center"},"Our Tecnologies That We Work By",-1)),e("div",S,[(t(!0),s(p,null,g(y(a.value),(r,l)=>(t(),s("div",{class:"col-lg-3 col-md-6 col-6",key:l},[e("div",{class:h({"d-flex justify-content-center":f(c)>992})},[e("div",k,[e("img",{src:r.image_with_full_path,width:"60",alt:"vue-logo",loading:"lazy"},null,8,B),e("span",null,v(r.name),1)])],2)]))),128))])])]))}},E=_(T,[["__scopeId","data-v-1e131d76"]]);export{E as default};
