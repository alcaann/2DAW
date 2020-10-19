window.onload = function(){

}
document.addEventListener("DOMContentLoaded",function(){	
	const textoIntroducio = document.querySelector("#textNumero")
	textoIntroducio.addEventListener("keyup",teclaLevantada)})

function teclaLevantada(acho){
	document.querySelector("#key").textoIntroducio = acho.key
	document.querySelector("#which").textoIntroducio = acho.which
	document.querySelector("#keycode").textoIntroducio = acho.keyCode


	console.log(acho);
	console.log("acho.which"+acho.which)
	if(acho.key == "Enter"){
		//acciones que quieras ejecutar tras el INTRO
		if(isNaN(textoIntroducio.value))
			alert("ERROR")

		else alert("Has escrito un número correcto")
	}

	
}