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
    <title>Edit Profile Iqueue</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('/images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('/images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('/images/favicon/favicon-16x16.png') }}">
</head>



<body class="container">

    <!--menu-->
    <!--nav extendido-->
    <nav>
        <div class="nav-wrapper">
            <a href="{{ url('/dashboard') }}" class="brand-logo center">I-queue</a>
            <ul id="nav-mobile" class="left ">
                <li><a href="{{ url('/dashboard') }}"> <i class="material-icons">chevron_left</i></a></li>

            </ul>
        </div>
    </nav>
    <main class="center-align container">
        <h2>Editar perfil</h2>
        <i class="medium material-icons">person</i>
        <div class="row">
            <form id="update_user" class="col s12">

                <input id="token" type="hidden" name="token" value="">

                <div class="row">
                    <div class="input-field col s12  m6 l6" id="name_err">
                        <input id="user" type="text" class="validate" name="name"
                            placeholder="{{ Auth::user()->name }}">
                        <label for="user">usuario</label>
                    </div>
                    <div class="input-field col s12  m6 l6" id="email_err">
                        <input id="email" type="email" class="validate" name="email"
                            placeholder="{{ Auth::user()->email }}">
                        <label for="email">email</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m6 l6" id="password_err">
                        <input id="password" type="password" name="password" class="validate">
                        <label for="password">Nueva Contraseña</label>
                    </div>
                    <div class="input-field col s12  m6 l6">
                        <input id="confirm_password" type="password" class="validate">
                        <label for="confirm_password">Confirmar Contraseña</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m6 l6">
                        <button type="submit" class="waves-effect waves-light btn-large">
                            <i class="material-icons right">update</i>Actualizar perfil
                        </button>
                    </div>
                    <div class="input-field col s12  m6 l6">
                        <a class="dropdown-trigger waves-effect waves-light btn-large red"
                            data-target='confirmDropDown'>
                            <i class="material-icons right">delete</i>Borrar cuenta
                        </a>
                        <!-- Dropdown Structure -->
                        <ul id='confirmDropDown' class='dropdown-content'>
                            <li><a href="#!">Cancelar</a></li>
                            <li class="divider" tabindex="-1">¿Estas seguro?</li>
                            <li><a href="#!" onclick="DeleteUser()">Borrar Cuenta</a></li>
                        </ul>
                    </div>
                </div>

                <br><br>

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
@php $token = Session::get('variableName'); @endphp
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
        $("#update_user").submit(function(event) {
            $(this).find(":input").filter(function() {
                return !this.value;
            }).attr("disabled", "disabled");
            var formData = new FormData(this);
            formData.append('_method', 'PUT');

            $.ajax({
                type: "POST",
                url: "{{ URL::to('/') }}/api/users/{{ Auth::id() }}",
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

                var url = window.location;
                var urlString = encodeURIComponent(url);
                console.log(urlString);

                location.reload();
                console.log(data);
            });
            event.preventDefault();
        });
    });

    function DeleteUser() {
        $.ajax({
            url: "{{ URL::to('/') }}/api/users/" + '{{ Auth::id() }}',
            type: 'DELETE',
            headers: {
                'Authorization': 'Bearer {{ $token }}'
            },
            success: function(data) {
                window.location.replace("{{url('/')}}");
                //show toast
            },
            error: function() {
                console.log("error");
                M.toast({
                    html: 'hubo un error!'
                })
            }
        });
    }
    $(".dropdown-trigger").dropdown({
        constrainWidth: false
    });

</script>

</html>
