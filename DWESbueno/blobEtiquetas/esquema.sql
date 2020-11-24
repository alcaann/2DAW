DROP TABLE IF EXISTS blob_archivos_etiquetas;
DROP TABLE IF EXISTS blob_etiquetas;
DROP TABLE IF EXISTS blob_archivos;

CREATE TABLE blob_archivos(
 id int not null auto_increment primary key,
 nombre varchar(50),
 titulo varchar(50),
 contenido mediumblob,
 tipo varchar(50));
 
 
CREATE TABLE blob_etiquetas(
 id int not null auto_increment primary key,
 etiqueta varchar(50)
 );
 
 CREATE TABLE blob_archivos_etiquetas(
 id int not null auto_increment primary key,
 etiqueta_id int,
 archivo_id int,
 FOREIGN KEY (etiqueta_id)  REFERENCES  blob_etiquetas( id ),
 FOREIGN KEY (archivo_id ) REFERENCES  blob_archivos( id )
 );
 
insert into blob_etiquetas ( etiqueta ) values ( "estatua");
 
insert into blob_etiquetas ( etiqueta ) values ( "pintura");
  
insert into blob_etiquetas ( etiqueta ) values ( "reliquia");

insert into blob_etiquetas ( etiqueta ) values ( "joya");


insert into blob_etiquetas ( etiqueta ) values ( "religioso");
 
 