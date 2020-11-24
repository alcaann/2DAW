document.addEventListener("DOMContentLoaded",main)
function main(){
    selectEmpresa1 = document.querySelector("#empresa1")
    selectEmpresa2 = document.querySelector("#empresa2")
    tablaDatos = document.querySelector("#tablaDatos")
    selectEmpresaOpciones = selectEmpresa1.innerHTML
    inputNombre = document.querySelector("#txtUsuario")
    botonEnviarDatos = document.querySelector("#btnEnviar")

    selectEmpresa1.addEventListener("change",()=>{cambioEmpresa(selectEmpresa1,selectEmpresa2)})
    botonEnviarDatos.addEventListener("click",()=>{aniadirFila(selectEmpresa1, selectEmpresa2, inputNombre, tablaDatos)})
    
}
function cambioEmpresa(selectCambiado,selectAfectado){
    if(selectCambiado.value != "nada"){
        selectCambiado.classList.remove("error")
        selectAfectado.innerHTML = selectEmpresaOpciones
        document.querySelector('#'+selectAfectado.id+' option[value='+selectCambiado.value+']').remove()
        selectAfectado.disabled = false
    }
    else {
        selectAfectado.disabled = true
        selectAfectado.innerHTML = ""
    }
}
function aniadirFila(selectEmpresa1, selectEmpresa2, inputNombre, tablaDatos){
    if (selectEmpresa1.value != 'nada' && inputNombre.value){
        inputNombre.classList.remove("error")
        nuevoTR = document.createElement("TR")
        tdUsuario = document.createElement("TD")
        tdUsuario.textContent = inputNombre.value
        tdPrioridad1 = document.createElement("TD")
        tdPrioridad1.textContent = selectEmpresa1.options[selectEmpresa1.selectedIndex].text
        tdPrioridad2 = document.createElement("TD")
        if(selectEmpresa2.value !="nada"){
            tdPrioridad2.textContent = selectEmpresa2.options[selectEmpresa2.selectedIndex].text
        }
        tdFecha = document.createElement("TD")
        fecha = new Date()
        tdFecha.innerHTML = fecha.toLocaleDateString().replace(/\//g,"-") +" / "+ fecha.toTimeString().slice(0,8)
        tdBorrar = document.createElement("TD")
        botonBorrar = document.createElement("BUTTON")
        botonBorrar.textContent ="X"
        tdBorrar.appendChild(botonBorrar)
        nuevoTR.appendChild(tdUsuario)
        nuevoTR.appendChild(tdPrioridad1)
        nuevoTR.appendChild(tdPrioridad2)
        nuevoTR.appendChild(tdFecha)
        nuevoTR.appendChild(tdBorrar)
        tablaDatos.appendChild(nuevoTR)
        botonBorrar.addEventListener("click", function(){this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode)})
        
    }
    else{
        if(selectEmpresa1.value == 'nada')
        selectEmpresa1.classList.add("error")
        if(!inputNombre.value)
        inputNombre.classList.add("error")
        else inputNombre.classList.remove("error")
    }
}

