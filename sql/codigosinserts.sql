INSERT INTO `Permiso` (`perm_id`, `perm_nom`, `perm_descripcion`) VALUES (NULL, 'Nueva Materia', 'Crear una nueva Materia'), (NULL, 'Nueva Asignatura', 'Crear una nueva Asignatura');
INSERT INTO `Persona_has_Permiso` (`per_perm_id`, `per_id`, `perm_id`, `per_perm_estado`) VALUES (NULL, '1', '2', '0'), (NULL, '1', '3', '0');
INSERT INTO `Permiso` (`perm_id`, `perm_nom`, `perm_descripcion`) VALUES (NULL, 'Nuevo Curso', 'Acceder a la pagina nuevo curso');
INSERT INTO `Persona_has_Permiso` (`per_perm_id`, `per_id`, `perm_id`, `per_perm_estado`) VALUES (NULL, '1', '4', '1');
INSERT INTO `Permiso` (`perm_id`, `perm_nom`, `perm_descripcion`) VALUES (NULL, 'Nuevo Grado', 'Acceder a la pagina nuevo Grado');
INSERT INTO `Persona_has_Permiso` (`per_perm_id`, `per_id`, `perm_id`, `per_perm_estado`) VALUES (NULL, '1', '5', '1');
