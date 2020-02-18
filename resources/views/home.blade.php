@extends('layouts.app')

@section('pagetitle', 'Home')
@section('pagesubtitle', 'Blank Page Layout')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{ route('home') }}">@yield('pagetitle')</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Inicio</span>
        </li>
    </ul>
</div>

@if (session('status'))
    <div class="alert alert-info text-center" role="alert">
        <button class="close" data-close="alert"></button>
        <span role="alert">
            <strong>{{ session('status') }}</strong>
        </span>
    </div>
@endif

<div class="note note-info">
    <p> A black page template with a minimal dependency assets to use as a base for any custom page you create </p>
</div>

@endsection

@push('scripts')
    <script>
        console.log("Pushed into Scripts Stack")
    </script>
@endpush