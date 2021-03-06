<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('/images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('/images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('/images/favicon/favicon-16x16.png') }}">
    <!--iconos material icon-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/materialize.css') }}" rel="stylesheet">
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
    <title>Iqueue-ADMIN-PANEL</title>
</head>
@php
use App\Models\Commerce;
use App\Models\CurrentQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

//flag
$empty_checker = false;
//commerce object
$week_data = [0, 0, 0, 0, 0, 0, 0, 0];
$commerce_id = 0;
$commerce = Commerce::where('user_id', Auth::user()->id)->first();
if (empty($commerce)) {
    $empty_checker = true;
} else {
    $commerce_id = $commerce->id;
    $stats = DB::select(DB::raw('SELECT count(*) as total,WEEKDAY(`created_at`) as weekday FROM statistics WHERE (YEAR(`created_at`) = YEAR(NOW())) AND`queue_id`=' . $commerce->id . ' GROUP BY WEEKDAY(`created_at`) ORDER BY WEEKDAY(`created_at`)'));

    foreach ($stats as $key => $result) {
        $week_data[$result->weekday] = $result->total;
    }
    $queue = CurrentQueue::where('commerce_id', $commerce->id)->first();
}
$week_data_array = json_encode($week_data);
$token = Session::get('variableName');
@endphp

