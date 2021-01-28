document.addEventListener("DOMContentLoaded", main)
function main(){
    const tablero = document.querySelector("#tablero")
    const bola= document.querySelector("#bola")

    const puntos = document.querySelector("#puntos")
    const empezar = document.querySelector("#btnEmpezar")
    const parar =document.querySelector("#btnParar")
    puntos.textContent = 0
    bola.style.display = "none";
 
    empezar.addEventListener("click", function(){
        juego(bola, tablero)
        this.disabled = true
        parar.disabled = false
        
    })

    parar.addEventListener("click",function(){
        
    })

    
}
function fin(){
    
}


function juego(bola, tablero){

    let velocidad = 1000

    setTimeout(() => {
        bola.style.display = "";
    }, velocidad);
    alarma = bolaSeMueve(bola,velocidad);
    
    
}

function cambioPosicionBola(bola){
    let nuevoTop = Math.floor(Math.random()*570)
    let nuevoLeft = Math.floor(Math.random()*570)
        bola.style.top = nuevoTop +"px"
        bola.style.left = nuevoLeft+"px"
    
    }

function bolaSeMueve(bola, velocidad){
    return alarma = setInterval(()=>{cambioPosicionBola(bola);activarClickBola(bola);},velocidad)
}
function activarClickBola(bola){
    bola.style.display = ""
    bola.addEventListener("click", sumarpuntos)
 
        
    
}
function sumarpuntos(){
    puntos.textContent ++
    this.style.display ="none"
    this.removeEventListener('click',sumarpuntos);
}


