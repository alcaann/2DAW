//NOMBRE DEL ALUMNO: Juan Gallego Soler

//RESOLUCIÓN DEL EXAMEN
document.addEventListener("DOMContentLoaded",main)
function main(){
    const inputConcepto = document.querySelector("#concepto")
    const inputCantidad = document.querySelector("#cantidad")
    const selectTipo = document.querySelector("#tipo")

    const errorConcepto = document.querySelector("#conceptoError")
    const errorCantidad = document.querySelector("#cantidadError")
    const errorTipo = document.querySelector("#tipoError")

    const cuerpoTabla = document.querySelector("#tablaMovs tbody")
    const footerTabla = document.querySelector("#tablaMovs tfoot")
    const formu = document.querySelector("#formMovimientos")
    formu.action = "formOK.html"

    const btnEnviar = document.querySelector("#enviar")
    const btnBorrar = document.querySelector("#borrar")
    const btnAniadir = document.querySelector("#anyadir")

    formu.addEventListener('submit',function(s){
        s.preventDefault()
        if(comprobarFormulario(inputConcepto,inputCantidad,selectTipo,errorConcepto,errorCantidad,errorTipo)){
            this.submit()
        }
    })



    formu.addEventListener("reset",()=>{
        errorConcepto.textContent = ""
        errorCantidad.textContent = ""
        errorTipo.textContent = ""
    })

    btnAniadir.addEventListener("click",()=>{
        if(comprobarFormulario(inputConcepto,inputCantidad,selectTipo,errorConcepto,errorCantidad,errorTipo)){
            nuevoTR = document.createElement("TR")
            td1 = document.createElement("TD")
            td2 = document.createElement("TD")
            td3 = document.createElement("TD")
            td4 = document.createElement("TD")

            btn = document.createElement("BUTTON")
            btn.textContent = "X"

            td1.textContent = inputConcepto.value
            td2.textContent = inputCantidad.value
            td3.textContent = selectTipo.options[selectTipo.selectedIndex].textContent
            td4.append(btn)
            nuevoTR.append(td1,td2,td3,td4)

            btn.addEventListener("click",function(){
                this.parentNode.parentNode.remove()
                recalcularTotales(cuerpoTabla,footerTabla)
            })

            cuerpoTabla.append(nuevoTR)
            formu.reset()
            recalcularTotales(cuerpoTabla,footerTabla)
            
            
            
        }
    })


}

function recalcularTotales(cuerpoTabla,footerTabla){
    let totalMovimientos = 0
    let totalEuros = 0
    cuerpoTabla.querySelectorAll("tr").forEach((hijo)=>{
        totalMovimientos++
        totalEuros += parseFloat(hijo.childNodes.item(1).textContent.replace(",","."))
    })
    footerTabla.querySelector("#numMovs").value = totalMovimientos
    footerTabla.querySelector("#saldo").value = totalEuros


}
function comprobarConcepto(concepto){
    return /^[A-Za-z0-9 -]{4,30}$/.test(concepto)
}
function comprobarCantidad(cantidad){
    return /^\d{1,},\d{2}$/.test(cantidad)
}

function comprobarFormulario(inputConcepto,inputCantidad,selectTipo,errorConcepto,errorCantidad,errorTipo){
    if(!comprobarConcepto(inputConcepto.value)){
        errorConcepto.textContent = "este concepto no vale"
        return false
    }else{
        errorConcepto.textContent = ""
    }
    if(!comprobarCantidad(inputCantidad.value)){
        errorCantidad.textContent = "esta cantidad no vale"
        return false
    }else{
        errorCantidad.textContent = ""
    }
    if(!selectTipo.value){
        errorTipo.textContent = "selecciona algo"
        return false
    }else{
        errorTipo.textContent = ""
    }

    return true
}







