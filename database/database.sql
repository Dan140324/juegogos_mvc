-- =====================================================================
--  Base de datos: Juegogos  (Proyecto DAW 6-7)
--  6 entidades en 3 parejas relacionadas (una pareja por integrante):
--    Integrante 1: usuarios (1) --- (N) puntajes
--    Integrante 2: categorias (1) --- (N) juegos
--    Integrante 3: resenas (1) --- (N) respuestas
--  Motor: MySQL 8 (compatible con MySQL 5.7)
-- =====================================================================

CREATE DATABASE IF NOT EXISTS juegogos
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE juegogos;

-- Se borra en orden inverso a las FK (por si el script se re-ejecuta)
DROP TABLE IF EXISTS respuestas;
DROP TABLE IF EXISTS resenas;
DROP TABLE IF EXISTS puntajes;
DROP TABLE IF EXISTS juegos;
DROP TABLE IF EXISTS categorias;
DROP TABLE IF EXISTS usuarios;

-- Tablas Base

CREATE TABLE usuarios (
  id      INT AUTO_INCREMENT PRIMARY KEY,
  usuario VARCHAR(50)  NOT NULL UNIQUE,
  correo  VARCHAR(100) NOT NULL,
  clave   VARCHAR(255) NOT NULL
);

CREATE TABLE categorias (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  nombre      VARCHAR(50)  NOT NULL,
  descripcion VARCHAR(255)
);

-- Juegos con sus categorias (relacion 1:N con categorias)

CREATE TABLE juegos (
  id           INT AUTO_INCREMENT PRIMARY KEY,
  nombre       VARCHAR(80)  NOT NULL,
  descripcion  VARCHAR(255),
  categoria_id INT,
  FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE SET NULL
);

-- Palabras para el juego del Ahorcado (no tiene relacion con otras tablas, se usa solo en el juego)

CREATE TABLE palabras (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  palabra    VARCHAR(80) NOT NULL,
  pista      VARCHAR(255),
  categoria  VARCHAR(50)
);

-- Puntajes de los juegos (relacion 1:N con usuarios y con juegos)
CREATE TABLE puntajes (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT NOT NULL,
  juego_id   INT NOT NULL,
  puntaje    INT NOT NULL DEFAULT 0,
  fecha      DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
  FOREIGN KEY (juego_id)   REFERENCES juegos(id)   ON DELETE CASCADE
);


-- Reseñas de los juegos (relacion 1:N con usuarios y con juegos)

CREATE TABLE resenas (
  id           INT AUTO_INCREMENT PRIMARY KEY,
  usuario_id   INT NOT NULL,
  juego_id     INT NOT NULL,
  calificacion INT NOT NULL,
  comentario   TEXT,
  fecha        DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
  FOREIGN KEY (juego_id)   REFERENCES juegos(id)   ON DELETE CASCADE
);

-- Respuestas a las reseñas (relacion 1:N con resenas y con usuarios)

CREATE TABLE respuestas (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  resena_id  INT NOT NULL,
  usuario_id INT NOT NULL,
  texto      TEXT NOT NULL,
  fecha      DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (resena_id)  REFERENCES resenas(id)  ON DELETE CASCADE,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- =====================================================================
--  DATOS DE EJEMPLO
--  Login de prueba: usuario "demo" / clave "1234"
-- =====================================================================

INSERT INTO usuarios (usuario, correo, clave) VALUES
  ('demo', 'demo@juegogos.com', '1234'),
  ('ana',  'ana@juegogos.com',  'ana123'),
  ('luis', 'luis@juegogos.com', 'luis123');

INSERT INTO categorias (nombre, descripcion) VALUES
  ('Clasicos',   'Juegos de toda la vida'),
  ('Arcade',     'Rapidez y reflejos'),
  ('Estrategia', 'Piensa antes de mover');

-- juego id 1 = Snake, id 2 = Tres en Raya, id 3 = Ahorcado, id 4 = Bong (los usa el frontend de los juegos)
INSERT INTO juegos (nombre, descripcion, categoria_id) VALUES
  ('Snake',        'Come manzanas y crece sin chocar', 2),
  ('Tres en Raya', 'Consigue tres en linea antes que tu rival', 3),
  ('Ahorcado', 'Adivina la palabra antes de completar el dibujo', 1),
  ('Bong', 'Salta obstaculos y recoge monedas', 2);

INSERT INTO palabras (palabra, pista, categoria) VALUES
  ('ELEFANTE','Animal terrestre más grande','Animales'),
  ('LEON','Rey de la selva','Animales'),
  ('PHP','Lenguaje utilizado en este proyecto','Programación'),
  ('MYSQL','Sistema gestor de base de datos','Tecnología'),
  ('GUAYAQUIL','Ciudad principal del litoral ecuatoriano','Ciudades');

INSERT INTO puntajes (usuario_id, juego_id, puntaje) VALUES
  (1, 1, 120),
  (2, 1, 80),
  (1, 2, 1);

INSERT INTO resenas (usuario_id, juego_id, calificacion, comentario) VALUES
  (1, 1, 5, 'Adictivo, no puedo parar de jugar Snake'),
  (2, 2, 4, 'Tres en Raya simple pero entretenido');

INSERT INTO respuestas (resena_id, usuario_id, texto) VALUES
  (1, 2, 'Totalmente de acuerdo, es buenisimo'),
  (1, 3, 'A mi tambien me encanta');
