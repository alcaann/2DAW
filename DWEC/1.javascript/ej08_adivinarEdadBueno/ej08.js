//window.onload = function(){
//document.addEventListener("contentReady") = function(){
	
	
	function empezarPartida(){
		const max = 1000,min = 0;
		const numeroRandom = obtenerNumeroRandom(min,max);
		const cajaTexto = document.querySelector("#inputNumero");
		partida(obtenerNumeroRandom(min,max),cajaTexto);

		


	}
	function partida(numeroParaAdivinar, usuario){
		console.log("El numero random es :"+numeroParaAdivinar);
		while()

	}

	function botonPresionado(){
	
	let numeroIntroducido = cajaTexto.value;
	
	if((isNaN(numeroIntroducido)) || (numeroIntroducido ==="")){
	alert("esto no vale socio")
	}
	else if (numeroIntroducido > numeroRandom){
		alert("no es ese número, te has pasado")
		cambiarClaseDe1("ladrillo", "ladrilloDescubierto", -1);
	}
	else if(numeroIntroducido < numeroRandom){
		alert("no es ese número, te has quedao corto");
		cambiarClaseDe1("ladrillo","ladrilloDescubierto",0);
	}
	else if(numeroIntroducido == numeroRandom){	
		alert("has acertado!!");
		cambiarClase("ladrillo","secreto");

	}
	else{ 
		alert("el "+numeroIntroducido+" no esWTF HAPPENED?????");
	}
	
	}
	
	
	
	function obtenerNumeroRandom(min, max){
		min = Math.ceil(min);
		max = Math.floor(max);
		return Math.floor(Math.random() * (max - min + 1)) + min;
	}
	function cambiarClase(claseActual, claseNueva){
		document.querySelectorAll("."+claseActual).forEach(function(objeto,indice){
			objeto.classList.replace(claseActual,claseNueva);
		})
	}
	function cambiarClaseDe1(claseActual,claseNueva,indice){
		if(indice == -1)
		cambiarClaseDe1(claseActual,claseNueva, document.getElementsByClassName(claseActual).length -1);
		else
		document.querySelectorAll("."+claseActual)[indice].classList.replace(claseActual,claseNueva);
		
	}
