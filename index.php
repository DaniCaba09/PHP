<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRACTICA 9- DanielCaba</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script type="text/javascript" src="registrar.js"></script>
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        body {
            background-image: url(img/ghost.jpg);
            background-size: cover;
            overflow: hidden;
        }

        .contenedor {
            width: 40%;
            background-color: transparent;
            backdrop-filter: blur(30px);
            border-radius: 5px;
            margin-top: 5%;
            transition: all 1s;
            border: 1px solid gainsboro;
        }

        .contenedor:hover {
            transform: scale(1.05);
        }

        #registro {
            width: 50%;
            background-color: rgba(255, 255, 255, 0.375);
            border-radius: 5px;
            backdrop-filter: blur(2px);
            margin-top: 10%;
            margin-left: -10%;
            transition: all 1s;
            display: none;
        }

        .login {
            text-shadow: 5px 5px 2px grey
                /*#c21d03*/
            ;
            font-size: 100px;
        }

        .letra {
            font-size: 12px;
        }

        @media screen and (max-width:990px) {
            .login {
                font-size: 50px;
            }
        }

        @media screen and (max-width:520px) {
            .login {
                font-size: 20px;
            }
        }

        @media screen and (max-width:430px) {
            .login {
                font-size: 30px;
            }

            .contenedor {
                width: 70%;
            }

            #registro {
                width: 70%;
                margin-left: 17%;
            }
        }
    </style>
</head>

