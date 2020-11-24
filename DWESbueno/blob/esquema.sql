
CREATE TABLE archivos(
 id int not null auto_increment primary key,
 nombre varchar(50),
 titulo varchar(50),
 contenido mediumblob,
 tipo varchar(50));