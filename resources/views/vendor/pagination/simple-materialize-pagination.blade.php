


@if ($paginator->hasPages())
<div class="row pagination ">
    <div class="col s6  ">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())

            <a class="right waves-effect disabled waves-light btn-small"><i class="material-icons left">chevron_left</i>atras&nbsp;&nbsp;&nbsp;&nbsp;</a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="right waves-effect waves-light btn-small"><i
                    class="material-icons left">chevron_left</i>atras&nbsp;&nbsp;&nbsp;&nbsp;</a>
        @endif
    </div>
    {{-- Next Page Link --}}
    <div class="col s6 ">
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="waves-effect waves-light btn-small"><i
                    class="material-icons right">chevron_right</i>siguiente</a>
        @else
            <a class="waves-effect waves-light btn-small disabled"><i class="material-icons left">chevron_right</i>siguiente</a>
        @endif
    </div>
</div>
@endif


