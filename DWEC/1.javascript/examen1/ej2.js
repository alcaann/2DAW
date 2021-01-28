//NOMBRE DEL ALUMNO: Juan Gallego Soler

//RESOLUCIÓN DEL EJERCICIO 2 DEL EXAMEN
document.addEventListener("DOMContentLoaded",main)
function main(){

    const btnEmpezar = document.querySelector("#empezar")
    const btnParar = document.querySelector("#parar")
    const cuerpoTabla = document.querySelector("#segundos tbody")
    const tr1 = document.createElement("tr")
    const todosLosTD = document.querySelectorAll("td")
    cuerpoTabla.append(tr1)

    let celdas = 60
    celdaActual = 50
    for(i = 0;i<celdas;i++){
        nuevoTD = document.createElement("td")
        nuevoTD.id = "acho"+i
        tr1.append(nuevoTD)

    }

    btnEmpezar.addEventListener("click",function(){
        contar()
        this.disabled = true
        btnParar.disabled = false
    })

    btnParar.addEventListener("click",function(){
        clearInterval(intervaloAcho)
        this.disabled = true
        btnEmpezar.disabled = false
    })
    
    
}

function contar(){
    
    sentido = 1
  
     intervaloAcho = setInterval(cambiarColor, 1000);
}
function cambiarColor(){
    if(celdaActual == 59){
    sentdio = 0
}
    if(celdaActual == 0){
    sentido = 1
}
    console.log("celdaActual "+celdaActual+" sentido "+sentido)
     document.querySelector("#acho"+celdaActual).classList.toggle("coloreado")
    if(sentido ==1){
        celdaActual++
    }
    else{
        celdaActual--
    }
    //(sentido ==1)?(celdaActual++):(celdaActual--)
    

}






