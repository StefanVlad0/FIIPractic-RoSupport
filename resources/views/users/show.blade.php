@include('navbar')

<div>Username: {{ $name }}</div>


<div class="card-body">
    @if (Auth::user()->name == $name)
        Acesta este profilul tău.
    @else
        Acesta este profilul utilizatorului {{ $name }}.
        <button onclick="location.href='/message/{{ $name }}'">Trimite mesaj</button>
    @endif
</div>
