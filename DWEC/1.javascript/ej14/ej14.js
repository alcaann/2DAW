document.addEventListener("DOMContentLoaded", main)
function main(){
    const tablero = document.querySelector("#tablero")
    const bolas = document.querySelectorAll(".bola")

    //establecemos los atributos del tablero
    tablero.style.width = "500px"
    tablero.style.height = "250px"
    tablero.style.position ="realtive"

    //creamos y establecemos los atributos de bola1
    const bola1 = document.createElement("div")
    bola1.classList.add("bola")
    bola1.style.width = "25px"
    bola1.style.height = "25px"
    tablero.appendChild(bola1)
    bola1.style.position = "absolute"

    //posicion inicial y dirección aleatorias para bola1 

    bola1.style.top = randomNumberBetween(1, parseInt(tablero.style.height)-parseInt(bola1.style.height))+"px"
    bola1.style.left = randomNumberBetween(1, parseInt(tablero.style.width)-parseInt(bola1.style.width))+"px"
    
    let direction = Array((Math.round(Math.random()))?1:-1, (Math.round(Math.random()))?1:-1)

    //la bola empieza a moverse
    moverBola(bola1,direction,tablero,10)
    
}
function moverBola(bola,direction, tablero, updatetime){
    maxTop = parseInt(tablero.style.height)-parseInt(bola.style.height)
    maxLeft = parseInt(tablero.style.width)-parseInt(bola.style.width)
    console.log(maxLeft)
    
    setInterval(function(){
        
        topActual = parseInt(bola.style.top)
        nuevoTop = (topActual  += ((direction[1] == -1)?-1:1) )
        bola.style.top =nuevoTop +"px"
        leftActual = parseInt(bola.style.left)
        nuevoLeft = (leftActual += ((direction[0] == -1)?-1:1))
        bola.style.left = nuevoLeft +"px"
        
        
        if(topActual  == 0|| parseInt(bola.style.top) == maxTop){
            direction[1]*=-1
        }
        if(leftActual == 0 || parseInt(bola.style.left) == maxLeft){
            direction[0]*=-1
        }
        



    }, updatetime)

}
function randomNumberBetween(min,max){
    return Math.floor(Math.random()*max)+min
}