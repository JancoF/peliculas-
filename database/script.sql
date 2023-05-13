create database peliculas;
use peliculas;

CREATE TABLE pelicula (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  titulo varchar(48) NOT NULL ,
  descripcion TEXT,
  genero TEXT,
  poster_name varchar(100) NOT NULL
);

DESCRIBE pelicula;