<body class="container">

    <!--menu-->
    <!--nav extendido-->
    <nav class="nav-extended">
        <div class="nav-wrapper" style="margin-left: 8px;">
            <a href="{{ url('/dashboard') }}" class="brand-logo"><span class=".center-align">AdminPanel</span></a>
            <ul class="right hide-on-med-and-down">
                <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">{{ Auth::user()->name }}<i
                            class="material-icons right">account_box</i></a></li>
            </ul>
        </div>
        <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <div class="nav-content">
            <ul class="tabs tabs-transparent">
                <li class="tab col s3 "><a class="active" href="#datos">Datos</a></li>
                <li class="tab col s3"><a href="#TuCola">Tu Cola</a></li>
                <li class="tab col s3 "><a href="#configuracion">
                        @if ($empty_checker)
                            Configura tu negocio
                        @else
                            Configuraci??n
                        @endif
                    </a></li>

                @if (!$empty_checker)
                    <li class="tab col s3 "><a href="#mostrador">Tu Mostrador</a></li>
                @endif
            </ul>
        </div>
    </nav>
    <!-- Dropdown Structure -->
    <ul id="dropdown1" class="dropdown-content">

        <li><a href="{{ url('/editProfile') }}">Configuracion</a></li>
        <li class="divider"></li>
        <li><a href="{{ url('/logout') }}">Cerrar Sesi??n</a></li>
    </ul>
    <!-- sidenav -->
    @include('userSidenav')
    <main class="center-align">
        <!--fin menu-->
        <div id="datos" class="col s12 queue-animate-bottom">
            <!--tab datos-->
            <h2>Datos</h2>
            <canvas id="myChart" width="400" height="200"></canvas>
            <br>
            <a class="waves-effect waves-light btn-large" onClick="window.location.reload();"><i
                    class="material-icons right">update</i>actualizar</a>
        </div>
        <div id="TuCola" class="col s12 queue-animate-bottom">
            <!--tab Cola-->
            @if ($empty_checker)
                <h2>Antes debes configurar tu negocio!</h2>
                <svg width="380px" height="500px" viewBox="0 0 837 1045" version="1.1"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                        <path
                            d="M353,9 L626.664028,170 L626.664028,487 L353,642 L79.3359724,487 L79.3359724,170 L353,9 Z"
                            id="Polygon-1" stroke="#007FB2" stroke-width="6" sketch:type="MSShapeGroup"></path>
                        <path
                            d="M78.5,529 L147,569.186414 L147,648.311216 L78.5,687 L10,648.311216 L10,569.186414 L78.5,529 Z"
                            id="Polygon-2" stroke="#EF4A5B" stroke-width="6" sketch:type="MSShapeGroup"></path>
                        <path
                            d="M773,186 L827,217.538705 L827,279.636651 L773,310 L719,279.636651 L719,217.538705 L773,186 Z"
                            id="Polygon-3" stroke="#795D9C" stroke-width="6" sketch:type="MSShapeGroup"></path>
                        <path
                            d="M639,529 L773,607.846761 L773,763.091627 L639,839 L505,763.091627 L505,607.846761 L639,529 Z"
                            id="Polygon-4" stroke="#F2773F" stroke-width="6" sketch:type="MSShapeGroup"></path>
                        <path
                            d="M281,801 L383,861.025276 L383,979.21169 L281,1037 L179,979.21169 L179,861.025276 L281,801 Z"
                            id="Polygon-5" stroke="#36B455" stroke-width="6" sketch:type="MSShapeGroup"></path>
                    </g>
                </svg>
                <div class="message-box">


                </div>
            @else
                <h2>Parametros de la Cola</h2>
                <img src="{{ $commerce->image ? url('/') . Storage::url('') . 'commerces/' . $commerce->image : 'https://i.imgur.com/n6bF2Vx.jpeg' }}"
                    alt="" class="circle " height="140px" width="140px" style="object-fit: cover;">
                <div class="row">
                    <div class="col s12 m6 l6">

                        <h3>{{ $commerce->name }}</h3>


                        <table class="centered">
                            <thead>
                                <tr>
                                    <th>Aforo</th>
                                    <th>Personas en la tienda</th>
                                    <th>Personas en la cola</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span id="fixed_capacity"></span></td>
                                    <td><span id="current_capacity"></span></td>
                                    <td><span id="current_queue"></span></td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <br>
                        <br>

                        <div class="progress">
                            <div class="indeterminate"></div>
                        </div>
                    </div>

                    <div class="col s12 m6 l6">
                        <h3>Editar <i class="material-icons prefix">mode_edit</i></h3>

                        <div class="row">
                            <form class="col s12" id="update_queue">
                                @csrf
                                <div class="row">
                                    <div class="row">
                                        <div class="input-field col s6" id="fixed_capacity_err">
                                            <i class="material-icons prefix">nature_people</i>
                                            <input name="_method" type="hidden" value="PUT">
                                            <input id="fixed_capacity" name="fixed_capacity" type="number" step="1"
                                                value="{{ $queue->fixed_capacity }}" class="validate">
                                            <label for="fixed_capacity">Aforo</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="row">
                                        <div class="input-field col s6" id="average_time_err">
                                            <i class="material-icons prefix">access_time</i>
                                            <input id="average_time" name="average_time" class="timepicker" type="text"
                                                value="{{ $queue->average_time }}">
                                            <label for="average_time">??Cuanto tarda un cliente (minutos)?</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <button type="submit" class="waves-effect waves-light btn-large">
                                                <i class="material-icons right">update</i>Actualizar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div id="configuracion" class="col s12 queue-animate-bottom">
            <!--tab negocio-->
            <h2>Configuraci??n</h2>
            <!--Si no tiene negocio-->
            @if ($empty_checker)
                <h5>No tienes negocio configurado! :(</h5>
                <div class="row">
                    <form class="col s12" id="commerce_create">
                        <div class="row">
                            <div class="input-field col s6" id="name_err">
                                <input id="name" name="name" type="text" class="validate">
                                <label for="name">Nombre del negocio</label>
                            </div>

                            <div class="input-field col s6">
                                <div class="file-field input-field" id="image_err">
                                    <div class="btn">
                                        <span>Foto</span>
                                        <input name="image" type="file">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input id="image" class="file-path validate" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="row">
                                <div class="input-field col s6" id="latitude_err">
                                    <i class="material-icons prefix">map</i>
                                    <label for="latitude">Latitud</label>
                                    <input id="latitude" name="latitude" type="number" step="any" class="validate">

                                </div>
                                <div class="input-field col s6" id="longitude_err">
                                    <i class="material-icons prefix">map</i>
                                    <label for="longitude">Longitud</label>
                                    <input id="longitude" name="longitude" type="number" step="any" class="validate">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="row">
                                <div class="input-field col s12" id="info_err">
                                    <i class="material-icons prefix">mode_edit</i>
                                    <textarea id="info" name="info" class="materialize-textarea validate"></textarea>
                                    <label for="info">Informacion del local</label>
                                </div>
                            </div>

                        </div>
                        <div class="row">

                            <div class="row">
                                <div class="input-field col s12" id="address_err">
                                    <i class="material-icons prefix">navigation</i>
                                    <input id="address" name="address" type="text" class="validate">
                                    <label for="address">Direccion del comercio</label>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col s12">
                                <button type="submit" class="waves-effect waves-light btn-large">
                                    <i class="material-icons right">add_circle</i>Crear Negocio
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @else
                <!--si tiene negocio-->
                <div class="row">
                    <!-- Pullup Card -->
                    <div class="col s12 m7">
                        <h3 class="header">Tu negocio</h3>
                        <div class="card large">
                            <div class="card-image waves-effect waves-block waves-light">
                                <img class="activator " style="width: 100%;
                                height: 100%;
                                object-fit:cover;"
                                    src="{{ $commerce->image ? url('/') . Storage::url('') . 'commerces/' . $commerce->image : 'https://i.imgur.com/n6bF2Vx.jpeg' }}">
                            </div>
                            <div class="card-content">
                                <span class="card-title activator grey-text text-darken-4">{{ $commerce->name }}<i
                                        class="material-icons right">edit</i></span>

                                <p>{{ $commerce->info }}</p>
                            </div>
                            <div class="card-reveal">
                                <span class="card-title grey-text text-darken-4">Actualizar "{{ $commerce->name }}"<i
                                        class="material-icons right">close</i></span>
                                <div class="row">
                                    <form class="col s12" id="commerce_update">
                                        <div class="row">
                                            <div class="input-field col s6" id="name_err">
                                                <input id="name" name="name" type="text" class="validate">
                                                <input name="_method" type="hidden" value="PUT">
                                                <label for="name">Nombre del negocio</label>
                                            </div>

                                            <div class="input-field col s6">
                                                <div class="file-field input-field" id="image_err">
                                                    <div class="btn">
                                                        <span>Foto</span>
                                                        <input name="image" type="file">
                                                    </div>
                                                    <div class="file-path-wrapper">
                                                        <input id="image" class="file-path validate" type="text"
                                                            value="{{ $commerce->image }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="row">
                                                <div class="input-field col s6" id="latitude_err">
                                                    <i class="material-icons prefix">map</i>
                                                    <input id="latitude" name="latitude" type="number" step="any"
                                                        class="validate" value="{{ $commerce->latitude }}">
                                                    <label for="latitude">Latitud</label>
                                                </div>
                                                <div class="input-field col s6" id="longitude_err">
                                                    <i class="material-icons prefix">map</i>
                                                    <input id="longitude" name="longitude" type="number" step="any"
                                                        class="validate" value="{{ $commerce->longitude }}">
                                                    <label for="longitude">Longitud</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="row">
                                                <div class="input-field col s12" id="latitude_err">
                                                    <i class="material-icons prefix">mode_edit</i>
                                                    <textarea id="info" name="info"
                                                        class="materialize-textarea">{{ $commerce->info }}</textarea>
                                                    <label for="info">Informacion del local</label>
                                                </div>
                                                <div class="input-field col s6" id="address_err">
                                                    <i class="material-icons prefix">mode_edit</i>
                                                    <textarea id="address" name="address"
                                                        class="materialize-textarea">{{ $commerce->address }}</textarea>
                                                    <label for="address">Direccion del local</label>
                                                </div>
                                                <div class="input-field col s6" id="longitude_err">
                                                    <button type="submit" class="waves-effect waves-light btn-large">
                                                        <i class="material-icons right">update</i>Actualizar
                                                    </button>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m5">
                        <br><br><br><br>
                        <p class="caption">
                            Aqui puedes retocar y realizar cambios oportunos a tu negocio!

                            <img src="./images/edit_icon.png" style=" width: 50%;">
                        </p>
                    </div>
                    <div class="col s12">
                        <br>

                    </div>
                </div>


            @endif
        </div>
        @if (!$empty_checker)
            <div id="mostrador" class="col s12 queue-animate-bottom">
                <h2>App Mostrador</h2>
                <div class="row">
                    <div class="col s12 center-align"><img class="responsive-img" style="max-height: 400px"
                            src="{{ asset('images/mockup_2.png') }}">
                    </div>
                    <div class="col s12  center-align">
                        <h5><b>Caracteristicas</b></h5>
                    </div>
                    <div class="col s12  center-align">
                        <table>
                            <thead>
                                <tr>
                                    <th>Requiere</th>
                                    <th>Tama??o</th>
                                    <th>Versi??n</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>Android 6 o Posterior</td>
                                    <td>Menor de 50mb</td>
                                    <td>1.0</td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <th>Actualizada</th>
                                    <th>Desarrollador</th>
                                    <th>Requisitos</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>20 de junio de 2021</td>
                                    <td>i-queue</td>
                                    <td>Conexi??n a internet</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col s12" style="margin-top: 50px" >

                        <a id="download-button" class="waves-effect waves-light btn-large"><i
                                class="material-icons right">file_download</i>Descargar</a>
                        <a id="download-cancel"
                            onclick="request.abort(); $('#download-button').show('slow');$('#download-cancel').hide('slow'); "
                            style="display: none;" class="waves-effect waves-light btn-large"><i
                                class="material-icons right">close</i>Cancelar</a>
                        <a id="save-file" class="waves-effect waves-light btn-large" style="display: none;"><i
                                class="material-icons right">save</i>Guardar Apk</a>
                        <div class="progress">
                            <div id="progress" class="determinate" style="width: 0%"></div>
                        </div>
                        <span id="progress-text"></span>
                        <span id="download-progress-text"></span>

                    </div>



                </div>
            </div>
        @endif


        <!--fin login-->
        <br>
    </main>

    @include('footerLayout')
</body>




<!-- Compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js"
    integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.tabs').tabs();
        $(".dropdown-trigger").dropdown({
            constrainWidth: false
        });;
    });
    const image = new Image();
    image.src = './images/logo.svg';
    const plugin = {
        id: 'custom_canvas_background_image',
        beforeDraw: (chart) => {
            if (image.complete) {
                const ctx = chart.ctx;
                const {
                    top,
                    left,
                    width,
                    height
                } = chart.chartArea;
                const x = left + width / 2 - image.width / 2;
                const y = top + height / 2 - image.height / 2;
                ctx.drawImage(image, x, y);
            } else {
                image.onload = () => chart.draw();
            }
        }
    };
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',

        plugins: [plugin],
        data: {
            labels: ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'],
            datasets: [{
                label: 'Personas en el local',
                data: {{ $week_data_array }},
                backgroundColor: [
                    'rgba(255, 99, 132,  0.5)',
                    'rgba(54, 162, 235,  0.5)',
                    'rgba(255, 206, 86,  0.5)',
                    'rgba(75, 192, 192,  0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64,  0.5)',
                    'rgba(255, 500, 64,  0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            aspectRatio: 2,
            layout: {
                padding: {
                    left: 0,
                    right: 0,
                    top: 0,
                    bottom: 0,
                }
            },
            responsive: true,
            cutoutPercentage: 90,
            legend: {
                display: false,
            },
            title: {
                display: false,
            },
        }

    });

</script>
<script>
    jQuery(document).ready(function() {
        jQuery('.timepicker').timepicker({
            twelveHour: false,
            format: "ii"
        });
    });
    $('.timepicker').on('change', function() {
        let receivedVal = $(this).val();
        var timeParts = $(this).val().split(":");

        $(this).val(Number(timeParts[0]) * 60 + Number(timeParts[1]));
    });

    $(document).ready(function() {
        $("#commerce_create").submit(function(event) {
            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "{{ URL::to('/') }}/api/commerces",
                headers: {
                    'Authorization': 'Bearer {{ $token }}'
                },
                data: formData,
                encode: true,
                processData: false, // tell jQuery not to process the data
                contentType: false,
                error: function(xhr, status, error) {
                    $(".errorSpan").remove();
                    var response = jQuery.parseJSON(xhr.responseText);
                    if (response.errors) {
                        $.each(response.errors, function(index, value) {
                            console.log(index + ": " + value);

                            if (response.errors) {
                                $("#" + index).addClass("invalid");
                                $("#" + index + "_err").append(
                                    '<span class="helper-text errorSpan" data-error="' +
                                    value +
                                    '" data-success="Pinta Bien!">' +
                                    value + "</span>"
                                );
                            } else {
                                $("#" + index).addClass("success");
                            }
                        });
                    }
                }
            }).done(function(data) {
                window.location.replace("{{ url('/dashboard#configuracion') }}");
                location.reload();

                //console.log(data);
            });
            event.preventDefault();
        });
        $("#commerce_update").submit(function(event) {
            var formData = new FormData(this);
            formData.append('_method', 'PUT');
            console.log(formData);
            $.ajax({
                type: "POST",
                url: "{{ URL::to('/') }}/api/commerces/{{ $commerce_id }}",
                headers: {
                    'Authorization': 'Bearer {{ $token }}'
                },
                data: formData,
                encode: true,
                processData: false, // tell jQuery not to process the data
                contentType: false,
                error: function(xhr, status, error) {
                    $(".errorSpan").remove();
                    var response = jQuery.parseJSON(xhr.responseText);
                    if (response.errors) {
                        $.each(response.errors, function(index, value) {
                            console.log(index + ": " + value);

                            if (response.errors) {
                                $("#" + index).addClass("invalid");
                                $("#" + index + "_err").append(
                                    '<span class="helper-text errorSpan" data-error="' +
                                    value +
                                    '" data-success="Pinta Bien!">' +
                                    value + "</span>"
                                );
                            } else {
                                $("#" + index).addClass("success");
                            }
                        });
                    }
                }
            }).done(function(data) {
                window.location.replace("{{ url('/dashboard#configuracion') }}");
                location.reload();
                //console.log(data);
            });
            event.preventDefault();
        });
        $("#update_queue").submit(function(event) {
            var formData = new FormData(this);
            formData.append('_method', 'PUT');

            $.ajax({
                type: "POST",
                url: "{{ URL::to('/') }}/api/current-queues/{{ $commerce_id }}",
                headers: {
                    'Authorization': 'Bearer {{ $token }}'
                },
                data: formData,
                encode: true,
                processData: false, // tell jQuery not to process the data
                contentType: false,
                error: function(xhr, status, error) {
                    $(".errorSpan").remove();
                    var response = jQuery.parseJSON(xhr.responseText);
                    if (response.errors) {
                        $.each(response.errors, function(index, value) {
                            console.log(index + ": " + value);

                            if (response.errors) {
                                $("#" + index).addClass("invalid");
                                $("#" + index + "_err").append(
                                    '<span class="helper-text errorSpan" data-error="' +
                                    value +
                                    '" data-success="Pinta Bien!">' +
                                    value + "</span>"
                                );
                            } else {
                                $("#" + index).addClass("success");
                            }
                        });
                    }
                }
            }).done(function(data) {
                window.location.replace("{{ url('/dashboard#TuCola') }}");
                location.reload();
            });
            event.preventDefault();
        });



        getQueueData();
        var intervalId = window.setInterval(function() {
            getQueueData();
        }, 5000);

    });

    function getQueueData() {
        $.ajax({
            url: "{{ URL::to('/') }}/api/current-queues/{{ $commerce_id }}",
            headers: {
                'Authorization': 'Bearer {{ $token }}'
            },
            success: function(data) {
                //console.log(data);

                $('#fixed_capacity').html(data.data.fixed_capacity);
                $('#current_capacity').html(data.data.current_capacity);
                $('#current_queue').html(getCurrentQueueValue(data.data.fixed_capacity, data.data
                    .current_capacity));
                M.toast({
                    html: 'Datos actualizados!'
                })
            },
            error: function() {
                console.log("error");
            }
        });
    }

    function getCurrentQueueValue(fixed_capacity, current_capacity) {
        if (current_capacity < fixed_capacity) {
            return 0;
        } else {
            return current_capacity - fixed_capacity;
        }
    }

