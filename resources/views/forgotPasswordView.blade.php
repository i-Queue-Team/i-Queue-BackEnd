<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--iconos material icon-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

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


<body class="container">

    <!--menu-->
    <!--nav extendido-->
    <nav>
        <div class="nav-wrapper">
            <a href="#" class="brand-logo center">I-queue</a>
            <ul id="nav-mobile" class="left ">
                <li><a href="{{ url('/') }}"> <i class="material-icons">chevron_left</i></a></li>

            </ul>
        </div>
    </nav>
    <main class="center-align container">
        <h2>Cambiar Contraseña</h2>
        <i class="medium material-icons">lock</i>
        <div class="row">
            <form id="updatePass" class="col s12">
                <input id="token" type="hidden" name="token" value="{{ $token }}">
                <div class="row">
                    <div class="input-field col s12" id="password_err">
                        <input id="password" type="password" name="password" class="validate">
                        <label for="password">Nueva Contraseña</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="confirm_password" type="password" class="validate">
                        <label for="email">Confirmar Contraseña</label>
                    </div>
                </div>
                <button type="submit" class="waves-effect waves-light btn-large">
                    <i class="material-icons right">update</i>Actualizar
                </button>
            </form>
        </div>
    </main>


</body>



<!-- Compiled and minified CSS -->

<link rel="stylesheet" href="{{ asset('css/materialize.css') }}">

<!-- Compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js"
    integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

<script>
    var password = document.getElementById("password"),
        confirm_password = document.getElementById("confirm_password");

    function validatePassword() {
        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Las contraseñas no coinciden :(");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
    $(document).ready(function() {

        $("#updatePass").submit(function(event) {
            var formData = new FormData(this);
            console.log(Array.from(formData));

            $.ajax({
                type: "POST",
                url: "{{ URL::to('/') }}/api/forgot-password-change-password",

                data: formData,
                encode: true,
                processData: false, // tell jQuery not to process the data
                contentType: false,
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    var response = jQuery.parseJSON(xhr.responseText);
                    console.log(response.errors);
                    if (response.errors) {
                        $.each(response.errors, function(index, value) {
                            console.log(index + ": " + value);
                            if (response.errors) {
                                if (!$("#" + index).hasClass("invalid")) {
                                    $("#" + index).addClass("invalid");
                                    $("#" + index + "_err").append(
                                        '<span class="helper-text" data-error="' +
                                        value +
                                        '" data-success="Pinta Bien!">' +
                                        value + "</span>"
                                    );
                                }
                            } else {
                                $("#" + index).addClass("success");
                            }
                        });
                    }
                }
            }).done(function(data) {

                console.log(data);

                location.reload();


                //console.log(data);
            });
            event.preventDefault();
        });
    });

</script>

</html>