<body>

    <?php

    
    session_start();
    session_destroy();

    include_once("CRUD/consultasCRUD.php");

    if(isset($_POST["Usuario"], $_POST["email"],$_POST["password"] )){


        if (Consultas::ExisteRegistro($_POST["Usuario"])) {
            echo "<h1 style='color:red'>Usuario ya existente</h1>";
        }else{
            Consultas::Insertar($_POST["Usuario"], $_POST["password"]);
            header("location:index.php?correcto");

        }


    }else{

    ?>

    <div class="container mt-5 ">
        <div class="row">
            <div class="col-5 container contenedor text-center animate__animated animate__slideInLeft animate__slow">
                <form class=" container mt-3" name="formulario" id="formulario" method="POST" action="formulario.php">
                    <!--Este formulario lo creamos para que el usuario de la web pueda logearse con su contraseña y nombre -->
                    <div class="form-outline mx-auto mb-4">
                        <h1 class="container login text-center text-body">LOGIN</h1>
                    </div>
                    <!-- Name input -->
                    <div class="form-outline mb-4">
                        <input type="text" name="Usuario" id="usuario" class="form-control text-center"
                            placeholder="Nombre Usuario" required />
                        <!--En este apartado el usuario debe meter el nombre con tipo text -->

                    </div>

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="password" name="password" id="password" class="form-control text-center"
                            placeholder="Password"
                            required /><!--Aquí el usuario mete la contraseña al logearse con tipo password -->

                    </div>

                    <?php
                    if (isset($_GET["inco"])) { //en este apartado creamos un pequeño php para que cuando el login sea incorrecto aparezca un mensaje diciendo que fue'incorrecto', esto lo conseguimos con el metodo GET, y otorgandole atributos
                        echo "<p style='color:red; text-shadow: 2px 2px 2px white;'>EL INICIO DE SESIÓN FUÉ INCORRECTO</p>";
                    }
                    ?>
                    <?php
                    if (isset($_GET["correcto"])) { //en este apartado creamos un pequeño php para que cuando el login sea CORRECTO aparezca un mensaje diciendo que fue'incorrecto', esto lo conseguimos con el metodo GET, y otorgandole atributos
                        echo "<p style='color:green; text-shadow: 2px 2px 2px white;'>EL REGISTRO FUÉ CORRECTO</p>";
                    }
                    ?>


                    <!-- Checkbox -->
                    <div class="form-check d-flex justify-content-center mb-4">
                        <input class="form-check-input me-2" type="checkbox" value="" checked />
                        <!--Este apartado lo usamos a modo de decoración donde el usuario puede marcar haber leido los términos -->
                        <label class="form-check-label" for="form5Example3">
                            He leído y acepto los términos
                        </label>
                    </div>

                    <!-- Submit button -->
                    <button id="enviar" type="submit"
                        class="col-5 btn btn-danger btn-block mb-4 ms-4 me-1">Iniciar</button>

                    <input type="button" class="col-5 btn btn-danger btn-block mb-4" value="Registrar"
                        onclick="registrar()" required></input>

                </form>


                <div class="accordion " id="accordionExample">
                    <!--en este apartado lo que he creado ha sido un desplegable, para que el usuario pueda ver de una forma atractiva e intuitiva de conocer la descripcion de las sesiones y las cookies, en vez de en el propio codigo -->
                    <div class="accordion-item ">
                        <h2 class="accordion-header">
                            <button class="accordion-button bg-transparent text-dark" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                aria-controls="collapseOne">
                                ¿Qué es PDO en BBDD?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body letra">
                                <strong>PDO es una extensión de PHP conocida como "PHP Data Objects".</strong> Su
                                función principal es ofrecer una capa de acceso a bases de datos que no está
                                vinculada a
                                un sistema de gestión de bases de datos (SGBD) específico. En lugar de depender de
                                funciones particulares de un SGBD, PDO emplea una interfaz universal para
                                comunicarse
                                con distintas bases de datos. Esto simplifica la tarea de cambiar entre
                                <code>diferentes SGBD, </code> ya que no es necesario reescribir una gran cantidad
                                de
                                código para adaptarse a cada uno.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-transparent text-dark" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                aria-controls="collapseTwo">
                                Principales Ventajas
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body letra">
                                <strong>Seguridad contra Inyección SQL</strong>
                                <hr>
                                <strong>Portabilidad del Código</strong>
                                <hr>
                                <strong>Soporte para Múltiples Bases de Datos</strong>
                                <hr>
                                <strong>Manejo Consistente de Errores</strong>
                                <hr>
                                <strong>Interfaz Orientada a Objetos</strong>
                                <hr>
                                <strong>Rendimiento Mejorado</strong>
                                <hr>
                                <strong>Preparación de Consultas</strong>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-7"></div>

        </div>
    </div>

    <div class="container  mt-5 ">
        <div class="row">
            <div id="registro" class="col-5 animate__animated animate__flipInY container contenedor text-center ">
                <form class=" container mt-3" name="formulario" id="formulario" method="POST" action="index.php">
                    <!--Este formulario lo creamos para que el usuario de la web pueda logearse con su contraseña y nombre -->
                    <div class="form-outline mx-auto mb-4">
                        <h1 class="container login text-center text-dark">REGISTRO</h1>
                    </div>
                    <!-- Name input -->
                    <div class="form-outline mb-4">
                        <input type="text" name="Usuario" id="usuario" class="form-control text-center"
                            placeholder="Nombre Usuario" required />
                        <!--En este apartado el usuario debe meter el nombre con tipo text -->

                    </div>

                    <div class="form-outline mb-4">
                        <input type="email" name="email" id="email" class="form-control text-center"
                            placeholder="Email Usuario" required />
                        <!--En este apartado el usuario debe meter el nombre con tipo text -->

                    </div>

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="password" name="password" id="password" class="form-control text-center"
                            placeholder="Password"
                            required /><!--Aquí el usuario mete la contraseña al logearse con tipo password -->

                    </div>

                    <?php
                    if (isset($_GET["inco"])) { //en este apartado creamos un pequeño php para que cuando el login sea incorrecto aparezca un mensaje diciendo que fue'incorrecto', esto lo conseguimos con el metodo GET, y otorgandole atributos
                        echo "<p style='color:red; text-shadow: 2px 2px 2px white;'>EL INICIO DE SESIÓN FUÉ INCORRECTO</p>";
                    }
                    ?>


                    <!-- Checkbox -->
                    <div class="form-check d-flex justify-content-center mb-4">
                        <input class="form-check-input me-2" type="checkbox" value="" checked />
                        <!--Este apartado lo usamos a modo de decoración donde el usuario puede marcar haber leido los términos -->
                        <label class="form-check-label" for="form5Example3">
                            He leído y acepto los términos
                        </label>
                    </div>

                    <!-- Submit button -->
                    <button id="" type="submit" class="btn btn-danger btn-block mb-4">Registrar</button>
                    <!--Este apartadoi del form lo usamos a modo de boton con un tipo submit, para que realice la funcion del action -->
                </form>
            </div>
            <div class="col-7"></div>

        </div>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <?php
    }
    ?>
</body>

</html>