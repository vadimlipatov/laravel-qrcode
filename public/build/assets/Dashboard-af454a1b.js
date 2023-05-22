import{m as $,o as r,f as d,b as e,F as b,p as k,t as l,u as c,r as m,q as C,j as B,k as f,a as _,w as v,Z as E,c as I,g as N,s as S}from"./app-b6e82b91.js";import{_ as V}from"./AuthenticatedLayout-83bbe59e.js";import{S as j}from"./Spinner-12722ffc.js";import{_ as q}from"./InputLabel-3da8a903.js";import"./ApplicationLogo-978fd475.js";import"./_plugin-vue_export-helper-c27b6911.js";const T={class:"w-full p-4 mx-auto text-center"},D=e("h1",{class:"text-lg mb-4"},"Участники",-1),L={class:"relative overflow-x-auto shadow-md sm:rounded-lg"},F={class:"w-full text-sm text-left text-gray-500"},R=e("thead",{class:"text-xs text-gray-700 uppercase bg-gray-100"},[e("tr",null,[e("th",{scope:"col",class:"px-6 py-3"},"Идентификатор"),e("th",{scope:"col",class:"px-6 py-3"},"Имя"),e("th",{scope:"col",class:"px-6 py-3"},"Фамилия"),e("th",{scope:"col",class:"px-6 py-3"},"Дата/время регистрации"),e("th",{scope:"col",class:"px-6 py-3"},"Печать")])],-1),A={key:0},M={scope:"row",class:"px-6 py-4 font-medium text-gray-900 whitespace-nowrap"},Q={class:"px-6 py-4"},Z={class:"px-6 py-4"},z={class:"px-6 py-4"},G={class:"px-6 py-4"},H=["onClick"],J={key:1},K=e("p",{class:"text-center p-2"},"Нет данных..",-1),O=[K],P={__name:"Table",props:{contacts:{type:Array}},setup(g){let{printCertificate:s}=$("printCertificate");return(n,h)=>(r(),d("div",T,[D,e("div",L,[e("table",F,[R,g.contacts.length?(r(),d("tbody",A,[(r(!0),d(b,null,k(g.contacts,a=>(r(),d("tr",{key:a.id,class:"bg-white border-b hover:bg-gray-50"},[e("th",M,l(a.item_id),1),e("td",Q,l(a.name),1),e("td",Z,l(a.last_name),1),e("td",z,l(a.created_at),1),e("td",G,[e("button",{onClick:u=>c(s)(a),class:"inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"}," Печать ",8,H)])]))),128))])):(r(),d("tbody",J,O))])])]))}},U=e("h2",{class:"font-semibold text-xl text-gray-800 leading-tight text-center"}," QR Code ",-1),W={class:"py-12"},X={class:"max-w-7xl mx-auto sm:px-6 lg:px-8"},Y={class:"bg-white overflow-hidden shadow-sm sm:rounded-lg flex justify-between"},ee={class:"p-6 w-60 text-gray-900 flex items-center justify-center"},te=e("video",{id:"preview"},null,-1),se={class:"flex items-center p-6"},ae={class:"",id:"print"},oe={class:"pt-2",id:"btn"},ne={class:"flex items-center p-6"},ie=e("input",{class:"ml-2 w-3/5 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm",type:"text",id:"text",name:"text",readonly:""},null,-1),ce={class:"max-w-7xl mx-auto sm:px-6 lg:px-8"},re={class:"bg-white overflow-hidden shadow-sm sm:rounded-lg py-8"},ge={__name:"Dashboard",props:{canLogin:{type:Boolean},canRegister:{type:Boolean},laravelVersion:{type:String,required:!0},phpVersion:{type:String,required:!0}},setup(g){let s=m({}),n=m([]),h=m(""),a=m(!0);function u(o){const t=document.getElementById("app"),i=document.createElement("div"),p=document.createElement("p");p.textContent=o.name??"Имя",document.body.before(p),i.append(p);const x=document.createElement("p");x.textContent=o.lastName??"Фамилия",i.append(x);const y=document.createElement("p");y.textContent=o.itemId??"Название билета",i.append(y),document.body.before(i),t.style.visibility="hidden",window.print(),setTimeout(()=>{i.remove(),t.style.visibility="visible"},100)}S("printCertificate",{printCertificate:u}),C(h,o=>{f.get("api/contacts").then(t=>{n.value=t.data})});function w(){let o={name:s.value.name,last_name:s.value.last_name,created_at:s.value.created_at};n.value.find(t=>t.item_id==s.value.item_id&&n.value.length)||(n.value=[o,...n.value])}return B(()=>{f.get("api/contacts").then(t=>{n.value=t.data});let o=new Instascan.Scanner({video:document.getElementById("preview")});Instascan.Camera.getCameras().then(function(t){t.length>0?(o.start(t[0]),a.value=!1):(alert("No cameras"),a.value=!1)}).catch(function(t){console.error(t)}),o.addListener("scan",function(t){h.value=t;const i=document.getElementById("text").value;document.getElementById("text").value=t,t!==i&&f.post("api/contacts",{itemId:t}).then(p=>{s.value=p.data,w(),u(s.value)})})}),(o,t)=>(r(),d(b,null,[_(c(E),{title:"Dashboard"}),_(V,null,{header:v(()=>[U]),default:v(()=>[e("div",W,[e("div",X,[e("div",Y,[e("div",ee,[c(a)?(r(),I(j,{key:0,style:{position:"absolute"}})):N("",!0),te]),e("div",se,[e("div",ae,[e("p",null,l(c(s).name??"Имя"),1),e("p",null,l(c(s).last_name??"Фамилия"),1),e("p",null,l(c(s).item_id??"Название билета"),1),e("p",oe,[e("button",{onClick:t[0]||(t[0]=i=>u(c(s))),class:"inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"}," Печать ")])])]),e("div",ne,[_(q,{value:"Scanner"}),ie])])])]),e("div",ce,[e("div",re,[_(P,{contacts:c(n)},null,8,["contacts"])])])]),_:1})],64))}};export{ge as default};
