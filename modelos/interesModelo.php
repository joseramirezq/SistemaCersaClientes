<?php
if ($peticionAjax) {
    require_once('../core/mainModel.php');
} else {
    require_once('./core/mainModel.php');
}

class interesModelo extends mainModel
{

    protected function agregar_interes_modelo($datos)
    {
    
        $sql=self::conectar()->prepare("INSERT INTO 
        interes(idestado, idusuario/*, idespecialidad, codigocliente, descri_estado*/)
        VALUES(:Estado, :Usuario/*, :Curso, :Cliente, :Descripcion*/)");
        $sql->bindParam(":Estado",$datos['Estado']);
        $sql->bindParam(":Usuario",$datos['Usuario']);
       /* $sql->bindParam(":Curso",$datos['Curso']);
        $sql->bindParam(":Cliente",$datos['Cliente']);
        $sql->bindParam(":Descripcion",$datos['Descripcion']);*/
        
        
        $sql->execute();
        return $sql;
    }
}

