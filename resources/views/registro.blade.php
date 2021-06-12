<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--iconos material icon-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Registro IQueue</title>
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
    <!--fin menu-->
    <h2 class="center-align">Registra tu cuenta</h2>
    <main>
        <section class="container">

            <div >
                <article class="col s6 offset-s3">
                    <form name="form" method="POST" action="{{ url('/register') }}">
                        @csrf
                        <div class="input-field">
                            <i class="material-icons prefix">person_pin</i>
                            <label for="usuario">Usuario</label>
                            <input id="usuario" type="text" name="name" value='@isset($inputs) {{ $inputs['name'] }}@endisset' required>
                            @if ($errors)
                            <span class="helper-text red-text" data-error="wrong" data-success="right">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="input-field">
                            <i class="material-icons prefix">email</i>
                            <label for="email">email</label>
                            <input id="email" type="text" name="email" value='@isset($inputs) {{ $inputs['email'] }}@endisset' required class="validate">
                            @if ($errors)
                            <span class="helper-text red-text" data-error="wrong" data-success="right">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="input-field">
                            <i class="material-icons prefix">password</i>
                            <label for="password">Contraseña</label>
                            <input id="password" type="password" name="password" required >
                            @if ($errors)
                            <span class="helper-text red-text" data-error="wrong" data-success="right">{{ $errors->first('password') }}</span>
                            @endif
                        </div>

                        <div class="input-field">
                            <i class="material-icons prefix">password</i>
                            <label for="password2" style="font-size: 0.8em;">Repetir contraseña</label>
                            <input id="password2" type="password" name="password2" required >
                        </div>

                        <div class="center-align">
                            <label>
                                <input type="checkbox" id="terminos" onclick="sendBtn()" />

                                <span>He leído y acepto los
                                    <a  data-target="terms" class="modal-trigger" style="font-size:10pt">términos y condiciones</a>
                                    <span style="font-size:12pt">y la
                                        <a data-target="terms" class="modal-trigger" style="font-size:10pt">política de privacidad</a>
                                        .</span>
                            </label>
                        </div>
                        <p class="center-align">

                            <button class="waves-effect waves-light btn" type="submit" id="enviarregistro"
                                disabled="disabled"><i class="material-icons right">send</i>registrar</button>
                        </p>
                        <br>
                        <p class="center-align">¿Ya tienes cuenta? <a href="{{ url('/login') }}">entra aquí</a>.</p>
                        <br>

                    </form>
                </article>

            </div>

        </section>
        <!--fin login-->
        <br>

    </main>
  <!-- terminos y condiciones-->
  <div id="terms" class="modal">
    <div class="modal-content">
      <h4>Terminos Y Condiciones/Politica de privacidad</h4>
      <p>El presente Pol&iacute;tica de Privacidad establece los t&eacute;rminos en que <strong>Iqueue&nbsp;</strong>usa y protege la informaci&oacute;n que es proporcionada por sus usuarios al momento de utilizar su sitio web.</p>
