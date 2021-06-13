 <!-- Modal Structure -->
 <div id="cookies" class="modal bottom-sheet">
    <div class="modal-content">

    <div class="row">
        <div class="col s12"><h4>Cookies</h4></div>
        <div class="col s6"><p>Hola,Este sitio web utiliza cookies para personalizar el contenido y analizar el tráfico con el fin de ofrecerle una mejor experiencia.</p></div>
        <div class="col s6">  <img class="RotateCookie" src=" {{URL::asset('/images/cookie.jpg')}}" alt="Girl in a jacket" width="100" height="100"></div>
      </div>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
</div>
<script>
 $(window).on('load',function(){
  if (document.cookie.indexOf('visited=true') == -1){
    $('#cookies').modal();
    $('#cookies').modal('open');
    var year = 1000*60*60*24*365;
    var expires = new Date((new Date()).valueOf() + year);
    document.cookie = "visited=true;expires=" + expires.toUTCString();
  }
});
</script>
