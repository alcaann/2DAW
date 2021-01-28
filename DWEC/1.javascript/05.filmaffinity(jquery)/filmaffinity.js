//NOMBRE DEL ALUMNO: Juan Gallego Soler

//RESOLUCIÓN DEL EXAMEN

(function(){
	//Escribe aquí todo tu código
	console.log("Empieza la ejecución");
	$(document).ready(main);
	function main(){
		$("#buscador").keyup(function(ev){
			if(ev.key === "Enter"){
				
				
				if(($inputSearch = $(this).val().trim()) != ""){
					
					mostrarResultados0($inputSearch)
				}
			}
		})
	}
	function mostrarResultados0(inputSearch){
		$("#divSugerencias").empty()
		$.ajax({
			url: "search.php",
			method: "GET",
			data: {
				p: inputSearch
			},
			success: function(respuestaEnTextoPlano){
				if(!jQuery.isEmptyObject($json = JSON.parse(respuestaEnTextoPlano))){
				$.each($json,function(i, item){
					console.log(item.texto)
					$("<p>")
					.html(item.texto)
					.data("id",item.id)
					.data("tipo",item.tipo)
					.click(function(){
						if(($seleccionados = $("#divBuscador #divSugerencias p.selected")).length){
							$.each($seleccionados, function(){
								$(this).removeClass("selected")
							})
						}
						$(this).addClass("selected")
						mostrarResultados1(item.id, item.tipo)
					})
					.appendTo($("#divSugerencias"))
				})
				$("#divSugerencias").show()
			}else{
				$("#divSugerencias").hide()
			}
				
			},
			error: function(error){
				console.log("Error en la consulta: "+error)
			}
		})
	}

	function mostrarResultados1(id, tipo){
		limpiarListas()
		$.ajax({
			url: "search.php",
			method: "GET",
			data: {
				id: id,
				t: tipo
			},
			success: function(respuestaEnTextoPlano){
			($(respuestaEnTextoPlano)).find("resultado").each(function(){
				
				console.log(parseInt($(this).find('tipo')))
				$("<li>")
				.html((($(this).find('tipo').html() == "0")?
				`[${$(this).find('anyo').html()}] ${$(this).find('titulo').html()}`:
				$(this).find('nombre').html() ))
				.appendTo($('.listaResultados').eq(parseInt($(this).find('tipo').html())))

				
			})
			}
		})
	}
	
	function mostrarResultados(inputSearch){
		limpiarListas()
		$.ajax({
			url: "search.php",
			method: "GET",
			data: {
				p: inputSearch
			},
			success: function(respuestaEnTextoPlano){
				$.each(JSON.parse(respuestaEnTextoPlano), function(i, item){
					let $nuevoMensaje = $("<li>").html(item.texto).data("id", item.id)
					let selectorUl
					switch (item.tipo){
						case "tit": selectorUl = "0";break;
						case "dir": selectorUl = "1";break;
						case "act": selectorUl = "2";break; 
					}
					let $ulResultados = $(".listaResultados").eq(selectorUl).append($nuevoMensaje)
				})			
		},
		error: function(error){
			console.log("Error en la consulta: "+error)
		}
	})
	}
	function limpiarListas(){
		$("ul").each( function(){
			$(this).html("")
		})
	}
	

})();