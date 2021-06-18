<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="{{ asset('css/materialize.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!--iconos material icon-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('/images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('/images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('/images/favicon/favicon-16x16.png') }}">
    <title>i-queue ApiDocs</title>
</head>
<style>
    body {
        display: flex;
        min-height: 100vh;
        flex-direction: column;
        min-width: 330px;
    }

    main {
        flex: 1 0 auto;
    }

    header,
    main,
    footer {
        padding-left: 300px;
    }

    @media only screen and (max-width: 992px) {

        header,
        main,
        footer {
            padding-left: 0;
        }
    }



    pre {
        border: 2px dashed #a7ffeb;
        margin: 20px;
        padding: 10px;
        font-family: helvetica;
        background-color: #e4e4e478;
        color: #00796b;
    }

    .pricing-table {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        width: min(1600px, 100%);
        margin: auto;
    }

    .pricing-card {
        flex: 1;
        max-width: 360px;
        background-color: #fff;
        margin: 20px 10px;
        text-align: center;
        cursor: pointer;
        overflow: hidden;
        color: #2d2d2d;
        transition: .3s linear;
    }

    .pricing-card-header {
        background-color: #80cbc4;
        display: inline-block;
        color: #fff;
        padding: 12px 30px;
        border-radius: 0 0 20px 20px;
        font-size: 16px;
        text-transform: uppercase;
        font-weight: 600;
        transition: .4s linear;
    }

    .pricing-card:hover .pricing-card-header {
        box-shadow: 0 0 0 26em #80cbc4;
    }

    .price {
        font-size: 70px;
        color: #1de9b6;
        margin: 40px 0;
        transition: .2s linear;
    }

    .price sup,
    .price span {
        font-size: 22px;
        font-weight: 700;
    }

    .pricing-card:hover,
    .pricing-card:hover .price {
        color: #fff;
    }

    .pricing-card li {
        font-size: 16px;
        padding: 10px 0;
        text-transform: uppercase;
    }

    .order-btn {
        display: inline-block;
        margin-bottom: 40px;
        margin-top: 80px;
        border: 2px solid #1de9b6;
        color: #1de9b6;
        padding: 18px 40px;
        border-radius: 8px;
        text-transform: uppercase;
        font-weight: 500;
        transition: .3s linear;
    }

    .order-btn:hover {
        background-color: #1de9b6;
        color: #fff;
    }

    @media screen and (max-width:1100px) {
        .pricing-card {
            flex: 50%;
        }
    }

</style>

