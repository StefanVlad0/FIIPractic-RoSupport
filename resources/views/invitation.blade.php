@extends('layouts.master')

@section('title')
    Invitation
@endsection

@section('content')
    <h1>Ai fost invitat de către utilizatorul {{ $inviter->name }}</h1>
@endsection
