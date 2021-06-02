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

        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        main {
            flex: 1 0 auto;
        }

    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css" />
    <title>User view 1</title>
</head>

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
                <li><a href="#Contacto" onclick="section1()">Mapa</a></li>
                <li><a href="#colas" onclick="section2()">Colas</a></li>
                <li><a href="#colas" onclick="section3()">Historial</a></li>
            </ul>
        </div>
    </nav>
    <main>
        <h2 class="center-align" id="tituloSeccion">Mapa I-Queue</h2>

        <section class="container">

            <div id="map">

            </div>

            <div id="colas" hidden="true">
                <p>colas contenido</p>
            </div>

            <div id="historial" hidden="true">
                <p>historial contenido</p>
            </div>
        </section>
        <!--fin login-->
        <br>
    </main>
    <!--fin menu-->

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

<script>
    //secciones por funciones
    function section1() {
        var titulo = document.getElementById("tituloSeccion");
        titulo.textContent = "Mapa de negocios"
        var contenido = document.getElementById("map");
        contenido.hidden = false;
        var contenido2 = document.getElementById("colas");
        contenido2.hidden = true
        var contenido3 = document.getElementById("historial");
        contenido3.hidden = true

    }

    function section2() {
        var titulo = document.getElementById("tituloSeccion");
        titulo.textContent = "Tus colas"
        var contenido = document.getElementById("map");
        contenido.hidden = true;
        var contenido2 = document.getElementById("colas");
        contenido2.hidden = false
        var contenido3 = document.getElementById("historial");
        contenido3.hidden = true
    }

    function section3() {
        var titulo = document.getElementById("tituloSeccion");
        titulo.textContent = "historial"
        var contenido = document.getElementById("map");
        contenido.hidden = true;
        var contenido2 = document.getElementById("colas");
        contenido2.hidden = true
        var contenido3 = document.getElementById("historial");
        contenido3.hidden = false
    }

</script>


<script src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js"></script>

<script>
    //map configuracion
    var map = L.map('map').
    setView([38.089923966368815, -3.615282093540719],
        15);

    L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {

        maxZoom: 18
    }).addTo(map);

    map.doubleClickZoom.disable();

    L.control.scale().addTo(map);

    //marker con click de popup
    L.marker([38.09620852240139, -3.6383423859866477]).addTo(map)
        .bindPopup('Mercadona')
        .openPopup();

    //marker con click de popup
    L.marker([39.09620852240239, -3.6383423859866477]).addTo(map)
        .bindPopup('Alcampo')
        .openPopup().closePopup();


    //evento click del mapa
    //  map.on('click', function() {
    // alert("has hecho click en el mapa");
    // });

</script>

<!--boton para el street view-->
<script>
    L.StreetView = L.Control.extend({
        options: {
            google: true,
        },

        providers: [
            ['google', '<i class="material-icons" style="padding:2px">accessibility</i>',
                'Google Street View', false,
                'https://www.google.com/maps?layer=c&cbll={lat},{lon}'
            ],
        ],

        onAdd: function(map) {
            this._container = L.DomUtil.create('div', 'leaflet-bar');
            this._buttons = [];

            for (var i = 0; i < this.providers.length; i++)
                this._addProvider(this.providers[i]);

            map.on('moveend', function() {
                if (!this._fixed)
                    this._update(map.getCenter());
            }, this);
            this._update(map.getCenter());
            return this._container;
        },

        /*
          fixCoord: function(latlon) {
            this._update(latlon);
            this._fixed = true;
          },
          */



        _addProvider: function(provider) {
            if (!this.options[provider[0]])
                return;
            if (provider[0] == 'mapillary' && !this.options.mapillaryId)
                return;
            var button = L.DomUtil.create('a');
            button.innerHTML = provider[1];
            button.title = provider[2];
            button._bounds = provider[3];
            button._template = provider[4];
            button.href = '#';
            button.target = 'streetview';
            button.style.padding = '0 8px';
            button.style.width = 'auto';

            // Some buttons require complex logic
            if (provider[0] == 'mapillary') {
                button._needUrl = false;
                L.DomEvent.on(button, 'click', function(e) {
                    if (button._href) {
                        this._ajaxRequest(
                            button._href.replace(/{id}/, this.options.mapillaryId),
                            function(data) {
                                if (data && data.features && data.features[0].properties) {
                                    var photoKey = data.features[0].properties.key,
                                        url = 'https://www.mapillary.com/map/im/{key}'.replace(
                                            /{key}/, photoKey);
                                    window.open(url, button.target);
                                }
                            }
                        );
                    }
                    return L.DomEvent.preventDefault(e);
                }, this);
            } else if (provider[0] == 'openstreetcam') {
                button._needUrl = false;
                L.DomEvent.on(button, 'click', function(e) {
                    if (button._href) {
                        this._ajaxRequest(
                            'http://openstreetcam.org/nearby-tracks',
                            function(data) {
                                if (data && data.osv && data.osv.sequences) {
                                    var seq = data.osv.sequences[0],
                                        url = 'https://www.openstreetcam.org/details/' + seq
                                        .sequence_id + '/' + seq.sequence_index;
                                    window.open(url, button.target);
                                }
                            },
                            button._href
                        );
                    }
                    return L.DomEvent.preventDefault(e);
                }, this);
            } else
                button._needUrl = true;

            // Overriding some of the leaflet styles
            button.style.display = 'inline-block';
            button.style.border = 'none';
            button.style.borderRadius = '0 0 0 0';
            this._buttons.push(button);
        },

        _update: function(center) {
            if (!center)
                return;
            var last;
            for (var i = 0; i < this._buttons.length; i++) {
                var b = this._buttons[i],
                    show = !b._bounds || b._bounds.contains(center),
                    vis = this._container.contains(b);

                if (show && !vis) {
                    ref = last ? last.nextSibling : this._container.firstChild;
                    this._container.insertBefore(b, ref);
                } else if (!show && vis) {
                    this._container.removeChild(b);
                    return;
                }
                last = b;

                var tmpl = b._template;
                tmpl = tmpl
                    .replace(/{lon}/g, L.Util.formatNum(center.lng, 6))
                    .replace(/{lat}/g, L.Util.formatNum(center.lat, 6));
                if (b._needUrl)
                    b.href = tmpl;
                else
                    b._href = tmpl;
            }
        },

        _ajaxRequest: function(url, callback, post_data) {
            if (window.XMLHttpRequest === undefined)
                return;
            var req = new XMLHttpRequest();
            req.open(post_data ? 'POST' : "GET", url);
            if (post_data)
                req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            req.onreadystatechange = function() {
                if (req.readyState === 4 && req.status == 200) {
                    var data = (JSON.parse(req.responseText));
                    callback(data);
                }
            };
            req.send(post_data);
        }
    });

    L.streetView = function(options) {
        return new L.StreetView(options);
    }

    L.streetView().addTo(map);

</script>


<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="./css/materialize.css">

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</html>
