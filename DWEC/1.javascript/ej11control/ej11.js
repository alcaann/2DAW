//Desarrolla aquí la solución al ejercicio 11
//nuevas filas
document.addEventListener("DOMContentLoaded",function(){
    var nuevoAtributo = document.getElementById("selectNuevoAtrib")
    const campoTelefono = document.querySelector("#tablaContacto tbody tr:nth-of-type(2)")
    const campoEmail = document.querySelector("#tablaContacto tbody tr:nth-of-type(3)")
    const cuerpoTabla = document.querySelector("#tablaContacto tbody")
    
    
    nuevoAtributo.addEventListener("change", aniadirFila)

        function aniadirFila(){
            var valor = nuevoAtributo.value
            if(valor != 0){
            let nuevoTR = document.createElement("TR")
            if(valor == 1){
                
                nuevoTR.innerHTML = campoTelefono.innerHTML
                
            }else if(valor == 2){
                nuevoTR.innerHTML = campoEmail.innerHTML
            }
            nuevoTR.lastElementChild.innerHTML = "<input type=\"button\" value=\"X\" onclick=\"borrarFila(this)\">"
            cuerpoTabla.appendChild(nuevoTR)
        }}

    })
    function borrarFila(acho){
        var padre = acho.parentNode.parentNode
        padre.parentNode.removeChild(padre)
    }
    