<p>Esta compa&ntilde;&iacute;a est&aacute; comprometida con la seguridad de los datos de sus usuarios.&nbsp;</p>
<p>Cuando le pedimos llenar los campos de informaci&oacute;n personal con la cual usted pueda ser identificado, lo hacemos asegurando que s&oacute;lo se emplear&aacute; de acuerdo con los t&eacute;rminos de este documento. Sin embargo esta <strong>Pol&iacute;tica de Privacidad&nbsp;</strong>puede cambiar con el tiempo o ser actualizada por lo que le recomendamos y enfatizamos revisar continuamente esta p&aacute;gina para asegurarse que est&aacute; de acuerdo con dichos cambios.&nbsp;</p>
<p><strong>INFORMACION RECOGIDA</strong></p>
<p>Informaci&oacute;n que es recogida Nuestro sitio web podr&aacute; recoger informaci&oacute;n personal por ejemplo: Nombre, informaci&oacute;n de contacto como su direcci&oacute;n de correo electr&oacute;nica e informaci&oacute;n demogr&aacute;fica. As&iacute; mismo cuando sea necesario podr&aacute; ser requerida informaci&oacute;n espec&iacute;fica para procesar alg&uacute;n pedido o realizar una entrega o facturaci&oacute;n. Uso de la informaci&oacute;n recogida Nuestro sitio web emplea la informaci&oacute;n con el fin de proporcionar el mejor servicio posible, particularmente para mantener un registro de usuarios, de pedidos en caso que aplique, y mejorar nuestros productos y servicios. Es posible que sean enviados correos electr&oacute;nicos peri&oacute;dicamente a trav&eacute;s de nuestro sitio con ofertas especiales, nuevos productos y otra informaci&oacute;n publicitaria que consideremos relevante para usted o que pueda brindarle alg&uacute;n beneficio, estos correos electr&oacute;nicos ser&aacute;n enviados a la direcci&oacute;n que usted proporcione y podr&aacute;n ser cancelados en cualquier momento. <strong>Iqueue&nbsp;</strong>est&aacute; altamente comprometido para cumplir con el compromiso de mantener su informaci&oacute;n segura. Usamos los sistemas m&aacute;s avanzados y los actualizamos constantemente para asegurarnos que no exista ning&uacute;n acceso no autorizado. Cookies Una cookie se refiere a un fichero que es enviado con la finalidad de solicitar permiso para almacenarse en su ordenador, al aceptar dicho fichero se crea y la cookie sirve entonces para tener informaci&oacute;n respecto al tr&aacute;fico web, y tambi&eacute;n facilita las futuras valencia cf noticias recurrente. Otra funci&oacute;n que tienen las cookies es que con ellas las web pueden reconocerte individualmente y por tanto brindarte el mejor servicio personalizado de su web. Nuestro sitio web emplea las cookies para poder identificar las p&aacute;ginas que son visitadas y su frecuencia. Esta informaci&oacute;n es empleada &uacute;nicamente para <strong>an&aacute;lisis&nbsp;</strong><strong>estad&iacute;stico&nbsp;</strong>y despu&eacute;s la informaci&oacute;n se elimina de forma permanente.&nbsp;</p>
<p><strong>COOKIES</strong></p>
<p>Usted puede eliminar las cookies en cualquier momento desde su ordenador. Sin embargo las cookies ayudan a proporcionar un mejor servicio de los sitios web, est&aacute;s no dan acceso a informaci&oacute;n de su ordenador ni de usted, a menos de que usted as&iacute; lo quiera y la proporcione directamente. Usted puede aceptar o negar el uso de cookies, sin embargo la mayor&iacute;a de navegadores aceptan cookies autom&aacute;ticamente pues sirve para tener un mejor servicio web. Tambi&eacute;n usted puede cambiar la configuraci&oacute;n de su ordenador para declinar las cookies. Si se declinan es posible que no pueda utilizar algunos de nuestros servicios. Enlaces a Terceros Este sitio web pudiera contener en laces a otros sitios que pudieran ser de su inter&eacute;s. Una vez que usted de clic en estos enlaces y abandone nuestra p&aacute;gina, ya no tenemos control sobre al sitio al que es redirigido y por lo tanto no somos responsables de los t&eacute;rminos o privacidad ni de la protecci&oacute;n de sus datos en esos otros sitios terceros. Dichos sitios est&aacute;n sujetos a sus propias pol&iacute;ticas de privacidad por lo cual es recomendable que los consulte para confirmar que usted est&aacute; de acuerdo con estas. Control de su informaci&oacute;n personal En cualquier momento usted puede restringir la recopilaci&oacute;n o el uso de la informaci&oacute;n personal que es proporcionada a nuestro sitio web. Cada vez que se le solicite rellenar un formulario, como el de alta de usuario, puede marcar o desmarcar la opci&oacute;n de recibir informaci&oacute;n por correo electr&oacute;nico. En caso de que haya marcado la opci&oacute;n de recibir nuestro bolet&iacute;n o publicidad usted puede cancelarla en cualquier momento. Esta compa&ntilde;&iacute;a no vender&aacute;, ceder&aacute; ni distribuir&aacute; la informaci&oacute;n personal que es recopilada sin su consentimiento, salvo que sea requerido por un juez con un orden judicial. <strong>Iqueue&nbsp;</strong>Se reserva el derecho de cambiar los t&eacute;rminos de la presente Pol&iacute;tica de Privacidad en cualquier momento. </p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">OK</a>
    </div>
  </div>
    @include('footerLayout')

</body>


<script id="envio">

    function sendBtn() {
        var terminos = document.getElementById("terminos")
        var sendBtn = document.getElementById("enviarregistro")
        if (sendBtn.disabled == 1) {
            sendBtn.disabled = 0;
        } else {
            sendBtn.disabled = 1;
        }
    }

</script>


<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="./css/materialize.css">

<!-- Compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script>    $(document).ready(function(){
    $('.modal').modal();
  });</script>
</body>

</html>
