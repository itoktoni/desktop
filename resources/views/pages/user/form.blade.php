@extends(Template::ajax())

@section('title') Master User @endsection

@section('form')

@if(isset($model))
{!! Form::model($model, ['route'=>[SharedData::get('route').'.postUpdate', 'code' => $model->{$model->getKeyName()}],'class'=>'form-horizontal needs-validation' , 'files'=>true]) !!}
@else
{!! Form::open(['url' => route(SharedData::get('route').'.postCreate'), 'class' => 'form-horizontal needs-validation', 'files' => true]) !!}
@endif

@endsection

@section('container')

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label>Name</label>
            {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'required']) !!}
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Role</label>
            {!! Form::select('role', $roles, null, ['class' => 'form-control', 'id' =>
            'user_name', 'placeholder' => '- Select role -', 'required']) !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            <label>Email address</label>
            {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email']) !!}
            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
            <label>Password</label>
            {!! Form::password('password', ['class' => 'form-control', 'id' => 'password']) !!}
            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

@endsection

@section('action')
<div class="button">
    <button type="submit" class="btn btn-primary" id="modal-btn-save">{{ __('Save') }}</button>
</div>
@endsection

@section('javascript')
@include(Template::components('form'))
@endsection
