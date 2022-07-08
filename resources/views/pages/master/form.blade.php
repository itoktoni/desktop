@extends('layouts.app')

@section('content')

@yield('form')
<!-- begin::page-header -->
<div class="page-header">
    <div class="header-container container-fluid d-sm-flex justify-content-between">

        <h4>@yield('title')</h4>
        @yield('action')

    </div>
</div>
<!-- end::page-header -->

<div class="container-fluid">

    <div class="card">
        <div class="card-body">

            @yield('container')

        </div>
    </div>

</div>

{!! Form::close() !!}

@endsection