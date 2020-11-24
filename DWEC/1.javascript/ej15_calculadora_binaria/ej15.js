document.addEventListener("DOMContentLoaded",main)
function main(){
    let todosLosBotones = document.querySelectorAll(".botonBit")
    let resultado = document.querySelector("#decimal")
    todosLosBotones.forEach(element =>{
        element.addEventListener("click", (ev)=>{
            cambiarValor(ev)
            mostrarResultado(todosLosBotones, resultado)
        })
    })
}
function cambiarValor(ev){
    if(ev.target.value =="0")
    ev.target.value ="1"
    else 
    ev.target.value ="0"
}
function mostrarResultado(todosLosBotones, resultado){
    let numero = ""
    todosLosBotones.forEach(element =>{
        numero += element.value
    })
    resultado.value = parseInt(numero, 2)
}