<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--iconos material icon-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--css tarjetas hoover-->
    <link rel="stylesheet" href="./css/aboutUsCards.css">
    <title>Sobre nosotros</title>

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
                <li><a href="#colas">Sobre nosotros</a></li>
            </ul>
        </div>
    </nav>
    <!--fin menu-->

    <div class="row">
        <div class="heading-title text-center">
            <h2 class="center-align"><b>Nuestro equipo</b></h2>
        </div>
        <!--Zamora-->
        <div class="col s12 m6 l4">
            <div class="team-member">
                <div class="team-img">
                    <img src="./images/ios.png" class="responsive-img" alt="team member"
                        style="display:block;margin:auto;">
                </div>
                <div class="team-hover">
                    <div class="desk">
                        <div class="card-panel teal lighten-2" style="display:block;margin:auto; heigth:100%;">
                            <img src='./images/zamora.PNG' class="responsive-img"
                                style="border-radius:140px;border:4px solid #666;margin-top:60px" />
                            <p>He desarrollado la aplicación móvil para terminales iOS.</p>

                        </div>
                    </div>
                    <div class="s-link">
                        <a href="#"><img src="./images/linkedin.png" alt=""></a>
                        <a href="#"><img src="./images/correoelectronico.png" alt=""></a>
                        <a href="#"><img src="./images/github.png" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="team-title">
                <h5>Jose Ángel Zamora</h5>
                <span>Desarrollador iOS</span>
            </div>
        </div>
        <!--Zamora-->
        <!--Pepelu-->
        <div class="col s12 m6 l4 offset-l2">
            <div class="team-member">
                <div class="team-img">
                    <img src="./images/android.png" class="responsive-img" alt="team member"
                        style="display:block;margin:auto;">
                </div>
                <div class="team-hover">
                    <div class="desk">
                        <div class="card-panel teal lighten-2" style="display:block;margin:auto;">

                            <div class="content">
                                <img src='./images/pepelu.PNG' class="responsive-img"
                                    style="border-radius:140px;border:4px solid #666;margin-top:60px" />
                                <p>He desarrollado la aplicación para terminales Android.</p>
                            </div>
                        </div>


                    </div>
                    <div class="s-link">
                        <a href="#"><img src="./images/linkedin.png" alt=""></a>
                        <a href="#"><img src="./images/correoelectronico.png" alt=""></a>
                        <a href="#"><img src="./images/github.png" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="team-title">
                <h5>Jose Luis Berrio</h5>
                <span>Desarrollador Android</span>
            </div>
        </div>
        <br><br><br>
        <!--Pepelu-->
        <!--Felix-->
        <div class="col s12 m6 l4">
            <div class="team-member">
                <div class="team-img">
                    <img src="./images/backend.png" class="responsive-img" alt="team member">
                </div>
                <div class="team-hover">
                    <div class="desk">
                        <div class="card-panel teal lighten-2">
                            <img src='./images/perfiltest2.png' class="responsive-img"
                                style="border-radius:140px;border:4px solid #666;margin-top:70px" />
                            <p>He desarrollado el backend utilizando el framework Laravel</p>
                        </div>
                    </div>
                    <div class="s-link">
                        <a href="#"><img src="./images/linkedin.png" alt=""></a>
                        <a href="#"><img src="./images/correoelectronico.png" alt=""></a>
                        <a href="#"><img src="./images/github.png" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="team-title">
                <h5>Felix Corujo</h5>
                <span>Desarrollador Backend</span>
            </div>
        </div>
        <!--Felix-->
        <div class="col s12 m6 l4">
            <div class="team-member">
                <div class="team-img">
                    <img src="./images/front.png" class="responsive-img" alt="team member">
                </div>
                <div class="team-hover">
                    <div class="desk">
                        <div class="card-panel teal lighten-2">
                            <img src='./images/dani.png' class="responsive-img"
                                style="border-radius:140px;border:4px solid #666;margin-top:70px" />
                            <p>He diseñado las interfaces desarrollado el frontend de la app </p>
                        </div>
                    </div>
                    <div class="s-link">
                        <a href="#"><img src="./images/linkedin.png" alt=""></a>
                        <a href="#"><img src="./images/correoelectronico.png" alt=""></a>
                        <a href="#"><img src="./images/github.png" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="team-title">
                <h5>Dani Merino</h5>
                <span>Desarrollador Frontend</span>
            </div>
        </div>
        <div class="col s12 m6 l4">
            <div class="team-member">
                <div class="team-img">
                    <img src="./images/backend.png" class="responsive-img" alt="team member">
                </div>
                <div class="team-hover">
                    <div class="desk">
                        <div class="card-panel teal lighten-2">
                            <img src='./images/perfiltest2.png' class="responsive-img"
                                style="border-radius:140px;border:4px solid #666;margin-top:70px" />
                            <p>Vicente quotes .</p>
                        </div>
                    </div>
                    <div class="s-link">
                        <a href="#"><img src="./images/linkedin.png" alt=""></a>
                        <a href="#"><img src="./images/correoelectronico.png" alt=""></a>
                        <a href="#"><img src="./images/github.png" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="team-title">
                <h5>Vicente Maroto</h5>
                <span>Desarrollador Backend</span>
            </div>
        </div>



    </div>


    <!-- Footer -->
    <footer class="page-footer">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">Info</h5>
                    <p class="grey-text text-lighten-4"> I-Queue es la aplicación multiplataforma desarrollada por el
                        equipo de la promoción 2020-2021 de Escuela Estech del Grado Superior en Desarrollo de
                        Aplicaciones multiplataforma. La idea está basada en la digitalización, monitorización y
                        adaptación de la misma para una gran cantidad de modelos de negocio de cara a la mejora e
                        implementación de sus servicios de cara al público.</p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="white-text">Descárgate la app</h5>
                    <ul>
                        <li><a class="grey-text text-lighten-3" href="#!"><img src="./images/appstore.PNG" alt=""></a>
                        </li>
                        <br>
                        <li><a class="grey-text text-lighten-3" href="#!"><img src="./images/androidstore.PNG"
                                    alt=""></a></li>
                        <li>
                            <h5>Redes sociales</h5>
                            <a class="grey-text text-lighten-3" href="#!"><img src="./images/facebook.png" alt=""></a>
                            <a class="grey-text text-lighten-3" href="#!"><img src="./images/correoelectronico.png"
                                    alt=""></a>
                            <a class="grey-text text-lighten-3" href="#!"><img src="./images/gorjeo.png" alt=""></a>
                            <a class="grey-text text-lighten-3" href="#!"><img src="./images/instagram.png" alt=""></a>
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
    <!--fin footer-->

    <!--fin contenedor-->
</body>

<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="./css/materialize.css">

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</body>

</html>
