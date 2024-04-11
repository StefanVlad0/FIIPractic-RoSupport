@extends('layouts.master')

@section('title')
    Referral
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/referralStyles.css') }}">
    <script src="{{ asset('js/copyLink.js') }}"></script>
@endsection

@section('content')
        <h1>Referral Link</h1>
        <p>Share this referral link with others:</p>
        <div class="link-container">
            <input id="referralLink" type="text" value="{{ route('invite', ['name' => Auth::user()->name]) }}" readonly>
            <button onclick="copyToClipboard()"><i class="fas fa-copy"></i></button>
        </div>

        <p>Or scan this QR code:</p>

        <div>
            <img src="{{ route('qr-code') }}" alt="QR Code">
        </div>
@endsection
