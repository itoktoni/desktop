@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (!session('status'))
                    <div class="alert alert-success" role="alert">
                        You are logged in!
                    </div>
                    <script>
                        localStorage.setItem('status_akun', 'login');
                    </script>                     
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
