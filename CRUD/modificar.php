<?php

    include_once("consultasCRUD.php");
    Consultas::Modificar($_POST["id"], $_POST["regala"], $_POST["regalo"], $_POST["regalado"]);
    header("location:../formulario.php");

?>