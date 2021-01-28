//NOMBRE DEL ALUMNO: Juan Gallego Soler

//RESOLUCIÓN DEL EJERCICIO

(function () {

    document.addEventListener("DOMContentLoaded", main);
    function main(){
        const inputBuscador = document.querySelector("#divBuscador #buscador");
        const cuerpoResultados = document.querySelector("#divResultados #tableResultados tbody");
        const cuerpoCarrito = document.querySelector("#divSeleccionados #tableSeleccionados tbody");
        const controladorDeAborto = new AbortController();//SIN USAR
        const senialDeAborto = controladorDeAborto.signal;
        let tiempoEspera;
        const botonVaciarTablaArticulos = document.querySelector("#inputBorrarTodos");
        

        inputBuscador.addEventListener("input", (e) => {
            
            clearTimeout(tiempoEspera);
            cuerpoResultados.innerHTML = "";
            if(inputBuscador.value.trim()!="")
            tiempoEspera = setTimeout(buscarPorPalabras, 1000, ((" ".concat(inputBuscador.value.replace(/  +/g," ").trim())).replace(/ /g,"&pattern=")).substr(1)/* PARA PASAR CADA PALABRA COMO UN PARÁMETRO DISTINTO*/, cuerpoResultados, senialDeAborto, cuerpoCarrito);


            
        });

        botonVaciarTablaArticulos.addEventListener('click', ()=> {
            cuerpoCarrito.innerHTML = "";
            recalcularTotal();
        })

    }
    
    function recuperarConsulta(respuestaTextoPlano){
        if(respuestaTextoPlano.ok){
            return respuestaTextoPlano.json();
        }
        else{
            throw "PACOPACOPACOerror";
        }
    }
    function mostrarResultados(json, cuerpoResultados, cuerpoCarrito){
        json.forEach((element) =>{
            let fila = document.createElement("tr");
            let tdNombre = document.createElement("td");
            let tdPrecio = document.createElement("td");
            let tdAniadir = document.createElement("td");
            let botonAniadir = document.createElement("button");

            

            tdNombre.textContent = element.titulo;
            tdPrecio.textContent = element.precio;
            botonAniadir.textContent = "X";
            tdAniadir.appendChild(botonAniadir);
            botonAniadir.addEventListener("click",(e)=>{
                aniadirAlCarro(e.target.parentNode.parentNode.cloneNode(true), cuerpoCarrito);
            })

            fila.append(tdNombre,tdPrecio,tdAniadir);
            cuerpoResultados.appendChild(fila);

        })
    }

    function aniadirAlCarro(fila, cuerpoCarrito){
        let noHay = true;
        let precio = parseInt(fila.firstChild.nextSibling.textContent);
        cuerpoCarrito.querySelectorAll("tr").forEach( tr =>{
            if(tr.firstChild.textContent == fila.firstChild.textContent){
                noHay = false;
                let numeroEnCarrito = parseInt(tr.firstElementChild.nextSibling.firstElementChild.textContent) +1;
                tr.firstElementChild.nextSibling.firstElementChild.textContent = numeroEnCarrito;
                tr.firstElementChild.nextSibling.lastElementChild.textContent = precio*numeroEnCarrito;
            }
        })
        if(noHay){
            fila.firstElementChild.nextSibling.innerHTML = `(<strong>1</strong>)&nbsp&nbsp<span>${fila.firstElementChild.nextSibling.innerHTML}</span>&euro;`;

            fila.lastChild.innerHTML = "";
            let botonBorrar = document.createElement("button");
            botonBorrar.textContent = "X";
            botonBorrar.addEventListener("click",(e)=>{
                quitarDelCarro(e.target.parentNode.parentNode);
            })
            fila.lastElementChild.append(botonBorrar);
            cuerpoCarrito.appendChild(fila);
        }
        recalcularTotal();
    }

    function quitarDelCarro(fila){
        const strong1 = fila.firstElementChild.nextElementSibling.firstElementChild;
        let numeroEnCarrito = parseInt(strong1.textContent);
        let precioUnitario = parseInt(strong1.nextElementSibling.textContent)/numeroEnCarrito;
        if(numeroEnCarrito == 1){
            fila.remove();
        }
        else{
            strong1.textContent = numeroEnCarrito- 1;
            strong1.nextElementSibling.textContent = parseInt(strong1.nextElementSibling.textContent) - precioUnitario;
        }
        recalcularTotal();
    }

    function recalcularTotal(){
        totalArticulos = 0;
        totalPrecio = 0;
        
        document.querySelectorAll("div#divSeleccionados #tableSeleccionados tbody tr").forEach( tr =>{
            totalArticulos+= parseInt(tr.firstElementChild.nextElementSibling.firstElementChild.textContent);
            totalPrecio += parseInt(tr.firstElementChild.nextElementSibling.lastElementChild.textContent);
        })

        console.log(totalArticulos);
        const pieTablaArticulos = document.querySelector("#divSeleccionados #tableSeleccionados tfoot tr");
        pieTablaArticulos.firstElementChild.textContent = `${totalArticulos} artículos`;
        pieTablaArticulos.firstElementChild.nextElementSibling.innerHTML = `${totalPrecio} &euro;`;
        
    }

    function buscarPorPalabras(palabras, cuerpoResultados, senialDeAborto, cuerpoCarrito){
        console.log(palabras);
        
        const opciones = {
            method: 'GET',
            signal: senialDeAborto
        }
        var url = "./ej1.php?".concat(palabras);

        fetch(url, opciones)
        .then(function(r){return recuperarConsulta(r)})
        .then(function(a){mostrarResultados(a, cuerpoResultados, cuerpoCarrito)})
        .catch(function (err){
            console.log("ERROR: " +err);
        })
        


    }

})();
