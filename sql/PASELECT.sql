DROP PROCEDURE IF EXISTS proc_con_materia;
DELIMITER $$
CREATE PROCEDURE proc_con_materia(IN id INT)
BEGIN
	SELECT * FROM materia WHERE mat_id=id;
END $$
DELIMITER ;
DROP PROCEDURE IF EXISTS proc_con_materia_order;
DELIMITER $$
CREATE PROCEDURE proc_con_materia_order()
BEGIN
	SELECT * FROM materia ORDER BY mat_id;
END $$
DELIMITER ;
DROP PROCEDURE IF EXISTS proc_con_asignatura;
DELIMITER $$
CREATE PROCEDURE proc_con_asignatura(IN id INT)
BEGIN
	SELECT * from asignatura WHERE mat_id=id;
END $$
DELIMITER ;
DROP PROCEDURE IF EXISTS proc_con_asignatura_asi;
DELIMITER $$
CREATE PROCEDURE proc_con_asignatura_asi(IN id INT)
BEGIN
	SELECT * from asignatura WHERE asi_id=id;
END $$
DELIMITER ;