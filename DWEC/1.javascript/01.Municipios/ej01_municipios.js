document.addEventListener("DOMContentLoaded",main)
function main(){
    let xhr = new XMLHttpRequest()
    const selectProvincia = document.querySelector("#provincia")

    xhr.addEventListener("readystatechange", function(){
        console.log("Me encuentro en el estado "+this.readyState)
        if(this.readyState == 4 && this.status == 200)
        {
            //let parser = new DOMParser()
            //let xmlDoc = parser.parseFromString(this.responseText, "text/html")
            selectProvincia.innerHTML += "<option>--- selecciona una provincia ---</option>"
            let cosas = Array.from(this.responseXML.getElementsByTagName("provincia"))
            cosas.forEach((element) =>{

                let nuevoOption = document.createElement("OPTION")
                nuevoOption.textContent = element.lastElementChild.textContent
                nuevoOption.value = element.firstElementChild.textContent

                selectProvincia.appendChild(nuevoOption)
            })
        }
    })
    xhr.open("GET", "cargaProvinciasXML.php",true)

    xhr.send()

    selectProvincia.addEventListener("change", (acho)=>{mostrarMunicipios(acho)})

}
function mostrarMunicipios(select){
    let xhr1 = new XMLHttpRequest()
    console.log(select.innerHTML)
    xhr1.addEventListener("readystatechange", ()=>{
        if(this.readyState == 4 && this.status == 200){
            let cosas = Array.from(this.responseXML.getElementsByTagName(""))
        }
    })
}