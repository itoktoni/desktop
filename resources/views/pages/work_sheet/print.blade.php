@extends('layouts.print')

@section('header')
<h4>List Work Sheet</h4>
<div class="header-action">
    <nav>
        <a onclick="window.print()" href="{{ route(SharedData::get('route').'.getPrint') }}">Print PDF</a>
    </nav>
</div>
@endsection

@section('content')
@includeIf(Template::form(SharedData::get('template'),'data'))
@endsection