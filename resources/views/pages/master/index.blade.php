@extends('layouts.app')

@section('content')

<!-- begin::page-header -->
<div class="page-header">
    <div class="header-container container-fluid d-sm-flex justify-content-between">

        @yield('header')

    </div>
</div>
<!-- end::page-header -->

<div class="container-fluid">

    @yield('form')

</div>

@endsection