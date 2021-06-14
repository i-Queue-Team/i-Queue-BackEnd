<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--iconos material icon-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Home I-Queue</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{URL::asset('/images/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{URL::asset('/images/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{URL::asset('/images/favicon/favicon-16x16.png')}}">
</head>

<body class="container">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        main {
            flex: 1 0 auto;
        }
        .slider .slides li .caption{
            top: 5% !important;
        }

    </style>
    <!--contenedor-->

    <!--nav-->
    @include('navLayout')

    <main>
        <!--fin menu-->
        <h2 class="center-align"><b>Bienvenido a I-Queue</b></h2>


        <!--carusel-->
        <div class="slider">
            <ul class="slides">
                <li>
                    <img src="./images/Orca.jpg" alt="">
                    <div class="caption center-align">
                        <h3>Monitoriza tu negocio</h3>
                        <h5>Gestiona la cadencia de clientes y el aforo.</h5>
                        <img class="responsive-img" src="./images/logoiqueue.png" style="height:300px;" alt="">

                    </div>
                </li>
                <li>
                    <img src="./images/Orca.jpg" alt="">
                    <div class="caption center-align">
                        <h3>Ahorra tiempo</h3>
                        <h5>Evita esperas innecesarias solicitando turno con tu smartphone</h5>
                        <img class="responsive-img"  src="./images/reloj.png" style=" height:300px;">
                    </div>
                </li>
                <li>
                    <img src="./images/Orca.jpg" alt="">
                    <div class="caption center-align">
                        <h3>Mapea tu zona</h3>
                        <h5>Encuentra las tiendas y establecimientos que utilizan I-Queue cerca tuyo</h5>
                        <img class="responsive-img"  src="./images/mapa.png" style=" height:300px;">
                    </div>
                </li>
            </ul>
        </div>
        <!--fin carusel-->
        <br>
        <!--registro button-->
        <div class="row">
            <div class="caption center-align">
                <a href="{{ url('/registro') }}" class="waves-effect waves-light btn-large">Regístrate ya</a>
            </div>
        </div>
        <div class="row center-align">
            <div id="main" style="width:100%; height:400px"></div>
            <h5>I queue por el mundo!</h5>
            <p>A muchos negocios al rededor el mundo les encanta Iqueue!</p>
        </div>

        <!--registro button-->
    </main>


    <!-- Footer -->
    @include('footerLayout')
    <!--fin footer-->

    <!--fin contenedor-->
</body>

<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="./css/materialize.css">

<!-- Compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<script type="text/javascript"
    src="https://cdn.jsdelivr.net/npm/echarts-nightly@5.1.2-dev.20210512/dist/echarts.min.js"></script>
<script type="text/javascript"
    src="https://cdn.jsdelivr.net/npm/echarts-nightly@5.1.2-dev.20210512/dist/extension/dataTool.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts-gl@2/dist/echarts-gl.min.js"></script>
<script type="text/javascript"
    src="https://cdn.jsdelivr.net/npm/echarts-nightly@5.1.2-dev.20210512/dist/extension/bmap.min.js"></script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<!--inicializador de carusel-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.slider');
        var instances = M.Slider.init(elems);
        interval: 1000;
    });

</script>
@php
use App\Models\Commerce;
$locations = array([]);
$commerces = Commerce::all();
foreach ($commerces as $commerce) {
    array_push($locations,[$commerce->longitude,$commerce->latitude,0.1]);
}
$locations_array = json_encode($locations);
@endphp
<script>
    $(document).ready(function() {
        var ROOT_PATH = './images/';

        var chartDom = document.getElementById('main');
        var myChart = echarts.init(chartDom);
        var option;

        var data = {{ $locations_array }};
        data = data.filter(function(dataItem) {
            return dataItem[2] > 0;
        }).map(function(dataItem) {
            return [dataItem[0], dataItem[1], Math.sqrt(dataItem[2])];
        });

        option = {
            backgroundColor: '#fff',
            globe: {
                baseTexture: "./images/world.jpg",
                heightTexture: "./images/world.topo.bathy.200401.jpg",
                //environment: "./images/nebula.jpg",
                shading: 'color',
                light: {
                    main: {
                        intensity: 3,
                        shadow: false
                    }
                },

                viewControl: {
                    autoRotate: false
                }

            },
            series: [{
                type: 'bar3D',
                coordinateSystem: 'globe',
                data: data,
                barSize: 0.6,
                minHeight: 0.1,
                silent: true,
                itemStyle: {
                    color: 'green'
                }
            }]
        };

        myChart.setOption(option);


        option && myChart.setOption(option);
    });

</script>
@include('CookieLayout')
</html>
