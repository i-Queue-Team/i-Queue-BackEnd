<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--iconos material icon-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Login IQueue</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{URL::asset('/images/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{URL::asset('/images/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{URL::asset('/images/favicon/favicon-16x16.png')}}">
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
            <div >
                <article class="col s6 offset-s3">
                    <form  method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                        <div class="input-field">
                            <i class="material-icons prefix">person_pin</i>
                            <input type="text" id="email" name="email" required value='@isset($inputs) {{ $inputs['email'] }}@endisset'>
                            <label for="email">Email</label>
                            @if ($errors)
                                <span class="helper-text red-text" data-error="wrong" data-success="right">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="input-field">
                            <i class="material-icons prefix">password</i>
                            <input id="password" type="password" name="password" required>
                            <label  for="password">Contraseña</label>
                            @if ($errors)
                                <span class="helper-text red-text" data-error="wrong" data-success="right">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <p class="center-align">
                            <button class="waves-effect waves-light btn" type="submit"><i
                                    class="material-icons right">send</i>entrar</button>
                        </p>
                    </form>
                    <br>
                    <div class="center-align">
                        <!-- Modal Trigger -->
                        <a class="modal-trigger" href="#modal1">¿Olvidaste tu contraseña?</a>
                        <!-- Modal Structure -->
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
                    </div>
                    <p class="center-align">¿No tienes cuenta? <a href="{{ url('/registro') }}">regístrate aquí</a>.
                    </p>
                    <br>
                    </form>
                </article>
            </div>
        </section>
    </main>
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
<link rel="stylesheet" href="./css/materialize.css">

<!-- Compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>


<script>
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
                        M.toast({html: 'Hubo un error :('})
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
                M.toast({html: 'El correo de recuperacion se envio correctamente'})

                //console.log(data);
            });
            event.preventDefault();
        });
    });


</script>
@include('CookieLayout')
</html>
