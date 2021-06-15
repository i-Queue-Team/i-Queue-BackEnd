<ul id="slide-out" class="sidenav">
    <li>
        <div class="user-view" style="z-index:10;">
            <div class="background">
                <img src="./images/Quepal.jpg">
            </div>
            <i class="material-icons right " style="color:white">close</i>
            <img class="circle" src="./images/logo.png">
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
