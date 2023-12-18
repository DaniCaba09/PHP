<?php

    include_once("consultasCRUD.php");
    Consultas::Eliminar($_POST["id"]);
    header("location:../formulario.php");

?>