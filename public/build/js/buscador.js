function iniciarAdmin(){buscarPorFecha()}function buscarPorFecha(){document.querySelector("#fecha").addEventListener("input",(function(n){const e=n.target.value;window.location="?date="+e}))}document.addEventListener("DOMContentLoaded",()=>{iniciarAdmin()});