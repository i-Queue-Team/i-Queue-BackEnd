<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--iconos material icon-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>Login IQueue</title>
</head>
<style>
    body {
        display: flex;
        min-height: 100vh;
        flex-direction: column;
    }

    main {
        flex: 1 0 auto;
    }

</style>

<body class="container">

    <!--menu-->
    <!--nav extendido-->
    <nav class="nav-extended">
        <div class="nav-wrapper" style="margin-left: 8px;">
            <a href="{{ url('/home') }}" class="brand-logo"><span class=".center-align">I-Queue</span></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="{{ url('/login') }}"><img src="./images/userlogin.png"
                            style=" padding: 5px 0px 5px 0px; margin-top: 10px;" alt=""></a></li>
            </ul>
            <a href="{{ url('/login') }}" data-target="mobile-demo" class="sidenav-trigger"
                style=" margin: 10px 0px 0px 0px; padding-left: 10px; height: 20px;"><img src="./images/userlogin.png"
                    alt=""></a>
        </div>
        <!--fin nav extendido-->
        <div class="nav-content">
            <ul class="tabs tabs-transparent">
                <li><a href="{{ url('/contactoempresas') }}">Empresas</a></li>
                <li><a href="{{ url('/sobrenosotros') }}">Sobre nosotros</a></li>
            </ul>
        </div>
    </nav>


    <main>
        <!--fin menu-->
        <h2 class="center-align">Inicio de sesión</h2>


        <section class="container">
            <div style="border-radius: 1rem; background-color: antiquewhite; padding: 10px; ">
                <article class="col s6 offset-s3">
                    <form method="GET" action="{{ url('/user') }}">
                        <div class="input-field">
                            <i class="material-icons prefix">person_pin</i>
                            <label for="usuario">Usuario</label>
                            <input type="text" name="usuario" required>
                        </div>

                        <div class="input-field">
                            <i class="material-icons prefix">password</i>
                            <label for="password">Contraseña</label>
                            <input type="password" name="password" required minlength="8">
                        </div>
                        <p class="center-align">
                            <button class="waves-effect waves-light btn" type="submit"><i
                                    class="material-icons right">send</i>entrar</button>
                        </p>
                    </form>
                    <br>

                    <div class="center-align">
                        <!-- Modal Trigger -->
                        <a class="modal-trigger" href="#modal1">¿Olvidaste tu contraseña?</a>

                        <!-- Modal Structure -->
                        <div id="modal1" class="modal" style="min-width: 250px">
                            <div class="modal-content">
                                <h4>Recordar contraseña</h4>
                                <p>Introduce tu dirección de correo electronico</p>
                                <form action="#ContraseñaRecordada">
                                    <div class="input-field">
                                        <i class="material-icons prefix">contact_mail</i>
                                        <label for="email">email</label>
                                        <input type="email" name="email" required class="validate">
                                    </div>
                                    <div class="input-field">
                                        <i class="material-icons prefix">contact_mail</i>
                                        <label for="email2">repetir email</label>
                                        <input type="email" name="email2" required class="validate">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <div class="center-align">
                                    <a href="#!" class="modal-close waves-effect waves-light btn red">Cancelar</a>
                                    <button class="waves-effect waves-light btn " type="submit">Recordar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="center-align">¿No tienes cuenta? <a href="{{ url('/registro') }}">regístrate aquí</a>.
                    </p>
                    <br>
                    </form>
                </article>

            </div>
    </main>

    </section>
    <!--fin login-->
    <br>
    <footer class="page-footer">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="center-align">Info</h5>
                    <p class="grey-text text-lighten-4"> I-Queue es la aplicación multiplataforma desarrollada por el
                        equipo de la promoción 2020-2021 de Escuela Estech del Grado Superior en Desarrollo de
                        Aplicaciones multiplataforma. La idea está basada en la digitalización, monitorización y
                        adaptación de la misma para una gran cantidad de modelos de negocio de cara a la mejora e
                        implementación de sus servicios de cara al público.</p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="white-text">Descárgate la app</h5>
                    <ul>
                        <li><a class="grey-text text-lighten-3" href="#DescargaparaiOS"><img src="./images/appstore.PNG"
                                    alt="iOS"></a></li>
                        <br>
                        <li><a class="grey-text text-lighten-3" href="#DescargaAndroid"><img
                                    src="./images/androidstore.PNG" alt="android"></a></li>
                        <li>
                            <h5>Redes sociales</h5>
                            <a class="grey-text text-lighten-3" href="#facebook"><img src="./images/facebook.png"
                                    alt="facebook"></a>
                            <a class="grey-text text-lighten-3" href="#email"><img src="./images/correoelectronico.png"
                                    alt="email"></a>
                            <a class="grey-text text-lighten-3" href="#twitter"><img src="./images/gorjeo.png"
                                    alt="twitter"></a>
                            <a class="grey-text text-lighten-3" href="#instagram"><img src="./images/instagram.png"
                                    alt="instagram"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                <p class="center-align">© 2021 Copyright I-Queue team</p>
            </div>
        </div>
    </footer>

</body>


<script>
    //modal

    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.modal');
        var instances = M.Modal.init(elems);
    });

</script>


<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="./css/materialize.css">

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</html>
