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


    @include('footerlayout')
    <!--fin footer-->

    <!--fin contenedor-->
</body>

<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="./css/materialize.css">

<!-- Compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>

</html>
