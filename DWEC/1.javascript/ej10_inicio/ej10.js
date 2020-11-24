document.addEventListener("DOMContentLoaded",function(){
	const places = ["Abanilla","Abarán","Águilas","Albudeite","Alcantarilla","Alcázares (Los)","Aledo","Alguazas","Alhama de Murcia","Archena","Beniel","Blanca","Bullas","Calasparra","Campos del Río","Caravaca de la Cruz","Cartagena","Cehegín","Ceutí","Cieza","Fortuna","Fuente Álamo de Murcia","Jumilla","Librilla","Lorca","Lorquí","Mazarrón","Molina de Segura","Moratalla","Mula","Murcia","Ojós","Pliego","Puerto Lumbreras","Ricote","San Javier","San Pedro del Pinatar","Santomera","Torre-Pacheco","Torres de Cotillas (Las)","Totana","Ulea","Unión (La)","Villanueva del Río Segura","Yecla"]
	const datalist = document.querySelector("#listaResult1")
	const search1 = document.querySelector("#search1")
	const addButton1 = document.querySelector("#solution1 form button.btn-primary")
	const form =document.querySelector("#solution1 form")
	const listaUL1 = document.querySelector("#placeList")
	
	
	places.forEach(function(township){
		nuevoOpition = document.createElement("option")
		nuevoOpition.value = township
		datalist.appendChild(nuevoOpition)
	})

	addButton1.addEventListener("click",function(){
		addItemToList(search1, places, listaUL1)
	})
	
	search1.addEventListener("keyup",function(tecla){
		if(tecla && tecla.key =="Enter"){
			addItemToList(search1, places, listaUL1)
		}
	})

	form.addEventListener("submit",function(f){
		f.preventDefault()
	})//impedir que el formulario envie todo al dar intro en algún campo 




})
function addItemToList(caja, listaLugares, ul){
	console.log(caja.value)
	if (listaLugares.includes(caja.value)){

	let nuevoLI = document.createElement("LI")
	nuevoLI.value = caja.vaule
	ul.appendChild(nuevoLI)
	}

}

Array.prototype.buscarSubstring = function(substring){
	var results = []
	this.forEach(function(item){
		if(item.includes(substring))
		results.push(item)})
	return results
}
