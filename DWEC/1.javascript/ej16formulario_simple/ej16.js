document.addEventListener("DOMContentLoaded",main)
function main(){
    formulario = document.querySelector("form")



 
    formulario.addEventListener("submit",(e)=>{
        e.preventDefault()
        if(campoNombreOK() && campoDniOK() && campoEdadOK() /*&& campoTipoCarnetOK() && campoTipoInfraccionOK()*/)
        formulario.submit()
    })
    
}
function campoNombreOK(){
    const nombre = document.querySelector("#conductor").value
    if (nombre.trim().length > 0 && !/\d/.test(nombre))
    return true
    else
    return false

}
function campoDniOK(){
    const dni = document.querySelector("#dni").value
    if (dni.trim().length==9 && !isNaN(dni.trim().slice(0,8)) && isNaN(dni.trim().slice(8,9)))
    return true
    else 
    return false
}
function campoEdadOK(){
    
}
function campoTipoCarnetOK(){}
function campoTipoInfraccionOK(){}

