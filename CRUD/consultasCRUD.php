<?php
class Consultas
{
    public static function CrearTabla()
    {
        $host = "localhost";
        $user = "root";
        $password = "";
        $conexion = mysqli_connect($host, $user, $password) or die("Conexion incorrecta"); //estos comandos son muy importantes ya que asignamos donde queremos que se utilice la BBDD


        $sql = "CREATE DATABASE IF NOT EXISTS datosinicio";
        $tablacrear = "CREATE TABLE IF NOT EXISTS REGALOS(ID INT AUTO_INCREMENT PRIMARY KEY,  REGALA varchar(30) , REGALO varchar(100)  ,REGALADO varchar(30));";
        mysqli_query($conexion, $sql) or die("BaseDeDatos no creada");
        mysqli_select_db($conexion, "datosinicio") or die("No se encontro la bd");

        mysqli_query($conexion, $tablacrear) or die("No se pudo crear la tabla");

        mysqli_close($conexion); //siempre se debe cerrar
    }

    public static function Insertar($usuario, $clave)
    {

        $host = "localhost";
        $user = "root";
        $password = "";
        $database = "datosinicio";
        $conexion = mysqli_connect($host, $user, $password, $database) or die("Conexion incorrecta");
        $HashPassword = password_hash($clave, PASSWORD_DEFAULT);


        $consultainsertar = "INSERT INTO USUARIOS VALUES(?,?)"; //Cuando usamos los ?? tenemos que usar los statements


        $stmtInsertar = mysqli_prepare($conexion, $consultainsertar); //creamos statements de insertar

        mysqli_stmt_bind_param($stmtInsertar, "ss", $usuario, $HashPassword); //para asignar los valores de la consulta / el poner la s es para indicar los string==numero de valores que vamos a usar

        mysqli_stmt_execute($stmtInsertar); //debemos ejecutarla

        mysqli_stmt_close($stmtInsertar); //Debemos cerrar tanto el statement de Insertar
        mysqli_close($conexion); //como la conexion


    }


    public static function ExisteRegistro($usuario)
    {
        //siempre debemos de llamar al dominio que vamos a usar, el usuario, que siempre sera root y una contraseña.
        $host = "localhost";
        $user = "root";
        $password = "";
        $database = "datosinicio";
        $conexion = mysqli_connect($host, $user, $password, $database) or die("Conexion incorrecta");
        $Existe = false;

        $consultausuario = "SELECT * FROM USUARIOS WHERE USUARIO=?"; //lo que estamos realizando con esta consulta es comprobar si el usuario existe en la BBDD
        $stmtUsuario = mysqli_prepare($conexion, $consultausuario) or die("Error");
        mysqli_stmt_bind_param($stmtUsuario, "s", $usuario) or die("Error");
        mysqli_stmt_execute($stmtUsuario);

        mysqli_stmt_store_result($stmtUsuario); //Deberemos guardar el resultado, para luego comprobar si el usuario existe

        if (mysqli_stmt_num_rows($stmtUsuario) > 0) { //Comprobamos si el usuario es mayor a 0 para ver si existe
            $Existe = true;
        }

        mysqli_stmt_close($stmtUsuario);
        mysqli_close($conexion);

        return $Existe; //Devolvemos la variable que iniciamos en false al principio
    }

    public static function ComprobarInicio($usuario, $clave)
    {

        $host = "localhost";
        $user = "root";
        $password = "";
        $database = "datosinicio";

        $conexion = mysqli_connect($host, $user, $password, $database) or die("Conexion incorrecta");
        $Existe = false;

        // Utilizar una consulta preparada
        $consulta = "SELECT CLAVE FROM USUARIOS WHERE USUARIO=?"; //Esta consulta lo que hace es ver si la contraseña y el usuario son correctos
        $stmt = mysqli_prepare($conexion, $consulta);
        // Vincular parámetros
        mysqli_stmt_bind_param($stmt, "s", $usuario);
        // Ejecutar la consulta
        mysqli_stmt_execute($stmt);

        mysqli_stmt_bind_result($stmt, $columnaHash);
        // Obtener resultados
        mysqli_stmt_fetch($stmt);

        if (password_verify($clave, $columnaHash)) {
            $Existe = true;
        }

        // Cerrar la consulta preparada
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);

