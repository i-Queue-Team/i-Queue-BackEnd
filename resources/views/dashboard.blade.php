@if (Auth::check() && Auth::user()->role == 'ADMIN')
    @include('userAdminView')
@else
    @include('userView')
@endif
