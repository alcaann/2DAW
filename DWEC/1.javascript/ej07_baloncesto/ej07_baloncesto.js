document.addEventListener("DOMContentLoaded",function(){
    const sinconvocar = document.querySelector("#sinconvocar")
    const equipo1 = document.querySelector("#equipo1")
    const equipo2 = document.querySelector("#equipo2")

    const jugadoresIniciales = document.querySelectorAll("li")

    for(let i=0; i<jugadoresIniciales.length; i++){
        jugadoresIniciales[i].addEventListener("click",function(){
            (this.parentNode.id == "equipo1")?(equipo2.appendChild(this)):(equipo1.appendChild(this))
        })
    }

    
})