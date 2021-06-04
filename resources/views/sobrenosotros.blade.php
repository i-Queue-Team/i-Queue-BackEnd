<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--iconos material icon-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--css tarjetas hoover-->
    <link rel="stylesheet" href="./css/aboutUsCards.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
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
    @include('navLayout')
    <!--fin menu-->
    <!-- Our team Section -->
    <main>
        <section id="team" class="team content-section">
            <div class="">
                <div class="row text-center">
                    <div class="col s12">
                        <h2>Nuestro equipo</h2>
                        <h3 class="caption gray">Conoce a los desarrolladores!</h3>
                    </div><!-- /.col l12 -->
                    <div class="">
                        <div class="row">
                            <div class="col l4">
                                <!-- dani-->
                                <div class="team-member">
                                    <figure>
                                        <img src="{{ asset('images/dani.PNG') }}" alt="" class="img-responsive circle"
                                            style="max-height: 450px; max-width:550px">
                                        <figcaption>
                                            <p>He diseñado las interfaces desarrollado el frontend de la app </p>
                                            <ul>
                                                <li><a href=""><i class="fa fa-facebook fa-2x"></i></a></li>
                                                <li><a href=""><i class="fa fa-twitter fa-2x"></i></a></li>
                                                <li><a href=""><i class="fa fa-linkedin fa-2x"></i></a></li>
                                            </ul>
                                        </figcaption>
                                    </figure>
                                    <h4>Dani Merino</h4>
                                    <p>Desarrollador Frontend</p>
                                </div><!-- /.team-member-->
                            </div><!-- /.col l4 -->
                            <!-- dani-->
                            <div class="col l4">
                                <div class="team-member">
                                    <figure>
                                        <img src="{{ asset('images/pepelu.PNG') }}" alt=""
                                            class="img-responsive circle" style="max-height: 450px; max-width:550px">
                                        <figcaption>
                                            <p>He desarrollado la aplicación para terminales Android.</p>
                                            <ul>
                                                <li><a href=""><i class="fa fa-facebook fa-2x"></i></a></li>
                                                <li><a href=""><i class="fa fa-twitter fa-2x"></i></a></li>
                                                <li><a href=""><i class="fa fa-linkedin fa-2x"></i></a></li>
                                            </ul>
                                        </figcaption>
                                    </figure>
                                    <h4>Jose Luis Berrio</h4>
                                    <p>Desarrollador Android</p>
                                </div><!-- /.team-member-->
                            </div><!-- /.col l4 -->
                            <!-- dani-->
                            <div class="col l4">
                                <div class="team-member">
                                    <figure>
                                        <img src="{{ asset('images/zamora.PNG') }}" alt=""
                                            class="img-responsive circle" style="max-height: 450px; max-width:550px">
                                        <figcaption>
                                            <p>He desarrollado la aplicación móvil para terminales iOS.</p>
                                            <ul>
                                                <li><a href=""><i class="fa fa-facebook fa-2x"></i></a></li>
                                                <li><a href=""><i class="fa fa-twitter fa-2x"></i></a></li>
                                                <li><a href=""><i class="fa fa-linkedin fa-2x"></i></a></li>
                                            </ul>
                                        </figcaption>
                                    </figure>
                                    <h4>Jose Ángel Zamora</h4>
                                    <p>>Desarrollador iOS</p>
                                </div><!-- /.team-member-->
                            </div><!-- /.col l4 -->
                        </div><!-- /.row -->
                    </div><!-- /.container -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.our-team -->
    </main>


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
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>

</html>
