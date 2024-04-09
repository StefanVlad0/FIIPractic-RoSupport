@extends('layouts.master')

@section('title')
    Homepage
@endsection

@section('content')
<h2>Hello, {{ \Illuminate\Support\Facades\Auth::user()->name }}!</h2>
@endsection
