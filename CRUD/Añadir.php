<?php

    include_once("consultasCRUD.php");
    Consultas::Añadir($_POST["regala"], $_POST["regalo"], $_POST["regalado"]);
    header("location:../formulario.php");

?>