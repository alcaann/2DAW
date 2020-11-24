
document.addEventListener("DOMContentLoaded",function(){
    const inputTexto = document.querySelector("#txtAdd");
    const boton0 = document.querySelector("#btnAdd");
    const botonSeleccionarTodo = document.querySelector("#btnSelAll");
    const botonSeleccionarNada = document.querySelector("#btnSelNot");
    const botonInvertirSeleccion = document.querySelector("#btnInvSel");
    const botonMoverSeleccionado = document.querySelector("#btnMovSel");
    const botonBorrarSeleccionado = document.querySelector("#btnDelSel");
    const listaCompra = document.querySelector("#mylist");


	inputTexto.addEventListener("keyup",function(acho){
        if(acho && acho.key ==="Enter")
        aniadirAlCarrito(inputTexto, listaCompra);
    });
    //DUDAAAA no va   boton0.addEventListener("click",aniadirAlCarrito(inputTexto, listaCompra));
    botonSeleccionarTodo.addEventListener("click",seleccionarTodo);




})
function aniadirAlCarrito(texto, lista){
    cosa = texto.value.trim();
    if(cosa){
    let nuevoLI = document.createElement("LI");
    nuevoLI.textContent = cosa;
    lista.appendChild(nuevoLI);
    texto.focus();
    texto.value = "";
    //hacer clickable el nuevo li
    nuevoLI.addEventListener("click", function(){
        this.classList.toggle("seleccionado");
    })

}
}
function seleccionarTodo(){
    console.log("seleccionar todo")
    document.querySelectorAll("#mylist li").forEach(function(objeto){
        objeto.classList.add("seleccionado");
    });
}
function DEseleccionarTodo(){
    console.log("seleccionar todo")
    document.querySelectorAll("#mylist li").forEach(function(objeto){
        objeto.classList.remove("seleccionado");
    });
}
function cambiarTodo(){
    console.log("seleccionar todo")
    document.querySelectorAll("#mylist li").forEach(function(objeto){
        objeto.classList.toggle("seleccionado");
    });
}



