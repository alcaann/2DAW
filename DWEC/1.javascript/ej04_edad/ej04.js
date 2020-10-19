
document.addEventListener("DOMContentLoaded",function(){

	const boton = document.querySelector("#botonCalcular");
	boton.addEventListener("click",comprobarEdad);
});


function comprobarEdad(){


	const diaIntroducido = document.querySelector("#inputDia").value;
	const mesIntroducido = document.querySelector("#inputMes").value;
	const anioIntroducido = document.querySelector("#inputAnio").value;
	const salida = document.querySelector("#errores");
	var today = new Date();
	let edad = today.getFullYear() - anioIntroducido;
	if (today.getMonth()+ 1 < mesIntroducido)
		edad --;
	else if(today.getMonth()+1 == mesIntroducido)
		if (today.getDate() < diaIntroducido) {
			edad--;
		}
		


	salida.textContent = "Tienes "+edad+" años."



/*prueba para aprender a seleccionar todos los nodos con la misma etiqueta*/
	var todosLosInputs = document.querySelectorAll("input")
	console.log("Prueba querySelectorAll:" + todosLosInputs.length)

}
