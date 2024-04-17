@extends('layouts.master')

@section('title')
{{ __('referral.referral') }}
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/referralStyles.css') }}">
    <script src="{{ asset('js/copyLink.js') }}"></script>
@endsection

@section('content')
        <h1> {{ __('referral.referral_link') }}</h1>
        <p>{{ __('referral.referral_text1') }} {{ Auth::user()->points }} {{ __('referral.referral_text2') }}</p>
        <p>{{ __('referral.share') }}</p>
        <div class="link-container">
            <input id="referralLink" type="text" value="{{ route('invite', ['name' => Auth::user()->name]) }}" readonly>
            <button onclick="copyToClipboard()"><i class="fas fa-copy"></i></button>
        </div>

        <p>{{ __('referral.scan') }}</p>

        <div>
            <img src="{{ route('qr-code') }}" alt="QR Code">
        </div>
@endsection
