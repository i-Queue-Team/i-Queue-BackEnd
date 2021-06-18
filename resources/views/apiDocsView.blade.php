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

</style>

<body>


    <!-- NAVBAR -->
    <header>
        <nav>
            <div class="nav-wrapper">
                <div class="row">
                    <div class="col s12">
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
        <li><a class="subheader">¡Bienvenido Desarrollador!🖥️🥤</a></li>
        <li><a href="" onclick="">Autenticación</a></li>
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
