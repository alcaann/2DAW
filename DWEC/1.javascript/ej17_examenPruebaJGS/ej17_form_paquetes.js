//NOMBRE DEL ALUMNO: Juan Gallego Soler

//RESOLUCIÓN DEL EXAMEN
document.addEventListener("DOMContentLoaded", main)

function main(){
    const campoNumeroReferencia = document.querySelector("#refPedido")
    const errorCampoNumeroReferencia = document.querySelector("#refPedidoError")
    const campoPeso = document.querySelector("#peso")
    const errorCampoPeso = document.querySelector("#pesoError")
    const botonAniadir = document.querySelector("#anyadir")
    const formulario = document.querySelector("#formEnvios")
    const cuerpoTabla = document.querySelector("#formEnvios #tablaEnvios tbody")
    const footerTabla = document.querySelector("#formEnvios #tablaEnvios tfoot")
    formulario.action = "ej17_formOK.html"


    intervaloComprobacion = setInterval(()=>{comprobarFormulario(campoNumeroReferencia,errorCampoNumeroReferencia,campoPeso,errorCampoPeso)},5000)

    const eventosInputText = ["input","keydown","keyup","mousedown","mouseup","select","contextmenu","drop"]
    eventosInputText.forEach(function(evento){
        campoNumeroReferencia.addEventListener(evento, function(){
            if(!/^[A-E]\d*$/.test(this.value)){
                if(this.hasOwnProperty("oldValue")){
                    this.value = this.oldValue
                }else this.value = ""
            }
        })
    })

    formulario.addEventListener('submit',function(f){
        f.preventDefault()
        if(comprobarFormulario(campoNumeroReferencia,errorCampoNumeroReferencia,campoPeso,errorCampoPeso)){
            this.submit()
        }
    })

    botonAniadir.addEventListener('click',()=>{
        if(comprobarFormulario(campoNumeroReferencia,errorCampoNumeroReferencia,campoPeso,errorCampoPeso)){
            let nuevoTR = document.createElement("TR")
            let nuevoTDnumero = document.createElement("TD")
            nuevoTDnumero.textContent = campoNumeroReferencia.value

            let nuevoTDpeso = document.createElement("TD")
            nuevoTDpeso.textContent = campoPeso.value

            let nuevoBUTTON = document.createElement("input")
            nuevoBUTTON.type = "button"
            nuevoBUTTON.value = "X"

            nuevoTR.append(nuevoTDnumero,nuevoTDpeso,nuevoBUTTON)
            
            cuerpoTabla.append(nuevoTR)
            nuevoBUTTON.addEventListener("dblclick", function(){
                this.parentNode.parentNode.removeChild(this.parentNode)
                recalcularTotales(cuerpoTabla,footerTabla)
            })


            nuevoTDnumero.addEventListener("dblclick", function(){
                
                nuevoInputText = document.createElement("INPUT")
                nuevoInputText.type = "text"
                nuevoInputText.value = this.textContent
                nuevoInputText.name = this.textContent
                nuevoInputText.addEventListener("keypress", function(evento){
                    if(evento.key === 'Enter'){
                        evento.preventDefault()
                        if (verificarNumeroReferencia(this.value))
                        this.parentNode.innerHTML = this.value
                        else
                            this.parentNode.innerHTML = this.name
                        this.name = ""
                        recalcularTotales(cuerpoTabla,footerTabla)
                    }
                })
                this.innerHTML = ""
                this.appendChild(nuevoInputText)
                nuevoInputText.focus()
            })



            nuevoTDpeso.addEventListener("dblclick", function(){
                nuevoInputText = document.createElement("INPUT")
                nuevoInputText.type = "text"
                nuevoInputText.value = this.textContent
                nuevoInputText.name = this.textContent
                nuevoInputText.addEventListener("keypress", function(evento){
                    if(evento.key ==='Enter'){
                    evento.preventDefault()
                    if(verificarPeso(this.value))
                    this.parentNode.innerHTML = this.value
                    else 
                        this.parentNode.innerHTML = this.name
                    this.name = ""
                    recalcularTotales(cuerpoTabla,footerTabla)
                    }
                })
                this.innerHTML = ""
                this.appendChild(nuevoInputText)
                nuevoInputText.focus()
            })
            recalcularTotales(cuerpoTabla,footerTabla)


        }
    })

}
function verificarNumeroReferencia(numeroReferencia){
    return /^[ABCDE]{1}[0-9]{5}$/.test(numeroReferencia)
}
function verificarPeso(peso){
    return /^[0-9]{1,2}[.]{1}[0-9]{1}$/.test(peso)
}

function comprobarFormulario(campoNumeroReferencia,errorCampoNumeroReferencia,campoPeso,errorCampoPeso){
    estado = true
    if(!verificarNumeroReferencia(campoNumeroReferencia.value)){
        var estado = false
        campoNumeroReferencia.classList.remove("campoCorrecto")
        campoNumeroReferencia.classList.add("campoIncorrecto")
        errorCampoNumeroReferencia.textContent =("dato no válido")

    }else {
        campoNumeroReferencia.classList.remove("campoIncorrecto")
        campoNumeroReferencia.classList.add("campoCorrecto")
        errorCampoNumeroReferencia.textContent=("")
    }

    if(!verificarPeso(campoPeso.value)){
        estado = false
        campoPeso.classList.remove("campoCorrecto")
        campoPeso.classList.add("campoIncorrecto")
        errorCampoPeso.textContent=("dato no válido")
    }else {
        campoPeso.classList.remove("campoIncorrecto")
        campoPeso.classList.add("campoCorrecto")
        errorCampoPeso.textContent= ("")

    }
    return estado
}

function recalcularTotales(cuerpo,footer){
    var totalEnvios = 0
    let totalPesos = 0
    cuerpo.querySelectorAll("tr").forEach((hijo)=>{
        totalEnvios++;
        totalPesos += parseFloat(hijo.childNodes.item(1).textContent)
    })
    footer.querySelector("#totalEnvios").value = totalEnvios
    footer.querySelector("#totalPeso").value = totalPesos.toFixed(2)


}
