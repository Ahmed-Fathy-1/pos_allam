import{_ as l,R as _,l as m,o as i,c,b as e,f as p,s as h,x as b,d}from"./index-BCy9y8-H.js";import{a as I}from"./index-BTnv5gsp.js";const v=async(s,a)=>{let t=null,n="";localStorage.getItem("token")&&localStorage.getItem("token")!=="undifined"&&(n=localStorage.getItem("token"));try{await I.post(`${s}`,a,{headers:{Authorization:`Bearer ${n}`}}).then(r=>{t=r.data.data})}catch(r){console.log(r)}return t},N={components:{RatingServices:_},setup(){const s=m(null),a=m({name:"",email:"",subject:"",phone:"",message:""}),t=m(""),n=m("");return{formRef:s,messageInfo:a,error:t,successMessage:n,handleMessageInfoChange:o=>{const{name:u,value:g}=o.target;a.value[u]=g},handleSubmitMessage:async()=>{try{v("contact-us",a.value)}catch(o){t.value="An error occurred: "+o.message,console.error("Error:",o)}}}}},k={class:"contact__form form-contact"},C={class:"input-wrapper"},M={class:"input-wrapper"},S={class:"input-wrapper"},x={class:"input-wrapper"},w={class:"input-wrapper"};function y(s,a,t,n,r,f){return i(),c("div",k,[a[12]||(a[12]=e("h2",null,[p("Message "),e("span",null,"Saas cashier")],-1)),e("form",{ref:"formRef",onSubmit:a[5]||(a[5]=h((...o)=>n.handleSubmitMessage&&n.handleSubmitMessage(...o),["prevent"])),action:"http://localhost:5000/mails",method:"POST"},[e("div",C,[a[6]||(a[6]=e("label",{for:"name"},"Enter Your Name *",-1)),e("input",{type:"text",id:"name",name:"name",onInput:a[0]||(a[0]=(...o)=>n.handleMessageInfoChange&&n.handleMessageInfoChange(...o)),required:""},null,32)]),e("div",M,[a[7]||(a[7]=e("label",{for:"email"},"Enter Your Email *",-1)),e("input",{type:"email",id:"email",name:"email",onInput:a[1]||(a[1]=(...o)=>n.handleMessageInfoChange&&n.handleMessageInfoChange(...o)),required:""},null,32)]),e("div",S,[a[8]||(a[8]=e("label",{for:"subject"},"Enter Msg Title *",-1)),e("input",{type:"text",id:"subject",name:"subject",onInput:a[2]||(a[2]=(...o)=>n.handleMessageInfoChange&&n.handleMessageInfoChange(...o)),required:""},null,32)]),e("div",x,[a[9]||(a[9]=e("label",{for:"phone"},"Enter Your Phone",-1)),e("input",{type:"tel",id:"phone",name:"phone",onInput:a[3]||(a[3]=(...o)=>n.handleMessageInfoChange&&n.handleMessageInfoChange(...o))},null,32)]),e("div",w,[a[10]||(a[10]=e("label",{for:"message"},"Your Message *",-1)),e("textarea",{id:"message",name:"message",onInput:a[4]||(a[4]=(...o)=>n.handleMessageInfoChange&&n.handleMessageInfoChange(...o)),required:""},null,32)]),a[11]||(a[11]=e("button",{type:"submit",class:"submit"},"Submit",-1))],544)])}const R=l(N,[["render",y],["__scopeId","data-v-62bb80de"]]),E="/mail.png",A="/phone.png",$="/location.png",Y="/facebook.png",P="/linkedin.png",T="/github.png",O="/whatsapp.png",V={},B={className:"social-bar"};function j(s,a){return i(),c("div",B,a[0]||(a[0]=[e("a",{className:"facebook",href:"https://web.facebook.com/facebook.comibrahimyoussef.saleh/?locale=ar_AR",target:"_blank",rel:"noopener noreferrer"},[e("img",{src:Y,alt:"f"})],-1),e("a",{className:"linkedin",href:"https://web.facebook.com/facebook.comibrahimyoussef.saleh/?locale=ar_AR",target:"_blank",rel:"noopener noreferrer"},[e("img",{src:P,alt:"In"})],-1),e("a",{className:"github",href:"https://web.facebook.com/facebook.comibrahimyoussef.saleh/?locale=ar_AR",target:"_blank",rel:"noopener noreferrer"},[e("img",{src:T,alt:"git"})],-1),e("a",{className:"whatsapp",href:"https://web.facebook.com/facebook.comibrahimyoussef.saleh/?locale=ar_AR",target:"_blank",rel:"noopener noreferrer"},[e("img",{src:O,alt:"Wup"})],-1)]))}const q=l(V,[["render",j],["__scopeId","data-v-52a8b478"]]),D={className:"contact__info flex-1"},W=b({__name:"ContactInfo",setup(s){return(a,t)=>(i(),c("div",D,[t[0]||(t[0]=e("h2",null,[p("contact "),e("span",null,"information")],-1)),t[1]||(t[1]=e("p",null," You can find me via all these soical for hiring or freelancing work, or send me mail via form. ",-1)),t[2]||(t[2]=e("div",{className:"contact__list"},[e("a",{target:"_blank",rel:"noopener",href:"https://mailto:ibrahimYoussef95.12@gmail.com",className:"contact-item"},[e("div",{className:"flex-center"},[e("img",{src:E,alt:"mail"})]),e("div",null,[e("h3",null,"Email"),e("p",null,"ibrahimYoussef95.12@gmail")])]),e("a",{target:"_blank",rel:"noopener",href:"tel:01147359396",className:"contact-item"},[e("div",{className:"flex-center"},[e("img",{src:A,alt:"mobile"})]),e("div",null,[e("h3",null,"Phone"),e("p",null,"01147359396")])]),e("div",{className:"contact-item"},[e("div",{className:"flex-center"},[e("img",{src:$,alt:"location"})]),e("div",null,[e("h3",null,"Residence"),e("p",null,"Egypt, Cairo")])])],-1)),t[3]||(t[3]=e("h3",null,[e("i",{className:"fa-solid fa-user"}),e("span",null,"Visit my social profiles and get contact ")],-1)),d(q)]))}}),F=l(W,[["__scopeId","data-v-e62be02c"]]),G={},U={class:"intro"};function z(s,a){return i(),c("section",U,a[0]||(a[0]=[e("h1",{className:"logo page-heading mb-1"},[p(" Get In "),e("span",{className:"spiceal"}," Touch ")],-1),e("p",{className:"text-center"},[e("span",{className:"upper"},"I’M "),p("ALWAYS OPEN TO DISCUSS PRODUCT DESIGN WORK OR PARTNERSHIPS ")],-1)]))}const H=l(G,[["render",z],["__scopeId","data-v-08684702"]]),K={className:"contact"},L={className:"container"},J={className:"contact__content "},Q={__name:"ContactView",setup(s){return(a,t)=>(i(),c("div",K,[e("div",L,[d(H),e("div",J,[d(F),d(R)])])]))}},ee=l(Q,[["__scopeId","data-v-a7238c33"]]);export{ee as default};
