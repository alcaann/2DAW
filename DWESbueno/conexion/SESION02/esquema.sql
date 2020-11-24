DROP TABLE IF EXISTS reg_usuarios; 

CREATE TABLE reg_usuarios
(
codigo int NOT NULL AUTO_INCREMENT PRIMARY KEY,
usuario varchar(255) NOT NULL,
password varchar(255)
);

INSERT INTO reg_usuarios ( usuario, password ) VALUES ( 'user','password' );

