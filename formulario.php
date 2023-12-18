<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRACTICA 9- BBDD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script type="text/javascript" src="js/scripts.js"></script>
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
        @font-face {
            font-family: navidad;
            src: url('https://fonts.googleapis.com/css2?family=Rubik+Dirt&display=swap');
        }


        body {
            background-image: url(img/gg.jpg);
            background-size: cover;
            background-position: 0px -50px;

            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;

        }

        h2 {
            color: red;
            display: flex;
            justify-content: center;
            /* Centrado horizontal */
            align-items: center;
            /* Centrado vertical */
            font-size: 20px;
        }

        .completo {
            height: 80vh;
            opacity: 95%;
            background-color: black;
            border-radius: 5px;
            backdrop-filter: blur(10px);
            margin-top: 5%;
            transition: all 1s;
            box-shadow: 0px 0px 15px white;
        }

        input {
            background-color: transparent;
            border: none;
            color: white;
            transition: all 1s;
            width: 150px;
            margin-right: 5%;
        }

        input:hover {
            transform: scale(1.1);
            transition: all 1s;
        }

        /* input {
            width: 30%;
            margin-right: 5%;
            border-color: white;
            background-color: whitesmoke;
            color: solid black;
            border-radius: 5px;
        } */

        label {
            width: 10%;
            color: white;
            margin-right: 3%;
            text-align: justify;
            font-weight: 600;
        }

        a {
            width: 50%;
            color: wheat;
        }

        .ache1 {
            font-size: 20px;
        }

        #a3 {
            margin-left: 8%;
            width: 50%;
            margin-right: 2%;
        }

        .sele {
            width: 80%;
            margin-right: 5%;
        }

        .fom {
            width: 30%;
            margin-right: 20%;

        }

        .login {
            text-shadow: 2px 2px 2px #2a0808;
            font-size: 80px;
            font-weight: 700;
            margin-top: 20px;
            /*podemos poner navidad*/
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        table th {
            font-size: 25px;
            color: #f3fafc;
            text-shadow: 2px 2px 2px #2a0808;
        }

        table tr {
            margin-bottom: 2px;
            font-size: 20px;
        }

        table td {
            color: #f3fafc;
            font-weight: 900;
        }

        table {
            border: 2px;
        }

        .eliminar {
            transition: all .2s;
        }

        .eliminar:hover {
            transform: scale(1.3);

        }
    </style>
</head>

<body>


    <div id="completo container-fluid">


        <?php
        session_start(); //para comenzar y crear una sesion debemos usar el session_start
        include_once("CRUD/consultasCRUD.php");

        if (isset($_SESSION["user"]) || isset($_POST["Usuario"], $_POST["password"]) && Consultas::ComprobarInicio($_POST["Usuario"], $_POST["password"])) {

            if (isset($_POST["Usuario"], $_POST["password"])) {
                $_SESSION["user"] = $_POST["Usuario"];
            }

            ?>

            <div class="container ">
                <div class="container completo bg-white bg-opacity-75 text-center">
                    <span class="container"></span>
                    <div class="container mt-5 mb-5">
                        <h1 class="container login mt-5 text-center text-white">Lista Regalos de Navidad</h1>
                    </div>
                    <div class=" text-black  ">
                        <form action="CRUD/Añadir.php" method="POST">
                            <input type="text" class="text-center text-dark" name="regala" placeholder="De..." required>
                            <input type="text" class="text-center text-dark " name="regalo" placeholder="Regalo..." required>
                            <input type="text" class="text-center text-dark" name="regalado" placeholder="Para..." required>
                            <input type="submit" class="text-white btn bg-success btn-block"
                                value="Agregar a la lista"></input>
                        </form>
                        <br>
                    </div>
                    <div class=" text-black  ">
                        <form action="CRUD/Modificar.php" method="POST">
                            <input type="text" class="text-center text-dark" name="id" placeholder="Id del Regalo..." required>
                            <input type="text" class="text-center text-dark" name="regala" placeholder="De..." required>
                            <input type="text" class="text-center text-dark" name="regalo" placeholder="Regalo..." required>
                            <input type="text" class="text-center text-dark" name="regalado" placeholder="Para..." required>
                            <input type="submit" class="text-white btn btn-outline-info btn-block"
                                value="Realizar Cambios"></input>
                        </form>
                        <br>
                    </div>
                    <br>
                    <div class="container-fluid d-flex justify-content-center align-items-center ">
                        <table class="container-fluid ">
                            <tr>
                                <th>
                                    Id:
                                </th>
                                <th>
                                    Regala:
                                </th>
                                <th>
                                    Regalo:
                                </th>
                                <th>
                                    Regalado:
                                </th>
                            </tr>
                            <?php
                            Consultas::MostrarTabla();

                            ?>

                        </table>
                    </div>
                    <div class="container fixed-bottom mb-5 text-danger">
                        <form action="index.php">
                            <input type="submit" class="container col-5 btn bg-white btn-block mt-5" value="Salir"></input>
                        </form>
                    </div>
                </div>

            </div>
        </div>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>

        <?php
        } else {
            header("location:index.php?inco");
        }
        ?>



</body>

</html>