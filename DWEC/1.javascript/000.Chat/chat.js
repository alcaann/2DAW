document.addEventListener("DOMContentLoaded", main);
function main(){
    var chatsContainer= document.querySelector("nav ul");
     mainChatContainer = document.querySelector("main section ul");
    var inputMessage = document.querySelector("textarea");
    var inputMessageButton = document.querySelector("#btnMsg");
    var inputUserID = document.querySelector("#idUsuario");


    inputUserID.addEventListener("keyup", function(e){
        if(e.keyCode === 13){
            cambiarMainChat("693", inputUserID.value);
        }
    })
    
}

function cambiarMainChat(chatID, userID){
    const params = new URLSearchParams(`status=changeChat&chatID=${chatID}`);
    const options = {
        method: 'POST',
        body: params
    }
    var url = "chat.php";

    fetch(url, options)
    .then(function(respuestaEnTextoPlano){
        if(respuestaEnTextoPlano.ok){
            mainChatContainer.innerHTML = "";
            return respuestaEnTextoPlano.json();
        }
        else{ throw "no va todo ok";}
    })
    .then(function(respuestaEnJson){
        respuestaEnJson.forEach((element)=>{
            let msg = document.createElement("li");
            msg.innerHTML = `${element.date} (${(element.uid == userID)?"You":element.uid}) 
            <ul><li>${element.text}</li></ul>`
            mainChatContainer.prepend(msg);
        })
    })
    .catch(function(err){
        console.log("error:   "+ err);
    })
}