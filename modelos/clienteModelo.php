<?php
if ($peticionAjax) {
    require_once('../core/mainModel.php');
} else {
    require_once('./core/mainModel.php');
}

class clienteModelo  extends mainModel{
    protected function agregar_cliente_modelo($datos){
   
        $sql=self::conectar()->prepare("INSERT INTO 
         cliente(codigocliente,nombres_cli, apellidos_cli ,correo_cli, telefono_cli, profesion_cli, grado_cli, pais_cli, departamento_cli, distrito_cli, direccion_cli, 	dni_cli, fechanacimiento_cli, detalle_cli, alumno_cli)
         VALUES(:Codigo, :Nombre, :Apellidos, :Correo, :Telefono, :Profesion, :Grado, :Pais, :Departamento, :Distrito, :Direccion, :Dni, :Fecha, :Detalle, :Alumno )");
        $sql->bindParam(":Codigo",$datos['Codigo']);
        $sql->bindParam(":Nombre",$datos['Nombre']);
        $sql->bindParam(":Apellidos",$datos['Apellidos']);
        $sql->bindParam(":Correo",$datos['Correo']);
        $sql->bindParam(":Telefono",$datos['Telefono']);
        $sql->bindParam(":Profesion",$datos['Profesion']);
        $sql->bindParam(":Grado",$datos['Grado']);
        $sql->bindParam(":Pais",$datos['Pais']);
        $sql->bindParam(":Departamento",$datos['Departamento']);
        $sql->bindParam(":Distrito",$datos['Distrito']);
        $sql->bindParam(":Direccion",$datos['Direccion']);

        $sql->bindParam(":Dni",$datos['Dni']);
        $sql->bindParam(":Fecha",$datos['Fecha']);
        $sql->bindParam(":Detalle",$datos['Detalle']);
        $sql->bindParam(":Alumno",$datos['Alumno']);

        $sql->execute();
        return $sql;
    }
    protected function agregar_interes_modelo($datos)
    {
    
        $sql=self::conectar()->prepare("INSERT INTO 
        interes(idestado, idusuario, idespecialidad, codigocliente, descri_estado)
        VALUES(:Estado, :Usuario, :Curso, :Cliente, :Descripcion)");
        $sql->bindParam(":Estado",$datos['Estado']);
        $sql->bindParam(":Usuario",$datos['Usuario']);
        $sql->bindParam(":Curso",$datos['Curso']);
        $sql->bindParam(":Cliente",$datos['Cliente']);
        $sql->bindParam(":Descripcion",$datos['Descripcion']);
        
        
        $sql->execute();
       // return $sql;
    }
}