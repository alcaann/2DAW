document.addEventListener("DOMContentLoaded", function(){

    const select1 =document.querySelector("#selectNuevoAtrib")

    select1.addEventListener("change", (ev)=>{
        const cuerpo = document.querySelector("#tablaContacto tbody")
        let opcion = ev.target.value
        if(opcion != 0){
            let nuevoTR = document.createElement("TR")
            let nuevoTD1 = document.createElement("TD")
            let nuevoTD2 = document.createElement("TD")
            let nuevoTD3 = document.createElement("TD")

            let nuevoIMG = document.createElement("IMG")
            let nuevoINPUT = document.createElement("INPUT")
            let nuevoBUTTON = document.createElement("BUTTON")

            nuevoIMG.classList.add("small-icon")

            if (opcion ==1)
            {
                nuevoIMG.src = "img/tlfn.png"
                nuevoINPUT.type = "tel"
            }
            else if(opcion ==2){
                nuevoIMG.src = "img/email.png"
                nuevoINPUT.type = "email"
            }

            nuevoBUTTON.textContent = "X"
            nuevoBUTTON.addEventListener("click", ()=>{
                nuevoTR.remove()
            })

            nuevoTD1.append(nuevoIMG)
            nuevoTD2.append(nuevoINPUT)
            nuevoTD3.append(nuevoBUTTON)
            nuevoTR.append(nuevoTD1,nuevoTD2, nuevoTD3)
            cuerpo.appendChild(nuevoTR)
        }
    })
})