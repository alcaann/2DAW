document.addEventListener("DOMContentLoaded", function(){
	/*esto se va a ejecutar sólo cuando el navegador haya termiando de crear el árbol DOM desde el HTML*/
console.log("comenzamos el js señore")
	//1.programar el evento clic del BUTTON
	const btnAdd = document.querySelector("#btnAdd")
	btnAdd.addEventListener("click",addItemToList)

	//2.programar el evento "pulsar INTRO" del INPUT
	document.querySelector("#inputText").addEventListener("keyup",function(e){
		if(e && e.key === "Enter")
		addItemToList()
	})
})





	function addItemToList(){
		console.log("holapaco")
		let texto = document.querySelector("#inputText").value
		if (texto.trim().length){ //Estamos suspensos == true

		//Crear un nuevo elemento HTML<LI>
		var acho = document.createElement("li");
		acho.innerHTML = texto;

		document.querySelector("#todoList").appendChild(acho);
		//2º Insertar el texto que hemos recupera dentro del li    
		//3. Hacer que li se añada al arbol DOM como hijo de la etiqueta <ul></ul>
		acho.addEventListener("click",function(){

			this.remove()
		})

document.querySelector("#inputText").value = "";
		//extra, devolver el foco en la caja de texto
		//y vaciar la caja de texto
		//IMPORTANTE EL USO DE AUTOFOCUS EN EL ELEMENTO INPUT DE TIPO TEXTO EN EL HTML
		// ahora esta línea sobra:
		//document.querySelector("#inputText").focus()
		}
	}

