<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--iconos material icon-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        #map {
            width: 100%;
            height: 400px;
            box-shadow: 5px 5px 5px #888;
        }

    </style>
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

    <script src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css" />
    <title>User view 1</title>
</head>

<body class="container">

    <!--menu-->
    <!--nav extendido-->
    <nav class="nav-extended">
        <div class="nav-wrapper" style="margin-left: 8px;">
            <a href="{{ url('/home') }}" class="brand-logo"><span class=".center-align">I-Queue -ADMINPANEL</span></a>
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
                <li><a href="#negocioDatos">Datos</a></li>
                <li><a href="#cola">Cola</a></li>
                <li><a href="#promo">Promociones</a></li>
            </ul>
        </div>
    </nav>
    <main>
        <!--fin menu-->
        <h2 class="center-align">Mapa I-Queue</h2>

        <p>Click the button to create a P element with some text, and append it to DIV.</p>

        <div id="myDIV">
            A DIV element
        </div>

        <button onclick="myFunction()">Añadir</button>
        <button onclick="myFunction2()">Borrar</button>

        <p><strong>Example explained:</strong><br>First create a P node,<br> then create a Text node,<br> then append
            the Text node to the P node.<br>Finally, get the DIV element with id="myDIV", and append the P node to DIV.
        </p>


        <section class="container">

            <div id='mydiv'>TEXTO QUE VA A CAMBIAR</div>
            <br />
            <input type='button' onclick='change()' value='cambiar valor'>
            <div id="map">

            </div>
        </section>
        <!--fin login-->
        <br>
    </main>

    <footer class="page-footer">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="center-align">Info</h5>
                    <p class="grey-text text-lighten-4"> I-Queue es la aplicación multiplataforma desarrollada por
                        el equipo de la promoción 2020-2021 de Escuela Estech del Grado Superior en Desarrollo de
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


<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="./css/materialize.css">

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    var map = L.map('map').
    setView([41.66, -4.72],
        15);

    L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {

        maxZoom: 18
    }).addTo(map);

    L.control.scale().addTo(map);
    L.marker([41.66, -4.71], {
        draggable: true
    }).addTo(map);
    L.marker([41.70, -4.71], {
        draggable: true
    }).addTo(map);

</script>
    <script>
        function myFunction() {
            var div = document.createElement("DIV");
            var para = document.createElement("P");
            var t = document.createTextNode("This is a paragraph.");
            para.appendChild(t);
            div.appendChild(para);
            document.getElementById("myDIV").appendChild(div);
        }

        function myFunction2() {

            var myobj = document.getElementById("myDIV").t;
            myobj.replaceChild(sp1, sp2);
        }

    </script>

</html>
