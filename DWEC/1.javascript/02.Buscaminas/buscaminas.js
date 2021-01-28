document.addEventListener("DOMContentLoaded",main);
function main(){
    const tablero = document.querySelector("#tablero");
    const inputFila = document.querySelector("#inputFila");
    const inputColumna= document.querySelector("#inputColumna");
    const tablaRecords = document.querySelector("#tablaRecords");
    const celdas = 120;
    const minas = 20;
    celdasParaGanar = celdas-minas;

    guardarRecord(tablaRecords);
    for(let i=0; i<=celdas; i++){
        let nuevaCelda = document.createElement("DIV");
        nuevaCelda.classList.add("celda");
     

        nuevaCelda.dataset.fila = Math.floor(i / 11);
        nuevaCelda.dataset.columna = i%11;
        nuevaCelda.dataset.clicado= false;
        nuevaCelda.dataset.mina = false;
        nuevaCelda.dataset.minasCerca = 0;


        nuevaCelda.addEventListener("mouseover",(ev)=>{
            inputFila.value = ev.target.dataset.fila;
            inputColumna.value = ev.target.dataset.columna;
            //inputMina.value = ev.target.dataset.mina;
        })


        nuevaCelda.addEventListener("contextmenu",function(e){
            e.preventDefault();
            if(nuevaCelda.dataset.clicado == "false"){
                
            e.target.classList.toggle("bandera");
        }
            
        },false);


        nuevaCelda.addEventListener("click",(ev)=>{
            if(ev.target.dataset.clicado == "false" && !ev.target.classList.contains("bandera")){
                ev.target.dataset.clicado = true;
            if(ev.target.dataset.mina== "true"){
                document.querySelectorAll(".celda[data-mina='true']").forEach(function(item){
                    item.classList.add("mina_explotada");
                })
                //ev.target.classList.add("mina_explotada");
                
            }
            else{
                ev.target.classList.add("agua");
                ev.target.innerHTML = ev.target.dataset.minasCerca;
                celdasParaGanar--;
                if(!celdasParaGanar){
                    hasGanado();
                }
            }
        }
        })
        

        tablero.append(nuevaCelda);
        //console.log(nuevaCelda.dataset.fila + "," + nuevaCelda.dataset.columna);
    }

    const todasLasCeldas = document.querySelectorAll('.celda');
    colocarMinas(todasLasCeldas, minas);
    
}

function colocarMinas(todasLasCeldas, minasParaColocar){
 

    while(minasParaColocar > 0){
        let aleatorio = Math.floor(Math.random()*120);
        
        if(todasLasCeldas[aleatorio].dataset.mina == "false"){
            todasLasCeldas[aleatorio].dataset.mina= "true";
            let x = parseInt(todasLasCeldas[aleatorio].dataset.fila);
            let y = parseInt(todasLasCeldas[aleatorio].dataset.columna);


            if(acho = document.querySelector(".celda[data-columna='"+(y-1)+"'][data-fila='"+(x-1)+"']")){
                acho.dataset.minasCerca++;
            }
            if(acho = document.querySelector(".celda[data-columna='"+(y-1)+"'][data-fila='"+(x)+"']")){
                acho.dataset.minasCerca++;
            }
            if(acho = document.querySelector(".celda[data-columna='"+(y-1)+"'][data-fila='"+(x+1)+"']")){
                acho.dataset.minasCerca++;
            }
            if(acho = document.querySelector(".celda[data-columna='"+(y+1)+"'][data-fila='"+(x-1)+"']")){
                acho.dataset.minasCerca++;
            }
            if(acho = document.querySelector(".celda[data-columna='"+(y+1)+"'][data-fila='"+(x)+"']")){
                acho.dataset.minasCerca++;
            }
            if(acho = document.querySelector(".celda[data-columna='"+(y+1)+"'][data-fila='"+(x+1)+"']")){
                acho.dataset.minasCerca++;
            }
            if(acho = document.querySelector(".celda[data-columna='"+(y)+"'][data-fila='"+(x-1)+"']")){
                acho.dataset.minasCerca++;
            }
            if(acho = document.querySelector(".celda[data-columna='"+(y)+"'][data-fila='"+(x+1)+"']")){
                acho.dataset.minasCerca++;
            }
            minasParaColocar--;
        }
    }
}

function hasGanado(){
     nuevoSPAN = document.createElement("span");
     nuevoSPAN.textContent = "HAS GANADO";
     document.querySelector("body").appendChild(nuevoSPAN);
}

function guardarRecord(tablaRecords){
    console.log("acho");
    const params = new URLSearchParams("modo=1&length=9")
    const opciones = {
        method: 'POST',
        body: params
    }
    var url = "loadRecords.php";

    fetch(url, opciones)
    .then(function(respuestaTextoPlano){
        if(respuestaTextoPlano.ok){
            tablaRecords.innerHTML = respuestaTextoPlano;
            console.log(respuestaTextoPlano);
            return respuestaTextoPlano.json();
        }
        else{
            throw "Error en la llamada Ajax";
        }
    })
    .then(function(restpuestaJson){
        restpuestaJson.forEach((element, index) =>{
            console.log("index= "+index);
            console.log(`element = [${element.nick}], [${element.nick}]`);
        })
    })
    .catch(function (err){
        console.log("ERROR:" + err);
    })
}