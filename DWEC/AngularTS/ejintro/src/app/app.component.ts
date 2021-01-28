import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title:any = 'ejintro';
  piezas:any = [];
  constructor(){
    setInterval( ()=>{
      this.title = 'ejintro' +String(Math.floor(Math.random()*100))
    }, 2000)

    const pieza1 = {
      nombre: "AMD Ryzen 5 3600",
      precio: 249.90,
      stock: false
    }
    const pieza2 = {
      nombre: "MSI B550i",
      precio: 179.90,
      stock: true
    }
    
    this.piezas.push(pieza1,pieza2);
  }
}

