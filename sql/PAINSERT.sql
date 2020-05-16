DROP PROCEDURE IF EXISTS proc_ins_materia;
DELIMITER $$
CREATE PROCEDURE proc_ins_materia(IN nombre VARCHAR(45))
BEGIN
	INSERT INTO Materia (mat_nombre) VALUES (nombre);
END $$
DELIMITER ;
DROP PROCEDURE IF EXISTS proc_ins_asignatura;
DELIMITER $$
CREATE PROCEDURE proc_ins_asignatura(IN id INT,IN nombre VARCHAR(45))
BEGIN
	INSERT INTO Asignatura (mat_id, asi_nombre) VALUES (id, nombre);
END $$
DELIMITER ;