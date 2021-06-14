<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="./css/materialize.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
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
            min-width: 330px;
        }

        main {
            flex: 1 0 auto;
        }

        .collection ul {
            border-radius: 1.5em;
        }

        .collection li {
            background: antiquewhite !important;

        }

        .inline-icon {
            vertical-align: bottom;

        }

        .collection .collection-item.avatar {
            padding-left: 10px !important;
        }

    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css" />
    <title>User view</title>
</head>

<body class="container">


    <!--menu-->
    <!--nav extendido-->
    <nav class="nav-extended">
        <div class="nav-wrapper" style="margin-left: 8px;">
            <a href="{{ url('/dashboard') }}" class="brand-logo"><span class=".center-align"><img
                        src="./images/cabeceraIcon.png" alt=""></span></a>
            <ul class="right hide-on-med-and-down">

                <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">{{ Auth::user()->name }}<i
                            class="material-icons right">account_box</i></a></li>
            </ul>
        </div>
        <a href="" data-target="slide-out" class="sidenav-trigger" style="padding-left: 10px; height: 20px;"><i
                class="material-icons left">account_box</i>{{ Auth::user()->name }}</a>
        <br>
        <div class="nav-content">
            <ul class="tabs tabs-transparent">
                <li class="tab col s3 "><a class="active" href="#test1">Mapa</a></li>
                <li class="tab col s3"><a href="#test2">Colas</a></li>
                <li class="tab col s3 "><a href="#test3">Comercios</a></li>
            </ul>
        </div>
    </nav>
    <!-- contenido sidenav-->
    <ul id="slide-out" class="sidenav">


        <li>
            <div class="user-view" style="z-index:10;">
                <div class="background">
                    <img src="./images/Orca.jpg">
                </div>
                <a class="sidenav-close" href="#!" style="float: right;"><i class="material-icons white">close</i></a>
                <img class="circle" src="./images/userlogin.png">
                <span class="white-text name">{{ Auth::user()->name }}</span>
                <span class="white-text email">{{ Auth::user()->email }}</span>
            </div>
        </li>

        <li><a href="{{ url('/editProfile') }}">Editar perfil<i class="material-icons">edit</i></a></li>
        <li>
            <div class="divider"></div>
        </li>
        <li><a class="waves-effect" href="{{ url('/logout') }}" style="color: red">Cerrar sesión<i
                    class="material-icons red-text ">subdirectory_arrow_left</i></a></li>

    </ul>
    <!--fin sidenav-->
    <!-- Dropdown Structure -->
    <ul id="dropdown1" class="dropdown-content">

        <li><a href="#!">Configuracion</a></li>
        <li class="divider"></li>
        <li><a href="{{ url('/logout') }}">Cerrar Sesión</a></li>
    </ul>
    <ul class="sidenav" id="mobile-demo">
        <li><a href="#!">Configuracion</a></li>
        <li><a href="{{ url('/logout') }}"> Cerrar Sesión </a></li>
    </ul>
    <main class="center-align">
        <!--fin menu-->
        <div id="test1" class="col s12 queue-animate-bottom">
            <!--tab datos-->
            <h2 class="center-align" id="tituloSeccion">Mapa I-Queue</h2>

            <section class="container">
                <div id="map" style="z-index:5;"></div>
            </section>
            <br><br>
        </div>
        <div id="test2" class="col s12 queue-animate-bottom">
            <!--tab datos-->
            <h2>Colas activas</h2>

            <ul class="collection">

                <li class="collection-item avatar">
                    <img class="responsive-img" src="https://via.placeholder.com/100" style="float: left;"
                        alt="fotonegocio">
                    <span class="title"><b>Nombre del negocio</b></span>
                    <p style="margin-right: 75px">Posicion: 5º
                    <p>
                    <p style="margin-right: 15px"> Tiempo estimado: 20' <br>

                        <!-- Modal Trigger -->
                        <a class=" btn modal-trigger" href="#modal1"><i class="material-icons">info</i></a>


                        <a href="#!" class="secondary-content" onclick="M.toast({html: 'Has salido de la cola'})"><i
                                class="material-icons red-text" style="margin-top:20px">delete</i></a>
                </li>

            </ul>
        </div>
        <div id="test3" class="col s12 queue-animate-bottom">
            <!--tab datos-->
            <h2>Comercios</h2>
            <div class="container">
                <div class="col-12">
                    <ul class="collection with-header" style="width: 100%; ">
                        <li>
                            <div class="card medium">
                                <div class="card-image waves-effect waves-block waves-light">
                                    <img class="activator"
                                        src="https://images.unsplash.com/photo-1552566626-52f8b828add9?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1650&q=80">
                                </div>
                                <div class="card-content">
                                    <span class="card-title activator grey-text text-darken-4">Card Title<i
                                            class="material-icons right">more_vert</i></span>
                                    <p><a href="#">This is a link</a></p>
                                </div>
                                <div class="card-reveal">
                                    <span class="card-title grey-text text-darken-4">Card Title<i
                                            class="material-icons right">close</i></span>
                                    <p>Here is some more information about this product that is only revealed once
                                        clicked on.</p>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

        <!-- Modal Structure -->
        <div id="modal2" class="modal">
            <div class="modal-content">
                <h4>Info del negocio</h4>

                <p><i class="inline-icon material-icons">access_alarm</i>Horario: 7:00-14:00</p>
                <p><i class="inline-icon material-icons">add_location</i>Avd sin nombre nº2</p>
            </div>

            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat red white-text">Cerrar</a>
            </div>
        </div>
    </main>

    <!--fin menu-->

    @include('footerLayout')

    <!-- Modal Structure -->
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Info del negocio</h4>

            <p><i class="inline-icon material-icons">access_alarm</i>Horario: 7:00- 14:00</p>
            <p><i class="inline-icon material-icons">add_location</i>Avd sin nombre nº2</p>
        </div>

        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat red white-text">Cerrar</a>
        </div>
    </div>



</body>
<script>
    //modal

    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.modal');
        var instances = M.Modal.init(elems);
    });

</script>

<!--sidenav-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.sidenav');
        var instances = M.Sidenav.init(elems);
    });

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




<!-- Compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<script>
    $(document).ready(function() {
        $('.tabs').tabs();

        $(".dropdown-trigger").dropdown({
            constrainWidth: false
        });
    });

</script>
@include('CookieLayout')

</html>
