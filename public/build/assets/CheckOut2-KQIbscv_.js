import{_ as S,u as E,k as I,a as g,e as f,c as n,b as t,d as o,w as l,f as a,t as r,g as m,h as y,v as P,i as C,r as c,o as i,j as D}from"./index-BCy9y8-H.js";import{l as $,_ as M}from"./vodafone-cash-Y0KcvFZJ.js";const F={name:"checkout",data:()=>({subDomain:"",errorMessage:"",mark:!1,disable:!0,errorMsg:"",color:"",res:{},cash:"card",isOpen:!1,type:"",amount:"",image:null,plan:{},walletPhone:"",isPaying:!1,domainMsg:"You must enter a valid sub domain first.",loader:!1,valueMonth:300,valueYear:3e3,domainError:"",planError:"",receiptError:"",package:{},paymentIntentId:"",paymentIntent:"",clientSecret:"",stripe:null,cardElement:null,stripeKey:"pk_test_51OOMOtK2t4I8yGl8aqXfrvJOdLScxRJ34dCEdYRaMpwuwvaxOBDLf3SdRmUXCAHlLsG8LbTprI8IB5h8llHZLmUc007scTeX5f",route:E(),router:I()}),methods:{getSinglrPackage(){g.get(`${f}packages/${this.route.params.packageId}`,{headers:{Authorization:`Bearer ${localStorage.getItem("token")}`}}).then(s=>{console.log(s.data),this.package=s.data.data.package_details,this.package.user=localStorage.getItem("authUser")?JSON.parse(localStorage.getItem("authUser")):null,this.valueYear=this.package.price_monthly,this.valueMonth=this.package.Price_monthly,console.log("single package",this.package)})},checkStripeFields(){return this.subDomain===""&&(this.domainError="ackage.Price_annuallyFill this field."),this.type===""&&(this.planError="Fill this field."),!(this.subDomain===""||this.type==="")},handleStripePayment(){this.loader=!0,this.stripe.confirmCardPayment(this.clientSecret,{payment_method:{card:this.cardElement}}).then(()=>g.post(f+"payment/complete",{headers:{Authorization:`Bearer ${localStorage.getItem("token")}`},params:{id:this.paymentIntentId,payment_intent:this.paymentIntent,client_secret:this.clientSecret}})).then(s=>{+s.status==200?router.push("/success"):alert("Somthing went wrong")}).catch(s=>{console.error(s),alert("Failed to complete payment")})},proceedToPayment(){if(!this.checkStripeFields())return!1;this.type=="1"?this.package.price_monthly:this.package.price_annually,g.post(`${f}payment/initiate`,{package_id:this.package.id,package_type:this.type,domain_name:this.subDomain,user_id:this.package.user.id},{headers:{Authorization:`Bearer ${localStorage.getItem("token")}`}}).then(e=>e.status!=200?(console.log("not 200"),Promiserr.reject(error)):(this.isPaying=!0,this.paymentIntentId=e.data.data.id,this.paymentIntent=e.data.data.payment_intent,this.clientSecret=e.data.data.client_secret,$(this.stripeKey))).then(e=>{this.stripe=e;const v=this.stripe.elements();this.cardElement=v.create("card"),this.cardElement.mount("#card-element")}).catch(e=>(console.error("Error............",e),this.paymentError=e.message||"An error occurred during payment processing.",Promiserr.reject(e)))}},mounted(){this.getSinglrPackage()}},L={class:"payment-page pt-5 pb-5 container"},j={class:"row g-3"},A={class:"col-lg-12"},B={class:"bread-crumb d-flex align-items-center"},O={class:"row"},z={class:"col-lg-6 col-md-12 col-12"},T={class:"d-flex flex-lg-row flex-md-column flex-column text-md-center text-lg-start text-center justify-content-between"},U={class:"right-side d-flex gap-4 align-items-center justify-content-center"},V={class:"text-center"},Y={class:"text-center"},N={class:"check-input"},R={class:"d-flex gap-2 align-items-center"},G={class:"text-error"},K={for:"subDomain",class:"form-label text-dark fw-semibold mb-2 mt-3 d-flex justify-content-between align-items-center"},q={key:0,class:"fw-bold text-success pe-4"},J={key:1,class:"fw-bold text-success pe-4"},X={class:"text-error"},H={class:"col-lg-6 col-md-12 col-12"},Z={key:0,class:"form mt-4"},Q={class:"card rounded-2 p-3"},W={class:"card-title fw-bold text-center"},ee={key:0,class:"fw-bold text-success"},te={key:1,class:"fw-bold text-success"},se={key:2,class:"fw-bold text-success"},ae={class:"row g-3"},oe={class:"col-12"},le={class:"col-12"},ne={class:"text-error"},re={key:1},ie={class:"mt-0"},de={key:0,class:"text-center text-primary fs-5 mt-3"},me={class:"fw-bold pt-3"},pe={class:"phone d-flex align-items-center gap-2 justify-content-center"},ce={class:"text-center"},ue={href:"tel:01110010489",class:"text-primary"},ge={href:"mailto:omaradelbakry375@gmail.com"};function fe(s,e,v,ye,ve,h){const b=c("router-link"),u=c("v-icon"),k=c("v-progress-circular"),w=c("v-card"),x=c("v-btn");return i(),n("div",L,[t("div",j,[t("div",A,[e[35]||(e[35]=t("h2",{class:"fw-bold"},"Kashear Checkout",-1)),t("div",B,[o(b,{to:"/",class:"text-black text-decoration-none"},{default:l(()=>e[8]||(e[8]=[a("Kashear")])),_:1}),o(u,null,{default:l(()=>e[9]||(e[9]=[a("mdi-chevron-right")])),_:1}),o(b,{class:"text-black text-decoration-none"},{default:l(()=>e[10]||(e[10]=[a("Checkout ")])),_:1})]),t("div",O,[t("div",z,[o(w,{class:"p-3 mt-3 payment-card border-1",elevation:"0"},{default:l(()=>[e[14]||(e[14]=t("h4",{class:"text-center fw-bold mb-4 mt-2"},"Package Name",-1)),t("div",T,[e[13]||(e[13]=t("div",{class:"left-side pb-lg-0 pb-md-4 pb-4"},[t("h5",{class:"fw-bold"},"Payment Amount"),t("p",{class:"mb-0"},[a(" All Transactions Are Secure "),t("br"),a(" in both ways card and cash payment ")])],-1)),t("div",U,[t("div",V,[o(k,{"model-value":s.package.Price_monthly,rotate:360,size:70,width:2,color:"yellow"},{default:l(()=>[a(r(s.package.Price_monthly)+" LE",1)]),_:1},8,["model-value"]),e[11]||(e[11]=t("p",{class:"mb-0 pt-2"},"Month",-1))]),t("div",Y,[o(k,{"model-value":s.package.Price_annually,rotate:360,size:70,width:2,color:"yellow"},{default:l(()=>[a(r(s.package.Price_annually)+" LE",1)]),_:1},8,["model-value"]),e[12]||(e[12]=t("p",{class:"mb-0 pt-2"},"Year",-1))])])])]),_:1}),o(w,{class:"p-3 mt-3 payment-card border-1",elevation:"0"},{default:l(()=>{var d,_;return[t("div",null,[t("div",N,[e[15]||(e[15]=t("label",{for:"subDomain",class:"form-label text-dark fw-semibold mb-2 mt-3"}," Enter Sub Domain* :",-1)),t("div",R,[y(t("input",{class:"form-control rounded-5 py-2","onUpdate:modelValue":e[0]||(e[0]=p=>s.subDomain=p),type:"text",required:"",onChange:e[1]||(e[1]=p=>s.domainError="")},null,544),[[P,s.subDomain]])]),t("p",G,r(s.domainError),1)]),t("label",K,[e[16]||(e[16]=t("span",null,"Select Plan* :",-1)),s.type==1?(i(),n("span",q,r((d=s.package)==null?void 0:d.Price_monthly)+" LE",1)):m("",!0),s.type==2?(i(),n("span",J,r((_=s.package)==null?void 0:_.Price_annually)+" LE",1)):m("",!0)]),y(t("select",{class:"form-select rounded-5 pt-2","aria-label":"Default select example","onUpdate:modelValue":e[2]||(e[2]=p=>s.type=p),onChange:e[3]||(e[3]=p=>s.planError=""),required:""},e[17]||(e[17]=[t("option",{value:"",selected:""},"Select Your Plan",-1),t("option",{value:"1"},"Monthly",-1),t("option",{value:"2"},"Yearly",-1)]),544),[[D,s.type]]),t("p",X,r(s.planError),1)])]}),_:1}),o(x,{class:"elevation-0 mt-4 bg-primary text-capitalize d-lg-flex d-md-none d-none","prepend-icon":"mdi-chevron-left",onClick:e[4]||(e[4]=d=>s.$router.push("/"))},{default:l(()=>e[18]||(e[18]=[a("Go Back")])),_:1})]),t("div",H,[e[34]||(e[34]=t("div",{class:"payment-methods mt-3"},[t("div",{class:"d-flex gap-2 align-items-center"})],-1)),s.cash=="wallet"?(i(),n("div",Z,[t("div",Q,[t("div",W,[t("h4",null,[e[19]||(e[19]=a(" Please Send this amount ")),s.type==1?(i(),n("span",ee,r(s.valueMonth)+" EGP ",1)):m("",!0),s.type==2?(i(),n("span",te,r(s.valueYear)+" EGP ",1)):m("",!0),s.type==""?(i(),n("span",se," (select_plan...) ")):m("",!0),e[20]||(e[20]=a(" payment and upload the receipt "))]),e[21]||(e[21]=t("div",{class:"d-flex gap-1 align-items-center justify-content-center"},[t("div",{class:"d-flex gap-1 align-items-center"},[t("img",{src:M,width:"50",alt:""}),t("h4",{class:"fw-bold"},"+994 5567 23")])],-1))]),t("div",ae,[t("div",oe,[e[22]||(e[22]=t("label",{for:"name",class:"form-label text-dark fw-semibold mb-1"}," Amount :",-1)),y(t("input",{class:"form-control rounded-5 py-2",type:"text","onUpdate:modelValue":e[5]||(e[5]=d=>s.amount=d),disabled:"disable"},null,512),[[P,s.amount]])]),t("div",le,[e[23]||(e[23]=t("label",{for:"name",class:"form-label text-dark fw-semibold mb-1"}," Receipt :",-1)),t("input",{type:"file",class:"form-control rounded-5",id:"inputGroupFile01",onChange:e[6]||(e[6]=d=>s.receiptError="")},null,32),t("p",ne,r(s.receiptError),1)])]),e[24]||(e[24]=t("input",{type:"button",class:"btn btn-primary mt-3 text-white",value:"Submit"},null,-1))])])):m("",!0),s.cash=="card"?(i(),n("div",re,[t("div",ie,[t("input",{class:"w-100 btn btn-warning text-white",value:"Proceed to Payment",type:"button",onClick:e[7]||(e[7]=(...d)=>h.proceedToPayment&&h.proceedToPayment(...d))}),s.isLoading?(i(),n("div",de," Loading... ")):m("",!0)]),e[25]||(e[25]=C('<div class="mt-3 bg-white p-3 rounded-4" data-v-02568e93><div class="d-flex gap-5" data-v-02568e93><form class="mt-3" data-v-02568e93><div id="card-element" data-v-02568e93></div><div class="d-flex justify-content-center gap-3 mt-4" data-v-02568e93><button class="btn btn-primary" type="submit" data-v-02568e93> Confirm Payment </button><div class="btn btn-danger" data-v-02568e93>Cancel</div></div></form></div></div>',1))])):m("",!0),t("h6",me,[t("div",pe,[t("span",ce,[e[30]||(e[30]=a(" For Customer Servece : ")),t("a",ue,[o(u,{size:"small",color:"green"},{default:l(()=>e[26]||(e[26]=[a("mdi-phone")])),_:1}),e[27]||(e[27]=a("01110010489"))]),e[31]||(e[31]=t("br",null,null,-1)),e[32]||(e[32]=t("span",null,"OR",-1)),e[33]||(e[33]=t("br",null,null,-1)),t("a",ge,[o(u,{size:"small",color:"green"},{default:l(()=>e[28]||(e[28]=[a("mdi-email")])),_:1}),e[29]||(e[29]=a(" omaradelbakry375@gmail.com"))])])])])])])])])])}const ke=S(F,[["render",fe],["__scopeId","data-v-02568e93"]]);export{ke as default};
