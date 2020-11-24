document.addEventListener("DOMContentLoaded", main)
function main(){
    const tablero = document.querySelector("#tablero")
    const bola= document.querySelector("#bola")

    const puntos = document.querySelector("#puntos")
    const empezar = document.querySelector("#btnEmpezar")
    puntos.textContent = 0
 
    empezar.addEventListener("click", juego(bola, tablero))
    
}



function juego(bola, tablero){
    let alarma = setInterval(cambioPosicionBola,1000)
    bola.addEventListener("click", ()=>{
        puntos.textContent ++
    })
}

function cambioPosicionBola(){
    let nuevoTop = Math.floor(Math.random()*570)
    let nuevoLeft = Math.floor(Math.random()*570)
        bola.style.top = nuevoTop +"px"
        bola.style.left = nuevoLeft+"px"
    
    }


