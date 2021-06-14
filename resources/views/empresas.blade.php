<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--iconos material icon-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--CHARTS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>I-Queue empresas</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{URL::asset('/images/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{URL::asset('/images/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{URL::asset('/images/favicon/favicon-16x16.png')}}">
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
    <!--contenedor-->

    <!--menu-->

    @include('navLayout')
    <main>
        <h2 class="center-align"><b>I-Queue Empresas</b></h2>


        <div class="center-align">
            <div class="row">
                <div class="col s12">
                    <h5><b>Ventajas</b></h5>
                </div>

                <div class="row">
                    <div class="col s12 m6 l6">
                        <p>
                        <h5>Para tu negocio</h5>
                        <ul class="collection"
                            style="background-color:antiquewhite; padding-left:20px; padding-right:20px">
                            <li>
                                <p class="left-align"><i class="material-icons"
                                        style="vertical-align: middle; padding:5px">alarm</i>Adapta y mejora el tiempo
                                    empleado en tu negocio</p>
                            </li>
                            <li>
                                <p class="left-align"><i class="material-icons"
                                        style="vertical-align: middle; padding:5px">euro_symbol</i>Reduce costes
                                    conociendo tu volumen de tu negocio</p>
                            </li>
                            <li>
                                <p class="left-align"><i class="material-icons"
                                        style="vertical-align: middle; padding:5px">supervisor_account</i>Conoce quién y
                                    cuándo precisa de tu servicio</p>
                            </li>
                            <li>
                                <p class="left-align"><i class="material-icons"
                                        style="vertical-align: middle; padding:5px">add_location</i>Destaca tu
                                    establecimiento en nuestro mapa de negocios</p>
                            </li>
                        </ul>
                    </div>
                    <div class="col s12 m6 l6">
                        <p>
                        <h5>Para tus clientes</h5>

                        <ul class="collection"
                            style="background-color:antiquewhite; padding-left:20px; padding-right:20px">
                            <li>
                                <p class="left-align"><i class="material-icons"
                                        style="vertical-align: middle; padding:5px">alarm</i>Evitar esperas y control de
                                    horarios actualizados</p>
                            </li>
                            <li>
                                <p class="left-align"><i class="material-icons"
                                        style="vertical-align: middle; padding:5px">euro_symbol</i>Posibilidad de
                                    obtener promociones para usuarios Iqueue</p>
                            </li>
                            <li>
                                <p class="left-align"><i class="material-icons"
                                        style="vertical-align: middle; padding:5px">supervisor_account</i>Conoce cuando
                                    te toca sin importar el orden de llegada</p>
                            </li>
                            <li>
                                <p class="left-align"><i class="material-icons"
                                        style="vertical-align: middle; padding:5px">add_location</i>Encuentra negocios y
                                    servicios a través de la app</p>
                            </li>
                        </ul>
                    </div>
                </div>

                <ul class="collapsible popout" style="background-color: antiquewhite">
                    <li>
                        <div class="collapsible-header" style="background-color: rgb(245, 190, 119)">

                            <div class="container">

                                <i class="material-icons">work</i>
                                <h5><b>Solicitar unirse a IQueue Empresas</b></h5>
                            </div>

                        </div>
                        <div class="collapsible-body"><b>Formulario de contacto</b>

                            <form method="GET" action="{{ url('/contactoempresas') }}">

                                <div class="input-field col s12 m6 ">
                                    <i class="material-icons prefix">account_circle</i>
                                    <input id="icon_prefix" type="text" class="validate">
                                    <label for="icon_prefix">Nombre completo</label>
                                </div>
                                <div class="input-field col s12 m6">
                                    <i class="material-icons prefix">email</i>
                                    <input id="icon_telephone" type="tel" class="validate">
                                    <label for="icon_telephone">Correo electrónico</label>
                                </div>

                                <div class="input-field col s12 m6">
                                    <i class="material-icons prefix">business</i>
                                    <input id="icon_prefix" type="text" class="validate">
                                    <label for="icon_prefix">Nombre de la empresa</label>
                                </div>
                                <div class="input-field col s12 m6">
                                    <i class="material-icons prefix">phone</i>
                                    <input id="icon_telephone" type="tel" class="validate">
                                    <label for="icon_telephone">Teléfono de contacto</label>
                                </div>
                                <b>Explique brevemente su actividad comercial</b>
                                <div class="input-field col s12 ">
                                    <i class="material-icons prefix">mode_edit</i>
                                    <textarea id="comentario" class="materialize-textarea"
                                        style="background-color: rgb(208, 240, 230); padding-left:10px"></textarea>
                                </div>
                                <p class="center-align">
                                    <button class="waves-effect waves-light btn" type="submit"><i
                                            class="material-icons right">send</i>Enviar solicitud</button>
                                </p>
                            </form>

                        </div>
                    </li>
                </ul>
            </div>
            <br>
    </main>
    <!--fin footer-->
    @include('footerLayout')

    <!--fin contenedor-->
</body>


<script>
    //formulario empresas init
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.collapsible');
        var instances = M.Collapsible.init(elems);
    });

</script>

<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="./css/materialize.css">

<!-- Compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

</body>
@include('CookieLayout')
</html>
