var f="https://js.stripe.com/v3",m=/^https:\/\/js\.stripe\.com\/v3\/?(\?.*)?$/,s="loadStripe.setLoadParameters was called but an existing Stripe.js script already exists in the document; existing script parameters will be used",w=function(){for(var r=document.querySelectorAll('script[src^="'.concat(f,'"]')),e=0;e<r.length;e++){var t=r[e];if(m.test(t.src))return t}return null},c=function(r){var e="",t=document.createElement("script");t.src="".concat(f).concat(e);var n=document.head||document.body;if(!n)throw new Error("Expected document.body not to be null. Stripe.js requires a <body> element.");return n.appendChild(t),t},h=function(r,e){!r||!r._registerWrapper||r._registerWrapper({name:"stripe-js",version:"4.8.0",startTime:e})},a=null,l=null,d=null,E=function(r){return function(){r(new Error("Failed to load Stripe.js"))}},g=function(r,e){return function(){window.Stripe?r(window.Stripe):e(new Error("Stripe.js not available"))}},L=function(r){return a!==null?a:(a=new Promise(function(e,t){if(typeof window>"u"||typeof document>"u"){e(null);return}if(window.Stripe&&r&&console.warn(s),window.Stripe){e(window.Stripe);return}try{var n=w();if(n&&r)console.warn(s);else if(!n)n=c(r);else if(n&&d!==null&&l!==null){var o;n.removeEventListener("load",d),n.removeEventListener("error",l),(o=n.parentNode)===null||o===void 0||o.removeChild(n),n=c(r)}d=g(e,t),l=E(t),n.addEventListener("load",d),n.addEventListener("error",l)}catch(S){t(S);return}}),a.catch(function(e){return a=null,Promise.reject(e)}))},P=function(r,e,t){if(r===null)return null;var n=r.apply(void 0,e);return h(n,t),n},u,v=!1,p=function(){return u||(u=L(null).catch(function(r){return u=null,Promise.reject(r)}),u)};Promise.resolve().then(function(){return p()}).catch(function(i){v||console.warn(i)});var j=function(){for(var r=arguments.length,e=new Array(r),t=0;t<r;t++)e[t]=arguments[t];v=!0;var n=Date.now();return p().then(function(o){return P(o,e,n)})};const y="/assets/vodafone-cash-1uSWIxwd.png";export{y as _,j as l};