</script>
<!-- dowload -->
<script>
    var fileName = '{{ asset('apps/mostrador-app-iqueue.apk') }}';
    var progress = $("#progress");
    var progressText = document.getElementById("progress-text");
    var downloadProgressText = document.getElementById("download-progress-text");
    var startTime = new Date().getTime();
    document.querySelector('#download-button')
        .addEventListener('click', function() {
            $("#download-button").hide("slow");
            $("#download-cancel").show("slow");
            request = new XMLHttpRequest();
            request.responseType = 'blob';
            request.open('get', fileName, true);
            request.send();
            request.onprogress = function(e) {

                var percent_complete = (e.loaded / e.total) * 100;
                percent_complete = Math.floor(percent_complete);
                progress.width(percent_complete + "%");
                progressText.innerHTML = percent_complete + "%";
                var duration = (new Date().getTime() - startTime) / 1000;
                var bps = e.loaded / duration;
                var kbps = bps / 1024;
                kbps = Math.floor(kbps);

                downloadProgressText.innerHTML = kbps + " KB / s";
            };
            request.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var obj = window.URL.createObjectURL(this.response);
                    document.getElementById('save-file').setAttribute('href', obj);
                    $("#download-cancel").hide("slow");
                    $("#save-file").show("slow");
                    document.getElementById('save-file').setAttribute('download', fileName);
                    setTimeout(function() {
                        window.URL.revokeObjectURL(obj);
                    }, 60 * 1000);
                }
            };
        });

</script>




@include('CookieLayout')

</html>
