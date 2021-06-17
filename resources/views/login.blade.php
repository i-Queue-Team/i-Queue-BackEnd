<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--iconos material icon-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/materialize.css') }}">
    <title>Login IQueue</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('/images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('/images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('/images/favicon/favicon-16x16.png') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

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

<body class="container">

    <!--menu-->
    <!--nav extendido-->
    @include('navLayout')


    <main>

        <!--fin menu-->
        <h2 class="center-align">Inicio de sesión</h2>


        <section class="container">
            <article class="col s6 offset-s3">

                <form method="POST" action="{{ url('/login') }}">
                    @isset($credentials)
                        @if ($credentials['passwordFromMail'] !== '')
                            <div class="tap-target container" data-target="loginButtonDiscovery">
                                <div class="tap-target-content">
                                    <h5 style="color:white">¡Bienvenido!</h5>
                                    <p style="color:white">Pulsa para iniciar sesión y supervisar tu turno</p>
                                </div>
                            </div>
                        @endif
                    @endisset
                    {{ csrf_field() }}
                    <div class="input-field">
                        <i class="material-icons prefix">person_pin</i>
                        <input type="text" id="email" name="email" required
                            @isset($inputs)value='{{ $inputs['email'] }}' @endisset
                            @isset($credentials)value='{{ $credentials['emailFromMail'] }}' @endisset>
                        <label for="email">Email</label>
                        @if ($errors)
                            <span class="helper-text red-text" data-error="wrong"
                                data-success="right">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="input-field">
                        <i class="material-icons prefix">password</i>

                        <input id="password" type="password" name="password" required
                            @isset($credentials)value='{{ $credentials['passwordFromMail'] }}' @endisset>
                        @if ($errors)
                            <span class="helper-text red-text" data-error="wrong"
                                data-success="right">{{ $errors->first('password') }}</span>
                        @endif
                        <label for="password">Contraseña</label>
                        <p class="center-align"><button id="loginButtonDiscovery" class="waves-effect waves-light btn"
                                type="submit"><i class="material-icons right">send</i>entrar</button></p>
                        <p class="center-align"><a class="modal-trigger" href="#modal1">¿Olvidaste tu contraseña?</a>
                        </p>
                        <p class="center-align">¿No tienes cuenta? <a href="{{ url('/registro') }}">regístrate
                                aquí</a>.
                    </div>

                </form>
            </article>
        </section>











        <div id="modal1" class="modal" style="min-width: 250px">
            <div class="modal-content">
                <h4>Recordar contraseña</h4>
                <p>Introduce tu dirección de correo electronico</p>
                <form id="rememberPass">
                    <div class="input-field">
                        <i class="material-icons prefix">contact_mail</i>
                        <label for="inputmail">email</label>
                        <input id="inputmail" type="email" name="email" required class="validate">
                    </div>
                    <div class="input-field">
                        <i class="material-icons prefix">contact_mail</i>
                        <label for="confirm_inputmail">repetir email</label>
                        <input id="confirm_inputmail" type="email" name="email2" required class="validate">
                    </div>
            </div>
            <div class="modal-footer">
                <div class="center-align">
                    <a href="#!" class="modal-close waves-effect waves-light btn red">Cancelar</a>
                    <button class="waves-effect waves-light btn " type="submit">Recordar</button>
                </div>
            </div>
        </div>
    </main>
    <!-- Tap Target Structure -->

    <!--fin login-->
    <br>
    @include('footerLayout')

</body>


<script>
    //modal

    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.modal');
        var instances = M.Modal.init(elems);
    });

</script>


<!-- Compiled and minified CSS -->


<!-- Compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.sidenav');
        var instances = M.Sidenav.init(elems, {});
        var elemsTap = document.querySelector('.tap-target');
        var instancesTap = M.TapTarget.init(elemsTap, {});
        instancesTap.open()
        $("#loginButtonDiscovery").animate({
            left: '1px'
        });
        $(".open").click(function() {
            $("#rememberPass").submit();

        });
    });

    var password = document.getElementById("inputmail"),
        confirm_password = document.getElementById("confirm_inputmail");

    function validatePassword() {
        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Los emails no coinciden :(");
        } else {
            confirm_password.setCustomValidity('');
        }
    }
    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
    $(document).ready(function() {

        $("#rememberPass").submit(function(event) {
            var formData = new FormData(this);
            formData.append('_method', 'POST');
            console.log(formData);
            $.ajax({
                type: "POST",
                url: "{{ URL::to('/') }}/api/forgot-password",
                data: formData,
                encode: true,
                processData: false, // tell jQuery not to process the data
                contentType: false,
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    var response = jQuery.parseJSON(xhr.responseText);
                    console.log(response.errors);
                    if (response.errors) {
                        M.toast({
                            html: 'Hubo un error :('
                        })
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
                var url = window.location;
                var urlString = encodeURIComponent(url);
                console.log(urlString);
                M.toast({
                    html: 'El correo de recuperacion se envio correctamente'
                })

                //console.log(data);
            });
            event.preventDefault();
        });
    });

</script>
@include('CookieLayout')

</html>
