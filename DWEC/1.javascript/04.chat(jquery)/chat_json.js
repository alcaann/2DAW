//asegurarnos de que nuestro código empieza a ejecutarse cuando el árbol dom ya está contstruido
$(document).ready(main)

function main(){
    idLastMessage = 0
    $("#texto").keyup(function(ev){
        if(ev.key === "Enter"){
        //comprobar que el campo NICK es válido
        //comprobar que el campo TEXTO es válido
        $.ajax({
            url: "chat_insert_post.php",
            method: "POST",
            data: {
                nick: $("#nick").val(),
                texto: $("#texto").val()
            },
            success: function(respuesta){
                console.log("La inserción se ha hecho bien")
            },
            error: function(error){
                console.log("Error en la inserción: "+error)
            }
        })
    }
    })

    cargarMensajes(idLastMessage);
    setInterval(function(){ cargarMensajes(idLastMessage)}, 2000)

    }
function cargarMensajes(inicio){
    $.ajax({
        url: "chat_select_get_json.php",
        data: {
            ultimo: inicio
        },
        success: function(json){
            let $json = JSON.parse(json)
            $.each($json, function(i,item){
                let $nuevoMensaje = $("<DIV>").html(item.instante+ " >> "+ item.nick+":"+ item.texto)
                let $chat = $("#chat")
                $chat.append($nuevoMensaje)
                idLastMessage = item.id
            })
            
        },
        error: function(error){
            console.log("Error en la consulta: "+error)
        }
    })
}


