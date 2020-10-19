//window.onload = function(){
//document.addEventListener("contentReady") = function(){
const numeroRandom = obtenerNumeroRandom(0,1000);
console.log("El numero random es :"+numeroRandom);

function botonPresionado(){
const cajaTexto = document.querySelector("#inputNumero")
let numeroIntroducido = cajaTexto.value

if((isNaN(numeroIntroducido)) || (numeroIntroducido ==="")){
alert("esto no vale socio")
}else if (numeroIntroducido > numeroRandom){
	alert("no es ese número, te has pasado")
}else if(numeroIntroducido < numeroRandom){
	alert("no es ese número, te has quedao corto")
}




else if(numeroIntroducido == numeroRandom)
{	
alert("has acertado!!")

}else{ 
alert("el "+numeroIntroducido+" no es")
}


}



function obtenerNumeroRandom(min, max){
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1)) + min;
}