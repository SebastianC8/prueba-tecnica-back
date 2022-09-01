/** Script base de datos **/

CREATE DATABASE gestion_empleados;
USE gestion_empleados;

/** Tabla usuarios **/
CREATE TABLE `usuarios` (
    `id` INT(11) NOT NULL PRIMARY KEY,
    `usuario` VARCHAR(20) NOT NULL,
    `contraseña` VARCHAR(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/** Tabla actividades **/
CREATE TABLE `actividades` (
    `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `descripcion` VARCHAR(50) NOT NULL,
    `usuario_id` INT(11) NOT NULL,
    FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

/** Tabla tiempos **/
CREATE TABLE `tiempos` (
    `id` INT (11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `fecha` DATE NOT NULL,
    `tiempo` TINYINT(2) NOT NULL,
    `actividad_id` INT(11) NOT NULL,
    FOREIGN KEY (`actividad_id`) REFERENCES `actividades`(`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;