<body>


    <!-- NAVBAR -->
    <header>
        <nav>
            <div class="nav-wrapper">
                <div class="row">
                    <div class="col s12">
                        <ul id="nav-mobile" class="left ">
                            <li><a href="{{ url('/') }}"> <i class="material-icons">chevron_left</i></a></li>

                        </ul>
                        <a href="#" data-target="sidenav-1" class="left sidenav-trigger hide-on-medium-and-up"><i
                                class="material-icons">menu</i></a>
                        <a href="#" data-target="sidenav-2" class="right sidenav-trigger show-on-medium-and-up"><i
                                class="material-icons">menu</i></a>
                        <a href="" target="_blank" class="brand-logo">i-Queue Api Docs</a>

                    </div>
                </div>
            </div>
        </nav>
    </header>




    <!-- LEFT SIDEBAR	 -->
    <ul id="sidenav-1" class="sidenav sidenav-fixed">
        <div class="center-align">
            <img src="{{ asset('images/propuestalogo.png') }}" height="90px" style="margin:10px" alt="">
        </div>
        <li><a class="subheader">¡Bienvenido Desarrollador!🖥️🥤</a></li>

        <li><a class="waves-effect waves-teal btn-flat" onclick="routeHide();$('#home-api').show('slow');"><i
                    class="material-icons">lens</i>Inicio</a></li>
        <li><a class="waves-effect waves-teal btn-flat" onclick="routeHide();$('#auth-section ').show('slow');"><i
                    class="material-icons">lock</i>Autenticación</a>
        </li>
        <div class="divider"></div>
        <li><a class="subheader">¡Rutas!</a></li>

        <!-- menu collapsible	 -->
        <li>
            <ul class="collapsible">
                <li>
                    <div class="collapsible-header"><i class="material-icons">business</i>api/commerces </div>
                    <div class="collapsible-body">
                        <a onclick="routeHide();$('#commerce-get').show('slow');"
                            class="waves-effect waves-teal btn-flat" style="width: 100%">Listar Comercios <strong
                                style="color:#26a69a ">Get</strong></a>

                        <a onclick="routeHide();$('#commerce-post').show('slow');"
                            class="waves-effect waves-teal btn-flat" style="width: 100%">Crear Comercios <strong
                                style="color:#a69926 ">POST</strong></a>
                        <a onclick="routeHide();$('#commerce-delete').show('slow');"
                            class="waves-effect waves-teal btn-flat" style="width: 100%">Eliminar Comercios <strong
                                style="color:#a63126 ">DELETE</strong></a>
                        <a onclick="routeHide();$('#commerce-update').show('slow');"
                            class="waves-effect waves-teal btn-flat" style="width: 100%">Actualizar Comercios <strong
                                style="color:#2657a6 ">PUT</strong></a>

                    </div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="material-icons">schedule</i>api/current-queues</div>
                    <div class="collapsible-body">
                        <a onclick="routeHide();$('#queue-get').show('slow');" class="waves-effect waves-teal btn-flat"
                            style="width: 100%">Listar Colas <strong style="color:#26a69a ">Get</strong></a>
                        <a onclick="routeHide();$('#queue-update').show('slow');"
                            class="waves-effect waves-teal btn-flat" style="width: 100%">Actualizar Colas <strong
                                style="color:#2657a6 ">PUT</strong></a>
                    </div>
                </li>
                <li>

                    <div class="collapsible-header"><i class="material-icons">people</i>api/users</div>
                    <div class="collapsible-body">
                        <a onclick="routeHide();$('#user-login').show('slow');" class="waves-effect waves-teal btn-flat"
                            style="width: 100%">Autenticar usuario <strong style="color:#a69926 ">POST</strong></a>
                        <a onclick="routeHide();$('#user-register').show('slow');"
                            class="waves-effect waves-teal btn-flat" style="width: 100%">Registrar usuario <strong
                                style="color:#a69926 ">POST</strong></a>
                        <a onclick="routeHide();$('#user-delete').show('slow');"
                            class="waves-effect waves-teal btn-flat" style="width: 100%">Eliminar Usuarios <strong
                                style="color:#a63126 ">DELETE</strong></a>

                        <a onclick="routeHide();$('#user-update').show('slow');"
                            class="waves-effect waves-teal btn-flat" style="width: 100%">Actualizar Usuarios <strong
                                style="color:#2657a6 ">PUT</strong></a>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="material-icons">verified_user</i>api/queue-verified-users
                    </div>
                    <div class="collapsible-body">
                        <a onclick="routeHide();$('#verified-user-post').show('slow');"
                            class="waves-effect waves-teal btn-flat" style="width: 100%">Añadir usuario a la cola
                            <strong style="color:#a69926 ">POST</strong></a>
                        <a onclick="routeHide();$('#verified-user-mail-post').show('slow');"
                            class="waves-effect waves-teal btn-flat" style="width: 100%">usuario a la cola (email)
                            <strong style="color:#a69926 ">POST</strong></a>
                        <a onclick="routeHide();$('#verified-user-entry-check-post').show('slow');"
                            class="waves-effect waves-teal btn-flat" style="width: 100%">usuario entra al local
                            <strong style="color:#a69926 ">POST</strong></a>

                        <a onclick="routeHide();$('#verified-user-delete').show('slow');"
                            class="waves-effect waves-teal btn-flat" style="width: 100%">Eliminar usuario de la cola
                            <strong style="color:#a63126 ">DELETE</strong></a>
                    </div>
                </li>
            </ul>
        </li>



    </ul>


    <!-- RIGHT SIDEBAR	 -->
    <ul id="sidenav-2" class="sidenav">
        <li><a class="subheader">Subheader</a></li>
        <li><a href="https://github.com/dogfalo/materialize/" target="_blank">Github</a></li>
        <li><a href="https://twitter.com/MaterializeCSS" target="_blank">Twitter</a></li>
        <li><a href="http://next.materializecss.com/getting-started.html" target="_blank">Docs</a></li>
    </ul>


    <main>
        <h1 class="center">
            i-Queue Api Docs</h1>


        <!-- home-->
        <div class="row route-hide " id="home-api">
            <!-- centre	 -->
            <div class="col s12 center-align">
                <h4>Inicio</h4>
                <h5><strong style="color:#26a69a ">Nuestra mision</strong></h5>
                <blockquote>Creemos que hay una cantidad asombrosa de valor sin explotar que podría liberarse con API
                    bien construidas, conectadas fácilmente a plataformas de terceros, todas respaldadas por datos.
                    <br>
                    Con nuestra api podras desarrollar sistemas de gestion de colas para tus establecimientos
                </blockquote>
            </div>
            <!-- izquierda	 -->
            <div class="col s12  center-align contan">
                <p></p>
                <ul class="collection">
                    <li class="collection-item"><strong>Tienes </strong>a tu dispoción un extenso catalogo de funciones!
                    </li>
                    <li class="collection-item"><strong>Puedes</strong> Desarrollar tus propias apps basadas en i-queue
                    </li>

                </ul>
            </div>
            <div class="col s12">
                <div class="pricing-table">
                    <div class="pricing-card">
                        <h3 class="pricing-card-header">Personal</h3>
                        <div class="price"><sup>€</sup>0</div>
                        <ul>

                            <li><strong>TODAS</strong> las peticiones gratis</li>
                            <li><strong>SIN LIMITE</strong> de peticiones</li>
                            <li><strong>1</strong> solo comercio</li>
                            <li>----------------------------------------</li>

                        </ul>
                        <a href="{{ url('/registro') }}" class="order-btn">Unete yá como comercio!</a>
                    </div>

                    <div class="pricing-card">
                        <h3 class="pricing-card-header">Professional</h3>
                        <div class="price"><sup>€</sup>30<span>/MES</span></div>
                        <ul>
                            <li><strong>TODAS</strong> las peticiones gratis</li>
                            <li><strong>SIN LIMITE</strong> de peticiones</li>
                            <li><strong>1</strong> Tablet "HUAWEI MatePad T 10s"</li>
                            <li><strong>Asistencia Tecnica</strong> dias laborales</li>
                        </ul>
                        <a href="mailto: iqueuemaster@gmail.com" class="order-btn">Contacta con nosotros</a>
                    </div>

                    <div class="pricing-card">
                        <h3 class="pricing-card-header">Premium</h3>
                        <div class="price"><sup>€</sup>50<span>/MES</span></div>
                        <ul>
                            <li><strong>TODAS</strong> las peticiones gratis</li>
                            <li><strong>SIN LIMITE</strong> de peticiones</li>
                            <li><strong>5</strong> Tablet "HUAWEI MatePad T 10s"</li>
                            <li><strong>Asistencia Tecnica</strong> dias laborales</li>
                        </ul>
                        <a href="mailto: iqueuemaster@gmail.com" class="order-btn">Contacta con nosotros</a>
                    </div>

                    <div class="pricing-card">
                        <h3 class="pricing-card-header">Ultimate</h3>
                        <div class="price"><sup>€</sup>400<span>/MES</span></div>
                        <ul>
                            <li><strong>HOSTEA</strong> tu propio nodo de i-queue</li>
                            <li><strong>TABLETS A MEDIDA</strong> Tablet "HUAWEI MatePad"</li>
                            <li><strong>Nuevas</strong> Funciones para tu negocio</li>
                            <li><strong>Asistencia Tecnica</strong> 12h/ 7 dias a la semana</li>
                        </ul>
                        <a href="mailto: iqueuemaster@gmail.com" class="order-btn">Contacta con nosotros</a>
                    </div>
                </div>
                <div class="divider"></div>
            </div>
            <div class="col s12">
                <h5 class="center-align">Metodos de pago Aceptados</h5>
                <br>
                <div class="row center-align">
                    <div class="col s3 offset-m2 m2">
                        <img style="height:80px" src="{{ asset('images/Bitcoin-Logo.png') }}" alt="">
                        <h6 style="color:#26a69a ">Bitcoin</h6>


                    </div>
                    <div class="col s3 m2 ">
                        <img style="height:80px" src="{{ asset('images/Ethereum-Logo.png') }}" alt="">
                        <h6 style="color:#26a69a ">Ethereum</h6>

                    </div>
                    <div class="col s3 m2">
                        <img style="height:80px" src="{{ asset('images/Doge-Logo.png') }}" alt="">
                        <h6 style="color:#26a69a ">DogeCoin</h6>

                    </div>
                    <div class="col s3 m2">
                        <img style="height:80px" src="{{ asset('images/Paypal-Logo.png') }}" alt="">
                        <h6 style="color:#26a69a ">Paypal</h6>

                    </div>


                </div>

            </div>

        </div>
        <!-- auth-section-->
        <div class="row route-hide" id="auth-section" style="display: none">
            <!-- centre	 -->
            <div class="col s12 center-align">
                <h4>Auth</h4>
                <h5><strong style="color:#26a69a ">[HEADER] 'Authorization: </strong><strong style="color:#26a69a ">
                        Bearer</strong><span style="color: #1de9b6"> $TU_TOKEN</span><strong
                        style="color:#26a69a ">'</strong> </h5>

            </div>
            <!-- izquierda	 -->
            <div class="col s12 m6 center-align">
                <h5>¿Como funciona?</h5>
                <ul class="collection">
                    <li class="collection-item"><strong>Al hacer Login </strong> Obtienes un token personal e
                        intrasferible con el cual puedes realizar peticiones a la API</li>
                    <li class="collection-item"><strong>Muy importante</strong> Tu token es TUYO y te identifica dentro
                        de la API, nunca des tu token a nadie!</li>
                    <li class="collection-item"><strong>Con el token</strong> Puedes realizar cualquier tipo de peticion
                        a la API, siempre y cuando seas el dueño del elemento del cual intentas realizar un cambio.</li>
                    <li class="collection-item"><strong>¿El token Caduca?</strong> ¡El token dura un año y es
                        sobreescrito cada vez que inicies sesion!</li>
                </ul>
                <br>
                <div class="container">
                    <blockquote>
                        <strong style="color:#26a69a ">
                            <h5>TOKEN</h5>
                        </strong>
                        <hr>
                        <strong>Tu token se parecerá a este:</strong>
                        <br>
                        <h6><span style="color: #1de9b6">233|TkxEFnfj2IyePpcrQnHCZFl4t9XCsYvVctbE2LlR</span></h6>
                    </blockquote>
                </div>
            </div>
            <!-- derecha	 -->
            <div class="col s12 m6">
                <h5 class="center-align">Sanctum</h5>
                <p class="container flow-text">El sistema de API de la aplicación utiliza Sanctum para realizar la
                    verificación al
                    momento de
                    realizar peticiones.
                    <br>
                    Laravel Sanctum proporciona un sistema de autenticación ligero para SPA (aplicaciones de una sola
                    página), aplicaciones móviles y API simples basadas en tokens. Sanctum permite que cada usuario de
                    su aplicación genere múltiples tokens API para su cuenta. A estos tokens se les pueden otorgar
                    habilidades / alcances que especifican qué acciones pueden realizar los tokens.
                    <br>
                    Sanctum es un paquete simple que puede usar para emitir tokens API a sus usuarios sin la
                    complicación de OAuth. Esta función está inspirada en GitHub y otras aplicaciones que emiten "tokens
                    de acceso personal". Por ejemplo, imagine que la "configuración de la cuenta" de su aplicación tiene
                    una pantalla donde un usuario puede generar un token API para su cuenta. Puede usar Sanctum para
                    generar y administrar esos tokens. Estos tokens suelen tener un tiempo de caducidad muy largo
                    (años), pero el usuario puede revocarlos manualmente en cualquier momento.
                </p>
                <br>
                <div class="center-align"><img style="height:80px; border-radius: 10%;"
                        src="{{ asset('images/Sanctum-Logo.png') }}" alt=""></div>

            </div>
        </div>
        <!-- get-->
        <div class="row route-hide" id="commerce-get" style="display: none">
            <!-- centre	 -->
            <div class="col s12 center-align">
                <h4>api/commerces/{id?}</h4>
                <h5><strong style="color:#26a69a ">Get</strong></h5>

            </div>
            <!-- izquierda	 -->
            <div class="col s12 m6 center-align">
                <h5>Parametros de Peticion</h5>
                <ul class="collection">
                    <li class="collection-item"><strong>/{id?} </strong>| Obtienes un unico objeto "commerce" y su
                        objeto cola "queue" </li>
                    <li class="collection-item"><strong>/</strong> | Obtienes un array de objetos "commerce"</li>

                </ul>
            </div>
            <!-- derecha	 -->
            <div class="col s12 m6">
                <h5 class="center-align">Json Example</h5>
                <pre>{
                    "code": 200,
                    "message": "OK",
                    "data": {
                        "id": 1,
                        "name": "Pizzeria Mezza Luna",
                        "latitude": 23.2843745,
                        "longitude": 31.3947575,
                        "info": null,
                        "address": "c/linares",
                        "image": "img/url.png",
                        "queueInfo": {
                            "id": 1,
                            "fixed_capacity": 19,
                            "current_capacity": 0,
                            "average_time": 6,
                            "password_verification": "12345",
                            "created_at": "2021-06-14T12:56:38.000000Z",
                            "updated_at": "2021-06-17T12:26:36.000000Z",
                            "commerce_id": 1
                        }
                    }
                }</pre>
            </div>
        </div>

        <!-- delete	 -->
        <div class="row route-hide" id="commerce-delete" style="display: none">
            <!-- centre	 -->
            <div class="col s12 center-align">
                <h4>api/commerces/{id}</h4>
                <h5><strong style="color:#a63126 ">DELETE</strong></h5>
            </div>
            <!-- izquierda	 -->
            <div class="col s12 m6 center-align">
                <h5>Parametros de Peticion</h5>
                <ul class="collection">
                    <li class="collection-item"><strong>/{id} </strong>| Se le pasa el id del negocio a borrar por
                        parametro</li>


                </ul>
            </div>
            <!-- derecha	 -->
            <div class="col s12 m6">
                <h5 class="center-align">Json Example</h5>
                <pre>{
                    {
                        "code": 204,
                        "message": "No Content"
                    }
                }</pre>
            </div>
        </div>
        <!-- post	 -->
        <div class="row route-hide" id="commerce-post" style="display: none">
            <!-- centre	 -->
            <div class="col s12 center-align">
                <h4>api/commerce</h4>
                <h5><strong style="color:#a69926 ">POST</strong></h5>
            </div>
            <!-- izquierda	 -->
            <div class="col s12 m6 center-align">
                <h5>Parametros de Peticion</h5>
                <ul class="collection">
                    <li class="collection-item"><strong>name </strong>| nombre del comercio (string)</li>
                    <li class="collection-item"><strong>latitude </strong>| latitud del comercio (float)</li>
                    <li class="collection-item"><strong>longitude </strong>| longitud del comercio (float)</li>
                    <li class="collection-item"><strong>image </strong>| imagen del comercio (file)</li>
                    <li class="collection-item"><strong>info </strong>| descripcion informativa del comercio (file)</li>
                </ul>
            </div>
            <!-- derecha	 -->
            <div class="col s12 m6">
                <h5 class="center-align">Json Example</h5>
                <pre>{
                    "code": 200,
                    "message": "OK",
                    "data": {
                        "id": 1,
                        "name": "Pizzeria Mezza Luna",
                        "latitude": 23.2843745,
                        "longitude": 31.3947575,
                        "info": null,
                        "address": "c/linares",
                        "image": "img/url.png",
                        "queueInfo": {
                            "id": 1,
                            "fixed_capacity": 19,
                            "current_capacity": 0,
                            "average_time": 6,
                            "password_verification": "12345",
                            "created_at": "2021-06-14T12:56:38.000000Z",
                            "updated_at": "2021-06-17T12:26:36.000000Z",
                            "commerce_id": 1
                        }
                    }
                }</pre>
            </div>
        </div>
        <!-- update	 -->
        <div class="row route-hide" id="commerce-update" style="display: none">
            <!-- centre	 -->
            <div class="col s12 center-align">
                <h4>api/commerces/{id}</h4>
                <h5><strong style="color:#2657a6 ">PUT</strong></h5>
            </div>
            <!-- izquierda	 -->
            <div class="col s12 m6 center-align">
                <h5>Parametros de Peticion</h5>
                <ul class="collection">
                    <li class="collection-item">|opcional <strong>name </strong>| nombre del comercio (string)</li>
                    <li class="collection-item">|opcional <strong>latitude </strong>| latitud del comercio (float)</li>
                    <li class="collection-item">|opcional <strong>longitude </strong>| longitud del comercio (float)
                    </li>
                    <li class="collection-item">|opcional <strong>image </strong>| imagen del comercio (file)</li>
                    <li class="collection-item">|opcional <strong>info </strong>| descripcion informativa del comercio
                        (file)</li>
                </ul>
            </div>
            <!-- derecha	 -->
            <div class="col s12 m6">
                <h5 class="center-align">Json Example</h5>
                <pre>{
                    "code": 200,
                    "message": "OK",
                    "data": {
                        "id": 2,
                        "name": "Gerlach PLC",
                        "latitude": 3.244,
                        "longitude": 31.3947575,
                        "info": null,
                        "address": "77625 Farrell Mill\nArmstrongside, SD 84702",
                        "image": "picture.png",
                        "queueInfo": {
                            "id": 2,
                            "fixed_capacity": 32,
                            "current_capacity": 1,
                            "average_time": 8,
                            "password_verification": "12345",
                            "created_at": "2021-06-14T12:56:38.000000Z",
                            "updated_at": "2021-06-15T17:01:55.000000Z",
                            "commerce_id": 2
                        }
                    }
                }</pre>
            </div>
        </div>
        <!-- post	 -->
        <div class="row route-hide" id="commerce-post" style="display: none">
            <!-- centre	 -->
            <div class="col s12 center-align">
                <h4>api/commerce</h4>
                <h5><strong style="color:#a69926 ">POST</strong></h5>
            </div>
            <!-- izquierda	 -->
            <div class="col s12 m6 center-align">
                <h5>Parametros de Peticion</h5>
                <ul class="collection">
                    <li class="collection-item"><strong>name </strong>| nombre del comercio (string)</li>
                    <li class="collection-item"><strong>latitude </strong>| latitud del comercio (float)</li>
                    <li class="collection-item"><strong>longitude </strong>| longitud del comercio (float)</li>
                    <li class="collection-item"><strong>image </strong>| imagen del comercio (file)</li>
                    <li class="collection-item"><strong>info </strong>| descripcion informativa del comercio (file)</li>
                </ul>
            </div>
            <!-- derecha	 -->
            <div class="col s12 m6">
                <h5 class="center-align">Json Example</h5>
                <pre>{
                            "code": 200,
                            "message": "OK",
                            "data": {
                                "id": 1,
                                "name": "Pizzeria Mezza Luna",
                                "latitude": 23.2843745,
                                "longitude": 31.3947575,
                                "info": null,
                                "address": "c/linares",
                                "image": "img/url.png",
                                "queueInfo": {
                                    "id": 1,
                                    "fixed_capacity": 19,
                                    "current_capacity": 0,
                                    "average_time": 6,
                                    "password_verification": "12345",
                                    "created_at": "2021-06-14T12:56:38.000000Z",
                                    "updated_at": "2021-06-17T12:26:36.000000Z",
                                    "commerce_id": 1
                                }
                            }
                        }</pre>
            </div>
        </div>

        <!-- update	 queues-->
        <div class="row route-hide" id="queue-update" style="display: none">
            <!-- centre	 -->
            <div class="col s12 center-align">
                <h4>api/current-queues/{id}</h4>
                <h5><strong style="color:#2657a6 ">PUT</strong></h5>
            </div>
            <!-- izquierda	 -->
            <div class="col s12 m6 center-align">
                <h5>Parametros de Peticion</h5>
                <ul class="collection">
                    <li class="collection-item">|opcional <strong>average_time </strong>| tiempo medio en minutos que el
                        cliente pasa en la tienda (int)</li>
                    <li class="collection-item">|opcional <strong>fixed_capacity </strong>| numero de personas admitidas
                    </li>
                </ul>
            </div>
            <!-- derecha	 -->
            <div class="col s12 m6">
                <h5 class="center-align">Json Example</h5>
                <pre>{
                    "code": 200,
                    "message": "OK",
                    "data": {
                        "id": 7,
                        "fixed_capacity": 3,
                        "current_capacity": 0,
                        "average_time": 5,
                        "password_verification": "L2bfWVR1yV3L9A7ZIRtO",
                        "created_at": "2021-06-15T10:00:46.000000Z",
                        "updated_at": "2021-06-15T10:20:56.000000Z",
                        "commerce_id": 7
                    }
                }
            }</pre>
            </div>
        </div>

        <!-- get queue-->
        <div class="row route-hide" id="queue-get" style="display: none">
            <!-- centre	 -->
            <div class="col s12 center-align">
                <h4>api/current-queues/{id?}</h4>
                <h5><strong style="color:#26a69a ">Get</strong></h5>
            </div>
            <!-- izquierda	 -->
            <div class="col s12 m6 center-align">
                <h5>Parametros de Peticion</h5>
                <ul class="collection">
                    <li class="collection-item"><strong>/{id?} </strong>| Obtienes un unico objeto "current-queue"</li>
                    <li class="collection-item"><strong>/</strong> | Obtienes un array de objetos "current-queue"</li>

                </ul>
            </div>
            <!-- derecha	 -->
            <div class="col s12 m6">
                <h5 class="center-align">Json Example</h5>
                <pre>{
                    "code": 200,
                    "message": "OK",
                    "data": {
                        "id": 7,
                        "fixed_capacity": 3,
                        "current_capacity": 0,
                        "average_time": 5,
                        "password_verification": "L2bfWVR1yV3L9A7ZIRtO",
                        "created_at": "2021-06-15T10:00:46.000000Z",
                        "updated_at": "2021-06-15T10:20:56.000000Z",
                        "commerce_id": 7
                    }
                }</pre>
            </div>
        </div>



        <!-- delete user-->
        <!-- delete	 -->
        <div class="row route-hide" id="user-delete" style="display: none">
            <!-- centre	 -->
            <div class="col s12 center-align">
                <h4>api/users/{id}</h4>
                <h5><strong style="color:#a63126 ">DELETE</strong></h5>
            </div>
            <!-- izquierda	 -->
            <div class="col s12 m6 center-align">
                <h5>Parametros de Peticion</h5>
                <ul class="collection">
                    <li class="collection-item"><strong>/{id} </strong>| Se le pasa el id del usuario a borrar por
                        parametro</li>
                </ul>
            </div>
            <!-- derecha	 -->
            <div class="col s12 m6">
                <h5 class="center-align">Json Example</h5>
                <pre>{
                    {
                        "code": 204,
                        "message": "No Content"
                    }
                }</pre>
            </div>
        </div>

        <!-- create	 users-->
        <div class="row route-hide" id="user-login" style="display: none">
            <!-- centre	 -->
            <div class="col s12 center-align">
                <h4>api/login</h4>
                <h5><strong style="color:#a69926 ">POST</strong></h5>
            </div>
            <!-- izquierda	 -->
            <div class="col s12 m6 center-align">
                <h5>Parametros de Peticion</h5>
                <ul class="collection ">
                    <li class="collection-item"><strong>email </strong>| email del usuario (string)</li>
                    <li class="collection-item"><strong>password </strong>| contraseña del usuario (string)</li>
                    <li class="collection-item">|opcional <strong>remember_token_firebase</strong>| necesario para las
                        notificaciones (string)</li>
                </ul>
                <br>
                <div class="container">
                    <blockquote>
                        ¡Si el token de firebase no es pasado por parametro,no recibiras notificaciones!
                        <hr>
                        "Realizando login obtienes el <strong>token</strong> para autorizarte en la api"
                    </blockquote>
                </div>

            </div>
            <!-- derecha	 -->
            <div class="col s12 m6">
                <h5 class="center-align">Json Example</h5>
                <pre>{
                    "code": 200,
                    "message": "OK",
                    "data": {
                        "id": 27,
                        "name": "pedrito",
                        "remember_token_firebase": "wea",
                        "email": "ragor71w927@bbsaili.com",
                        "email_verified_at": null,
                        "role": "ADMIN",
                        "created_at": "2021-06-17T23:38:27.000000Z",
                        "updated_at": "2021-06-17T23:39:39.000000Z",
                        "token": "233|TkxEFnfj2IyePpcrQnHCZFl4t9XCsYvVctbE2LlR"
                    }
                }</pre>
            </div>
        </div>
        <!-- create	 users-->
        <div class="row route-hide" id="user-register" style="display: none">
            <!-- centre	 -->
            <div class="col s12 center-align">
                <h4>api/register</h4>
                <h5><strong style="color:#a69926 ">POST</strong></h5>
            </div>
            <!-- izquierda	 -->
            <div class="col s12 m6 center-align">
                <h5>Parametros de Peticion</h5>
                <ul class="collection ">
                    <li class="collection-item"><strong>email </strong>| email del usuario (string)</li>
                    <li class="collection-item"><strong>name </strong>| nombre del usuario (string)</li>
                    <li class="collection-item"><strong>password </strong>| contraseña del usuario (string)</li>
                    <li class="collection-item">|opcional<strong>role </strong>| rol del usuario
                        ENUM['ADMIN','USER'](string)</li>

                </ul>
                <br>
                <div class="container">
                    <blockquote>
                        ¡El rol es muy importante para diferenciar usuarios normales a empresas!
                        <hr>
                        "Este parametro es usuario ("USER") por defecto y por lo tanto es opcional"
                    </blockquote>
                </div>

            </div>
            <!-- derecha	 -->
            <div class="col s12 m6">
                <h5 class="center-align">Json Example</h5>
                <pre>{
                            "code": 200,
                            "message": "OK",
                            "data": {
                                "id": 27,
                                "name": "pedrito",
                                "remember_token_firebase": "wea",
                                "email": "ragor71w927@bbsaili.com",
                                "email_verified_at": null,
                                "role": "ADMIN",
                                "created_at": "2021-06-17T23:38:27.000000Z",
                                "updated_at": "2021-06-17T23:39:39.000000Z",
                                "token": "233|TkxEFnfj2IyePpcrQnHCZFl4t9XCsYvVctbE2LlR"
                            }
                        }</pre>
            </div>
        </div>

        <!-- update	 users-->
        <div class="row route-hide" id="user-update" style="display: none">
            <!-- centre	 -->
            <div class="col s12 center-align">
                <h4>api/users/{id}</h4>
                <h5><strong style="color:#2657a6 ">PUT</strong></h5>
            </div>
            <!-- izquierda	 -->
            <div class="col s12 m6 center-align">
                <h5>Parametros de Peticion</h5>
                <ul class="collection ">
                    <li class="collection-item">|opcional <strong>name </strong>| nombre del usuario (string)</li>
                    <li class="collection-item">|opcional <strong>email </strong>| email del usuario (string)</li>
                    <li class="collection-item">|opcional <strong>password </strong>| contraseña del usuario (string)
                    </li>
                </ul>
                <br>
                <div class="container">
                    <blockquote>
                        ¡No es posible cambiar el rol de un usuario creado con anterioridad , deberás borrar el usuario!
                        <hr>
                        ¡Unicamente es posible actualizar el usuario que pertenezca a tu token!
                    </blockquote>
                </div>

            </div>
            <!-- derecha	 -->
            <div class="col s12 m6">
                <h5 class="center-align">Json Example</h5>
                <pre>{
                    "code": 200,
                    "message": "OK",
                    "data": {
                        "id": 27,
                        "name": "pedrito",
                        "remember_token_firebase": "",
                        "email": "ragor71w927@bbsaili.com",
                        "email_verified_at": null,
                        "role": "ADMIN",
                        "created_at": "2021-06-17T23:38:27.000000Z",
                        "updated_at": "2021-06-17T23:39:39.000000Z"
                    }
                }</pre>
            </div>
        </div>


        <!-- queue verified user post	 -->
        <div class="row route-hide" id="verified-user-post" style="display: none">
            <!-- centre	 -->
            <div class="col s12 center-align">
                <h4>api/queue-verified-users</h4>
                <h5><strong style="color:#a69926 ">POST</strong></h5>
            </div>
            <!-- izquierda	 -->
            <div class="col s12 m6 center-align">
                <h5>Parametros de Peticion</h5>
                <ul class="collection">
                    <li class="collection-item"><strong>queue_id </strong>| id de la cola (int)</li>
                    <li class="collection-item"><strong>password_verification </strong>| contraseña de la cola (string)
                    </li>

                </ul>
                <br>
                <div class="container">
                    <blockquote>
                        ¡Para entrar en una cola es necesario que se provea de la contraseña de la misma!
                        <hr>
                        De esta manera se evitan usuarios que no hayan estado fisicamente en el comercio.
                    </blockquote>
                </div>
            </div>
            <!-- derecha	 -->
            <div class="col s12 m6">
                <h5 class="center-align">Json Example</h5>
                <pre>{
                    "code": 201,
                    "message": "Resource Created",
                    "data": {
                        "id": 95,
                        "name": "Gerlach PLC",
                        "position": 1,
                        "estimated_time": "2021-06-18 01:59:02",
                        "created_at": "2021-06-17T23:59:02.000000Z",
                        "updated_at": "2021-06-17T23:59:02.000000Z",
                        "queue_id": 2,
                        "user_id": 27,
                        "image": "bussines_image.png"
                    }
                }</pre>
            </div>
        </div>

        <!-- delete verified user user-->
        <!-- delete	 -->
        <div class="row route-hide" id="verified-user-delete" style="display: none">
            <!-- centre	 -->
            <div class="col s12 center-align">
                <h4>api/queue-verified-users</h4>
                <h5><strong style="color:#a63126 ">DELETE</strong></h5>
            </div>
            <!-- izquierda	 -->
            <div class="col s12 m6 center-align">
                <h5>Parametros de Peticion</h5>
                <ul class="collection">
                    <li class="collection-item"><strong>/{id} </strong>| Se le pasa el id de la cola de la cual se ba a
                        borrar al usuario por
                        parametro</li>
                </ul>
            </div>
            <!-- derecha	 -->
            <div class="col s12 m6">
                <h5 class="center-align">Json Example</h5>
                <pre>{
                    {
                        "code": 200,
                        "message": "OK"
                    }
                }</pre>
            </div>
        </div>
        <!-- queue verified user post email	 -->
        <div class="row route-hide" id="verified-user-mail-post" style="display: none">
            <!-- centre	 -->
            <div class="col s12 center-align">
                <h4>/api/queue-entry-mail</h4>
                <h5><strong style="color:#a69926 ">POST</strong></h5>
            </div>
            <!-- izquierda	 -->
            <div class="col s12 m6 center-align">
                <h5>Parametros de Peticion</h5>
                <ul class="collection">
                    <li class="collection-item"><strong>queue_id </strong>| id de la cola (int)</li>
                    <li class="collection-item"><strong>email </strong>| email del usuario (string)
                    </li>

                </ul>
                <br>
                <div class="container">
                    <blockquote>
                        De esta manera se pueden añadir usuarios a la cola utilizando su email.
                        <hr>
                        Usuarios nuevos tendran una cuenta creada automaticamente con una contraseña aleatoria.
                        <hr>
                        Usuarios existentes seran añadidos a la cola.
                    </blockquote>
                </div>
            </div>
            <!-- derecha	 -->
            <div class="col s12 m6">
                <h5 class="center-align">Json Example</h5>
                <pre>{
                        "code": 201,
                        "message": "Resource Created",
                        "data": {
                            "id": 95,
                            "name": "Gerlach PLC",
                            "position": 1,
                            "estimated_time": "2021-06-18 01:59:02",
                            "created_at": "2021-06-17T23:59:02.000000Z",
                            "updated_at": "2021-06-17T23:59:02.000000Z",
                            "queue_id": 2,
                            "user_id": 27,
                            "image": "bussines_image.png"
                        }
                    }</pre>
            </div>
        </div>

        <!-- queue verified userentry check	 -->
        <div class="row route-hide" id="verified-user-entry-check-post" style="display: none">
            <!-- centre	 -->
            <div class="col s12 center-align">
                <h4>/api/queue-entry-mail</h4>
                <h5><strong style="color:#a69926 ">POST</strong></h5>
            </div>
            <!-- izquierda	 -->
            <div class="col s12 m6 center-align">
                <h5>Parametros de Peticion</h5>
                <ul class="collection">
                    <li class="collection-item"><strong>queue_id </strong>| id de la cola (int)</li>

                </ul>
                <br>
                <div class="container">
                    <blockquote>
                        Cuando el usuario vuelve a escanear el codigo qr y este esta en primera posicion, es posible
                        entrar al establecimiento
                        <hr>
                        En caso contrario se mostrará error.
                        <hr>
                        "Unicamente usuarios con posicion 1 pueden realizar esta accion con exito".
                    </blockquote>
                </div>
            </div>
            <!-- derecha	 -->
            <div class="col s12 m6">
                <h5 class="center-align">Json Example</h5>
                <pre>{
                    "code": 200,
                    "message": "OK"
                }</pre>
            </div>
        </div>


    </main>

    <script>
        function routeHide() {
            $(".route-hide").hide('slow');
        }

    </script>



    <!--fin menu-->

    @include('footerLayout')





</body>





<!-- Compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>


<script>
    //collapsible
    $(document).ready(function() {
        $('.collapsible').collapsible();
    });
    //sidenav
    $(document).ready(function() {
        $('.sidenav').sidenav();
        $('#sidenav-1').sidenav({
            edge: 'left'
        });
        $('#sidenav-2').sidenav({
            edge: 'right'
        });
    });

</script>
@include('CookieLayout')

</html>
