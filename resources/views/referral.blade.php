@extends('layouts.master')

@section('title')
    Referral
@endsection

@section('content')
    <h1>Referral Link</h1>
    <p>Share this referral link with others:</p>
    <p><a href="{{ route('invite', ['name' => Auth::user()->name]) }}">http://127.0.0.1:8000/invite/{{ Auth::user()->name }}</a></p>

    <div>
        <img src="{{ route('qr-code') }}" alt="QR Code">
    </div>
@endsection
