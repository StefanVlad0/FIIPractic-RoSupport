@include('navbar')

<h2>Hello, {{ \Illuminate\Support\Facades\Auth::user()->name }}!</h2>
