/*Creacíon de usuario*/
DELIMITER \\
CREATE TRIGGER creacion_usuario AFTER INSERT ON users
FOR EACH ROW
BEGIN
	INSERT INTO historial_turnos (id,detalle_ht) VALUES (NEW.id,CONCAT("Se ha registrado ",NEW.name));
END \\
DELIMITER ;

/*Creación de turnos*/
DELIMITER \\
CREATE TRIGGER creacion_turnos AFTER INSERT ON turnos
FOR EACH ROW
BEGIN
  DECLARE usuario bigint;
  SELECT id INTO usuario FROM horarios WHERE id_ho=NEW.id_ho LIMIT 1;
	INSERT INTO historial_turnos (id_tu,id,detalle_ht) VALUES (NEW.id_tu,usuario,CONCAT("Ha generado un turno el ",NEW.fecha_tu," de ",NEW.inicio_tu," a ",NEW.fin_tu));
END \\
DELIMITER ;

DELIMITER \\
CREATE TRIGGER actualizacion_turnos AFTER UPDATE ON turnos
FOR EACH ROW
BEGIN
  DECLARE usuario bigint;
  SELECT id INTO usuario FROM horarios WHERE id_ho=OLD.id_ho LIMIT 1;
  IF (NEW.id_et!=OLD.id_et AND OLD.cedula_es=null) THEN
    INSERT INTO historial_turnos (id_tu,id,detalle_ht) VALUES (OLD.id_tu,usuario,CONCAT(NEW.cedula_es," ha tomado el turno de ",NEW.fecha_tu,"  ",NEW.inicio_tu," a ",NEW.fin_tu),NEW.id_et);    
  END IF;
  IF (NEW.id_et!=OLD.id_et AND NEW.cedula_es=null) THEN
    INSERT INTO historial_turnos (id_tu,id,detalle_ht) VALUES (OLD.id_tu,usuario,CONCAT(OLD.cedula_es," ha liberado el turno de ",NEW.fecha_tu,"  ",NEW.inicio_tu," a ",NEW.fin_tu),NEW.id_et);
  END IF;
  IF (NEW.id_et!=OLD.id_et AND NEW.cedula_es=OLD.cedula_es) THEN
    INSERT INTO historial_turnos (id_tu,id,detalle_ht,id_et) VALUES (OLD.id_tu,usuario,CONCAT("El turno del ",NEW.fecha_tu,"  ",NEW.inicio_tu," a ",NEW.fin_tu),NEW.id_et);
  END IF;

END \\
DELIMITER ;