        return $Existe;
    }
    public static function recolectarDatos($usuario)
    { //Esta funcion es opcional , se encarga de almacenar los datos en una sesion
        $host = "localhost";
        $user = "root";
        $password = "";
        $database = "datosinicio";

        $conexion = mysqli_connect($host, $user, $password, $database) or die("Conexion incorrecta");
        $consulta = "SELECT * FROM USUARIOS WHERE USUARIO=?";
        $stmtRecolectar = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmtRecolectar, "s", $usuario);
        mysqli_stmt_execute($stmtRecolectar);
        mysqli_stmt_store_result($stmtRecolectar);

        mysqli_stmt_bind_result($stmtRecolectar, $columna1, $columnaNN, $columna3, $columna4, $columna5, $columna6, $columna7);

        mysqli_stmt_fetch($stmtRecolectar);

        $_SESSION["usuario"] = $columna1;
        $_SESSION["email"] = $columna3;
        $_SESSION["nombre"] = $columna4;
        $_SESSION["telefono"] = $columna5;
        $_SESSION["direccion"] = $columna6;
        $_SESSION["sexo"] = $columna7;

        mysqli_stmt_close($stmtRecolectar);
        mysqli_close($conexion);

    }


    public static function Añadir($regala, $regalo, $regalado)
    {

        $host = "localhost";
        $user = "root";
        $password = "";
        $database = "datosinicio";

        $conexion = mysqli_connect($host, $user, $password, $database) or die("Conexion incorrecta");
        $consulta = "INSERT INTO REGALOS (REGALA, REGALO, REGALADO) VALUES(?,?,?)";

        $stmtAñadir = mysqli_prepare($conexion, $consulta); //creamos statements de insertar

        mysqli_stmt_bind_param($stmtAñadir, "sss", $regala, $regalo, $regalado); //para asignar los valores de la consulta / el poner la s es para indicar los string==numero de valores que vamos a usar

        mysqli_stmt_execute($stmtAñadir); //debemos ejecutarla

        mysqli_stmt_close($stmtAñadir); //Debemos cerrar tanto el statement de Insertar
        mysqli_close($conexion);

    }


    public static function Eliminar($id)
    {

        $host = "localhost";
        $user = "root";
        $password = "";
        $database = "datosinicio";

        $conexion = mysqli_connect($host, $user, $password, $database) or die("Conexion incorrecta");
        $consulta = "DELETE FROM REGALOS WHERE ID=$id";

        $StmtEliminar = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_execute($StmtEliminar);
        mysqli_stmt_store_result($StmtEliminar);

        mysqli_stmt_close($StmtEliminar);
        mysqli_close($conexion);

    }

    public static function Modificar($id, $regala, $regalo, $regalado)
    {

        $host = "localhost";
        $user = "root";
        $password = "";
        $database = "datosinicio";

        $conexion = mysqli_connect($host, $user, $password, $database) or die("Conexion incorrecta");

        $consulta = "UPDATE REGALOS SET REGALA=?, REGALO=?, REGALADO=?  WHERE ID=$id";

        $StmtModificar = mysqli_prepare($conexion, $consulta); //creamos statements de insertar

        mysqli_stmt_bind_param($StmtModificar, "sss", $regala, $regalo, $regalado); //para asignar los valores de la consulta / el poner la s es para indicar los string==numero de valores que vamos a usar

        mysqli_stmt_execute($StmtModificar);

        mysqli_stmt_close($StmtModificar);
        mysqli_close($conexion);

    }



    public static function MostrarTabla()
    {

        $host = "localhost";
        $user = "root";
        $password = "";
        $database = "datosinicio";

        $conexion = mysqli_connect($host, $user, $password, $database) or die("Conexion incorrecta");

        $consulta = "SELECT * FROM REGALOS";

        $Stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_execute($Stmt);
        mysqli_stmt_store_result($Stmt);

        mysqli_stmt_bind_result($Stmt, $id, $regala, $regalo, $regalado);

        while (mysqli_stmt_fetch($Stmt)) {

            echo "<tr class='' >";
            echo "<td class='text-success animate__animated animate__fadeIn'>$id</td>";
            echo "<td class='text-secondary animate__animated animate__fadeIn'>$regala</td>";
            echo "<td class='text-secondary animate__animated animate__fadeIn'>$regalo</td>";
            echo "<td class='text-secondary animate__animated animate__fadeIn'>$regalado</td>";
            echo "<td style=''><form action='CRUD/eliminar.php' method='POST'> <button name='id' value='$id' class='animate__animated animate__fadeIn eliminar  border-0 bg-transparent text-danger'><svg xmlns='http://www.w3.org/2000/svg' width='30' height='30' fill='currentColor' class='bi bi-x-circle' viewBox='0 0 16 16'>
        <path d='M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16'/>
        <path d='M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708'/>
      </svg></button></form></td>";
            echo "</tr>";
        }

        mysqli_stmt_close($Stmt);
        mysqli_close($conexion);
    }

}

?>