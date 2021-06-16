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
    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('/images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('/images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('/images/favicon/favicon-16x16.png') }}">

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
    @php
        use App\Models\Commerce;
        $commerces = Commerce::orderBy('updated_at', 'DESC')->simplePaginate(4);

    @endphp

    <!--menu-->
    <nav class="nav-extended">
        <div class="nav-wrapper" style="margin-left: 8px;">
            <a href="{{ url('/dashboard') }}" class="brand-logo"><span class=".center-align"><img
                        src="./images/cabeceraIcon.png" height="50px" style="margin: 5px" alt=""></span></a>
            <ul class="right hide-on-med-and-down">
                <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">{{ Auth::user()->name }}<i
                            class="material-icons right">account_box</i></a></li>
            </ul>
        </div>
        <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <div class="nav-content">
            <ul class="tabs tabs-transparent">
                <li class="tab col s3 "><a class="active" href="#test1">Comercios</a></li>
                <li class="tab col s3"><a href="#test2">Colas</a></li>
                <li class="tab col s3 "><a href="#test3">Mapa</a></li>
            </ul>
        </div>
    </nav>

    <!-- contenido sidenav-->
    @include('userSidenav')
    <!--fin sidenav-->
    <!-- Dropdown Structure -->
    <ul id="dropdown1" class="dropdown-content">

        <li><a href="{{ url('/editProfile') }}">Configuracion</a></li>
        <li class="divider"></li>
        <li><a href="{{ url('/logout') }}">Cerrar Sesión</a></li>
    </ul>
    <ul class="sidenav" id="mobile-demo">
        <li><a href="{{ url('/editProfile') }}">Configuracion</a></li>
        <li><a href="{{ url('/logout') }}"> Cerrar Sesión </a></li>
    </ul>
    <main>
        <!--fin menu-->
        <div id="test1" class="col s12 queue-animate-bottom">
            <!--tab datos-->
            <h2 class="center-align">Comercios</h2>
            @if ($commerces)
                <div class="container">

                    <div class="row">
                        <!-- one .row fixes the issue -->
                        <!-- cards -->
                        @foreach ($commerces as $commerce)
                            <div class="col s12 m6 l6 ">
                                <div class="card large">
                                    <div class="card-image waves-effect waves-block waves-light">
                                        <img class="activator" src="{{ $commerce->imageUrl() }}">
                                    </div>
                                    <div class="card-content">
                                        <span
                                            class="card-title activator grey-text text-darken-4">{{ $commerce->name }}<i
                                                class="material-icons right">more_vert</i></span>
                                        <p>{{ $commerce->address }}</p>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Personas en la tienda</th>

                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td>{{ $commerce->queue->current_capacity }} de
                                                        {{ $commerce->queue->fixed_capacity }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-reveal">
                                        <span class="card-title grey-text text-darken-4">{{ $commerce->name }}<i
                                                class="material-icons right">close</i></span>

                                        <ul style="line-height: 50px;">
                                            <li>{{ $commerce->address }} </li>
                                            <li>{{ $commerce->info }} </li>
                                        </ul>
                                        <a href="#"><i class="material-icons">gmail</i></a>
                                        <a href=""><i class="material-icons">facebook</i></a>
                                        <a href=""><i class="material-icons">call</i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    {{ $commerces->links('pagination::simple-materialize-pagination') }}
                </div>
            @endif

        </div>
        <div id="test3" class="col s12 queue-animate-bottom">
            <!--tab datos-->
            <h2 class="center-align" id="tituloSeccion">Mapa I-Queue</h2>

            <section class="container">
                <div id="map" style="z-index:5;"></div>
            </section>
            <br><br>
        </div>
        <div id="test2" class="col s12 queue-animate-bottom">
            <!--tab datos-->
            <h2 class="center-align">Colas activas</h2>
            <div class="row" id="queues_container" style="max-height:650px;overflow:auto;">







            </div>







    </main>

    <!--fin menu-->

    @include('footerLayout')





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

    @foreach ($commerces as $commerce)
        L.marker([{{ $commerce->latitude }}, {{ $commerce->longitude }} ]).addTo(map)
        .bindPopup('{{ $commerce->name }}')
        .openPopup().closePopup();
    @endforeach

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
<!-- Save Scroll -->
<script type="text/javascript">
    $(document).ready(function() {

        if (localStorage.getItem("my_app_name_here-quote-scroll") != null) {
            $(window).scrollTop(localStorage.getItem("my_app_name_here-quote-scroll"));
        }

        $(window).on("scroll", function() {
            localStorage.setItem("my_app_name_here-quote-scroll", $(window).scrollTop());
        });

    });

</script>
<!-- Ajax queue -->
@php
$token = Session::get('variableName');
@endphp
<script>
    //every 10 seconds get data
    $(document).ready(function() {
        getQueueData();
        var intervalId = window.setInterval(function() {
            getQueueData();
        }, 10000);
    });


    function getQueueData() {
        $.ajax({
            url: "{{ URL::to('/') }}/api/queue-verified-users",
            headers: {
                'Authorization': 'Bearer {{ $token }}'
            },
            success: function(data) {
                var $queues_container = $("#queues_container");
                $queues_container.empty();
                if (data.data.length == 0) {
                    var $template_empty = $("#emptyQueueTemplate").clone();
                    $template_empty.find("div.bounce").css("background-image", 'url(' + imgDataURI + ')');
                    $queues_container.append($template_empty.html());
                } else {
                    $.each(data.data, function(i, queue) {
                        var $template = $("#template").clone();
                        //title
                        $template.find("span#queue-name").text(queue.name);
                        //position
                        $template.find("td#queue-position").text(queue.position);
                        //estimated Time
                        $template.find("td#estimated_time").text(queue.estimated_time);
                        //image
                        $template.find("img#queue-image").attr("src", queue.image);
                        //delete button
                        $template.find("a#delete_from_queue_button").attr("onclick",
                            "DeleteFromQueue(" + queue.id + ")")
                        //load template
                        $queues_container.append($template.html());
                    });
                    //show toast
                    M.toast({
                        html: 'Colas actualizadas!'
                    })
                }
            },
            error: function() {
                M.toast({
                    html: 'hubo un error!'
                })
            }
        });
    }

    function DeleteFromQueue($id) {
        $.ajax({
            url: "{{ URL::to('/') }}/api/queue-verified-users/" + $id,
            type: 'DELETE',
            headers: {
                'Authorization': 'Bearer {{ $token }}'
            },
            success: function(data) {
                getQueueData();
                //show toast
                M.toast({
                    html: 'Eliminado de la cola!'
                })
            },
            error: function() {
                console.log("error");
                M.toast({
                    html: 'hubo un error!'
                })
            }
        });
    }
    var imgDataURI =
        "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAAbrwAAG68BXhqRHAAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAABA/SURBVHic7Z1plF1FEcd/QybbMWBIAiKIIhDF/bCJO6CComBEhCAiGhWF4xHccAUBdzzywQ03BCXiLiqCCCIoorK4IEclKkZkEgMJISEJEEKS54d6l7nv39XLffPmzQjzP6c/3Pequuveut1dXVXdFyYwgQlMYAITeGhiEnACsAS4HTh0bMV5aONRwHVAq1ZuH1OJxjnmAcuAO4CXJegGgOcCX8Ae6HLg5Zm692rX3ZKyol3fBBwsYfhBLXH+nw68CbgJ/8HG8AxgtcOzGji4R7I/KKEPrMIU4C34b3hVlkfqfCK+Mi4EHjlCeecBq9pynQJsOcL6xh30oW0BHA38y/lP54HDnfrmRHjPaNc9EgwQviArgJOAaSOse9xAH9yNzm9VWQ9cgL2lU5y6BoCfOHyf6qG8d0RkW8yDxHpL9YL6uP8xYNtMXcc7vN+htxP4PODOhKyXATv2sL2+I6WItcDJwMML6tmhTV/nvwEzCnqNmcBp2Fziyb0KmC88pdbkmOJV+De0CTgb2K5BXedLHfdgk/toYiY2HN6Hfx/nMDy35KzJMcUAcDqwmfAmbsJM1iZ4plPXO3olbAHmApfgK+V6bAiLWZNjjunAtwkF3AycSXdDzBVS15+BwV4I2wADmJl+D+G9LXd+GxeYDvwCf67o1kJ5gVPffg5dv8bwJwJ/dWQadwqZDvwc31x8ygjqvUzquyxC188xfAbwLcaxQqYBlxIK9WeaTdyKJxHOHftEaMfigbwff54cc4WoBdQCfgtsPcJ6vyR1/jpBO1YP5Fhgo9P+8/ooQwfe5QjzO6xbjwTTCP1Vr0zQj+UbeiShUlYAO/dZDg50BLkRmNWDug+TepeStqz6oZCpxK3EBYTD11+ArXotxKHAbcBKOq2XHdq/1QUYIu5tfVH7/xXAQQXt/kDqPiNDP9oKeR1mLa4lbsW905Hjm70WZGmt8tsZfkt/Kg1vwBZwHmbQ6bS7NdPmTOBeqT+3Kh9NhUzGHJ/14ehhEdrzHFle10th6gppYcPUG5xG35aoQ9+c/2bafL3Q/7FAztFUyCRM5pL7nYat3uu0a4FdeyXM2VL5xYST7U+Je1ynEir19Eyb2vtOLZBztIes06T+IfwQAdjDXyP0V9Ijr/SLCG+2Xu7E5pMYjhL6u4FtEvTT2jR1nt2xSXMpNmwe4fB1q5D52BC0jPQKf44j16sT9K9xZHp9A7mimEw8aNMCjsnwqx/q8xn6AwgVeLn85iUxdKuQ22s8S5x66/istHFVpu4fCf1KTLEjhg5bVfkd6RuYS2gKPinT1icibdWLF2vvViFqKT4mQbsL4f2kjI1HA+uEvrIWD8OG/iXASxrIC/jD1mbg2Rm+U4UntdKucJXTVr2sitxAtwrR9nKOyV/hP+AY3iP067BcsrqH+D8N5AVs2LpLKr6ggO8vwpMb3ibju7ercgl2Mx66VcjnhO+UDP0CoV9MepSYjhkAdR61who7Q3cl7Kp7Z3ieIPTryYdq98JXxBosdyt1490q5E3C970M/ZaEw9BeGZ43OvLVy1cayAtYAkK9gisLeLSr/qSA51hH2CuAnQp4u1XIPsL3jwIe9SJ8NEM/iA1LMYUc2EBeBgkXRSWZgRqoWlDAo8PHlyi33btVyJbCt4F8fpcujK8raOe9jowtzGJsFP2cJxUsxVauKTyMTldDi/jYX8fVwtMkytitQiC0tLbP0O9A5xC+kbxDdQ6hO6ir4er7UkHOqoBwLbGosC1d7zyugZwjUcifhDcWBKvjBuF5RQGPF2V0h6tYFx3EYtp1LCxoWLNKrijg2RqYXbtej6WM9gNDcv3oAh414UuUeL5cb8LM6AAxhTwd87xWWIyZsjk8Xa6vLeDZRa5vxgTuB9T7XJKZqPPGngU8l2KjQIVJwFM9wphCtDtdUtAohCbx7wt4NLqWc9H3EroO8OaQI7GHuQzzYV0v/+9J3gC5nzBJ4wCPsFQhP8s0CDZ5PaJ2vY6yOUQfQj8Vcqdc63ppC8wCnI0lbXwDOA7zs1WYSVnPulyuX+gReQqZTOeCp4UlLuTweLleRNnQo9kpOq6PJlbL9Uy59oyEEwmDVHML2lKF7I3z/D2FzMWUUuEWwjfJw25y/c8CHghDv7kgVi+hCtEe0sJW9Osz9ZQEoYawkHiFGTjWpKcQ9cr+oaAxgMfKdcnKF8KtCCXK7xXukmvtIWC+u+eQHkpLo4I3yPXuSuApRN3KJdYVhG/6LYV8mp3RT4XkekiFP2DD+C8j/5dup1OFPEEJShRyS2FjOjnrFuXXYCvjITqD/2OpkHVyHUtgAHN1HAB8xvkvt+GowmK5Lln3BHGC/Qob01Vv3T4fIHRTXIoFhdT5lgoLexjJSn1b4S3d5/4W4dM3PwaNLwULZ6+H6Btb6rPXXau6tXmzXB+IDYdqZd1X2F4Or8QMhLsIdz1VuF+uS519P5fr2S5VCLUgi14+3elamjStnmEV8iXEt4rVS9OMP6+HvJrOzMo7fNbA47umsM0dhC+1r76O7YVvaQnTCsoe0Hysiw9hcWKNLHo5vo8iviOpKk23ISv/UYRprrdFeKcJ3b2FbW5Nd4qcKXyrSpjUfT7ZodE5YSNhZDHW/Qcw217zl6rSdM+58qsyNhJP1p7k0JZgqvBtKOSbInxFw/MGyh5sKkWoRT52shNhqlAvFKIPOJVD1a1CBoVP56IYVJG5BScQ7tWOHTFxOP7+iNSQpRgg7JFTS4SsIaWMozK8OmTdnSZ/ADOEb20h3xzhix0h0oFbhSllYx9G2KOqkspSrEPnnqZnjHhtb6AscKSTetGYjt1b4weLebbrfDcrgTc86GIptRvqB1ic2XMilu661XHUm7OaYBPwWsrSlTRHt9Tk1nsrNQb0ZQt6lqcQXSnnbOWFWCKDKqVbhTQdshRHYyHTEqhCSidnXdGXKkRHjcA68xSi4dOSJIWFhJG0R3iEDnRiG+mxSN9uQKsmfdEkS+i7Kl2HaIgicFh6CtFxrdSTqW7zEkVC6HEtOf+kV9C2Sv1o6rfzFni6ToNQITcpk2fSqkLc2K8DVUjpyTk6kXou8NGCKqR0UleF6L0PAGcxnCL0Hcyh6gXxOuD1kL/L9dOKROy+h+hDiPWQ+htXYkGVINZDBkjvS9F5Ve+9sqIqTAK+hsVV6gh6iIdBwhzWXAIZmNB1notLGiPck368Q+N5Bqo1hpq8TaBe289iC1Y9RUL3pehhCd4JeLl12noci9LrIRuBa+S3/TDX8TLM5p7n8Km2S3uWury9YI/3xp2HHQM1Emhbz8E80JoRou0/Wf73gnjfw4apWF7Bbylf4Qf76q6g8xAxLxFhKuEbUbJr6DjhiaVYem+c9wY2wVcdfi26L2WW/L+etNv+6Iic72si6PMzQsa8p38XOjfVRfAy4bkoQatuda80gW4y1XIR4XC9r9CUBKeOcep2tzLEHHlXEY8hQPwQMU0i2yNRRwWdEFNhzfOxVXivMht3ivy+GhtuDiaUT/fk31jQjr7AKynb8t2Br+C/NeckeHSSrGc8vhizWlYDh9R+ny08d5PPBPRiHk17yBb4Weler6jjYqF/c0FberDbuQ3kfAAHOsL+jXQiwB5Cvw5zT+xEZ/xD99aph7kktBlTSin0eL57sd6XwiTCvfpB5ohgFqFHe98Gcj6AQTq3DreAtxfwqPd2f8JNPDoMXNulwN5hm6XYT/h+U8Czp/AsJ9+bTxCem1M8qWDQRuDL8tvxpANPGwmTir+AGQl1nCrXmuWYe+sqlDoRPWi6018LeHSnbpWhE8Nkwpf46ymeXHTuLDo9oHNJn10FZrnUoe6Cy7H973X8Ta5L1zAjgbahMng4TK5z+yePITQc9sZ61m3Es2GSqDRaN/NSitwOs4K8CXcN/gb9lwpdSXJ3hW6HrGuEL7cBU3cXbyC9nW2Q/Dn3KUs2KYhOnm/I8PwyIsBxEXqdYNeSj8lX6EYhg4Tnl+TCBacJfexQzgq5LdEtyt32AfSIjeWkI4l6zFILm9hTE6AmTZQOW90oZHfhyZ2oMEh4CEDK3N2GMJ1Ky3I6zf8o5mMPZw1mk78L++KNxs5Th8lsRXgyw9GZdi8S+lhvUnSjEF0v5Q4NOFTo15GO2yx05KqG7IXYEB074qkDA+TTe6qyCTNpY9C5JzcvvF/ozysR2JGrBHqa6kkZevXuqvVZh3c+zGWYQdDVBwRSn2zQMkR86NJFYov0Ear7Cu0thfI2VcgAnYcvtwjjFHXsRZgEGOzraGMbwqydRYzwozCHkx//6uW7ibr0BJ1UjGQ64TCnu7I8NFXIU4R+DelMF3VAXh2hm0QYR9lE/uSkIgxi+6/f0xZIv9+h5d2Reg4Rus2kD6/RvN8TC2RtqpCThP7CBO2znPpj5vGHHNpPFsjTFQaxQwHei+3IVQVtwj9+D+ywszrttcTXMScKbcnu36YKuVLo3xqhG8DmvZLe8QrCtdc1jDzHrBi7Eg5r92LfI1TsT/jQjo3UO1foNpDfe9FEIdsSrqliWTXeCaxefOcgwg+/3Em453LU8SxC9/UafKWoy3oF8VWufjwstwhtopA3C+2fInSzCV84dQmB+eh03ltPl97cXuAIQgtkHaEzcRdCwWPGwClC94uMDE0Uotn2H3BoBggP3rmH8MSJFxAmg2wmn+A96tBJsroBTdU52aHzxu/dCG8ydTpQqUJ2I3x51PEJdlCy1qmKW4CfZH5Cov2+4h2EN7sZszyqCXwq4cbQ+wgPrAE7cadOd2ai7VKFfFrovKNen0H4oP/I8Kp6APiI02YLM3jGFd6IH8G7kOHF41zCnVNLCIeD+UKzinhGY4lCtiYMnKlVuCvhPsm7GD42Yxvgx057LUyJZ2Or9H5/IyuJI/A/NTfEsP1+pPP/YjozHScTHlMeOzW0RCGnC80SOh/cjphnQOuqlPZSLH7hKUPLsjb9mGIylsRwLvFF5GbsZJ0ZwMed/2+ic8fvB+X/lfhumpxCZhHu/q3PCdsTpi+1sAMuZ2GZlbHPG8XKmH7X/RDK357qDToO3yM6xPBKfg6hX807RSGnkLPk/5UMm9z7EPq1Wm3Z3k542EFVrsfi+ec6Mlb3MWYo9Q5r+Seh2djC1jbVwctq8dxPmOuVUsjehPNaZQktIMwGabVlWhyReRPWu+sr8Gp0+Cr2Yq7AT7XtG3Ssb7WF+iK2Hnk+djJQU4X9EJtQF8nv/6BzU09MIVthStdh8XHEJ+dUWcQYLvia4FCsl9yGJdcdQGhpTMcO249tEI2VewiPkG1hyQXVW+opZAr+576vJn2keUyGkxn5VrtxiZ2x8TmWBNGkXEC4i7bV/k0/F9FN2YgFyfr+xbWxwJOxm419jbm0eFkduUyPEkUsxF/FP+jxSODD+PNQv8t/27IUnWH1YMckzLX9NcpODOpVWY7F/l9OH2MXKfTkY1U9xiDm2j8I86g+jcIMjQKswwJkV2OJC9fRv0ObizAeFaKYgsXB98Am2B2x7MftMOXV03E2YA99dbvciuVc/RtLFb2B8gNmJjCBCUxgAhP4v8L/ADYpmJg0kKzfAAAAAElFTkSuQmCC";

</script>
<!-- Template -->
<div id="template" style="display: none">
    <div class="col s12" class="queue-animate-zoom">
        <div class="card ">
            <div class="card-image">
                <img id="queue-image" height="200px" style=" object-fit: cover;"
                    src="https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=934&q=80">
                <span id="queue-name" class="card-title">Card Title</span>
                <a id="delete_from_queue_button" onclick="DeleteFromQueue()"
                    class="btn-floating halfway-fab waves-effect waves-light red"><i
                        class="material-icons">close</i></a>
            </div>
            <div class="card-content">
                <table class="striped centered">
                    <thead>
                        <tr>
                            <th>Posicion</th>
                            <th>Tiempo estimado</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td id="queue-position">1</td>
                            <td id="estimated_time">4:32</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="emptyQueueTemplate" style="display: none">
    <div class="animation-container">
        <div class="bounce"></div>
        <div class="pebble1"></div>
        <div class="pebble2"></div>
        <div class="pebble3"></div>
    </div>
    <div>
        <br><br>
        <p class="center-align">No parece que estes en ninguna cola!</p>
    </div>
</div>
@include('CookieLayout')

</html>
